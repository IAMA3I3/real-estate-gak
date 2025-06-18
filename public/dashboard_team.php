<?php

include './components/header.php';
userAccess(['admin']);

$team = fetchAll($pdo, "team");

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
                <div class=" text-2xl text-center sm:text-left">Team</div>
                <div class="inline-block">
                    <a href="./team-add.php" class=" flex items-center justify-between sm:justify-normal md:text-lg gap-2 text-app-primary font-semibold hover:text-white transition border py-3 px-5 border-app-primary group bg-transparent relative">
                        <div class=" absolute top-0 left-0 bg-app-primary rounded-r-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                        <div class=" absolute top-0 right-0 bg-app-primary rounded-l-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                        <span class=" z-10 uppercase">Add New</span>
                        <i class="fa-solid fa-plus z-10"></i>
                    </a>
                </div>
            </div>
            <!--  -->
            <?php if ($team) { ?>
                <div class=" mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    <?php foreach ($team as $i) { ?>
                        <div class=" w-full rounded overflow-hidden shadow-md">
                            <div class=" w-full aspect-[3/2]">
                                <img src="<?php echo ($i['img']) ? './includes/team/' . htmlspecialchars($i['img']) : './assets/man-placeholder.jpg' ?>" class=" w-full h-full object-cover object-top" alt="">
                            </div>
                            <div class=" px-2 py-4">
                                <div class=" font-semibold font-playfair truncate">
                                    <?php echo htmlspecialchars($i['name']) ?>
                                </div>
                                <div class=" mt-2 line-clamp-2">
                                    <?php echo nl2br(htmlspecialchars($i['bio'])) ?>
                                </div>
                                <div class=" mt-2 flex flex-col gap-2 *:w-full">
                                    <a href="./dashboard_team_detail.php?id=<?php echo $i['id'] ?>" class=" rounded-sm py-2 px-6 text-xs font-semibold bg-app-secondary text-white hover:bg-app-primary text-center"><i class="fa-solid fa-arrow-up-right-from-square"></i> Open</a>
                                    <a href="./team-edit.php?id=<?php echo $i['id'] ?>" class=" rounded-sm py-2 px-6 text-xs font-semibold border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white text-center"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    <form action="./includes/team/delete-member.php" method="post" onsubmit="return confirm('Proceed to delete');">
                                        <input type="hidden" name="id" value="<?php echo $i['id'] ?>">
                                        <input type="hidden" name="file" value="<?php echo htmlspecialchars($i['img']) ?>">
                                        <button class=" w-full rounded-sm py-2 px-6 text-xs font-semibold border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white"><i class="fa-solid fa-arrow-up-right-from-square"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class=" mt-8 text-center text-4xl font-bold text-gray-300">No Team Member Found</div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
?>