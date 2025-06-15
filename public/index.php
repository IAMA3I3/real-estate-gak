<?php

include './components/header.php';
include './components/top_nav.php';

$showcaseSlides = [
    ['img' => './assets/house-1.jpg', 'text' => 'Premium Houses', 'subtext' => 'Provide a decent level of confort', 'button_name' => 'Contact Us', 'button_url' => './contact.php'],
    ['img' => './assets/house-2.jpg', 'text' => 'Elite Residences', 'subtext' => 'Find your dream house', 'button_name' => 'Contact Us', 'button_url' => './contact.php'],
    ['img' => './assets/house-3.jpg', 'text' => 'Luxury Residences', 'subtext' => 'Living in your life style', 'button_name' => 'Contact Us', 'button_url' => './contact.php'],
];

$locations = fetchAll($pdo, "locations");

$ongoing = fetchAllBy($pdo, "properties", "status", "ongoing");
$completed = fetchAllBy($pdo, "properties", "status", "completed");
$upcoming = fetchAllBy($pdo, "properties", "status", "upcoming");

$blogs = fetchAll($pdo, "blog");
?>

<!-- showcase -->
<div class=" h-[80vh] relative">
    <div class=" h-full w-full relative overflow-hidden">
        <!-- <video src="./assets/showcase.mp4" autoplay loop class=" w-full h-full object-cover"></video> -->
        <video autoplay loop muted playsinline class=" w-full h-full object-cover">
            <source src="./assets/showcase.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class=" absolute top-0 left-0 w-full h-full bg-gradient-to-r from-black/60 to-black/10 text-white">
            <div class=" container h-full">
                <div class=" pl-0 md:pl-36 pr-32 md:pr-36 h-full">
                    <div class=" h-full flex flex-col items-start justify-center">
                        <div class=" text-2xl md:text-5xl font-bold text-app-primary font-playfair">Premium Houses</div>
                        <div class=" mt-4 text-xl md:text-3xl font-bold">Provide a decent level of confort</div>
                        <a href="./contact.php" class=" mt-6 flex items-center justify-between sm:justify-normal md:text-lg gap-2 text-app-primary font-semibold hover:text-white transition border py-3 px-5 border-app-primary group bg-transparent relative">
                            <div class=" absolute top-0 left-0 bg-app-primary rounded-r-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                            <div class=" absolute top-0 right-0 bg-app-primary rounded-l-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                            <span class=" z-10">Contact Us</span>
                            <i class="fa-solid fa-arrow-right z-10"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" absolute top-[50%] -translate-y-[50%] left-0 z-10 text-white hidden md:flex items-center gap-8 rotate-90">
        <div class="">FOLLOW US</div>
        <div class=" h-[2px] w-10 bg-white"></div>
        <div class=" flex items-center gap-4">
            <a href="#" class=" hover:text-app-primary -rotate-90"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class=" hover:text-app-primary -rotate-90"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#" class=" hover:text-app-primary -rotate-90"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
    </div>
</div>

<!--  -->
<div class=" container">
    <div class=" -mt-20 sm:-mt-12 md:-mt-20 flex flex-col sm:flex-row items-center gap-4 *:w-full">
        <a href="./properties.php?status=ongoing" class=" group z-10 aspect-[2/1] rounded-xl border-2 border-app-secondary hover:border-app-primary p-2">
            <div class=" relative w-full h-full rounded-lg bg-white shadow overflow-hidden">
                <img src="./assets/ongoing.webp" class=" w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="">
                <div class=" absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/85 from-40% p-4 flex flex-col justify-end">
                    <div class=" text-white font-semibold text-xl group-hover:text-app-primary">Ongoing</div>
                </div>
            </div>
        </a>
        <a href="./properties.php?status=completed&type=rental" class=" group z-10 aspect-[2/1] rounded-xl border-2 border-app-secondary hover:border-app-primary p-2">
            <div class=" relative w-full h-full rounded-lg bg-white shadow overflow-hidden">
                <img src="./assets/house-2.jpg" class=" w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="">
                <div class=" absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/85 from-40% p-4 flex flex-col justify-end">
                    <div class=" text-white font-semibold text-xl group-hover:text-app-primary">Rentals</div>
                </div>
            </div>
        </a>
        <a href="./properties.php?status=completed&type=sale" class=" group z-10 aspect-[2/1] rounded-xl border-2 border-app-secondary hover:border-app-primary p-2">
            <div class=" relative w-full h-full rounded-lg bg-white shadow overflow-hidden">
                <img src="./assets/house-1.jpg" class=" w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="">
                <div class=" absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/85 from-40% p-4 flex flex-col justify-end">
                    <div class=" text-white font-semibold text-xl group-hover:text-app-primary">Sales</div>
                </div>
            </div>
        </a>
    </div>
