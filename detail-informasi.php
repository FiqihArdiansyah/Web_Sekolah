<?php include 'header.php'; ?>
 <div class="section">
    <div class="container">

    <?php
            $informasi   = mysqli_query($conn, "SELECT * FROM informasi LEFT JOIN pengguna ON pengguna.id = informasi.created_by where informasi.id = '".$_GET['id']."' ");

                if(mysqli_num_rows($informasi) == 0){
                    echo "<script>window.location='index.php'</script>";
                }
            $p          = mysqli_fetch_object($informasi);
    ?>
        <h3 class="text-center"><?= $p->judul?></h3>
        <small>Dibuat Pada <?= date('d/m/y', strtotime($p-> created_at)) ?>, Oleh <?= $p->nama?></small>
        <img src="uploads/informasi/<?= $p->gambar?>" width="100%" class="image" style="margin-top: 5px;">
        <?= $p->keterangan?>
    </div>
 </div>
<?php include 'footer.php'; ?>