<?php

$blogs = [
    ['blog_id' => 'djjr648fnnher','title' => 'Blog Title', 'body' => 'Lorem ipsum dolor', 'img' => null,'seen' => 9, 'created_at' => '2025-04-28 14:14:01'],
    ['blog_id' => 'djjr648fnnher','title' => 'Blog Title', 'body' => 'Lorem ipsum dolor', 'img' => null,'seen' => 9, 'created_at' => '2025-04-28 14:14:01'],
    ['blog_id' => 'djjr648fnnher','title' => 'Blog Title', 'body' => 'Lorem ipsum dolor', 'img' => null,'seen' => 9, 'created_at' => '2025-04-28 14:14:01']
];
?>

<!-- footer -->
<div class=" py-8 bg-app-secondary text-white text-sm">
    <div class=" container">
        <div class=" grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!--  -->
            <div class="">
                <img id="footer-logo" src="./assets/logo.png" class=" h-[80px]" alt="">
                <div class=" mt-4">
                    Our team offers the most up-to-date, sustainable all manufacturing allsolutions. teachings of the great explorer of the truth We only source materrials from tried and trusted suppliers.
                </div>
                <div class=" mt-4 flex items-center gap-4">
                    <!-- facebook -->
                    <a href="#" class=" w-[40px] aspect-square rounded border-2 border-app-primary text-app-primary flex justify-center items-center hover:bg-app-primary hover:text-white">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <!-- linked in -->
                    <a href="#" class=" w-[40px] aspect-square rounded border-2 border-app-primary text-app-primary flex justify-center items-center hover:bg-app-primary hover:text-white">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                    <!-- x-twitter -->
                    <a href="#" class=" w-[40px] aspect-square rounded border-2 border-app-primary text-app-primary flex justify-center items-center hover:bg-app-primary hover:text-white">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                    <!-- skype -->
                    <a href="#" class=" w-[40px] aspect-square rounded border-2 border-app-primary text-app-primary flex justify-center items-center hover:bg-app-primary hover:text-white">
                        <i class="fa-brands fa-skype"></i>
                    </a>
                </div>
            </div>
            <!--  -->
            <div class="">
                <div class=" text-2xl font-semibold text-app-primary font-playfair uppercase">Quick Links</div>
                <!-- links -->
                <div class=" mt-4 flex flex-col items-start gap-4">
                    <a href="./index.php" class=" font-semibold hover:text-app-primary tracking-wide">- Home</a>
                    <a href="./about.php" class=" font-semibold hover:text-app-primary tracking-wide">- About Us</a>
                    <a href="./properties.php" class=" font-semibold hover:text-app-primary tracking-wide">- Properties</a>
                    <a href="./properties.php?status=on_going" class=" font-semibold hover:text-app-primary tracking-wide">- On Going</a>
                    <a href="./properties.php?status=completed" class=" font-semibold hover:text-app-primary tracking-wide">- Completed</a>
                    <a href="./blog.php" class=" font-semibold hover:text-app-primary tracking-wide">- Blog</a>
                    <a href="./contact.php" class=" font-semibold hover:text-app-primary tracking-wide">- Contact Us</a>
                </div>
            </div>
            <!--  -->
            <div class="">
                <div class=" text-2xl font-semibold text-app-primary font-playfair uppercase">recent news</div>
                <!-- news -->
                <?php if ($blogs) { ?>
                    <div class=" mt-4">
                        <?php foreach (array_splice($blogs, 0, 3) as $blog) { ?>
                            <a href="./blog_detail.php?id=<?php echo $blog['blog_id'] ?>" class=" my-4 pb-4 border-b border-gray-600 flex items-center gap-4 group">
                                <div class=" relative w-[50px] flex-none aspect-square overflow-hidden">
                                    <img src="<?php echo ($blog['img']) ? './includes/blog/' . htmlspecialchars($blog['img']) : './assets/showcase.png'; ?>" class=" w-full h-full object-cover group-hover:scale-110 transition-all duration-500" alt="">
                                    <div class=" absolute top-0 left-0 w-full h-full group-hover:bg-app-primary/50 transition-all duration-500"></div>
                                </div>
                                <div class=" flex-1 overflow-hidden">
                                    <div class=" text-lg w-full truncate"><?php echo htmlspecialchars($blog['title']) ?></div>
                                    <div class=" text-app-primary"><?php echo htmlspecialchars(date('j M, Y', strtotime($blog['created_at']))) ?></div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class=" mt-4 font-semibold text-gray-500 text-2xl">No Blog Yet</div>
                <?php } ?>
            </div>
            <!--  -->
            <div class="">
                <div class=" text-2xl font-semibold text-app-primary font-playfair uppercase">Keep in Touch</div>
                <!--  -->
                <div class=" mt-4 flex flex-col gap-4">
                    <div class=" flex">
                        <div class=" text-app-primary w-[30px] flex-none">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <span>81, CMD Road, Magodo Phase II, Shangisha, Lagos State.</span>
                    </div>
                    <!--  -->
                    <div class=" flex">
                        <div class=" text-app-primary w-[30px] flex-none">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <span>32, Ajibodu street, Karaole Estate, Ifako Ijaiye, Lagos State.</span>
                    </div>
                    <!--  -->
                    <div class=" flex">
                        <div class=" text-app-primary w-[30px] flex-none">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <span>2 Batchelor Street Chatham, Kent ME4 4BJ</span>
                    </div>
                    <!--  -->
                    <a href="mailto:info@gadekelanichambers.com" class=" flex">
                        <div class=" text-app-primary w-[30px] flex-none">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <span>info@gadekelanichambers.com</span>
                    </a>
                    <!--  -->
                    <a href="tel:+2348023345854" class=" flex">
                        <div class=" text-app-primary w-[30px] flex-none">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <span>(+234) 802 3345 854</span>
                    </a>
                </div>
            </div>
            <!--  -->
        </div>
    </div>
</div>
<!--  -->
<div class=" bg-app-secondary text-app-primary font-semibold">
    <div class=" bg-black/30 py-4">
        <div class=" container">
            <div class=" text-center">&copy; <?php echo date("Y") ?> All Rights Reserved.</div>
        </div>
    </div>
</div>