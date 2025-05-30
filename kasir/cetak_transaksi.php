<?php 
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'kasir') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
 <title>Cetak Laporan</title>
 <script src="https://cdn.tailwindcss.com"></script>
 <style>
    @media print {
        .no-print { display: none; }
        body { background: white !important; }
    }
 </style>
</head>
<body class="bg-white text-black font-sans">
    <div class="max-w-3xl mx-auto p-8 border border-gray-300 rounded-lg shadow-lg mt-8 bg-white">
        <div class="flex flex-col items-center mb-6">
            <h2 class="text-3xl font-extrabold text-blue-700 tracking-wide mb-1">LAPORAN TRANSAKSI LAUNDRY</h2>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">LAUNDRY</h3>
            <div class="w-full border-b-4 border-blue-700 mb-2"></div>
        </div>

        <div class="flex justify-between items-center mb-4">
            <div>
                <h4 class="text-lg font-semibold mb-1">Data Customer</h4>
                <table class="text-sm">
                <?php
                 include "koneksi.php";
                 $sql = 'select * from transaksi join detail_transaksi on detail_transaksi.id_transaksi=transaksi.id_transaksi join member on member.id_member = transaksi.id_member join outlet on outlet.id_outlet = transaksi.id_outlet where transaksi.id_transaksi = '  .$_GET['id_transaksi'];
                 $result = mysqli_query($conn, $sql);
                 $data_detail_transaksi = mysqli_fetch_assoc($result);
                ?>
                    <tr>
                        <td class="pr-2 font-semibold text-gray-600">No Transaksi</td>
                        <td class="font-bold"><?=$data_detail_transaksi['id_transaksi']?></td>
                    </tr>
                    <tr>
                        <td class="pr-2 font-semibold text-gray-600">Nama Lengkap</td>
                        <td class="font-bold"><?=$data_detail_transaksi['nama_member']?></td>
                    </tr>
                    <tr>
                        <td class="pr-2 font-semibold text-gray-600">Alamat</td>
                        <td class="font-bold"><?=$data_detail_transaksi['alamat']?></td>
                    </tr>
                    <tr>
                        <td class="pr-2 font-semibold text-gray-600">Jenis Kelamin</td>
                        <td class="font-bold"><?=$data_detail_transaksi['jenis_kelamin']?></td>
                    </tr>
                    <tr>
                        <td class="pr-2 font-semibold text-gray-600">Telepon</td>
                        <td class="font-bold"><?=$data_detail_transaksi['tlp']?></td>
                    </tr>
                    <tr>
                        <td class="pr-2 font-semibold text-gray-600">Nama Outlet</td>
                        <td class="font-bold"><?=$data_detail_transaksi['nama']?></td>
                    </tr>
                    <tr>
                        <td class="pr-2 font-semibold text-gray-600">Status Pembayaran</td>
                        <td class="font-bold"><?=$data_detail_transaksi['dibayar']?></td>
                    </tr>
                    <tr>
                        <td class="pr-2 font-semibold text-gray-600">Status Order</td>
                        <td class="font-bold"><?=$data_detail_transaksi['status']?></td>
                    </tr>
                    <tr>
                        <td class="pr-2 font-semibold text-gray-600">Tanggal Diambil</td>
                        <td class="font-bold"><?=$data_detail_transaksi['batas_waktu']?></td>
                    </tr>
                </table>
            </div>
            <div class="text-right">
                <span class="block text-gray-600">Tanggal Cetak:</span>
                <span class="font-semibold"><?=date('l, d-m-Y')?></span>
            </div>
        </div>

        <div class="mt-6">
            <h4 class="text-lg font-semibold mb-2">Detail Transaksi</h4>
            <table class="table-auto w-full border-collapse text-sm shadow rounded overflow-hidden">
                <thead>
                    <tr class="bg-blue-700 text-white">
                        <th class="border px-3 py-2">No</th>
                        <th class="border px-3 py-2">Tanggal Order</th>
                        <th class="border px-3 py-2">Tanggal Bayar</th>
                        <th class="border px-3 py-2">Paket Laundry</th>
                        <th class="border px-3 py-2">Berat Cucian</th>
                        <th class="border px-3 py-2">Harga/Kg</th>
                        <th class="border px-3 py-2">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "koneksi.php";
                    $qry_pembayaran=mysqli_query($conn,"select * from transaksi join detail_transaksi on detail_transaksi.id_transaksi = transaksi.id_transaksi join paket on paket.id_paket = transaksi.id_paket where transaksi.id_transaksi = ".$_GET['id_transaksi']);
                    $no=0;
                    $grand_total = 0;
                    foreach($qry_pembayaran as $data_pembayaran) {
                        $no++;
                        $harga = $data_pembayaran['harga'];
                        $qty = $data_pembayaran['qty'];
                        $total = $harga*$qty;
                        $grand_total += $total;
                    ?>
                    <tr class="even:bg-gray-50">
                        <td class="border px-3 py-2"><?=$no?></td>
                        <td class="border px-3 py-2"><?=$data_pembayaran['tgl']?></td>
                        <td class="border px-3 py-2"><?=$data_pembayaran['tgl_bayar']?></td>
                        <td class="border px-3 py-2"><?=$data_pembayaran['nama_paket']?></td>
                        <td class="border px-3 py-2"><?=$data_pembayaran['qty']?> kg</td>
                        <td class="border px-3 py-2">Rp.<?=number_format($data_pembayaran['harga'],0,',','.')?></td>
                        <td class="border px-3 py-2">Rp.<?=number_format($total,0,',','.')?></td>
                    </tr>
                    <?php } ?>
                    <tr class="bg-blue-100 font-bold">
                        <td colspan="6" class="border px-3 py-2 text-right">Total</td>
                        <td class="border px-3 py-2 text-blue-700">Rp.<?=number_format($grand_total,0,',','.')?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-12 flex justify-end">
            <div class="text-center">
                <div class="mb-16"></div>
                <div class="font-semibold">Admin Laundry'ss</div>
                <div class="mt-16">(___________________)</div>
            </div>
        </div>
        <button onclick="window.print()" class="no-print mt-8 px-6 py-2 bg-blue-700 text-white rounded shadow hover:bg-blue-800 font-semibold">Cetak Laporan</button>
    </div>
</body>
</html>