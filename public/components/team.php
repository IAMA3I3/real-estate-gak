<?php

$team = fetchAll($pdo, "team");
?>

<div class=" py-16">
    <div class=" container">
        <div class=" w-full max-w-[500px] m-auto text-center">
            <div class=" text-2xl font-bold font-playfair">Our Team</div>
            <div class=" mt-2">
                Meet our dedicated team of real estate experts, committed to helping you buy, sell, or invest with confidence.
            </div>
        </div>
        <!--  -->
        <div class=" mt-8 w-full">
            <?php if ($team) { ?>
                <div class=" relative swiper primary-swiper">
                    <div class=" swiper-wrapper">
                        <?php foreach ($team as $i) { ?>
                            <div class=" swiper-slide">
                                <div class=" group rounded overflow-hidden shadow aspect-[2/3] bg-app-secondary border border-gray-200">
                                    <div class=" h-[70%]">
                                        <img src="<?php echo ($i['img']) ? './includes/team/' . htmlspecialchars($i['img']) : './assets/man-placeholder.jpg' ?>" class=" h-full w-full object-cover object-top" alt="">
                                    </div>
                                    <div class=" h-[30%] p-2">
                                        <div class=" relative h-full border border-app-primary flex justify-center items-center p-4">
                                            <div class=" text-app-primary font-semibold font-playfair text-center group-hover:-translate-y-8 group-hover:opacity-0 group-hover:invisible transition-all duration-500">
                                                <?php echo htmlspecialchars($i['name']) ?>
                                            </div>
                                            <!--  -->
                                            <a href="./team-bio.php?id=<?php echo $i['id'] ?>" class=" absolute text-white font-semibold hover:text-app-primary uppercase translate-y-8 opacity-0 invisible group-hover:translate-y-0 group-hover:opacity-100 group-hover:visible transition-all duration-500">View Bio <i class="fa-solid fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class=" text-center text-4xl font-bold text-gray-300">No Team Member Found</div>
            <?php } ?>
        </div>
    </div>
</div>