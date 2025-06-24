<?php
// Gunakan informasi kredensial dari InfinityFree
$db_host = "sql107.infinityfree.com";        
$db_user = "if0_39312582";                   
$db_pass = "rafli6636";       
$db_name = "if0_39312582_kantin";            

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>