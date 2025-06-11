<div class=" sticky top-0 p-4 bg-white shadow-md z-20">
    <div class=" flex items-center gap-4 lg:gap-6">
        <!-- menu btn -->
        <div id="toggle-dashboard-nav" class=" text-2xl cursor-pointer active:text-app-primary">
            <i class="fa-solid fa-bars-staggered"></i>
        </div>
        <!-- first name -->
        <div class=" flex-1 truncate text-2xl font-semibold">
            Hello <?php echo htmlspecialchars($_SESSION['user']['first_name']) ?>
        </div>
        <!-- profile -->
        <div class=" dashboard-top-dropdown-toggle relative cursor-pointer flex gap-2 items-center">
            <!-- avater -->
            <div class=" w-[40px] aspect-square rounded-full overflow-hidden bg-gray-500">
                <img src="./assets/man-placeholder.jpg" class=" w-full h-full object-cover" alt="">
            </div>
            <!-- username -->
            <div class=" hidden md:block">
                <div class=" font-semibold"><?php echo htmlspecialchars($_SESSION['user']['email']) ?></div>
            </div>
            <!-- arrow -->
            <div class=" drop-ic transition-all duration-500 text-gray-500">
                <i class="fa-solid fa-angle-down"></i>
            </div>
            <!-- dropdown -->
            <div class=" dashboard-top-dropdown transition-all duration-500 absolute right-0 top-[60px] bg-white border border-gray-100 shadow-lg rounded-md p-2 min-w-[180px]">
                <!-- profile -->
                <a href="./profile.php" class=" flex items-center text-sm font-semibold text-gray-500 py-2 px-4 hover:text-app-primary">
                    <div class=" w-[20px]">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div class="">Profile</div>
                </a>
                <div class=" w-full h-[1px] bg-gray-200"></div>
                <!-- logout -->
                 <form action="./includes/auth/logout.php" method="post" onsubmit="return confirm('Procceed to logout')" >
                <button class=" flex items-center text-sm font-semibold text-gray-500 py-1 px-4 hover:text-app-primary">
                    <div class=" w-[20px]">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </div>
                    <div class="">Log Out</div>
                </button>
                </form>
            </div>
        </div>
    </div>
</div>