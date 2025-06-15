<?php
ob_start();

include './components/header.php';
userAccess(['admin']);

if (!isset($_GET['id'])) {
    header('Location: ./dashboard_properties.php');
    exit;
}

$property = fetchById($pdo, $_GET['id'], "properties", "property_id");

if (!$property) {
    header('Location: ./dashboard_properties.php');
    exit;
}

$landlords = fetchLandlords($pdo);
$locations = fetchAll($pdo, "locations");

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
        <div class="p-4">
            <div class="mt-4x bg-white p-4 rounded shadow w-full max-w-[600px] m-auto">
                <div class="text-2xl text-center">Edit Property</div>
                <form action="includes/property/update.php" method="POST" enctype="multipart/form-data" class="app-form mt-4">
                    <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($property['property_id']) ?>">
                    <input type="hidden" name="images" value="<?php echo htmlspecialchars($property['images']) ?>">

                    <!-- Preview Container -->
                    <div id="file-preview" class="grid grid-cols-3 gap-2 border-2 border-gray-300 bg-gray-100 p-2 rounded overflow-hidden min-h-[100px]">
                        <!-- Images and videos will show here -->
                    </div>

                    <!-- Upload button -->
                    <div class="my-2 flex flex-col gap-1">
                        <button type="button" id="addImageBtn" class="block w-full py-2 px-6 text-center text-sm font-semibold border-2 border-app-primary text-app-primary cursor-pointer rounded hover:bg-app-primary hover:text-white active:scale-95">
                            Replace Images & Videos
                        </button>
                        <input type="file" class="hidden" name="files[]" id="fileInput" accept="image/jpeg,image/png,image/gif,image/webp,video/mp4,video/avi,video/mov,video/wmv,video/flv,video/webm" multiple>
                        <?php if (isset($_SESSION['errors']['file_upload'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['file_upload']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- name -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="name" class="text-sm font-semibold text-gray-500">Name</label>
                        <input type="text" name="name" id="name" value="<?php echo (isset($_SESSION['input_data']['name']) && !isset($_SESSION['errors']['name'])) ? htmlspecialchars($_SESSION['input_data']['name']) : htmlspecialchars($property['name']) ?>" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                        <?php if (isset($_SESSION['errors']['name'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['name']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- description -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="description" class="text-sm font-semibold text-gray-500">Description</label>
                        <textarea name="description" id="description" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20 resize-y min-h-[150px]"><?php echo (isset($_SESSION['input_data']['description']) && !isset($_SESSION['errors']['description'])) ? htmlspecialchars($_SESSION['input_data']['description']) : htmlspecialchars($property['description']) ?></textarea>
                        <?php if (isset($_SESSION['errors']['description'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['description']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- landlord -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="landlord" class="text-sm font-semibold text-gray-500">Landlord</label>
                        <select name="landlord" id="landlord" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                            <option value="">Select Landlord</option>
                            <?php foreach ($landlords as $landlord) { ?>
                                <option <?php echo isset($_SESSION['input_data']['landlord']) && !isset($_SESSION['errors']['landlord']) && $_SESSION['input_data']['landlord'] === htmlspecialchars($landlord['user_id']) ? 'selected' : ($property['landlord_id'] === $landlord['user_id'] ? 'selected' : '') ?> value="<?php echo htmlspecialchars($landlord['user_id']) ?>"><?php echo htmlspecialchars($landlord['first_name']) ?> <?php echo htmlspecialchars($landlord['last_name']) ?> - <?php echo htmlspecialchars($landlord['email']) ?></option>
                            <?php } ?>
                        </select>
                        <?php if (isset($_SESSION['errors']['landlord'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['landlord']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- price -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="price" class="text-sm font-semibold text-gray-500">Price (&#8358;)</label>
                        <input type="number" name="price" id="price" value="<?php echo (isset($_SESSION['input_data']['price']) && !isset($_SESSION['errors']['price'])) ? htmlspecialchars($_SESSION['input_data']['price']) : htmlspecialchars($property['price']) ?>" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                        <?php if (isset($_SESSION['errors']['price'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['price']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- location -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="location" class="text-sm font-semibold text-gray-500">Location</label>
                        <select name="location" id="location" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                            <option value="">Select Location</option>
                            <?php foreach ($locations as $location) { ?>
                                <option <?php echo isset($_SESSION['input_data']['location']) && !isset($_SESSION['errors']['location']) && $_SESSION['input_data']['location'] === htmlspecialchars($location['location_id']) ? 'selected' : ($property['location_id'] === $location['location_id'] ? 'selected' : '') ?> value="<?php echo htmlspecialchars($location['location_id']) ?>"><?php echo htmlspecialchars($location['name']) ?></option>
                            <?php } ?>
                        </select>
                        <?php if (isset($_SESSION['errors']['location'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['location']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- address -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="address" class="text-sm font-semibold text-gray-500">Address</label>
                        <textarea name="address" id="address" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20 resize-y min-h-[150px]"><?php echo (isset($_SESSION['input_data']['address']) && !isset($_SESSION['errors']['address'])) ? htmlspecialchars($_SESSION['input_data']['address']) : htmlspecialchars($property['address']) ?></textarea>
                        <?php if (isset($_SESSION['errors']['address'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['address']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- latitude -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="latitude" class="text-sm font-semibold text-gray-500">Latitude</label>
                        <input type="text" name="latitude" id="latitude" value="<?php echo (isset($_SESSION['input_data']['latitude']) && !isset($_SESSION['errors']['latitude'])) ? htmlspecialchars($_SESSION['input_data']['latitude']) : htmlspecialchars($property['latitude']) ?>" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                        <?php if (isset($_SESSION['errors']['latitude'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['latitude']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- longitude -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="longitude" class="text-sm font-semibold text-gray-500">Longitude</label>
                        <input type="text" name="longitude" id="longitude" value="<?php echo (isset($_SESSION['input_data']['longitude']) && !isset($_SESSION['errors']['longitude'])) ? htmlspecialchars($_SESSION['input_data']['longitude']) : htmlspecialchars($property['longitude']) ?>" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                        <?php if (isset($_SESSION['errors']['longitude'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['longitude']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- status -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="status" class="text-sm font-semibold text-gray-500">Status</label>
                        <select name="status" id="status" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                            <option value="">Select Status</option>
                            <option <?php echo isset($_SESSION['input_data']['status']) && !isset($_SESSION['errors']['status']) && $_SESSION['input_data']['status'] === 'ongoing' ? 'selected' : ($property['status'] === 'ongoing' ? 'selected' : '') ?> value="ongoing">Ongoing</option>
                            <option <?php echo isset($_SESSION['input_data']['status']) && !isset($_SESSION['errors']['status']) && $_SESSION['input_data']['status'] === 'completed' ? 'selected' : ($property['status'] === 'completed' ? 'selected' : '') ?> value="completed">Completed</option>
                        </select>
                        <?php if (isset($_SESSION['errors']['status'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['status']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- type -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="type" class="text-sm font-semibold text-gray-500">Type</label>
                        <select name="type" id="type" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                            <option value="">Select Type</option>
                            <option <?php echo isset($_SESSION['input_data']['type']) && !isset($_SESSION['errors']['type']) && $_SESSION['input_data']['type'] === 'rental' ? 'selected' : ($property['type'] === 'rental' ? 'selected' : '') ?> value="rental">Rental</option>
                            <option <?php echo isset($_SESSION['input_data']['type']) && !isset($_SESSION['errors']['type']) && $_SESSION['input_data']['type'] === 'sale' ? 'selected' : ($property['type'] === 'sale' ? 'selected' : '') ?> value="sale">Sale</option>
                        </select>
                        <?php if (isset($_SESSION['errors']['type'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['type']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- size -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="size" class="text-sm font-semibold text-gray-500">Size (sqm)</label>
                        <input type="number" name="size" id="size" value="<?php echo (isset($_SESSION['input_data']['size']) && !isset($_SESSION['errors']['size'])) ? htmlspecialchars($_SESSION['input_data']['size']) : htmlspecialchars($property['size']) ?>" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                        <?php if (isset($_SESSION['errors']['size'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['size']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- livingroom -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="livingroom" class="text-sm font-semibold text-gray-500">Livingroom</label>
                        <input type="number" name="livingroom" id="livingroom" value="<?php echo (isset($_SESSION['input_data']['livingroom']) && !isset($_SESSION['errors']['livingroom'])) ? htmlspecialchars($_SESSION['input_data']['livingroom']) : htmlspecialchars($property['livingroom']) ?>" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                        <?php if (isset($_SESSION['errors']['livingroom'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['livingroom']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- bedroom -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="bedroom" class="text-sm font-semibold text-gray-500">Bedroom</label>
                        <input type="number" name="bedroom" id="bedroom" value="<?php echo (isset($_SESSION['input_data']['bedroom']) && !isset($_SESSION['errors']['bedroom'])) ? htmlspecialchars($_SESSION['input_data']['bedroom']) : htmlspecialchars($property['bedroom']) ?>" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                        <?php if (isset($_SESSION['errors']['bedroom'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['bedroom']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- bathroom -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="bathroom" class="text-sm font-semibold text-gray-500">Bathroom</label>
                        <input type="number" name="bathroom" id="bathroom" value="<?php echo (isset($_SESSION['input_data']['bathroom']) && !isset($_SESSION['errors']['bathroom'])) ? htmlspecialchars($_SESSION['input_data']['bathroom']) : htmlspecialchars($property['bathroom']) ?>" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                        <?php if (isset($_SESSION['errors']['bathroom'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['bathroom']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- condition -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="property_condition" class="text-sm font-semibold text-gray-500">Property Condition</label>
                        <textarea name="property_condition" id="property_condition" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20 resize-y min-h-[150px]"><?php echo (isset($_SESSION['input_data']['property_condition']) && !isset($_SESSION['errors']['property_condition'])) ? htmlspecialchars($_SESSION['input_data']['property_condition']) : htmlspecialchars($property['property_condition']) ?></textarea>
                        <?php if (isset($_SESSION['errors']['property_condition'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['property_condition']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- features -->
                    <div class="my-2 flex flex-col gap-1 items-start">
                        <label for="features" class="text-sm font-semibold text-gray-500">Features / Amenities (Seperate by ', ')</label>
                        <textarea name="features" id="features" class="w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20 resize-y min-h-[150px]"><?php echo (isset($_SESSION['input_data']['features']) && !isset($_SESSION['errors']['features'])) ? htmlspecialchars($_SESSION['input_data']['features']) : htmlspecialchars($property['features']) ?></textarea>
                        <?php if (isset($_SESSION['errors']['features'])) { ?>
                            <div class="text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['features']) ?></div>
                        <?php } ?>
                    </div>

                    <!-- Submit -->
                    <div class="mt-4 flex justify-center">
                        <button class="py-2 px-6 rounded bg-app-secondary text-white hover:bg-app-primary">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
unset($_SESSION['errors']);
unset($_SESSION['input_data']);
?>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('file-preview');
        const addImageBtn = document.getElementById('addImageBtn');

        addImageBtn.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', (event) => {
            const files = Array.from(event.target.files);
            const allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            const allowedVideoTypes = ['video/mp4', 'video/avi', 'video/mov', 'video/wmv', 'video/flv', 'video/webm'];
            const allowedTypes = [...allowedImageTypes, ...allowedVideoTypes];

            // Clear previous previews
            filePreview.innerHTML = '';

            // If no files selected, show empty state
            if (files.length === 0) {
                return;
            }

            files.forEach(file => {
                if (!allowedTypes.includes(file.type)) {
                    alert('Only image and video files are allowed (JPEG, PNG, GIF, WebP, MP4, AVI, MOV, WMV, FLV, WebM)');
                    return;
                }

                if (file.size > 500 * 1024 * 1024) { // Increased to 500MB for videos
                    alert('Each file must be under 500MB');
                    return;
                }

                const fileContainer = document.createElement('div');
                fileContainer.className = 'relative';

                const reader = new FileReader();
                reader.onload = (e) => {
                    if (allowedImageTypes.includes(file.type)) {
                        // Handle image files
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-full h-[100px] object-cover rounded';
                        fileContainer.appendChild(img);
                    } else if (allowedVideoTypes.includes(file.type)) {
                        // Handle video files
                        const video = document.createElement('video');
                        video.src = e.target.result;
                        video.className = 'w-full h-[100px] object-cover rounded';
                        video.controls = false;
                        video.muted = true;

                        // Add play icon overlay
                        const playIcon = document.createElement('div');
                        playIcon.innerHTML = '▶';
                        playIcon.className = 'absolute inset-0 flex items-center justify-center text-white text-2xl bg-black bg-opacity-30 rounded cursor-pointer hover:bg-opacity-50';
                        playIcon.addEventListener('click', () => {
                            if (video.paused) {
                                video.play();
                                playIcon.style.display = 'none';
                            }
                        });

                        video.addEventListener('click', () => {
                            if (!video.paused) {
                                video.pause();
                                playIcon.style.display = 'flex';
                            }
                        });

                        fileContainer.appendChild(video);
                        fileContainer.appendChild(playIcon);
                    }

                    // Add file name overlay
                    const fileName = document.createElement('div');
                    fileName.textContent = file.name;
                    fileName.className = 'absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1 rounded-b truncate';

                    fileContainer.appendChild(fileName);
                    filePreview.appendChild(fileContainer);
                };
                reader.readAsDataURL(file);
            });
        });
    });
</script>