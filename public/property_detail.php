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

// Handle media files (images and videos)
$mediaFiles = [];
if (!empty($property['images'])) {
    $mediaFiles = explode(', ', trim($property['images']));
    // Remove any empty entries
    $mediaFiles = array_filter($mediaFiles, function ($item) {
        return !empty(trim($item));
    });
}

$properties = fetchAll($pdo, "properties");

include './components/detail_showcase.php';

ob_end_flush();
?>

<!--  -->
<div class=" py-16">
    <div class=" container">
        <div class=" text-2xl font-bold font-playfair mb-2"><?php echo htmlspecialchars($property['name']) ?></div>
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
            <div class=""><?php echo htmlspecialchars($property['address']) ?></div>
        </div>
    </div>
</div>

<!-- images/videos -->
<div class="">
    <div class=" container">
        <div class=" w-full max-w-[800px] m-auto lg:flex-1 p-2 rounded-lg bg-white">
            <?php if (!empty($mediaFiles)) { ?>
                <div id="property-pic" data-index="0" class=" relative w-full rounded-md aspect-[3/2] overflow-hidden group cursor-pointer">
                    <?php
                    $firstMedia = $mediaFiles[0];
                    $isVideo = preg_match('/\.(mp4|avi|mov|wmv|flv|webm|mkv)$/i', $firstMedia);
                    ?>
                    <?php if ($isVideo) { ?>
                        <video src="<?php echo './includes/property/' . htmlspecialchars($firstMedia) ?>" class=" w-full h-full object-cover" muted preload="metadata"></video>
                        <div class=" absolute top-2 right-2 bg-black/60 text-white px-2 py-1 rounded text-xs">
                            <i class="fa-solid fa-play"></i>
                        </div>
                        <div class=" absolute top-0 left-0 w-full h-full flex justify-center items-center">
                            <div class=" invisible opacity-0 w-0 group-hover:visible group-hover:opacity-100 group-hover:w-[60px] transition-all duration-500 aspect-square rounded-full border-white border-2 bg-black/20 text-white flex justify-center items-center text-lg"><i class="fa-solid fa-play"></i></div>
                        </div>
                    <?php } else { ?>
                        <img src="<?php echo './includes/property/' . htmlspecialchars($firstMedia) ?>" class=" w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\' w-full h-full bg-gray-200 flex items-center justify-center text-gray-400\'><div class=\'text-center\'><i class=\'fa-solid fa-image text-4xl mb-2\'></i><div>Image not found</div></div></div>';">
                        <div class=" absolute top-0 left-0 w-full h-full flex justify-center items-center">
                            <div class=" invisible opacity-0 w-0 group-hover:visible group-hover:opacity-100 group-hover:w-[60px] transition-all duration-500 aspect-square rounded-full border-white border-2 bg-black/20 text-white flex justify-center items-center text-lg"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
                        </div>
                    <?php } ?>
                </div>
                <div class=" mt-2 grid grid-cols-4 gap-2">
                    <?php for ($i = 0; $i < count(array_slice($mediaFiles, 0, 4)); $i++) {
                        $mediaFile = $mediaFiles[$i];
                        $isVideoThumb = preg_match('/\.(mp4|avi|mov|wmv|flv|webm|mkv)$/i', $mediaFile);
                    ?>
                        <div id="property-pic-thumb" data-type="<?php echo $isVideoThumb ? 'video' : 'image' ?>" class="<?php echo $i === 0 ? 'active' : '' ?> relative cursor-pointer w-full aspect-[3/2] rounded-md overflow-hidden">
                            <?php if ($isVideoThumb) { ?>
                                <video src="<?php echo './includes/property/' . htmlspecialchars($mediaFile) ?>" class=" w-full h-full object-cover" muted preload="metadata"></video>
                                <div class=" absolute top-2 right-2 bg-black/60 text-white px-1 py-0.5 rounded text-xs">
                                    <i class="fa-solid fa-play"></i>
                                </div>
                            <?php } else { ?>
                                <img src="<?php echo './includes/property/' . htmlspecialchars($mediaFile) ?>" class=" w-full h-full object-cover" alt="" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\' w-full h-full bg-gray-200 flex items-center justify-center text-gray-400\'><i class=\'fa-solid fa-image text-xl\'></i></div>';">
                            <?php } ?>
                            <?php if (count($mediaFiles) > 4 && $i === 3) { ?>
                                <div class=" absolute top-0 left-0 w-full h-full bg-black/80 flex justify-center items-center text-white">
                                    <div class=" font-semibold text-sm">+ <?php echo count($mediaFiles) - 4 ?> More</div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <!-- Hidden thumbnails for all media files -->
                <div class="hidden">
                    <?php for ($i = 0; $i < count($mediaFiles); $i++) {
                        $mediaFile = $mediaFiles[$i];
                        $isVideoThumb = preg_match('/\.(mp4|avi|mov|wmv|flv|webm|mkv)$/i', $mediaFile);
                    ?>
                        <div id="property-pic-thumb-all" data-type="<?php echo $isVideoThumb ? 'video' : 'image' ?>" class="<?php echo $i === 0 ? 'active' : '' ?> relative cursor-pointer w-full aspect-[3/2] rounded-md overflow-hidden">
                            <?php if ($isVideoThumb) { ?>
                                <video src="<?php echo './includes/property/' . htmlspecialchars($mediaFile) ?>" class=" w-full h-full object-cover" muted preload="metadata"></video>
                            <?php } else { ?>
                                <img src="<?php echo './includes/property/' . htmlspecialchars($mediaFile) ?>" class=" w-full h-full object-cover" alt="">
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class=" w-full rounded-md aspect-[3/2] overflow-hidden bg-gray-200 flex items-center justify-center">
                    <div class=" text-gray-500 text-center">
                        <i class="fa-solid fa-image text-4xl mb-2"></i>
                        <div>No media available</div>
                    </div>
                </div>
            <?php } ?>
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

<!-- location -->
<?php if ($property['latitude'] || $property['longitude']) { ?>
    <div class=" py-16">
        <div class=" container">
            <div class=" text-xl font-bold font-playfair">Location</div>
            <div class=" mt-4 h-[300px] rounded-lg overflow-hidden">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3048.4037829718944!2d<?php echo htmlspecialchars($property['longitude']); ?>!3d<?php echo htmlspecialchars($property['latitude']); ?>!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM40zNy40NiJOIDc0wrAwMC4yMiJX!5e0!3m2!1sen!2sus!4v1629794729807"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
<?php } ?>

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
            <?php if ($property['bedroom']) { ?>
                <div class=" py-2 border-b-2 border-gray-300 flex justify-between items-center">
                    <div class=" font-semibold">Bedrooms:</div>
                    <div class=""><?php echo htmlspecialchars($property['bedroom']) ?></div>
                </div>
            <?php } ?>
            <?php if ($property['bathroom']) { ?>
                <div class=" py-2 border-b-2 border-gray-300 flex justify-between items-center">
                    <div class=" font-semibold">Bathrooms:</div>
                    <div class=""><?php echo htmlspecialchars($property['bathroom']) ?></div>
                </div>
            <?php } ?>
            <?php if ($property['livingroom']) { ?>
                <div class=" py-2 border-b-2 border-gray-300 flex justify-between items-center">
                    <div class=" font-semibold">Living Rooms:</div>
                    <div class=""><?php echo htmlspecialchars($property['livingroom']) ?></div>
                </div>
            <?php } ?>
            <?php if ($property['price']) { ?>
                <div class=" py-2 border-b-2 border-gray-300 flex justify-between items-center">
                    <div class=" font-semibold">Price:</div>
                    <div class=" text-app-primary font-bold">₦<?php echo number_format($property['price']) ?></div>
                </div>
            <?php } ?>
            <?php if ($property['availability']) { ?>
                <div class=" py-2 border-b-2 border-gray-300 flex justify-between items-center">
                    <div class=" font-semibold">Availability:</div>
                    <div class=""><?php echo htmlspecialchars($property['availability']) ?></div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- features -->
<div class=" py-16">
    <div class=" container">
        <div class=" text-xl font-bold font-playfair">Features</div>
        <div class=" mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php if (!empty($property['features'])) {
                $features = explode(',', $property['features']);
                foreach ($features as $feature) {
                    $feature = trim($feature);
                    if (!empty($feature)) {
            ?>
                        <div class=" flex gap-2 items-center">
                            <div class=" text-app-primary"><i class="fa-regular fa-circle-check"></i></div>
                            <div class=""><?php echo htmlspecialchars($feature) ?></div>
                        </div>
                <?php
                    }
                }
            } else { ?>
                <div class=" flex gap-2 items-center">
                    <div class=" text-app-primary"><i class="fa-regular fa-circle-check"></i></div>
                    <div class="">24/7 Power supply</div>
                </div>
            <?php } ?>
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
                <textarea name="detail" id="detail" class=" w-full min-h-[150px] bg-app-primary/10 border border-app-primary/20 focus:border-app-primary focus:bg-app-primary/20 resize-y outline-none p-2">Hello, I'm interested in <?php echo htmlspecialchars($property['name']) ?></textarea>
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
                        <?php foreach (array_slice($properties, 0, 6) as $featuredProperty) {
                            // Get first media for featured property
                            $featuredMediaFiles = [];
                            if (!empty($featuredProperty['images'])) {
                                $featuredMediaFiles = explode(', ', trim($featuredProperty['images']));
                                $featuredMediaFiles = array_filter($featuredMediaFiles, function ($item) {
                                    return !empty(trim($item));
                                });
                            }
                            $featuredFirstMedia = !empty($featuredMediaFiles) ? $featuredMediaFiles[0] : '';
                            $isFeaturedVideo = !empty($featuredFirstMedia) && preg_match('/\.(mp4|avi|mov|wmv|flv|webm|mkv)$/i', $featuredFirstMedia);
                        ?>
                            <div class=" swiper-slide">
                                <div class=" group rounded shadow bg-white overflow-hidden">
                                    <div class=" aspect-[3/2] overflow-hidden bg-gray-200 flex items-center justify-center relative">
                                        <?php if (!empty($featuredFirstMedia)) { ?>
                                            <?php if ($isFeaturedVideo) { ?>
                                                <video src="<?php echo './includes/property/' . htmlspecialchars($featuredFirstMedia) ?>" class=" w-full h-full object-cover group-hover:scale-105 transition-all duration-500" muted></video>
                                                <div class=" absolute top-2 right-2 bg-black/60 text-white px-2 py-1 rounded text-xs">
                                                    <i class="fa-solid fa-play"></i>
                                                </div>
                                            <?php } else { ?>
                                                <img src="<?php echo './includes/property/' . htmlspecialchars($featuredFirstMedia) ?>" class=" w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="">
                                            <?php } ?>
                                        <?php } else { ?>
                                            <div class=" text-gray-400 text-center">
                                                <i class="fa-solid fa-image text-3xl mb-2"></i>
                                                <div class=" text-sm">No Image</div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class=" p-4">
                                        <a href="./property_detail.php?id=<?php echo htmlspecialchars($featuredProperty['property_id']) ?>" class=" text-lg font-semibold hover:text-app-primary"><?php echo htmlspecialchars($featuredProperty['name']) ?></a>
                                        <div class=" flex">
                                            <div class=" text-app-primary w-[30px] flex-none">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </div>
                                            <span><?php echo htmlspecialchars($featuredProperty['location_id']) ?></span>
                                        </div>
                                        <div class=" mt-4 flex flex-wrap gap-4">
                                            <?php if ($featuredProperty['size']) { ?>
                                                <div class=" rounded py-1 px-3 bg-gray-200 flex items-center gap-2 flex-nowrap text-nowrap text-sm font-semibold">
                                                    <i class="fa-solid fa-expand"></i>
                                                    <div class="">Size: <span class=" text-app-primary"><?php echo htmlspecialchars($featuredProperty['size']) ?> sqm</span></div>
                                                </div>
                                            <?php } ?>
                                            <?php if ($featuredProperty['bedroom']) { ?>
                                                <div class=" rounded py-1 px-3 bg-gray-200 flex items-center gap-2 flex-nowrap text-nowrap text-sm font-semibold">
                                                    <i class="fa-solid fa-bed"></i>
                                                    <div class="">Bedrooms: <span class=" text-app-primary"><?php echo htmlspecialchars($featuredProperty['bedroom']) ?></span></div>
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