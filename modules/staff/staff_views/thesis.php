<!-- Start: Action Container Layer -->
<div class="action-container d-flex justify-content-between">
    <input type="text" name="search" class="search-fields" id="" placeholder="Cari Skripsi">
    <div class="d-flex align-items-center">
        <span class="me-2">Prodi : </span>
        <select class="form-select w-auto" name="prodi">
            <option value="all">Semua</option>
            <?php
            $categories = Thesis::getAllCategories();
            while ($cat = $categories->fetch_assoc()) {
            ?>
                <option value="<?= $cat['category'] ?>" <?= (isset($_SESSION['prodi']) && $_SESSION['prodi'] == $cat['category']) ? 'selected':'' ?> ><?= $cat['category'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
</div>
<!-- End: Action Container Layer -->

<!-- Start: View Books Layer -->
<div class="collection-views d-flex justify-content-between">
    <p class="total-views">
        Menampilkan <?= $thesis['start']+1 ?>-<?= $thesis['end'] ?> dari <?= $thesis['countAll'] ?> koleksi
    </p>
</div>
<!-- End: View Books Layer -->

<!-- Start: Table -->
<table>
    <thead>
        <tr>
            <th class="no-column">No</th>
            <th class="id-column" id="">ID Skripsi</th>
            <th>Judul Skripsi</th>
            <th>Penulis</th>
            <!-- <th class="number-column" id="available">Tersedia</th> -->
            <th class="more-icon-column"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($thesis['data'] as $th) {
        ?>
            <tr>
                <td class="no-column"><?= $i+$thesis['start'] ?></td>
                <td class="id-column" id=""><?= $th->getId(); ?></td>
                <td class="title-column"><?= $th->getTitle(); ?></td>
                <td class="title-column"><?= $th->getAuthor()->getAuthorName(); ?></td>
                <!-- <td class="number-column" id="available">0</td> -->
                <td class="more-icon-column">
                    <a href="" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                            <path fill="#1B1B1B" fill-rule="evenodd" d="M8.75 5a1.25 1.25 0 1 1 2.5 0 1.25 1.25 0 0 1-2.5 0Zm0 5a1.25 1.25 0 1 1 2.5 0 1.25 1.25 0 0 1-2.5 0Zm0 5a1.25 1.25 0 1 1 2.5 0 1.25 1.25 0 0 1-2.5 0Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#"  name="book" onclick="getDesc(this);" id="<?= $th->getId() ?>">Detail</a>
                    </div>
                </td>
            </tr>
        <?php
            $i++;
        }
        ?>
    </tbody>
</table>
<!-- End: Table -->

<!-- Start: Pagination View -->
<div class="pagination d-flex">
    <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M10 13.28 5.653 8.933a1.324 1.324 0 0 1 0-1.866L10 2.72" />
        </svg>
    </a>

    <?php
        for ($i=1; $i <= $numPage; $i++) {
    ?>
            <a href="#" name="pagination" class="<?= ($thesis['page'] == $i) ? 'active':'' ?>" ><?= $i ?></a>
    <?php
        }
    ?>
    <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m5.94 13.28 4.347-4.347a1.324 1.324 0 0 0 0-1.866L5.94 2.72" />
        </svg>
    </a>
</div>
<!-- End: Pagination View -->

<!-- Start: Modal -->
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
                            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5" />
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
            </div>
        </div>
    </div>
</div>
<!-- End: Modal -->
