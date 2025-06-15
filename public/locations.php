<?php

include './components/header.php';
userAccess(['admin']);

$locations = fetchAll($pdo, "locations");
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
                <div class=" text-2xl text-center sm:text-left">Location</div>
                <div class="inline-block">
                    <a href="./location_add.php" class=" flex items-center justify-between sm:justify-normal md:text-lg gap-2 text-app-primary font-semibold hover:text-white transition border py-3 px-5 border-app-primary group bg-transparent relative">
                        <div class=" absolute top-0 left-0 bg-app-primary rounded-r-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                        <div class=" absolute top-0 right-0 bg-app-primary rounded-l-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                        <span class=" z-10 uppercase">Add New</span>
                        <i class="fa-solid fa-plus z-10"></i>
                    </a>
                </div>
            </div>
            <div class=" mt-4 pb-2 w-full overflow-x-auto scrollbar small-scrollbar">
                <table class="datatable display nowrap w-full min-w-[800px] border border-gray-200 rounded-lg overflow-hidden shadow text-sm text-left text-gray-700">
                    <thead class="bg-gray-300 text-gray-800 font-semibold">
                        <tr>
                            <th class="px-6 py-4">S/N</th>
                            <th class="px-6 py-4">Image</th>
                            <th class="px-6 py-4">Location</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($locations as $location) { ?>
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $sn++ ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class=" w-[50px] aspect-square rounded overflow-hidden">
                                        <img src="<?php echo $location['image'] ? './includes/location/' . $location['image'] : './assets/showcase.png' ?>" class=" w-full h-full object-cover" alt="">
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($location['name']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class=" flex gap-2 flex-nowrap *:text-nowrap">
                                        <a href="./location_edit.php?id=<?php echo htmlspecialchars($location['location_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white">Edit Location</a>
                                        <form action="./includes/location/delete.php" method="post" onsubmit="return confirm(`Proceed to delete location`)">
                                            <input type="hidden" name="location_id" value="<?php echo htmlspecialchars($location['location_id']) ?>">
                                            <button type="submit" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white">Delete</button>
                                        </form>
                                    </div>
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