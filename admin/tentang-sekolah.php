<?php include 'header.php' ?>
    <!--content-->
    <div class="content">

        <div class="container">
            <div class="box">


            <div class="box-header">
                Tentang Sekolah
            </div>
                <div class="box-body">
                <?php
                    if(isset($_GET['succes'])){
                        echo "<div class='alert alert-sukses'>".$_GET['succes']."</div>";
                    }
                    ?>
                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Tentang Sekolah</label>
                        <textarea name="tentang" class="input-control" placeholder="Tentang Sekolah" id="keterangan"><?= $d->tentang_sekolah ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Foto Sekolah</label>
                        <img src="../uploads/identitas/<?= $d->foto_sekolah?>" width="150px" class="image">
                        <input type="hidden" name="foto_lama" value="<?= $d->foto_sekolah?>">
                        <input type="file" name="foto_baru" class="input-control" >
                    </div>

                    <input type="submit" name="submit" value="Simpan Perubahan" class="btn btn-blue">

                   </form>

                   <?php 
                   
                   if(isset($_POST['submit'])){

                    $tentang = addslashes($_POST['tentang']);
                    $currdate = date ('Y-m-d H:i:s');
                    
                    // menampung dan falidasi data foto sekolah
                    if($_FILES['foto_baru']['name'] != ''){
                        // echo 'user ganti gambar';

                        $filename = $_FILES['foto_baru']['name'];
                        $tmpname = $_FILES['foto_baru']['tmp_name'];
                        $filesize = $_FILES['foto_baru']['size'];
    
                        $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
                        $rename = 'sekolah'.time().'.'.$formatfile;
    
                        $allowedtype = array('png','jpg', 'jpeg', 'gif');

                        if(!in_array($formatfile, $allowedtype)){
                            echo '<div class="alert alert-eror">Format file foto sekolah tidak diizinkan</div>';

                            return false;
                        }elseif($filesize > 1000000){
                            echo '<div class="alert alert-eror">Ukuran file logo sekolah tidak boleh lebih 1 MB</div>';
                            return false;
                        }else{

                        //kodingan jika user mengubah gambar maka hapus gambar sebelumnya
                            if(file_exists("../uploads/identitas/".$_POST['foto_lama'])){
                                unlink("../uploads/identitas/".$_POST['foto_lama']);
                            }

                            move_uploaded_file($tmpname, "../uploads/identitas/".$rename);
                        }

                    }else{

                        $rename = $_POST['foto_lama'];
                    }

                    $update = mysqli_query($conn, "UPDATE pengaturan SET
                        tentang_sekolah = '".$tentang."',
                        foto_sekolah = '".$rename."',
                        updated_at = '".$currdate."'
                        WHERE id = '".$d->id."'
                    ");

                    if($update){
                        echo "<script>window.location='tentang-sekolah.php?succes=Edit data berhasil'</script>";
                    }else{
                        echo 'Gagal Edit'.mysqli_error($conn);
                    }
                   }

                   ?>

                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>