<?php

$navLinks = [
    ['name' => 'Home', 'url' => './index.php', 'isActive' => isPageActive('index.php'), 'subNav' => null],
    ['name' => 'Properties', 'url' => './properties.php', 'isActive' => isPageActive('properties.php') || isPageActive('property_detail.php'), 'subNav' => [
        ['name' => 'On Going', 'url' => './properties.php?status=on_going', 'isActive' => isPageActive('properties.php') && isset($_GET['status']) && $_GET['status'] === 'on_going'],
        ['name' => 'Rentals', 'url' => './properties.php?status=completed&type=rental', 'isActive' => isPageActive('properties.php') && isset($_GET['status']) && $_GET['status'] === 'completed' && isset($_GET['type']) && $_GET['type'] === 'rental'],
        ['name' => 'Sale', 'url' => './properties.php?status=completed&type=sale', 'isActive' => isPageActive('properties.php') && isset($_GET['status']) && $_GET['status'] === 'completed' && isset($_GET['type']) && $_GET['type'] === 'sale']
    ]],
    ['name' => 'Blog', 'url' => './blog.php', 'isActive' => isPageActive('blog.php') || isPageActive('blog_detail.php'), 'subNav' => null],
    ['name' => 'About Us', 'url' => './about.php', 'isActive' => isPageActive('about.php'), 'subNav' => null],
    ['name' => 'Contact', 'url' => './contact.php', 'isActive' => isPageActive('contact.php'), 'subNav' => null]
];
?>

<!-- top -->
<div class=" bg-app-primary">
    <div class=" container">
        <div class=" flex items-center justify-between">
            <!-- mail -->
            <a href="mailto:info@gadekelanichambers.com" class=" hidden sm:inline hover:text-white font-semibold font-playfair">
                <i class="fa-solid fa-envelope"></i> <span>info@gadekelanichambers.com</span>
            </a>
            <!-- phone -->
            <a href="tel:+2348023345854" class=" hidden md:inline hover:text-white font-semibold font-playfair">
                <i class="fa-solid fa-phone"></i> <span>(+234) 802 3345 854</span>
            </a>
            <!-- social -->
            <div class=" hidden lg:flex items-center gap-2 *:rounded">
                <!-- facebook -->
                <a href="#" class=" w-[30px] aspect-square text-sm flex justify-center items-center bg-app-secondary text-white hover:bg-white hover:text-app-primary">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <!-- linked in -->
                <a href="#" class=" w-[30px] aspect-square text-sm flex justify-center items-center bg-app-secondary text-white hover:bg-white hover:text-app-primary">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>
                <!-- x-twitter -->
                <a href="#" class=" w-[30px] aspect-square text-sm flex justify-center items-center bg-app-secondary text-white hover:bg-white hover:text-app-primary">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
                <!-- skype -->
                <a href="#" class=" w-[30px] aspect-square text-sm flex justify-center items-center bg-app-secondary text-white hover:bg-white hover:text-app-primary">
                    <i class="fa-brands fa-skype"></i>
                </a>
            </div>
            <!-- consult button -->
            <a href="./contact.php" class=" py-3 px-6 bg-app-secondary text-app-primary hover:bg-white font-semibold">
                FREE CONSULTATION
            </a>
        </div>
    </div>
</div>

<!-- top nav bar -->
<div class=" bg-white/70 backdrop-blur-sm py-2">
    <div class=" container">
        <div class=" flex items-center justify-between">
            <!-- logo -->
            <a href="./index.php">
                <img src="./assets/logo.png" class=" h-[60px]" alt="">
            </a>
            <!--  -->
            <div class=" flex items-center gap-8">
                <!-- navs -->
                <div class=" hidden md:flex items-center gap-6 uppercase">
                    <?php foreach ($navLinks as $navLink) { ?>
                        <div class=" drop-menu relative z-50">
                            <a href="<?php echo $navLink['url'] ?>" class="<?php echo $navLink['isActive'] ? ' text-app-primary' : ' hover:text-app-primary' ?> font-semibold flex gap-4 items-center">
                                <span><?php echo $navLink['name'] ?></span>
                                <!-- <?php if ($navLink['subNav']) { ?>
                                    <div class=" ic rotate-0 transition-all duration-500">
                                        <i class="fa-solid fa-caret-down"></i>
                                    </div>
                                <?php } ?> -->
                            </a>
                            <!-- <?php if ($navLink['subNav']) { ?>
                                <div class=" sub-menu -translate-y-8 opacity-0 invisible transition-all duration-500 absolute right-0 mt-2 bg-white rounded border shadow min-w-[200px] py-2 divide-y-2 text-sm font-semibold">
                                    <?php foreach ($navLink['subNav'] as $subNav) { ?>
                                        <a href="<?php echo $subNav['url'] ?>" class="<?php echo $subNav['isActive'] ? ' bg-gray-200 text-app-primary' : ' hover:bg-gray-200 hover:text-app-primary' ?> block py-1 px-4"><?php echo $subNav['name'] ?></a>
                                    <?php } ?>
                                </div>
                            <?php } ?> -->
                        </div>
                    <?php } ?>
                </div>
                <!-- search button -->
                <div class=" search-toggle text-app-primary hover:text-app-secondary cursor-pointer">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <!-- menu toggle button -->
                <div class=" side-nav-toggle md:hidden cursor-pointer w-[40px] aspect-square rounded-sm bg-app-primary text-white flex items-center justify-center">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- sticky top navbar -->
