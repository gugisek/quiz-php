<header class="text-gray-600 py-2 body-font w-full">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a href="index.php" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
      <img src="img/icon.png" alt="logo" class="w-[50px]">
      <span class="ml-3 text-xl">QuizPHP</span>
    </a>
    <nav class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400	flex flex-wrap items-center text-base justify-center">
      <a class="mr-5 hover:text-indigo-500 hover:scale-105 transition-all duration-300" href="quiz.php?">Quizy</a>
      <a class="mr-5 hover:text-indigo-500 hover:scale-105 transition-all duration-300" href="ranking.php">Ranking</a>
      <a class="mr-5 hover:text-indigo-500 hover:scale-105 transition-all duration-300" href="">O nas</a>
    </nav>
    <?php
                    
                    if(empty($_SESSION['uzytkownik'])) {
                        echo '
                        <a href="login.php" class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Zaloguj się
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </a>';
                    } else
                    {
                        echo '<a href="logout.php" class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Wyloguj się ';
                        $conn = mysqli_connect('localhost', 'root', '', 'quiz');
                        $sesja_login = $_SESSION['uzytkownik'];
                        $query = "SELECT Imie FROM login WHERE Login = '$sesja_login'";
                        $result = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_assoc($result)) {
                                $imie = $row['Imie'];
                                echo $imie;
                        }
                        echo '
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </a>';
                    }
    
                    
                ?>
  </div>
</header>