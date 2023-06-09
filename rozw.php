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
<body class="min-h-screen flex justify-between flex-col">
    <?php include 'components/nav.php'; ?>
    <?php
    $_SESSION['sesja_wynik'] = 0;
    $quiz = $_GET['quiz'];
    $conn = mysqli_connect('localhost', 'root', '', 'quiz');
    $query = "SELECT * FROM `testy` WHERE `ID_Testu` = '$quiz'";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)) {
        $nazwa = $row['Nazwa'];
        $opis = $row['opis'];
        $kategoria = $row['kategoria'];
    }

    $query = "SELECT count(ID_Pyt) FROM `pytania` WHERE `ID_Testu` = '$quiz'";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)) {
        $ilosc = $row['count(ID_Pyt)'];
        $_SESSION['ilosc'] = $ilosc;
    }
    $aktualne_pyt = $_GET['p'];
    ?>
<section class="text-gray-600 body-font">
  <div class="container px-5 py-2 mx-auto">
    <div class="flex flex-col text-center w-full mb-10">
      <h2 class="text-xs text-indigo-500 tracking-widest font-medium title-font uppercase"><?=$kategoria?> - <?=$nazwa?> - <?=$aktualne_pyt?>/<?=$ilosc?></h2>
      
    </div>
    <h1 class="text-gray-900 font-black text-center text-4xl mb-5">
        <?php
        $ak_pyt2 = $aktualne_pyt-1;
        $nast_pyt = $aktualne_pyt+1;
        $query = "SELECT * FROM `pytania` WHERE `ID_Testu` = '$quiz' LIMIT 1 OFFSET $ak_pyt2";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result)) {
            echo $row['tresc'];
            $aktualne_pyt_data = $row['ID_Pyt'];
        }
    ?>
    </h1>
    <form action="?quiz=<?=$quiz?>&p=<?=$nast_pyt?>" method="POST">
    <div class="flex flex-wrap items-center py-10">
      <?php 
      $query = "SELECT * FROM `odpowiedzi` WHERE `ID_Pyt` = '$aktualne_pyt_data'";
        $result = mysqli_query($conn, $query);
        $a = 1;
        while($row = mysqli_fetch_assoc($result)) {
            $tresc = $row['Tresc'];
            $id_odp = $row['ID_odp'];
            $poprawna = $row['Poprawna'];
            echo '
            <div class="xl:w-1/4 lg:w-1/2 md:w-full px-8 py-6 border-l-2 border-gray-200 border-opacity-60">
                <h2 class="text-lg sm:text-xl text-gray-900 font-medium title-font mb-2">' . $tresc . '</h2>
                <input type="radio" value="' . $id_odp . '" required name="odp-' . $aktualne_pyt . '" id="odp-' . $id_odp . '" class="hidden"></input>
                    <label for="odp-' . $id_odp . '" class="text-indigo-500 hover:text-indigo-800 hover:cursor-pointer transition-all duration-300 inline-flex items-center">Wybieram
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                    </label>
                
            </div>
            ';
            $a++;
        }
      ?>
      
      
    </div>
    <button type="submit" class="w-auto flex mx-auto mt-5 rounded-full bg-[#3d3d3d] py-3 px-8 text-white hover:bg-[#fdfdfd] hover:text-[#3d3d3d] hover:shadow-xl transition-all duration-300">
    <?php 
        if($aktualne_pyt == $ilosc) {
            echo "Zakończ quiz";
        } else {
            echo "Następne pytanie";
        }
        if ($aktualne_pyt > $ilosc) {
        header("Location: wynik.php?quiz=$quiz");
    }
    
    ?>
    </button>
    <?php
    
    if ($aktualne_pyt<=1) {

    }else{
        $_SESSION['odp-' . $aktualne_pyt-1] = $_POST['odp-' . $aktualne_pyt-1];
    }
    ?>
    </form>
  </div>
</section>
<?php include 'components/footer.php'; ?>
</body>
</html>

