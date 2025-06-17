<?php

include './components/header.php';
include './components/top_nav.php';
include './components/showcase.php';

// Get URL parameters
$status = isset($_GET['status']) ? trim($_GET['status']) : null;
$type = isset($_GET['type']) ? trim($_GET['type']) : null;
$location_id = isset($_GET['location_id']) ? $_GET['location_id'] : null;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Build WHERE conditions array
$whereConditions = [];
$params = [];

if ($status) {
    $whereConditions[] = "status = ?";
    $params[] = $status;
}

if ($type) {
    $whereConditions[] = "type = ?";
    $params[] = $type;
}

if ($location_id) {
    $whereConditions[] = "location_id = ?";
    $params[] = $location_id;
}

// Build the WHERE clause
$whereClause = '';
if (!empty($whereConditions)) {
    $whereClause = ' WHERE ' . implode(' AND ', $whereConditions);
}

// Get total count with filters
$countQuery = "SELECT COUNT(*) FROM properties" . $whereClause;
$countStmt = $pdo->prepare($countQuery);
$countStmt->execute($params);
$propertiesCount = $countStmt->fetchColumn();

// Pagination setup
$limit = 8;
$maxPage = ceil($propertiesCount / $limit);

// Validate page number
if ($page < 1) {
    $page = 1;
} elseif ($page > $maxPage && $maxPage > 0) {
    $page = $maxPage;
}

// Calculate offset
$offset = ($page - 1) * $limit;

// Get properties with filters and pagination
$propertiesQuery = "SELECT * FROM properties" . $whereClause . " ORDER BY created_at DESC LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
$propertiesStmt = $pdo->prepare($propertiesQuery);
$propertiesStmt->execute($params);
$properties = $propertiesStmt->fetchAll(PDO::FETCH_ASSOC);

$locations = fetchAll($pdo, "locations");

// Function to build URL with current parameters
function buildUrl($newParams = []) {
    $currentParams = [];
    
    if (isset($_GET['status']) && $_GET['status']) {
        $currentParams['status'] = $_GET['status'];
    }
    if (isset($_GET['type']) && $_GET['type']) {
        $currentParams['type'] = $_GET['type'];
    }
    if (isset($_GET['location_id']) && $_GET['location_id']) {
        $currentParams['location_id'] = $_GET['location_id'];
    }
    
    // Merge with new parameters (new params override current ones)
    $allParams = array_merge($currentParams, $newParams);
    
    // Remove empty parameters
    $allParams = array_filter($allParams, function($value) {
        return $value !== '' && $value !== null;
    });
    
    $url = $_SERVER['PHP_SELF'];
    if (!empty($allParams)) {
        $url .= '?' . http_build_query($allParams);
    }
    
    return $url;
}

// Build page title based on filters
$pageTitle = "Our Properties";
$titleParts = [];

if ($status) {
    $titleParts[] = ucfirst($status);
}
if ($type) {
    $titleParts[] = ucfirst($type);
}
if ($location_id) {
    // Get location name
    $locationStmt = $pdo->prepare("SELECT name FROM locations WHERE location_id = ?");
    $locationStmt->execute([$location_id]);
    $locationName = $locationStmt->fetchColumn();
    if ($locationName) {
        $titleParts[] = $locationName;
    }
}

if (!empty($titleParts)) {
    $pageTitle = implode(' ', $titleParts) . " Properties";
}
?>

