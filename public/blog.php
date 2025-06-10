<?php

include './components/header.php';
include './components/top_nav.php';
include './components/showcase.php';

$blogs = [
    ['blog_id' => 'djjr648fnnher','title' => 'Blog Title', 'body' => 'Lorem ipsum dolor', 'img' => null,'seen' => 9, 'created_at' => '2025-04-28 14:14:01'],
    ['blog_id' => 'djjr648fnnher','title' => 'Blog Title', 'body' => 'Lorem ipsum dolor', 'img' => null,'seen' => 9, 'created_at' => '2025-04-28 14:14:01'],
    ['blog_id' => 'djjr648fnnher','title' => 'Blog Title', 'body' => 'Lorem ipsum dolor', 'img' => null,'seen' => 9, 'created_at' => '2025-04-28 14:14:01']
];
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
                <?php $comments = []; ?>
                <div class=" group">
                    <div class=" relative aspect-[3/2] overflow-hidden">
                        <img src="<?php echo ($blog['img']) ? './includes/blog/' . htmlspecialchars($blog['img']) : './assets/showcase.png' ?>" class=" w-full h-full object-cover group-hover:scale-110 transition-all duration-500" alt="">
                        <div class=" absolute top-0 left-0 w-full h-full group-hover:bg-black/60 transition-all duration-500"></div>
                        <div class=" absolute bottom-0 right-0 w-[60px] h-[60px] bg-black text-white p-2 text-center">
                            <div class=" text-xl font-semibold"><?php echo htmlspecialchars(date('j', strtotime($blog['created_at']))) ?></div>
                            <div class=" text-sm font-semibold"><?php echo htmlspecialchars(date('M', strtotime($blog['created_at']))) ?></div>
                        </div>
                    </div>
                    <!--  -->
                    <div class=" mt-2 flex gap-4 text-sm font-semibold">
                        <div class="">
                            <div class=""><i class="fa-regular fa-eye text-app-primary"></i> <?php echo htmlspecialchars($blog['seen']) ?></div>
                        </div>
                        <div class="">
                            <span class=" text-app-primary"><i class="fa-regular fa-comments"></i></span> <?php echo count($comments) ?>
                        </div>
                    </div>
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

<?php

include './components/footer_main.php';
include './components/footer.php';
?>