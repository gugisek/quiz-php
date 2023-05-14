<?php
if(isset($_GET['tytul']) && isset($_GET['opis']) && isset($_GET['kategoria']) && isset($_GET['czas'])) {
    $tytul = $_GET['tytul'];
    $opis = $_GET['opis'];
    $kategoria = $_GET['kategoria'];
    $czas = $_GET['czas'];
    if($tytul == '') {
        echo "
        <script>
            document.getElementById('tytul').style.borderBottom = '1px solid red';
            document.getElementById('tytul').placeholder = 'Wpisz tytuł';
        </script>
        ";
    }
    if($opis == '') {
        echo "
        <script>
            document.getElementById('opis').style.borderBottom = '1px solid red';
            document.getElementById('opis').placeholder = 'Wpisz opis';
        </script>
        ";
    }
    if($kategoria == '') {
        echo "
        <script>
            document.getElementById('kategoria').style.borderBottom = '1px solid red';
            document.getElementById('kategoria').placeholder = 'Wpisz kategorie';
        </script>
        ";
    }
    if($czas == '') {
        echo "
        <script>
            document.getElementById('czas').style.borderBottom = '1px solid red';
            document.getElementById('czas').placeholder = 'Wpisz czas';
        </script>
        ";
    }
    
    if($tytul != '' && $opis != '' && $kategoria != '' && $czas != '') {
        $conn = mysqli_connect('localhost', 'root', '','quiz');
        $sql2 = "SELECT * FROM testy WHERE Nazwa='$tytul'";
        
        if ($result = mysqli_query($conn, $sql2)) {
            $rowcount = mysqli_num_rows($result);
            if($rowcount == 0) {
                $sql = "INSERT INTO testy (ID_Testu, Nazwa, opis, kategoria, Czas_trwania_w_min) VALUES ('NULL', '$tytul', '$opis', '$kategoria', '$czas')";
                mysqli_query($conn, $sql);
                $dodano = true;
            }
        }
        
    }
}
echo '
<section class="text-gray-600 body-font">
    <form method="GET" action="admin.php?action=quiz class="container px-5 py-2 mx-auto">
    <input name="action" id="action" value="quiz" type="text" class="hidden">
        <div class="flex flex-col text-center w-full mb-12">
        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Dodaj nowy QUIZ</h1>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Whatever cardigan tote bag tumblr hexagon brooklyn asymmetrical gentrify, subway tile poke farm-to-table. Franzen you probably havent heard of them man bun deep.</p>
        </div>
        <div class="sm:px-5 flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end">
            <div class="relative flex-grow w-full">
                <label for="tytul" class="leading-7 text-sm text-gray-600">Tytuł</label>
                <input type="text" id="tytul" name="tytul" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <div class="relative flex-grow w-full">
                <label for="opis" class="leading-7 text-sm text-gray-600">Opis</label>
                <input type="text" id="opis" name="opis" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <div class="relative flex-grow w-full">
                <label for="kategoria" class="leading-7 text-sm text-gray-600">Kategoria</label>
                <input type="text" id="kategoria" name="kategoria" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <div class="relative flex-grow w-full">
                <label for="czas" class="leading-7 text-sm text-gray-600">Czas</label>
                <input type="text" id="czas" name="czas" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Dodaj</button>
        </div>
    </form>
    <div class="container sm:px-5 py-10 mx-auto font-light w-full">
        <table class="flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end font-light">
        <tr class="border-b-[1px] w-full">
            <th class="font-normal w-[5%]">ID</th>
            <th class="font-normal w-[25%]">Tytul</th>
            <th class="font-normal w-[40%] sm:table-cell hidden ">Opis</th>
            <th class="font-normal w-[15%] text-indigo-500 py-2">Kategoria</th>
            <th class="font-normal w-[10%]">Czas</th>
            <th class="font-normal w-[10%] sm:table-cell hidden"></th>
        </tr>
        
    ';

