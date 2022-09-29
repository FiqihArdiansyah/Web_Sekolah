<?php
include '../koneksi.php';
$identitas = mysqli_query($conn, "SELECT * FROM pengaturan ORDER BY id DESC LIMIT 1");
$d =  mysqli_fetch_object($identitas);
?>
 <!--footer-->
 <div class="footer">
        <div class="container text-center">
            Copyright &copy; 2022 <?= $d->nama ?>
            <p>
              Designed by <a href="https:wa.me//6285963090921">Fiqih Ardiansyah</a>
            </p>
        </div>
    </div>
</body>
</html>