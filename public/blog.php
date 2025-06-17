<?php

include './components/header.php';
include './components/top_nav.php';
include './components/showcase.php';

$blogCount = count(fetchAll($pdo, "blog"));

$page = 1;
$limit = 12;

$maxPage = ceil($blogCount / $limit);

if (isset($_GET['page'])) {
    if ((int)$_GET['page'] >= 1 && (int)$_GET['page'] <= $maxPage) {
        $page = (int)$_GET['page'];
    }
}

$blogs = fetchAllWithPagination($pdo, "blog", $limit, $page);
?>

<!-- blog -->
<div class=" py-16 bg-gray-200">
    <div class=" container">
        <div class=" w-full max-w-[500px] m-auto text-center">
            <div class=" text-2xl font-bold font-playfair">Our Blog</div>
            <div class=" mt-2">Insights, Tips & Trends from the Real Estate World</div>
        </div>
        <!--  -->
        <?php if ($blogs) { ?>
            <div class=" mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <?php foreach ($blogs as $blog) { ?>
                    <div class=" group">
                        <div class=" relative aspect-[3/2] overflow-hidden">
                            <img src="<?php echo ($blog['image']) ? './includes/blog/' . htmlspecialchars($blog['image']) : './assets/showcase.png' ?>" class=" w-full h-full object-cover group-hover:scale-110 transition-all duration-500" alt="">
                            <div class=" absolute top-0 left-0 w-full h-full group-hover:bg-black/60 transition-all duration-500"></div>
                            <div class=" absolute bottom-0 right-0 w-[60px] h-[60px] bg-black text-white p-2 text-center">
                                <div class=" text-xl font-semibold"><?php echo htmlspecialchars(date('j', strtotime($blog['created_at']))) ?></div>
                                <div class=" text-sm font-semibold"><?php echo htmlspecialchars(date('M', strtotime($blog['created_at']))) ?></div>
                            </div>
                        </div>
                        <!--  -->
                        <!--  -->
                        <a href="./blog_detail.php?id=<?php echo htmlspecialchars($blog['blog_id']) ?>" class=" mt-2 text-xl font-semibold font-playfair hover:text-app-primary"><?php echo htmlspecialchars($blog['title']) ?></a>
                        <!--  -->
                        <div class=" mt-2 line-clamp-3"><?php echo nl2br(htmlspecialchars($blog['body'])) ?></div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class=" mt-8 text-center text-4xl font-bold text-gray-400">No Blog Found</div>
        <?php } ?>
    </div>
</div>

<!-- pagination -->
<div class=" container py-8 bg-gray-200">
    <div class=" flex items-center justify-between gap-2">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
            <input type="text" name="page" value="<?php echo ($page > 1) ? $page - 1 : 1 ?>" id="prev-page" class=" hidden">
            <button title="previous" class=" py-2 px-4 rounded-md bg-app-secondary/70 hover:bg-app-secondary text-white active:scale-95"><i class="fa-solid fa-angle-left"></i></button>
        </form>
        <div class=" text-sm font-semibold text-gray-500 text-center">Showing <?php echo (empty($blogs)) ? '0' : htmlspecialchars(($page - 1) * $limit + 1) ?> to <?php echo htmlspecialchars(($page - 1) * $limit + count($blogs)) ?> of <?php echo htmlspecialchars($blogCount) ?></div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
            <input type="text" name="page" value="<?php echo ($page < $maxPage) ? $page + 1 : 1 ?>" id="next-page" class=" hidden">
            <button type="submit" title="next" class=" py-2 px-4 rounded-md bg-app-secondary/70 hover:bg-app-secondary text-white active:scale-95"><i class="fa-solid fa-angle-right"></i></button>
        </form>
    </div>
</div>
<!-- end pagination -->

<?php

include './components/footer_main.php';
include './components/footer.php';
?>