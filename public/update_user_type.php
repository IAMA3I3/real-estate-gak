<?php
ob_start();

include './components/header.php';
userAccess(['admin']);

if (!isset($_GET['id'])) {
    header('Location: ./users.php');
    exit;
}

$user = fetchById($pdo, $_GET['id'], "users", "user_id");
if (!$user) {
    header('Location: ./users.php');
    exit;
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
            <div class=" text-2xl">Update User Type</div>
            <div class=" text-sm font-semibold"><?php echo htmlspecialchars($user['email']) ?></div>
            <div class=" mt-8 w-full max-w-[700px] m-auto bg-white p-4 rounded shadow border">
                <form action="./includes/auth/update_type.php" class=" app-form" method="post">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']) ?>">
                    <div class=" flex flex-col items-start gap-1 my-2">
                        <label for="user_type" class=" text-sm font-semibold text-gray-500">User Type</label>
                        <select name="user_type" id="user_type" class=" w-full py-2 px-4 rounded outline-none bg-app-secondary/15 focus:bg-app-secondary/25">
                            <option <?php echo $user['user_type'] === 'user' ? 'selected' : '' ?> value="user">User</option>
                            <option <?php echo $user['user_type'] === 'landlord' ? 'selected' : '' ?> value="landlord">Landlord</option>
                            <option <?php echo $user['user_type'] === 'admin' ? 'selected' : '' ?> value="admin">Admin</option>
                        </select>
                    </div>
                    <div class=" mt-4 flex justify-center">
                        <button class=" py-2 px-6 rounded bg-app-secondary text-white hover:bg-app-primary">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
?>