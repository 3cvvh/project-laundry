<?php
if($_POST){
    $qty = $_POST['qty'];
    $keterangan = $_POST['keterangan'];
    $id_member=$_POST['id_member'];
    $id_outlet=$_POST['id_outlet'];
    $id_paket=$_POST['id_paket'];
    $id_user=$_POST['id_user'];
    $tgl=$_POST['tgl'];
    $batas_waktu=$_POST['batas_waktu'];
    $status=$_POST['status'];
    $dibayar=$_POST['dibayar'];


        include "koneksi.php";
        if($dibayar == 'dibayar') {
            $tgl_bayar = date('Y-m-d');
        } else {
            $tgl_bayar = '0000-00-00';
        }
        $query_insert="INSERT INTO transaksi VALUES('','$id_outlet','$id_member','$tgl','$batas_waktu','$tgl_bayar','$status','$dibayar','$id_user','$id_paket')";
        $insert=mysqli_query($conn, $query_insert);
        if($insert){
            $id_transaksi = mysqli_insert_id($conn);
            $query_detail = "INSERT INTO detail_transaksi VALUES('', '$id_transaksi', '$id_paket', '$qty', '$keterangan')";
            $insert_detail = mysqli_query($conn, $query_detail);
            if($insert_detail){
                echo "<script>alert('Sukses menambahkan transaksi dan detail transaksi');location.href='transaksi.php';</script>";
            } else {
                echo "<script>alert('Transaksi berhasil, tapi gagal menambahkan detail transaksi');location.href='transaksi.php';</script>";
            }
        } else {
            echo "<script>alert('Gagal menambahkan transaksi');location.href='transaksi.php';</script>";
        }
    }
?>