<?php
 if(isset($_GET['id_pyt']) && isset($_GET['tresc']) && isset($_GET['poprawna'])) {
    $id_pyt = $_GET['id_pyt'];
    $tresc = $_GET['tresc'];
    $poprawna = $_GET['poprawna'];
    if($id_pyt == '') {
        echo "
        <script>
            document.getElementById('id_pyt').style.borderBottom = '1px solid red';
            document.getElementById('id_pyt').placeholder = 'Wpisz id pytania';
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
    if($poprawna == '') {
        echo "
        <script>
            document.getElementById('poprawna').style.borderBottom = '1px solid red';
            document.getElementById('poprawna').placeholder = 'Wpisz poprawną odpowiedź';
        </script>
        ";
    }
    
    if($id_pyt != '' && $tresc != '' && $poprawna != '') {
        $conn = mysqli_connect('localhost', 'root', '','quiz');

                
                $sql2 = "SELECT * FROM odpowiedzi WHERE Tresc='$tresc' and ID_Pyt='$id_pyt'";
        
                if ($result = mysqli_query($conn, $sql2)) {
                    $rowcount = mysqli_num_rows($result);
                    if($rowcount == 0) {
                        if($poprawna == 'Tak' || $poprawna == 'tak' || $poprawna == 'TAK' || $poprawna == '1') {
                            $poprawna = 1;
                        } else {
                            $poprawna = 0;
                        }
                        $sql = "INSERT INTO odpowiedzi (ID_odp, tresc, ID_Pyt, Poprawna) VALUES ('NULL', '$tresc', '$id_pyt', '$poprawna')";
                        mysqli_query($conn, $sql);
                        $dodano = true;
                    }
                }
        
        
    }
}
echo '
<section class="text-gray-600 body-font">
    <form method="GET" action="admin.php?action=odp class="container px-5 py-2 mx-auto">
    <input name="action" id="action" value="odp" type="text" class="hidden">
        <div class="flex flex-col text-center w-full mb-12">
        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Dodaj odpowiedź</h1>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Tutaj dodajesz odpowiedź do istniejęcego już pytania, po kolei tylko dodawaj.</p>
        </div>
        <div class="sm:px-5 flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end">
            <div class="relative flex-grow w-full">
                <label for="id_pyt" class="leading-7 text-sm text-gray-600">Id pytania</label>
                <input type="text" id="id_pyt" name="id_pyt" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <div class="relative flex-grow w-full">
                <label for="tresc" class="leading-7 text-sm text-gray-600">Treść</label>
                <input type="text" id="tresc" name="tresc" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <div class="relative flex-grow w-full">
                <label for="poprawna" class="leading-7 text-sm text-gray-600">Poprawna (Tak/Nie)</label>
                <input type="text" id="poprawna" name="poprawna" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Dodaj</button>
        </div>
    </form>
    <div class="container sm:px-5 py-10 mx-auto font-light w-full">
    <h1 class="sm:text-2xl text-1xl font-medium title-font mb-4 text-gray-900 text-center">Wszystkie pytania</h1>
        <table class="flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end font-light">
        <tr class="border-b-[1px] w-full">
            <th class="font-normal w-[5%]">ID</th>
            <th class="font-normal w-[25%]">Quiz</th>
            <th class="font-normal w-[40%]">Pytanie</th>
            <th class="font-normal w-[10%]">Ilość odpowiedzi</th>
        </tr>
        
    ';
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
<div class="container sm:px-5 py-10 mx-auto font-light w-full">
    <h1 class="sm:text-2xl text-1xl font-medium title-font mb-4 text-gray-900 text-center">Wszystkie odpowiedzi</h1>
        <table class="flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end font-light">
        <tr class="border-b-[1px] w-full">
            <th class="font-normal w-[5%]">ID</th>
            <th class="font-normal w-[45%]">Pytanie</th>
            <th class="font-normal w-[45%] ">Odpowiedź</th>
            <th class="font-normal w-[15%] py-2">Poprawna</th>
        </tr>';
        $sql = "SELECT odpowiedzi.ID_odp, odpowiedzi.Tresc, pytania.tresc, odpowiedzi.Poprawna, odpowiedzi.ID_Pyt FROM `odpowiedzi` left join pytania on odpowiedzi.ID_Pyt=pytania.ID_Pyt;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    $id_pyt = $row['ID_Pyt'] + 30;
    //ustawienie koloru dla takich samych pytań 3, 7
    $color = substr(md5($id_pyt), 7, 8);

    if($row['Poprawna'] == 1){
        $poprawna = '<span class="text-green-700">Tak</span>';
    }else{
        $poprawna = '<span class="text-red-700">Nie</span>';
    }  
    echo '
        <tr class="border-b-[1px] bg-[#'.$color.']">
            <td class="text-center">'.$row['ID_odp'].'</td>
            <td class="sm:text-left text-center">'.$row['tresc'].'</td>
            <td class="py-2"> '.$row['Tresc'].'</td>
            <td class="text-center py-2">'.$poprawna.'</td>
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
                document.getElementById('id_pyt').style.borderBottom = '1px solid green';
                document.getElementById('id_pyt').placeholder = 'Dodano!';
                document.getElementById('tresc').style.borderBottom = '1px solid green';
                document.getElementById('tresc').placeholder = 'Dodano!';
                document.getElementById('poprawna').style.borderBottom = '1px solid green';
                document.getElementById('poprawna').placeholder = 'Dodano!';
            </script>
            ";
        
    }
    if($dodano == false && isset($_GET['id_pyt']) && isset($_GET['tresc']) && isset($_GET['poprawna'])){
        echo "
        <script>
            document.getElementById('id_pyt').style.borderBottom = '1px solid orange';
            document.getElementById('id_pyt').placeholder = 'Istnieje już takie pytanie';
            document.getElementById('tresc').style.borderBottom = '1px solid orange';
            document.getElementById('tresc').placeholder = 'Istnieje już takie pytanie';
            document.getElementById('poprawna').style.borderBottom = '1px solid orange';
            document.getElementById('poprawna').placeholder = 'Istnieje już taka odpowiedź';
        </script>
        ";
    }
    if(isset($_GET['id_pyt']) && isset($_GET['tresc']) && isset($_GET['poprawna'])) {
        $id_pyt = $_GET['id_pyt'];
        $tresc = $_GET['tresc'];
        $poprawna = $_GET['poprawna'];
        if($id_pyt == '') {
            echo "
            <script>
                document.getElementById('id_pyt').style.borderBottom = '1px solid red';
                document.getElementById('id_pyt').placeholder = 'Wpisz id pytania';
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
        if($poprawna == '') {
            echo "
            <script>
                document.getElementById('poprawna').style.borderBottom = '1px solid red';
                document.getElementById('poprawna').placeholder = 'Wpisz poprawną odpowiedź';
            </script>
            ";
        }
    }

?>