<?php
    include 'onek.php';
    require_once 'nav.php';
?>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Selamat Datang</h1>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Admin
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-info">
                            Selamat datang, <?=$_SESSION['username']?>. Ini adalah aplikasi pengambilan metode keputusan dengan metode SMART (Simple Multi Attribute Rating Technique). <a href="alternatif.php" class="alert-link">masukkan data alternatif</a>
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