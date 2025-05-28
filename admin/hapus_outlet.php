<?php
    if($_GET['id_outlet']){
        include "koneksi.php";
        $id_outlet = $_GET['id_outlet'];

        // Ambil semua id_user yang ada di outlet ini
        $result_users = mysqli_query($conn, "SELECT id_user FROM user WHERE id_outlet='$id_outlet'");
        while($row = mysqli_fetch_assoc($result_users)){
            $id_user = $row['id_user'];
            // Ambil semua id_transaksi milik user ini
            $result_transaksi = mysqli_query($conn, "SELECT id_transaksi FROM transaksi WHERE id_user='$id_user'");
            while($trx = mysqli_fetch_assoc($result_transaksi)){
                $id_transaksi = $trx['id_transaksi'];
                // Hapus detail_transaksi terkait transaksi ini
                mysqli_query($conn, "DELETE FROM detail_transaksi WHERE id_transaksi='$id_transaksi'");
            }
            // Hapus transaksi yang terkait user ini
            mysqli_query($conn, "DELETE FROM transaksi WHERE id_user='$id_user'");
        }

        // Hapus user di outlet ini
        mysqli_query($conn, "DELETE FROM user WHERE id_outlet='$id_outlet'");
        // Hapus paket di outlet ini
        mysqli_query($conn, "DELETE FROM paket WHERE id_outlet='$id_outlet'");
        // Hapus outlet
        $qry_hapus = mysqli_query($conn, "DELETE FROM outlet WHERE id_outlet='$id_outlet'");

        if($qry_hapus){
            echo "<script>alert('Sukses Hapus Outlet');location.href='outlet.php';</script>";
        } else {
            echo "<script>alert('Gagal hapus Outlet');location.href='outlet.php';</script>";
        }
    }
?>