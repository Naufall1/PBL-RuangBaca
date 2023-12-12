<body>
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
                    <h1 class="heading-table-page">Dashboard</h1>
                    <p class="subtitle-table-page">Dashboard</p>
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
                        <p class="navbar-content-name fw-bold lh-1 text-nowrap">Muhammad Naufal Kurniawan</p>
                        <p class="navbar-content-users">Staf</p>
                    </div>
                </div>
            </div>

        </div>
        <!-- End: NAVBAR -->

    </div>
    <!-- End: Fixed Layer -->



    <!-- Start: Main Layer -->
    <main class="container-main d-flex flex-column dashboard">

        <?php
        // include 'modules/staff/staff_views/dashboard.php';
        ?>

    </main>
    <!-- End: Main Layer -->
</body>

</html>