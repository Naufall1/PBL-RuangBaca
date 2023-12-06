<?php
    foreach ($borrowingData as $row) {
        if ($row['id'] == null) {
            break;
        }
        // var_dump($row);
?>

        <div class="borrowing-card d-flex flex-column justify-content-between">

            <div class="borrowing-card-header d-flex align-items-center justify-content-between">
                <p class="borrowing-id">#<?= $row['id'] ?></p>
                <div class="borrowing-status d-flex" id="borrowed">
                    <p>
                        <?= $row['status'] ?>
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