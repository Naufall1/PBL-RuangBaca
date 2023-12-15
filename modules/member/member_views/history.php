
<!-- Start: Summary Layer -->
<div class="d-flex summarizes-container">

    <!-- Start: Total Buku -->
    <div class="summarize-item d-flex flex-column">
        <div class="icon-container icon-container-danger d-flex justify-content-center align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
            <path stroke="#E20000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 18.333c4.583 0 8.333-3.75 8.333-8.333S14.583 1.667 10 1.667 1.667 5.417 1.667 10s3.75 8.333 8.333 8.333Zm0-11.666v4.166m-.004 2.5h.007"/>
        </svg>

        </div>
        <div class="summmarize-content">
            <p class="summarize-title">Tanggungan Kompen</p>
            <p class="summarize-value">
                <?= $summarizes['kompen'] ?>
            </p>
        </div>
    </div>
    <!-- End: Total Buku -->

    <!-- Start: Dikonfirmasi -->
    <div class="summarize-item d-flex flex-column">
        <div class="icon-container icon-container-success d-flex justify-content-center align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" margin="0">
                <path stroke="#14AE5C" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.532 3.892V13.95c0 .8-.65 1.55-1.45 1.65l-.275.033c-1.817.242-4.617 1.167-6.217 2.05-.216.125-.575.125-.8 0l-.033-.016c-1.6-.875-4.392-1.792-6.2-2.034l-.242-.033c-.8-.1-1.45-.85-1.45-1.65V3.883a1.64 1.64 0 0 1 1.8-1.658c1.75.142 4.4 1.025 5.884 1.95l.208.125c.242.15.642.15.883 0l.142-.092a12.85 12.85 0 0 1 1.917-.941v3.4l1.666-1.109 1.667 1.109v-4.35c.225-.042.442-.067.642-.084h.05a1.642 1.642 0 0 1 1.808 1.659Zm-8.332.683v12.5" />
                <path stroke="#14AE5C" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.033 2.317v4.35l-1.667-1.109-1.667 1.109v-3.4c1.092-.434 2.309-.784 3.334-.95Z" />
            </svg>
        </div>
        <div class="summmarize-content">
            <p class="summarize-title">Dikonfirmasi</p>
            <p class="summarize-value">
                <?= $summarizes['confirmed'] ?>
            </p>
        </div>
    </div>
    <!-- End: Dikonfirmasi -->

    <!-- Start: Dipinjam -->
    <div class="summarize-item d-flex flex-column">
        <div class="icon-container icon-container-warning d-flex justify-content-center align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" margin="0">
                <path stroke="#F1CB01" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.532 3.892V13.95c0 .8-.65 1.55-1.45 1.65l-.275.033c-1.817.242-4.617 1.167-6.217 2.05-.216.125-.575.125-.8 0l-.033-.016c-1.6-.875-4.392-1.792-6.2-2.034l-.242-.033c-.8-.1-1.45-.85-1.45-1.65V3.883a1.64 1.64 0 0 1 1.8-1.658c1.75.142 4.4 1.025 5.884 1.95l.208.125c.242.15.642.15.883 0l.142-.092a12.85 12.85 0 0 1 1.917-.941v3.4l1.666-1.109 1.667 1.109v-4.35c.225-.042.442-.067.642-.084h.05a1.642 1.642 0 0 1 1.808 1.659Zm-8.332.683v12.5" />
                <path stroke="#F1CB01" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.033 2.317v4.35l-1.667-1.109-1.667 1.109v-3.4c1.092-.434 2.309-.784 3.334-.95Z" />
            </svg>
        </div>
        <div class="summmarize-content">
            <p class="summarize-title">Dipinjam</p>
            <p class="summarize-value">
                <?= $summarizes['borrowed'] ?>
            </p>
        </div>
    </div>
    <!-- End: Dipinjam -->

    <!-- Start: Selesai -->
    <div class="summarize-item d-flex flex-column">
        <div class="icon-container d-flex justify-content-center align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" margin="0">
                <path stroke="#1B84FF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.532 3.892V13.95c0 .8-.65 1.55-1.45 1.65l-.275.033c-1.817.242-4.617 1.167-6.217 2.05-.216.125-.575.125-.8 0l-.033-.016c-1.6-.875-4.392-1.792-6.2-2.034l-.242-.033c-.8-.1-1.45-.85-1.45-1.65V3.883a1.64 1.64 0 0 1 1.8-1.658c1.75.142 4.4 1.025 5.884 1.95l.208.125c.242.15.642.15.883 0l.142-.092a12.85 12.85 0 0 1 1.917-.941v3.4l1.666-1.109 1.667 1.109v-4.35c.225-.042.442-.067.642-.084h.05a1.642 1.642 0 0 1 1.808 1.659Zm-8.332.683v12.5" />
                <path stroke="#1B84FF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.033 2.317v4.35l-1.667-1.109-1.667 1.109v-3.4c1.092-.434 2.309-.784 3.334-.95Z" />
            </svg>
        </div>
        <div class="summmarize-content">
            <p class="summarize-title">Selesai</p>
            <p class="summarize-value">
                <?= $summarizes['done'] ?>
            </p>
        </div>
    </div>
    <!-- End: Selesai -->


</div>
<!-- End: Summary Layer -->

<!-- Start: Peminjaman Layer -->
<div class="borrowing-container d-flex flex-column">
    <h2 class="main-heading">Peminjaman</h2>

    <!-- Start: Tab Menu -->
    <div class="tab-menu d-flex">
        <div class="tab-item d-flex justify-content-center align-items-center" id="all">
            <a href="#" class="tab-title">Semua</a>
        </div>
        <div class="tab-item d-flex justify-content-center align-items-center text-nowrap" id="waiting">
            <a href="#" class="tab-title">Menunggu Konfirmasi</a>
        </div>
        <div class="tab-item d-flex justify-content-center align-items-center" id="confirmed">
            <a href="#" class="tab-title">Dikonfirmasi</a>
        </div>
        <div class="tab-item d-flex justify-content-center align-items-center" id="borrowed">
            <a href="#" class="tab-title">Dipinjam</a>
        </div>
        <div class="tab-item d-flex justify-content-center align-items-center" id="late">
            <a href="#" class="tab-title">Terlambat</a>
        </div>
        <div class="tab-item d-flex justify-content-center align-items-center" id="done">
            <a href="#" class="tab-title">Selesai</a>
        </div>
        <div class="tab-item d-flex justify-content-center align-items-center" id="rejected">
            <a href="#" class="tab-title">Ditolak</a>
        </div>
        <div class="d-flex justify-content-center align-items-center rest">
        </div>
    </div>
    <!-- End: Tab Menu -->

    <!-- Start: Cards -->
    <div class="borrowing-cards-container d-flex flex-wrap" name="main">

    </div>
    <!-- End: Cards -->

</div>
<!-- End: Peminjaman Layer -->