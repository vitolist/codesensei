<div class="flex min-h-screen bg-gray-900 text-gray-100">
    <!-- Left Side: Background Image -->
    <div class="hidden md:flex md:w-1/2 lg:w-3/5 bg-cover bg-center"
        style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Isusova%C4%8Dki_samostan_V%C5%BD_%28FOI%29.jpg/1200px-Isusova%C4%8Dki_samostan_V%C5%BD_%28FOI%29.jpg');">
        <div class="bg-violet-700 bg-opacity-25 w-full h-full flex items-center justify-center">
            <h1 class="text-4xl font-bold text-white text-center px-4"></h1>
        </div>
    </div>

    <!-- Right Side: Registration Form -->
    <div class="flex flex-col justify-center items-center w-full md:w-1/2 lg:w-2/5 p-8 bg-gray-800">
        <div class="flex items-center gap-2 mb-6">
            <img class="h-10" src="/public/assets/logo_spcp.png">
            <h1 class="text-3xl font-bold text-center">Kreirajte račun</h1>
        </div>
        <form class="w-full max-w-md" id="registerForm" method="post" action="/register/registerUser">

            <div class="flex space-x-4 mb-4">
                <!-- First Name -->
                <div class="w-1/2">
                    <!-- <label for="first_name" class="block text-sm font-medium mb-1">Ime</label> -->
                    <input type="text" id="first_name" name="first_name" placeholder="Ime"
                        class="w-full px-3 py-2 rounded-md bg-gray-900 text-gray-100 focus:ring-2 focus:ring-purple-600 focus:outline-none" required>
                </div>

                <!-- Last Name -->
                <div class="w-1/2">
                    <!-- <label for="last_name" class="block text-sm font-medium mb-1">Prezime</label> -->
                    <input type="text" id="last_name" name="last_name" placeholder="Prezime"
                        class="w-full px-3 py-2 rounded-md bg-gray-900 text-gray-100 focus:ring-2 focus:ring-purple-600 focus:outline-none" required>
                </div>
            </div>

            <!-- Sex -->
            <div class="mb-4">
                <!-- <label for="sex" class="block text-sm font-medium mb-1">Spol</label> -->
                <select id="sex" name="sex"
                    class="w-full px-3 py-2 rounded-md bg-gray-900 text-gray-100 focus:ring-2 focus:ring-purple-600 focus:outline-none" required>
                    <option value="" disabled selected>Odaberite spol</option>
                    <option value="M">Muško</option>
                    <option value="Z">Žensko</option>
                </select>
            </div>

            <div class="flex space-x-4 mb-4">
                <!-- Phone -->
                <div class="w-1/2">
                    <!-- <label for="phone" class="block text-sm font-medium mb-1">Telefon</label> -->
                    <input type="tel" id="phone" name="phone" placeholder="Telefon"
                        class="w-full px-3 py-2 rounded-md bg-gray-900 text-gray-100 focus:ring-2 focus:ring-purple-600 focus:outline-none" required>
                </div>

                <!-- Email -->
                <div class="w-1/2">
                    <!-- <label for="email" class="block text-sm font-medium mb-1">Email</label> -->
                    <input type="email" id="email" name="email" placeholder="Email"
                        class="w-full px-3 py-2 rounded-md bg-gray-900 text-gray-100 focus:ring-2 focus:ring-purple-600 focus:outline-none" required>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <!-- <label for="password" class="block text-sm font-medium mb-1">Lozinka</label> -->
                <input type="password" id="password" name="password" placeholder="Lozinka"
                    class="w-full px-3 py-2 rounded-md bg-gray-900 text-gray-100 focus:ring-2 focus:ring-purple-600 focus:outline-none" required>
            </div>

            <!-- Repeat Password -->
            <div class="mb-4">
                <!-- <label for="repeat_password" class="block text-sm font-medium mb-1">Ponovite lozinku</label> -->
                <input type="password" id="repeat_password" name="repeat_password" placeholder="Ponovite lozinku"
                    class="w-full px-3 py-2 rounded-md bg-gray-900 text-gray-100 focus:ring-2 focus:ring-purple-600 focus:outline-none" required>
            </div>

            <!-- Profile Picture -->
            <div class="my-3 flex items-center justify-between">
                <!-- Input and Button -->
                <div class="relative group w-3/4">
                    <!-- Hidden File Input -->
                    <input type="file" id="picture" name="picture" accept="image/*"
                        class="sr-only" required
                        onchange="previewImage(event)">

                    <!-- Custom Button -->
                    <label for="picture"
                        class="cursor-pointer flex items-center justify-between px-4 py-2 rounded-md bg-gray-900 text-white font-medium shadow-md hover:bg-purple-700 focus:ring-2 focus:ring-purple-500 focus:outline-none transition w-full">
                        Profilna slika <i class="fa-regular fa-file ml-2"></i>
                    </label>
                </div>

                <!-- Image Preview -->
                <div id="image-preview" class="ml-4 w-16 h-16 rounded-full bg-gray-800 flex items-center justify-center overflow-hidden border border-gray-700">
                    <span class="text-gray-400 text-xs">Nema slike</span>
                </div>
            </div>

            <!-- Script for Image Preview -->
            <script>
                function previewImage(event) {
                    const file = event.target.files[0];
                    const preview = document.getElementById('image-preview');

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.innerHTML = `<img src="${e.target.result}" alt="Selected Image" class="w-16 h-16 object-cover">`;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        preview.innerHTML = `<span class="text-gray-400 text-sm">No Image</span>`;
                    }
                }
            </script>


            <!-- Birth Date -->
            <div class="mb-4">
                <!-- <label for="birth_date" class="block text-sm font-medium mb-1">Datum rođenja</label> -->
                <input type="date" id="birth_date" name="birth_date"
                    class="w-full px-3 py-2 rounded-md bg-gray-900 text-gray-100 focus:ring-2 focus:ring-purple-600 focus:outline-none" required>
            </div>


            <div class="flex items-center justify-center mb-4">
                <label class="py-2 w-full relative inline-flex items-center cursor-pointer bg-gray-900 rounded-md">
                    <!-- Hidden Input for 'Student' when unchecked -->
                    <input type="hidden" name="account_type" value="student">

                    <!-- Checkbox for 'Profesor' when checked -->
                    <input type="checkbox" name="account_type" value="landlord" class="sr-only peer" onchange="console.log(this.checked)" />

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


            <!-- Terms and Conditions -->
            <div class="flex items-center mb-6">
                <input type="checkbox" id="terms" name="terms" class="h-4 w-4 text-purple-600 focus:ring-purple-600" required>
                <label for="terms" class="ml-2 text-sm font-medium">Pristajem na <a href="#" class="text-purple-400 underline">odredbe i uvjete</a></label>
            </div>

            <!-- Register Button -->
            <button type="submit"
                class="w-full py-2 bg-purple-600 text-white rounded-md font-medium hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600">
                Kreiraj račun
            </button>

        </form>

        <!-- Login Link -->
        <p class="text-center mt-6 text-sm font-medium">Već imate račun? <a href="/login" class="text-purple-400 underline">Prijavite se</a></p>
    </div>
</div>

<script>
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        console.log($("input[name='account_type']").val());

        const password = $('input[name="password"]').val();
        const repeatPassword = $('input[name="repeat_password"]').val();

        if (password !== repeatPassword) {
            alert('Passwords do not match!');
            return;
        }

        const formData = new FormData(this);

        // for(var pair of formData.entries()) {
        //     console.log(pair[0]+ ', '+ pair[1]);
        // }
        // return;

        $.ajax({
            type: 'POST',
            url: '/register',
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