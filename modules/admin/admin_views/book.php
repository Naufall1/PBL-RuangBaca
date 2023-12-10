<!-- Start: Action Container Layer -->
<div class="action-container d-flex justify-content-between">
    <input type="text" name="search-book" class="search-fields" id="" placeholder="Cari Buku"
        onkeypress="search(this);">
    <button class="enabled" id="icon-button" type="button" data-bs-toggle="modal" data-bs-target="#modalAdd">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
            <path fill="#fff"
                d="M18 12.75H6c-.41 0-.75-.34-.75-.75s.34-.75.75-.75h12c.41 0 .75.34.75.75s-.34.75-.75.75Z" />
            <path fill="#fff"
                d="M12 18.75c-.41 0-.75-.34-.75-.75V6c0-.41.34-.75.75-.75s.75.34.75.75v12c0 .41-.34.75-.75.75Z" />
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
                        <path fill="#1B1B1B" fill-rule="evenodd"
                            d="M8.75 5a1.25 1.25 0 1 1 2.5 0 1.25 1.25 0 0 1-2.5 0Zm0 5a1.25 1.25 0 1 1 2.5 0 1.25 1.25 0 0 1-2.5 0Zm0 5a1.25 1.25 0 1 1 2.5 0 1.25 1.25 0 0 1-2.5 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" name="book" onclick="edit(this);"
                        value="<?= $book->getId() ?>">Edit</a>
                    <a class="dropdown-item" href="#" name="book" onclick="detail(this);"
                        value="<?= $book->getId() ?>">Detail</a>
                    <a class="dropdown-item" href="#" id="risk-action" name="book" onclick="detail(this);"
                        value="<?= $book->getId() ?>">Hapus</a>
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
            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                stroke-width="1.5" d="M10 13.28 5.653 8.933a1.324 1.324 0 0 1 0-1.866L10 2.72" />
        </svg>
    </a>
    <?php
        for ($i=1; $i <= $numPage; $i++) {
    ?>
    <a href="#" class="<?= ($books['page'] == $i) ? 'active':'' ?>"><?= $i ?></a>
    <?php
        }
    ?>
    <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                stroke-width="1.5" d="m5.94 13.28 4.347-4.347a1.324 1.324 0 0 0 0-1.866L5.94 2.72" />
        </svg>
    </a>
</div>
<!-- End: Pagination View -->



