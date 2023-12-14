<!-- Start: Action Container Layer -->
<div class="action-container d-flex justify-content-between">
    <input type="text" name="search" class="search-fields" id="" placeholder="Cari Skripsi">
    <button class="enabled" id="icon-button" type="button" data-bs-toggle="modal" data-bs-target="#modalAdd">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
            <path fill="#fff" d="M18 12.75H6c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h12c.41 0 .75.34.75.75s-.34.75-.75.75Z" />
            <path fill="#fff" d="M12 18.75c-.41 0-.75-.34-.75-.75V6c0-.41.34-.75.75-.75s.75.34.75.75v12c0 .41-.34.75-.75.75Z" />
        </svg>
        Tambah
    </button>
</div>
<!-- End: Action Container Layer -->

<!-- Start: View Books Layer -->
<div class="collection-views d-flex justify-content-between">
    <p class="total-views">
        Menampilkan <?= $thesis['start'] + 1 ?>-<?= $thesis['end'] ?> dari <?= $thesis['countAll'] ?> koleksi
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
                <td class="no-column"><?= $i + $thesis['start'] ?></td>
                <td class="id-column"><?= $th->getId(); ?></td>
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
                        <a class="dropdown-item" href="#" name="book" onclick="editThesis('<?= $th->getId(); ?>');" value="">Edit</a>
                        <a class="dropdown-item" href="#" id="risk-action" name="book" onclick="deleteById('<?= $th->getId(); ?>');" value="">Hapus</a>
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
    for ($i = 1; $i <= $numPage; $i++) {
    ?>
        <a href="#" name="pagination" class="<?= ($thesis['page'] == $i) ? 'active' : '' ?>"><?= $i ?></a>
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

<!-- Start: Modal Add thesis -->
<!-- DELETE DISPLAY STYLE FIRST BELOW -->
<div class="modal" id="modalAdd">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content modal-custom-single-col">
            <div class="modal-header border-0 d-flex">
                <div class="d-flex" style="padding: 0; width: 100%;">

                    <div class="d-flex flex-column align-content-between " style="width: 100%;">
                        <h3 class="modal-heading" id="">Tambah Data</h3>
                    </div>

                    <button type="button" class="close-button" id="book" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5" />
                        </svg>
                    </button>

                </div>
            </div>

            <div class="modal-body">

                <form class=" flex-column d-flex" id="formAddThesis" method="post">
                    <div class="modal-form-addbook-area d-flex flex-column">
                        <div class="addbook-input-field input-fields d-flex flex-column">
                            <label for="thesis_title">Judul</label>
                            <input required type="text" id="thesis_title" name="thesis_title" placeholder="Masukkan Judul">
                        </div>
                        <div class="addbook-input-field input-fields d-flex flex-column">
                            <label for="writer_name">Nama Penulis</label>
                            <input required type="text" id="writer_name" name="writer_name" placeholder="Masukkan Nama Penulis">
                        </div>
                        <div class="addbook-input-field input-fields d-flex flex-column">
                            <label for="writer_NIM">NIM Penulis</label>
                            <input required type="text" id="writer_NIM" name="writer_NIM" placeholder="Masukkan NIM Penulis">
                        </div>
                        <div class="addbook-input-field input-fields d-flex flex-column">
                            <label for="year_published">Tahun</label>
                            <input required type="number" id="year_published" name="year_published" placeholder="Masukkan Tahun">
                        </div>
                        <div class="addbook-input-field input-fields d-flex flex-column">
                            <label for="lecturer_id1">Dosen Pembimbing 1</label>
                            <select class="form-select input-group-custom" id="inputGroupSelect01 lecturer_id1" name="lecturer_id1">
                                <option disabled selected>Pilih Dosen</option>
                                <?php
                                $lecturer = Lecturer::getAll();
                                while ($row = $lecturer->fetch_assoc()) {
                                ?>
                                    <option value="<?= $row['NIDN'] ?>"><?= $row['lecturer_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="addbook-input-field input-fields d-flex flex-column">
                            <label for="lecturer_id2">Dosen Pembimbing 2</label>
                            <select class="form-select input-group-custom" id="inputGroupSelect01 lecturer_id2" name="lecturer_id2">
                                <option disabled selected>Pilih Dosen</option>
                                <?php
                                $lecturer = Lecturer::getAll();
                                while ($row = $lecturer->fetch_assoc()) {
                                ?>
                                    <option value="<?= $row['NIDN'] ?>"><?= $row['lecturer_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="addbook-input-field input-fields d-flex flex-column">
                            <label for="lecturer_id2">Prodi</label>
                            <select class="form-select input-group-custom" id="inputGroupSelect01 lecturer_id2" name="prodi">
                                <option disabled selected>Pilih Prodi</option>
                                <option value="D4-TI">D4-TI</option>
                                <option value="D3-MI">D3-MI</option>
                                <option value="D4-SIB">D4-SIB</option>
                                <option value="D2-PPLS">D2-PPLS</option>
                            </select>
                        </div>
                        <div class="addbook-input-field input-fields d-flex flex-column">
                            <label for="shelf">Rak</label>
                            <select class="form-select input-group-custom" id="inputGroupSelect01 shelf" name="shelf" required>
                                <option disabled selected>Pilih Rak</option>
                                <?php
                                $rak = Shelf::getAll();
                                foreach ($rak as $rak_id) {
                                ?>
                                    <option value="<?= $rak_id[0] ?>"><?= $rak_id[0] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex modal-button-group" style="gap: 12px;">
                        <button type="submit" class="enabled modal-button-top-margin" id="tambah" name="thesis" onclick="">Tambah</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<!-- End: Modal Add thesis -->


<!-- Start: Modal Edit thesis -->
<!-- DELETE DISPLAY STYLE FIRST BELOW -->
<div class="modal" id="modalEdit">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content modal-custom-single-col">
            <div class="modal-header border-0 d-flex">
                <div class="d-flex" style="padding: 0; width: 100%;">

                    <div class="d-flex flex-column align-content-between " style="width: 100%;">
                        <h3 class="modal-heading" id="">Edit Data</h3>
                    </div>

                    <button type="button" data-dismiss="modal" aria-label="Close" class="close-button" onclick="closeModal(this);" id="book">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5" />
                        </svg>
                    </button>

                </div>
            </div>

            <div class="modal-body">

                <form class=" flex-column d-flex" id="formEdit" method="post" enctype="multipart/form-data">

                    <div class="modal-form-addbook-areas d-flex">

                        <div class="modal-form-addbook-area d-flex flex-column">
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="thesis_id">ID Skripsi</label>
                                <input value="[THESIS ID]" disabled type="text" id="thesis_id" name="id">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="thesis_title">Judul</label>
                                <input value="[FILLED TITLE]" required type="text" id="thesis_title" name="thesis_title" placeholder="Masukkan Judul">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="writer_name">Nama Penulis</label>
                                <input value="[FILLED WRITER]" required type="text" id="writer_name" name="writer_name" placeholder="Masukkan Nama Penulis">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="writer_NIM">NIM Penulis</label>
                                <input value="[FILLED WRITER'S NIM]" required type="text" id="writer_NIM" name="writer_NIM" placeholder="Masukkan NIM Penulis">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="year_published">Tahun</label>
                                <input value="[FILLED YEAR]" required type="text" id="year_published" name="year_published" placeholder="Masukkan Tahun">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="lecturer_id1">Dosen Pembimbing 1</label>
                                <select class="form-select input-group-custom" id="inputGroupSelect01 lecturer_id1" name="lecturer_id1">
                                    <?php
                                    $lecturer = Lecturer::getAll();
                                    while ($row = $lecturer->fetch_assoc()) {
                                    ?>
                                        <option value="<?= $row['NIDN'] ?>"><?= $row['lecturer_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="lecturer_id2">Dosen Pembimbing 2</label>
                                <select class="form-select input-group-custom" id="inputGroupSelect01 lecturer_id2" name="lecturer_id2">
                                    <?php
                                    $lecturer = Lecturer::getAll();
                                    while ($row = $lecturer->fetch_assoc()) {
                                    ?>
                                        <option value="<?= $row['NIDN'] ?>"><?= $row['lecturer_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="shelf">Rak</label>
                                <select class="form-select input-group-custom" id="inputGroupSelect01 shelf" name="shelf" required>
                                    <?php
                                    $rak = Shelf::getAll();
                                    foreach ($rak as $rak_id) {
                                    ?>
                                        <option value="<?= $rak_id[0] ?>"><?= $rak_id[0] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex modal-button-group" style="gap: 12px;">

                        <button type="submit" class="enabled modal-button-top-margin" id="tambah" name="thesis" onclick="">Simpan</button>

                    </div>

                </form>
            </div>



        </div>
    </div>
</div>
<!-- End: Modal Edit thesis -->


<!-- Start: Modal Delete-->
<!-- DELETE DISPLAY STYLE FIRST BELOW -->
<div class="modal" id="modalDelete">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content modal-custom-delete">
            <div class="modal-header border-0 d-flex">
                <div class="d-flex" style="padding: 0; width: 100%;">

                    <div class="d-flex flex-column align-content-between " style="width: 100%;">
                        <h3 class="modal-heading" id="">Hapus Data</h3>
                    </div>

                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close-button"
                        onclick="closeModal(this);" id="book">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5 15 15 5m0 10-5-5-5-5" />
                        </svg>
                    </button> -->

                </div>
            </div>

            <div class="modal-body">

                <!-- <form class=" flex-column d-flex"> -->
                <p class="delete-confirmation" mod='thesis'>
                    Apakah Anda yakin ingin menghapus Skripsi dengan ID Skripsi <span>BK0001</span>?
                </p>

                <div class="d-flex modal-button-group" style="gap: 12px;">
                    <button type="button" class="enabled danger modal-button-top-margin" id="hapus" name="publisher" onclick="processDelete();">Hapus</button>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="enabled secondary modal-button-top-margin" id="modalBuku">Batal</button>
                </div>

                <!-- </form> -->
            </div>



        </div>
    </div>
</div>
<!-- End: Modal Delete-->