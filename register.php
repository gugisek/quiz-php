<!DOCTYPE html>
<html lang="pl">
<?php include 'components/head.php'; ?>
<body class="flex flex-col items-center min-h-screen justify-between">
    <?php include 'components/navLogin.php'; ?>
    <section class="text-gray-600 body-font">
        <form method="GET" action = "register.php">
            <div class="container px-5 py-20 mx-auto">
                <div class="flex flex-col text-center w-full mb-12">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Zarejestruj się w naszym serwisie!</h1>
                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Konto w naszym serwisie pomoże osiągnąc Ci sukces w życiu i w rozwiązywaniu quizów. Badania potwierdzają skuteczność nauki poprzez założenie konta. Masz już konto? <a href="login.php" class="text-indigo-500">Zaloguj się tutaj</a>.</p>
                </div>
                <div class="flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end">
                    <div class="relative flex-grow w-full">
                        <label for="imie" class="leading-7 text-sm text-gray-600">Imie</label>
                        <input type="text" id="imie" name="imie" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <div class="relative flex-grow w-full">
                        <label for="login" class="leading-7 text-sm text-gray-600">Login</label>
                        <input type="text" id="login" name="login" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <div class="relative flex-grow w-full">
                        <label for="password" class="leading-7 text-sm text-gray-600">Hasło</label>
                        <input type="password" id="password" name="password" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Zarejestruj</button>
                </div>
            </div>
        </form>
    </section>
    <?php
            
            if(isset($_GET['login']) && isset($_GET['password'])) {
                $login = $_GET['login'];
                $password = $_GET['password'];
                $imie = $_GET['imie'];
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
                if($imie == '') {
                    echo "
                    <script>
                        document.getElementById('imie').style.borderBottom = '1px solid red';
                        document.getElementById('imie').placeholder = 'Wpisz imie';
                    </script>
                    ";
                }
                $error = false;
                if($login != '' && $password != '' && $imie != '') {
                    $conn = mysqli_connect('localhost', 'root', '','quiz');
                    $query = "SELECT * FROM `login` WHERE `Login` = '$login' or `Imie` = '$imie'";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($result)) {
                        if($row['Login'] == $login) {
                            echo "
                            <script>
                                document.getElementById('login').style.borderBottom = '1px solid orange';
                                document.getElementById('login').placeholder = 'Login zajęty';
                            </script>
                            ";
                            $error = true;
                        }
                        if($row['Imie'] == $imie) {
                            echo "
                            <script>
                                document.getElementById('imie').style.borderBottom = '1px solid orange';
                                document.getElementById('imie').placeholder = 'Imie zajęte';
                            </script>
                            ";
                            $error = true;
                        }
                    }
                    if($error != true) {
                        $query = "INSERT INTO `login` (`ID`, `Imie`, `Login`, `Haslo`, `Rola`) VALUES ('NULL', '$imie', '$login', '$password', 'user')";
                        $result = mysqli_query($conn, $query);
                        $_SESSION['uzytkownik'] = $login;
                        $_SESSION['zalogowany'] = true;
                        header("Location: quiz.php");
                    }
                }
            }

        ?>
<?php include 'components/footer.php'; ?>
</body>
</html>