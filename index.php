<?php
require("controller/Kriteria.php");

$kriteria = Index("SELECT * FROM kriteria");
$alternatif = Index("SELECT * FROM alternatif");
$bobot = Index("SELECT * FROM perhitungan");
$maxkriteria = Index("SELECT SUM(bobot) AS Total FROM kriteria");
$test = [];
$varV = [];
$totalS = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK</title>
    <link rel="stylesheet" href="asset/css/bulma.min.css">
    <link rel="stylesheet" href="asset/css/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .navbar-item.has-text-white:hover {
            background-color: white;
            color: black !important;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar has-shadow" role="navigation" aria-label="main navigation" style="background-color: deepskyblue;">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="index.php?halaman=home">
                    <h3 class="title">Pemilihan Peptisida Untuk Padi</h3>
                </a>

                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="NavbarUtama">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="NavbarUtama" class="navbar-menu">
                <div class="navbar-end">
                    <a class="navbar-item has-text-white">Home</a>
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-success" href="login.php">
                                <strong>Login</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- AKHIR NAVBAR -->

    <!-- HALAMAN -->
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title animate__animated animate__zoomIn">
                    PEMILIHAN PEPTISIDA TERBAIK UNTUK PADI METODE WEIGHTED PRODUCT
                </h1>
                <h2 class="subtitle animate__animated animate__slideInUp">
                    Sistem Pendukung Keputusan Pemilihan Pestisida Terbaik Untuk Tanaman Padi Metode Weighted Product
                </h2>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half">
                    <figure class="image is-10by3">
                        <img src="asset/img/padi.jpg" style="height:300px;" alt="Tanaman Padi">
                    </figure>
                </div>
                <div class="column is-half">
                    <h3 class="title is-4">Tentang Padi</h3>
                    <p>Padi adalah tanaman budidaya yang menjadi sumber utama beras, makanan pokok bagi sebagian besar penduduk dunia. Tanaman padi tumbuh di daerah yang beriklim tropis dan subtropis, dan memerlukan banyak air untuk tumbuh dengan baik.</p>
                    <p>Proses budidaya padi melibatkan beberapa tahap, mulai dari penanaman, pemeliharaan, hingga panen. Padi yang sehat dan produktif sangat bergantung pada kondisi tanah, air, dan pengendalian hama serta penyakit.</p>
                </div>
            </div>
            <div class="columns">
                <div class="column is-half">
                    <h3 class="title is-4">Tentang Pestisida</h3>
                    <p>Pestisida adalah bahan atau campuran bahan yang digunakan untuk mencegah, menghancurkan, atau mengendalikan hama yang merugikan tanaman. Pestisida dapat berupa bahan kimia atau biologis yang dirancang untuk melindungi tanaman dari serangan hama, penyakit, dan gulma.</p>
                    <p>Pestisida yang efektif dapat membantu meningkatkan hasil panen dan kualitas tanaman. Namun, penggunaan pestisida harus dilakukan dengan hati-hati untuk menghindari dampak negatif terhadap lingkungan dan kesehatan manusia.</p>
                </div>
                <div class="column is-half">
                    <figure class="image is-10by3">
                        <img src="asset/img/pestisida.jpg" style="height:300px;" alt="Pestisida">
                    </figure>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="columns">
                    <div class="column">
                        <div>
                            <!-- Mencari Nilai W -->
                            <?php foreach ($kriteria as $tampildoang) : ?>
                                <? $tampildoang["bobot"] . "," ?>
                            <?php endforeach ?>

                            <!-- Perhitungan -->
                            <?php $b = 1 ?>
                            <?php foreach ($kriteria as $bagibobot) : ?>
                                <?php foreach ($maxkriteria as $TotalLah) : ?>
                                    <?php $b++ ?>
                                    <? round($bagibobot["bobot"] / $TotalLah["Total"], 3) ?>
                                <?php endforeach ?>
                            <?php endforeach ?>

                            <!-- Mencari Normalisasi Berdasarkan Perhitungan -->
                            <?php $c = 1 ?>
                            <?php foreach ($kriteria as $bagibobot) : ?>
                                <?php foreach ($maxkriteria as $TotalLah) : ?>
                                    <?php $c++ ?>
                                    <?php if ($bagibobot["status"] == "COST") : ?>
                                        <? round($bagibobot["bobot"] / $TotalLah["Total"], 3) * -1 ?>
                                    <?php else : ?>
                                        <? round($bagibobot["bobot"] / $TotalLah["Total"], 3) ?>
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
                                <?php $d++ ?>
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
                                <?php $f++ ?>
                                <? round($test[$g], 3) . round($totalS, 3) ?>
                                <? round(round($test[$g], 3) / round($totalS, 3), 3) ?>
                                <?php $g++ ?>
                            <?php endforeach ?>
                            
                            <hr>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <canvas id="rankingChart" width="400" height="200" style="margin-bottom: 20px;"></canvas>
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
                                </table>
                            </div>
                            <script>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- AKHIR HALAMAN -->

    <!-- JAVASCRIPT -->
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <script src="asset/js/main.js"></script>
</body>

</html>