<div class="py-16">
    <div class="container">
        <div class="w-full max-w-[500px] m-auto text-center">
            <div class="text-2xl font-bold font-playfair"><?php echo htmlspecialchars($pageTitle) ?></div>
            <div class="mt-2">Find the Perfect Property for Your Needs</div>
            
            <?php if ($status || $type || $location_id) { ?>
                <div class="mt-4">
                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="inline-flex items-center gap-2 text-app-primary hover:text-app-secondary transition-colors">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>View All Properties</span>
                    </a>
                </div>
            <?php } ?>
        </div>
        
        <!-- Filter Summary -->
        <?php if ($status || $type || $location_id) { ?>
            <div class="mt-6 flex flex-wrap justify-center gap-2">
                <?php if ($status) { ?>
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-app-primary text-white rounded-full text-sm">
                        Status: <?php echo htmlspecialchars(ucfirst($status)) ?>
                        <a href="<?php echo htmlspecialchars(buildUrl(['status' => null])); ?>" class="hover:text-gray-200">
                            <i class="fa-solid fa-times"></i>
                        </a>
                    </span>
                <?php } ?>
                <?php if ($type) { ?>
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-app-secondary text-white rounded-full text-sm">
                        Type: <?php echo htmlspecialchars(ucfirst($type)) ?>
                        <a href="<?php echo htmlspecialchars(buildUrl(['type' => null])); ?>" class="hover:text-gray-200">
                            <i class="fa-solid fa-times"></i>
                        </a>
                    </span>
                <?php } ?>
                <?php if ($location_id && isset($locationName)) { ?>
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-green-600 text-white rounded-full text-sm">
                        Location: <?php echo htmlspecialchars($locationName) ?>
                        <a href="<?php echo htmlspecialchars(buildUrl(['location_id' => null])); ?>" class="hover:text-gray-200">
                            <i class="fa-solid fa-times"></i>
                        </a>
                    </span>
                <?php } ?>
            </div>
        <?php } ?>
        
        <!--  -->
        <?php if (empty($properties)) { ?>
            <div class="mt-8 text-center text-4xl font-bold text-gray-400">
                <?php if ($status || $type || $location_id) { ?>
                    No Properties Found with Current Filters
                <?php } else { ?>
                    No Properties Found
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-8">
                <?php foreach ($properties as $property) { ?>
                    <div class="group rounded shadow bg-white overflow-hidden">
                        <div class="aspect-[3/2] overflow-hidden">
                            <div class="w-full h-full relative">
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
                                    <video class="w-full h-full object-cover" muted>
                                        <source src="<?php echo './includes/property/' . htmlspecialchars($firstMedia) ?>" type="video/<?php echo $fileExtension ?>">
                                    </video>
                                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
                                        <i class="fa-solid fa-play text-white text-lg"></i>
                                    </div>
                                <?php } elseif ($firstMedia) { ?>
                                    <img src="<?php echo './includes/property/' . htmlspecialchars($firstMedia) ?>" class="w-full h-full object-cover" alt="">
                                <?php } else { ?>
                                    <img src="./assets/showcase.png" class="w-full h-full object-cover" alt="">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="p-4">
                            <a href="./property_detail.php?id=<?php echo htmlspecialchars($property['property_id']) ?>" class="text-lg font-semibold hover:text-app-primary"><?php echo htmlspecialchars($property['name']) ?></a>
                            <div class="flex">
                                <div class="text-app-primary w-[30px] flex-none">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <span><?php echo htmlspecialchars($property['address']) ?></span>
                            </div>
                            <div class="mt-4 flex flex-wrap gap-4">
                                <?php if ($property['size']) { ?>
                                    <div class="rounded py-1 px-3 bg-gray-200 flex items-center gap-2 flex-nowrap text-nowrap text-sm font-semibold">
                                        <i class="fa-solid fa-expand"></i>
                                        <div class="">Size: <span class="text-app-primary"><?php echo htmlspecialchars($property['size']) ?> sqm</span></div>
                                    </div>
                                <?php } ?>
                                <?php if ($property['bedroom']) { ?>
                                    <div class="rounded py-1 px-3 bg-gray-200 flex items-center gap-2 flex-nowrap text-nowrap text-sm font-semibold">
                                        <i class="fa-solid fa-bed"></i>
                                        <div class="">Bedrooms: <span class="text-app-primary"><?php echo htmlspecialchars($property['bedroom']) ?></span></div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!-- pagination -->
            <div class="container py-8">
                <div class="flex items-center justify-between gap-2">
                    <form action="<?php echo htmlspecialchars(buildUrl()); ?>" method="get">
                        <?php
                        // Preserve current filters in hidden inputs
                        if ($status) echo '<input type="hidden" name="status" value="' . htmlspecialchars($status) . '">';
                        if ($type) echo '<input type="hidden" name="type" value="' . htmlspecialchars($type) . '">';
                        if ($location_id) echo '<input type="hidden" name="location_id" value="' . htmlspecialchars($location_id) . '">';
                        ?>
                        <input type="hidden" name="page" value="<?php echo ($page > 1) ? $page - 1 : 1 ?>">
                        <button <?php echo ($page <= 1) ? 'disabled' : ''; ?> title="previous" class="py-2 px-4 rounded-md <?php echo ($page <= 1) ? 'bg-gray-300 cursor-not-allowed' : 'bg-app-secondary/70 hover:bg-app-secondary'; ?> text-white active:scale-95">
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                    </form>
                    <div class="text-sm font-semibold text-gray-300 text-center">
                        Showing <?php echo (empty($properties)) ? '0' : htmlspecialchars(($page - 1) * $limit + 1) ?> 
                        to <?php echo htmlspecialchars(min($page * $limit, $propertiesCount)) ?> 
                        of <?php echo htmlspecialchars($propertiesCount) ?>
                    </div>
                    <form action="<?php echo htmlspecialchars(buildUrl()); ?>" method="get">
                        <?php
                        // Preserve current filters in hidden inputs
                        if ($status) echo '<input type="hidden" name="status" value="' . htmlspecialchars($status) . '">';
                        if ($type) echo '<input type="hidden" name="type" value="' . htmlspecialchars($type) . '">';
                        if ($location_id) echo '<input type="hidden" name="location_id" value="' . htmlspecialchars($location_id) . '">';
                        ?>
                        <input type="hidden" name="page" value="<?php echo ($page < $maxPage) ? $page + 1 : $maxPage ?>">
                        <button <?php echo ($page >= $maxPage) ? 'disabled' : ''; ?> type="submit" title="next" class="py-2 px-4 rounded-md <?php echo ($page >= $maxPage) ? 'bg-gray-300 cursor-not-allowed' : 'bg-app-secondary/70 hover:bg-app-secondary'; ?> text-white active:scale-95">
                            <i class="fa-solid fa-angle-right"></i>
                        </button>
                    </form>
                </div>
            </div>
            <!-- end pagination -->
        <?php } ?>
    </div>
</div>

<div class="py-16 bg-gray-200">
    <div class="container">
        <div class="w-full max-w-[500px] m-auto text-center">
            <div class="text-2xl font-bold font-playfair">Explore Our Properties</div>
            <div class="mt-2">Browse a wide range of properties - from ongoing developments to ready-to-rent and for-sale listings</div>
        </div>
        <!--  -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 *:w-full">
            <a href="./properties.php?status=ongoing" class="group z-10 aspect-[2/1] rounded-xl border-2 border-app-secondary hover:border-app-primary p-2">
                <div class="relative w-full h-full rounded-lg bg-white shadow overflow-hidden">
                    <img src="./assets/ongoing.webp" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="">
                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/85 from-40% p-4 flex flex-col justify-end">
                        <div class="text-white font-semibold text-xl group-hover:text-app-primary">Ongoing</div>
                    </div>
                </div>
            </a>
            <a href="./properties.php?status=completed&type=rental" class="group z-10 aspect-[2/1] rounded-xl border-2 border-app-secondary hover:border-app-primary p-2">
                <div class="relative w-full h-full rounded-lg bg-white shadow overflow-hidden">
                    <img src="./assets/house-2.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="">
                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/85 from-40% p-4 flex flex-col justify-end">
                        <div class="text-white font-semibold text-xl group-hover:text-app-primary">Rentals</div>
                    </div>
                </div>
            </a>
            <a href="./properties.php?status=completed&type=sale" class="group z-10 aspect-[2/1] rounded-xl border-2 border-app-secondary hover:border-app-primary p-2">
                <div class="relative w-full h-full rounded-lg bg-white shadow overflow-hidden">
                    <img src="./assets/house-1.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="">
                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/85 from-40% p-4 flex flex-col justify-end">
                        <div class="text-white font-semibold text-xl group-hover:text-app-primary">Sales</div>
                    </div>
                </div>
            </a>
            <a href="./properties.php?status=upcoming" class="group z-10 aspect-[2/1] rounded-xl border-2 border-app-secondary hover:border-app-primary p-2">
                <div class="relative w-full h-full rounded-lg bg-white shadow overflow-hidden">
                    <img src="./assets/house-3.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="">
                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/85 from-40% p-4 flex flex-col justify-end">
                        <div class="text-white font-semibold text-xl group-hover:text-app-primary">Upcoming</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container">
        <div class="w-full max-w-[500px] m-auto text-center">
            <div class="text-2xl font-bold font-playfair">EXPLORE BY LOCATION</div>
            <div class="mt-2">Your Ideal Home Starts with the Right Location</div>
        </div>
        <!--  -->
        <?php if (empty($locations)) { ?>
            <div class="my-8 text-center font-bold text-2xl text-gray-300">Nothing here yet</div>
        <?php } else { ?>
            <div class="mt-8 w-full">
                <div class="relative swiper primary-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($locations as $location) { ?>
                            <div class="swiper-slide">
                                <div class="relative w-full aspect-[3/2] shadow rounded overflow-hidden group">
                                    <img src="<?php echo $location['image'] ? './includes/location/' . $location['image'] : './assets/showcase.png' ?>" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500" alt="">
                                    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-black/85 via-transparent to-black/85 p-4 flex flex-col justify-between items-start text-white">
                                        <div class="text-lg font-semibold"><?php echo htmlspecialchars($location['name']) ?></div>
                                        <a href="./properties.php?location_id=<?php echo htmlspecialchars($location['location_id']) ?>" class="mt-6 flex items-center justify-between sm:justify-normal md:text-lg gap-2 text-app-primary font-semibold hover:text-white transition border py-3 px-5 border-app-primary group/link bg-transparent relative">
                                            <div class="absolute top-0 left-0 bg-app-primary rounded-r-md h-full w-0 group-hover/link:w-[60%] transition-all duration-500"></div>
                                            <div class="absolute top-0 right-0 bg-app-primary rounded-l-md h-full w-0 group-hover/link:w-[60%] transition-all duration-500"></div>
                                            <span class="z-10">See Properties</span>
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