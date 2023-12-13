<!-- Start: Summary Layer -->
<div class="d-flex summarizes-container">

    <!-- Start: Total Buku -->
    <div class="summarize-item d-flex flex-column">
        <div class="icon-container d-flex justify-content-center align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" margin="0">
                <path stroke="#1B84FF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.916 15V5.833c0-3.333.833-4.166 4.167-4.166h5.833c3.333 0 4.167.833 4.167 4.166v8.334c0 .116 0 .233-.009.35" />
                <path stroke="#1B84FF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.291 12.5h11.792v2.917a2.92 2.92 0 0 1-2.917 2.916H5.833a2.92 2.92 0 0 1-2.917-2.916v-.542A2.38 2.38 0 0 1 5.291 12.5Zm1.375-6.667h6.667M6.666 8.75h4.167" />
            </svg>
        </div>
        <div class="summmarize-content">
            <p class="summarize-title">Total Buku</p>
            <p class="summarize-value"><?= $summarizes['book'] ?></p>
        </div>
    </div>
    <!-- End: Total Buku -->

    <!-- Start: Total Skripsi -->
    <div class="summarize-item d-flex flex-column">
        <div class="icon-container d-flex justify-content-center align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" margin="0">
                <path stroke="#1B84FF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.733 13.95V3.892c0-1-.817-1.742-1.808-1.659h-.05c-1.75.15-4.409 1.042-5.892 1.975l-.142.092a.923.923 0 0 1-.883 0l-.208-.125c-1.484-.925-4.134-1.808-5.884-1.95a1.64 1.64 0 0 0-1.8 1.658V13.95c0 .8.65 1.55 1.45 1.65l.242.033c1.808.242 4.6 1.159 6.2 2.034l.033.016c.225.125.584.125.8 0 1.6-.883 4.4-1.808 6.217-2.05l.275-.033c.8-.1 1.45-.85 1.45-1.65ZM10.4 4.575v12.5m-3.54-10H4.983m2.501 2.5h-2.5" />
            </svg>
        </div>
        <div class="summmarize-content">
            <p class="summarize-title">Total Skripsi</p>
            <p class="summarize-value"><?= $summarizes['thesis'] ?></p>
        </div>
    </div>
    <!-- End: Total Skripsi -->

    <!-- Start: Total Anggota -->
    <div class="summarize-item d-flex flex-column">
        <div class="icon-container d-flex justify-content-center align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" margin="0">
                <path stroke="#1B84FF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.967 17.5H6.633c-3.333 0-4.166-.833-4.166-4.167V6.667c0-3.334.833-4.167 4.166-4.167h8.334c3.333 0 4.167.833 4.167 4.167v6.666c0 3.334-.834 4.167-4.167 4.167Zm-2.5-10.833h4.167M13.3 10h3.334m-1.667 3.333h1.667" />
                <path stroke="#1B84FF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.883 9.408a1.508 1.508 0 1 0 0-3.016 1.508 1.508 0 0 0 0 3.016Zm2.917 4.2a2.517 2.517 0 0 0-2.283-2.266 6.428 6.428 0 0 0-1.267 0 2.524 2.524 0 0 0-2.283 2.266" />
            </svg>
        </div>
        <div class="summmarize-content">
            <p class="summarize-title">Total Anggota</p>
            <p class="summarize-value"><?= $summarizes['member'] ?></p>
        </div>
    </div>
    <!-- End: Total Anggota -->

    <!-- Start: Total Peminjaman -->
    <div class="summarize-item d-flex flex-column">
        <div class="icon-container d-flex justify-content-center align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" margin="0">
                <path stroke="#1B84FF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.532 3.892V13.95c0 .8-.65 1.55-1.45 1.65l-.275.033c-1.817.242-4.617 1.167-6.217 2.05-.216.125-.575.125-.8 0l-.033-.016c-1.6-.875-4.392-1.792-6.2-2.034l-.242-.033c-.8-.1-1.45-.85-1.45-1.65V3.883a1.64 1.64 0 0 1 1.8-1.658c1.75.142 4.4 1.025 5.884 1.95l.208.125c.242.15.642.15.883 0l.142-.092a12.85 12.85 0 0 1 1.917-.941v3.4l1.666-1.109 1.667 1.109v-4.35c.225-.042.442-.067.642-.084h.05a1.642 1.642 0 0 1 1.808 1.659Zm-8.332.683v12.5" />
                <path stroke="#1B84FF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.033 2.317v4.35l-1.667-1.109-1.667 1.109v-3.4c1.092-.434 2.309-.784 3.334-.95Z" />
            </svg>
        </div>
        <div class="summmarize-content">
            <p class="summarize-title">Total Peminjaman</p>
            <p class="summarize-value"><?= $summarizes['borrowing'] ?></p>
        </div>
    </div>
    <!-- End: Total Peminjaman -->

    <!-- Start: Peminjaman Menunggu -->
    <div class="summarize-item d-flex flex-column">
        <div class="icon-container d-flex justify-content-center align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" margin="0">
                <path stroke="#1B84FF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.932 10c0 4.6-3.733 8.333-8.333 8.333A8.336 8.336 0 0 1 2.266 10c0-4.6 3.733-8.333 8.333-8.333S18.932 5.4 18.932 10Z" />
                <path stroke="#1B84FF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m13.691 12.65-2.583-1.542c-.45-.266-.817-.908-.817-1.433V6.258" />
            </svg>
        </div>
        <div class="summmarize-content">
            <p class="summarize-title">Peminjaman Menunggu</p>
            <p class="summarize-value"><?= $summarizes['waiting'] ?></p>
        </div>
    </div>
    <!-- End: Peminjaman Menunggu -->

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
    <div class="borrowing-cards-container d-flex flex-wrap">

    </div>
    <!-- End: Cards -->

