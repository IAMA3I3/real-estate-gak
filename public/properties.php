<?php

include './components/header.php';
include './components/top_nav.php';
include './components/showcase.php';

$propertiesCount = 64;

$page = 1;
$limit = 12;

$maxPage = ceil($propertiesCount / $limit);

$locations = [
    ['img' => './assets/house-1.jpg', 'location' => 'Area 1', 'href' => './properties.php?location=' . urlencode('Area 1')],
    ['img' => './assets/house-2.jpg', 'location' => 'Area 2', 'href' => './properties.php?location=' . urlencode('Area 2')],
    ['img' => './assets/house-3.jpg', 'location' => 'Area 3', 'href' => './properties.php?location=' . urlencode('Area 3')],
    ['img' => './assets/house-1.jpg', 'location' => 'Area 4', 'href' => './properties.php?location=' . urlencode('Area 4')],
    ['img' => './assets/house-2.jpg', 'location' => 'Area 5', 'href' => './properties.php?location=' . urlencode('Area 5')]
];

$properties = [
    ['property_id' => 'hh466cjn37fuie', 'img' => './assets/ongoing.webp', 'title' => 'The Haven Residences', 'location' => 'Area 1', 'size' => 920, 'bedrooms' => 4],
    ['property_id' => 'hh466cjn37fuie', 'img' => './assets/house-1.jpg', 'title' => 'Sunset Grove Villas', 'location' => 'Area 2', 'size' => 920, 'bedrooms' => 4],
    ['property_id' => 'hh466cjn37fuie', 'img' => './assets/house-2.jpg', 'title' => 'Maplewood Heights', 'location' => 'Area 3', 'size' => 920, 'bedrooms' => 4],
    ['property_id' => 'hh466cjn37fuie', 'img' => './assets/house-3.jpg', 'title' => 'Oceanview Luxe Apartments', 'location' => 'Area 3', 'size' => 920, 'bedrooms' => 4],
    ['property_id' => 'hh466cjn37fuie', 'img' => './assets/ongoing.webp', 'title' => 'The Grand Oak Estate', 'location' => 'Area 4', 'size' => 920, 'bedrooms' => 4],
    ['property_id' => 'hh466cjn37fuie', 'img' => './assets/house-1.jpg', 'title' => 'Crystal Creek Homes', 'location' => 'Area 5', 'size' => 920, 'bedrooms' => 4],
    ['property_id' => 'hh466cjn37fuie', 'img' => './assets/house-2.jpg', 'title' => 'Skyline Edge Towers', 'location' => 'Area 1', 'size' => 920, 'bedrooms' => 4],
    ['property_id' => 'hh466cjn37fuie', 'img' => './assets/house-3.jpg', 'title' => 'Willow Park Enclave', 'location' => 'Area 2', 'size' => 920, 'bedrooms' => 4],
    ['property_id' => 'hh466cjn37fuie', 'img' => './assets/ongoing.webp', 'title' => 'Amberstone Courts', 'location' => 'Area 3', 'size' => 920, 'bedrooms' => 4],
    ['property_id' => 'hh466cjn37fuie', 'img' => './assets/house-1.jpg', 'title' => 'The Pearl Residency', 'location' => 'Area 4', 'size' => 920, 'bedrooms' => 4],
    ['property_id' => 'hh466cjn37fuie', 'img' => './assets/house-2.jpg', 'title' => 'Serenity Gardens Villas', 'location' => 'Area 5', 'size' => 920, 'bedrooms' => 4],
    ['property_id' => 'hh466cjn37fuie', 'img' => './assets/house-3.jpg', 'title' => 'Aurora Heights', 'location' => 'Area 1', 'size' => 920, 'bedrooms' => 4]
];
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
                <?php } ?>
            </div>
            <!-- pagination -->
            <div class=" py-8">
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
        <div class=" mt-8 flex flex-col sm:flex-row items-center gap-4 *:w-full">
            <a href="./properties.php?status=on_going" class=" group z-10 aspect-[2/1] rounded-xl border-2 border-app-secondary hover:border-app-primary p-2">
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
                                <div class=" relative aspect-[3/2] shadow rounded overflow-hidden group">
                                    <img src="<?php echo htmlspecialchars($location['img']) ?>" class=" w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="">
                                    <div class=" absolute top-0 left-0 w-full h-full bg-gradient-to-b from-black/85 via-transparent to-black/85 p-4 flex flex-col justify-between items-start text-white">
                                        <div class=" text-lg font-semibold"><?php echo htmlspecialchars($location['location']) ?></div>
                                        <a href="<?php echo $location['href'] ?>" class=" mt-6 flex items-center justify-between sm:justify-normal md:text-lg gap-2 text-app-primary font-semibold hover:text-white transition border py-3 px-5 border-app-primary group/link bg-transparent relative">
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