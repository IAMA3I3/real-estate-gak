<?php

include './components/header.php';
userAccess(["user", "landlord", "admin"]);
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
            <div class=" text-2xl">Reset Password</div>
            <div class=" text-sm font-semibold"><?php echo htmlspecialchars($_SESSION['user']['email']) ?></div>
            <div class=" mt-8 w-full max-w-[700px] m-auto bg-white p-4 rounded shadow border">
                <form action="./includes/auth/reset_password.php" class=" app-form" method="post">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user']['user_id']) ?>">
                    <input type="hidden" name="location" value="profile">
                    <div class=" flex flex-col items-start gap-1 my-2">
                        <label for="password" class=" text-sm font-semibold text-gray-500">New Password</label>
                        <input type="password" name="password" id="password" class=" w-full py-2 px-4 rounded outline-none bg-app-secondary/15 focus:bg-app-secondary/25">
                        <?php if (isset($_SESSION['errors']['password'])) { ?>
                            <div class=" text-sm font-semibold text-red-500"><?php echo $_SESSION['errors']['password'] ?></div>
                        <?php } ?>
                    </div>
                    <div class=" flex flex-col items-start gap-1 my-2">
                        <label for="confirm_password" class=" text-sm font-semibold text-gray-500">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class=" w-full py-2 px-4 rounded outline-none bg-app-secondary/15 focus:bg-app-secondary/25">
                        <?php if (isset($_SESSION['errors']['confirm_password'])) { ?>
                            <div class=" text-sm font-semibold text-red-500"><?php echo $_SESSION['errors']['confirm_password'] ?></div>
                        <?php } ?>
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
unset($_SESSION['errors']);
?>