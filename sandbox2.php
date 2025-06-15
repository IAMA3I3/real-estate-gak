<!-- properties -->

<?php

include './components/header.php';
include './components/top_nav.php';
include './components/showcase.php';

$propertiesCount = count(fetchAll($pdo, "properties"));

$page = 1;
$limit = 12;

$maxPage = ceil($propertiesCount / $limit);

if (isset($_GET['page'])) {
    if ((int)$_GET['page'] >= 1 && (int)$_GET['page'] <= $maxPage) {
        $page = (int)$_GET['page'];
    }
}

$properties = fetchAllWithPagination($pdo, "properties", $limit, $page);

$locations = fetchAll($pdo, "locations");
?>

<div class=" py-16">
    <div class=" container">
        <div class=" w-full max-w-[500px] m-auto text-center">
            <div class=" text-2xl font-bold font-playfair">Our Properties</div>
            <div class=" mt-2">Find the Perfect Property for Your Needs</div>
        </div>
        <!--  -->
        <?php if (empty($properties)) { ?>
            <div class=" mt-8 text-center text-4xl font-bold text-gray-400">No Properties Found</div>
        <?php } else { ?>
            <div class=" mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-8">
                <?php foreach ($properties as $property) { ?>
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
                <?php } ?>
            </div>
            <!-- pagination -->
            <div class=" container py-8">
                <div class=" flex items-center justify-between gap-2">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                        <input type="text" name="page" value="<?php echo ($page > 1) ? $page - 1 : 1 ?>" id="prev-page" class=" hidden">
                        <button title="previous" class=" py-2 px-4 rounded-md bg-app-secondary/70 hover:bg-app-secondary text-white active:scale-95"><i class="fa-solid fa-angle-left"></i></button>
                    </form>
                    <div class=" text-sm font-semibold text-gray-300 text-center">Showing <?php echo (empty($properties)) ? '0' : htmlspecialchars(($page - 1) * $limit + 1) ?> to <?php echo htmlspecialchars(($page - 1) * $limit + 1) + (count($properties) - 1) ?> of <?php echo htmlspecialchars($propertiesCount) ?></div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                        <input type="text" name="page" value="<?php echo ($page < $maxPage) ? $page + 1 : 1 ?>" id="next-page" class=" hidden">
                        <button type="submit" title="next" class=" py-2 px-4 rounded-md bg-app-secondary/70 hover:bg-app-secondary text-white active:scale-95"><i class="fa-solid fa-angle-right"></i></button>
                    </form>
                </div>
            </div>
            <!-- end pagination -->
        <?php } ?>
    </div>
</div>

