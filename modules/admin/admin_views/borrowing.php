<!-- Start: Action Container Layer -->
<div class="action-container d-flex justify-content-between">
    <input type="text" name="search" class="search-fields" id="" placeholder="Cari Peminjaman">
</div>
<!-- End: Action Container Layer -->

<!-- Start: View Books Layer -->
<div class="collection-views d-flex justify-content-between">
    <p class="total-views">
        Menampilkan <?= $borrowing['start']+1 ?>-<?= $borrowing['end'] ?> dari <?= $borrowing['countAll'] ?> koleksi
    </p>
</div>
<!-- End: View Books Layer -->

<!-- Start: Table -->
<table>
    <thead>
        <tr>
            <th class="no-column">No</th>
            <th class="id-column" id="">ID Peminjaman</th>
            <th>Nama</th>
            <th>Tanggal Ambil</th>
            <th>Status</th>
            <!-- <th class="number-column" id="available">Tersedia</th> -->
            <th class="more-icon-column"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($borrowing['data'] as $dt) {
            switch ($dt->getStatus()) {
                case 'Menunggu':
                    $statusId = 'waiting';
                    break;
                case 'Dikonfirmasi':
                    $statusId = 'confirmed';
                    break;
                case 'Dipinjam':
                    $statusId = 'borrowed';
                    break;
                case 'Selesai':
                    $statusId = 'done';
                    break;
                case 'Ditolak':
                    $statusId = 'reject';
                    break;
                case 'Terlambat':
                    $statusId = 'reject';
                    break;
                default:
                    # code...
                    break;
            }
        ?>
            <tr>
                <td class="no-column"><?= $i+$borrowing['start'] ?></td>
                <td class="id-column" id=""><?= $dt->getId(); ?></td>
                <td class="title-column"><?= $dt->getMember()->getName(); ?></td>
                <td class="title-column"><?= $dt->getReserveDate(); ?></td>
                <!-- <td class="title-column"><?= $dt->getStatus(); ?></td> -->
                <td class="title-column">
                    <div class="borrowing-status d-flex" name="status-modal" id="<?= $statusId ?>">
                        <p>
                            <!-- [STATUS] -->
                            <?= $dt->getStatus();?>
                        </p>
                    </div>
                </td>

                <td class="more-icon-column">
                    <!-- <a href="" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                            <path fill="#1B1B1B" fill-rule="evenodd" d="M8.75 5a1.25 1.25 0 1 1 2.5 0 1.25 1.25 0 0 1-2.5 0Zm0 5a1.25 1.25 0 1 1 2.5 0 1.25 1.25 0 0 1-2.5 0Zm0 5a1.25 1.25 0 1 1 2.5 0 1.25 1.25 0 0 1-2.5 0Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" name="book" onclick="edit(this);" value="">Edit</a>
                        <a class="dropdown-item" href="#" id="risk-action" name="book" onclick="detail(this);" value="">Hapus</a>
                    </div> -->
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
    <a href="#" id="prev" name="pagination">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M10 13.28 5.653 8.933a1.324 1.324 0 0 1 0-1.866L10 2.72" />
        </svg>
    </a>

    <?php
        for ($i=1; $i <= $numPage; $i++) {
    ?>
            <a href="#" name="pagination" class="<?= ($borrowing['page'] == $i) ? 'active':'' ?>" ><?= $i ?></a>
    <?php
        }
    ?>
    <a href="#" id="next" name="pagination">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="m5.94 13.28 4.347-4.347a1.324 1.324 0 0 0 0-1.866L5.94 2.72" />
        </svg>
    </a>
</div>
<!-- End: Pagination View -->