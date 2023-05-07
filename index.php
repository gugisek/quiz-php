<!DOCTYPE html>
<html lang="pl">
<?php include 'head.php'; ?>
<body class="min-h-screen flex flex-col items-center justify-start">
    <?php 
    session_start();
    include 'nav.php'; ?>
    <section class="text-gray-600 body-font">
  <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col-reverse items-center">
    <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
      <h1 class="title-font sm:text-5xl text-3xl mb-4 font-black text-gray-900">Najlepsze quizy
        <br class="hidden lg:inline-block">na silniku PHP
      </h1>
      <p class="mb-8 leading-relaxed">Przedstawiamy rewolucyjną aplikację internetową zaprojektowaną, aby móc rozwiązywać quizy. Użyta została nowoczesna technologia php. Znajdziesz tu wiele quizów na różne tematy. Pomoże Ci to rozwinąć się bo tak mówią badania przeprowadzone w czwartek i udowadianiąją skuteczność quizów php!</p>
      <div class="flex justify-center">
        <form action="quiz.php">
            <button type="submit" class="rounded-full bg-[#3d3d3d] py-3 px-8 text-white hover:bg-[#fdfdfd] hover:text-[#3d3d3d] hover:shadow-xl transition-all duration-300">Rozwiąż Quiz</button>
        </form>
      </div>
    </div>
    <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
      <img class="object-cover object-center rounded" alt="hero" src="img/img.png">
    </div>
  </div>
</section>
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
      <h1 class="sm:text-3xl text-2xl font-black title-font mb-4 text-gray-700">Nasze community</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Pamiętasz papier toaletowy jak ostatnio w łazience byłeś? To właśnie tak jest rozwinięte nasze community, które łączy najlepszych rozwiązywaczy quizów. Chcesz być jednym z nim? To nie dobrze. Poniżej znajdziesz wspaniałe statystyki przedstawiające naszą społeczność.</p>
    </div>
    <div class="flex flex-wrap -m-4 text-center">
      <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
        <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
            <path d="M8 17l4 4 4-4m-4-5v9"></path>
            <path d="M20.88 18.09A5 5 0 0018 9h-1.26A8 8 0 103 16.29"></path>
          </svg>
          <h2 class="title-font font-medium text-3xl text-gray-900">
            <?php
            $conn = mysqli_connect('localhost', 'root', '', 'quiz');
            $query = "SELECT count(*) from rozwiazania;";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
                echo $row['count(*)'];
            }
            ?>
          </h2>
          <p class="leading-relaxed">Rozwiązanych quizów</p>
        </div>
      </div>
      <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
        <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 00-3-3.87m-4-12a4 4 0 010 7.75"></path>
          </svg>
          <h2 class="title-font font-medium text-3xl text-gray-900">
            <?php
            $conn = mysqli_connect('localhost', 'root', '', 'quiz');
            $query = "SELECT count(*) from login;";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
                echo $row['count(*)'];
            }
            ?>
          </h2>
          <p class="leading-relaxed">Użytkownicy</p>
        </div>
      </div>
      <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
        <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
            <path d="M3 18v-6a9 9 0 0118 0v6"></path>
            <path d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z"></path>
          </svg>
          <h2 class="title-font font-medium text-3xl text-gray-900">
            <?php
            $conn = mysqli_connect('localhost', 'root', '', 'quiz');
            $query = "SELECT count(*) from testy;";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
                echo $row['count(*)'];
            }
            ?>
          </h2>
          <p class="leading-relaxed">Dostępnych quizów</p>
        </div>
      </div>
      <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
        <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="text-indigo-500 w-12 h-12 mb-3 inline-block" viewBox="0 0 24 24">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
          </svg>
          <h2 class="title-font font-medium text-3xl text-gray-900">
            <?php
            $conn = mysqli_connect('localhost', 'root', '', 'quiz');
            $query = "SELECT count(*) from pytania;";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
                echo $row['count(*)'];
            }
            ?>
          </h2>
          <p class="leading-relaxed">Unikalnych pytań</p>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include 'footer.php'; ?>
</body>
</html>