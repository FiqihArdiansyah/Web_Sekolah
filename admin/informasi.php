<?php include 'header.php' ?>

    <!--content-->
    <div class="content">

        <div class="container">
            <div class="box">


            <div class="box-header">
                Informasi
            </div>
                <div class="box-body">
                    <a href="tambah-informasi.php" class="text-hijau"><i class="fa fa-plus"></i> Tambah</a>
                    <?php
                    if(isset($_GET['succes'])){
                        echo "<div class='alert alert-sukses'>".$_GET['succes']."</div>";
                    }
                    ?>
                    <form action="">
                        <div class="input-group">
                            <input type="text" name="key" placeholder="Pencarian">
                            <button class="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Keterangan</th>
                                <th>gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;

                            $where = " WHERE 1=1 ";
                            if(isset($_GET['key'])){
                                $where .= " AND judul LIKE '%".addslashes($_GET['key'])."%' ";
                            }
                            $informasi = mysqli_query($conn, "SELECT * FROM informasi $where ORDER BY id");
                            if(mysqli_num_rows($informasi) >0){
                                while($p = mysqli_fetch_array($informasi)){
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $p['judul'] ?></td>
                                <td><?= substr ($p['keterangan'], 0, 50) ?></td>
                                <td><img src="../uploads/informasi/<?= $p['gambar']?>" width="50px"></td>
                                <td>
                                    <a href="edit-informasi.php?id=<?= $p['id']?>" title="Edit Data" class="text-orange"><i class="fa fa-edit"></i> </a>
                                    <a href="hapus.php?idinformasi=<?= $p['id']?>" onclick="return confirm('Yakin ingin menghapus data..?')" title="Hapus Data" class="text-red"><i class="fa fa-times"></i> </a>
                                </td>
                            </tr>
                            <?php }}else{ ?>
                                <tr>
                                    <td colspan="5">Data Tidak Ada</td>
                                </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>