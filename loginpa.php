<?php
session_start();
require "koneksi.php";

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    if ($role == 'admin') {
        $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $username;
            $row = mysqli_fetch_assoc($result);
            $_SESSION['nama'] = $row['nama'];
            header("location: admin/index.php");
        } else {
            echo "<script>
                alert('Username dan password salah.');
            </script>";
        }
    } else if ($role == 'bph') {
        $query = "SELECT * FROM login WHERE username='$username' AND password='$password' AND role='$role'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $username;
			$row = mysqli_fetch_assoc($result);
            $_SESSION['nama'] = $row['nama'];
            header("location: bph/index.php");
        } else {
            echo "<script>
                alert('Username dan password salah.');
            </script>";
        }
    } else if ($role == 'anggota') {
        $query = "SELECT * FROM login WHERE username='$username' AND password='$password' AND role='$role'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $username;
			$row = mysqli_fetch_assoc($result);
            $_SESSION['nama'] = $row['nama'];
            header("location: staff/index.php");
        } else {
            echo "<script>
                alert('Username dan password salah.');
            </script>";
        }
    } else {
        echo "Role tidak valid!";
    }
}
mysqli_close($conn);
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
<form action="login.php" method="POST" class="formulir-box">
<div class="header-text">Skuy Login</div>
		
		<input placeholder="masukan usernamemu" id="nama" name="username" type="text" required>
		<input placeholder="masukan pwmu" id="password" name="password" type="password" required>
	
						
						<select name="role">
					  
						  
						  <option>--Role--</option>
						  <option value="admin">admin</option>
						  <option value="bph">badan pengurus harian</option>
						  <option value="anggota">anggota</option>
					  </select>
				


					  
		<button type="submit">login</button>
	
		<p align="center">anda belum punya akun?</p>
		<p align="center"><a href="index.html">Kembali |</a> <a href="register.php"> Daftar</a></p>
	
	</form>
	

</body>




</html>