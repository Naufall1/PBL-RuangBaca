<?php
// $books = new Book();
foreach ($books as $book) {
?>


    <a class="col-xs-2-4 book" href="#" id="<?= $book->getId() ?>" onclick="getDesc(this);" style="text-decoration: none; margin: 10px;" class="d-flex flex-column">
        <!-- <div > -->
        <div class="d-flex flex-column" style="align-items: center;">
            <img class="img-fluid center-cropped" src="<?= COVER_DIR . '/' . $book->getCover() ?>" style="height: 203px; width:169px; object-fit: cover; object-position: 0 100%;">
        </div>
        <!-- <div class=""> -->
        <span class="fw-bold d-flex fs-10 status <?= ($book->getAvail() < 1) ? 'not-avail' : 'avail' ?> rounded-3">
            <img src="<?= ($book->getAvail() < 1) ? 'assets/icon/ellipse-red.svg' : 'assets/icon/ellipse-green.svg' ?>" style="padding-right: 5px;"> <?= ($book->getAvail() < 1) ? 'Tidak Tersedia' : 'Tersedia' ?>
        </span>
        <!-- </div> -->
        <p class="fw-bold title-text fs-14 sb" style="margin-bottom: 4px; height: 32px; line-height: 16px;">
            <?= $book->getTitle() ?>
        </p>
        <!-- <div id="title">
                                    </div> -->
        <div class="row" style="margin-top: auto; margin-bottom: 0px;">
            <div class="col-7" style=" padding-bottom: 5px; padding-top: 4px; padding-right: 2px;">
                <p class="lh-1" style="font-size: x-small; color: darkgray;">Penulis</p>
                <p id="penulis" class="lh-1 fs-14 text-nowrap" style="overflow: hidden; text-overflow: ellipsis;"><?= $book->getAuthor()->getAuthorName() ?></p>
            </div>
            <div class="col d-flex" style=" align-items: center; padding-left: 0%;">
                <div style=" border-left: 2px solid #D9D9D9; height: 25px; "></div>
                <div style="margin-left: 10px;">
                    <p class="lh-1" style="font-size: xx-small; color: darkgray;">Tahun
                        Terbit
                    </p>
                    <p id="tahun_terbit" class="lh-1 fs-14"><?= $book->getYear() ?></p>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </a>


<?php
}
?>