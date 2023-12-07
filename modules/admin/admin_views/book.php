<!-- Start: Action Container Layer -->
<div class="action-container d-flex justify-content-between">
    <input type="text" name="search-book" class="search-fields" id="" placeholder="Cari Buku" onkeypress="search(this);">
    <button class="enabled" id="icon-button" type="button">
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
        Menampilkan <?= $books['start']+1 ?>-<?= $books['end'] ?> dari <?= $books['countAll'] ?> koleksi
    </p>
</div>
<!-- End: View Books Layer -->

<!-- Start: Table -->
<table>
    <thead>
        <tr>
            <th class="no-column">No</th>
            <th class="id-column" id="">ID Buku</th>
            <th>Judul</th>
            <th class="number-column" id="stock">Stok</th>
            <th class="number-column" id="available">Tersedia</th>
            <th class="more-icon-column"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($books['data'] as $book) {
        ?>
            <tr>
                <td class="no-column"><?= $i ?></td>
                <td class="id-column" id=""><?= $book->getId(); ?></td>
                <td class="title-column"><?= $book->getTitle(); ?></td>
                <td class="number-column" id="stock"><?= $book->getStock(); ?></td>
                <td class="number-column" id="available"><?= $book->getAvail(); ?></td>
                <td class="more-icon-column">
                    <a href="" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                            <path fill="#1B1B1B" fill-rule="evenodd" d="M8.75 5a1.25 1.25 0 1 1 2.5 0 1.25 1.25 0 0 1-2.5 0Zm0 5a1.25 1.25 0 1 1 2.5 0 1.25 1.25 0 0 1-2.5 0Zm0 5a1.25 1.25 0 1 1 2.5 0 1.25 1.25 0 0 1-2.5 0Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" name="book" onclick="edit(this);" value="<?= $book->getId() ?>">Edit</a>
                        <a class="dropdown-item" href="#"  name="book" onclick="detail(this);" value="<?= $book->getId() ?>">Detail</a>
                        <a class="dropdown-item" href="#" id="risk-action" name="book" onclick="detail(this);" value="<?= $book->getId() ?>">Hapus</a>
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
            <a href="#" class="<?= ($books['page'] == $i) ? 'active':'' ?>" ><?= $i ?></a>
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



<!-- Start: Modal Confirmation -->
<!-- DELETE DISPLAY STYLE FIRST BELOW -->
<div class="modal" id="modalBuku">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content modal-custom-add-book">
            <div class="modal-header border-0 d-flex">
                <div class="d-flex" style="padding: 0; width: 100%;">

                    <div class="d-flex flex-column align-content-between " style="width: 100%;">
                        <h3 class="modal-heading" id="">Tambah Data</h3>
                    </div>

                    <button type="button" data-dismiss="modal" aria-label="Close" class="close-button" onclick="closeModal(this);" id="book">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 15 15 5m0 10-5-5-5-5"/>
                        </svg>
                    </button>

                </div>
            </div>

            <div class="modal-body">

                <form class=" flex-column d-flex">

                    <div class="modal-form-addbook-areas d-flex">

                        <div class="modal-form-addbook-area d-flex flex-column">
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="title">Judul</label>
                                <input required type="text" id="title" name="title" placeholder="Masukkan Judul">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="synopsis">Sinposis</label>
                                <textarea required id="synopsis" name="synopsis" placeholder="Masukkan Sinopsis"></textarea>
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="cover">Cover</label>
                                <input required type="file" id="cover" name="cover">
                            </div>
                        </div>

                        <div class="modal-form-addbook-area d-flex flex-column">
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="author">Penulis</label>
                                <input required type="text" id="author" name="author" placeholder="Pilih Penulis">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="add-author">Tambah Penulis</label>
                                <input required type="text" id="add-author" name="add-author" placeholder="Masukkan Penulis">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="publisher">Penerbit</label>
                                <input required type="text" id="publisher" name="publisher" placeholder="Pilih Penerbit">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="add-publisher">Tambah Penerbit</label>
                                <input required type="text" id="add-publisher" name="add-publisher" placeholder="Masukkan Penerbit">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="year">Tahun Terbit</label>
                                <input required type="number" id="year" name="year" placeholder="Masukkan Tahun Terbit">
                            </div>
                            <div class="addbook-input-field divider-half-input-field input-fields d-flex">
                                <div class="addbook-input-field half-input-field input-fields d-flex flex-column">
                                    <label for="shelf">Rak</label>
                                    <input required type="text" id="shelf" name="shelf" placeholder="Pilih Rak">
                                </div>
                                <div class="addbook-input-field half-input-field input-fields d-flex flex-column">
                                    <label for="stock">Stok</label>
                                    <input required type="number" min="1" id="stock" name="stock" placeholder="Masukkan Stok">
                                </div>
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="isbn">ISBN</label>
                                <input required type="text" id="isbn" name="isbn" placeholder="Masukkan ISBN">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="ddc_code">Kode DDC</label>
                                <input required type="text" id="ddc_code" name="ddc_code" placeholder="Masukkan Kode DDC">
                            </div>

                        </div>
                    </div>

                    <div class="d-flex modal-button-group" style="gap: 12px;">

                        <button type="submit" class="enabled modal-button-top-margin" id="tambah" name="book" onclick="">Tambah</button>

                    </div>

                </form>
            </div>



        </div>
    </div>
</div>
<!-- End: Modal Confirmation -->