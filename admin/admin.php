<?php
session_start();
require "../koneksi.php";

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
// tambah data
if(isset($_POST['tambah'])){
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telp = $_POST['telp'];
    
    // cek apakah data sudah ada
    $query = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
		echo "<script>
		alert('username sudah terdaftar');
		document.location.href = 'admin.php';
		</script>";
    } else {
        $sql = "INSERT INTO admin (nama, username, password, no_telp) VALUES ('$nama', '$username', '$password', '$telp')";
        if(mysqli_query($conn, $sql)){
			echo "<script>
			alert('berhasil menambahkan data');
			document.location.href = 'admin.php';
			</script>";
        } else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

// hapus data
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    $sql = "DELETE FROM admin WHERE id_admin=$id";
    if(mysqli_query($conn, $sql)){
      echo "<script>
      alert('berhasil menghapus data');
      document.location.href = 'admin.php';
      </script>";
    } else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// update data
if(isset($_POST['update'])){
    $id = $_POST['id_admin'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telp = $_POST['telp'];

    // cek apakah username sudah terdaftar
    $query = "SELECT * FROM admin WHERE username='$username' AND id_admin!='$id'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
      echo "<script>
      alert('username sudah terdaftar');
      document.location.href = 'admin.php';
      </script>";
    } else {
        $sql = "UPDATE admin SET nama='$nama', username='$username', password='$password', no_telp='$telp' WHERE id_admin=$id";
        if(mysqli_query($conn, $sql)){
          echo "<script>
          alert('berhasil mengubah data');
          document.location.href = 'admin.php';
          </script>";
        } else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

$search = isset($_POST['search']) ? $_POST['search'] : '';
$sortby = isset($_GET['sortby']) ? $_GET['sortby'] : 'id_admin';
$sorttype = isset($_GET['sorttype']) ? $_GET['sorttype'] : 'asc';


$query = "SELECT * FROM admin WHERE nama LIKE '%$search%' OR username LIKE '%$search%' OR password LIKE '%$search%' ORDER BY $sortby $sorttype";
$result = mysqli_query($conn, $query);


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
  <style>
	.form-popup {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.5);
}

.form-popup-content {
  background-color: #fefefe;
  margin: 2% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.form-popup-close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.form-popup-close:hover,
.form-popup-close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

    .box {
	color: #272164;
}
.box:after {
	content: '';
	display: block;
	clear: both;
}
    .box .col-4 h4 {
	margin:20px 0;
}
.box .col-4 {
		width:100%;
		float: none;
		margin-bottom: 20px;
	}
    .box .col-4 {
	width:25%;
	padding:20px;
	box-sizing: border-box;
	text-align: center;
	float: left;
}
    .contain {
	width:80%;
	margin:0 auto;
}
.contain:after {
	content:'';
	display: block;
	clear: both;
}
	.servis {
	padding-bottom: 100px;
}
     .kontainer{
	max-width: 1000px;
	width: 100%;
	background-color: #fff;
	padding: 25px 30px;
	border-radius: 5px;
	box-shadow: 0 5px 10px rgba(0,0,0,0.15);
  }
  .kontainer .title{
	font-size: 25px;
	font-weight: 500;
	position: relative;
  }
  .kontainer .title::before{
	content: "";
	position: absolute;
	left: 0;
	bottom: 0;
	height: 3px;
	width: 30px;
	border-radius: 5px;
	background: linear-gradient(135deg, #71b7e6, #9b59b6);
  }

  .kontener{
	max-width: 1000px;
	width: 100%;
	background-color: #fff;
	padding: 25px 30px;
	border-radius: 5px;
	box-shadow: 0 5px 10px rgba(0,0,0,0.15);
  }
  .kontener p {
	background-color: white;
    padding: 20px 20px;
    border-radius: 12px;
    box-shadow: 0 1px 20px rgb(0 0 0 / 20%);
    width: 350px;
    margin: 15px auto;
}
.kontener p:hover{
    background-color: #18d3ad;
}
.kontener .oke{
	width: 200px;
	height: 200px;
	border-radius: 50%;


	margin-left: 40%;
}
.animasi-teks {
	font-size: 29px;
	width: 100%;
	white-space:nowrap;
	overflow:hidden;
	-webkit-animation: typing 5s steps(70, end);
	animation: animasi-ketik 5s steps(70, end);
  }
  
  @keyframes animasi-ketik{
	from { width: 0; }
  }
  
  @-webkit-keyframes animasi-ketik{
	from { width: 0; }
  }

  .content form .user-details{
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	margin: 20px 0 12px 0;
  }
  form .user-details .input-box{
	margin-bottom: 15px;
	width: calc(100% / 2 - 20px);
  }
  form .input-box span.details{
	display: block;
	font-weight: 500;
	margin-bottom: 5px;
  }
  .user-details .input-box input{
	height: 45px;
	width: 100%;
	outline: none;
	font-size: 16px;
	border-radius: 5px;
	padding-left: 15px;
	border: 1px solid #ccc;
	border-bottom-width: 2px;
	transition: all 0.3s ease;
  }
  .kombo{
	height: 45px;
	width: 100%;
	outline: none;
	font-size: 16px;
	border-radius: 5px;
	padding-left: 15px;
	border: 1px solid #ccc;
	border-bottom-width: 2px;
	transition: all 0.3s ease;
  }

  .teks{
	height: 100px;
	width: 100%;
	outline: none;
	font-size: 16px;
	border-radius: 5px;

	border: 1px solid #ccc;
	border-bottom-width: 2px;
	transition: all 0.3s ease;
  }

  .user-details .input-box input:focus,
  .user-details .input-box input:valid{
	border-color: #9b59b6;
  }
   form .gender-details .gender-title{
	font-size: 20px;
	font-weight: 500;
   }
   form .hobi{
	font-size: 20px;
	font-weight: 500;
   }
   form .category{
	 display: flex;
	 width: 80%;
	 margin: 14px 0 ;
	 padding-right: 38rem;
	 justify-content: space-between;
   }
   form .category label{
	 display: flex;
	 align-items: center;
	 cursor: pointer;
   }
   form .category label .dot{
	height: 18px;
	width: 18px;
	border-radius: 50%;
	margin-right: 10px;
	background: #d9d9d9;
	border: 5px solid transparent;
	transition: all 0.3s ease;
  }
   #dot-1:checked ~ .category label .one,
   #dot-2:checked ~ .category label .two,
   #dot-3:checked ~ .category label .three{
	 background: #148F77;
	 border-color: #d9d9d9;
   }
   form input[type="radio"]{
	 display: none;
   }
   form .button{
	 height: 45px;
	 margin: 35px 0
   }
   form .button input{
	 height: 100%;
	 width: 100%;
	 border-radius: 5px;
	 border: none;
	 color: #fff;
	 font-size: 18px;
	 font-weight: 500;
	 letter-spacing: 1px;
	 cursor: pointer;
	 transition: all 0.3s ease;
	 background: linear-gradient(135deg, #0099ff, #272164);
   }
   form .button input:hover{
	/* transform: scale(0.99); */
	background: linear-gradient(-135deg, #0099ff, #272164);
	}
   @media(max-width: 584px){
   .kontainer{
	max-width: 100%;
  }
  form .user-details .input-box{
	  margin-bottom: 15px;
	  width: 100%;
	}
	form .category{
	  width: 100%;
	}
	.content form .user-details{
	  max-height: 300px;
	  overflow-y: scroll;
	}
	.user-details::-webkit-scrollbar{
	  width: 5px;
	}
	}
	@media(max-width: 459px){
	.kontainer .content .category{
	  flex-direction: column;
	}
}
</style>
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
          <a href="pendaftar.php"><span class="fa fa-table mr-3"></span>data pendaftar</a>
          </li>
          <li>
          <a href="pdh.php"><span class="fa fa-table mr-3"></span>pdh</a>
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
	  <div class="kontainer">
			<div class="content">
				
				
        <h2 class="mb-4">data admin</h2>

	
		<div id="form-popup" class="form-popup">
  <div class="form-popup-content">
    <span id="form-popup-close" class="form-popup-close">&times;</span>
	
	<form method="post">
	<h1 align="center">tambah admin</h1>

				  <div class="user-details">
					<div class="input-box">
					  <span class="details">nama</span>
					  <input type="text" id="nama-proyek" name="nama" placeholder="masukan nama">
					</div>
					
					
          <div class="input-box">
					  <span class="details">password</span>
					  <input type="text" id="jumlah-orang" name="password" placeholder="masukan password">
					</div>
					<div class="input-box">
					  <span class="details">username</span>
					  <input type="text" id="jumlah-pengeluaran" name="username" placeholder="masukan username">
					</div>
          <div class="input-box">
					  <span class="details">no telp</span>
					  <input type="text" id="harga-satuan" name="telp" placeholder="masukan no telp">
					</div>
					
				  </div>
				  <br>
			
				
				  <div class="button">
					<input type="submit" value="tambah" name="tambah">
				  </div>
				</form>

        
      </div>
		</div>




		<button id="open-form-btn">tambah</button>

		<br>
		<br>
		<div style="display: flex; justify-content: space-between;">
    <form method="POST" action="" style="margin-right: 10px;">
        <input type="text" name="search" value="<?php echo $search; ?>" placeholder="Search">
        <button type="submit">Search</button>
    </form>
    
    <form action="" method="get" style="margin-left: 10px;">
        <label for="sortby">Urutkan berdasarkan:</label>
        <select name="sortby" id="sortby">
            <option value="nama" <?php if($sortby == 'nama') echo 'selected'; ?>>Nama</option>
            <option value="username" <?php if($sortby == 'username') echo 'selected'; ?>>username</option>
            <option value="password" <?php if($sortby == 'password') echo 'selected'; ?>>password</option>
            <option value="no_telp" <?php if($sortby == 'no_telp') echo 'selected'; ?>>no telp</option>
        </select>
        <select name="sorttype" id="sorttype">
            <option value="asc" <?php if($sorttype == 'asc') echo 'selected'; ?>>Ascending</option>
            <option value="desc" <?php if($sorttype == 'desc') echo 'selected'; ?>>Descending</option>
        </select>
        <button type="submit" name="sort">Urutkan</button>
    </form>
</div>

		<table border="1" cellpadding="5" cellspacing="0" align="center" width="100%">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Password</th>
        <th>No. Telp</th>
        <th>aksi</th>

    </tr>
    <?php
                                       
                                        //membuat variabel angka
                                        $no = 1;
            
                                        //mengambil data dari tabel barang
                                      
                                        //melooping(perulangan) dengan menggunakan while
                                        while($data= mysqli_fetch_array($result)){
                                    ?>
                                    <tr>
            
                                        <!-- menampilkan data dengan menggunakan array  -->
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td><?php echo $data['username']; ?></td>
                                        <td><?php echo $data['password']; ?></td>
                                        <td><?php echo $data['no_telp']; ?></td>
                                        <td>
            
                                            <!-- membuat tombol dengan ukuran small berwarna biru  -->
                                            <!-- data-target setiap modal harus berbeda, karena akan menampilkan data yang berbeda pula
                                            caranya membedakannya, gunakan id_barang sebagai pembeda data-target di setiap modal -->
                                            <a href="" class="btn btn-sm btn-info" data-toggle="modal"
                                                data-target="#modal<?php echo $data['id_admin']; ?>">Edit</a>
                                                <a href="?hapus=<?php echo $data['id_admin']; ?>" class="btn btn-sm btn-danger"
                onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
            
                                            <!-- untuk melihat bentuk-bentuk modal kalian bisa mengunjungi laman bootstrap dan cari modal di kotak pencariannya -->
                                            <!-- id setiap modal juga harus berbeda, cara membedakannya dengan menggunakan id_barang -->
                                            <div class="modal fade" id="modal<?php echo $data['id_admin']; ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <!-- di dalam modal-body terdapat 4 form input yang berisi data.
                        data-data tersebut ditampilkan sama seperti menampilkan data pada tabel. -->
                                                        <div class="modal-body">
                                                        <form method="post">
	<h1 align="center">tambah admin</h1>

				  <div class="user-details">
					<div class="input-box">
<input type="hidden" id="id" name="id_admin" value="<?php echo $data['id_admin']; ?>">

					  <span class="details">nama</span>

					  <input type="text" id="nm" name="nama" placeholder="masukan nama" value="<?php echo $data['nama']; ?>"> >
					</div>
					
					
          <div class="input-box">
					  <span class="details">password</span>
					  <input type="text" id="pw" name="password" placeholder="masukan password" value="<?php echo $data['password']; ?>">>
					</div>
					<div class="input-box">
					  <span class="details">username</span>
					  <input type="text" id="us" name="username" placeholder="masukan username" value="<?php echo $data['username']; ?>">>
					</div>
          <div class="input-box">
					  <span class="details">no telp</span>
					  <input type="text" id="no" name="telp" placeholder="masukan no telp" value="<?php echo $data['no_telp']; ?>">>
					</div>
					
				  </div>
				  <br>
			
				
				  <div class="button">
					<input type="submit" value="ubah" name="update">
				  </div>
				</form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
</table>


<script>
        
        $('#modaledit').on('show.bs.modal', function (event) {
            // event.relatedtarget menampilkan elemen mana yang digunakan saat diklik.
            var button              = $(event.relatedTarget)

            // data-data yang disimpan pada tombol edit dimasukkan ke dalam variabelnya masing-masing 
            var nama_barang         = button.data('nama')
            var deskripsi_barang    = button.data('username')
            var jenis_barang        = button.data('password')
            var harga_barang        = button.data('no_telp')
            var modal = $(this)

            //variabel di atas dimasukkan ke dalam element yang sesuai dengan idnya masing-masing
            modal.find('#nm').val(nama_barang)
            modal.find('#us').val(deskripsi_barang)
            modal.find('#pw').val(jenis_barang)
            modal.find('#no').val(harga_barang)
        })
    </script>

<script>
	// Ambil tombol untuk membuka form pop up
var openFormBtn = document.getElementById("open-form-btn");

// Ambil elemen form pop up
var formPopup = document.getElementById("form-popup");

// Ambil tombol untuk menutup form pop up
var closeFormBtn = document.getElementById("form-popup-close");

// Fungsi untuk membuka form pop up
function openForm() {
  formPopup.style.display = "block";
}

// Fungsi untuk menutup form pop up
function closeForm() {
  formPopup.style.display = "none";
}

// Tambahkan event listener untuk tombol membuka form pop up
openFormBtn.addEventListener("click", openForm);

// Tambahkan event listener untuk tombol menutup form pop up
closeFormBtn.addEventListener("click", closeForm);
</script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/utama.js"></script>
  </body>
</html>