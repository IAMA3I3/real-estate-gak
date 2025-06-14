<?php
ob_start();

include './components/header.php';
userAccess(['admin']);

if (!isset($_GET['property_id'])) {
    header('Location: ./dashboard_properties.php');
    exit;
}

$property = fetchById($pdo, $_GET['property_id'], "properties", "property_id");

if (!$property) {
    header('Location: ./dashboard_properties.php');
    exit;
}

$users = fetchUsers($pdo);

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
            <div class=" text-xl font-semibold"><?php echo htmlspecialchars($property['name']) ?></div>
            <div class=" mt-4 rounded shadow bg-white border p-4 w-full max-w-[700px] m-auto">
                <div class=" text-lg font-semibold">Add From Users</div>
                <form action="./includes/tenant/add.php" method="post" class=" app-form w-full mt-4">
                    <div class=" flex flex-col items-start gap-1 my-2">
                        <label for="tenant" class=" text-sm font-semibold text-gray-500">Tenant</label>
                        <select name="tenant" id="tenant" class=" w-full py-2 px-4 rounded outline-none bg-app-secondary/15 focus:bg-app-secondary/25">
                            <option value="">Select Tenant</option>
                            <?php foreach ($users as $user) { ?>
                                <option <?php echo isset($_SESSION['input_data']['tenant']) && !isset($_SESSION['errors']['tenant']) && $_SESSION['input_data']['tenant'] === $user['user_id'] ? 'selected' : '' ?> value="<?php echo $user['user_id'] ?>"><?php echo htmlspecialchars($user['first_name']) ?> <?php echo htmlspecialchars($user['last_name']) ?> - <?php echo htmlspecialchars($user['email']) ?></option>
                            <?php } ?>
                        </select>
                        <?php if (isset($_SESSION['errors']['tenant'])) { ?>
                            <div class=" text-sm font-semibold text-red-500"><?php echo $_SESSION['errors']['tenant'] ?></div>
                        <?php } ?>
                    </div>
                    <div class=" flex flex-col items-start gap-1 my-2">
                        <label for="rent_start" class=" text-sm font-semibold text-gray-500">Rent Start</label>
                        <input type="date" name="rent_start" id="rent_start" class=" w-full py-2 px-4 rounded outline-none bg-app-secondary/15 focus:bg-app-secondary/25">
                        <?php if (isset($_SESSION['errors']['tenant'])) { ?>
                            <div class=" text-sm font-semibold text-red-500"><?php echo $_SESSION['errors']['tenant'] ?></div>
                        <?php } ?>
                    </div>
                    <div class=" mt-4 flex justify-center">
                        <button class=" py-2 px-6 rounded bg-app-secondary text-white hover:bg-app-primary">SUBMIT</button>
                    </div>
                </form>
            </div>
            <div class=" mt-4 text-xl font-semibold text-gray-400 text-center">OR</div>
            <!-- new tenant -->
            <div class=" mt-8 rounded shadow bg-white border p-4 w-full max-w-[700px] m-auto">
                <div class=" text-lg font-semibold">Create New Tenant</div>
                <form action="./includes/tenant/create.php" method="post" class=" app-form w-full mt-4">
                    <input type="hidden" name="password" value="123456">
                    <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($property['property_id']) ?>">
                    <div class=" flex flex-col items-start gap-1 my-2">
                        <label for="first_name" class=" text-sm font-semibold text-gray-500">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="<?php echo (isset($_SESSION['input_data']['first_name']) && !isset($_SESSION['errors']['first_name'])) ? htmlspecialchars($_SESSION['input_data']['first_name']) : '' ?>" class=" w-full py-2 px-4 rounded outline-none bg-app-secondary/15 focus:bg-app-secondary/25">
                        <?php if (isset($_SESSION['errors']['first_name'])) { ?>
                            <div class=" text-sm font-semibold text-red-500"><?php echo $_SESSION['errors']['first_name'] ?></div>
                        <?php } ?>
                    </div>
                    <div class=" flex flex-col items-start gap-1 my-2">
                        <label for="last_name" class=" text-sm font-semibold text-gray-500">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="<?php echo (isset($_SESSION['input_data']['last_name']) && !isset($_SESSION['errors']['last_name'])) ? htmlspecialchars($_SESSION['input_data']['last_name']) : '' ?>" class=" w-full py-2 px-4 rounded outline-none bg-app-secondary/15 focus:bg-app-secondary/25">
                        <?php if (isset($_SESSION['errors']['last_name'])) { ?>
                            <div class=" text-sm font-semibold text-red-500"><?php echo $_SESSION['errors']['last_name'] ?></div>
                        <?php } ?>
                    </div>
                    <div class=" flex flex-col items-start gap-1 my-2">
                        <label for="email" class=" text-sm font-semibold text-gray-500">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo (isset($_SESSION['input_data']['email']) && !isset($_SESSION['errors']['email'])) ? htmlspecialchars($_SESSION['input_data']['email']) : '' ?>" class=" w-full py-2 px-4 rounded outline-none bg-app-secondary/15 focus:bg-app-secondary/25">
                        <?php if (isset($_SESSION['errors']['email'])) { ?>
                            <div class=" text-sm font-semibold text-red-500"><?php echo $_SESSION['errors']['email'] ?></div>
                        <?php } ?>
                    </div>
                    <div class=" flex flex-col items-start gap-1 my-2">
                        <label for="phone" class=" text-sm font-semibold text-gray-500">Phone</label>
                        <input type="text" name="phone" id="phone" value="<?php echo (isset($_SESSION['input_data']['phone']) && !isset($_SESSION['errors']['phone'])) ? htmlspecialchars($_SESSION['input_data']['phone']) : '' ?>" class=" w-full py-2 px-4 rounded outline-none bg-app-secondary/15 focus:bg-app-secondary/25">
                        <?php if (isset($_SESSION['errors']['phone'])) { ?>
                            <div class=" text-sm font-semibold text-red-500"><?php echo $_SESSION['errors']['phone'] ?></div>
                        <?php } ?>
                    </div>
                    <div class=" mt-4 flex justify-center">
                        <button class=" py-2 px-6 rounded bg-app-secondary text-white hover:bg-app-primary">SUBMIT</button>
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
unset($_SESSION['input_data']);
?>