$sql = "SELECT * FROM testy";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    $str = $row['opis'];
    if (strlen($str) > 90){
        $str = substr($str, 0, 83) . '...';
    }
    echo '
        <tr class="border-b-[1px] ">
            <td class="text-center">'.$row['ID_Testu'].'</td>
            <td class="sm:text-left text-center">'.$row['Nazwa'].'</td>
            <td class="sm:table-cell hidden py-2"> '.$str.'</td>
            <td class="text-center py-2 text-indigo-500">'.$row['kategoria'].'</td>
            <td class="text-center">'.$row['Czas_trwania_w_min'].' min</td>
            <td class="sm:table-cell hidden"><a class="flex flex-row items-center hover:text-indigo-500 transition-all duration-300" href="index.php?action=pytanie&id='.$row['ID_Testu'].'">Pytania<svg class="sm:table-cell hidden w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14"></path>
            <path d="M12 5l7 7-7 7"></path>
          </svg></a></td>
        </tr>
    ';
}
echo '</table><a href="admin.php?action=" class="rounded-full bg-[#3d3d3d] text-center py-3 px-8 text-white hover:bg-[#fdfdfd] hover:text-[#3d3d3d] hover:shadow-xl transition-all duration-300">Powrót do panelu</a></div>

</section>
';

    if($dodano == true){
        
            echo "
            <script>
                document.getElementById('tytul').style.borderBottom = '1px solid green';
                document.getElementById('tytul').placeholder = 'Dodano!';
                document.getElementById('opis').style.borderBottom = '1px solid green';
                document.getElementById('opis').placeholder = 'Dodano!';
                document.getElementById('kategoria').style.borderBottom = '1px solid green';
                document.getElementById('kategoria').placeholder = 'Dodano!';
                document.getElementById('czas').style.borderBottom = '1px solid green';
                document.getElementById('czas').placeholder = 'Dodano!';
            </script>
            ";
        
    }
    if($dodano == false && isset($_GET['tytul']) && isset($_GET['opis']) && isset($_GET['kategoria']) && isset($_GET['czas'])){
        echo "
        <script>
            document.getElementById('tytul').style.borderBottom = '1px solid orange';
            document.getElementById('tytul').placeholder = 'Istnieje już taki Quiz';
            document.getElementById('opis').style.borderBottom = '1px solid orange';
            document.getElementById('opis').placeholder = 'Istnieje już taki Quiz';
            document.getElementById('kategoria').style.borderBottom = '1px solid orange';
            document.getElementById('kategoria').placeholder = 'Istnieje już taki Quiz';
            document.getElementById('czas').style.borderBottom = '1px solid orange';
            document.getElementById('czas').placeholder = 'Istnieje już taki Quiz';
        </script>
        ";
    }
if(isset($_GET['tytul']) && isset($_GET['opis']) && isset($_GET['kategoria']) && isset($_GET['czas'])) {
    $tytul = $_GET['tytul'];
    $opis = $_GET['opis'];
    $kategoria = $_GET['kategoria'];
    $czas = $_GET['czas'];
    if($tytul == '') {
        echo "
        <script>
            document.getElementById('tytul').style.borderBottom = '1px solid red';
            document.getElementById('tytul').placeholder = 'Wpisz tytuł';
        </script>
        ";
    }
    if($opis == '') {
        echo "
        <script>
            document.getElementById('opis').style.borderBottom = '1px solid red';
            document.getElementById('opis').placeholder = 'Wpisz opis';
        </script>
        ";
    }
    if($kategoria == '') {
        echo "
        <script>
            document.getElementById('kategoria').style.borderBottom = '1px solid red';
            document.getElementById('kategoria').placeholder = 'Wpisz kategorie';
        </script>
        ";
    }
    if($czas == '') {
        echo "
        <script>
            document.getElementById('czas').style.borderBottom = '1px solid red';
            document.getElementById('czas').placeholder = 'Wpisz czas';
        </script>
        ";
    }
}

?>