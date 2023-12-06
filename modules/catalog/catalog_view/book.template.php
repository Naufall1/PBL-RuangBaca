<?php
// $books = new Book();
foreach ($books as $book) {
?>

    <div class="book-collection d-flex" id="<?= $book->getId() ?>" onclick="getDesc(this);">

        <img src="<?= COVER_DIR . '/' . $book->getCover() ?>" alt="" class="book-cover" style="object-fit: cover; object-position: 0 80%;">

        <div class="book-content d-flex">
            <div class="<?= ($book->getAvail() < 1) ? 'book-status-not-avail':'book-status-avail'?> d-flex">
                <p id="<?= ($book->getAvail() < 1) ? 'not-avail':'avail'?>"><?= ($book->getAvail() < 1) ? 'Tidak Tersedia' : 'Tersedia' ?></p>
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