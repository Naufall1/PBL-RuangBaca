<body>

    
    <!-- Start: Sidebar Cart -->
    <section class="cart-container" >

    <div class="detail-readable-container d-flex flex-col ">

        <div class="d-flex justify-content-between">
            <h2 class="main-heading">Detail Buku</h2>
            <button title="close" class="close-button" type="button" onclick="closeCart();">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5" />
                </svg>
            </button>
        </div>

        <div class="cart-detail-information d-flex flex-column">

            <div class="d-flex flex-column" style="flex: auto; gap: 8px;">
                <!-- <div class="gambar" > -->
                <img id="cover" src="" class="full-cover-cart book-cover-detail center-cropped">
                <!-- </div> -->
            </div>

            <div id="title">
                <h4 class="not-editable-item-heading">Judul</h4>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus voluptate
                    repellendus provident.</p>
            </div>
            <div id="synopsis">
                <h4 class="not-editable-item-heading">Sinopsis</h4>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus voluptate
                    repellendus provident
                    officia consequatur sint id. Cum cupiditate impedit placeat.</p>
            </div>
            <div class="hr-divider" style="margin: 8px 0;"></div>
            <div class="d-flex flex-column" style=" gap: 12px;">
                <div class="justify-content-between d-flex modal-book-detail">
                    <h5 class="">Ketersediaan</h5>
                    <span id="ketersediaan" class="">4/2</span>
                </div>
                <div class="justify-content-between d-flex modal-book-detail">
                    <h5 class="r">ISBN</h5>
                    <span id="isbn" class="">122124141243</span>
                </div>
                <div class="justify-content-between d-flex modal-book-detail">
                    <h5 class="">Kode DDC</h5>
                    <span id="ddc_code" class="">123.23</span>
                </div>
            </div>

        </div>

    </div>

    </section>
    <!-- End: Sidebar Cart -->


    <!-- Start: Fixed Layer -->
    <div class="fixed-layer d-flex">
        <!-- Start: Sidebar Menu -->

        <?php
        $template->sidebar();
        ?>

        <!-- End: Sidebar Menu -->


        <!-- Start: NAVBAR -->
        <div class="container-nav d-flex">

            <div class="d-flex align-items-center">


                
                <div class="d-flex flex-column heading-page">
                    <h1 class="heading-table-page">Buku</h1>
                    <p class="subtitle-table-page">Tabel Buku</p>
                </div>
            </div>

            <div class="navbar-content">
                <!-- <a href="">
              <svg class="navbar-borrowing-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.333 3.892V13.95c0 .8-.65 1.55-1.45 1.65l-.275.033c-1.816.242-4.616 1.167-6.216 2.05-.217.125-.575.125-.8 0l-.034-.016c-1.6-.875-4.391-1.792-6.2-2.034l-.241-.033c-.8-.1-1.45-.85-1.45-1.65V3.883a1.64 1.64 0 0 1 1.8-1.658c1.75.142 4.4 1.025 5.883 1.95l.208.125c.242.15.642.15.884 0l.141-.092a12.85 12.85 0 0 1 1.917-.941v3.4l1.667-1.109 1.666 1.109v-4.35c.225-.042.442-.067.642-.084h.05a1.642 1.642 0 0 1 1.808 1.659ZM10 4.575v12.5"/>
                <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.833 2.317v4.35l-1.666-1.109L12.5 6.667v-3.4c1.092-.434 2.308-.784 3.333-.95Z"/>
              </svg>
            </a>

            <div class="vertical-divider"></div> -->

                <div class="account-profile d-flex">
                    <img class="photo-profile" src="bunga2.jpeg" alt="" height="40px" width="40px">
                    <div class="navbar-content-text d-flex">
                        <p class="navbar-content-name fw-bold lh-1 text-nowrap">Muhammad Naufal Kurniawan</p>
                        <p class="navbar-content-users">Admin</p>
                    </div>
                </div>
            </div>

        </div>
        <!-- End: NAVBAR -->

    </div>
    <!-- End: Fixed Layer -->



    <!-- Start: Main Layer -->
    <main class="container-main d-flex container-main-table">

        <?php
            
        ?>

    </main>
    <!-- End: Main Layer -->

    
    <script>


        $(document).ready(function() {
            
        });
    </script>


</body>

</html>