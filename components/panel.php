<?php
echo '
<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap w-full mb-20 flex-col items-center text-center">
        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Panel administracyjny</h1>
        <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">Możesz tutaj dodać testy, pytania i odpowiedzi. Rówież masz dostęp do zarządzania użytkownikami.</p>
        </div>
        <div class="flex flex-wrap -m-4">
        <a href="admin.php?action=quiz" class="xl:w-1/3 md:w-1/2 p-4 hover:scale-105 transition-all duration-300">
            <div class="border border-gray-200 p-6 rounded-lg">
            <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
            </div>
            <h2 class="text-lg text-gray-900 font-medium title-font mb-2">Dodaj QUIZ</h2>
            <p class="leading-relaxed text-base">Tutaj dodasz nowy quiz, bez pytań i odpowiedzi. Dodasz je później.</p>
            </div>
        </a>
        <a href="admin.php?action=pytanie" class="xl:w-1/3 md:w-1/2 p-4 hover:scale-105 transition-all duration-300">
            <div class="border border-gray-200 p-6 rounded-lg">
            <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1zM4 22v-7"></path>
                </svg>
            </div>
            <h2 class="text-lg text-gray-900 font-medium title-font mb-2">Dodaj pytanie</h2>
            <p class="leading-relaxed text-base">Dodajesz tutaj pytanie do istniejącego już testu! Odpowiedzi później dodasz.</p>
            </div>
        </a>
        <a href="admin.php?action=odp" class="xl:w-1/3 md:w-1/2 p-4 hover:scale-105 transition-all duration-300">
            <div class="border border-gray-200 p-6 rounded-lg">
            <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-6 h-6" viewBox="0 0 24 24">
                <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                </svg>
            </div>
            <h2 class="text-lg text-gray-900 font-medium title-font mb-2">Dodaj odpowiedź</h2>
            <p class="leading-relaxed text-base">Odpowiedź dodana zostanie w tym miejscu jak klikniesz.</p>
            </div>
        </a>
        </div>
    </div>
</section>
';
?>