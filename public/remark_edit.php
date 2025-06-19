<?php
ob_start();

include './components/header.php';
userAccess(['admin']);

if (!isset($_GET['id'])) {
    header('Location: ./rent_history.php');
    exit;
}

$remark = fetchById($pdo, $_GET['id'], "remarks", "remark_id");

if (!$remark) {
    header('Location: ./rent_history.php');
    exit;
}

$rent = fetchById($pdo, $remark['rent_id'], "rents", "rent_id");

$property = fetchById($pdo, $rent['property_id'], "properties", "property_id");
$tenant = fetchById($pdo, $rent['tenant_id'], "users", "user_id");

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
                <div class="">
                    <div class=" text-xl font-semibold"><?php echo htmlspecialchars($property['name']) ?></div>
                    <div class=" text-sm font-semibold"><?php echo htmlspecialchars($tenant['first_name']) ?> <?php echo htmlspecialchars($tenant['last_name']) ?></div>
                </div>
            </div>
            <div class=" mt-4 bg-white p-4 rounded shadow w-full max-w-[500px] m-auto">
                <form action="includes/remark/update.php" method="POST" class=" app-form mt-4">
                    <input type="hidden" name="remark_id" value="<?php echo htmlspecialchars($remark['remark_id']) ?>">
                    <input type="hidden" name="rent_id" value="<?php echo htmlspecialchars($remark['rent_id']) ?>">
                    <!--  -->
                    <div class=" my-2 flex flex-col gap-1 items-start">
                        <label for="remark" class=" text-sm font-semibold text-gray-500">Remark</label>
                        <textarea name="remark" id="remark" class=" w-full py-2 px-6 rounded bg-app-secondary/15 outline-none focus:bg-app-secondary/20 resize-y min-h-[150px]"><?php echo (isset($_SESSION['input_data']['remark']) && !isset($_SESSION['errors']['remark'])) ? htmlspecialchars($_SESSION['input_data']['remark']) : $remark['comment'] ?></textarea>
                        <?php if (isset($_SESSION['errors']['remark'])) { ?>
                            <div class=" text-sm text-red-500 font-semibold"><?php echo htmlspecialchars($_SESSION['errors']['remark']) ?></div>
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