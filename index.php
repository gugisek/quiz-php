<!DOCTYPE html>
<html lang="pl">
<?php include 'head.php'; ?>
<body class="min-h-screen flex flex-col items-center justify-start">
    <nav class="font-regular flex items-center justify-center px-10 py-10 w-full">
        <a href="" class="w-1/3"></a>
        <a href="index.php" class="w-1/3 text-center text-xl">QuizPHP</a>
        <a href="login.php" class="w-1/3 text-right hover:font-medium hover:drop-shadow transition-all duration-300">login</a>
    </nav>
    <section class="flex flex-1 items-center justify-center h-full mb-[40px]">
        <div class="w-1/2 pl-10">
            <h1 class="text-3xl font-bold py-3">Zacznij swój quiz już teraz!</h1>
            <form action="quiz.php">
            <button type="submit" class="rounded-full bg-[#3d3d3d] py-3 px-8 text-white hover:bg-[#fdfdfd] hover:text-[#3d3d3d] hover:shadow-xl transition-all duration-300">START</button>
            </form>
        </div>
        <div class="w-1/2">
            <div class="flex items-center justify-end pr-10">
                <div class="flex items-center flex-col">
                    <ul>
                        <li class="text-[#fdd92e] text-xl"> 1. Twuj Stary</li>
                        <li class="text-[gray] text-lg"> 2. Twoja strna</li>
                        <li class="text-[brown]"> 3. Twoja strona</li>
                    </ul>
                </div>
            
                <img src="podium.webp" alt="podium img" class="w-1/2">
            
            </div>

            <h2 class="text-center pl-10">Nasi najlepsi zawodnicy</h2>
        </div>
    </section>
    <section class="py-2 text-gray-500">
        designed and builded by <a href="">gugisek</a>
    </section>
</body>
</html>