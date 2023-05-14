<?php
 if(isset($_GET['id_quiz']) && isset($_GET['tresc'])) {
    $id_quiz = $_GET['id_quiz'];
    $tresc = $_GET['tresc'];
    if($id_quiz == '') {
        echo "
        <script>
            document.getElementById('id_quiz').style.borderBottom = '1px solid red';
            document.getElementById('id_quiz').placeholder = 'Wpisz id quizu';
        </script>
        ";
    }
    if($tresc == '') {
        echo "
        <script>
            document.getElementById('tresc').style.borderBottom = '1px solid red';
            document.getElementById('tresc').placeholder = 'Wpisz treść pytania';
        </script>
        ";
    }
    
    if($id_quiz != '' && $tresc != '') {
        $conn = mysqli_connect('localhost', 'root', '','quiz');
        $sql2 = "SELECT * FROM pytania WHERE tresc='$tresc'";
        
        if ($result = mysqli_query($conn, $sql2)) {
            $rowcount = mysqli_num_rows($result);
            if($rowcount == 0) {
                $sql = "INSERT INTO pytania (ID_Pyt, ID_testu, tresc) VALUES ('NULL', '$id_quiz', '$tresc')";
                mysqli_query($conn, $sql);
                $dodano = true;
            }
        }
        
    }
}
echo '
<section class="text-gray-600 body-font">
    <form method="GET" action="admin.php?action=pytanie class="container px-5 py-2 mx-auto">
    <input name="action" id="action" value="pytanie" type="text" class="hidden">
        <div class="flex flex-col text-center w-full mb-12">
        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Dodaj pytanie</h1>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Tutaj dodajesz pytanie do instniejęcego quizu, potem dodasz do tych pytań odpowiedzi.</p>
        </div>
        <div class="sm:px-5 flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end">
            <div class="relative flex-grow w-full">
                <label for="id_quiz" class="leading-7 text-sm text-gray-600">Id quizu</label>
                <input type="text" id="id_quiz" name="id_quiz" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <div class="relative flex-grow w-full">
                <label for="tresc" class="leading-7 text-sm text-gray-600">Treść</label>
                <input type="text" id="tresc" name="tresc" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Dodaj</button>
        </div>
    </form>
    <div class="container sm:px-5 py-10 mx-auto font-light w-full">
    <h1 class="sm:text-2xl text-1xl font-medium title-font mb-4 text-gray-900 text-center">Dostępne QUIZY</h1>
        <table class="flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end font-light">
        <tr class="border-b-[1px] w-full">
            <th class="font-normal w-[5%]">ID</th>
            <th class="font-normal w-[25%]">Tytul</th>
            <th class="font-normal w-[40%] sm:table-cell hidden ">Opis</th>
            <th class="font-normal w-[15%] text-indigo-500 py-2">Kategoria</th>
            <th class="font-normal w-[10%] sm:table-cell">Ilość pytań</th>
        </tr>
        
    ';

$sql = "SELECT testy.ID_Testu, testy.Nazwa, testy.opis, testy.kategoria, COUNT(pytania.ID_Pyt) FROM `testy` left join pytania on pytania.ID_testu=testy.ID_Testu GROUP by testy.ID_Testu;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    $str = $row['opis'];
    if (strlen($str) > 60){
        $str = substr($str, 0, 53) . '...';
    }
    echo '
        <tr class="border-b-[1px] ">
            <td class="text-center">'.$row['ID_Testu'].'</td>
            <td class="sm:text-left text-center">'.$row['Nazwa'].'</td>
            <td class="sm:table-cell hidden py-2"> '.$str.'</td>
            <td class="text-center py-2 text-indigo-500">'.$row['kategoria'].'</td>
            <td class="sm:table-cell hidden text-center">' . $row['COUNT(pytania.ID_Pyt)'] . '</td>
        </tr>
    ';
}
echo '</table>
<div class="container sm:px-5 py-10 mx-auto font-light w-full">
    <h1 class="sm:text-2xl text-1xl font-medium title-font mb-4 text-gray-900 text-center">Wszystkie pytania</h1>
        <table class="flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end font-light">
        <tr class="border-b-[1px] w-full">
            <th class="font-normal w-[5%]">ID</th>
            <th class="font-normal w-[25%]">Quiz</th>
            <th class="font-normal w-[40%] sm:table-cell hidden ">Pytanie</th>
            <th class="font-normal w-[10%] sm:table-cell">Ilość odpowiedzi</th>
        </tr>';
        $sql = "SELECT pytania.ID_Pyt, testy.Nazwa, pytania.tresc, testy.ID_testu, count(odpowiedzi.ID_odp) as 'ilosc_odp' FROM `pytania` join testy on testy.ID_Testu=pytania.ID_testu left JOIN odpowiedzi on pytania.ID_Pyt=odpowiedzi.ID_Pyt group by pytania.ID_Pyt;";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $id_pyt = $row['ID_testu'];
            $color = substr(md5($id_pyt), 7, 8);
            $str = $row['tresc'];
            if (strlen($str) > 90){
                $str = substr($str, 0, 83) . '...';
            }
            echo '
                <tr class="border-b-[1px] bg-[#'.$color.']">
                    <td class="text-center">'.$row['ID_Pyt'].'</td>
                    <td class="sm:text-left text-center">'.$row['Nazwa'].'</td>
                    <td class="sm:table-cell hidden py-2"> '.$str.'</td>
                    <td class="sm:table-cell hidden text-center">' . $row['ilosc_odp'] . '</td>
                </tr>
            ';
        }
        echo '</table>

<a href="admin.php?action=" class="rounded-full bg-[#3d3d3d] text-center py-3 px-8 text-white hover:bg-[#fdfdfd] hover:text-[#3d3d3d] hover:shadow-xl transition-all duration-300">Powrót do panelu</a></div>

</section>
';

    if($dodano == true){
        
            echo "
            <script>
                document.getElementById('id_quiz').style.borderBottom = '1px solid green';
                document.getElementById('id_quiz').placeholder = 'Dodano!';
                document.getElementById('tresc').style.borderBottom = '1px solid green';
                document.getElementById('tresc').placeholder = 'Dodano!';
            </script>
            ";
        
    }
    if($dodano == false && isset($_GET['id_quiz']) && isset($_GET['tresc'])){
        echo "
        <script>
            document.getElementById('id_quiz').style.borderBottom = '1px solid orange';
            document.getElementById('id_quiz').placeholder = 'Istnieje już takie pytanie';
            document.getElementById('tresc').style.borderBottom = '1px solid orange';
            document.getElementById('tresc').placeholder = 'Istnieje już takie pytanie';
        </script>
        ";
    }
    if(isset($_GET['id_quiz']) && isset($_GET['tresc'])) {
        $id_quiz = $_GET['id_quiz'];
        $tresc = $_GET['tresc'];
        if($id_quiz == '') {
            echo "
            <script>
                document.getElementById('id_quiz').style.borderBottom = '1px solid red';
                document.getElementById('id_quiz').placeholder = 'Wpisz id quizu';
            </script>
            ";
        }
        if($tresc == '') {
            echo "
            <script>
                document.getElementById('tresc').style.borderBottom = '1px solid red';
                document.getElementById('tresc').placeholder = 'Wpisz treść pytania';
            </script>
            ";
        }
    }

?>