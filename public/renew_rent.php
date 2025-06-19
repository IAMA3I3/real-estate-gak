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
            <div class=" text-xl font-semibold"><?php echo htmlspecialchars($property['name']) ?></div>
            <div class=" text-sm font-semibold"><?php echo htmlspecialchars($tenant['first_name']) ?> <?php echo htmlspecialchars($tenant['last_name']) ?></div>
            <div class=" mt-4 rounded shadow bg-white border p-4 w-full max-w-[700px] m-auto">
                <div class=" text-lg font-semibold">Extend Rent End</div>
                <form action="./includes/tenant/renew.php" method="post" class=" app-form w-full mt-4">
                    <input type="hidden" name="rent_id" value="<?php echo htmlspecialchars($rent['rent_id']) ?>">
                    <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($rent['property_id']) ?>">
                    <div class=" flex flex-col items-start gap-1 my-2">
                        <label for="rent_end" class=" text-sm font-semibold text-gray-500">Rent End</label>
                        <input type="date" name="rent_end" id="rent_end" value="<?php echo (isset($_SESSION['input_data']['rent_end']) && !isset($_SESSION['errors']['rent_end'])) ? htmlspecialchars($_SESSION['input_data']['rent_end']) : htmlspecialchars(date('Y-m-d', strtotime($rent['rent_end']))) ?>" class=" w-full py-2 px-4 rounded outline-none bg-app-secondary/15 focus:bg-app-secondary/25">
                        <?php if (isset($_SESSION['errors']['rent_end'])) { ?>
                            <div class=" text-sm font-semibold text-red-500"><?php echo $_SESSION['errors']['rent_end'] ?></div>
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