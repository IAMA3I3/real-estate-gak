<?php

include './components/header.php';
userAccess(['landlord']);
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
            <div class=" text-2xl">Dashboard</div>
            <div class="">Landlord</div>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
?>