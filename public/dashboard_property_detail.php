<?php
ob_start();

include './components/header.php';
userAccess(['admin', 'landlord']);

if (!isset($_GET['id'])) {
    header('Location: ./dashboard_properties.php');
    exit;
}

$property = fetchById($pdo, $_GET['id'], "properties", "property_id");

if (!$property) {
    header('Location: ./dashboard_properties.php');
    exit;
}

$landlord = fetchById($pdo, $property['landlord_id'], "users", "user_id");

$tenant = null;
if ($property['availability'] === 'occupied') {
    $rent = fetchByIdWithCondition($pdo, $property['property_id'], "rents", "property_id", "status", "active");
    if ($rent) {
        $tenant = fetchById($pdo, $rent['tenant_id'], "users", "user_id");
    }
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
            <div class=" text-xl font-semibold"><?php echo htmlspecialchars($property['name']) ?></div>
            <!-- images -->
            <div class=" mt-4 rounded shadow bg-white p-4">
                <div class=" text-lg font-semibold">Images</div>
                <?php if ($property['images']) { ?>
                    <div class=" mt-4 flex flex-wrap gap-2">
                        <?php foreach (explode(', ', $property['images']) as $image) { ?>
                            <div class=" w-[150px] aspect-square rounded overflow-hidden">
                                <img src="<?php echo './includes/property/' . htmlspecialchars($image) ?>" class=" w-full h-full object-cover" alt="">
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class=" mt-4 text-center font-bold text-3xl text-gray-400">No Image Found</div>
                <?php } ?>
            </div>
            <!-- description -->
            <div class=" mt-4 rounded shadow bg-white p-4">
                <div class=" text-lg font-semibold">Description</div>
                <div class=" mt-4"><?php echo nl2br(htmlspecialchars($property['description'])) ?></div>
            </div>
            <!-- address -->
            <div class=" mt-4 rounded shadow bg-white p-4">
                <div class=" text-lg font-semibold">Address</div>
                <div class=" mt-4"><?php echo nl2br(htmlspecialchars($property['address'])) ?></div>
            </div>
            <!-- condition -->
            <div class=" mt-4 rounded shadow bg-white p-4">
                <div class=" text-lg font-semibold">Property Condition</div>
                <?php if ($property['property_condition']) { ?>
                    <div class=" mt-4"><?php echo nl2br(htmlspecialchars($property['property_condition'])) ?></div>
                <?php } else { ?>
                    <div class=" mt-4 text-center font-bold text-3xl text-gray-400">Not Specified</div>
                <?php } ?>
            </div>
            <!-- features -->
            <div class=" mt-4 rounded shadow bg-white p-4">
                <div class=" text-lg font-semibold">Features / Amenities</div>
                <?php if ($property['features']) { ?>
                    <div class=" mt-4"><?php echo htmlspecialchars($property['features']) ?></div>
                <?php } else { ?>
                    <div class=" mt-4 text-center font-bold text-3xl text-gray-400">Not Specified</div>
                <?php } ?>
            </div>
            <!-- landlord -->
            <div class=" mt-4 rounded shadow bg-white p-4">
                <div class=" text-lg font-semibold">Landlord</div>
                <div class=" mt-4"><?php echo htmlspecialchars($landlord['first_name']) ?> <?php echo htmlspecialchars($landlord['last_name']) ?></div>
                <div class=" text-sm font-semibold"><?php echo htmlspecialchars($landlord['email']) ?></div>
            </div>
            <!-- others -->
            <div class=" mt-4 rounded shadow bg-white p-4 flex gap-4 flex-wrap">
                <!-- price -->
                <div class=""><span class=" font-semibold">Price:</span> <span class=" capitalize">&#8358;<?php echo htmlspecialchars(number_format($property['price'])) ?></span></div>
                <!-- status -->
                <div class=""><span class=" font-semibold">Status:</span> <span class=" capitalize"><?php echo htmlspecialchars($property['status']) ?></span></div>
                <!-- type -->
                <div class=""><span class=" font-semibold">Type:</span> <span class=" capitalize"><?php echo htmlspecialchars($property['type']) ?></span></div>
                <!-- size -->
                <div class=""><span class=" font-semibold">Size:</span> <span class=" capitalize"><?php echo htmlspecialchars($property['size']) ?></span> sqm</div>
                <!-- livingroom -->
                <div class=""><span class=" font-semibold">Livingroom:</span> <span class=" capitalize"><?php echo $property['livingroom'] ? htmlspecialchars($property['livingroom']) : 'NIL' ?></span></div>
                <!-- bedroom -->
                <div class=""><span class=" font-semibold">Bedroom:</span> <span class=" capitalize"><?php echo $property['bedroom'] ? htmlspecialchars($property['bedroom']) : 'NIL' ?></span></div>
                <!-- bathroom -->
                <div class=""><span class=" font-semibold">Bathroom:</span> <span class=" capitalize"><?php echo $property['bathroom'] ? htmlspecialchars($property['bathroom']) : 'NIL' ?></span></div>
                <!-- availability -->
                <div class=""><span class=" font-semibold">Availability:</span> <span class=" capitalize"><?php echo htmlspecialchars($property['availability']) ?></span></div>
                <!-- upload -->
                <div class=""><span class=" font-semibold">Upload:</span> <span class=" capitalize"><?php echo htmlspecialchars(date('d F, Y', strtotime($property['created_at']))) ?></span></div>
            </div>
            <!-- tenatnt -->
            <div class=" mt-4 rounded shadow bg-white p-4">
                <div class=" flex justify-between items-center">
                    <div class=" text-lg font-semibold">Tenant</div>
                    <a href="./rent_history.php?id=<?php echo htmlspecialchars($property['property_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-app-primary text-app-primary hover:bg-app-primary hover:text-white">Rent History</a>
                </div>
                <?php if ($tenant) { ?>
                    <div class=" mt-4"><?php echo htmlspecialchars($tenant['first_name']) ?> <?php echo htmlspecialchars($tenant['last_name']) ?></div>
                    <div class=" text-sm font-semibold"><?php echo htmlspecialchars($tenant['email']) ?></div>
                    <div class=" mt-2"><span class=" font-semibold">Rent Start:</span> <span class=" capitalize"><?php echo htmlspecialchars(date('d F, Y', strtotime($property['rent_start']))) ?></span></div>
                    <div class=" mt-2"><span class=" font-semibold">Rent End:</span> <span class=" capitalize"><?php echo htmlspecialchars(date('d F, Y', strtotime($property['rent_end']))) ?></span></div>
                <?php } else { ?>
                    <div class=" mt-4 text-center font-bold text-3xl text-gray-400">No Active Tenant</div>
                    <?php if ($_SESSION['user']['user_type'] === 'admin') { ?>
                        <div class=" mt-4 text-center">
                            <a href="./add_tenant.php?property_id=<?php echo htmlspecialchars($property['property_id']) ?>" class=" font-semibold text-app-primary hover:underline">Add Tenant</a>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <!--  -->
            <?php if ($_SESSION['user']['user_type'] === 'admin') { ?>
                <div class=" mt-4 rounded shadow bg-white p-4 flex flex-wrap gap-4">
                    <a href="./property_edit.php?id=<?php echo htmlspecialchars($property['property_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white">Edit Property</a>
                    <form action="./includes/property/delete.php" method="post" onsubmit="return confirm(`Proceed to delete property`)">
                        <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($property['property_id']) ?>">
                        <button type="submit" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white">Delete Property</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
?>