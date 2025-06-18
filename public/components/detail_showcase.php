<?php

$currentPage = basename($_SERVER['PHP_SELF']);

$pageTitle = '';
$pageSubTitle = '';
$backLink = '#';

switch ($currentPage) {
    case 'property_detail.php':
        $pageTitle = 'Properties';
        $pageSubTitle = htmlspecialchars($property['name']);
        $backLink = './properties.php';
        break;

    case 'blog_detail.php':
        $pageTitle = 'Blog';
        $pageSubTitle = htmlspecialchars($blog['title']);
        $backLink = './blog.php';
        break;

    case 'team-bio.php':
        $pageTitle = 'About';
        $pageSubTitle = htmlspecialchars($member['name']);
        $backLink = './about.php';
        break;

    default:
        $pageTitle = '';
        $pageSubTitle = '';
        $backLink = '#';
        break;
}

?>

<div class=" w-full bg-cover bg-no-repeat bg-center" style="background-image: url(./assets/showcase.png);">
    <div class=" bg-app-secondary/80 text-white py-16">
        <div class=" container">
            <div class=" text-center w-full max-w-[600px] m-auto">
                <div class=" text-sm font-semibold flex items-center justify-center gap-2">
                    <a href="./index.php" class=" hover:text-app-primary">Home</a>
                    <i class="fa-solid fa-angle-right translate-y-[2px]"></i>
                    <a href="<?php echo $backLink ?>" class=" hover:text-app-primary"><?php echo $pageTitle ?></a>
                    <i class="fa-solid fa-angle-right translate-y-[2px]"></i>
                    <div class=" max-w-[60px] truncate"><?php echo $pageSubTitle ?></div>
                </div>
                <div class=" mt-8 text-lg font-semibold font-playfair">
                    <?php echo $pageSubTitle ?>
                </div>
            </div>
        </div>
    </div>
</div>