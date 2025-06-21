<?php
ob_start();

include './components/header.php';
userAccess(['admin']);

if (!isset($_GET['id'])) {
    header('Location: ./dashboard_team.php');
    exit;
}

$member = fetchById($pdo, $_GET['id'], "team", "id");

if (!$member) {
    header('Location: ./dashboard_team.php');
    exit;
}

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
            <div class=" mt-4x bg-white p-4 rounded shadow w-full max-w-[500px] m-auto">
                <div class=" text-2xl text-center">Edit Team Member</div>
                <form action="./includes/team/update-member.php" method="post" enctype="multipart/form-data" onsubmit="this.querySelector('input[type=submit]').disabled = true;" class=" mt-4">
                    <input type="hidden" value="<?php echo $member['id'] ?>" name="id" id="id">
                    <input type="hidden" name="img" value="<?php echo htmlspecialchars($member['img']) ?>" id="img">
                    <div id="file-preview" class=" w-full aspect-[3/1] rounded border-2 border-gray-300 bg-gray-100 overflow-hidden">
                        <!-- replace image here -->
                        <?php if ($member['img']) { ?>
                            <img src="<?php echo './includes/team/' . htmlspecialchars($member['img']) ?>" class=" w-full h-full object-cover object-top" alt="">
                        <?php } ?>
                    </div>
                    <div class=" my-2">
                        <label for="file" class=" block w-full py-2 px-6 text-center text-sm font-semibold border-2 border-app-primary text-app-primary cursor-pointer rounded hover:bg-app-primary hover:text-white active:scale-95">Upload Image</label>
                        <input type="file" class=" hidden" name="file" id="file" accept="image/jpeg,image/png,image/gif,image/webp">
                    </div>
                    <!--  -->
                    <div class=" my-2 flex flex-col gap-1 items-start">
                        <label for="name" class=" text-sm font-semibold text-gray-500">Name</label>
                        <input type="text" name="name" id="name" value="<?php echo (isset($_SESSION['inputData']['name']) && !isset($_SESSION['error']['name'])) ? htmlspecialchars($_SESSION['inputData']['name']) : htmlspecialchars($member['name']) ?>" class=" w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                        <?php if (isset($_SESSION['errors']['name'])) { ?>
                            <div class=" text-sm font-semibold text-red-500"><?php echo $_SESSION['errors']['name'] ?></div>
                        <?php } ?>
                    </div>
                    <!--  -->
                    <div class=" my-2 flex flex-col gap-1 items-start">
                        <label for="position" class=" text-sm font-semibold text-gray-500">Position</label>
                        <input type="text" name="position" id="position" value="<?php echo (isset($_SESSION['inputData']['position']) && !isset($_SESSION['errors']['position'])) ? htmlspecialchars($_SESSION['inputData']['position']) : htmlspecialchars($member['position']); ?>" class=" w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                        <?php if (isset($_SESSION['errors']['position'])) { ?>
                            <div class=" text-sm font-semibold text-red-500"><?php echo $_SESSION['errors']['position'] ?></div>
                        <?php } ?>
                    </div>
                    <!--  -->
                    <div class=" my-2 flex flex-col gap-1 items-start">
                        <label for="descriptbioion" class=" text-sm font-semibold text-gray-500">Bio</label>
                        <textarea name="bio" id="bio" class=" w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20 resize-y min-h-[150px]"><?php echo (isset($_SESSION['inputData']['bio']) && !isset($_SESSION['error']['bio'])) ? htmlspecialchars($_SESSION['inputData']['bio']) : htmlspecialchars($member['bio']) ?></textarea>
                        <?php if (isset($_SESSION['errors']['bio'])) { ?>
                            <div class=" text-sm font-semibold text-red-500"><?php echo $_SESSION['errors']['bio'] ?></div>
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
unset($_SESSION['inputData']);
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
                img.className = 'w-full h-full object-cover object-top';

                // Clear previous preview and add new image
                filePreview.innerHTML = '';
                filePreview.appendChild(img);
            };

            reader.readAsDataURL(file);
        });
    });
</script>