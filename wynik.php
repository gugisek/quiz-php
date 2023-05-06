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
<body>
    <?php include 'navLogged.php'; ?>
    
    <?php

    echo $_SESSION['odp-1'];
    echo $_SESSION['odp-2'];
    echo $_SESSION['odp-3'];
    echo $_SESSION['odp-4'];

  
    ?>

</body>
</html>

