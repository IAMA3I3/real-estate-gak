<?php

$currentPage = basename($_SERVER['PHP_SELF']);

$pageTitle = '';

switch ($currentPage) {
    case 'about.php':
        $pageTitle = 'About Us';
        break;

    case 'properties.php':
        $pageTitle = 'Properties';
        break;

    case 'blog.php':
        $pageTitle = 'Blog';
        break;

    case 'contact.php':
        $pageTitle = 'Contact';
        break;

    default:
        $pageTitle = '';
        break;
}

?>

<div class=" w-full h-[40vh] bg-cover bg-no-repeat bg-center" style="background-image: url(./assets/showcase.png);">
    <div class=" w-full h-full bg-app-secondary/80 text-white">
        <div class=" container h-full">
            <div class=" h-full flex flex-col md:flex-row items-center justify-center md:justify-between">
                <div class=" text-2xl font-bold font-playfair">
                    <?php echo $pageTitle ?>
                </div>
                <div class=" flex items-center gap-2">
                    <a href="./index.php" class=" hover:text-app-primary">Home</a>
                    <i class="fa-solid fa-angle-right translate-y-[2px]"></i>
                    <div><?php echo $pageTitle ?></div>
                </div>
            </div>
        </div>
    </div>
</div>