<?php
ob_start();

include './components/header.php';
include './components/top_nav.php';

if (!isset($_GET['id'])) {
    header('Location: ./index.php');
    exit;
}

$member = fetchById($pdo, $_GET['id'], "team", "id");

include './components/detail_showcase.php';

ob_end_flush();
?>

<!-- bio -->
<div class=" py-16">
    <div class=" container">
        <div class=" flex flex-col md:flex-row *:w-full items-center gap-8">
            <!-- img -->
            <div class=" flex items-center justify-center">
                <div class=" w-[80%] max-w-[400px] aspect-[3/4] relative">
                    <div class=" absolute bottom-0 left-0 w-[90%] h-[90%] rounded bg-app-secondary"></div>
                    <div class=" absolute top-0 right-0 w-[90%] h-[90%] rounded overflow-hidden shadow">
                    <img src="<?php echo ($member['img']) ? './includes/team/' . htmlspecialchars($member['img']) : './assets/man-placeholder.jpg' ?>" class=" h-full w-full object-cover object-top" alt="">
                    </div>
                </div>
            </div>
            <!-- text -->
            <div class="">
                <div class=" text-lg font-semibold font-playfair text-app-primary">About</div>
                <div class=" mt-1 text-2xl font-bold font-playfair"><?php echo htmlspecialchars($member['name']) ?></div>
                <div class=" mt-4"><?php echo nl2br(htmlspecialchars($member['bio'])) ?></div>
            </div>
        </div>
    </div>
</div>

<?php

include './components/footer_main.php';
include './components/footer.php';
?>