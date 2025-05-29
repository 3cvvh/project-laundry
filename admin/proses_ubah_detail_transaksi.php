<?php 
    include 'koneksi.php';

    $dibayar = $_POST['dibayar'];

    $tgl_bayar = $_POST['tgl_bayar'];
    $status = $_POST['status'];
 if($dibayar == 'dibayar') {
            $tgl_bayar = $_POST['tgl_bayar'];
        } else {
            $tgl_bayar = '0000-00-00';
        }
    $sql = "
        update transaksi join detail_transaksi on detail_transaksi.id_transaksi = transaksi.id_transaksi set dibayar = '" . $dibayar . "', tgl_bayar = '" . $tgl_bayar . "', status = '" . $status . "' where transaksi.id_transaksi = '" . $_POST['id_transaksi'] . "'
    ";

    $result = mysqli_query($conn, $sql);
        if($result){
            echo "<script>alert('Success edit transaksi');location.href='transaksi.php';</script>";
        }else{
            echo "<script>alert('Failed edit transaksi');location.href='transaksi.php';</script>";
        }
?>