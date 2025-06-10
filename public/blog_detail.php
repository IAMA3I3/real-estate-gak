<?php
ob_start();

include './components/header.php';
include './components/top_nav.php';

if (!isset($_GET['id'])) {
    header('Location: ./blog.php');
    exit;
}

$blog = ['blog_id' => 'djjr648fnnher', 'title' => 'Blog Title', 'body' => 'Lorem ipsum dolor', 'img' => null, 'seen' => 9, 'created_at' => '2025-04-28 14:14:01'];

if (!$blog) {
    header('Location: ./blog.php');
    exit;
}

$blogs = [
    ['blog_id' => 'djjr648fnnher', 'title' => 'Blog Title', 'body' => 'Lorem ipsum dolor', 'img' => null, 'seen' => 9, 'created_at' => '2025-04-28 14:14:01'],
    ['blog_id' => 'djjr648fnnher', 'title' => 'Blog Title', 'body' => 'Lorem ipsum dolor', 'img' => null, 'seen' => 9, 'created_at' => '2025-04-28 14:14:01'],
    ['blog_id' => 'djjr648fnnher', 'title' => 'Blog Title', 'body' => 'Lorem ipsum dolor', 'img' => null, 'seen' => 9, 'created_at' => '2025-04-28 14:14:01']
];

$comments = [];

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
                    <img src="<?php echo ($blog['img']) ? './includes/blog/' . htmlspecialchars($blog['img']) : './assets/showcase.png' ?>" class=" w-full h-full object-cover" alt="">
                </div>
                <!--  -->
                <div class=" mt-4 text-2xl font-semibold font-playfair"><?php echo htmlspecialchars($blog['title']) ?></div>
                <!--  -->
                <div class=" mt-2 flex items-center flex-wrap gap-4">
                    <div class=""><i class="fa-solid fa-calendar-days text-app-primary"></i> <?php echo htmlspecialchars(date('M j', strtotime($blog['created_at']))) ?></div>
                    <div class=""><i class="fa-regular fa-comments text-app-primary"></i> <?php echo count($comments) ?></div>
                    <div class=""><i class="fa-regular fa-eye text-app-primary"></i> <?php echo htmlspecialchars($blog['seen']) ?></div>
                </div>
                <!--  -->
                <div class=" mt-4"><?php echo nl2br(htmlspecialchars($blog['body'])) ?></div>
                <!-- comments -->
                <div class=" mt-16">
                    <div class=" text-xl font-semibold font-playfair">Comment</div>
                    <div class=" mt-2 p-4 border rounded border-gray-300 divide-y divide-gray-300">
                        <?php if (!$comments) { ?>
                            <!--  -->
                            <div class=" text-center font-bold text-3xl text-gray-300">No Comment Yet</div>
                            <!--  -->
                        <?php } else { ?>
                            <?php foreach ($comments as $comment) { ?>
                                <div class=" my-2 flex gap-4">
                                    <div class=" text-2xl text-app-primary">
                                        <i class="fa-solid fa-user pt-2"></i>
                                    </div>
                                    <div class="">
                                        <div class=" text-lg font-semibold font-playfair"><?php echo htmlspecialchars($comment['user_name']) ?></div>
                                        <div class=" text-sm font-semibold text-gray-500"><?php echo htmlspecialchars(date('j M, Y', strtotime($comment['created_at']))) ?></div>
                                        <div class=" mt-2"><?php echo nl2br(htmlspecialchars($comment['message'])) ?></div>
                                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] === 1) { ?>
                                            <form action="./includes/blog/delete-comment.php" class=" mt-2" method="post" onsubmit="confirm('Procceed to delete comment');">
                                                <input type="hidden" name="id" value="<?php echo $comment['id'] ?>">
                                                <input type="hidden" name="blog_id" value="<?php echo $blog['id'] ?>">
                                                <button class=" text-sm font-semibold text-red-500">Delete</button>
                                            </form>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!--  -->
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class=" mt-8 text-xl font-semibold font-playfair">Leave a comment</div>
                    <div class=" w-full h-[1px] bg-gray-300"></div>
                    <form action="./includes/blog/add-comment.php" method="post" class=" mt-8 w-full">
                        <input type="hidden" name="blog_id" value="<?php echo $blog['blog_id'] ?>">
                        <input type="text" placeholder="Your Name*" value="<?php echo (isset($_SESSION['inputData']['name']) && !isset($_SESSION['errors']['name'])) ? htmlspecialchars($_SESSION['inputData']['name']) : '' ?>" class=" outline-none pb-2 border-b border-gray-400 bg-transparent w-full focus:border-app-primary mt-4" name="name" id="name">
                        <?php if (isset($_SESSION['errors']['name'])) { ?>
                            <div class=" text-sm font-semibold text-red-500 mb-2"><?php echo $_SESSION['errors']['name'] ?></div>
                        <?php } ?>
                        <input type="email" placeholder="Email*" value="<?php echo (isset($_SESSION['inputData']['email']) && !isset($_SESSION['errors']['email'])) ? htmlspecialchars($_SESSION['inputData']['email']) : '' ?>" class=" outline-none pb-2 border-b border-gray-400 bg-transparent w-full focus:border-app-primary mt-4" name="email" id="email">
                        <?php if (isset($_SESSION['errors']['email'])) { ?>
                            <div class=" text-sm font-semibold text-red-500 mb-2"><?php echo $_SESSION['errors']['email'] ?></div>
                        <?php } ?>
                        <input type="tel" placeholder="Phone No." value="<?php echo (isset($_SESSION['inputData']['phone']) && !isset($_SESSION['errors']['phone'])) ? htmlspecialchars($_SESSION['inputData']['phone']) : '' ?>" class=" outline-none pb-2 border-b border-gray-400 bg-transparent w-full focus:border-app-primary mt-4" name="phone" id="phone">
                        <?php if (isset($_SESSION['errors']['phone'])) { ?>
                            <div class=" text-sm font-semibold text-red-500 mb-2"><?php echo $_SESSION['errors']['phone'] ?></div>
                        <?php } ?>
                        <label class=" mt-8 text-gray-500" for="message">Comment</label>
                        <textarea name="message" id="message" class=" w-full min-h-[150px] bg-app-primary/5 border border-app-primary/15 focus:border-app-primary focus:bg-app-primary/10 resize-y outline-none p-2"><?php echo (isset($_SESSION['inputData']['message']) && !isset($_SESSION['errors']['message'])) ? htmlspecialchars($_SESSION['inputData']['message']) : '' ?></textarea>
                        <?php if (isset($_SESSION['errors']['message'])) { ?>
                            <div class=" text-sm font-semibold text-red-500 mb-2"><?php echo $_SESSION['errors']['message'] ?></div>
                        <?php } ?>
                        <div class=" inline-block mt-4">
                            <button type="submit" class=" flex items-center justify-between sm:justify-normal md:text-lg gap-2 text-app-primary font-semibold hover:text-white transition border py-3 px-5 border-app-primary group bg-transparent relative">
                                <div class=" absolute top-0 left-0 bg-app-primary rounded-r-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                                <div class=" absolute top-0 right-0 bg-app-primary rounded-l-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                                <span class=" z-10 uppercase">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
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
                                    <img src="<?php echo ($i['img']) ? './includes/blog/' . htmlspecialchars($i['img']) : './assets/showcase.png' ?>" class=" w-full h-full object-cover group-hover:scale-110 transition-all duration-500" alt="">
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