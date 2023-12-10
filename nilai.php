<?php
include 'onek.php';
require_once 'nav.php';

function simpanNilai($alternatifID, $kriteria) {
    global $dbcon;
    $sql = "INSERT INTO tabel_nilai (alternatif_id, kriteria_id, nilai) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($dbcon, $sql);

    foreach ($kriteria as $kriteriaID => $nilai) {
        mysqli_stmt_bind_param($stmt, "iii", $alternatifID, $kriteriaID, $nilai);
        mysqli_stmt_execute($stmt);
    }

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>alert('Data berhasil disimpan')</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data')</script>";
    }
    mysqli_stmt_close($stmt);
}

if (isset($_POST['submit'])) {
    $alternatifID = $_POST['alternatif'];
    $kriteria = $_POST['kriteria'];

    if (!empty($alternatifID) && is_numeric($alternatifID)) {
        $validKriteria = true;
        foreach ($kriteria as $nilai) {
            if (!is_numeric($nilai)) {
                $validKriteria = false;
                break;
            }
        }

        if ($validKriteria) {
            simpanNilai($alternatifID, $kriteria);
        } else {
            echo "<script>alert('Input nilai kriteria harus berupa angka')</script>";
        }
    } else {
        echo "<script>alert('Pilih alternatif terlebih dahulu')</script>";
    }
}
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Input Nilai Alternatif</h1>
            </div>
            <form role="form" method="POST" action="">
                <div class="form-group">
                    <label for="alternatif">Alternatif:</label>
                    <select required name="alternatif" class="form-control">
                        <option value="">Pilih Alternatif</option>
                        <?php
                        $sqlAlternatif = "SELECT * FROM alternatif";
                        $queryAlternatif = mysqli_query($dbcon, $sqlAlternatif);

                        while ($alternatif = mysqli_fetch_array($queryAlternatif)) {
                            echo '<option value="' . $alternatif['id_alt'] . '">' . $alternatif['nama'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <?php
                $sqlKriteria = "SELECT * FROM kriteria";
                $queryKriteria = mysqli_query($dbcon, $sqlKriteria);

                while ($kriteria = mysqli_fetch_array($queryKriteria)) {
                    echo '<div class="form-group">';
                    echo '<label for="kriteria_' . $kriteria['id_kriteria'] . '">' . $kriteria['nama_kriteria'] . ':</label>';
                    echo '<input required type="text" name="kriteria[' . $kriteria['id_kriteria'] . ']" class="form-control" placeholder="Nilai Kriteria">';
                    echo '</div>';
                }
                ?>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary form-control" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'foot.php';
?>