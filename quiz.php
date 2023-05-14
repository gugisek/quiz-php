<?php 
    session_start();
    if(!isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] !== true) {
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pl">
<?php include 'head.php'; ?>
<body class="min-h-screen">
    <?php include 'nav.php'; ?>
    <section class="text-gray-600 body-font">
  <div class="container px-5 py-14 mx-auto">
    <div class="text-center mb-20">
      <h1 class="sm:text-3xl text-2xl font-black text-gray-700 text-center title-font mb-4">Dostępne quizy!</h1>
      <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto">Poniżej znajdziesz nasze najlepsze najwspanialsze quizy, które pomogą Ci rozwinąc swoją wiedzę i umiejętności w wybranych dziedzinach.</p>
    </div>
    
  </div>
</section>
    <section class="text-gray-600 body-font mb-24">
  <div class="container px-5 py-2 mx-auto">
    <div class="flex flex-wrap -m-4 justify-center">
      <?php
            $conn = mysqli_connect('localhost', 'root', '', 'quiz');
            $query = "SELECT * FROM testy";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
                echo '
                <a class="p-4 lg:w-1/3 hover:scale-105 transition-all duration-300" href="rozw.php?quiz=' . $row['ID_Testu'] . '&p=1">
                       
                            <div class="h-full hover:bg-indigo-100 bg-gray-100 transition-all duration-300 bg-opacity-75 px-8 pt-16 pb-24 rounded-lg overflow-hidden text-center relative">
                            <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1 uppercase">' . $row['kategoria'] . '</h2>
                            <h1 class="title-font sm:text-2xl text-xl font-medium text-gray-900 mb-3">' . $row['Nazwa'] . '</h1>
                            <p class="leading-relaxed mb-3">' . $row['opis'] . '</p>
                            <span class="text-indigo-500 inline-flex items-center hover:text-indigo-800 transition-all duration-300" href="rozw.php?quiz=' . $row['ID_Testu'] . '&p=1">Zacznij quiz
                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5l7 7-7 7"></path>
                                </svg>
                            </span>
                            
                            <div class="text-center mt-2 leading-none flex justify-center absolute bottom-0 left-0 w-full py-4">
                                <span class="text-gray-400 mr-3 inline-flex items-center leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                                <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                ';
                                $conn = mysqli_connect('localhost', 'root', '', 'quiz');
                                $nazwa = $row['Nazwa'];
                                $query2 = "SELECT COUNT(rozwiazania.id) FROM `rozwiazania` join testy on rozwiazania.id_testu = testy.ID_Testu where nazwa='$nazwa';";
                                $result2 = mysqli_query($conn, $query2);
                                while($row2 = mysqli_fetch_assoc($result2)) {
                                    echo $row2['COUNT(rozwiazania.id)'];
                                } 
                                echo '
                                </span>
                                <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                                <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                </svg>' . $row['Czas_trwania_w_min'] . ' min
                                </span>
                            </div>
                            
                            </div>
                            
                    </a>
                ';
            }
            ?>
    </div>
  </div>
</section>
    <?php include 'footer.php'; ?>
</body>
</html>

