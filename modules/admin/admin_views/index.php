<body>

    <!-- Start: Flash Message -->
    <div id="message">
        <!-- Success -->
        <div id="inner-message" class="alert alert-custom alert-success-custom">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex" style="gap: 12px; align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none">
                        <rect width="48" height="48" fill="#14AE5C" rx="24"/>
                        <path fill="#fff" d="M24 11.167c-7.347 0-13.334 5.986-13.334 13.333S16.654 37.833 24 37.833c7.346 0 13.333-5.986 13.333-13.333S31.347 11.167 24 11.167Zm6.373 10.266-7.56 7.56a.999.999 0 0 1-1.413 0l-3.773-3.773a1.006 1.006 0 0 1 0-1.413 1.006 1.006 0 0 1 1.413 0l3.067 3.066 6.853-6.853a1.006 1.006 0 0 1 1.413 0 1.006 1.006 0 0 1 0 1.413Z"/>
                    </svg>
                    <div class="d-flex flex-column" style="justify-content: center; gap: 2px;">
                        <h4 class="heading-message">Success</h4>
                        <p class="content-message">Pesan</p>
                    </div>  
                </div>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close-button" onclick="closeModal(this);" id="thesis">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                        <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5"/>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Success -->

        <!-- Warning -->
        <div id="inner-message" class="alert alert-custom alert-warning-custom">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex" style="gap: 12px; align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none">
                        <rect width="48" height="48" fill="#F1CB01" rx="24"/>
                        <path fill="#fff" d="M24 11.167c-7.347 0-13.334 5.986-13.334 13.333S16.654 37.833 24 37.833c7.346 0 13.333-5.986 13.333-13.333S31.347 11.167 24 11.167Zm-1 8c0-.547.453-1 1-1 .547 0 1 .453 1 1v6.666c0 .547-.453 1-1 1-.547 0-1-.453-1-1v-6.666Zm2.227 11.173c-.067.173-.16.307-.28.44a1.54 1.54 0 0 1-.44.28c-.16.067-.334.107-.507.107a1.32 1.32 0 0 1-.507-.107 1.54 1.54 0 0 1-.44-.28 1.376 1.376 0 0 1-.28-.44 1.327 1.327 0 0 1-.107-.507c0-.173.04-.346.107-.506.067-.16.16-.307.28-.44.133-.12.28-.214.44-.28a1.33 1.33 0 0 1 1.014 0c.16.066.306.16.44.28.12.133.213.28.28.44.066.16.106.333.106.506 0 .174-.04.347-.106.507Z"/>
                    </svg>

                    <div class="d-flex flex-column" style="justify-content: center; gap: 2px;">
                        <h4 class="heading-message">Warning</h4>
                        <p class="content-message">Pesan</p>
                    </div>  
                </div>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close-button" onclick="closeModal(this);" id="thesis">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                        <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5"/>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Warning -->

        <!-- Danger -->
        <div id="inner-message" class="alert alert-custom alert-danger-custom">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex" style="gap: 12px; align-items: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none">
                    <rect width="48" height="48" fill="#E20000" rx="24"/>
                    <path fill="#fff" d="M24 10.667c-7.347 0-13.334 5.986-13.334 13.333S16.654 37.333 24 37.333c7.346 0 13.333-5.986 13.333-13.333S31.347 10.667 24 10.667Zm4.48 16.4a1.006 1.006 0 0 1 0 1.413.99.99 0 0 1-.707.293.989.989 0 0 1-.706-.293L24 25.413l-3.067 3.067a.99.99 0 0 1-.706.293.99.99 0 0 1-.707-.293 1.006 1.006 0 0 1 0-1.413L22.587 24l-3.067-3.067a1.006 1.006 0 0 1 0-1.413 1.006 1.006 0 0 1 1.413 0L24 22.587l3.067-3.067a1.006 1.006 0 0 1 1.413 0 1.006 1.006 0 0 1 0 1.413L25.413 24l3.067 3.067Z"/>
                </svg>


                    <div class="d-flex flex-column" style="justify-content: center; gap: 2px;">
                        <h4 class="heading-message">Danger</h4>
                        <p class="content-message">Pesan</p>
                    </div>  
                </div>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close-button" onclick="closeModal(this);" id="thesis">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                        <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5"/>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Danger -->

    </div>
    <!-- End: Flash Message -->

    
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
                    <img class="photo-profile" src="assets/icon/profile.svg" alt="" height="40px" width="40px">
                    <div class="navbar-content-text d-flex">
                        <p class="navbar-content-name fw-bold lh-1 text-nowrap">Admin</p>
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