<?php
ob_start();

include './components/header.php';
userAccess(['admin']);

if (!isset($_GET['rent_id'])) {
    header('Location: ./rent_history.php');
    exit;
}

$rent = fetchById($pdo, $_GET['rent_id'], "rents", "rent_id");

if (!$rent) {
    header('Location: ./rent_history.php');
    exit;
}

$property = fetchById($pdo, $rent['property_id'], "properties", "property_id");

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
            <div class=" text-2xl">Upload Rent Document</div>
            <div class=" text-sm font-semibold"><?php echo htmlspecialchars($property['name']) ?></div>
            <div class=" mt-8 bg-white p-4 rounded shadow w-full max-w-[500px] m-auto">
                <form action="includes/document/add.php" method="POST" enctype="multipart/form-data" class=" app-form mt-4" onsubmit="this.querySelector('input[type=submit]').disabled = true;">
                    <input type="hidden" name="rent_id" value="<?php echo htmlspecialchars($rent['rent_id']) ?>">
                    <!--  -->
                    <div class=" my-2 flex flex-col gap-1 items-start">
                        <label for="name" class=" text-sm font-semibold text-gray-500">Name</label>
                        <input type="text" name="name" id="name" value="<?php echo (isset($_SESSION['input_data']['name']) && !isset($_SESSION['errors']['name'])) ? htmlspecialchars($_SESSION['input_data']['name']) : '' ?>" class=" w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                        <?php if (isset($_SESSION['errors']['name'])) { ?>
                            <div class=" text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['name']) ?></div>
                        <?php } ?>
                    </div>
                    <!--  -->
                    <div class=" my-2 flex flex-col gap-1 items-start">
                        <label for="file" class=" text-sm font-semibold text-gray-500">File</label>
                        <input type="file" name="file" id="file" accept=".pdf,.docx,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document" value="<?php echo (isset($_SESSION['input_data']['file']) && !isset($_SESSION['errors']['file'])) ? htmlspecialchars($_SESSION['input_data']['file']) : '' ?>" class=" w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20">
                        <?php if (isset($_SESSION['errors']['file'])) { ?>
                            <div class=" text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['file']) ?></div>
                        <?php } ?>
                    </div>
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