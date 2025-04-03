<?php
class FileUpload
{
    private $file;
    private $targetDir;
    private $allowedTypes;
    private $maxSize;
    private $errors = [];
    private $filename;

    public function __construct($file, $targetDir, $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'], $maxSize = 2097152)
    {
        $this->file = $file;
        $this->targetDir = $targetDir;
        $this->allowedTypes = $allowedTypes;
        $this->maxSize = $maxSize;
    }

    public function validate()
    {
        // Check if file type is allowed
        if (!in_array($this->file['type'], $this->allowedTypes)) {
            $this->errors[] = 'Invalid file type.';
        }

        // Check if file size is within the limit
        if ($this->file['size'] > $this->maxSize) {
            $this->errors[] = 'File size exceeds the maximum limit.';
        }

        return empty($this->errors);
    }

    public function upload()
    {
        if ($this->validate()) {
            $uniqueFilename = $this->generateUniqueFilename($this->file['name']);
            $targetFilePath = $this->targetDir . DIRECTORY_SEPARATOR . $uniqueFilename;

            if (move_uploaded_file($this->file['tmp_name'], $targetFilePath)) {
                $this->filename = $uniqueFilename;
                return $uniqueFilename;
            } else {
                $this->errors[] = 'Failed to move uploaded file.';
            }
        }

        return false;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getFileRoute()
    {
        return $this->targetDir . DIRECTORY_SEPARATOR . $this->filename;
    }

    private function generateUniqueFilename($filename)
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $uniqueName = bin2hex(random_bytes(8)) . '.' . $ext;
        return $uniqueName;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
