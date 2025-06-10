<?php
ob_start();

include './components/header.php';
include './components/top_nav.php';

if (!isset($_GET['id'])) {
    header('Location: ./properties.php');
    exit;
}

$property = ['property_id' => 'hh466cjn37fuie', 'img' => './assets/house-3.jpg, ./assets/ongoing.webp, ./assets/house-1.jpg, ./assets/house-2.jpg, ./assets/house-3.jpg , ./assets/house-1.jpg , ./assets/house-2.jpg', 'title' => 'Aurora Heights', 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta architecto facere, deleniti quis omnis nihil aut, laboriosam a repudiandae voluptates id recusandae asperiores doloremque itaque rerum quasi reiciendis non. Labore.', 'location' => 'Area 1', 'status' => 'completed', 'type' => 'rental', 'size' => 920, 'bedrooms' => 4];
$propertyImages = explode(', ', $property['img']);

if (!$property) {
    header('Location: ./properties.php');
    exit;
}

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