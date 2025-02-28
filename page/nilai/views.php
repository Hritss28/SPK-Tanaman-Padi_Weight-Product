<?php
require("../controller/Kriteria.php");

$kriteria = Index("SELECT * FROM kriteria");
$alternatif = Index("SELECT * FROM alternatif");
$bobot = Index("SELECT * FROM perhitungan");
$maxkriteria = Index("SELECT SUM(bobot) AS Total FROM kriteria");
$test = [];
$varV = [];
$totalS = 0;
?>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="columns">
                <div class="column">
                    <div>
                        <div class="card-header">
                            <p class="card-header-title">Table penilaian</p>
                        </div>
                        <div class="card-content">
                            <div class="table-container">
                                <table class="table is-fullwidth">
                                    <thead class="has-background-success">
                                        <tr>
                                            <th class="has-text-white">No</th>
                                            <th class="has-text-white">Alternatif</th>
                                            <th class="has-text-white">Harga (Rp)</th>
                                            <th class="has-text-white">Ukuran Kemasan (ML)</th>
                                            <th class="has-text-white">Luas Cakup (m<sup>2</sup>)</th>
                                            <th class="has-text-white">Masa Kadaluarsa (Tahun)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $a = 1 ?>
                                        <?php foreach ($alternatif as $row) : ?>
                                            <tr>
                                                <th><?= $a++ ?></th>
                                                <td><?= $row["nm_les"] ?></td>
                                                <?php foreach ($bobot as $pembobot) : ?>
                                                    <?php if ($pembobot["id_les"] == $row["id_les"]) : ?>
                                                        <td><?= $pembobot["nilai"] ?></td>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Mencari Nilai W -->
                                <?php foreach ($kriteria as $tampildoang) : ?>
                                    <? $tampildoang["bobot"] . "," ?>
                                <?php endforeach ?>
                            
                            <!-- Pembobotan -->
                            <?php $b = 1 ?>
                            <?php foreach ($kriteria as $bagibobot) : ?>
                                <?php foreach ($maxkriteria as $TotalLah) : ?>
                                    <? $b++ ?>  
                                    <? round($bagibobot["bobot"] / $TotalLah["Total"], 3) ?>
                                <?php endforeach ?>
                            <?php endforeach ?>
                            
                            <!-- Mencari Normalisasi Berdasarkan Pembobotan -->
                            <?php $c = 1 ?>
                            <?php foreach ($kriteria as $bagibobot) : ?>
                                <?php foreach ($maxkriteria as $TotalLah) : ?>
                                    <? $c++ ?> 
                                    <?php if ($bagibobot["status"] == "COST") : ?>
                                        <? round($bagibobot["bobot"] / $TotalLah["Total"], 3) * -1 ?>
                                    <?php else : ?>
                                        <? round($bagibobot["bobot"] / $TotalLah["Total"], 3) ?></p>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endforeach ?>

                        <!-- Mencari Nilai Vector (S) -->
                        <?php $d = 1 ?>
                        <?php $e = 0 ?>
                        <?php foreach ($alternatif as $les) : ?>
                            <?php $idles = $les["id_les"] ?>
                            <?php $bobot = Index("SELECT * FROM perhitungan WHERE id_les = $idles"); ?>
                            <?php $test[$e] = 1 ?>
                            <? $d++ ?> 
                            <?php foreach ($bobot as $pembobot) : ?>
                                <?php $idbobot = $pembobot["id_kriteria"] ?>
                                <?php $kriteria = Index("SELECT * FROM kriteria WHERE id_kriteria = $idbobot"); ?>
                                <?php foreach ($kriteria as $bagibobot) : ?>
                                    <?php $maxkriteria = Index("SELECT SUM(bobot) AS Total FROM kriteria"); ?>
                                    <?php foreach ($maxkriteria as $TotalLah) : ?>
                                        <?php if ($bagibobot["status"] == "COST") : ?>
                                            <?php $test[$e] = $test[$e] * pow($pembobot["nilai"], round($bagibobot["bobot"] / $TotalLah["Total"], 3) * -1) ?>
                                        <?php else : ?>
                                            <?php $test[$e] = $test[$e] * pow($pembobot["nilai"], round($bagibobot["bobot"] / $TotalLah["Total"], 3)) ?>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endforeach ?>
                            <?php endforeach ?>
                            
                            <? round($test[$e], 3) ?>
                            <?php $totalS = $totalS + $test[$e] ?>
                            <?php $e++ ?>
                        <?php endforeach ?>

                        <!-- Mencari Nilai V (V) -->
                        <?php $f = 1 ?>
                        <?php $g = 0 ?>
                        <?php foreach ($test as $row) : ?>
                            <? $f++ ?> 
                            <? round($test[$g], 3) . round($totalS, 3) ?>
                            <? round(round($test[$g], 3) / round($totalS, 3), 3) ?>
                            <?php $g++ ?>
                        <?php endforeach ?>
                        
                        <h4 class="subtitle"><u>Perhitungan</u></h4>
                        <div class="table-container">
                            <table class="table is-fullwidth">
                                <thead class="has-background-success">
                                    <tr>
                                        <th class="has-text-white">No</th>
                                        <th class="has-text-white">Alternatif</th>
                                        <th class="has-text-white">Nilai</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $h = 1 ?>
                                    <?php $i = 0 ?>
                                    <?php $j = 0 ?>
                                    <?php foreach ($alternatif as $row) : ?>
                                        <?php $varV[$j] = 1 ?>
                                        <?php $varV[$j] = $test[$i] / $totalS ?>
                                        <tr>
                                            <th><?= $h++ ?></th>
                                            <td><?= $row["nm_les"] ?></td>
                                            <td><?= round(round($test[$i], 3) / round($totalS, 3), 3) ?></td>
                                        </tr>
                                        <?php $i++ ?>
                                        <?php $j++ ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        <hr>
                        <h4 class="subtitle"><u>Ranking</u></h4>
                        <div class="table-container">
                            <table class="table is-fullwidth">
                                <thead class="has-background-success">
                                    <tr>
                                        <th class="has-text-white">Ranking</th>
                                        <th class="has-text-white">Alternatif</th>
                                        <th class="has-text-white">Nilai</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                    $h = 1;
                                    $i = 0;
                                    $j = 0;
                                    $varV = array(); // Array untuk menyimpan nilai-nilai

                                    // Menyimpan nilai-nilai ke dalam array
                                    foreach ($alternatif as $row) {
                                        $varV[$j] = $test[$i] / $totalS;
                                        $i++;
                                        $j++;
                                    }

                                    // Mengurutkan array dari nilai yang paling besar
                                    arsort($varV);

                                    $i = 0;
                                    ?>

                                    <!-- Menampilkan nilai-nilai yang telah diurutkan -->
                                    <?php foreach ($varV as $key => $value) : ?>
                                        <tr>
                                            <th><?= ++$i ?></th>
                                            <td><?= $alternatif[$key]["nm_les"] ?></td>
                                            <td><?= round($value, 3) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Create a canvas element for the chart -->
<canvas id="rankingChart" width="400" height="200" style="margin-bottom: 20px;"></canvas>

<script>
    // Prepare data for the chart
    var ctx = document.getElementById('rankingChart').getContext('2d');
    var rankingChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php foreach ($varV as $key => $value) : ?>
                    '<?= $alternatif[$key]["nm_les"] ?>',
                <?php endforeach ?>
            ],
            datasets: [{
                label: 'Ranking',
                data: [
                    <?php foreach ($varV as $value) : ?>
                        <?= round($value, 3) ?>,
                    <?php endforeach ?>
                ],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>