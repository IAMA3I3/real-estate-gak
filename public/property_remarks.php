<?php
ob_start();

include './components/header.php';
userAccess(['admin', 'landlord', 'user']);

if (!isset($_GET['id'])) {
    header('Location: ./dashboard_properties.php');
    exit;
}

$property = fetchById($pdo, $_GET['id'], "properties", "property_id");

if (!$property) {
    header('Location: ./dashboard_properties.php');
    exit;
}

$remarks = fetchAllBy($pdo, "remarks", "property_id", $_GET['id']);

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
                </div>
                <?php if ($_SESSION['user']['user_type'] === 'admin') { ?>
                    <div class="inline-block">
                        <a href="./property_remark_add.php?property_id=<?php echo htmlspecialchars($property['property_id']) ?>" class=" flex items-center justify-between sm:justify-normal md:text-lg gap-2 text-app-primary font-semibold hover:text-white transition border py-3 px-5 border-app-primary group bg-transparent relative">
                            <div class=" absolute top-0 left-0 bg-app-primary rounded-r-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                            <div class=" absolute top-0 right-0 bg-app-primary rounded-l-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                            <span class=" z-10 uppercase">Add New</span>
                            <i class="fa-solid fa-plus z-10"></i>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <?php if ($remarks) { ?>
                <div class=" mt-8">
                    <?php foreach ($remarks as $remark) { ?>
                        <div class=" my-2 bg-white rounded shadow border p-4">
                            <div class=" text-sm font-semibold"><?php echo htmlspecialchars(date('d M, Y', strtotime($remark['created_at']))) ?></div>
                            <div class=" mt-2"><?php echo nl2br(htmlspecialchars($remark['comment'])) ?></div>
                            <?php if ($_SESSION['user']['user_type'] === 'admin') { ?>
                                <div class=" mt-4 flex gap-2 flex-nowrap *:text-nowrap">
                                    <a href="./property_remark_edit.php?id=<?php echo htmlspecialchars($remark['remark_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white">Edit</a>
                                    <form action="./includes/remark/property_delete.php" method="post" onsubmit="return confirm(`Proceed to delete remark`)">
                                        <input type="hidden" name="remark_id" value="<?php echo htmlspecialchars($remark['remark_id']) ?>">
                                        <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($remark['property_id']) ?>">
                                        <button type="submit" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white">Delete</button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class=" mt-8 text-center text-4xl font-bold text-gray-300">No Remark Found</div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
?>