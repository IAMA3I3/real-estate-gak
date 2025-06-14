<?php

include './components/header.php';
userAccess(['admin', 'landlord', 'user']);

$rents = fetchAll($pdo, "rents");

if (isset($_GET['property_id'])) {
    $rents = fetchAllBy($pdo, "rents", "property_id", $_GET['property_id']);
}

$sn = 1
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
            <div class=" text-2xl">Rents</div>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
?>