</div>


<!-- explore by location -->
<div class=" py-16">
    <div class=" container">
        <div class=" w-full max-w-[600px]">
            <div class=" font-semibold">EXPLORE BY LOCATION</div>
            <div class=" mt-2 text-2xl font-bold font-playfair text-app-primary">Your Ideal Home Starts with the Right Location</div>
        </div>
        <?php if (empty($locations)) { ?>
            <div class=" my-8 text-center font-bold text-2xl text-gray-300">Nothing here yet</div>
        <?php } else { ?>
            <div class=" mt-4 flex flex-col md:flex-row gap-4 *:w-full">
                <?php foreach (array_slice($locations, 0, 3) as $location) { ?>
                    <div class=" relative aspect-[3/2] shadow rounded overflow-hidden group">
                        <img src="<?php echo $location['image'] ? './includes/location/' . $location['image'] : './assets/showcase.png' ?>" class=" w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="">
                        <div class=" absolute top-0 left-0 w-full h-full bg-gradient-to-b from-black/85 via-transparent to-black/85 p-4 flex flex-col justify-between items-start text-white">
                            <div class=" text-lg font-semibold"><?php echo htmlspecialchars($location['name']) ?></div>
                            <a href="./properties.php?location_id=<?php echo htmlspecialchars($location['location_id']) ?>" class=" mt-6 flex items-center justify-between sm:justify-normal md:text-lg gap-2 text-app-primary font-semibold hover:text-white transition border py-3 px-5 border-app-primary group/link bg-transparent relative">
                                <div class=" absolute top-0 left-0 bg-app-primary rounded-r-md h-full w-0 group-hover/link:w-[60%] transition-all duration-500"></div>
                                <div class=" absolute top-0 right-0 bg-app-primary rounded-l-md h-full w-0 group-hover/link:w-[60%] transition-all duration-500"></div>
                                <span class=" z-10">See Properties</span>
                                <i class="fa-solid fa-arrow-right z-10"></i>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class=" mt-4 flex flex-col md:flex-row gap-4 *:w-full">
                <?php foreach (array_slice($locations, 3, 2) as $location) { ?>
                    <div class=" relative aspect-[3/1] shadow rounded overflow-hidden group">
                        <img src="<?php echo $location['image'] ? './includes/location/' . $location['image'] : './assets/showcase.png' ?>" class=" w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="">
                        <div class=" absolute top-0 left-0 w-full h-full bg-gradient-to-b from-black/85 via-transparent to-black/85 p-4 flex flex-col justify-between items-start text-white">
                            <div class=" text-lg font-semibold"><?php echo htmlspecialchars($location['name']) ?></div>
                            <a href="./properties.php?location_id=<?php echo htmlspecialchars($location['location_id']) ?>" class=" mt-6 flex items-center justify-between sm:justify-normal md:text-lg gap-2 text-app-primary font-semibold hover:text-white transition border py-1 px-4 border-app-primary group/link bg-transparent relative">
                                <div class=" absolute top-0 left-0 bg-app-primary rounded-r-md h-full w-0 group-hover/link:w-[60%] transition-all duration-500"></div>
                                <div class=" absolute top-0 right-0 bg-app-primary rounded-l-md h-full w-0 group-hover/link:w-[60%] transition-all duration-500"></div>
                                <span class=" z-10">See Properties</span>
                                <i class="fa-solid fa-arrow-right z-10"></i>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>


<!-- ongoing projects -->
<div class=" py-16 bg-gray-200">
    <div class=" container">
        <div class=" w-full max-w-[600px] m-auto text-center">
            <div class=" font-semibold">ONGOING PROJECTS</div>
            <div class=" mt-2 text-2xl font-bold font-playfair text-app-primary">See What We’re Building Right Now</div>
        </div>
        <?php if (empty($ongoing)) { ?>
            <div class=" my-8 text-center font-bold text-2xl text-gray-400">Nothing here yet</div>
        <?php } else { ?>
            <div class=" mt-8 w-full">
                <div class=" relative swiper primary-swiper">
                    <div class=" swiper-wrapper">
                        <?php foreach (array_slice($ongoing, 0, 6) as $property) { ?>
                            <div class=" swiper-slide">
                                <div class=" group rounded shadow bg-white overflow-hidden">
                                    <div class=" aspect-[3/2] overflow-hidden">
                                        <div class=" w-full h-full relative">
                                            <?php
                                            // Get first media file (could be image or video)
                                            $firstMedia = null;
                                            $isVideo = false;

                                            if ($property['images']) {
                                                $firstMedia = explode(', ', $property['images'])[0];
                                                // Check if it's a video file
                                                $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv'];
                                                $fileExtension = strtolower(pathinfo($firstMedia, PATHINFO_EXTENSION));
                                                $isVideo = in_array($fileExtension, $videoExtensions);
                                            }

                                            if ($firstMedia && $isVideo) { ?>
                                                <video class=" w-full h-full object-cover" muted>
                                                    <source src="<?php echo './includes/property/' . htmlspecialchars($firstMedia) ?>" type="video/<?php echo $fileExtension ?>">
                                                </video>
                                                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
                                                    <i class="fa-solid fa-play text-white text-lg"></i>
                                                </div>
                                            <?php } elseif ($firstMedia) { ?>
                                                <img src="<?php echo './includes/property/' . htmlspecialchars($firstMedia) ?>" class=" w-full h-full object-cover" alt="">
                                            <?php } else { ?>
                                                <img src="./assets/showcase.png" class=" w-full h-full object-cover" alt="">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class=" p-4">
                                        <a href="./property_detail.php?id=<?php echo htmlspecialchars($property['property_id']) ?>" class=" text-lg font-semibold hover:text-app-primary"><?php echo htmlspecialchars($property['name']) ?></a>
                                        <div class=" flex">
                                            <div class=" text-app-primary w-[30px] flex-none">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </div>
                                            <span><?php echo htmlspecialchars($property['address']) ?></span>
                                        </div>
                                        <div class=" mt-4 flex flex-wrap gap-4">
                                            <?php if ($property['size']) { ?>
                                                <div class=" rounded py-1 px-3 bg-gray-200 flex items-center gap-2 flex-nowrap text-nowrap text-sm font-semibold">
                                                    <i class="fa-solid fa-expand"></i>
                                                    <div class="">Size: <span class=" text-app-primary"><?php echo htmlspecialchars($property['size']) ?> sqm</span></div>
                                                </div>
                                            <?php } ?>
                                            <?php if ($property['bedroom']) { ?>
                                                <div class=" rounded py-1 px-3 bg-gray-200 flex items-center gap-2 flex-nowrap text-nowrap text-sm font-semibold">
                                                    <i class="fa-solid fa-bed"></i>
                                                    <div class="">Bedrooms: <span class=" text-app-primary"><?php echo htmlspecialchars($property['bedroom']) ?></span></div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!--  -->
        <div class=" mt-8 flex justify-center">
            <div class=" inline-block">
                <a href="./properties.php?status=ongoing" class=" flex items-center justify-between sm:justify-normal md:text-lg gap-2 text-app-primary font-semibold hover:text-white transition border py-3 px-5 border-app-primary group bg-transparent relative">
                    <div class=" absolute top-0 left-0 bg-app-primary rounded-r-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                    <div class=" absolute top-0 right-0 bg-app-primary rounded-l-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                    <span class=" z-10 uppercase">View All</span>
                    <i class="fa-solid fa-arrow-right z-10"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- completed projects -->
<div class=" py-16">
    <div class=" container">
        <div class=" w-full max-w-[600px] m-auto text-center">
            <div class=" font-semibold">COMPLETED PROJECTS</div>
            <div class=" mt-2 text-2xl font-bold font-playfair text-app-primary">Discover the Legacy We've Already Built</div>
        </div>
        <?php if (empty($completed)) { ?>
            <div class=" my-8 text-center font-bold text-2xl text-gray-400">Nothing here yet</div>
        <?php } else { ?>
            <div class=" mt-8 w-full">
                <div class=" relative swiper primary-swiper">
                    <div class=" swiper-wrapper">
                        <?php foreach (array_slice($completed, 0, 6) as $property) { ?>
                            <div class=" swiper-slide">
                                <div class=" group rounded shadow bg-white overflow-hidden">
                                    <div class=" aspect-[3/2] overflow-hidden">
                                        <div class=" w-full h-full relative">
                                            <?php
                                            // Get first media file (could be image or video)
                                            $firstMedia = null;
                                            $isVideo = false;

                                            if ($property['images']) {
                                                $firstMedia = explode(', ', $property['images'])[0];
                                                // Check if it's a video file
                                                $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv'];
                                                $fileExtension = strtolower(pathinfo($firstMedia, PATHINFO_EXTENSION));
                                                $isVideo = in_array($fileExtension, $videoExtensions);
                                            }

                                            if ($firstMedia && $isVideo) { ?>
                                                <video class=" w-full h-full object-cover" muted>
                                                    <source src="<?php echo './includes/property/' . htmlspecialchars($firstMedia) ?>" type="video/<?php echo $fileExtension ?>">
                                                </video>
                                                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
                                                    <i class="fa-solid fa-play text-white text-lg"></i>
                                                </div>
                                            <?php } elseif ($firstMedia) { ?>
                                                <img src="<?php echo './includes/property/' . htmlspecialchars($firstMedia) ?>" class=" w-full h-full object-cover" alt="">
                                            <?php } else { ?>
                                                <img src="./assets/showcase.png" class=" w-full h-full object-cover" alt="">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class=" p-4">
                                        <a href="./property_detail.php?id=<?php echo htmlspecialchars($property['property_id']) ?>" class=" text-lg font-semibold hover:text-app-primary"><?php echo htmlspecialchars($property['name']) ?></a>
                                        <div class=" flex">
                                            <div class=" text-app-primary w-[30px] flex-none">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </div>
                                            <span><?php echo htmlspecialchars($property['address']) ?></span>
                                        </div>
                                        <div class=" mt-4 flex flex-wrap gap-4">
                                            <?php if ($property['size']) { ?>
                                                <div class=" rounded py-1 px-3 bg-gray-200 flex items-center gap-2 flex-nowrap text-nowrap text-sm font-semibold">
                                                    <i class="fa-solid fa-expand"></i>
                                                    <div class="">Size: <span class=" text-app-primary"><?php echo htmlspecialchars($property['size']) ?> sqm</span></div>
                                                </div>
                                            <?php } ?>
                                            <?php if ($property['bedroom']) { ?>
                                                <div class=" rounded py-1 px-3 bg-gray-200 flex items-center gap-2 flex-nowrap text-nowrap text-sm font-semibold">
                                                    <i class="fa-solid fa-bed"></i>
                                                    <div class="">Bedrooms: <span class=" text-app-primary"><?php echo htmlspecialchars($property['bedroom']) ?></span></div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!--  -->
        <div class=" mt-8 flex justify-center">
            <div class=" inline-block">
                <a href="./properties.php?status=completed" class=" flex items-center justify-between sm:justify-normal md:text-lg gap-2 text-app-primary font-semibold hover:text-white transition border py-3 px-5 border-app-primary group bg-transparent relative">
                    <div class=" absolute top-0 left-0 bg-app-primary rounded-r-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                    <div class=" absolute top-0 right-0 bg-app-primary rounded-l-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                    <span class=" z-10 uppercase">View All</span>
                    <i class="fa-solid fa-arrow-right z-10"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- upcoming projects -->
<div class=" py-16 bg-gray-200">
    <div class=" container">
        <div class=" w-full max-w-[600px] m-auto text-center">
            <div class=" font-semibold">UPCOMING PROJECTS</div>
            <div class=" mt-2 text-2xl font-bold font-playfair text-app-primary">Exciting New Developments Launching Soon</div>
        </div>
        <?php if (empty($upcoming)) { ?>
            <div class=" my-8 text-center font-bold text-2xl text-gray-400">Nothing here yet</div>
        <?php } else { ?>
            <div class=" mt-8 w-full">
                <div class=" relative swiper primary-swiper">
                    <div class=" swiper-wrapper">
                        <?php foreach (array_slice($upcoming, 0, 6) as $property) { ?>
                            <div class=" swiper-slide">
                                <div class=" group rounded shadow bg-white overflow-hidden">
                                    <div class=" aspect-[3/2] overflow-hidden">
                                        <div class=" w-full h-full relative">
                                            <?php
                                            // Get first media file (could be image or video)
                                            $firstMedia = null;
                                            $isVideo = false;

                                            if ($property['images']) {
                                                $firstMedia = explode(', ', $property['images'])[0];
                                                // Check if it's a video file
                                                $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv'];
                                                $fileExtension = strtolower(pathinfo($firstMedia, PATHINFO_EXTENSION));
                                                $isVideo = in_array($fileExtension, $videoExtensions);
                                            }

                                            if ($firstMedia && $isVideo) { ?>
                                                <video class=" w-full h-full object-cover" muted>
                                                    <source src="<?php echo './includes/property/' . htmlspecialchars($firstMedia) ?>" type="video/<?php echo $fileExtension ?>">
                                                </video>
                                                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
                                                    <i class="fa-solid fa-play text-white text-lg"></i>
                                                </div>
                                            <?php } elseif ($firstMedia) { ?>
                                                <img src="<?php echo './includes/property/' . htmlspecialchars($firstMedia) ?>" class=" w-full h-full object-cover" alt="">
                                            <?php } else { ?>
                                                <img src="./assets/showcase.png" class=" w-full h-full object-cover" alt="">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class=" p-4">
                                        <a href="./property_detail.php?id=<?php echo htmlspecialchars($property['property_id']) ?>" class=" text-lg font-semibold hover:text-app-primary"><?php echo htmlspecialchars($property['name']) ?></a>
                                        <div class=" flex">
                                            <div class=" text-app-primary w-[30px] flex-none">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </div>
                                            <span><?php echo htmlspecialchars($property['address']) ?></span>
                                        </div>
                                        <div class=" mt-4 flex flex-wrap gap-4">
                                            <?php if ($property['size']) { ?>
                                                <div class=" rounded py-1 px-3 bg-gray-200 flex items-center gap-2 flex-nowrap text-nowrap text-sm font-semibold">
                                                    <i class="fa-solid fa-expand"></i>
                                                    <div class="">Size: <span class=" text-app-primary"><?php echo htmlspecialchars($property['size']) ?> sqm</span></div>
                                                </div>
                                            <?php } ?>
                                            <?php if ($property['bedroom']) { ?>
                                                <div class=" rounded py-1 px-3 bg-gray-200 flex items-center gap-2 flex-nowrap text-nowrap text-sm font-semibold">
                                                    <i class="fa-solid fa-bed"></i>
                                                    <div class="">Bedrooms: <span class=" text-app-primary"><?php echo htmlspecialchars($property['bedroom']) ?></span></div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!--  -->
        <div class=" mt-8 flex justify-center">
            <div class=" inline-block">
                <a href="./properties.php?status=upcoming" class=" flex items-center justify-between sm:justify-normal md:text-lg gap-2 text-app-primary font-semibold hover:text-white transition border py-3 px-5 border-app-primary group bg-transparent relative">
                    <div class=" absolute top-0 left-0 bg-app-primary rounded-r-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                    <div class=" absolute top-0 right-0 bg-app-primary rounded-l-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                    <span class=" z-10 uppercase">View All</span>
                    <i class="fa-solid fa-arrow-right z-10"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- blog -->
<div class=" py-16">
    <div class=" container">
        <div class=" w-full max-w-[600px] m-auto text-center">
            <div class=" font-semibold">OUR BLOG</div>
            <div class=" mt-2 text-2xl font-bold font-playfair text-app-primary">Insights, Tips & Trends from the Real Estate World</div>
        </div>
        <!--  -->
        <?php if ($blogs) { ?>
            <div class=" mt-8 flex flex-wrap justify-center gap-8 *:w-full *:max-w-[350px]">
                <?php foreach (array_slice($blogs, 0, 3) as $blog) { ?>
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

<?php

include './components/footer_main.php';
include './components/footer.php';
?>