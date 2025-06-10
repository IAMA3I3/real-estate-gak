<?php

include './components/header.php';
include './components/top_nav.php';
include './components/showcase.php';
?>

<!-- contact -->
<div class=" mt-32 py-16 bg-gray-200">
    <div class=" container">
        <div class=" flex flex-col-reverse md:flex-row gap-16 *:w-full">
            <!-- info -->
            <div class="">
                <div class=" -translate-y-32 md:translate-y-0">
                    <div class=" mt-4 flex flex-col gap-4">
                        <div class=" flex">
                            <div class=" text-app-primary w-[30px] flex-none">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <span>81, CMD Road, Magodo Phase II, Shangisha, Lagos State.</span>
                        </div>
                        <!--  -->
                        <div class=" flex">
                            <div class=" text-app-primary w-[30px] flex-none">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <span>32, Ajibodu street, Karaole Estate, Ifako Ijaiye, Lagos State.</span>
                        </div>
                        <!--  -->
                        <div class=" flex">
                            <div class=" text-app-primary w-[30px] flex-none">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <span>2 Batchelor Street Chatham, Kent ME4 4BJ</span>
                        </div>
                        <!--  -->
                        <a href="mailto:info@gadekelanichambers.com" class=" flex">
                            <div class=" text-app-primary w-[30px] flex-none">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <span>info@gadekelanichambers.com</span>
                        </a>
                        <!--  -->
                        <a href="tel:+2348023345854" class=" flex">
                            <div class=" text-app-primary w-[30px] flex-none">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <span>(+234) 802 3345 854</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- form -->
            <div class="">
                <div class=" w-full p-8 rounded-lg bg-gray-100 shadow-lg -translate-y-32">
                    <div class=" text-2xl font-semibold font-playfair">Get In Touch</div>
                    <div class="">Contact us for expert support.</div>
                    <form action="" class=" mt-8 w-full">
                        <input type="text" placeholder="Your Name*" class=" outline-none pb-2 border-b border-gray-400 bg-transparent w-full focus:border-app-primary my-2" name="name" id="name">
                        <input type="email" placeholder="Email*" class=" outline-none pb-2 border-b border-gray-400 bg-transparent w-full focus:border-app-primary my-2" name="email" id="email">
                        <input type="tel" placeholder="Phone No." class=" outline-none pb-2 border-b border-gray-400 bg-transparent w-full focus:border-app-primary my-2" name="phone" id="phone">
                        <input type="text" placeholder="Subject" class=" outline-none pb-2 border-b border-gray-400 bg-transparent w-full focus:border-app-primary my-2" name="subject" id="subject">
                        <label class=" mt-4 text-gray-600" for="detail">Message</label>
                        <textarea name="detail" id="detail" class=" w-full min-h-[150px] bg-app-primary/10 border border-app-primary/20 focus:border-app-primary focus:bg-app-primary/20 resize-y outline-none p-2"></textarea>
                        <div class=" inline-block mt-4">
                            <button type="submit" class=" flex items-center justify-between sm:justify-normal md:text-lg gap-2 text-app-primary font-semibold hover:text-white transition border py-3 px-5 border-app-primary group bg-transparent relative">
                                <div class=" absolute top-0 left-0 bg-app-primary rounded-r-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                                <div class=" absolute top-0 right-0 bg-app-primary rounded-l-md h-full w-0 group-hover:w-[60%] transition-all duration-500"></div>
                                <span class=" z-10 uppercase">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include './components/footer_main.php';
include './components/footer.php';
?>