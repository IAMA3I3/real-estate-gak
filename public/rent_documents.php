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

$property = fetchById($pdo, $rent['property_id'], "properties", "property_id");
$landlord = fetchById($pdo, $rent['landlord_id'], "users", "user_id");
$tenant = fetchById($pdo, $rent['tenant_id'], "users", "user_id");

$documents = fetchAllBy($pdo, "documents", "rent_id", $rent['rent_id']);

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
            <div class=" flex justify-between gap-4 flex-wrap">
                <div class=" text-xl font-semibold">Rent Documents</div>
                <?php if ($_SESSION['user']['user_type'] === 'admin') { ?>
                    <div class="">
                        <a href="./upload_rent_document.php?rent_id=<?php echo htmlspecialchars($rent['rent_id']) ?>" class=" text-xs font-semibold text-app-primary py-2 px-4 rounded border-2 border-app-primary bg-transparent hover:bg-app-primary hover:text-white">Upload New Document</a>
                    </div>
                <?php } ?>
            </div>
            <div class=" mt-8 flex flex-col lg:flex-row gap-4 *:w-full">
                <!--  -->
                <div class=" bg-white rounded shadow border p-4">
                    <div class=" text-lg font-semibold">Property</div>
                    <div class=" mt-4"><?php echo htmlspecialchars($property['name']) ?></div>
                    <div class=" mt-2 text-sm font-semibold"><?php echo htmlspecialchars($property['address']) ?></div>
                </div>
                <!--  -->
                <?php if ($_SESSION['user']['user_type'] === 'user' || $_SESSION['user']['user_type'] === 'admin') { ?>
                    <div class=" bg-white rounded shadow border p-4">
                        <div class=" text-lg font-semibold">Landlord</div>
                        <div class=" mt-4"><?php echo htmlspecialchars($landlord['first_name']) ?> <?php echo htmlspecialchars($landlord['last_name']) ?></div>
                        <div class=" mt-2 text-sm font-semibold"><?php echo htmlspecialchars($landlord['email']) ?></div>
                    </div>
                <?php } ?>
                <!--  -->
                <?php if ($_SESSION['user']['user_type'] === 'landlord' || $_SESSION['user']['user_type'] === 'admin') { ?>
                    <div class=" bg-white rounded shadow border p-4">
                        <div class=" text-lg font-semibold">Tenant</div>
                        <div class=" mt-4"><?php echo htmlspecialchars($tenant['first_name']) ?> <?php echo htmlspecialchars($tenant['last_name']) ?></div>
                        <div class=" mt-2 text-sm font-semibold"><?php echo htmlspecialchars($tenant['email']) ?></div>
                    </div>
                <?php } ?>
            </div>
            <div class=" mt-8">
                <?php if (!$documents) { ?>
                    <div class=" text-center font-bold text-3xl text-gray-400">No Document Here Yet</div>
                <?php } else { ?>
                    <?php foreach ($documents as $document) { ?>
                        <div class=" my-2 bg-white rounded shadow border p-4 flex flex-col sm:flex-row gap-4 items-center text-center sm:text-left">
                            <div class=" flex-1">
                                <div class=""><?php echo htmlspecialchars($document['name']) ?></div>
                                <div class=" text-sm font-semibold"><?php echo htmlspecialchars(date('d F, Y', strtotime($document['created_at']))) ?></div>
                            </div>
                            <div class=" flex gap-2 items-center">
                                <form action="./includes/document/download.php" method="post">
                                    <input type="hidden" name="document" value="<?php echo htmlspecialchars($document['document']) ?>">
                                    <button class=" text-xs font-semibold text-app-primary py-2 px-4 rounded border-2 border-app-primary bg-transparent hover:bg-app-primary hover:text-white">Download File</button>
                                </form>
                                <?php if ($_SESSION['user']['user_type'] === 'admin') { ?>
                                    <form action="./includes/document/delete.php" method="post" onsubmit="return confirm(`Proceed to delete document`)">
                                        <input type="hidden" name="document_id" value="<?php echo htmlspecialchars($document['document_id']) ?>">
                                        <input type="hidden" name="rent_id" value="<?php echo htmlspecialchars($rent['rent_id']) ?>">
                                        <button class=" text-xs font-semibold text-red-500 py-2 px-4 rounded border-2 border-red-500 bg-transparent hover:bg-red-500 hover:text-white">Delete File</button>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
?>