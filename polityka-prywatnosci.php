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
<body class="min-h-screen flex justify-between flex-col">
<?php include 'nav.php'; ?>

<section class="flex flex-col items-center">
    <h1 class="text-8xl font-black text-gray-900 text-center">404 nie znale<span class="text-indigo-500">ziomo</span> strony<br/> <span class="text-6xl">(w sumie to znaleziono)</span></h1>
    
</section>

<?php include 'footer.php'; ?>
</body>
</html>

