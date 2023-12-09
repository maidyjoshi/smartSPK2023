<?php
include 'onek.php';
require_once 'nav.php';

// Ambil data dari database atau sumber data lainnya jika diperlukan
// ...
$dataInput = array(); // Gantilah dengan cara mengambil data yang sesuai

?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Hasil SPK</h1>
            </div>
            <div class="col-lg-12">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            <?php
                            // Menampilkan nama kriteria sebagai header tabel
                            $sqlKriteria = "SELECT * FROM kriteria";
                            $queryKriteria = mysqli_query($dbcon, $sqlKriteria);

                            while ($kriteria = mysqli_fetch_array($queryKriteria)) {
                                echo '<th>' . $kriteria['nama_kriteria'] . '</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $n = 1;

                        // Menampilkan data alternatif dan nilai kriteria
                        foreach ($dataInput as $alternatif) {
                            echo '<tr>';
                            echo '<td>' . $n . '</td>';
                            echo '<td>' . $alternatif['alternatif'] . '</td>';

                            // Menampilkan nilai kriteria untuk setiap alternatif
                            foreach ($alternatif['kriteria'] as $nilaiKriteria) {
                                echo '<td>' . $nilaiKriteria . '</td>';
                            }

                            echo '</tr>';
                            $n++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php
require_once 'foot.php';
?>
