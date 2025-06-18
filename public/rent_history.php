<?php

include './components/header.php';
userAccess(['admin', 'landlord', 'user']);

$rents = fetchAll($pdo, "rents");
$property = null;

if (isset($_GET['property_id'])) {
    $rents = fetchAllBy($pdo, "rents", "property_id", $_GET['property_id']);
    $property = fetchById($pdo, $_GET['property_id'], "properties", "property_id");
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
            <?php if ($property) { ?>
                <div class=" text-sm font-semibold"><?php echo htmlspecialchars($property['name']) ?></div>
            <?php } ?>
            <div class=" mt-4 pb-2 w-full overflow-x-auto scrollbar small-scrollbar">
                <table class="datatable display nowrap w-full min-w-[800px] border border-gray-200 rounded-lg overflow-hidden shadow text-sm text-left text-gray-700">
                    <thead class="bg-gray-300 text-gray-800 font-semibold">
                        <tr>
                            <th class="px-6 py-4">S/N</th>
                            <th class="px-6 py-4">Property</th>
                            <th class="px-6 py-4">Address</th>
                            <?php if ($_SESSION['user']['user_type'] === 'admin' || $_SESSION['user']['user_type'] === 'user') { ?>
                                <th class="px-6 py-4">Landlord</th>
                            <?php } ?>
                            <?php if ($_SESSION['user']['user_type'] === 'admin' || $_SESSION['user']['user_type'] === 'landlord') { ?>
                                <th class="px-6 py-4">Tenant</th>
                            <?php } ?>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Rent Start</th>
                            <th class="px-6 py-4">Rent End</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($rents as $rent) { ?>
                            <?php
                            $property = fetchById($pdo, $rent['property_id'], "properties", "property_id");
                            $landlord = fetchById($pdo, $rent['landlord_id'], "users", "user_id");
                            $tenant = fetchById($pdo, $rent['tenant_id'], "users", "user_id");
                            ?>
                            <?php if ($_SESSION['user']['user_type'] === 'landlord') { ?>
                                <?php if ($rent['landlord_id'] === $_SESSION['user']['user_id']) { ?>
                                    <tr class="hover:bg-blue-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $sn++ ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class=" max-w-[300px] text-wrap line-clamp-2"><?php echo htmlspecialchars($property['name']) ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class=" max-w-[300px] text-wrap line-clamp-2"><?php echo htmlspecialchars($property['address']) ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="">
                                                <div class=""><?php echo htmlspecialchars($tenant['first_name']) ?> <?php echo htmlspecialchars($tenant['last_name']) ?></div>
                                                <div class=" text-xs font-semibold"><?php echo htmlspecialchars($tenant['email']) ?></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class=" text-xs font-semibold uppercase"><?php echo htmlspecialchars($rent['status']) ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars(date('d F, Y', strtotime($rent['rent_start']))) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars(date('d F, Y', strtotime($rent['rent_end']))) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class=" flex gap-2 flex-nowrap *:text-nowrap">
                                                <a href="./rent_documents.php?rent_id=<?php echo htmlspecialchars($rent['rent_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white">Documents</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } elseif ($_SESSION['user']['user_type'] === 'user') { ?>
                                <?php if ($rent['tenant_id'] === $_SESSION['user']['user_id']) { ?>
                                    <tr class="hover:bg-blue-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $sn++ ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class=" max-w-[300px] text-wrap line-clamp-2"><?php echo htmlspecialchars($property['name']) ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class=" max-w-[300px] text-wrap line-clamp-2"><?php echo htmlspecialchars($property['address']) ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="">
                                                <div class=""><?php echo htmlspecialchars($landlord['first_name']) ?> <?php echo htmlspecialchars($landlord['last_name']) ?></div>
                                                <div class=" text-xs font-semibold"><?php echo htmlspecialchars($landlord['email']) ?></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class=" text-xs font-semibold uppercase"><?php echo htmlspecialchars($rent['status']) ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars(date('d F, Y', strtotime($rent['rent_start']))) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars(date('d F, Y', strtotime($rent['rent_end']))) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class=" flex gap-2 flex-nowrap *:text-nowrap">
                                                <a href="./rent_documents.php?rent_id=<?php echo htmlspecialchars($rent['rent_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white">Documents</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $sn++ ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class=" max-w-[300px] text-wrap line-clamp-2"><?php echo htmlspecialchars($property['name']) ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class=" max-w-[300px] text-wrap line-clamp-2"><?php echo htmlspecialchars($property['address']) ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="">
                                            <div class=""><?php echo htmlspecialchars($landlord['first_name']) ?> <?php echo htmlspecialchars($landlord['last_name']) ?></div>
                                            <div class=" text-xs font-semibold"><?php echo htmlspecialchars($landlord['email']) ?></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="">
                                            <div class=""><?php echo htmlspecialchars($tenant['first_name']) ?> <?php echo htmlspecialchars($tenant['last_name']) ?></div>
                                            <div class=" text-xs font-semibold"><?php echo htmlspecialchars($tenant['email']) ?></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class=" text-xs font-semibold uppercase"><?php echo htmlspecialchars($rent['status']) ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars(date('d F, Y', strtotime($rent['rent_start']))) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars(date('d F, Y', strtotime($rent['rent_end']))) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class=" flex gap-2 flex-nowrap *:text-nowrap">
                                            <a title="Documents" href="./rent_documents.php?rent_id=<?php echo htmlspecialchars($rent['rent_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white"><i class="fa-solid fa-file"></i></a>
                                            <a title="Remark" href="./rent_documents.php?rent_id=<?php echo htmlspecialchars($rent['rent_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-app-primary text-app-primary hover:bg-app-primary hover:text-white"><i class="fa-solid fa-comment-dots"></i></a>
                                            <form action="./includes/tenant/terminate.php" method="post" onsubmit="return confirm(`Proceed to terminate tenant`)">
                                                <input type="hidden" name="rent_id" value="<?php echo htmlspecialchars($rent['rent_id']) ?>">
                                                <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($rent['property_id']) ?>">
                                                <button title="Terminate" type="submit" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white"><i class="fa-solid fa-calendar-xmark"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
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