<?php 
    session_start();
    if(!isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] !== true) {
        header("Location: login.php");
        exit;
    }
    if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] === true) {
        if($_SESSION['admin'] != 'true') {
            header("Location: quiz.php");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<?php include 'components/head.php'; ?>
<body class="min-h-screen flex justify-between flex-col">
    <?php include 'components/nav.php'; ?>
    <?php
    if ($_GET['action'] == "") {
        include 'components/panel.php';
    }
    $dodano = false;
    if (($_GET['action'] == "quiz")){
        include 'components/dod_quiz.php';
    }
    if (($_GET['action'] == "pytanie")){
       include 'components/dod_pyt.php';
    }
    if (($_GET['action'] == "odp")){
        include 'components/dod_odp.php';
    }
    ?> 
    <?php include 'components/footer.php'; ?>
</body>
</html>

