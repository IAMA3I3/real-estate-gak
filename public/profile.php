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
            <div class=" flex justify-between gap-4 flex-wrap">
                <div class=" text-xl font-semibold">Profile</div>
                <div class="">
                    <a href="./reset_password.php" class=" text-xs font-semibold text-app-primary py-2 px-4 rounded border-2 border-app-primary bg-transparent hover:bg-app-primary hover:text-white">Reset Password</a>
                </div>
            </div>
            <div class=" mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <!--  -->
                <div class=" rounded-lg p-4 border shadow bg-white">
                    <div class=" text-sm text-primary font-semibold">Name:</div>
                    <div class=" text-lg"><?php echo htmlspecialchars($_SESSION['user']['first_name']) ?> <?php echo htmlspecialchars($_SESSION['user']['last_name']) ?></div>
                </div>
                <!--  -->
                <div class=" rounded-lg p-4 border shadow bg-white">
                    <div class=" text-sm text-primary font-semibold">Email:</div>
                    <div class=" text-lg"><?php echo htmlspecialchars($_SESSION['user']['email']) ?></div>
                </div>
                <!--  -->
                <div class=" rounded-lg p-4 border shadow bg-white">
                    <div class=" text-sm text-primary font-semibold">Type:</div>
                    <div class=" text-sm font-semibold uppercase"><?php echo htmlspecialchars($_SESSION['user']['user_type']) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
?>