</div>
<!-- End: Peminjaman Layer -->


<!-- Start: Modal Confirmation -->
<div class="modal" id="modalBuku">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-custom-confirmation">
            <div class="modal-header border-0 d-flex">
                <div class="d-flex" style="padding: 0; width: 100%;">

                    <div class="d-flex flex-column align-content-between " style="width: 100%;">
                        <h3 class="modal-heading" id="">Detail Peminjaman</h3>
                        <!-- id atas: exampleModalLongTitle -->
                        <span class="modal-heading-id" style="font-size: small;" id="borrowing_id">[ID PEMINJAMAN]</span>
                    </div>

                    <button type="button" data-dismiss="modal" aria-label="Close" class="close-button" onclick="closeModal(this);" id="book">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5" />
                        </svg>
                    </button>

                </div>
            </div>

            <div class="modal-body">

                <div class="modal-details-areas d-flex">

                    <div class="modal-confirm-information-area modal-confirm-detail-area d-flex flex-column">
                        <h5 class="modal-confirm-heading">Informasi</h5>

                        <div class="not-editable-information d-flex flex-column">
                            <div class="not-editable-item d-flex flex-column">
                                <h4 class="not-editable-item-heading">Nama</h4>
                                <p class="not-editable-item-value" id="member_name">Muhammad Naufal Kurniawan</p>
                            </div>
                            <div class="not-editable-item d-flex flex-column">
                                <h4 class="not-editable-item-heading">Status</h4>
                                <div class="borrowing-status d-flex" name="status-modal" id="borrowed">
                                    <p>
                                        [STATUS]
                                    </p>
                                </div>
                            </div>
                            <div class="not-editable-item d-flex flex-column">
                                <h4 class="not-editable-item-heading">Tanggal Ambil</h4>
                                <p class="not-editable-item-value text-nowrap" id="reserve_date">12 November 2023</p>
                            </div>
                            <div class="not-editable-item d-flex flex-column">
                                <h4 class="not-editable-item-heading">Tenggat Kembali</h4>
                                <p class="not-editable-item-value text-nowrap" id="due_date">19 November 2023</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-confirm-ordered-area modal-confirm-detail-area d-flex flex-column">
                        <h5 class="modal-confirm-heading">Daftar Buku</h5>

                        <div class="modal-confirm-detail-contianer not-editable-information d-flex flex-column">

                            <!-- READABLE ITEMS -->

                        </div>
                    </div>

                </div>
            </div>


            <div class="d-flex modal-button-group" style="gap: 12px;">
                <button type="button" class="enabled danger modal-button-top-margin" name="reject" id="" onclick="processBorrowing(this);">Tolak</button>
                <button type="button" class="enabled modal-button-top-margin" name="confirm" id="" onclick="processBorrowing(this);">Konfirmasi</button>
                <button type="button" class="enabled modal-button-top-margin" name="pickUp" id="" onclick="processBorrowing(this);">Diambil</button>
                <button type="button" class="enabled modal-button-top-margin" name="finish" id="" onclick="processBorrowing(this);">Selesai</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Modal Confirmation -->