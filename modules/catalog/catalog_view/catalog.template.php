<link rel="stylesheet" href="/assets/bootstrap-5.3.2-dist/css/bootstrap.min.css">
<div class="container-collection d-flex">
    <!-- Start: Filter Collection Layer -->
    <div class="filter-collection">
        <p class="menus-heading">FILTER</p>

        <!-- Start: Filter Groups -->
        <div class="filter-groups d-flex">

            <?php include 'modules/catalog/catalog_view/filter.template.php'; ?>

        </div>
        <!-- End: Filter Groups -->

    </div>
    <!-- End: Filter Collection Layer -->

    <!-- Start: Collections Layer -->
    <div class="collections d-flex flex-column">

        <!-- Start: Filtered Layer -->
        <div class="filtered-items d-flex flex-wrap" id="filtered-items">

            <!-- Start: Book Filter Item -->
            <!-- <div name="type" id="book" class="d-flex filter-item text-nowrap">
                        <p class="filtered-title" id="book">Buku</p>
                        <button class="filter-item-closed d-flex" id="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="none">
                                <path stroke="#7F7F7F" stroke-linecap="round" stroke-linejoin="round" d="M8 15.167c3.667 0 6.667-3 6.667-6.667s-3-6.667-6.667-6.667-6.667 3-6.667 6.667 3 6.667 6.667 6.667Zm-1.887-4.78 3.774-3.774m0 3.774L6.113 6.613" />
                            </svg>
                        </button>
                    </div> -->
            <!-- End: Book Filter Item -->

            <!-- Start: R2 Filter Item -->
            <!-- <div name="shelf" id="r2" class="d-flex filter-item text-nowrap">
                        <p class="filtered-title" id="r2">R2</p>
                        <button class="filter-item-closed d-flex" id="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="none">
                                <path stroke="#7F7F7F" stroke-linecap="round" stroke-linejoin="round" d="M8 15.167c3.667 0 6.667-3 6.667-6.667s-3-6.667-6.667-6.667-6.667 3-6.667 6.667 3 6.667 6.667 6.667Zm-1.887-4.78 3.774-3.774m0 3.774L6.113 6.613" />
                            </svg>
                        </button>
                    </div> -->
            <!-- End: R2 Filter Item -->

            <a class="d-flex delete-filter-item text-nowrap" onmouseover="this.style.cursor='pointer'" onclick="clearFilter();">Hapus Semua</a>

        </div>
        <!-- End: Filtered Layer -->

        <div class="d-flex flex-column" id="content">


        </div>

    </div>

    <!-- Modal -->
    <div class="modal" id="modalBuku">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content modal-custom-collection">
                <div class="modal-header border-0 d-flex">
                    <div class="d-flex" style="padding: 0; width: 100%;">

                        <div class="d-flex flex-column align-content-between " style="width: 100%;">
                            <h3 class="modal-heading" id="">Detail Buku</h3>
                            <!-- id atas: exampleModalLongTitle -->
                            <span class="modal-heading-id" style="font-size: small;" id="book_id"></span>
                        </div>

                        <button type="button" data-dismiss="modal" aria-label="Close" class="close-button" onclick="closeModal(this);" id="book">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                                <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5"/>
                            </svg>
                        </button>

                    </div>
                </div>

                <div class="modal-body">

                    <div class="d-flex" style="flex: auto; gap: 8px; width: 100%;">
                        <!-- <div class="gambar" > -->
                        <img id="cover" src="" class="book-cover-detail center-cropped">
                        <!-- </div> -->
                        <div class="details d-flex flex-column">
                            <div class="judul">
                                <h4 id="book_title">Judul Buku</h4>
                            </div>
                            <div id="status" class="d-flex">
                                <!-- <img src="assets/icon/ellipse-green.svg" style="padding-right: 5px;"> Tersedia -->
                            </div>
                            <div class="d-flex justify-content-between" style="padding: 0;">
                                <div class="info-modal-full-width">
                                    <p class="book-collection-info-heading">Penulis</p>
                                    <p id="author" class="book-collection-info-value">Libero S, Rutrum N</p>
                                </div>
                                <div class="">
                                    <p class="book-collection-info-heading">Tahun Terbit</p>
                                    <p id="year_published" class="book-collection-info-value">2017</p>
                                </div>
                                <div class="">
                                    <p class="book-collection-info-heading">Letak</p>
                                    <p id="shelf" class="book-collection-info-value">R1</p>
                                </div>
                            </div>

                        </div>
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

                <div class="d-flex modal-button-group" style="gap: 12px;">
                    <?php
                    if (!isset($_SESSION['level'])) {
                    ?>
                        <!-- <button type="button" class="enabled secondary" data-dismiss="modal" onclick="closeModal(this);" id="book">Batal</button> -->
                        <?php
                    } else {
                        if ($_SESSION['level'] == 'member') {
                        ?>
                            <!-- <button type="button" class="enabled" data-dismiss="modal" onclick="closeModal(this);" id="book">Batal</button> -->
                            <button type="button" class="enabled modal-button-top-margin" id="pinjam" name="book" onclick="addToCart(this);">Pinjam</button>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modalSkripsi">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content modal-custom-collection">
                <div class="modal-header border-0 d-flex">
                    <div class="d-flex" style="padding: 0; width: 100%;">

                        <div class="d-flex flex-column align-content-between " style="width: 100%;">
                            <h3 class="modal-heading" id="">Detail Skripsi</h3>
                            <!-- id atas: exampleModalLongTitle -->
                            <span class="modal-heading-id" style="font-size: small;" id="thesis_id"></span>
                        </div>

                        <button type="button" data-dismiss="modal" aria-label="Close" class="close-button" onclick="closeModal(this);" id="thesis">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                                <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5"/>
                            </svg>
                        </button>

                    </div>

                </div>

                <div class="modal-body">

                <div class="d-flex" style="flex: auto; gap: 8px;">
                        <!-- <div class="gambar" > -->
                        <img src="" class="book-cover-detail center-cropped" id="cover">
                        <!-- </div> -->
                        <div class="details d-flex flex-column">
                            <div class="judul">
                                <h4 id="thesis_title">Judul Skripsi</h4>
                            </div>
                            <div id="status" class="d-flex">
                                <!-- <img src="assets/icon/ellipse-green.svg" style="padding-right: 5px;"> Tersedia -->
                            </div>
                            <div class="d-flex justify-content-between" style="padding: 0;">
                                <div class="info-modal-full-width">
                                    <p class="book-collection-info-heading">Penulis</p>
                                    <p id="author" class="book-collection-info-value">Libero S, Rutrum N</p>
                                </div>
                                <div class="">
                                    <p class="book-collection-info-heading">Tahun</p>
                                    <p id="year_published" class="book-collection-info-value">2017</p>
                                </div>
                                <div class="">
                                    <p class="book-collection-info-heading">Letak</p>
                                    <p id="shelf" class="book-collection-info-value">R1</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="hr-divider" style="margin: 8px 0;"></div>
                    <div class="d-flex flex-column" style="gap: 12px;">
                        <div class="justify-content-between d-flex modal-book-detail">
                            <h5 class="">Dosen Pembimbing</h5>
                            <span id="dospem" class=""></span>
                        </div>
                    </div>

                </div>
                <div class="d-flex modal-button-group" style="gap: 12px;">
                    <!-- <button type="button" class="btn btn-secondary btn-footer sb fs-14" data-dismiss="modal" onclick="closeModal(this);" id="thesis">Batal</button> -->
                    <!-- <button type="button" class="btn btn-primary btn-footer sb fs-14" id="pinjam">Pinjam</button> -->
                    <?php
                    if (!isset($_SESSION['level'])) {
                    ?>
                        <!-- <button type="button" class="btn btn-secondary btn-footer sb fs-14" data-dismiss="modal" onclick="closeModal(this);" id="thesis">Batal</button> -->
                        <?php
                    } else {
                        if ($_SESSION['level'] == 'member') {
                        ?>
                            <!-- <button type="button" class="btn btn-secondary btn-footer sb fs-14" data-dismiss="modal" onclick="closeModal(this);" id="thesis">Batal</button>
                            <button type="button" class="btn btn-primary btn-footer sb fs-14" id="pinjam">Pinjam</button> -->
                            <button type="button" class="enabled modal-button-top-margin" id="pinjam" name="thesis" onclick="addToCart(this);">Pinjam</button>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- End: Collections Layer -->
    </div>