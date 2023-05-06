<nav class="font-regular flex md:flex-row flex-col items-center justify-center px-10 py-10 w-full">
        <a href="" class="w-1/3"></a>
        <a href="index.php" class="w-1/3 text-center text-xl">QuizPHP</a>
        <a href="logout.php" class="md:w-1/3 text-right hover:font-medium hover:drop-shadow transition-all duration-300">
                Wyloguj się 
                <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'quiz');
                        $sesja_login = $_SESSION['uzytkownik'];
                        $query = "SELECT Imie FROM login WHERE Login = '$sesja_login'";
                        $result = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_assoc($result)) {
                                $imie = $row['Imie'];
                                echo $imie;
                        }
                ?>
        </a>
</nav>