<?php
    if($_GET['id_member']){
        include "koneksi.php";
        // Cek apakah member punya transaksi
        $cek_transaksi = mysqli_query($conn, "SELECT COUNT(*) as jml FROM transaksi WHERE id_member='".$_GET['id_member']."'");
        $data_cek = mysqli_fetch_assoc($cek_transaksi);
        if ($data_cek['jml'] > 0) {
            echo "<script>alert('Tidak bisa menghapus member karena masih ada transaksi yang ada.');location.href='member.php';</script>";
            exit;
        }
        $qry_hapus=mysqli_query($conn,"delete from member where id_member='".$_GET['id_member']."'");
        if($qry_hapus){
            echo "<script>alert('Sukses Hapus Member');location.href='member.php';</script>";
        } else {
            echo "<script>alert('Gagal hapus Member');location.href='member.php';</script>";
        }
    }
?>