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
<body class="min-h-screen flex justify-between flex-col">
    <?php include 'nav.php'; ?>
    <?php
    $quiz = $_GET['quiz'];
    $conn = mysqli_connect('localhost', 'root', '', 'quiz');
    $query = "SELECT * FROM `testy` WHERE `ID_Testu` = '$quiz'";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)) {
        $nazwa = $row['Nazwa'];
        $opis = $row['opis'];
        $kategoria = $row['kategoria'];
    }
    ?>
    <section class="text-gray-600 body-font sm:mt-[-100px]">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
      <h2 class="text-xs text-indigo-500 tracking-widest font-medium title-font mb-1"><?=$nazwa?></h2>
      <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">Ranking naszych użytkowników</h1>
    </div>
    <div class="flex flex-wrap -m-4">
      <div class="p-4 md:w-1/3">
        <div class="flex rounded-lg h-full bg-gray-100 p-8 flex-col">
          <div class="flex items-center mb-3">
            <div class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full bg-indigo-500 text-white flex-shrink-0">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
              </svg>
            </div>
            <h2 class="text-gray-900 text-lg title-font font-medium">Najlepsze wyniki - <?=$nazwa?></h2>
          </div>
          <div class="flex-grow">
          <?php
            $sql = "SELECT MAX(wynik), login.Imie FROM `rozwiazania` join login on login.ID = rozwiazania.id_login group by Imie order by MAX(wynik) desc limit 6;";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                echo '
                <div class="flex flex-row justify-between leading-relaxed text-base py-2">
                  <div class="flex flex-row gap-1 items-center justify-center">
                  ' . $row['Imie'] . '
                  </div>
                  <div>
                  ' . $row['MAX(wynik)'] . '%
                  </div>
                </div>
                <hr>
                ';
            }
            ?>
          </div>
        </div>
      </div>
      <div class="p-4 md:w-1/3">
        <div class="flex rounded-lg h-full bg-gray-100 p-8 flex-col">
          <div class="flex items-center mb-3">
            <div class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full bg-indigo-500 text-white flex-shrink-0">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </div>
            <h2 class="text-gray-900 text-lg title-font font-medium">Najwięcej rozwiązań - <?=$nazwa?></h2>
          </div>
          <div class="flex-grow">
          <?php
            $conn = mysqli_connect('localhost', 'root', '', 'quiz');
            $sql = "SELECT count(*), login.Imie FROM `rozwiazania` join login on rozwiazania.id_login=login.ID where id_testu = $quiz group by id_login order by count(*) desc limit 6;";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                echo '
                <div class="flex flex-row justify-between leading-relaxed text-base py-2">
                  <div class="flex flex-row gap-1 items-center justify-center">
                  ' . $row['Imie'] . '
                  </div>
                  <div>
                  ' . $row['count(*)'] . '
                  </div>
                </div>
                <hr>
                ';
            }
            ?>
          </div>
        </div>
      </div>
      <div class="p-4 md:w-1/3">
        <div class="flex rounded-lg h-full bg-gray-100 p-8 flex-col">
          <div class="flex items-center mb-3">
            <div class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full bg-indigo-500 text-white flex-shrink-0">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <circle cx="6" cy="6" r="3"></circle>
                <circle cx="6" cy="18" r="3"></circle>
                <path d="M20 4L8.12 15.88M14.47 14.48L20 20M8.12 8.12L12 12"></path>
              </svg>
            </div>
            <h2 class="text-gray-900 text-lg title-font font-medium">Średnie wyniki - <?=$nazwa?></h2>
          </div>
          <div class="flex-grow">
            <?php
                $sql = "SELECT round(AVG(wynik), 0) as wynik, login.Imie FROM `rozwiazania` join login on login.ID = rozwiazania.id_login group by Imie order by AVG(wynik) desc limit 6;";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <div class="flex flex-row justify-between leading-relaxed text-base py-2">
                    <div class="flex flex-row gap-1 items-center justify-center">
                    ' . $row['Imie'] . '
                    </div>
                    <div>
                    ' . $row['wynik'] . '%
                    </div>
                    </div>
                    <hr>
                    ';
                }
                ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include('footer.php'); ?>
</body>
</html>

