<?php
    $statusId = '';
    foreach ($borrowingData as $row) {
        if ($row['id'] == null) {
            break;
        }
        // var_dump($row);
        // id, status, book, thesis, reserve_date
?>

        <div class="borrowing-card d-flex flex-column justify-content-between" onclick="loadModal('<?= $row['id'] ?>');">

            <div class="borrowing-card-header d-flex align-items-center justify-content-between">
                <p class="borrowing-id">#<?= $row['id'] ?></p>
                <?php
                    switch ($row['status']) {
                        case 'menunggu':
                            $statusId = 'waiting';
                            break;
                        case 'dikonfirmasi':
                            $statusId = 'confirmed';
                            break;
                        case 'dipinjam':
                            $statusId = 'borrowed';
                            break;
                        case 'selesai':
                            $statusId = 'done';
                            break;
                        case 'ditolak':
                            $statusId = 'reject';
                            break;
                        case 'terlambat':
                            $statusId = 'reject';
                            break;
                        default:
                            # code...
                            break;
                    }
                ?>
                <div class="borrowing-status d-flex" id="<?= $statusId ?>">
                    <p>
                        <?= ucfirst($row['status']) ?>
                    </p>
                </div>
            </div>

            <div class="borrowing-card-content d-flex flex-column">
                <p class="borrowing-card-title">
                    <?php
                        if ($row['book'] > 0 && $row['thesis'] > 0) {
                            echo $row['book'] . ' Buku & ' . $row['thesis'] . ' Skripsi';
                        } else {
                            if ($row['book']) {
                                echo $row['book'] . ' Buku';
                            }
                            if ($row['thesis']) {
                                echo $row['thesis'] . ' Skripsi';
                            }
                        }

                    ?>
                </p>
                <p class="borrowing-card-date">
                    <?php
                        $date=date_create($row['reserve_date']);
                        echo date_format($date,"d F Y");
                    ?>
                </p>
            </div>

        </div>
<?php
    }
?>