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

        </div>
        <!-- End: Filtered Layer -->

        <!-- Start: View Books Layer -->
        <div class="collection-views d-flex justify-content-between">
            <p class="total-views">
                Menampilkan <span class="total-views" id="count"><?= MAX_NUMS_ITEM ?></span> dari <?= Catalog::getCountCollection(); ?> koleksi
            </p>
            <div class="sorting-content d-flex">
                <p class="total-views">Urutkan</p>
                <button class="dropdown-sorting d-flex" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Abjad
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none">
                        <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M9.96 4.475 6.7 7.735a.993.993 0 0 1-1.4 0l-3.26-3.26" />
                    </svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" onchange="sort(this);">
                    <option class="dropdown-item" value="title" onclick="sort(this);">Abjad</option>
                    <option class="dropdown-item" value="year" onclick="sort(this);">Tahun Terbit</option>
                </div>
            </div>
        </div>
        <!-- End: View Books Layer -->

        <!-- Start: Books Collection Layer -->
        <div class="books-collection d-flex" id="books-collection">



        </div>
        <!-- End: Books Collection Layer -->

        <!-- Start: Bar View -->
        <div class="pagination d-flex">
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
                    <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M10 13.28 5.653 8.933a1.324 1.324 0 0 1 0-1.866L10 2.72" />
                </svg>
            </a>

            <!-- <a href="" class="active">2</a> -->
            <?php
            for ($i = 1; $i <= Catalog::getNumPages(); $i++) {
            ?>
                <a class="page" id="P-<?= $i ?>" onclick="changePages(this);"> <?= $i ?> </a>
            <?php
            }
            ?>

            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
                    <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m5.94 13.28 4.347-4.347a1.324 1.324 0 0 0 0-1.866L5.94 2.72" />
                </svg>
            </a>
        </div>
        <!-- End: Bar View -->

    </div>
    <!-- Modal -->
    <div class="modal" id="modalBuku">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0" style="width: 450px; padding: 10px;">
                <div class="modal-header border-0 d-flex row">
                    <div class="d-flex">
                        <h4 class="modal-title text-nowrap sb" id="exampleModalLongTitle">Detail Buku</h4>
                        <button type="button" data-dismiss="modal" aria-label="Close" style="width: auto; height: auto; margin-left: auto; align-items: center;" onclick="closeModal(this);" id="book">
                            <img src="assets/icon/close-circle-bl.svg" alt="">
                        </button>
                    </div>
                    <span class="lh-1 sr" style="font-size: small;" id="book_id"></span>
                </div>
                <div class="modal-body">
                    <div class="d-flex">
                        <!-- <div class="gambar" > -->
                        <img id="cover" src="" class=" center-cropped" style="width: 111px;height: 134px; object-fit: cover; object-position: 0 100%;">
                        <!-- </div> -->
                        <div class="details row" style="margin-left: 10px;">
                            <div class="judul sb">
                                <h4 class="fs-18" id="book_title">Judul Buku</h4>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p class="lh-1" style="font-size: x-small; color: darkgray; margin-bottom: 2px;">
                                        Penulis</p>
                                    <p id="author" class="lh-1 fw-bold fs-12 sb">Libero S, Rutrum N</p>
                                </div>
                                <div class="col-4">
                                    <p class="lh-1" style="font-size: x-small; color: darkgray; margin-bottom: 2px;">
                                        Tahun Terbit</p>
                                    <p id="year_published" class="lh-1 fs-12 sb">2017</p>
                                </div>
                                <div class="col-2">
                                    <p class="lh-1" style="font-size: x-small; color: darkgray; margin-bottom: 2px;">
                                        Letak</p>
                                    <p id="shelf" class="lh-1 fs-12 sb">R1</p>
                                </div>
                            </div>
                            <span id="status" class="fw-bold d-flex fs-10 rounded-3 status">
                                <!-- <img src="assets/icon/ellipse-green.svg" style="padding-right: 5px;"> Tersedia -->
                            </span>
                        </div>
                    </div>
                    <div id="synopsis" class="border-bottom sb fs-14 p-1">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus voluptate
                            repellendus provident
                            officia consequatur sint id. Cum cupiditate impedit placeat.</p>
                    </div>
                    <div class="d-flex flex-column">
                        <div style="margin: 5px 0px;" class="justify-content-between d-flex">
                            <span class="fs-12 sr">Ketersediaan</span>
                            <span id="ketersediaan" class="fs-14 sb">4/2</span>
                        </div>
                        <div style="margin: 5px 0px;" class="justify-content-between d-flex">
                            <span class="fs-12 sr">ISBN</span>
                            <span id="isbn" class="fs-14 sb">122124141243</span>
                        </div>
                        <div style="margin: 5px 0px;" class="justify-content-between d-flex">
                            <span class="fs-12 sr">Kode DDC</span>
                            <span id="ddc_code" class="fs-14 sb">123.23</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row mdl-footer">
                    <?php
                    if (!isset($_SESSION['level'])) {
                    ?>
                        <button type="button" class="btn btn-secondary btn-footer sb fs-14" data-dismiss="modal" onclick="closeModal(this);" id="book">Batal</button>
                        <?php
                    } else {
                        if ($_SESSION['level'] == 'member') {
                        ?>
                            <button type="button" class="btn btn-secondary btn-footer sb fs-14" data-dismiss="modal" onclick="closeModal(this);" id="book">Batal</button>
                            <button type="button" class="btn btn-primary btn-footer sb fs-14" name="book" id="" onclick="addToCart(this);">Pinjam</button>
                            <!-- <button type="button" class="btn btn-primary btn-footer sb fs-14" name="modalSkripsi" id="" onclick="addToCart(this);" >Pinjam</button> -->
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modalSkripsi">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0" style="width: 450px; padding: 10px;">
                <div class="modal-header border-0 d-flex row">
                    <div class="d-flex">
                        <h4 class="modal-title text-nowrap sb" id="exampleModalLongTitle">Detail Skripsi</h4>
                        <button type="button" data-dismiss="modal" aria-label="Close" style="width: auto; height: auto; margin-left: auto; align-items: center;" onclick="closeModal(this);" id="thesis">
                            <img src="assets/icon/close-circle-bl.svg" alt="">
                        </button>
                    </div>
                    <span class="lh-1 sr" style="font-size: small;" id="thesis_id">#TH001</span>
                </div>
                <div class="modal-body">
                    <div class="d-flex border-bottom">
                        <div class="gambar" style="width: 111px;height: 134px;">
                            <img src="cover/cover_buku2.png" class="img img-fluid" id="cover">
                        </div>
                        <div class="details row" style="margin-left: 10px;">
                            <div class="judul sb">
                                <h4 id="thesis_title" class="fs-18 sb">Judul Skripsi</h4>
                            </div>
                            <div class="row" style="height: 20px;">
                                <div class="col-10">
                                    <p class="lh-1" style="font-size: x-small; color: darkgray; margin-bottom: 2px;">
                                        Penulis</p>
                                    <p id="author" class="lh-1 fw-bold fs-14 sb" style="margin-bottom: 0px;">Libero S,
                                        Rutrum N</p>
                                </div>
                                <!-- <div class="col-4">
                        <p class="lh-1" style="font-size: x-small; color: darkgray; margin-bottom: 2px;">Tahun Terbit</p>
                        <p id="penulis" class="lh-1 fs-14 sb">2017</p>
                      </div> -->
                                <div class="col-2">
                                    <p class="lh-1" style="font-size: x-small; color: darkgray; margin-bottom: 2px;">
                                        Letak</p>
                                    <p id="shelf" class="lh-1 fs-14 sb">R1</p>
                                </div>
                            </div>
                            <span id="status" class="fw-bold d-flex fs-10 rounded-3 status">
                                <!-- <img src="assets/icon/ellipse-green.svg" style="padding-right: 5px;"> Tersedia -->
                            </span>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <div style="margin: 5px 0px;" class="justify-content-between d-flex">
                            <span class="fs-12 sr">Dosen Pembimbing</span>
                            <span id="dospem" class="fs-14 sb"></span>
                        </div>
                        <div style="margin: 5px 0px;" class="justify-content-between d-flex">
                            <span class="fs-12 sr">Tahun Terbit</span>
                            <span id="year" class="fs-14 sb">2020</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row mdl-footer">
                    <!-- <button type="button" class="btn btn-secondary btn-footer sb fs-14" data-dismiss="modal" onclick="closeModal(this);" id="thesis">Batal</button> -->
                    <!-- <button type="button" class="btn btn-primary btn-footer sb fs-14" id="pinjam">Pinjam</button> -->
                    <?php
                    if (!isset($_SESSION['level'])) {
                    ?>
                        <button type="button" class="btn btn-secondary btn-footer sb fs-14" data-dismiss="modal" onclick="closeModal(this);" id="thesis">Batal</button>
                        <?php
                    } else {
                        if ($_SESSION['level'] == 'member') {
                        ?>
                            <button type="button" class="btn btn-secondary btn-footer sb fs-14" data-dismiss="modal" onclick="closeModal(this);" id="thesis">Batal</button>
                            <button type="button" class="btn btn-primary btn-footer sb fs-14" name="thesis" id="" onclick="addToCart(this);" >Pinjam</button>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- End: Collections Layer -->
    </div>