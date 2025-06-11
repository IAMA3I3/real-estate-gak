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
                <!-- login -->
                <div class="">
                    <div class=" text-lg text-center">SIGN IN</div>
                    <?php if (isset($_SESSION['errors']['default'])) { ?>
                        <div class=" text-center font-semibold text-red-500"><?php echo $_SESSION['errors']['default'] ?></div>
                    <?php } ?>
                    <form action="./includes/auth/login.php" method="post" class=" app-form w-full mt-4">
                        <div class=" flex flex-col items-start gap-1 my-2">
                            <label for="email" class=" text-sm font-semibold text-gray-500">Email</label>
                            <input type="email" name="email" id="email" class=" w-full py-2 px-4 rounded outline-none bg-app-secondary/15 focus:bg-app-secondary/25">
                            <?php if (isset($_SESSION['errors']['email'])) { ?>
                                <div class=" text-sm font-semibold text-red-500"><?php echo $_SESSION['errors']['email'] ?></div>
                            <?php } ?>
                        </div>
                        <div class=" flex flex-col items-start gap-1 my-2">
                            <label for="password" class=" text-sm font-semibold text-gray-500">Password</label>
                            <input type="password" name="password" id="password" class=" w-full py-2 px-4 rounded outline-none bg-app-secondary/15 focus:bg-app-secondary/25">
                            <?php if (isset($_SESSION['errors']['password'])) { ?>
                                <div class=" text-sm font-semibold text-red-500"><?php echo $_SESSION['errors']['password'] ?></div>
                            <?php } ?>
                        </div>
                        <div class=" mt-4 flex justify-center">
                            <button class=" py-2 px-6 rounded bg-app-secondary text-white hover:bg-app-primary">LOGIN</button>
                        </div>
                    </form>
                    <div class=" mt-4 text-sm font-semibold text-gray-600 text-center">
                        Don't have an account? <a href="./sign_up.php" class=" text-app-secondary hover:underline">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include './components/footer.php';
unset($_SESSION['errors']);
?>