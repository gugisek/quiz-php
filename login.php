<?php session_start();
    if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] == true) {
        header("Location: quiz.php");
    }
?>
<!-- if not logged to pokaz formulaz logowania, a jeśli zalogowany to pokaż historie konta oraz nazwe użytkownika -->
<!DOCTYPE html>
<html lang="pl">
<?php include 'head.php'; ?>
<body class="flex flex-col items-center min-h-screen">
    <nav class="font-regular flex items-center justify-center px-10 py-10 w-full">
        <a href="" class="w-1/3"></a>
        <a href="index.php" class="w-1/3 text-center text-xl">QuizPHP</a>
        <a href="login.php" class="w-1/3 text-right hover:font-medium hover:drop-shadow transition-all duration-300">login</a>
    </nav>
    <h1 class="font-light m-0 mb-[-30px]">Zaloguj / Rejestruj</h1>
    <section class="w-[20%] flex flex-col ac jev py-[60px] px-[50px]" style="
    border-radius: 30px;
    background: ##f2f2f2;
    box-shadow:  20px 20px 60px #bebebe,
                -20px -20px 60px #ffffff;">
        <form method="GET" action = "login.php" class="text-center">
            <p class="mt-0">Login</p>
            <input type="text" name="login" id="login" class="login-input text-center">
            <p>Hasło</p>
            <input type="password" name="password" id="password" class="login-input text-center">
            <br>
            <button type="submit" id="login-button" class="login-button mt-[10px]">Zaloguj</button>
        </form>
        <?php
        // auth.php
            if(isset($_GET['login']) && isset($_GET['password'])) {
                $login = $_GET['login'];
                $password = $_GET['password'];
                if($login == '') {
                    echo "
                    <script>
                        document.getElementById('login').style.borderBottom = '1px solid red';
                        document.getElementById('login').placeholder = 'Wpisz login';
                    </script>
                    ";
                }
                if($password == '') {
                    echo "
                    <script>
                        document.getElementById('password').style.borderBottom = '1px solid red';
                        document.getElementById('password').placeholder = 'Wpisz hasło';
                    </script>
                    ";
                }
                if($login != '' && $password != '') {
                    $conn = mysqli_connect('localhost', 'root', '','quiz');
                    $query = "SELECT * FROM `login` WHERE `Login` = '$login' AND `Haslo` = '$password'";
                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result) > 0) {
                        $_SESSION['uzytkownik'] = $login;
                        $_SESSION['zalogowany'] = true;
                        header("Location: quiz.php");
                    } else {
                        echo "<p class='m-0 mt-30px text-red'>Niepoprawny login lub hasło</p>";
                    }
                }
            }
            
        ?>
</body>
</html>