<div class=" py-16 bg-gray-200">
    <div class=" container">
        <div class=" w-full max-w-[500px] m-auto text-center">
            <div class=" text-2xl font-bold font-playfair">Explore Our Properties</div>
            <div class=" mt-2">Browse a wide range of properties - from ongoing developments to ready-to-rent and for-sale listings</div>
        </div>
        <!--  -->
        <div class=" mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 *:w-full">
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
            <a href="./properties.php?status=upcoming" class=" group z-10 aspect-[2/1] rounded-xl border-2 border-app-secondary hover:border-app-primary p-2">
                <div class=" relative w-full h-full rounded-lg bg-white shadow overflow-hidden">
                    <img src="./assets/house-3.jpg" class=" w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="">
                    <div class=" absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/85 from-40% p-4 flex flex-col justify-end">
                        <div class=" text-white font-semibold text-xl group-hover:text-app-primary">Upcoming</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class=" py-16">
    <div class=" container">
        <div class=" w-full max-w-[500px] m-auto text-center">
            <div class=" text-2xl font-bold font-playfair">EXPLORE BY LOCATION</div>
            <div class=" mt-2">Your Ideal Home Starts with the Right Location</div>
        </div>
        <!--  -->
        <?php if (empty($locations)) { ?>
            <div class=" my-8 text-center font-bold text-2xl text-gray-300">Nothing here yet</div>
        <?php } else { ?>
            <div class=" mt-8 w-full">
                <div class=" relative swiper primary-swiper">
                    <div class=" swiper-wrapper">
                        <?php foreach ($locations as $location) { ?>
                            <div class=" swiper-slide">
                                <div class=" relative w-full aspect-[3/2] shadow rounded overflow-hidden group">
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
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php

include './components/footer_main.php';
include './components/footer.php';
?>

























<!-- propert_detail -->
<?php
ob_start();

include './components/header.php';
include './components/top_nav.php';

if (!isset($_GET['id'])) {
    header('Location: ./properties.php');
    exit;
}

$property = fetchById($pdo, $_GET['id'], "properties", "property_id");

if (!$property) {
    header('Location: ./properties.php');
    exit;
}

$propertyImages = explode(', ', $property['images']);

$properties = fetchAll($pdo, "properties");

include './components/detail_showcase.php';

ob_end_flush();
?>

<!--  -->
<div class=" py-16">
    <div class=" container">
        <div class=" text-2xl font-bold font-playfair mb-2"><?php echo htmlspecialchars($property['title']) ?></div>
        <div class=" flex flex-wrap gap-2">
            <?php if ($property['status']) { ?>
                <div class=" py-1 px-3 rounded bg-app-primary text-white text-sm font-semibold uppercase"><?php echo htmlspecialchars($property['status']) ?></div>
            <?php } ?>
            <?php if ($property['type']) { ?>
                <div class=" py-1 px-3 rounded bg-app-secondary text-white text-sm font-semibold uppercase"><?php echo htmlspecialchars($property['type']) ?></div>
            <?php } ?>
        </div>
        <div class=" mt-2 text-sm text-gray-500 flex gap-2">
            <div class="">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div class=""><?php echo htmlspecialchars($property['location']) ?></div>
        </div>
    </div>
</div>

<!-- images -->
<div class="">
    <div class=" container">
        <div class=" w-full max-w-[800px] m-auto lg:flex-1 p-2 rounded-lg bg-white">
            <div id="property-pic" data-index="0" class=" relative w-full rounded-md aspect-[3/2] overflow-hidden group cursor-pointer">
                <img src="./assets/showcase.png" class=" w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="">
                <div class=" absolute top-0 left-0 w-full h-full flex justify-center items-center">
                    <div class=" invisible opacity-0 w-0 group-hover:visible group-hover:opacity-100 group-hover:w-[60px] transition-all duration-500 aspect-square rounded-full border-white border-2 bg-black/20 text-white flex justify-center items-center text-lg"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
                </div>
            </div>
            <div class=" mt-2 grid grid-cols-4 gap-2">
                <?php for ($i = 0; $i < count(array_slice($propertyImages, 0, 4)); $i++) { ?>
                    <div id="property-pic-thumb" class="<?php echo $i === 0 ? 'active' : '' ?> relative cursor-pointer w-full aspect-[3/2] rounded-md overflow-hidden">
                        <img src="<?php echo htmlspecialchars($propertyImages[$i]) ?>" class=" w-full h-full object-cover" alt="">
                        <?php if (count(explode(', ', $property['img'])) > 4 && $i === 3) { ?>
                            <div class=" absolute top-0 left-0 w-full h-full bg-black/80 flex justify-center items-center text-white">
                                <div class=" font-semibold text-sm">+ <?php echo count(explode(', ', $property['img'])) - 4 ?> More</div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?php for ($i = 0; $i < count($propertyImages); $i++) { ?>
                    <div id="property-pic-thumb-all" class="<?php echo $i === 0 ? 'active' : '' ?> hidden relative cursor-pointer w-full aspect-[3/2] rounded-md overflow-hidden">
                        <img src="<?php echo htmlspecialchars($propertyImages[$i]) ?>" class=" w-full h-full object-cover" alt="">
                        <?php if (count(explode(', ', $property['img'])) > 4 && $i === 3) { ?>
                            <div class=" absolute top-0 left-0 w-full h-full bg-black/80 flex justify-center items-center text-white">
                                <div class=" font-semibold text-sm">+ <?php echo count(explode(', ', $property['img'])) - 4 ?> More</div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- description -->
<div class=" py-16">
    <div class=" container">
        <div class=" text-xl font-bold font-playfair">Description</div>
        <div class=" mt-2"><?php echo nl2br(htmlspecialchars($property['description'])) ?></div>
    </div>
</div>

<!-- details -->
<div class=" py-16">
    <div class=" container">
        <div class=" text-xl font-bold font-playfair">Details</div>
        <div class=" mt-4 p-4 rounded-lg bg-app-primary/20 border-2 border-app-primary grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php if ($property['size']) { ?>
                <div class=" py-2 border-b-2 border-gray-300 flex justify-between items-center">
                    <div class=" font-semibold">Land Area:</div>
                    <div class=""><?php echo htmlspecialchars($property['size']) ?> sqm</div>
                </div>
            <?php } ?>
            <?php if ($property['bedrooms']) { ?>
                <div class=" py-2 border-b-2 border-gray-300 flex justify-between items-center">
                    <div class=" font-semibold">Bedrooms:</div>
                    <div class=""><?php echo htmlspecialchars($property['bedrooms']) ?></div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- features -->
<div class=" py-16">
    <div class=" container">
        <div class=" text-xl font-bold font-playfair">Features</div>
        <div class=" mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <div class=" flex gap-2">
                <div class=""><i class="fa-regular fa-circle-check"></i></div>
                <div class="">24/7 Power supply</div>
            </div>
        </div>
    </div>
</div>

<!-- contact form -->
<div class=" py-16">
    <div class=" container">
        <div class=" rounded-lg border shadow bg-white p-8 text-center">
            <div class=" text-xl font-bold font-playfair">Contact Us</div>
            <div class=" text-sm font-semibold">Enquire about this property</div>
            <form action="" class=" mt-8 w-full max-w-[600px] m-auto">
                <input type="text" placeholder="Your Name*" class=" outline-none pb-2 border-b border-gray-400 bg-transparent w-full focus:border-app-primary my-2" name="name" id="name">
                <input type="email" placeholder="Email*" class=" outline-none pb-2 border-b border-gray-400 bg-transparent w-full focus:border-app-primary my-2" name="email" id="email">
                <input type="tel" placeholder="Phone No." class=" outline-none pb-2 border-b border-gray-400 bg-transparent w-full focus:border-app-primary my-2" name="phone" id="phone">
                <input type="text" placeholder="Subject" class=" outline-none pb-2 border-b border-gray-400 bg-transparent w-full focus:border-app-primary my-2" name="subject" id="subject">
                <label class=" mt-4 text-gray-600 text-left" for="detail">Message</label>
                <textarea name="detail" id="detail" class=" w-full min-h-[150px] bg-app-primary/10 border border-app-primary/20 focus:border-app-primary focus:bg-app-primary/20 resize-y outline-none p-2">Hello, I'm interested in <?php echo htmlspecialchars($property['title']) ?></textarea>
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
</div>

<!-- featured properties -->
<div class=" py-16 bg-gray-200">
    <div class=" container">
        <div class=" w-full max-w-[600px] m-auto text-center">
            <div class=" font-semibold">Featured Properties</div>
        </div>
        <?php if (empty($properties)) { ?>
            <div class=" my-8 text-center font-bold text-2xl text-gray-400">Nothing here yet</div>
        <?php } else { ?>
            <div class=" mt-8 w-full">
                <div class=" relative swiper primary-swiper">
                    <div class=" swiper-wrapper">
                        <?php foreach (array_slice($properties, 0, 6) as $property) { ?>
                            <div class=" swiper-slide">
                                <div class=" group rounded shadow bg-white overflow-hidden">
                                    <div class=" aspect-[3/2] overflow-hidden">
                                        <img src="<?php echo htmlspecialchars($property['img']) ?>" class=" w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="">
                                    </div>
                                    <div class=" p-4">
                                        <a href="./property_detail.php?id=<?php echo htmlspecialchars($property['property_id']) ?>" class=" text-lg font-semibold hover:text-app-primary"><?php echo htmlspecialchars($property['title']) ?></a>
                                        <div class=" flex">
                                            <div class=" text-app-primary w-[30px] flex-none">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </div>
                                            <span><?php echo htmlspecialchars($property['location']) ?></span>
                                        </div>
                                        <div class=" mt-4 flex flex-wrap gap-4">
                                            <?php if ($property['size']) { ?>
                                                <div class=" rounded py-1 px-3 bg-gray-200 flex items-center gap-2 flex-nowrap text-nowrap text-sm font-semibold">
                                                    <i class="fa-solid fa-expand"></i>
                                                    <div class="">Size: <span class=" text-app-primary"><?php echo htmlspecialchars($property['size']) ?> sqm</span></div>
                                                </div>
                                            <?php } ?>
                                            <?php if ($property['bedrooms']) { ?>
                                                <div class=" rounded py-1 px-3 bg-gray-200 flex items-center gap-2 flex-nowrap text-nowrap text-sm font-semibold">
                                                    <i class="fa-solid fa-bed"></i>
                                                    <div class="">Bedrooms: <span class=" text-app-primary"><?php echo htmlspecialchars($property['bedrooms']) ?></span></div>
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
                <a href="./properties.php" class=" flex items-center justify-between sm:justify-normal md:text-lg gap-2 text-app-primary font-semibold hover:text-white transition border py-3 px-5 border-app-primary group bg-transparent relative">
                    <div class=" absolute top-0 left-0 bg-app-primary rounded-r-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                    <div class=" absolute top-0 right-0 bg-app-primary rounded-l-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                    <span class=" z-10 uppercase">View All</span>
                    <i class="fa-solid fa-arrow-right z-10"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?php

include './components/footer_main.php';
include './components/footer.php';
?>








<!-- footer -->
<!-- display image -->
<div id="img-display" class=" pop transition-all duration-500 overflow-hidden fixed top-0 left-0 z-[10000] w-screen h-screen bg-black/80 flex justify-center items-center">
    <div class=" main transition-all duration-500 h-screen md:h-[80vh] w-full md:w-[80vw]">
        <img src="./assets/logo.png" alt="..." class=" w-full h-full object-contain">
    </div>
    <div id="left" class=" absolute left-4 sm:left-8 top-[50%] translate-y-[-50%] px-2 py-4 text-2xl md:text-4xl text-gray-400 hover:text-white bg-black/20 cursor-pointer"><i class="fa-solid fa-chevron-left"></i></div>
    <div id="right" class=" absolute right-4 sm:right-8 top-[50%] translate-y-[-50%] px-2 py-4 text-2xl md:text-4xl text-gray-400 hover:text-white bg-black/20 cursor-pointer"><i class="fa-solid fa-chevron-right"></i></div>
    <div class=" absolute top-8 right-4 sm:right-8 rounded-full border border-white w-[50px] h-[50px] flex justify-center items-center text-white hover:bg-app-primary hover:rotate-90 transition cursor-pointer text-2xl">
        <i class="fa-solid fa-xmark"></i>
    </div>
</div>
<!-- end display image -->

<!-- display video -->
<div id="video-display" class=" pop transition-all duration-500 overflow-hidden fixed top-0 left-0 z-[10000] w-screen h-screen bg-black/80 flex justify-center items-center">
    <div class=" main transition-all duration-500 h-screen md:h-[80vh] w-full md:w-[80vw]">
        <video src="" class=" w-full h-full object-contain" controls></video>
    </div>
    <div class=" absolute top-8 right-4 sm:right-8 rounded-full border border-white w-[50px] h-[50px] flex justify-center items-center text-white hover:bg-app-primary hover:rotate-90 transition cursor-pointer text-2xl">
        <i class="fa-solid fa-xmark"></i>
    </div>
</div>
<!-- end display video -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://kit.fontawesome.com/ecdfbd10f7.js" crossorigin="anonymous"></script>
<script src="./src/slider.js"></script>
<script src="./src/popImg.js"></script>
<script src="./src/script.js"></script>
<script>
    $(document).ready(function() {
        // Initialize all tables with .datatable class
        $('.datatable').DataTable();

        // Make <tr> clickable if it has a data-href attribute
        $('.datatable tbody').on('click', 'tr', function() {
            const href = $(this).data('href');
            if (href) {
                window.location.href = href;
            }
        });
    });
</script>
</body>

</html>








<!-- popImage -->
<script>
    const propertyPic = document.querySelector('#property-pic')
    const propertyPicThumb = document.querySelectorAll('#property-pic-thumb')
    const propertyPicThumbAll = document.querySelectorAll('#property-pic-thumb-all')
    const imgDisplay = document.querySelector('#img-display')
    const popImg = document.querySelector('#img-display img')
    const leftBtn = document.querySelector('#img-display #left')
    const rightBtn = document.querySelector('#img-display #right')
    let currentPropertyImgIndex = 0
    let currentImgGroup = ''
    let imgIndex = -1

    const displayImg = (index, gal) => {
        popImg.src = gal[index].querySelector('img').getAttribute('src')
        imgDisplay.classList.add('show')
    }

    if (imgDisplay) {
        imgDisplay.onclick = () => {
            imgDisplay.classList.remove('show')
        }
    }
    if (popImg) {
        popImg.onclick = (e) => {
            e.stopPropagation()
        }
    }

    const setPropertyPic = (index) => {
        propertyPic.querySelector('img').src = propertyPicThumb[index].querySelector('img').getAttribute('src')
    }

    if (propertyPic && propertyPicThumb) {
        setPropertyPic(currentPropertyImgIndex)
        propertyPicThumb.forEach((item, index) => {
            item.onclick = () => {
                currentPropertyImgIndex = index
                setPropertyPic(currentPropertyImgIndex)
                for (let i = 0; i < propertyPicThumb.length; i++) {
                    propertyPicThumb[i].classList.remove('active')
                    if (currentPropertyImgIndex === i) {
                        propertyPicThumb[i].classList.add('active')
                    }
                }
            }
        })

        propertyPic.onclick = () => {
            displayImg(currentPropertyImgIndex, propertyPicThumb)
            imgIndex = currentPropertyImgIndex
            currentImgGroup = 'propertyImg'
        }
    }



    // control
    if (leftBtn) {
        leftBtn.onclick = (e) => {
            e.stopPropagation()
            if (currentImgGroup === 'propertyImg') {
                imgIndex = imgIndex - 1
                if (imgIndex < 0) {
                    imgIndex = propertyPicThumbAll?.length - 1
                }
                displayImg(imgIndex, propertyPicThumbAll)
            }
        }
    }
    if (rightBtn) {
        rightBtn.onclick = (e) => {
            e.stopPropagation()
            if (currentImgGroup === 'propertyImg') {
                imgIndex = imgIndex + 1
                if (imgIndex === propertyPicThumbAll?.length) {
                    imgIndex = 0
                }
                displayImg(imgIndex, propertyPicThumbAll)
            }
        }
    }
</script>