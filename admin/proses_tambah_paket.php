<?php
if($_POST){
    $id_outlet=$_POST['id_outlet'];
    $jenis=$_POST['jenis'];
    $nama_paket=$_POST['nama_paket'];
    $harga=$_POST['harga'];

    include "koneksi.php";
    $insert=mysqli_query($conn,"insert into paket 
    value
    ('"."','".$id_outlet."','".$jenis."','".$nama_paket."','".$harga."')") or
    die(mysqli_error($conn));
if($insert){
    echo "<script>alert('Sukses menambahkan paket');location.href='paket.php';</script>";
} else {
    echo "<script>alert('Gagal menambahkan paket');location.href='paket.php';</script>";
}
}
?>