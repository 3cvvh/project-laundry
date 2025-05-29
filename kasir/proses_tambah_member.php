<?php
if($_POST){
    $nama=$_POST['nama'];
    $alamat=$_POST['alamat'];
    $jenis_kelamin=$_POST['jenis_kelamin'];
    $tlp=$_POST['tlp'];

    include "koneksi.php";
    $insert=mysqli_query($conn,"insert into member
    (id_member, nama_member, alamat, jenis_kelamin, tlp) 
    value
    ('"."','".$nama."','".$alamat."','".$jenis_kelamin."','".$tlp."')") or
    die(mysqli_error($conn));
if($insert){
    echo "<script>alert('Sukses menambahkan member');location.href='member.php';</script>";
} else {
    echo "<script>alert('Gagal menambahkan member');location.href='member.php';</script>";
}
}

?>  