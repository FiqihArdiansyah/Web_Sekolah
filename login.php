<?php
	session_start();
	include 'koneksi.php';
?>

<! DOCTYPE html>
	<!DOCTYPE html>
	<html>
		<head>
			<title>Halaman Login</title>
			<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	
		</head>
	<body>
	<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "> </script> 
		<!--page login-->
		<div class="page-login">
			
			<!-- box-->
			<div class="box box-login">

				<!-- box header -->
				<div class="box-header text-center" >
					Login
				</div>

				<!-- box body-->
				<div class="box-body">

					<?php
					if(isset($_GET['msg'])){
						echo "<div class='alert alert-eror'>".$_GET['msg']."</div>";
					}
					?>
				
					<!-- form login -->
					<form action="" method="POST">

					<div class="form-group">
						<label>Username</label>
						<input type="text" name="user" placeholder="Username" class="input-control">
					</div>

					<div class="form-group">
						<label>Password</label>
						<input type="password" name="pass" placeholder="Password" class="input-control">
					</div>
					<input type="submit" name="submit" value="login" class="btn" oneClick="showAlert" >
					</form>
					<?php
					if(isset($_POST['submit'])){
						
						$user = mysqli_real_escape_string($conn, $_POST['user']);
						$pass = mysqli_real_escape_string($conn, $_POST['pass']);

						$cek = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '".$user."' ");
						if(mysqli_num_rows($cek) > 0){

							$d = mysqli_fetch_object($cek);
							if(md5($pass) == $d->password){

								$_SESSION['status_login'] 	= true;
								$_SESSION['uid']			=$d->id;
								$_SESSION['uname']			=$d->nama;
								$_SESSION['ulevel']			=$d->level;
								echo "<script type='text/javascript'>
								setTimeout(function showAlert () { 
								
								swal('($d->level) ', 'Login berhasil', {
								icon : 'success',
								buttons: {        			
								confirm: {
								className : 'btn btn-success'
								}
								},
								});    
								},10);  
								window.setTimeout(function(){ 
								window.location.replace('admin/index.php');
								} ,3000);</script>";
							}else{
								echo '<div class="alert alert-eror">Password salah</div>';
							}
						}else{
							echo '<div class="alert alert-eror">Username tidak ditemukan</div>';
						}

					}
					?>
				</div>

				<!-- box footer -->
				<div class="box-footer text-center">
						<a href="index.php">Halaman Utama</a>
				</div>
				
			</div>
		</div>
	</body>
	</html>