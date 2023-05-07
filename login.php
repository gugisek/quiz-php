<?php session_start();
    
?>
<!DOCTYPE html>
<html lang="pl">
<?php include 'head.php'; ?>
<body class="flex flex-col items-center min-h-screen justify-between">
    <?php include 'navLogin.php'; ?>
    <section class="text-gray-600 body-font">
        <form method="GET" action = "login.php">
            <div class="container px-5 py-24 mx-auto flex flex-wrap items-center">
                <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
                    <a href="register.php" class="title-font font-medium text-3xl hover:text-gray-900 text-indigo-500 transition-all duration-300">Dołącz do naszego grona rozwiązywaczy quizów!</a>
                    <p class="leading-relaxed mt-4">Twoje konto umożliwia Ci osiągnięcie pełni umiejętności w quizach i zapisuje Twój progres w chmurze. Bardzo doceniamy Twoje członowstwo w naszych użytkownikach na tej stronie.</p>
                </div>
                <div class="lg:w-2/6 md:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
                    <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Zaloguj się</h2>
                    <div class="relative mb-4">
                        <label for="full-name" class="leading-7 text-sm text-gray-600">Login</label>
                        <input type="text" name="login" id="login" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <div class="relative mb-4">
                        <label for="email" class="leading-7 text-sm text-gray-600">Hasło</label>
                        <input type="password" name="password" id="password" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <button type="submit" class="rounded-full bg-[#3d3d3d] py-3 px-8 text-white hover:bg-[#fdfdfd] hover:text-[#3d3d3d] hover:shadow-xl transition-all duration-300">Zaloguj się</button>
                    <p class="text-xs text-gray-500 mt-3">Chcesz się zarejestrować? Zrób to <a href="register.php" class="text-indigo-500">tutaj</a>.</p>
                    
                </div>
            </div>
        </form>
    </section>
    <?php

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
                        echo "<p class='mt-5 text-red-400'>Niepoprawny login lub hasło</p>";
                    }
                }
            }
            if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] == true) {
                header("Location: quiz.php");
            }
        ?>
<?php include 'footer.php'; ?>
</body>
</html>