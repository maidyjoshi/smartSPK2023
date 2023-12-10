<?php
include 'onek.php';
require_once 'nav.php';

$sqlNilai = "SELECT a.nama AS alternatif, k.nama_kriteria, n.nilai
             FROM tabel_nilai n
             INNER JOIN alternatif a ON n.alternatif_id = a.id_alt
             INNER JOIN kriteria k ON n.kriteria_id = k.id_kriteria";
$queryNilai = mysqli_query($dbcon, $sqlNilai);
$dataInput = array();

while ($row = mysqli_fetch_assoc($queryNilai)) {
    $alternatif = $row['alternatif'];
    $kriteria = $row['nama_kriteria'];
    $nilai = $row['nilai'];

    $dataInput[$alternatif][$kriteria] = $nilai;
}
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Penghitungan SPK SMART</h1>
            </div>
            <div class="col-lg-12">
                <h3 class="page-header">Nilai alternatif pada tiap kriteria</h1>
                <table class="table table-striped table-bordered table-hover" style="text-align: center;">
                    <thead style="text-align: center;">
                        <tr style="text-align: center;">
                            <th style="text-align: center;">Alternatif</th>
                            <?php
                            $sqlKriteria = "SELECT * FROM kriteria";
                            $queryKriteria = mysqli_query($dbcon, $sqlKriteria);
                            while ($kriteria = mysqli_fetch_array($queryKriteria)) {
                                echo '<th style="text-align: center;">' . $kriteria['nama_kriteria'] . '</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $n = 1;
                        foreach ($dataInput as $alternatif => $nilaiKriteria) {
                            echo '<tr>';
                            echo '<td>' . $alternatif . '</td>';
                            foreach ($nilaiKriteria as $nilai) {
                                echo '<td>' . $nilai . '</td>';
                            }
                            echo '</tr>';
                            $n++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12">
                <h3 class="page-header">Penentuan nilai min/max</h1>
                <table class="table table-striped table-bordered table-hover" style="text-align: center;">
                    <thead style="text-align: center;">
                        <tr style="text-align: center;">
                            <th style="text-align: center;">Min/Max</th>
                            <?php
                            $sqlKriteria = "SELECT * FROM kriteria";
                            $queryKriteria = mysqli_query($dbcon, $sqlKriteria);
                            $minMaxValues = array();

                            while ($kriteria = mysqli_fetch_array($queryKriteria)) {
                                echo '<th style="text-align: center;">' . $kriteria['nama_kriteria'] . '</th>';

                                $sqlMinMax = "SELECT MIN(nilai) as min, MAX(nilai) as max FROM tabel_nilai WHERE kriteria_id = " . $kriteria['id_kriteria'];
                                $queryMinMax = mysqli_query($dbcon, $sqlMinMax);
                                $minMax = mysqli_fetch_assoc($queryMinMax);
                                $minMaxValues[$kriteria['id_kriteria']] = $minMax;
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Min</td>
                            <?php
                            foreach ($minMaxValues as $minMax) {
                                echo '<td>' . $minMax['min'] . '</td>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>Max</td>
                            <?php
                            foreach ($minMaxValues as $minMax) {
                                echo '<td>' . $minMax['max'] . '</td>';
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12">
                <h3 class="page-header">Nilai utility</h3>
                <table class="table table-striped table-bordered table-hover" style="text-align: center;">
                    <thead style="text-align: center;">
                        <tr style="text-align: center;">
                            <th style="text-align: center;">Alternatif</th>
                            <?php
                            $sqlKriteria = "SELECT * FROM kriteria";
                            $queryKriteria = mysqli_query($dbcon, $sqlKriteria);

                            while ($kriteria = mysqli_fetch_array($queryKriteria)) {
                                echo '<th style="text-align: center;">' . $kriteria['nama_kriteria'] . '</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($dataInput as $alternatif => $nilaiKriteria) {
                            echo '<tr>';
                            echo '<td>' . $alternatif . '</td>';

                            foreach ($nilaiKriteria as $kriteria => $nilai) {
                                $sqlKriteriaId = "SELECT id_kriteria, jenis_kriteria FROM kriteria WHERE nama_kriteria = '$kriteria'";
                                $queryKriteriaId = mysqli_query($dbcon, $sqlKriteriaId);
                                $row = mysqli_fetch_assoc($queryKriteriaId);
                                $idKriteria = $row['id_kriteria'];
                                $jenisKriteria = $row['jenis_kriteria'];

                                $min = $minMaxValues[$idKriteria]['min'];
                                $max = $minMaxValues[$idKriteria]['max'];

                                if ($jenisKriteria === 'Benefit') {
                                    $utility = ($nilai - $min) / ($max - $min) * 1;
                                } else {
                                    $utility = ($max - $nilai) / ($max - $min) * 1;
                                }
                                $utility = number_format($utility, 3);
                                echo '<td>' . $utility . '</td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12">
                <h3 class="page-header">Pembobotan</h3>
                <table class="table table-striped table-bordered table-hover" style="text-align: center;">
                    <thead style="text-align: center;">
                        <tr style="text-align: center;">
                            <th style="text-align: center;">Alternatif</th>
                            <?php
                            $sqlKriteria = "SELECT * FROM kriteria";
                            $queryKriteria = mysqli_query($dbcon, $sqlKriteria);

                            while ($kriteria = mysqli_fetch_array($queryKriteria)) {
                                echo '<th style="text-align: center;">' . $kriteria['nama_kriteria'] . '</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($dataInput as $alternatif => $nilaiKriteria) {
                            echo '<tr>';
                            echo '<td>' . $alternatif . '</td>';

                            foreach ($nilaiKriteria as $kriteria => $nilai) {
                                $sqlKriteriaDetail = "SELECT id_kriteria, jenis_kriteria, bobot FROM kriteria WHERE nama_kriteria = '$kriteria'";
                                $queryKriteriaDetail = mysqli_query($dbcon, $sqlKriteriaDetail);
                                $row = mysqli_fetch_assoc($queryKriteriaDetail);
                                $idKriteria = $row['id_kriteria'];
                                $jenisKriteria = $row['jenis_kriteria'];
                                $bobot = $row['bobot'];

                                $min = $minMaxValues[$idKriteria]['min'];
                                $max = $minMaxValues[$idKriteria]['max'];

                                if ($jenisKriteria === 'Benefit') {
                                    $utility = ($nilai - $min) / ($max - $min) * 1;
                                } else {
                                    $utility = ($max - $nilai) / ($max - $min) * 1;
                                }
                                $utility = number_format($utility, 3);
                                $bobot_nilai = $utility * $bobot;
                                $bobot_nilai = number_format($bobot_nilai, 3);

                                echo '<td>' . $bobot_nilai . '</td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12">
            <h3 class="page-header">Nilai Akhir dan Perankingan</h3>
            <table class="table table-striped table-bordered table-hover" style="text-align: center;">
                <thead>
                    <tr>
                        <th style="text-align: center;">Ranking</th>
                        <th style="text-align: center;">Alternatif</th>
                        <th style="text-align: center;">Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nilaiAkhir = array();
                    foreach ($dataInput as $alternatif => $nilaiKriteria) {
                        $totalNilai = 0;

                        foreach ($nilaiKriteria as $kriteria => $nilai) {
                            $sqlKriteriaDetail = "SELECT id_kriteria, jenis_kriteria, bobot FROM kriteria WHERE nama_kriteria = '$kriteria'";
                            $queryKriteriaDetail = mysqli_query($dbcon, $sqlKriteriaDetail);
                            $row = mysqli_fetch_assoc($queryKriteriaDetail);
                            $idKriteria = $row['id_kriteria'];
                            $jenisKriteria = $row['jenis_kriteria'];
                            $bobot = $row['bobot'];

                            $min = $minMaxValues[$idKriteria]['min'];
                            $max = $minMaxValues[$idKriteria]['max'];

                            if ($jenisKriteria === 'Benefit') {
                                $utility = ($nilai - $min) / ($max - $min) * 1;
                            } else {
                                $utility = ($max - $nilai) / ($max - $min) * 1;
                            }
                            $utility = number_format($utility, 3);

                            $bobot_nilai = $utility * $bobot;
                            $bobot_nilai = number_format($bobot_nilai, 3);

                            $totalNilai += $bobot_nilai;
                        }

                        $nilaiAkhir[$alternatif] = $totalNilai;
                    }

                    arsort($nilaiAkhir);
                    $ranking = 1;
                    foreach ($nilaiAkhir as $alternatif => $totalNilai) {
                        echo '<tr>';
                        echo '<td>' . $ranking . '</td>';
                        echo '<td>' . $alternatif . '</td>';
                        echo '<td>' . number_format($totalNilai, 3) . '</td>';
                        echo '</tr>';
                        $ranking++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        </div>
        </div>
    </div>
</div>

<?php
require_once 'foot.php';
?>