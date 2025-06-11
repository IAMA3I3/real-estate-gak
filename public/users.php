<?php

include './components/header.php';
userAccess(['admin']);

$users = fetchAll($pdo, "users");
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
            <div class=" text-2xl">Users</div>
            <div class=" mt-4 pb-2 w-full overflow-x-auto scrollbar small-scrollbar">
                <table class="datatable display nowrap w-full min-w-[800px] border border-gray-200 rounded-lg overflow-hidden shadow text-sm text-left text-gray-700">
                    <thead class="bg-gray-300 text-gray-800 font-semibold">
                        <tr>
                            <th class="px-6 py-4">S/N</th>
                            <th class="px-6 py-4">First Name</th>
                            <th class="px-6 py-4">Last Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Type</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($users as $user) { ?>
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $sn++ ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($user['first_name']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($user['last_name']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($user['email']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs font-semibold uppercase"><?php echo htmlspecialchars($user['user_type']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($user['user_id'] !== $_SESSION['user']['user_id']) { ?>
                                        <div class=" flex gap-2 flex-nowrap *:text-nowrap">
                                            <a href="./update_user_type.php?id=<?php echo htmlspecialchars($user['user_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white">Update Type</a>
                                            <a href="./reset_user_password.php?id=<?php echo htmlspecialchars($user['user_id']) ?>" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-green-500 text-green-500 hover:bg-green-500 hover:text-white">Reset Password</a>
                                            <form action="./includes/auth/delete.php" method="post" onsubmit="return confirm(`Proceed to delete User`)">
                                                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']) ?>">
                                                <input type="hidden" name="location" value="users">
                                                <button type="submit" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white">Delete</button>
                                            </form>
                                        </div>
                                    <?php } else { ?>
                                        <a href="./profile.php" class=" text-xs font-semibold py-1 px-3 rounded bg-transparent border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white">My Profile</a>
                                    <?php } ?>
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