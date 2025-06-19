<?php
ob_start();

include './components/header.php';
userAccess(['admin', 'landlord']);

if (!isset($_GET['id'])) {
    header('Location: ./dashboard_properties.php');
    exit;
}

$property = fetchById($pdo, $_GET['id'], "properties", "property_id");

if (!$property) {
    header('Location: ./dashboard_properties.php');
    exit;
}

$landlord = fetchById($pdo, $property['landlord_id'], "users", "user_id");

$tenant = null;
if ($property['availability'] === 'occupied') {
    $rent = fetchByIdWithCondition($pdo, $property['property_id'], "rents", "property_id", "status", "active");
    if ($rent) {
        $tenant = fetchById($pdo, $rent['tenant_id'], "users", "user_id");
    }
}

$location = fetchById($pdo, $property['location_id'], "locations", "location_id");

ob_end_flush();
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
            <div class=" flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class=" text-xl font-semibold"><?php echo htmlspecialchars($property['name']) ?></div>
                <a href="./property_remarks.php?id=<?php echo htmlspecialchars($property['property_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-app-primary text-app-primary hover:bg-app-primary hover:text-white">Remarks</a>
            </div>
            <!-- media -->
            <div class=" mt-4 rounded shadow bg-white p-4">
                <div class=" text-lg font-semibold">Images & Videos</div>
                <?php if ($property['images']) { ?>
                    <div class=" mt-4 flex flex-wrap gap-2">
                        <?php foreach (explode(', ', $property['images']) as $media) { ?>
                            <?php
                            // Check if it's a video file
                            $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv'];
                            $fileExtension = strtolower(pathinfo($media, PATHINFO_EXTENSION));
                            $isVideo = in_array($fileExtension, $videoExtensions);
                            ?>

                            <div class=" w-[150px] aspect-square rounded overflow-hidden relative">
                                <?php if ($isVideo) { ?>
                                    <video class=" w-full h-full object-cover" controls>
                                        <source src="<?php echo './includes/property/' . htmlspecialchars($media) ?>" type="video/<?php echo $fileExtension ?>">
                                        Your browser does not support the video tag.
                                    </video>
                                    <div class="absolute top-2 right-2 bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded">
                                        <i class="fa-solid fa-video"></i>
                                    </div>
                                <?php } else { ?>
                                    <img src="<?php echo './includes/property/' . htmlspecialchars($media) ?>" class=" w-full h-full object-cover cursor-pointer" alt="" onclick="openMediaModal('<?php echo './includes/property/' . htmlspecialchars($media) ?>', 'image')">
                                    <div class="absolute top-2 right-2 bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class=" mt-4 text-center font-bold text-3xl text-gray-400">No Media Found</div>
                <?php } ?>
            </div>
            <!-- description -->
            <div class=" mt-4 rounded shadow bg-white p-4">
                <div class=" text-lg font-semibold">Description</div>
                <div class=" mt-4"><?php echo nl2br(htmlspecialchars($property['description'])) ?></div>
            </div>
            <!-- location -->
            <div class=" mt-4 rounded shadow bg-white p-4">
                <div class=" text-lg font-semibold">Location</div>
                <?php if ($location) { ?>
                    <div class=" mt-4"><?php echo htmlspecialchars($location['name']) ?></div>
                <?php } else { ?>
                    <div class=" mt-4 text-center font-bold text-3xl text-gray-400">Not Specified</div>
                <?php } ?>
            </div>
            <!-- address -->
            <div class=" mt-4 rounded shadow bg-white p-4">
                <div class=" text-lg font-semibold">Address</div>
                <div class=" mt-4"><?php echo nl2br(htmlspecialchars($property['address'])) ?></div>
            </div>
            <!-- map -->
            <div class=" mt-4 rounded shadow bg-white p-4">
                <div class=" text-lg font-semibold">Map</div>
                <?php if ($property['latitude'] || $property['longitude']) { ?>
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
                <?php } else { ?>
                    <div class=" mt-4 text-center font-bold text-3xl text-gray-400">Not Specified</div>
                <?php } ?>
            </div>
            <!-- condition -->
            <div class=" mt-4 rounded shadow bg-white p-4">
                <div class=" text-lg font-semibold">Property Condition</div>
                <?php if ($property['property_condition']) { ?>
                    <div class=" mt-4"><?php echo nl2br(htmlspecialchars($property['property_condition'])) ?></div>
                <?php } else { ?>
                    <div class=" mt-4 text-center font-bold text-3xl text-gray-400">Not Specified</div>
                <?php } ?>
            </div>
            <!-- features -->
            <div class=" mt-4 rounded shadow bg-white p-4">
                <div class=" text-lg font-semibold">Features / Amenities</div>
                <?php if ($property['features']) { ?>
                    <div class=" mt-4"><?php echo htmlspecialchars($property['features']) ?></div>
                <?php } else { ?>
                    <div class=" mt-4 text-center font-bold text-3xl text-gray-400">Not Specified</div>
                <?php } ?>
            </div>
            <!-- landlord -->
            <div class=" mt-4 rounded shadow bg-white p-4">
                <div class=" text-lg font-semibold">Landlord</div>
                <div class=" mt-4"><?php echo htmlspecialchars($landlord['first_name']) ?> <?php echo htmlspecialchars($landlord['last_name']) ?></div>
                <div class=" text-sm font-semibold"><?php echo htmlspecialchars($landlord['email']) ?></div>
            </div>
            <!-- others -->
            <div class=" mt-4 rounded shadow bg-white p-4 flex gap-4 flex-wrap">
                <!-- price -->
                <div class=""><span class=" font-semibold">Price:</span> <span class=" capitalize">&#8358;<?php echo htmlspecialchars(number_format($property['price'])) ?></span></div>
                <!-- status -->
                <div class=""><span class=" font-semibold">Status:</span> <span class=" capitalize"><?php echo htmlspecialchars($property['status']) ?></span></div>
                <!-- type -->
                <div class=""><span class=" font-semibold">Type:</span> <span class=" capitalize"><?php echo htmlspecialchars($property['type']) ?></span></div>
                <!-- size -->
                <div class=""><span class=" font-semibold">Size:</span> <span class=" capitalize"><?php echo htmlspecialchars($property['size']) ?></span> sqm</div>
                <!-- livingroom -->
                <div class=""><span class=" font-semibold">Livingroom:</span> <span class=" capitalize"><?php echo $property['livingroom'] ? htmlspecialchars($property['livingroom']) : 'NIL' ?></span></div>
                <!-- bedroom -->
                <div class=""><span class=" font-semibold">Bedroom:</span> <span class=" capitalize"><?php echo $property['bedroom'] ? htmlspecialchars($property['bedroom']) : 'NIL' ?></span></div>
                <!-- bathroom -->
                <div class=""><span class=" font-semibold">Bathroom:</span> <span class=" capitalize"><?php echo $property['bathroom'] ? htmlspecialchars($property['bathroom']) : 'NIL' ?></span></div>
                <!-- availability -->
                <div class=""><span class=" font-semibold">Availability:</span> <span class=" capitalize"><?php echo htmlspecialchars($property['availability']) ?></span></div>
                <!-- upload -->
                <div class=""><span class=" font-semibold">Upload:</span> <span class=" capitalize"><?php echo htmlspecialchars(date('d F, Y', strtotime($property['created_at']))) ?></span></div>
            </div>
            <!-- tenatnt -->
            <?php if ($property['type'] === 'rental') { ?>
                <div class=" mt-4 rounded shadow bg-white p-4">
                    <div class=" flex justify-between items-center">
                        <div class=" text-lg font-semibold">Tenant</div>
                        <a href="./rent_history.php?property_id=<?php echo htmlspecialchars($property['property_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-app-primary text-app-primary hover:bg-app-primary hover:text-white">Rent History</a>
                    </div>
                    <?php if ($tenant) { ?>
                        <div class=" mt-4"><?php echo htmlspecialchars($tenant['first_name']) ?> <?php echo htmlspecialchars($tenant['last_name']) ?></div>
                        <div class=" text-sm font-semibold"><?php echo htmlspecialchars($tenant['email']) ?></div>
                        <div class=" mt-2"><span class=" font-semibold">Rent Start:</span> <span class=" capitalize"><?php echo htmlspecialchars(date('d F, Y', strtotime($rent['rent_start']))) ?></span></div>
                        <div class=" mt-2"><span class=" font-semibold">Rent End:</span> <span class=" capitalize"><?php echo htmlspecialchars(date('d F, Y', strtotime($rent['rent_end']))) ?></span></div>
                        <div class=" mt-2 flex gap-2 flex-nowrap *:text-nowrap">
                            <a title="Documents" href="./rent_documents.php?rent_id=<?php echo htmlspecialchars($rent['rent_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white"><i class="fa-solid fa-file"></i></a>
                            <a title="Remark" href="./remarks.php?rent_id=<?php echo htmlspecialchars($rent['rent_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-app-primary text-app-primary hover:bg-app-primary hover:text-white"><i class="fa-solid fa-comment-dots"></i></a>
                            <a title="Renew" href="./renew_rent.php?rent_id=<?php echo htmlspecialchars($rent['rent_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-green-500 text-green-500 hover:bg-green-500 hover:text-white"><i class="fa-solid fa-repeat"></i></a>
                            <form action="./includes/tenant/terminate.php" method="post" onsubmit="return confirm(`Proceed to terminate tenant`)">
                                <input type="hidden" name="rent_id" value="<?php echo htmlspecialchars($rent['rent_id']) ?>">
                                <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($rent['property_id']) ?>">
                                <button title="Terminate" type="submit" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white"><i class="fa-solid fa-calendar-xmark"></i></button>
                            </form>
                        </div>
                    <?php } else { ?>
                        <div class=" mt-4 text-center font-bold text-3xl text-gray-400">No Active Tenant</div>
                        <?php if ($_SESSION['user']['user_type'] === 'admin' && $property['type'] === 'rental') { ?>
                            <div class=" mt-4 text-center">
                                <a href="./add_tenant.php?property_id=<?php echo htmlspecialchars($property['property_id']) ?>" class=" font-semibold text-app-primary hover:underline">Add Tenant</a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
            <!--  -->
            <?php if ($_SESSION['user']['user_type'] === 'admin') { ?>
                <div class=" mt-4 rounded shadow bg-white p-4 flex flex-wrap gap-4">
                    <a href="./property_edit.php?id=<?php echo htmlspecialchars($property['property_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white">Edit Property</a>
                    <form action="./includes/property/delete.php" method="post" onsubmit="return confirm(`Proceed to delete property`)">
                        <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($property['property_id']) ?>">
                        <button type="submit" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white">Delete Property</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Media Modal -->
<div id="mediaModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden items-center justify-center">
    <div class="relative max-w-4xl max-h-full p-4">
        <button onclick="closeMediaModal()" class="absolute top-2 right-2 text-white text-2xl z-10 bg-black bg-opacity-50 w-10 h-10 rounded-full flex items-center justify-center hover:bg-opacity-75">
            <i class="fa-solid fa-times"></i>
        </button>
        <div id="modalContent" class="max-w-full max-h-full">
            <!-- Content will be inserted here -->
        </div>
    </div>
</div>

<script>
    function openMediaModal(src, type) {
        const modal = document.getElementById('mediaModal');
        const modalContent = document.getElementById('modalContent');

        if (type === 'image') {
            modalContent.innerHTML = `<img src="${src}" class="max-w-full max-h-full object-contain" alt="">`;
        } else if (type === 'video') {
            modalContent.innerHTML = `<video class="max-w-full max-h-full" controls autoplay>
            <source src="${src}" type="video/${src.split('.').pop()}">
            Your browser does not support the video tag.
        </video>`;
        }

        modal.style.display = 'flex';
    }

    function closeMediaModal() {
        const modal = document.getElementById('mediaModal');
        const modalContent = document.getElementById('modalContent');
        modal.style.display = 'none';
        modalContent.innerHTML = '';
    }

    // Close modal when clicking outside the content
    document.getElementById('mediaModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeMediaModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMediaModal();
        }
    });
</script>

<!-- end container -->

<?php

include './components/footer.php';
?>