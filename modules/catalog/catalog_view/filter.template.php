<?php
// $shelf = Shelf::getAll();
// $cat = Category::
?>

<!-- <div class="filter-groups d-flex"> -->

<!-- Start: Filter Jenis -->
<div class="filter-group d-flex" id="types">

    <div class="filter-title d-flex">
        <p class="filter-heading">Jenis</p>
        <svg class="dropdown-icon" id="type" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m16.6 12.542-5.433-5.434a1.655 1.655 0 0 0-2.334 0L3.4 12.542" />
        </svg>
    </div>

    <div class="filter-contents d-flex">
        <button class="btn-filter d-flex" name="type" id="buku">Buku</button>
        <button class="btn-filter d-flex" name="type" id="skripsi">Skripsi</button>
    </div>

</div>
<!-- End: Filter Jenis -->

<div class="hr-divider"></div>

<!-- Start: Filter Ketersediaan -->
<div class="filter-group d-flex" id="avail-status">

    <div class="filter-title d-flex">
        <p class="filter-heading">Ketersediaan</p>
        <svg class="dropdown-icon" id="type" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m16.6 12.542-5.433-5.434a1.655 1.655 0 0 0-2.334 0L3.4 12.542" />
        </svg>
    </div>

    <div class="filter-contents d-flex">
        <button class="btn-filter d-flex" name="avail-status" id="avail">Tersedia</button>
        <button class="btn-filter d-flex" name="avail-status" id="not-avail">Tidak Tersedia</button>
    </div>

</div>
<!-- End: Filter Ketersediaan -->

<div class="hr-divider"></div>

<!-- Start: Filter Lokasi -->
<div class="filter-group d-flex" id="locations">

    <div class="filter-title d-flex">
        <p class="filter-heading">Lokasi</p>
        <svg class="dropdown-icon" id="locations" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m16.6 12.542-5.433-5.434a1.655 1.655 0 0 0-2.334 0L3.4 12.542" />
        </svg>
    </div>

    <div class="filter-contents d-flex">
        <form action="" class="form-data d-flex">

            <?php
            foreach (Shelf::getAll() as $shelf) {
            ?>
                <div class="form-check">
                    <input name="location" class="form-check-input checkbox-filter" type="checkbox" value="<?= $shelf[0] ?>" id="<?= $shelf[0] ?>">
                    <label class="form-check-label" for="<?= $shelf[0] ?>">
                        RAK-<?= substr($shelf[0], 1) ?>
                    </label>
                </div>

            <?php
            }
            ?>
        </form>
    </div>

</div>
<!-- End: Filter Lokasi -->

<div class="hr-divider"></div>

<!-- Start: Filter Kategori -->
<div class="filter-group d-flex" id="categories">

    <div class="filter-title d-flex">
        <p class="filter-heading">Kategori</p>
        <svg class="dropdown-icon" id="categories" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m16.6 12.542-5.433-5.434a1.655 1.655 0 0 0-2.334 0L3.4 12.542" />
        </svg>
    </div>

    <div class="filter-contents d-flex">
        <input type="text" name="search" class="filter-search-fields" id="categories" placeholder="Cari Kategori">
        <form action="" class="form-data d-flex">

            <?php
            $categories = Category::getAll();
            while ($cat = $categories->fetch_assoc()) {
            ?>

                <div class="form-check">
                    <input name="category" class="form-check-input checkbox-filter" type="checkbox" value="<?= $cat['category_id'] ?>" id="<?= $cat['category_id'] ?>">
                    <label class="form-check-label" for="<?= $cat['category_id'] ?>">
                        <?= $cat['category_name'] ?>
                    </label>
                </div>

            <?php
            }
            ?>

        </form>
        <a href="" class="more-filter" id="categories">Lihat Selengkapnya</a>
    </div>

</div>
<!-- End: Filter Kategori -->

<div class="hr-divider"></div>

<!-- Start: Filter Author -->
<div class="filter-group d-flex" id="authors">

    <div class="filter-title d-flex">
        <p class="filter-heading">Penulis</p>
        <svg class="dropdown-icon" id="author" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m16.6 12.542-5.433-5.434a1.655 1.655 0 0 0-2.334 0L3.4 12.542" />
        </svg>
    </div>

    <div class="filter-contents d-flex">
        <input type="text" name="search" class="filter-search-fields" id="categories" placeholder="Cari Penulis">
        <form action="" class="form-data d-flex">
            <?php
            $author = Author::getAll();
            while ($aut = $author->fetch_assoc()) {
            ?>

                <div class="form-check">
                    <input name="author" class="form-check-input checkbox-filter" type="checkbox" value="<?= $aut['author_id'] ?>" id="<?= $aut['author_id'] ?>">
                    <label class="form-check-label" for="<?= $aut['author_id'] ?>">
                        <?= $aut['author_name'] ?>
                    </label>
                </div>

            <?php
            }
            ?>

        </form>
        <a href="" class="more-filter" id="authors">Lihat Selengkapnya</a>
    </div>

</div>
<!-- End: Filter Penulis -->

<div class="hr-divider"></div>

<!-- Start: Filter Penerbit -->
<div class="filter-group d-flex" id="publishers">

    <div class="filter-title d-flex">
        <p class="filter-heading">Penerbit</p>
        <svg class="dropdown-icon" id="publishers" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m16.6 12.542-5.433-5.434a1.655 1.655 0 0 0-2.334 0L3.4 12.542" />
        </svg>
    </div>

    <div class="filter-contents d-flex">
        <input type="text" name="search" class="filter-search-fields" id="publishers" placeholder="Cari Penerbit">
        <form action="" class="form-data d-flex">
            <?php
            $publisher = Publisher::getAll();
            while ($pub = $publisher->fetch_assoc()) {
            ?>

                <div class="form-check">
                    <input name="publisher" class="form-check-input checkbox-filter" type="checkbox" value="<?= $pub['publisher_id'] ?>" id="<?= $pub['publisher_id'] ?>">
                    <label class="form-check-label" for="<?= $pub['publisher_id'] ?>">
                        <?= $pub['publisher_name'] ?>
                    </label>
                </div>

            <?php
            }
            ?>

        </form>
        <a href="" class="more-filter" id="publishers">Lihat Selengkapnya</a>
    </div>

</div>
<!-- End: Filter Penerbit -->

<div class="hr-divider"></div>

<!-- Start: Filter Tahun Terbit -->
<div class="filter-group d-flex" id="years">

    <div class="filter-title d-flex">
        <p class="filter-heading">Tahun Terbit</p>
        <svg class="dropdown-icon" id="years" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m16.6 12.542-5.433-5.434a1.655 1.655 0 0 0-2.334 0L3.4 12.542" />
        </svg>
    </div>

    <div class="filter-contents d-flex">
        <input type="text" name="search" class="filter-search-fields" id="years" placeholder="Cari Tahun Terbit">
        <form action="" class="form-data d-flex">
            <?php
            foreach (Catalog::getAllYearPublished() as $year) {
            ?>
                <div class="form-check">
                    <input name="year" class="form-check-input checkbox-filter" type="checkbox" value="<?= $year ?>" id="Y<?= $year ?>">
                    <label class="form-check-label" for="Y<?= $year ?>">
                        <?= $year ?>
                    </label>
                </div>
            <?php
            }
            ?>

        </form>
        <a href="" class="more-filter" id="publishers">Lihat Selengkapnya</a>
    </div>

</div>
<!-- End: Filter Tahun Terbit -->

<!-- </div> -->