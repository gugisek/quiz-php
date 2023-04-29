<?php session_start();
    if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] !== true) {
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<?php include 'head.php'; ?>
<body>
    <?php
        
        $conn = mysqli_connect('localhost', 'root', '', 'quiz');
        $sesja_login = $_SESSION['uzytkownik'];
        $query = "SELECT Imie FROM login WHERE Login = '$sesja_login'";
        $result = mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($result)) {
            $imie = $row['Imie'];
            echo "<h1 class='fw-light m-0'>Witaj $imie</h1>";
        }
        ?>
    <a href="logout.php">wyloguj</a>
</body>
</html>