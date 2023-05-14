<?php 
    session_start();
    if(!isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] !== true) {
        header("Location: login.php");
        exit;
    }
    
?>
<!DOCTYPE html>
<html lang="pl">
<?php include 'components/head.php'; ?>
<body>
    <?php include 'components/nav.php'; ?>
    
    <section class="text-gray-600 body-font">
        <h1 class="text-center text-4xl font-black pt-5 pb-7">
        <?php
        $quiz = $_GET['quiz'];
        $ilosc = $_SESSION['ilosc'];
        $query = "SELECT * FROM `testy` WHERE `ID_Testu` = '$quiz'";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result)) {
            $nazwa = $row['Nazwa'];
        }
        echo $nazwa;
        echo ' - Podsumowanie'
        ?>
        </h1>
       
        <div class="container px-5 py-5 mx-auto">
            <div class="flex justify-between items-center lg:w-3/5 mx-auto border-b pb-1 mb-10 border-gray-200 sm:flex-row flex-col">
                <?php
                
                        $a = 1;
                        $suma = 0;
                        while ($a <= $ilosc) {
                            $_SESSION['count_' . $a] = $_SESSION['odp-' . $a];
                            $c = $_SESSION['count_' . $a];
                            $query = "SELECT Poprawna FROM `Odpowiedzi` WHERE `ID_odp` = '$c'";
                            $result = mysqli_query($conn, $query);

                            while($row = mysqli_fetch_assoc($result)) {
                                $poprawna = $row['Poprawna'];
                                if($poprawna == 1){
                                $suma++;
                                }
                            }
                            $a++;
                        }
                        $procent_wynik = $suma/$ilosc*100;
                        echo '<p class="">Twój wynik: ' . $procent_wynik . '%</p>';
                        echo '<div class="flex gap-3">';
                        echo '<p class="text-green-400">Poprawne: ' . $suma . '</p>';
                        echo '<p class="text-red-400">Niepoprawne: ' . $ilosc-$suma . '</p>';
                        echo '</div>';
                        
                        $sesja_login = $_SESSION['uzytkownik'];
                        $query = "SELECT ID FROM login WHERE Login = '$sesja_login'";
                        $result = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_assoc($result)) {
                                $id_login = $row['ID'];
                        }
                        
                        $query = "INSERT INTO `rozwiazania` (`id`, `id_testu`, `id_login`, `wynik`) VALUES (NULL, '$quiz', '$id_login', '$procent_wynik')";
                        if ($_SESSION['sesja_wynik'] == 0){
                            $result = mysqli_query($conn, $query);
                        }
                        $_SESSION['sesja_wynik'] = 1;
                ?>
            </div>
            <?php
                $query = "SELECT * FROM `pytania` WHERE `ID_Testu` = '$quiz'";
                $result = mysqli_query($conn, $query);
                $a = 1;
                while($row = mysqli_fetch_assoc($result)) {
                    $pyt = $row['tresc'];
                    echo '
                    <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
                        <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                            <h2 class="text-gray-900 text-lg title-font font-medium mb-2">' . $pyt . '</h2>
                            <p class="leading-relaxed text-base">';
                            $id_odp = $_SESSION['odp-' . $a];
                            $query2 = "SELECT * FROM `odpowiedzi` WHERE `ID_odp` = '$id_odp'";
                            $result2 = mysqli_query($conn, $query2);
                            while($row2 = mysqli_fetch_assoc($result2)) {
                                $odp = $row2['Tresc'];
                                echo '<p class="text-gray-400">Twoja odpowiedź: </p>';
                                if($row2['Poprawna'] == 1){
                                    echo '<p class="text-green-400">' . $odp . ' - poprawna</p>';
                                } else {
                                    echo '<p class="text-red-400">' . $odp . ' - błędna</p>';
                                }
                                
                            }
                    echo'
                            </p>
                        </div>
                    </div>
                    ';
                    $a++;
                }
            echo '              
                <div class="flex items-center justify-center">
                    <a href="rozw.php?quiz=' . $quiz . '&p=1" class="rounded-full bg-[#3d3d3d] py-3 px-8 text-white hover:bg-[#fdfdfd] hover:text-[#3d3d3d] hover:shadow-xl transition-all duration-300">Spróbuj ponownie</a>
                    </div>
            </div>
            ';
            ?>
    </section>
    <section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="text-center mb-20">
      <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900 mb-4">Konkuruj z innymi użytkownikami!</h1>
      <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto text-gray-500s">Determinacja i motywacja pomoże Ci osiągnąć Twój cel, teraz sprawdź jak Ci idzie w porównaniu do innych.</p>
      <div class="flex mt-6 justify-center">
        <div class="w-16 h-1 rounded-full bg-indigo-500 inline-flex"></div>
      </div>
    </div>
    <div class="flex flex-wrap items-center justify-center sm:-m-4 -mx-4 -mb-10 -mt-4 md:space-y-0 space-y-6">
      <div class="p-4 md:w-1/3 flex flex-col text-center items-center">
        <div class="w-20 h-20 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5 flex-shrink-0">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
          </svg>
        </div>
        <div class="flex-grow">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Twoje wzloty i upadki</h2>
          <p class="leading-relaxed text-base">
            <?php
                $sesja_login = $_SESSION['uzytkownik'];
                $query = "SELECT ID FROM login WHERE Login = '$sesja_login'";
                $result = mysqli_query($conn, $query);
    
                while($row = mysqli_fetch_assoc($result)) {
                        $id_login = $row['ID'];
                }
                $query = "SELECT * FROM `rozwiazania` WHERE `id_login` = '$id_login' and id_testu = '$quiz'";
                $result = mysqli_query($conn, $query);
                $ilosc = 0;
                $suma = 0;
                while($row = mysqli_fetch_assoc($result)) {
                    $ilosc++;
                    $suma += $row['wynik'];
                }
                if($ilosc == 1){
                    echo 'To Twój pierwszy raz, nie poddawaj się!';
                } else {
                    echo 'Twój średni wynik z tego quizu: ' . round($suma/$ilosc, 2) . '%';
                }
            ?>
          </p>
          <a class="mt-3 text-indigo-500 hover:text-indigo-800 transition-all duration-300 inline-flex items-center" href="quiz.php?">Rozwiąż następny quiz
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
              <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>
      <div class="p-4 md:w-1/3 flex flex-col text-center items-center">
      <div class="w-20 h-20 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-5 flex-shrink-0">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10" viewBox="0 0 24 24">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
        </div>
        
        <div class="flex-grow">
          <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Lepszy od innych?</h2>
          <p class="leading-relaxed text-base">
            <?php
            
            $sql = "SELECT COUNT(*) FROM `rozwiazania` WHERE `wynik` <= $procent_wynik and `id_testu` = $quiz";
            $sql = "SELECT id FROM `rozwiazania` WHERE `wynik` <= $procent_wynik and `id_testu` = $quiz group by id_login";
            $result = mysqli_query($conn, $sql);
            $sum_users = 0;
            while ($row = mysqli_fetch_row($result))
            {
                $sum_users++;
            }
            if ($sum_users == 1) {
                echo "Nikt nie jest lepszy od Ciebie!";
            } else {
                $sum_users = $sum_users - 1;
                echo 'Jesteś lepszy niż ' . $sum_users;
                if ($sum_users == 1) {
                    echo ' użytkownik, który rozwiązał ten quiz!';
                } else {
                    echo ' użytkowników, którzy rozwiązali ten quiz!';
                }
            }
            
            ?>
             </p>
          <a class="mt-3 text-indigo-500 hover:text-indigo-800 transition-all duration-300 inline-flex items-center" href="ranking.php?quiz=<?=$quiz?>">Zobacz ranking
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
              <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include 'components/footer.php'; ?>
</body>
</html>

