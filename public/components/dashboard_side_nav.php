<?php

$navLinks = [
    ['name' => 'Dashboard', 'url' => './admin_dashboard.php', 'isActive' => isPageActive('admin_dashboard.php'), 'ic' => '<i class="fa-solid fa-house"></i>', 'access' => ["admin"]],
    ['name' => 'Dashboard', 'url' => './landlord_dashboard.php', 'isActive' => isPageActive('landlord_dashboard.php'), 'ic' => '<i class="fa-solid fa-house"></i>', 'access' => ["landlord"]],
    ['name' => 'Dashboard', 'url' => './user_dashboard.php', 'isActive' => isPageActive('user_dashboard.php'), 'ic' => '<i class="fa-solid fa-house"></i>', 'access' => ["user"]],
    ['name' => 'Users', 'url' => './users.php', 'isActive' => isPageActive('users.php') || isPageActive('update_user_type.php') || isPageActive('reset_user_password.php'), 'ic' => '<i class="fa-solid fa-users"></i>', 'access' => ["admin"]],
    ['name' => 'Locations', 'url' => './locations.php', 'isActive' => isPageActive('locations.php') || isPageActive('location_add.php') || isPageActive('location_edit.php'), 'ic' => '<i class="fa-solid fa-location-dot"></i>', 'access' => ["admin"]],
    ['name' => 'Properties', 'url' => './dashboard_properties.php', 'isActive' => isPageActive('dashboard_properties.php') || isPageActive('dashboard_property_detail.php') || isPageActive('property_add.php') || isPageActive('property_edit.php') || isPageActive('add_tenant.php'), 'ic' => '<i class="fa-solid fa-city"></i>', 'access' => ["admin", "landlord"]],
    ['name' => 'Rents', 'url' => './rent_history.php', 'isActive' => isPageActive('rent_history.php') || isPageActive('rent_documents.php') || isPageActive('upload_rent_document.php'), 'ic' => '<i class="fa-solid fa-house-user"></i>', 'access' => ["admin", "landlord", "user"]],
    ['name' => 'Blog', 'url' => './dashboard_blog.php', 'isActive' => isPageActive('dashboard_blog.php') || isPageActive('dashboard_blog_detail.php') || isPageActive('blog_add.php') || isPageActive('blog_edit.php'), 'ic' => '<i class="fa-solid fa-blog"></i>', 'access' => ["admin"]],
    ['name' => 'Team', 'url' => './dashboard_team.php', 'isActive' => isPageActive('dashboard_team.php') || isPageActive('dashboard_team_detail.php') || isPageActive('team_add.php') || isPageActive('team_edit.php'), 'ic' => '<i class="fa-solid fa-people-group"></i>', 'access' => ["admin"]]
];

?>

<div class=" dashboard-nav-container scrollbar small-scrollbar transition-all duration-500">
    <div class=" p-4 border-b border-gray-300 sticky top-0 bg-white z-10">
        <a href="./index.php">
            <img src="./assets/logo.png" class=" w-[120px]" alt="">
        </a>
    </div>
    <!-- navs -->
    <div class=" py-4">
        <!-- nav links -->
        <?php foreach ($navLinks as $navLink) { ?>
            <?php if (in_array($_SESSION['user']['user_type'], $navLink['access'])) { ?>
                <a href="<?php echo $navLink['url'] ?>" class="<?php echo $navLink['isActive'] ? ' text-app-primary' : ' text-gray-500'; ?> nav-dropdown-toggle cursor-pointer py-2 px-4 hover:bg-gray-200 flex items-center font-semibold">
                    <div class=" w-[30px]">
                        <?php echo $navLink['ic'] ?>
                    </div>
                    <div class=" flex-1 truncate"><?php echo $navLink['name'] ?></div>
                </a>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<div id="toggle-dashboard-nav" class=" dashboard-nav-overlay md:hidden fixed top-0 left-0 w-full h-full bg-black/15 transition-all duration-500"></div>