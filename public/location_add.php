<?php

include './components/header.php';
userAccess(['admin']);
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
            <div class=" mt-4x bg-white p-4 rounded shadow w-full max-w-[500px] m-auto">
                <div class=" text-2xl text-center">Add New Location</div>
                <form action="includes/location/add.php" method="POST" enctype="multipart/form-data" class=" app-form mt-4">
                    <div id="file-preview" class=" w-full aspect-[3/1] rounded border-2 border-gray-300 bg-gray-100 overflow-hidden">
                        <!-- display uploaded image here -->
                    </div>
                    <div class=" my-2 flex flex-col gap-1">
                        <label for="file" class=" block w-full py-2 px-6 text-center text-sm font-semibold border-2 border-app-primary text-app-primary cursor-pointer rounded hover:bg-app-primary hover:text-white active:scale-95">Upload Image</label>
                        <input type="file" class=" hidden" name="file" id="file" accept="image/jpeg,image/png,image/gif,image/webp">
                        <?php if (isset($_SESSION['errors']['file_upload'])) { ?>
                            <div class=" text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['file_upload']) ?></div>
                        <?php } ?>
                    </div>
                    <!--  -->
                    <div class=" my-2 flex flex-col gap-1 items-start">
                        <label for="name" class=" text-sm font-semibold text-gray-500">Location</label>
                        <input type="text" name="name" id="name" value="<?php echo (isset($_SESSION['input_data']['name']) && !isset($_SESSION['errors']['name'])) ? htmlspecialchars($_SESSION['input_data']['name']) : '' ?>" class=" w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                        <?php if (isset($_SESSION['errors']['name'])) { ?>
                            <div class=" text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['name']) ?></div>
                        <?php } ?>
                    </div>
                    <!--  -->
                    <div class=" mt-4 flex justify-center">
                        <button class=" py-2 px-6 rounded bg-app-secondary text-white hover:bg-app-primary">SUBMIT</button>
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fileInput = document.getElementById('file');
        const filePreview = document.getElementById('file-preview');

        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];

            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                alert('Please upload a valid image file (JPEG, PNG, GIF, or WebP)');
                fileInput.value = ''; // Clear the input
                filePreview.innerHTML = ''; // Clear preview
                return;
            }

            // Validate file size (optional, e.g., max 100MB)
            if (file.size > 100 * 1024 * 1024) {
                alert('File size should not exceed 100MB');
                fileInput.value = '';
                filePreview.innerHTML = '';
                return;
            }

            // Create file reader to preview image
            const reader = new FileReader();

            reader.onload = (e) => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover';

                // Clear previous preview and add new image
                filePreview.innerHTML = '';
                filePreview.appendChild(img);
            };

            reader.readAsDataURL(file);
        });
    });
</script>