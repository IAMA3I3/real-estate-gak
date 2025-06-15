<?php
ob_start();

include './components/header.php';
include './components/top_nav.php';

if (!isset($_GET['id'])) {
    header('Location: ./blog.php');
    exit;
}

$blog = fetchById($pdo, $_GET['id'], "blog", "blog_id");

if (!$blog) {
    header('Location: ./blog.php');
    exit;
}

$blogs = fetchAll($pdo, "blog");

include './components/detail_showcase.php';

ob_end_flush();
?>

<!-- blog detail -->
<div class=" py-16">
    <div class=" container">
        <div class=" flex gap-8 flex-col md:flex-row">
            <!-- main -->
            <div class=" flex-1">
                <div class=" w-full aspect-[3/1] rounded overflow-hidden">
                    <img src="<?php echo ($blog['image']) ? './includes/blog/' . htmlspecialchars($blog['image']) : './assets/showcase.png' ?>" class=" w-full h-full object-cover" alt="">
                </div>
                <!--  -->
                <div class=" mt-4 text-2xl font-semibold font-playfair"><?php echo htmlspecialchars($blog['title']) ?></div>
                <!--  -->
                <div class=" mt-2 flex items-center flex-wrap gap-4">
                    <div class=""><i class="fa-solid fa-calendar-days text-app-primary"></i> <?php echo htmlspecialchars(date('M j', strtotime($blog['created_at']))) ?></div>
                </div>
                <!--  -->
                <div class=" mt-4"><?php echo nl2br(htmlspecialchars($blog['body'])) ?></div>
            </div>
            <!-- side bar -->
            <div class=" w-full md:w-[200px] lg:w-[300px]">
                <!-- search bar -->
                <form action="" class=" w-full">
                    <div class=" w-full rounded-sm overflow-hidden border-2 border-app-secondary flex items-center gap-2">
                        <input type="search" placeholder="Search" class=" flex-1 w-full h-full bg-transparent outline-none py-2 px-6" name="blog-search" id="blog-search">
                        <button type="submit" class=" w-[40px] aspect-square bg-app-secondary text-app-primary hover:bg-app-primary hover:text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
                <!-- recent posts -->
                <div class=" mt-8">
                    <div class=" text-lg font-semibold font-playfair">Recent Post</div>
                    <div class=" mt-4">
                        <?php foreach ($blogs as $i) { ?>
                            <a href="./blog_detail.php?id=<?php echo $i['blog_id'] ?>" class=" my-4 pb-4 border-b border-gray-400 flex items-center gap-4 group">
                                <div class=" relative w-[50px] flex-none aspect-square overflow-hidden">
                                    <img src="<?php echo ($i['image']) ? './includes/blog/' . htmlspecialchars($i['image']) : './assets/showcase.png' ?>" class=" w-full h-full object-cover group-hover:scale-110 transition-all duration-500" alt="">
                                    <div class=" absolute top-0 left-0 w-full h-full group-hover:bg-app-primary/50 transition-all duration-500"></div>
                                </div>
                                <div class=" flex-1 overflow-hidden">
                                    <div class=" text-lg w-full truncate group-hover:text-app-primary"><?php echo htmlspecialchars($i['title']) ?></div>
                                    <div class=" text-app-primary"><?php echo htmlspecialchars(date('j M, Y', strtotime($i['created_at']))) ?></div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include './components/footer_main.php';
include './components/footer.php';
?>