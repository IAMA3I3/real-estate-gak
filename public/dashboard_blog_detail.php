<?php
ob_start();

include './components/header.php';
userAccess(['admin']);

if (!isset($_GET['id'])) {
    header('Location: ./dashboard_blog.php');
    exit;
}

$blog = fetchById($pdo, $_GET['id'], "blog", "blog_id");

if (!$blog) {
    header('Location: ./dashboard_blog.php');
    exit;
}

ob_end_flush();
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
            <div class=" w-full aspect-[3/1] rounded overflow-hidden">
                <img src="<?php echo $blog['image'] ? './includes/blog/' . $blog['image'] : './assets/showcase.png' ?>" class=" w-full h-full object-cover" alt="">
            </div>
            <!--  -->
            <div class=" mt-4 text-2xl font-semibold font-playfair"><?php echo htmlspecialchars($blog['title']) ?></div>
            <!--  -->
            <div class=" mt-2 flex items-center flex-wrap gap-4">
                <div class=""><i class="fa-solid fa-calendar-days text-app-primary"></i> <?php echo htmlspecialchars(date('F d', strtotime($blog['created_at']))) ?></div>
                <div class=""><i class="fa-regular fa-comments text-app-primary"></i> 19</div>
                <div class=""><i class="fa-solid fa-eye text-app-primary"></i> <?php echo htmlspecialchars($blog['views']) ?></div>
            </div>
            <!--  -->
            <div class=" mt-4"><?php echo nl2br(htmlspecialchars($blog['body'])) ?></div>
            <!--  -->
            <div class=" mt-4 flex flex-col sm:flex-row md:flex-col lg:flex-row gap-2 *:w-full">
                <a href="./blog_detail.php?id=<?php echo htmlspecialchars($blog['blog_id']) ?>" target="_blank" class=" rounded-sm py-2 px-6 text-xs font-semibold bg-app-secondary text-white hover:bg-app-primary text-center"><i class="fa-solid fa-arrow-up-right-from-square"></i> Go To</a>
                <a href="./blog_edit.php?id=<?php echo htmlspecialchars($blog['blog_id']) ?>" class=" rounded-sm py-2 px-6 text-xs font-semibold border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white text-center"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                <form action="./includes/blog/delete.php" method="post" onsubmit="return confirm('Proceed to delete blog');">
                    <input type="hidden" name="blog_id" value="<?php echo htmlspecialchars($blog['blog_id']) ?>">
                    <button class=" w-full rounded-sm py-2 px-6 text-xs font-semibold border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white"><i class="fa-solid fa-trash-can"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
?>