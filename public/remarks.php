<?php
ob_start();

include './components/header.php';
userAccess(['admin', 'landlord', 'user']);

if (!isset($_GET['rent_id'])) {
    header('Location: ./rent_history.php');
    exit;
}

$rent = fetchById($pdo, $_GET['rent_id'], "rents", "rent_id");

if (!$rent) {
    header('Location: ./rent_history.php');
    exit;
}

$remarks = fetchAllBy($pdo, "remarks", "rent_id", $_GET['rent_id']);

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
            <div class=" mt-4">
                <div class=""></div>
            </div>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
?>