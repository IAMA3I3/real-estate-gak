<?php

include './components/header.php';
userAccess(['admin']);

$users = fetchAll($pdo, "users");
$landlords = fetchAllBy($pdo, "users", "user_type", "landlord");
$properties = fetchAll($pdo, "properties");
$blogs = fetchAll($pdo, "blog");

$grids = [
    ['name' => 'Users', 'url' => './users.php', 'value' => count($users)],
    ['name' => 'Landlords', 'url' => './users.php', 'value' => count($landlords)],
    ['name' => 'Properties', 'url' => './dashboard_properties.php', 'value' => count($properties)],
    ['name' => 'Blog', 'url' => './dashboard_blog.php', 'value' => count($blogs)]
];
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
            <div class=" text-2xl">Dashboard</div>
            <div class=" mt-2 grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                <!-- grids -->
                <?php foreach ($grids as $grid) { ?>
                    <div class=" rounded bg-white shadow-md p-4 border border-gray-200">
                        <div class=" text-4xl font-bold text-gray-600"><?php echo $grid['value'] ?></div>
                        <div class=""><?php echo $grid['name'] ?></div>
                        <a href="<?php echo $grid['url'] ?>" class=" block text-right text-sm font-semibold text-app-primary hover:underline">View <i class="fa-solid fa-arrow-right-long"></i></a>
                    </div>
                <?php } ?>
            </div>
            <div class=" mt-8 grid gap-8 grid-cols-1 lg:grid-cols-2">
                <!--  -->
                <div class=" rounded bg-white shadow-md p-4 border border-gray-200">
                    <div class=" flex justify-between items-start">
                        <div class=" text-lg font-semibold">Recent Properties</div>
                        <div class="">
                            <a href="./dashboard_properties.php" class=" text-xs font-semibold text-app-primary py-2 px-4 rounded border-2 border-app-primary bg-transparent hover:bg-app-primary hover:text-white">All Properties</a>
                        </div>
                    </div>
                    <div class=" mt-2">
                        <?php if (!$properties) { ?>
                            <div class=" mt-4 text-center font-bold text-gray-300">Nothing Here Yet</div>
                        <?php } else { ?>
                            <?php foreach (array_slice($properties, 0, 5) as $property) { ?>
                                <a href="./dashboard_property_detail.php?id=<?php echo htmlspecialchars($property['property_id']) ?>" class=" block my-2 rounded bg-gray-100 hover:bg-gray-200 py-1 px-3">
                                    <div class=" flex items-center gap-2">
                                        <div class=" w-[50px] aspect-square rounded overflow-hidden relative">
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
                                        <div class=" flex-1 overflow-hidden">
                                            <div class=" font-semibold truncate w-full"><?php echo htmlspecialchars($property['name']) ?></div>
                                            <div class=" text-sm font-semibold text-gray-500 truncate w-full"><?php echo htmlspecialchars($property['address']) ?></div>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <!--  -->
                <div class=" rounded bg-white shadow-md p-4 border border-gray-200">
                    <div class=" flex justify-between items-start">
                        <div class=" text-lg font-semibold">Recent Blog</div>
                        <div class="">
                            <a href="./dashboard_blog.php" class=" text-xs font-semibold text-app-primary py-2 px-4 rounded border-2 border-app-primary bg-transparent hover:bg-app-primary hover:text-white">All Blog</a>
                        </div>
                    </div>
                    <div class=" mt-2">
                        <?php if (!$blogs) { ?>
                            <div class=" mt-4 text-center font-bold text-gray-300">Nothing Here Yet</div>
                        <?php } else { ?>
                            <?php foreach (array_slice($blogs, 0, 5) as $blog) { ?>
                                <a href="./dashboard_blog_detail.php?id=<?php echo htmlspecialchars($blog['blog_id']) ?>" class=" block my-2 rounded bg-gray-100 hover:bg-gray-200 py-1 px-3">
                                    <div class=" flex items-center gap-2">
                                        <div class=" w-[50px] aspect-square rounded overflow-hidden">
                                            <img src="<?php echo $blog['image'] ? './includes/blog/' . $blog['image'] : './assets/showcase.png' ?>" class=" w-full h-full object-cover" alt="">
                                        </div>
                                        <div class=" flex-1 overflow-hidden">
                                            <div class=" font-semibold truncate w-full"><?php echo htmlspecialchars($blog['title']) ?></div>
                                            <div class=" text-sm font-semibold text-gray-500 truncate w-full"><?php echo htmlspecialchars($blog['body']) ?></div>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
?>