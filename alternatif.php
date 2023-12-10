<?php
    include 'onek.php';
    require_once 'nav.php';
?>
            
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Alternatif</h1>
                <a href="nilai.php">masukkan nilai alternatif</a>
            </div>
            <div class="col-lg-8">
                <form role="form" action="" method="POST">
                <div class="form-group">
                    <input type="text" required name="nama" class="form-control" placeholder="NAMA">
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                    <?php
                        include 'onek.php';
                        require_once 'nav.php';

                        if (isset($_POST['submit'])) {
                            $nama = $_POST['nama'];
                            $sql = "INSERT INTO alternatif (nama) VALUES ('$nama')";
                            $query = mysqli_query($dbcon, $sql);

                            if ($query) {
                                echo "<script>alert('Berhasil memasukkan data Alternatif')</script>";
                            } else {
                                 echo "<script>alert('Gagal Memasukkan data')</script>";
                            }
                        }
                    ?>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Alternatif
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql ="SELECT * FROM alternatif";
                                            $query = mysqli_query($dbcon, $sql);
                                            $n = 1 ;
                                            while ($alternatif=mysqli_fetch_array($query)) {
                                                        
                                        ?>
                                        <tr>
                                            <td><?=$n?></td>
                                            <td><?=$alternatif['nama']?></td>
                                            <td><a onclick="return confirm('Apakah yakin menghapus ?')" href="hapus_alt.php?id_alt=<?=$alternatif['id_alt'];?>">hapus</a></td>
                                        <?php
                                            $n++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    require_once 'foot.php';
 ?>