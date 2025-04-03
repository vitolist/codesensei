<div class="flex min-h-screen bg-gray-900 text-gray-100">
    <!-- Left Side: Background Image -->
    <div class="hidden md:flex md:w-1/2 lg:w-3/5 bg-cover bg-center"
        style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Isusova%C4%8Dki_samostan_V%C5%BD_%28FOI%29.jpg/1200px-Isusova%C4%8Dki_samostan_V%C5%BD_%28FOI%29.jpg');">
        <div class="bg-violet-700 bg-opacity-25 w-full h-full flex items-center justify-center">
            <!-- <h1 class="text-4xl font-bold text-white text-center px-4"></h1> -->
        </div>
    </div>

    <!-- Right Side: Registration Form -->
    <div class="flex flex-col justify-center items-center w-full md:w-1/2 lg:w-2/5 p-8 bg-gray-800">
        <div class="flex items-center gap-2 mb-6">
            <img class="h-10" src="/public/assets/logo_spcp.png">
            <h1 class="text-3xl font-bold text-center">Prijavite se</h1>
        </div>
        <form class="w-full max-w-md" id="loginForm" method="post" action="/login">

            <div class="mb-4">
                <!-- <label for="email" class="block text-sm font-medium mb-1">Email</label> -->
                <input type="email" id="email" name="email" placeholder="Email"
                    class="w-full px-3 py-2 rounded-md bg-gray-900 text-gray-100 focus:ring-2 focus:ring-purple-600 focus:outline-none" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <!-- <label for="password" class="block text-sm font-medium mb-1">Lozinka</label> -->
                <input type="password" id="password" name="password" placeholder="Lozinka"
                    class="w-full px-3 py-2 rounded-md bg-gray-900 text-gray-100 focus:ring-2 focus:ring-purple-600 focus:outline-none" required>
            </div>

            <div class="flex items-center justify-center mb-4">
                <label class="py-2 w-full relative inline-flex items-center cursor-pointer bg-gray-900 rounded-md">
                    <!-- Hidden Input for 'Student' when unchecked -->
                    <input type="hidden" name="account_type" value="Student">

                    <!-- Checkbox for 'Profesor' when checked -->
                    <input type="checkbox" id="account_type" name="account_type" value="Profesor" class="sr-only peer" onchange="console.log(this.checked)" />

                    <!-- Slider (moving rectangle) -->
                    <span class="absolute inset-y-1 left-1 w-[48%] bg-purple-600 rounded-md shadow-md transition-transform transform peer-checked:translate-x-[calc(100%+8px)]"></span>

                    <!-- Option Labels -->
                    <span class="w-1/2 text-center text-md font-medium text-white z-10">
                        Student
                    </span>
                    <span class="w-1/2 text-center text-md font-medium text-white z-10">
                        Profesor
                    </span>
                </label>
            </div>

            <!-- Register Button -->
            <button type="submit"
                class="w-full py-2 bg-purple-600 text-white rounded-md font-medium hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600">
                Prijavi se
            </button>

        </form>

        <!-- Login Link -->
        <p class="text-center mt-6 text-sm font-medium">Nemate račun? <a href="/register" class="text-purple-400 underline">Registrirajte se</a></p>
    </div>
</div>

<script>
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '/login',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.status === "error") {
                    alert(response.message);
                } else if (response.status === "success") {
                    window.location.href = '/landing';
                }
            },
            error: function(response) {
                console.log(response);
                alert('Error! Please try again.');
            }
        });
    });
</script>