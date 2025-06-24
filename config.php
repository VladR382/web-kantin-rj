<?php
// Ganti dengan kredensial database Anda
$db_host = "localhost";        
$db_user = "username_database_anda";                   
$db_pass = "password_database_anda";       
$db_name = "nama_database_anda";            

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
