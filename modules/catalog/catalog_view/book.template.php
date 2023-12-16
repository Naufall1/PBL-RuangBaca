<!-- Start: View Books Layer -->
<div class="collection-views d-flex justify-content-between mb-3">
    <p class="total-views">
        Menampilkan <?= $_SESSION['start']+1 ?>-<?= $_SESSION['end'] ?> dari <?= $_SESSION['countResult'] ?> koleksi
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

    <?php
    // $books = new Book();
    foreach ($books as $book) {
    ?>

        <div class="book-collection d-flex" id="<?= $book->getId() ?>" onclick="getDesc(this);">

            <img src="<?= COVER_DIR . '/' . $book->getCover() ?>" alt="" class="book-cover" style="object-fit: cover; object-position: 0 80%;">

            <div class="book-content d-flex">
                <div class="<?= ($book->getAvail() < 1) ? 'book-status-not-avail' : 'book-status-avail' ?> d-flex">
                    <p id="<?= ($book->getAvail() < 1) ? 'not-avail' : 'avail' ?>"><?= ($book->getAvail() < 1) ? 'Tidak Tersedia' : 'Tersedia' ?></p>
                </div>

                <p class="book-collection-title">
                    <?= $book->getTitle() ?>
                </p>

                <div class="book-collection-infos d-flex">
                    <div class="book-collection-info d-flex" style="width: 50%;">
                        <p class="book-collection-info-heading">
                            Penulis
                        </p>
                        <p class="book-collection-info-value">
                            <?= $book->getAuthor()->getAuthorName() ?>
                        </p>
                    </div>

                    <div class="vertical-divider book-collection-info-divider align-content-between"></div>

                    <div class="book-collection-info d-flex">
                        <p class="book-collection-info-heading">
                            Tahun Terbit
                        </p>
                        <p class="book-collection-info-value">
                            <?= $book->getYear() ?>
                        </p>
                    </div>

                </div>

            </div>

        </div>


    <?php
    }
    ?>

</div>
<!-- End: Books Collection Layer -->

<!-- Start: Bar View -->
<div class="pagination d-flex">
    <a href="#catalog" onclick="changePages('prev');">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M10 13.28 5.653 8.933a1.324 1.324 0 0 1 0-1.866L10 2.72" />
        </svg>
    </a>

    <!-- <a href="" class="active">2</a> -->
    <?php
    for ($i = 1; $i <= ceil($_SESSION['countResult'] / MAX_NUMS_ITEM); $i++) {
    ?>
        <a class="page <?= ($_SESSION['page'] == $i) ? 'active' : '' ?>" id="P-<?= $i ?>" onclick="changePages(this);"> <?= $i ?> </a>
    <?php
    }
    ?>

    <a href="#catalog" onclick="changePages('next');">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m5.94 13.28 4.347-4.347a1.324 1.324 0 0 0 0-1.866L5.94 2.72" />
        </svg>
    </a>
</div>
<!-- End: Bar View -->