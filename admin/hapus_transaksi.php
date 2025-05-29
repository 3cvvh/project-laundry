<?php
$id = $_GET["id_transaksi"];
    if($id){
        include "koneksi.php";
           $qry_hapus = mysqli_query($conn,"delete from detail_transaksi where id_transaksi = $id");
        $qry_hapus=mysqli_query($conn,"delete from transaksi where id_transaksi= $id");
        if($qry_hapus){
            echo "<script>alert('Sukses Hapus Transaksi');location.href='transaksi.php';</script>";
        } else {
            echo "<script>alert('Gagal hapus Transaksi');location.href='transaksi.php';</script>";
        }
    }
?>