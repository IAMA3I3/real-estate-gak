<?php

include './components/header.php';
include './components/top_nav.php';
include './components/showcase.php';
?>

<div class="">Home</div>

<?php

include './components/footer_main.php';
include './components/footer.php';
?>

<?php
ob_start();

include './components/header.php';
include './components/top_nav.php';
include './components/detail_showcase.php';

if (!isset($_GET['id'])) {
    header('Location: ./index.php');
    exit;
}

ob_end_flush();
?>

<div class="">Detail</div>

<?php

include './components/footer_main.php';
include './components/footer.php';
?>





<div class=" absolute top-0 left-0 w-full h-full text-white z-10">
    <div class=" container h-full">
        <div class=" h-full flex justify-between items-center text-sm font-semibold">
            <div class=" hidden md:flex items-center gap-8 rotate-90">
                <div class="">FOLLOW US</div>
                <div class=" h-[2px] w-10 bg-white"></div>
                <div class=" flex items-center gap-4">
                    <a href="#" class=" hover:text-app-primary -rotate-90"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class=" hover:text-app-primary -rotate-90"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" class=" hover:text-app-primary -rotate-90"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class=" flex items-center gap-8 rotate-90">
                <button class=" hover:text-app-primary">PREV</button>
                <div class=" h-[2px] w-10 bg-white"></div>
                <button class=" hover:text-app-primary">NEXT</button>
            </div>
        </div>
    </div>
</div>





<div class=" relative w-full flex flex-col md:flex-row justify-center gap-4 group">
    <div class=" flex-1 max-w-[700px] aspect-[3/2]">
        <img src="<?php echo htmlspecialchars(explode(', ', $property['img'])[0]) ?>" class=" w-full h-full object-cover" alt="">
    </div>
    <?php if (count(explode(', ', $property['img'])) > 1) { ?>
        <div class=" flex md:flex-col gap-4 md:w-[300px] lg:w-[400px] *:w-full md:*:h-full">
            <div class="">
                <img src="<?php echo htmlspecialchars(explode(', ', $property['img'])[1]) ?>" class=" w-full h-full object-cover" alt="">
            </div>
            <div class="">
                <?php if (count(explode(', ', $property['img'])) > 2) { ?>
                    <img src="<?php echo htmlspecialchars(explode(', ', $property['img'])[2]) ?>" class=" w-full h-full object-cover" alt="">
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    <?php if (count(explode(', ', $property['img'])) > 3) { ?>
        <div class=" absolute bottom-4 right-8"></div>
    <?php } ?>
    <div class=" absolute top-0 left-0 w-full h-full flex justify-center items-center">
        <div class=" invisible opacity-0 w-0 group-hover:visible group-hover:opacity-100 group-hover:w-[60px] transition-all duration-500 aspect-square rounded-full border-white border-2 bg-black/20 text-white flex justify-center items-center text-lg"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
    </div>
</div>


<?php

include './components/header.php';
userAccess(['admin']);
?>

<!-- container -->
<div class=" dashboard-container">
    <!--  -->
    <?php include './components/dashboard_side_nav.php' ?>
    <!--  -->
    <div class=" dashboard-main scrollbar transition-all duration-500">
        <?php include './components/dashboard_top_bar.php' ?>
        <!-- main -->
        <div class=" p-4">
            <div class=" text-2xl">Dashboard</div>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
?>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        require_once '../db.php';
        require_once '../functions.php';
        require_once '../session.php';
        
        $pdo = null;
        $stmt = null;
        exit;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header('Location: ../../index.php');
    exit;
}
?>