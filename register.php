<?php
require "koneksi.php";
if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    $query = "INSERT INTO login (nama, username, password, role) VALUES ('$nama', '$username', '$password', '$role')";
    
    if(mysqli_query($conn, $query)){
        echo "<script>
        alert('Berhasil daftar');
        document.location.href = 'login.php';
        </script>";
        
    } else {
        echo "Registrasi gagal: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<!--www.codingflicks.com-->
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>login</title>
	
</head>
<style>
	* {
		box-sizing: border-box;
	}

	body {
		font-family: poppins;
		font-size: 16px;
		color: #fff;
	}

	.formulir-box {
		background-color: rgba(0, 0, 0, 0.5);
		margin: auto auto;
		padding: 40px;
		border-radius: 5px;
		box-shadow: 0 0 10px #000;
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		width: 500px;
		height: 500px;
	}

	.formulir-box:before {
		background-image: url("img/ok.jpg");
		width: 100%;
		height: 100%;
		background-size: cover;
		content: "";
		position: fixed;
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
		z-index: -1;
		display: block;

	}

	.formulir-box .header-text {
		font-size: 32px;
		font-weight: 600;
		padding-bottom: 30px;
		text-align: center;
	}

	.formulir-box input {
		margin: 10px 0px;
		border: none;
		padding: 10px;
		border-radius: 5px;
		width: 100%;
		font-size: 18px;
		font-family: poppins;
	}
	.formulir-box select {
		margin: 10px 0px;
		border: none;
		padding: 10px;
		border-radius: 5px;
		width: 100%;
		font-size: 18px;
		font-family: poppins;
	}
	.formulir-box input[type=checkbox] {
		display: none;
	}

	.formulir-box label {
		position: relative;
		margin-left: 5px;
		margin-right: 10px;
		top: 5px;
		display: inline-block;
		width: 20px;
		height: 20px;
		cursor: pointer;
	}

	.formulir-box label:before {
		content: "";
		display: inline-block;
		width: 20px;
		height: 20px;
		border-radius: 5px;
		position: absolute;
		left: 0;
		bottom: 1px;
		background-color: #ddd;
	}

	.formulir-box input[type=checkbox]:checked+label:before {
		content: "\2713";
		font-size: 20px;
		color: #000;
		text-align: center;
		line-height: 20px;
	}

	.formulir-box span {
		font-size: 14px;
	}

	.formulir-box button {
		background-color: #148F77 ;
		color: #fff;
		border: none;
		border-radius: 5px;
		cursor: pointer;
		width: 100%;
		font-size: 18px;
		padding: 10px;
		margin: 20px 0px;
	}

	span a {
		color: #BBB;
	}
	a {
		color: #ddd;
	}
	a:hover{
		color: #148F77;
	}
</style>

<body>
<form action="register.php" method="POST" class="formulir-box">
<div class="header-text">Skuy Daftar</div>
<input placeholder="masukan namamu" id="nama" name="nama" type="text" required>
		
		<input placeholder="masukan usernamemu" id="nama" name="username" type="text" required>
		<input placeholder="masukan pwmu" id="password" name="password" type="password" required>
	
						
						<select name="role">
					  
						  
						  <option>--Role--</option>
						  <option value="bph">badan pengurus harian</option>
						  <option value="anggota">anggota</option>
					  </select>
				


					  
		<button type="submit" name="submit">submit</button>
	
		<p align="center">anda sudah punya akun?</p>
		<p align="center"><a href="login.php">Kembali |</a> <a href="contact.html"> Daftar</a></p>
	
	</form>
	

</body>




</html>