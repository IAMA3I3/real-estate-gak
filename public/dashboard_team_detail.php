<?php
ob_start();

include './components/header.php';
userAccess(['admin']);

if (!isset($_GET['id'])) {
    header('Location: ./dashboard_team.php');
    exit;
}

$member = fetchById($pdo, $_GET['id'], "team", "id");

if (!$member) {
    header('Location: ./dashboard_team.php');
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
            <div class=" flex flex-col md:flex-row *:w-full items-center gap-8">
                <!-- img -->
                <div class=" flex items-center justify-center">
                    <div class=" w-[80%] max-w-[400px] aspect-[3/4] relative">
                        <div class=" absolute bottom-0 left-0 w-[90%] h-[90%] rounded bg-app-secondary"></div>
                        <div class=" absolute top-0 right-0 w-[90%] h-[90%] rounded overflow-hidden shadow">
                            <img src="<?php echo ($member['img']) ? './includes/team/' . htmlspecialchars($member['img']) : './assets/man-placeholder.jpg' ?>" class=" w-full h-full object-cover object-top" alt="">
                        </div>
                    </div>
                </div>
                <!-- text -->
                <div class="">
                    <div class=" text-lg font-semibold font-playfair text-app-primary">About Our Attorney</div>
                    <div class=" mt-1 text-2xl font-bold font-playfair"><?php echo htmlspecialchars($member['name']) ?></div>
                    <div class=" mt-4"><?php echo nl2br(htmlspecialchars($member['bio'])) ?></div>
                </div>
            </div>
            <!--  -->
            <div class=" mt-4 flex flex-col sm:flex-row md:flex-col lg:flex-row gap-2 *:w-full">
                <a href="./team-bio.php?id=<?php echo $member['id'] ?>" target="_blank" class=" rounded-sm py-2 px-6 text-xs font-semibold bg-app-secondary text-white hover:bg-app-primary text-center"><i class="fa-solid fa-arrow-up-right-from-square"></i> Go To</a>
                <a href="./team-edit.php?id=<?php echo $member['id'] ?>" class=" rounded-sm py-2 px-6 text-xs font-semibold border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white text-center"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                <form action="./includes/team/delete-member.php" method="post" onsubmit="return confirm('Proceed to delete');">
                    <input type="hidden" name="id" value="<?php echo $member['id'] ?>">
                    <input type="hidden" name="file" value="<?php echo htmlspecialchars($member['img']) ?>">
                    <button class=" w-full rounded-sm py-2 px-6 text-xs font-semibold border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white"><i class="fa-solid fa-arrow-up-right-from-square"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end container -->

<?php

include './components/footer.php';
?>