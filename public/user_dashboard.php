<?php

include './components/header.php';
userAccess(['user']);

$rent = fetchByIdWithCondition($pdo, $_SESSION['user']['user_id'], "rents", "tenant_id", "status", "active");

if ($rent) {
    $landlord = fetchById($pdo, $rent['landlord_id'], "users", "user_id");
    $property = fetchById($pdo, $rent['property_id'], "properties", "property_id");
}
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
            <?php if ($rent) { ?>
                <div class=" mt-8 rounded bg-white shadow-md p-4 border border-gray-200">
                    <div class=" text-lg font-semibold">Active Rent</div>
                    <div class=" mt-4 bg-gray-100 rounded shadow border p-4 flex flex-col sm:flex-row gap-4 items-center text-center sm:text-left">
                        <div class=" flex-1">
                            <div class=""><?php echo htmlspecialchars($property['name']) ?></div>
                            <div class=" text-sm font-semibold text-gray-500"><?php echo htmlspecialchars($property['address']) ?></div>
                            <div class=" mt-2 text-sm font-semibold"><?php echo htmlspecialchars(date('d F, Y', strtotime($rent['rent_start']))) ?> - <?php echo htmlspecialchars(date('d F, Y', strtotime($rent['rent_end']))) ?></div>
                        </div>
                        <div class=" flex gap-2 flex-nowrap *:text-nowrap">
                            <a href="./rent_documents.php?rent_id=<?php echo htmlspecialchars($rent['rent_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white">Documents</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
?>