<!-- display image -->
<div id="img-display" class=" pop transition-all duration-500 overflow-hidden fixed top-0 left-0 z-[10000] w-screen h-screen bg-black/80 flex justify-center items-center">
    <div class=" main transition-all duration-500 h-screen md:h-[80vh] w-full md:w-[80vw]">
        <img src="./assets/logo.png" alt="..." class=" w-full h-full object-contain">
    </div>
    <div id="left" class=" absolute left-4 sm:left-8 top-[50%] translate-y-[-50%] px-2 py-4 text-2xl md:text-4xl text-gray-400 hover:text-white bg-black/20 cursor-pointer"><i class="fa-solid fa-chevron-left"></i></div>
    <div id="right" class=" absolute right-4 sm:right-8 top-[50%] translate-y-[-50%] px-2 py-4 text-2xl md:text-4xl text-gray-400 hover:text-white bg-black/20 cursor-pointer"><i class="fa-solid fa-chevron-right"></i></div>
    <div class=" absolute top-8 right-4 sm:right-8 rounded-full border border-white w-[50px] h-[50px] flex justify-center items-center text-white hover:bg-app-primary hover:rotate-90 transition cursor-pointer text-2xl">
        <i class="fa-solid fa-xmark"></i>
    </div>
</div>
<!-- end display image -->

<!-- display video -->
<div id="video-display" class=" pop transition-all duration-500 overflow-hidden fixed top-0 left-0 z-[10000] w-screen h-screen bg-black/80 flex justify-center items-center">
    <div class=" main transition-all duration-500 h-screen md:h-[80vh] w-full md:w-[80vw]">
        <video src="" class=" w-full h-full object-contain" controls></video>
    </div>
    <div id="left" class=" absolute left-4 sm:left-8 top-[50%] translate-y-[-50%] px-2 py-4 text-2xl md:text-4xl text-gray-400 hover:text-white bg-black/20 cursor-pointer"><i class="fa-solid fa-chevron-left"></i></div>
    <div id="right" class=" absolute right-4 sm:right-8 top-[50%] translate-y-[-50%] px-2 py-4 text-2xl md:text-4xl text-gray-400 hover:text-white bg-black/20 cursor-pointer"><i class="fa-solid fa-chevron-right"></i></div>
    <div class=" absolute top-8 right-4 sm:right-8 rounded-full border border-white w-[50px] h-[50px] flex justify-center items-center text-white hover:bg-app-primary hover:rotate-90 transition cursor-pointer text-2xl">
        <i class="fa-solid fa-xmark"></i>
    </div>
</div>
<!-- end display video -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://kit.fontawesome.com/ecdfbd10f7.js" crossorigin="anonymous"></script>
<script src="./src/slider.js"></script>
<script src="./src/popImg.js"></script>
<script src="./src/script.js"></script>
<script>
    $(document).ready(function() {
        // Initialize all tables with .datatable class
        $('.datatable').DataTable();

        // Make <tr> clickable if it has a data-href attribute
        $('.datatable tbody').on('click', 'tr', function() {
            const href = $(this).data('href');
            if (href) {
                window.location.href = href;
            }
        });
    });
</script>
</body>

</html>