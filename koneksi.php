<?php
    $conn = mysqli_connect("localhost", "root", "", "eksternal");
    if (!$conn){
        die("Gagal Terhubung ". mysqli_connect_error());
    }
?>