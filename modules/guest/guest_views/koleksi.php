<body>
    <!-- <div class="d-flex flex-column"> -->
    <nav class="navbar nav">
        <div class="d-flex" style="align-items: center;">
            <img src="assets/icon/logo.svg" alt="" style="margin: 5px;">
            <span class="fw-bold color" style="font-size: 18px;">ruangbaca</span>
        </div>
        <div style="width: 40%;margin-left: 20px;">
            <input type="text" name="search" class="form-control search" id="recipient-name" placeholder="Search">
        </div>
        <a href="/index.php?page=login" class="btn btn-light" style="margin-left: auto;margin-right: 10px; width: auto;">
            Masuk
        </a>
    </nav>

    <div style="overflow-y: auto; height: 100vh; width: auto;" class="scroll">
        <div class="jumbotron" style="background: url('assets/img/jumbotron.png');">
            <h1>Ruang Baca Jurusan Teknologi Informasi</h1>
            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi voluptas totam deleniti iusto vitae iure
                fuga sunt quod vero? Eos consectetur labore necessitatibus ducimus ea tempore quidem nulla quas nam.</span>
            <div style="width: 25%;margin-left: 20px; margin-top: 20px;">
                <input type="text" name="search" class="form-control search" id="recipient-name" placeholder="Search" style="background-color: #F8F8F8;">
            </div>
        </div>

        <main class="d-flex" style="padding-top: 20px;">
            <div style="width: 20%;">
                <div class="d-flex flex-column container-fluid f-bar">
                    <p class="" style="margin-bottom: 0px; font-size:18px; font-weight: 800;">FILTER</p>

                    <div class="filter-header filter-group d-flex flex-column">
                        <button style="align-items: center;">
                            <span class="fw-bold">Jenis</span>
                            <img src="assets/icon/arrow-up.svg" alt="">
                        </button>
                        <div class="filter-box" id="filter-box">
                            <button class="btn rounded-3 d-flex btn-filter" name="jenis" id="buku">Buku</button>
                            <button class="btn rounded-3 d-flex btn-filter" name="jenis" id="skripsi">Skripsi</button>
                        </div>
                    </div>

                    <div class="filter-group d-flex flex-column filter-header" id="lokasi">
                        <button style="align-items: center;">
                            <span class="fw-bold">Ketersediaan</span>
                            <img src="assets/icon/arrow-up.svg" alt="">
                        </button>
                        <div class="filter-box" id="filter-box">
                            <button class="btn rounded-3 d-flex btn-filter" name="ketersediaan" id="tersedia">Tersedia</button>
                            <button class="btn rounded-3 d-flex btn-filter" name="ketersediaan" id="tidak_tersedia">Tidak
                                Tersedia</button>
                        </div>
                    </div>

                    <div class="filter-group d-flex flex-column filter-header" id="lokasi">
                        <button style="align-items: center;">
                            <span class="fw-bold">Lokasi</span>
                            <img src="assets/icon/arrow-up.svg" alt="">
                        </button>
                        <div class="filter-box form-check" name="lokasi" id="filter-box">
                            <form action="" class="form-data">
                                <div class="form-check">
                                    <input name="lokasi" class="form-check-input" type="checkbox" value="r1" id="r1">
                                    <label class="form-check-label fs-12" for="r1">
                                        RAK-1
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input name="lokasi" class="form-check-input" type="checkbox" value="r2" id="r2">
                                    <label class="form-check-label" for="r2">
                                        RAK-2
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="filter-group d-flex flex-column filter-header" id="kategori">
                        <button style="align-items: center;">
                            <span class="fw-bold">Kategori</span>
                            <img src="assets/icon/arrow-up.svg" alt="">
                        </button>
                        <div class="filter-box form-check" name="kategori" id="filter-box">
                            <form action="" class="form-data">
                                <div class="form-check">
                                    <input name="kategori" class="form-check-input" type="checkbox" value="c1" id="c1">
                                    <label class="form-check-label" for="c1">
                                        CAT-1
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input name="kategori" class="form-check-input" type="checkbox" value="c2" id="c2">
                                    <label class="form-check-label" for="c2">
                                        CAT-2
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="filter-header filter-group d-flex flex-column" id="pengarang">
                        <button style="align-items: center;">
                            <span class="fw-bold">Pengarang</span>
                            <img src="assets/icon/arrow-up.svg" alt="">
                        </button>
                        <div class="filter-box form-check" name="pengarang" id="filter-box">
                            <form action="" class="form-data">
                                <div class="form-check">
                                    <input name="pengarang" class="form-check-input" type="checkbox" value="p1" id="p1">
                                    <label class="form-check-label" for="p1">
                                        P-1
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input name="pengarang" class="form-check-input" type="checkbox" value="p2" id="p2">
                                    <label class="form-check-label" for="p2">
                                        P-2
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="filter-header filter-group d-flex flex-column" id="penerbit">
                        <button style="align-items: center;">
                            <span class="fw-bold">Penerbit</span>
                            <img src="assets/icon/arrow-up.svg" alt="">
                        </button>
                        <div class="filter-box form-check" name="penerbit" id="filter-box">
                            <form action="" class="form-data">
                                <div class="form-check">
                                    <input name="penerbit" class="form-check-input" type="checkbox" value="pen1" id="pen1">
                                    <label name="penerbit" class="form-check-label" for="pen1">
                                        Pen-1
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input name="penerbit" class="form-check-input" type="checkbox" value="pen2" id="pen2">
                                    <label name="penerbit" class="form-check-label" for="pen2">
                                        Pen-2
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="filter-group d-flex flex-column filter-header" id="tahun_terbit">
                        <button id="tahun-terbit" style="align-items: center;">
                            <span class="fw-bold">Tahun Terbit</span>
                            <img src="assets/icon/arrow-up.svg" alt="">
                        </button>
                        <div class="filter-box form-check" name="tahun_terbit" id="filter-box">
                            <form action="" class="form-data">
                                <div class="form-check">
                                    <input name="tahun_terbit" class="form-check-input" type="checkbox" value="t2022" id="t2022">
                                    <label name="tahun_terbit" class="form-check-label" for="t2022">
                                        2022
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input name="tahun_terbit" class="form-check-input" type="checkbox" value="t2023" id="t2023">
                                    <label name="tahun_terbit" class="form-check-label" for="t2023">
                                        2023
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div style="width: 79%;">
                <div class="d-flex main-catalog flex-column">
                    <!-- <div class="d-flex "> -->

                    <div class="d-flex flex-wrap flex-row" id="filter-implement-box">
                        <div name="" id="test" class="d-flex filter-item rounded-3 text-nowrap">
                            <span>asdasd</span><button id="test" onclick="remove(this);"><img src="assets/icon/close-circle-gr.svg" alt=""></button>
                        </div>
                    </div>

                    <div class="d-flex catalog-head">
                        <div class="col-9" style="color: rgb(148, 148, 148);">
                            <span class="sr fs-14">Menampilkan <?= $lenBooks ?> dari <?= $lenAllBooks ?> koleksi</span>
                        </div>
                        <div class="col-3 d-flex sort">
                            <span style="margin-right: 10px; color: darkgrey;">Urutkan: </span>
                            <select class="form-select" name="sort" id="sort" style="width: auto;" onchange="sort(this);" >
                                <option value="title">Abjad</option>
                                <option value="year">Tahun</option>
                            </select>
                        </div>
                    </div>

                    <!-- Koleksi Buku -->
                    <div class="book-grids" id="book-grids">

                        <!-- USE CAT2.php -->

                        <!-- <a class="col-xs-2-4 book" href="#" id="b4" data-toggle="modal" data-target="#modalSkripsi"
                            style="text-decoration: none;">
                            <div class="d-flex flex-column" style="padding: 0px 5px;">
                                <div class="d-flex flex-column" style="align-items: center;">
                                    <img class="img-fluid center-cropped" src="cover/cover_buku2.png"
                                        style="height: 203px; width:169px; object-fit: cover; object-position: 0 100%;">
                                </div>
                                <div class="status rounded-3">
                                    <span class="fw-bold success d-flex fs-10"
                                        style="align-items: center; justify-content: center;">
                                        <img src="assets/icon/ellipse-green.svg" style="padding-right: 5px;"> Tersedia
                                    </span>
                                </div>
                                <div id="title">
                                    <p class="lh-1 fw-bold"
                                        style="font-size: 14px; font-family: 'Satoshi-Bold'; margin-bottom: 4px;">
                                        Judul Lorem ipsum dolor sit amet
                                        consectetur.</p>
                                </div>
                                <div class="row">
                                    <div class="col-7" style=" padding-bottom: 5px; padding-top: 4px;">
                                        <p class="lh-1" style="font-size: x-small; color: darkgray;">Penulis</p>
                                        <p id="penulis" class="lh-1">Nama</p>
                                    </div>
                                    <div class="col d-flex" style=" align-items: center; padding-left: 0%;">
                                        <div style=" border-left: 2px solid #D9D9D9; height: 25px; "></div>
                                        <div style="margin-left: 10px;">
                                            <p class="lh-1" style="font-size: xx-small; color: darkgray;">Tahun
                                                Terbit
                                            </p>
                                            <p id="tahun_terbit" class="lh-1 fs-6">2023</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a> -->


                    </div>

                    <div class="page">
                        <button>
                            < </button>

                                <button>1</button>
                                <button>2</button>
                                <button>3</button>
                                <button>...</button>
                                <button>9</button>

                                <button>></button>
                    </div>
                    <br>

                    <!-- </div> -->
                </div>
            </div>
        </main>
    </div>



    <!-- Modal -->
    <div class="modal" id="modalBuku">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0" style="width: 450px; padding: 10px;">
                <div class="modal-header border-0 d-flex row">
                    <div class="d-flex">
                        <h4 class="modal-title text-nowrap sb" id="exampleModalLongTitle">Detail Buku</h4>
                        <button type="button" data-dismiss="modal" aria-label="Close" style="width: auto; height: auto; margin-left: auto; align-items: center;">
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
                    <button type="button" class="btn btn-secondary btn-footer sb fs-14" data-dismiss="modal">Batal</button>
                    <!-- <button type="button" class="btn btn-primary btn-footer sb fs-14" id="pinjam">Pinjam</button> -->
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
                        <button type="button" data-dismiss="modal" aria-label="Close" style="width: auto; height: auto; margin-left: auto; align-items: center;">
                            <img src="assets/icon/close-circle-bl.svg" alt="">
                        </button>
                    </div>
                    <span class="lh-1 sr" style="font-size: small;" id="thesis_id">#TH001</span>
                </div>
                <div class="modal-body">
                    <div class="d-flex border-bottom">
                        <div class="gambar" style="width: 111px;height: 134px;">
                            <img src="cover/cover_buku2.png" class="img img-fluid">
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
                    <button type="button" class="btn btn-secondary btn-footer sb fs-14" data-dismiss="modal">Batal</button>
                    <!-- <button type="button" class="btn btn-primary btn-footer sb fs-14" id="pinjam">Pinjam</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
    <!-- <script src="assets/js/filter.js"></script> -->
</body>