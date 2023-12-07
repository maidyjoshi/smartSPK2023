<?php
    include 'onek.php';
    require_once 'nav.php';
?>
            
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Data Kriteria</h1>
                            <a href="alternatif.php">masukkan data alternatif</a> atau <a href="spk.php">proses perhitungan</a>
                        </div>

                        <div class="col-lg-8">
                        <form role="form" action="" method="POST" class="text-center">
                            <div class="form-group">
                                <input type="text" required name="kriteria" class="form-control" placeholder="NAMA KRITERIA">
                            </div>
                            <div class="form-group">
                                <input type="text" required name="bobot" class="form-control" placeholder="BOBOT">
                            </div>
                            <div class="form-group">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-secondary active">
                                        <input type="radio" required name="benefit_or_cost" value="Benefit" autocomplete="off"> Benefit
                                    </label>
                                    <label class="btn btn-secondary">
                                        <input type="radio" required name="benefit_or_cost" value="Cost" autocomplete="off"> Cost
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>



                            <!-- insert kriteria -->
                            <?php
                                include 'onek.php';
                                require_once 'nav.php';

                                if (isset($_POST['submit'])) {
                                    $kriteria = $_POST['kriteria'];
                                    $bobot = $_POST['bobot'];
                                    $jenis_kriteria = $_POST['benefit_or_cost']; // Added line to get the selected value from the radio buttons

                                    $sql = "INSERT INTO kriteria (nama_kriteria, bobot, jenis_kriteria) VALUES ('$kriteria','$bobot','$jenis_kriteria')";
                                    $query = mysqli_query($dbcon, $sql);

                                    if ($query) {
                                        echo "<script>alert('Berhasil memasukkan data Kriteria')</script>";
                                    } else {
                                        echo "<script>alert('Gagal Memasukkan data')</script>";
                                    }
                                } else {
                                }

                            ?>
                            <!-- end kriteria -->


                        </div>
                        
                        <!-- Tabel Data -->
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Data Kriteria
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Nama Kriteria</th>
                                                    <th>Bobot Kriteria</th>
                                                    <th>Jenis Kriteria</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- mengeluarkan data siswa dari database -->
                                                <?php
                                                   
                                                   $sqljumlah ="SELECT SUM(bobot) FROM kriteria";
                                                   $queryjumlah= mysqli_query($dbcon,$sqljumlah);
                                                   $jumlah0=mysqli_fetch_array($queryjumlah);
                                                   $jumlah = $jumlah0[0];
                                                   


                                                   $sql ="SELECT * FROM kriteria";
                                                   $query = mysqli_query($dbcon, $sql);
                                                   $n = 1 ;
                                                   while ($barisbobot=mysqli_fetch_assoc($query)) {
                                                        
                                                ?>
                                                <tr>
                                                    <td><?="C" . $n?></td>
                                                    <td><?=$barisbobot['nama_kriteria']?></td>
                                                    <td class="text-right"><?=$barisbobot['bobot']?></td>
                                                    <td>
                                                        <?php
                                                        if ($barisbobot['jenis_kriteria'] == 'Benefit') {
                                                            echo 'Benefit';
                                                        } elseif ($barisbobot['jenis_kriteria'] == 'Cost') {
                                                            echo 'Cost';
                                                        } else {
                                                            echo 'Unknown';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="hapus_kriteria.php?id_kriteria=<?=$barisbobot['id_kriteria']?>">hapus</a> |
                                                        <!-- Replace "id" with the actual primary key column name -->
                                                    </td>
                                                </tr>

                                                <?php
                                                    $n++;
                                                    }
                                                ?>
                                                 <tr class="inverse">
                                                    <td colspan="2">Total</td>
                                                    <td class="text-right"><?=$jumlah?></td>
                                                    <td class="text-right"> </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Tabel Data -->

                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

<?php 
    require_once 'foot.php';
 ?>