<!-- Start: Modal Add Book -->
<!-- DELETE DISPLAY STYLE FIRST BELOW -->
<div class="modal" id="modalAdd">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content modal-custom-add-book">
            <div class="modal-header border-0 d-flex">
                <div class="d-flex" style="padding: 0; width: 100%;">

                    <div class="d-flex flex-column align-content-between " style="width: 100%;">
                        <h3 class="modal-heading" id="">Tambah Data</h3>
                    </div>

                    <button type="button" data-dismiss="modal" aria-label="Close" class="close-button"
                    data-bs-dismiss="modal" aria-label="Close" id="book">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5 15 15 5m0 10-5-5-5-5" />
                        </svg>
                    </button>

                </div>
            </div>

            <div class="modal-body">

                <form class=" flex-column d-flex" id="formAddBook" enctype="multipart/form-data">

                    <div class="modal-form-addbook-areas d-flex">

                        <div class="modal-form-addbook-area d-flex flex-column">
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="title">Judul</label>
                                <input required type="text" id="title" name="title" placeholder="Masukkan Judul">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="synopsis">Sinposis</label>
                                <textarea required id="synopsis" name="synopsis"
                                    placeholder="Masukkan Sinopsis"></textarea>
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="category">Category</label>
                                <select class="form-select input-group-custom" id="inputGroupSelect01 category"
                                    name="category">
                                    <option disabled selected>Pilih Category</option>
                                    <option value="add">Tambah...</option>
                                    <?php
                                        $categories = Category::getAll();
                                        while ($cat = $categories->fetch_assoc()) {
                                    ?>
                                        <option value="<?= $cat['category_id'] ?>"><?= $cat['category_name'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="add-category">Tambah Category</label>
                                <input required type="text" id="add-category" name="add-category"
                                    placeholder="Masukkan Category">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="cover">Cover</label>
                                <input required type="file" id="cover" name="cover">
                            </div>
                        </div>

                        <div class="modal-form-addbook-area d-flex flex-column">
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="author">Penulis</label>
                                <select class="form-select input-group-custom" id="inputGroupSelect01 author"
                                    name="author">
                                    <option disabled selected>Pilih Penulis</option>
                                    <option value="add">Tambah...</option>
                                    <?php
                                        $author = Author::getAll();
                                        while ($aut = $author->fetch_assoc()) {
                                    ?>
                                        <option value="<?= $aut['author_id'] ?>"><?= $aut['author_name'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="add-author">Tambah Penulis</label>
                                <input required type="text" id="add-author" name="add-author"
                                    placeholder="Masukkan Penulis">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="publisher">Penerbit</label>
                                <select class="form-select input-group-custom" id="inputGroupSelect01 publisher"
                                    name="publisher">
                                    <option disabled selected>Pilih Penerbit</option>
                                    <option value="add">Tambah...</option>
                                    <?php
                                        $publisher = Publisher::getAll();
                                        while ($pub = $publisher->fetch_assoc()) {
                                    ?>
                                        <option value="<?= $pub['publisher_id']?>"><?= $pub['publisher_name']?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="add-publisher">Tambah Penerbit</label>
                                <input required type="text" id="add-publisher" name="add-publisher"
                                    placeholder="Masukkan Penerbit">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="year">Tahun Terbit</label>
                                <input required type="number" id="year" name="year" placeholder="Masukkan Tahun Terbit">
                            </div>
                            <div class="addbook-input-field divider-half-input-field input-fields d-flex">
                                <div class="addbook-input-field half-input-field input-fields d-flex flex-column">
                                    <label for="shelf">Rak</label>
                                    <select class="form-select input-group-custom" id="inputGroupSelect01 shelf"
                                        name="shelf" required>
                                        <option disabled selected>Pilih Rak</option>
                                        <?php
                                            $rak = Shelf::getAll();
                                            foreach ($rak as $rak_id) {
                                        ?>
                                            <option value="<?= $rak_id[0]?>"><?= $rak_id[0]?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="addbook-input-field half-input-field input-fields d-flex flex-column">
                                    <label for="stock">Stok</label>
                                    <input required type="number" min="1" id="stock" name="stock"
                                        placeholder="Masukkan Stok">
                                </div>
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="isbn">ISBN</label>
                                <input required type="text" id="isbn" name="isbn" placeholder="Masukkan ISBN">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="ddc_code">Kode DDC</label>
                                <input required type="text" id="ddc_code" name="ddc_code"
                                    placeholder="Masukkan Kode DDC">
                            </div>

                        </div>
                    </div>

                    <div class="d-flex modal-button-group" style="gap: 12px;">

                        <button type="submit" class="enabled modal-button-top-margin" id="tambah" name="book"
                            onclick="">Tambah</button>

                    </div>

                </form>
            </div>



        </div>
    </div>
</div>
<!-- End: Modal Add Book -->


<!-- Start: Modal Edit Book -->
<!-- DELETE DISPLAY STYLE FIRST BELOW -->
<div class="modal" id="modalEdit" >
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content modal-custom-add-book">
            <div class="modal-header border-0 d-flex">
                <div class="d-flex" style="padding: 0; width: 100%;">

                    <div class="d-flex flex-column align-content-between " style="width: 100%;">
                        <h3 class="modal-heading" id="">Edit Data</h3>
                    </div>

                    <button type="button" data-dismiss="modal" aria-label="Close" class="close-button"
                        onclick="closeModal(this);" id="book">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5 15 15 5m0 10-5-5-5-5" />
                        </svg>
                    </button>

                </div>
            </div>

            <div class="modal-body">

                <form class=" flex-column d-flex" method="post" enctype="multipart/form-data">

                    <div class="modal-form-addbook-areas d-flex">

                        <div class="modal-form-addbook-area d-flex flex-column">
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="cover">Cover</label>
                                <img src="<?= COVER_DIR . '/' . $book->getCover() ?>" alt="" class="book-cover"
                                    style="object-fit: cover; object-position: 0 80%;">
                                <input required type="file" id="cover" name="cover">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="title">Judul</label>
                                <input value="[FILLED TITLE]" required type="text" id="title" name="title"
                                    placeholder="Masukkan Judul">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="synopsis">Sinposis</label>
                                <textarea id="synopsis" name="synopsis" placeholder="Masukkan Sinopsis">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ut quam eaque facilis repellat expedita corrupti dolores eius, possimus sequi beatae dolorem nam enim, dicta quo soluta magni voluptatum recusandae? Labore dolorem magnam, suscipit maxime dignissimos magni dicta quam porro at.
                                </textarea>
                            </div>
                        </div>

                        <div class="modal-form-addbook-area d-flex flex-column">
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="book_id">ID Buku</label>
                                <input value="[BOOK ID]" disabled type="text" id="book_id" name="book_id"
                                    placeholder="Masukkan Penerbit">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="author">Penulis</label>
                                <!-- <div class="input-group"> -->
                                <!-- <label class="input-group-text" for="inputGroupSelect01">Options</label> -->
                                <select class="form-select input-group-custom" id="inputGroupSelect01 author"
                                    name="author">
                                    <option selected>[SELECTED AUTHOR]</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <!-- </div> -->
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="publisher">Penerbit</label>
                                <select class="form-select input-group-custom" id="inputGroupSelect01 publisher"
                                    name="publisher">
                                    <option selected>[SELECTED PUBLISHER]</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="year">Tahun Terbit</label>
                                <input value="[FILLED YEAR]" required type="number" id="year" name="year"
                                    placeholder="Masukkan Tahun Terbit">
                            </div>
                            <div class="addbook-input-field divider-half-input-field input-fields d-flex">
                                <div class="addbook-input-field half-input-field input-fields d-flex flex-column">
                                    <label for="shelf">Rak</label>
                                    <select class="form-select input-group-custom" id="inputGroupSelect01 shelf"
                                        name="shelf">
                                        <option selected>[SELECTED SHELF]</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="addbook-input-field half-input-field input-fields d-flex flex-column">
                                    <label for="stock">Stok</label>
                                    <input value="[STOCK LEFT]" required type="number" min="1" id="stock" name="stock"
                                        placeholder="Masukkan Stok">
                                </div>
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="isbn">ISBN</label>
                                <input value="[FILLED ISBN]" required type="text" id="isbn" name="isbn"
                                    placeholder="Masukkan ISBN">
                            </div>
                            <div class="addbook-input-field input-fields d-flex flex-column">
                                <label for="ddc_code">Kode DDC</label>
                                <input value="[FILLED DDC CODE]" required type="text" id="ddc_code" name="ddc_code"
                                    placeholder="Masukkan Kode DDC">
                            </div>

                        </div>
                    </div>

                    <div class="d-flex modal-button-group" style="gap: 12px;">

                        <button type="submit" class="enabled modal-button-top-margin" id="tambah" name="book"
                            onclick="">Simpan</button>

                    </div>

                </form>
            </div>



        </div>
    </div>
</div>
<!-- End: Modal Edit Book -->

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
                    <p class="delete-confirmation">
                        Apakah Anda yakin ingin menghapus Buku dengan ID Buku <span>BK0001</span>?
                    </p>


                    <div class="d-flex modal-button-group" style="gap: 12px;">

                        <button type="button" class="enabled danger modal-button-top-margin" id="hapus" name="book" onclick="">Hapus</button>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="enabled secondary modal-button-top-margin" onclick="closeModal(this);" id="modalBuku">Batal</button>
                        <!-- BUTTON BATAL GA GELEM CLOSE, BLM KETEMU SOLUSINYA -->
                    </div>

                <!-- </form> -->
            </div>



        </div>
    </div>
</div>
<!-- End: Modal Delete-->