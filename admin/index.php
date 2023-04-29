
<?php
session_start();

// Periksa apakah pengguna telah login sebagai admin
if ($_SESSION['role'] !== 'admin') {
  header('Location: ../login.php');
  exit();
}

if (isset($_GET['logout'])) {
  session_destroy();
  header('Location: ../login.php');
  exit();
}

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>halaman admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	        </button>
        </div>
	  		<div class="img bg-wrap text-center py-4" style="background-image: url(images/bg_1.jpg);">
	  			<div class="user-logo">
	  				<div class="img" style="background-image: url(images/admin.png);"></div>
	  				<h3 id=nama_ni></h3>
	  			</div>
	  		</div>
        <ul class="list-unstyled components mb-5">
          <li class="active">
            <a href="index.php"><span class="fa fa-home mr-3"></span> Home</a>
          </li>
          <li>
          <a href="admin.php"><span class="fa fa-table mr-3"></span>Data Admin</a>
          </li>
          <li>
          <a href="login.php"><span class="fa fa-table mr-3"></span>Data Login</a>
          </li>
          <li>
          <a href="data.php"><span class="fa fa-table mr-3"></span>Data RAB</a>
          </li>
          <li>
          <a href="crud.php"><span class="fa fa-table mr-3"></span>Data kegiatan</a>
          </li>
          <li>
          <a href="?logout=true"><span class="fa fa-sign-out mr-3"></span> Sign Out</a>
          </li>
        </ul>

    	</nav>
 


        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4">hallo selamat datang <span><?php echo $_SESSION['nama']; ?><span> di halaman admin</h2>

<ul>


    
    

	</ul>
        
      </div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/utama.js"></script>
  </body>
</html>