<style>
    body {
      padding-top: 4rem;
      /* Kompenzacija za fiksirani header */
    }

    .sticky-nav {
      position: fixed;
      top: 0;
      z-index: 1000;
      width: 100%;
    }

    .dark {
      --tw-bg-opacity: 1;
      background-color: rgba(36, 37, 38, var(--tw-bg-opacity));
      color: white;
    }
  </style>

<header class="bg-white sticky-nav">
    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="<?php echo BASE_PATH ?>/home" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="<?php echo BASE_PATH ?>/public/assets/logo_spcp.png" class="h-8" alt="Logo" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">CodeSensei</span>
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
          <?php if (isset($_SESSION['user_id'])): ?>
            <a class="block rounded-md px-5 py-2 text-sm font-medium text-white bg-blue-800 hover:bg-blue-900 transition" href="<?php echo BASE_PATH ?>/profile">Profil</a>
          <?php else: ?>
            <a class="block rounded-md bg-blue-800 px-5 py-2 text-sm font-medium text-white transition hover:bg-blue-900" href="<?php echo BASE_PATH ?>/login">Prijava</a>
            <a class="hidden rounded-md bg-blue-100 px-5 py-2 text-sm font-medium text-blue-800 transition hover:text-blue-800/75 sm:block" href="<?php echo BASE_PATH ?>/register">Registracija</a>
          <?php endif; ?>
          <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
            </svg>
          </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-default">
          <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            <li>
              <a href="<?php echo BASE_PATH ?>/home" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Početna</a>
            </li>
            <li>
              <a href="<?php echo BASE_PATH ?>/spcp" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Lekcije</a>
            </li>
            <!--<li>
              <a href="<?php echo BASE_PATH ?>/spcp" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Teorijski</a>
            </li>
            <li>
              <a href="<?php echo BASE_PATH ?>/spcp" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Zadaci</a>
            </li>-->
          </ul>
        </div>
      </div>
    </nav>

  </header>

<main id="main" class="">
    <!-- Hero Section -->
    <section class="bg-blue-800 text-white py-20 text-center">
        <div class="container mx-auto px-6">
            <h1 class="text-5xl font-extrabold">Nauči programirati u C++</h1>
            <div class="mt-6">
                <p class="text-lg"><b>Dobrodošli na platformu za samostalno učenje!</b></p>
            </div>
            <a class="mt-6 inline-block px-6 py-3 bg-blue-500 rounded-lg hover:bg-blue-600 transition" href="<?php echo BASE_PATH ?>/spcp">Započni učenje</a>
        </div>
    </section>


    <!-- Features Section -->

    <section class="py-20 bg-blue-100 dark:bg-blue-700">
        <div class="container mx-auto text-center mb-10">
            <h1 class="text-4xl font-extrabold text-blue-900 dark:text-blue-200">Trenutno dostupne značajke</h1>
            <p class="text-lg mt-2 text-blue-800 dark:text-blue-300">Istražite što vam naša platforma nudi kako biste unaprijedili svoje programerske vještine.</p>
        </div>
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 px-6">
            <div class="p-6 bg-blue-200 dark:bg-blue-600 rounded-lg shadow-lg hover:shadow-xl transition">
                <h3 class="text-2xl font-bold text-blue-900 dark:text-blue-100">Lekcije</h3>
                <p class="mt-2 text-blue-800 dark:text-blue-300">Učite kroz jasno strukturirane lekcije s teorijskim objašnjenjima.</p>
            </div>
            <div class="p-6 bg-blue-200 dark:bg-blue-600 rounded-lg shadow-lg hover:shadow-xl transition">
                <h3 class="text-2xl font-bold text-blue-900 dark:text-blue-100">Zadaci</h3>
                <p class="mt-2 text-blue-800 dark:text-blue-300">Praktični zadaci koji testiraju i poboljšavaju vaše programerske vještine.</p>
            </div>
            <div class="p-6 bg-blue-200 dark:bg-blue-600 rounded-lg shadow-lg hover:shadow-xl transition">
                <h3 class="text-2xl font-bold text-blue-900 dark:text-blue-100">Rješenja</h3>
                <p class="mt-2 text-blue-800 dark:text-blue-300">Dostupna rješenja za sve zadatke s mogućnošću slanja boljih prijedloga.</p>
            </div>
        </div>
    </section>


    <!-- Call to Action -->
    <section class="bg-blue-500 text-white py-16 text-center p-5">
        <h2 class="text-4xl font-bold">Vaša podrška je važna!</h2>
        <p class="mt-4">Naš cilj je da sustav ostane besplatan za sve korisnike, no to ograničava naše resurse. Molimo vas da ne zloupotrebljavate sustav kako bismo mogli podržati što više korisnika.</p>
        <p class="mt-4">Spreman za početak? Registriraj se i postani dio codesensei zajednice već danas!</p>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="<?php echo BASE_PATH ?>/spcp" class="mt-6 inline-block px-6 py-3 bg-white text-blue-500 rounded-lg hover:bg-gray-100 transition">Započni sa rješavanjem</a>
        <?php else: ?>
            <a href="<?php echo BASE_PATH ?>/login" class="mt-6 inline-block px-6 py-3 bg-white text-blue-500 rounded-lg hover:bg-gray-100 transition">Registriraj se</a>
        <?php endif; ?>
    </section>

</main>
<!-- Footer Section -->
<footer class="bg-blue-900 text-white text-center p-6">
    <p>&copy; 2025 codesensei.eu | Sva prava pridržana | Hvala vam na sudjelovanju!</p>
</footer>

<script>
    function toggleMenu() {
      var menu = document.getElementById('menu');
      menu.classList.toggle('hidden');
    }
  </script>