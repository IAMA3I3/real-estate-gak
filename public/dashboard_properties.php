<?php

include './components/header.php';
userAccess(['admin', 'landlord']);

$properties = fetchAll($pdo, "properties");

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
            <div class=" flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class=" text-2xl text-center sm:text-left">Properties</div>
                <?php if ($_SESSION['user']['user_type'] === 'admin') { ?>
                    <div class="inline-block">
                        <a href="./property_add.php" class=" flex items-center justify-between sm:justify-normal md:text-lg gap-2 text-app-primary font-semibold hover:text-white transition border py-3 px-5 border-app-primary group bg-transparent relative">
                            <div class=" absolute top-0 left-0 bg-app-primary rounded-r-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                            <div class=" absolute top-0 right-0 bg-app-primary rounded-l-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                            <span class=" z-10 uppercase">Add New</span>
                            <i class="fa-solid fa-plus z-10"></i>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <!--  -->
            <div class=" mt-4 pb-2 w-full overflow-x-auto scrollbar small-scrollbar">
                <table class="datatable display nowrap w-full min-w-[800px] border border-gray-200 rounded-lg overflow-hidden shadow text-sm text-left text-gray-700">
                    <thead class="bg-gray-300 text-gray-800 font-semibold">
                        <tr>
                            <th class="px-6 py-4">S/N</th>
                            <th class="px-6 py-4">Image</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Address</th>
                            <?php if ($_SESSION['user']['user_type'] === 'admin') { ?>
                                <th class="px-6 py-4">Landlord</th>
                            <?php } ?>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Type</th>
                            <th class="px-6 py-4">Availability</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($properties as $property) { ?>
                            <?php $landlord = fetchById($pdo, $property['landlord_id'], "users", "user_id") ?>
                            <tr data-href="dashboard_property_detail.php?id=<?php echo htmlspecialchars($property['property_id']) ?>" class="hover:bg-blue-50 transition cursor-pointer">
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $sn++ ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class=" w-[50px] aspect-square rounded overflow-hidden">
                                        <img src="<?php echo $property['images'] ? './includes/property/' . explode(', ', $property['images'])[0] : './assets/showcase.png' ?>" class=" w-full h-full object-cover" alt="">
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class=" max-w-[300px] text-wrap line-clamp-2"><?php echo htmlspecialchars($property['name']) ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class=" max-w-[200px] text-wrap line-clamp-2"><?php echo htmlspecialchars($property['address']) ?></div>
                                </td>
                                <?php if ($_SESSION['user']['user_type'] === 'admin') { ?>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($landlord['first_name']) ?> <?php echo htmlspecialchars($landlord['last_name']) ?></td>
                                <?php } ?>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class=" text-xs font-semibold uppercase"><?php echo htmlspecialchars($property['status']) ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class=" text-xs font-semibold uppercase"><?php echo htmlspecialchars($property['type']) ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class=" text-xs font-semibold uppercase"><?php echo htmlspecialchars($property['availability']) ?></div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
?>