<!DOCTYPE html>
<html lang="pl">
<?php include 'head.php'; ?>
<body class="min-h-screen flex flex-col items-center justify-between">
    <?php 
    session_start();
    include 'nav.php'; ?>
<section class="text-gray-600 body-font relative">
  <div class="container px-5 pt-24 pb-10 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Kontakt</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Jesteśmy tutaj dla Ciebie, chętnie dowiemy się Twoich opinii na nasz temat i naszego serwisu quizowego.</p>
    </div>
    <div class="lg:w-1/2 md:w-2/3 mx-auto">
      <div class="flex flex-wrap -m-2">
        <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
          <a class="text-indigo-500" href="https://ui.gugisek.pl/" target="_blank">ui.gugisek.pl</a>
          <p class="leading-normal my-5">gugisek@gmail.com
            <br>Warszawa, Poland
          </p>
          
        </div>
      </div>
    </div>
  </div>
</section>

<section id="o-nas" class="text-gray-600 body-font">
  <div class="container px-5 pb-24 mx-auto flex flex-col">
    <div class="lg:w-4/6 mx-auto">
      
      <div class="flex flex-col sm:flex-row mt-10">
        <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8">
          <div class="w-20 h-20 rounded-full inline-flex items-center justify-center bg-gray-200 text-gray-400">
            <img src="img/avatar.jpeg" alt="profile-img" class="rounded-full">
          </div>
          <div class="flex flex-col items-center text-center justify-center">
            <h2 class="font-medium title-font mt-2 text-gray-900 text-lg">Gustaw Sołdecki</h2>
            <div class="w-12 h-1 bg-indigo-500 rounded mt-2 mb-4"></div>
            <p class="text-base">Mam 18 lat, uczęszczam do czwartej klasy w zespole szkół nr 14 w Warszawie na kierunku informatyk.
         </div>
        </div>
        <div class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-gray-200 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
          <p class="leading-relaxed text-lg mb-4">
          Tworzenie strony internetowej z quizami w języku PHP było fascynujące i jednocześnie bardzo edukacyjne. Istnieje kilka powodów, dla których taki projekt dostarczył wiele satysfakcji i umożliwił zdobycie nowych umiejętności.
          <br/><br/>
          Po pierwsze, tworzenie takiej strony wymagało ode mnie nie tylko znajomości języka PHP, ale także wiedzy z zakresu HTML, CSS i JavaScript. Była to zatem doskonała okazja do ćwiczenia umiejętności programistycznych oraz pogłębiania swojej wiedzy na temat technologii webowych.
          <br/><br/>
          Po drugie, stworzenie strony z quizami pozwoliło na zastosowanie różnych technik programowania, takich jak manipulowanie danymi, operowanie na tablicach, czy tworzenie zapytań do bazy danych. Wszystkie te umiejętności mogą być przydatne w innych projektach programistycznych.
         </p>
          
        </div>
      </div>
    </div>
</div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>