<?php

include './components/header.php';
?>

<div class=" min-h-screen bg-center bg-no-repeat bg-cover" style="background-image: url(./assets/showcase.png);">
    <div class=" w-full h-full min-h-screen bg-app-secondary/70 flex justify-center items-center p-2 md:p-4">
        <div class=" w-full max-w-[600px] p-2 md:p-4 rounded-md bg-white/15">
            <div class=" w-full p-2 md:p-4 rounded bg-white/80 backdrop-blur-sm">
                <div class=" flex justify-center">
                    <img src="./assets/logo.png" class=" w-[100px]" alt="">
                </div>
                <!-- sign up -->
                <div class="">
                    <div class=" text-lg text-center">SIGN UP</div>
                    <form action="./includes/auth/register.php" method="post" class=" app-form w-full mt-4">
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
                        <div class=" flex flex-col items-start gap-1 my-2">
                            <label for="password" class=" text-sm font-semibold text-gray-500">Password</label>
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
                            <button class=" py-2 px-6 rounded bg-app-secondary text-white hover:bg-app-primary">REGISTER</button>
                        </div>
                    </form>
                    <div class=" mt-4 text-sm font-semibold text-gray-600 text-center">
                        Already have an account? <a href="./sign_in.php" class=" text-app-secondary hover:underline">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include './components/footer.php';
unset($_SESSION['errors']);
unset($_SESSION['input_data']);
?>