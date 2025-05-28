<?php
if($_POST){
    $nama=$_POST['nama'];
    $alamat=$_POST['alamat'];
    $tlp=$_POST['tlp'];

    include "koneksi.php";
    $insert=mysqli_query($conn,"insert into outlet
    value
    ('"."','".$nama."','".$alamat."','".$tlp."')") or
    die(mysqli_error($conn));
if($insert){
    echo "<script>alert('Sukses menambahkan outlet');location.href='outlet.php';</script>";
} else {
    echo "<script>alert('Gagal menambahkan outlet');location.href='outlet.php';</script>";
}
}

?>