<div class=" sticky-navbar transition-all duration-500 fixed w-full bg-white/80 backdrop-blur-sm py-2 shadow z-40">
    <div class=" container">
        <div class=" flex items-center justify-between">
            <!-- logo -->
            <a href="./index.php">
                <img src="./assets/logo.png" class=" h-[60px]" alt="">
            </a>
            <!--  -->
            <div class=" flex items-center gap-8">
                <!-- navs -->
                <div class=" hidden md:flex items-center gap-6 uppercase">
                    <?php foreach ($navLinks as $navLink) { ?>
                        <div class=" drop-menu relative">
                            <a href="<?php echo $navLink['url'] ?>" class="<?php echo $navLink['isActive'] ? ' text-app-primary' : ' hover:text-app-primary' ?> font-semibold flex gap-4 items-center">
                                <span><?php echo $navLink['name'] ?></span>
                                <!-- <?php if ($navLink['subNav']) { ?>
                                    <div class=" ic rotate-0 transition-all duration-500">
                                        <i class="fa-solid fa-caret-down"></i>
                                    </div>
                                <?php } ?> -->
                            </a>
                            <!-- <?php if ($navLink['subNav']) { ?>
                                <div class=" sub-menu -translate-y-8 opacity-0 invisible transition-all duration-500 absolute right-0 mt-2 bg-white rounded border shadow min-w-[200px] py-2 divide-y-2 text-sm font-semibold">
                                    <?php foreach ($navLink['subNav'] as $subNav) { ?>
                                        <a href="<?php echo $subNav['url'] ?>" class="<?php echo $subNav['isActive'] ? ' bg-gray-200 text-app-primary' : ' hover:bg-gray-200 hover:text-app-primary' ?> block py-1 px-4"><?php echo $subNav['name'] ?></a>
                                    <?php } ?>
                                </div>
                            <?php } ?> -->
                        </div>
                    <?php } ?>
                </div>
                <!-- search button -->
                <div class=" search-toggle text-app-primary hover:text-app-secondary cursor-pointer">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <!-- menu toggle button -->
                <div class=" side-nav-toggle md:hidden cursor-pointer w-[40px] aspect-square rounded-sm bg-app-primary text-white flex items-center justify-center">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- side nav overlay -->
<div class=" side-nav-toggle nav-overlay transition-all duration-500 md:hidden fixed top-0 right-0 h-full bg-black/50 z-50"></div>
<!-- side nav bar -->
<div class=" side-nav transition-all duration-500 md:hidden fixed top-0 h-full w-[250px] pr-4 bg-app-secondary overflow-x-hidden overflow-y-auto no-scrollbar z-50">
    <!-- close button -->
    <div class=" h-[120px] sticky top-0 w-full py-4 flex justify-end items-start bg-app-secondary">
        <div class=" side-nav-toggle w-[40px] aspect-square rounded border-2 border-app-primary text-app-primary text-lg flex items-center justify-center cursor-pointer hover:bg-app-primary hover:text-white">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    <!-- navs -->
    <div class=" border-y border-gray-600 divide-y divide-gray-600 *:block uppercase font-semibold">
        <?php foreach ($navLinks as $navLink) { ?>
            <a href="<?php echo $navLink['url'] ?>" class="<?php echo $navLink['isActive'] ? 'text-app-primary bg-black/20 border-app-primary border-l-2' : 'text-white hover:text-app-primary hover:bg-black/20'; ?> py-2 px-6">
                <?php echo $navLink['name'] ?>
            </a>
            <?php if ($navLink['subNav']) { ?>
                <?php foreach ($navLink['subNav'] as $subNav) { ?>
                    <a href="<?php echo $subNav['url'] ?>" class="<?php echo $subNav['isActive'] ? 'text-app-primary bg-black/20 border-app-primary border-l-2' : 'text-white hover:text-app-primary hover:bg-black/20'; ?> py-2 px-6 !flex items-center gap-4">
                        <i class="fa-solid fa-caret-right"></i>
                        <span><?php echo $subNav['name'] ?></span>
                    </a>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<!-- search -->
<div class=" search-container transition-all duration-500 fixed top-0 left-0 w-full h-full flex justify-center items-center z-50">
    <div class=" relative search-overlay transition-all duration-500 w-full h-full bg-black/90 flex justify-center items-center p-4">
        <!-- main -->
        <div class=" main w-full max-w-[600px]">
            <form action="" class=" w-full flex gap-1">
                <input type="search" placeholder="Search Here ..." class=" flex-1 py-4 px-6 outline-none rounded-l-md bg-app-primary text-xl" name="" id="">
                <button class=" w-[60px] flex items-center justify-center rounded-r-md bg-app-secondary text-app-primary hover:bg-app-primary hover:text-white text-xl">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <!-- close -->
        <div class=" absolute top-6 right-6 w-[40px] aspect-square border-2 border-app-primary rounded text-lg flex items-center justify-center text-app-primary hover:text-white hover:bg-app-primary cursor-pointer">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
</div>

<!-- scroll back up button -->
<div class=" scroll-up transition-all duration-500 fixed right-6 w-[40px] aspect-square rounded bg-app-primary/70 text-white hover:bg-app-primary flex items-center justify-center cursor-pointer z-20">
    <i class="fa-solid fa-circle-up"></i>
</div>