<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'owner') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Laundry App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto py-10">
        <div class="bg-white rounded-xl shadow-lg p-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-extrabold text-blue-700 mb-1 tracking-wide">Detail Transaksi Laundry</h1>
                    <p class="text-gray-500">Informasi lengkap transaksi dan pembayaran</p>
                </div>
                <div class="flex gap-2 mt-4 md:mt-0">
                    <a href="index_owner.php" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">Kembali</a>
                    <?php
                    include "koneksi.php";
                    $sql = 'select * from transaksi join member on member.id_member=transaksi.id_member join outlet on outlet.id_outlet=transaksi.id_outlet where transaksi.id_transaksi = '  .$_GET['id_transaksi'];
                    $result = mysqli_query($conn, $sql);
                    $data_member = mysqli_fetch_assoc($result);
                    ?>
                    <a href="cetak_transaksi.php?id_transaksi=<?=$data_member['id_transaksi']?>" target="_blank" class="px-5 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Cetak Laporan</a>
                </div>
            </div>
            <!-- Customer Info Card -->
            <div class="bg-blue-50 rounded-lg p-6 mb-8 shadow border border-blue-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="mb-2"><span class="font-semibold text-gray-600">ID Transaksi:</span> <span class="text-gray-800"><?=$data_member['id_transaksi']?></span></div>
                        <div class="mb-2"><span class="font-semibold text-gray-600">Nama Member:</span> <span class="text-gray-800"><?=$data_member['nama_member']?></span></div>
                        <div class="mb-2"><span class="font-semibold text-gray-600">Alamat:</span> <span class="text-gray-800"><?=$data_member['alamat']?></span></div>
                        <div class="mb-2"><span class="font-semibold text-gray-600">Jenis Kelamin:</span> <span class="text-gray-800"><?=$data_member['jenis_kelamin']?></span></div>
                        <div class="mb-2"><span class="font-semibold text-gray-600">Telepon:</span> <span class="text-gray-800"><?=$data_member['tlp']?></span></div>
                    </div>
                    <div>
                        <div class="mb-2"><span class="font-semibold text-gray-600">Nama Outlet:</span> <span class="text-gray-800"><?=$data_member['nama']?></span></div>
                        <div class="mb-2"><span class="font-semibold text-gray-600">Status Pembayaran:</span> <span class="text-gray-800"><?=$data_member['dibayar']?></span></div>
                        <div class="mb-2"><span class="font-semibold text-gray-600">Status Order:</span> <span class="text-gray-800"><?=$data_member['status']?></span></div>
                        <div class="mb-2"><span class="font-semibold text-gray-600">Tanggal Diambil:</span> <span class="text-gray-800"><?=$data_member['batas_waktu']?></span></div>
                    </div>
                </div>
            </div>
            <!-- Table Transaksi -->
            <div>
                <h3 class="text-xl font-semibold mb-4 text-blue-700">Rincian Pembayaran</h3>
                <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 text-sm rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-blue-700 text-white hidden md:table-row">
                            <th class="py-3 px-4 text-left">No</th>
                            <th class="py-3 px-4 text-left">Tanggal Order</th>
                            <th class="py-3 px-4 text-left">Tanggal Bayar</th>
                            <th class="py-3 px-4 text-left">Paket Laundry</th>
                            <th class="py-3 px-4 text-left">Berat Cucian</th>
                            <th class="py-3 px-4 text-left">Harga/Kg</th>
                            <th class="py-3 px-4 text-left">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php
                        include "koneksi.php";
                        $qry_pembayaran = mysqli_query($conn, "SELECT * FROM transaksi 
                            JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi 
                            JOIN paket ON paket.id_paket = detail_transaksi.id_paket 
                            WHERE transaksi.id_transaksi = " . $_GET['id_transaksi']);
                        $no=0;
                        $grand_total = 0;
                        while($data_pembayaran=mysqli_fetch_array($qry_pembayaran)){
                            $harga = $data_pembayaran['harga'];
                            $qty = $data_pembayaran['qty'];
                            $total = $harga*$qty;
                            $grand_total += $total;
                            $no++;
                        ?>
                        <tr class="border-b border-gray-200 hover:bg-blue-50 transition md:table-row flex flex-col md:flex-row mb-4 md:mb-0 bg-white md:bg-transparent rounded md:rounded-none shadow md:shadow-none w-full md:w-auto">
                            <td class="py-2 px-4 md:table-cell block" data-label="No">
                                <span class="font-semibold md:hidden block text-blue-700 mb-1">No</span><?=$no?>
                            </td>
                            <td class="py-2 px-4 md:table-cell block" data-label="Tanggal Order">
                                <span class="font-semibold md:hidden block text-blue-700 mb-1">Tanggal Order</span><?=$data_pembayaran['tgl']?>
                            </td>
                            <td class="py-2 px-4 md:table-cell block" data-label="Tanggal Bayar">
                                <span class="font-semibold md:hidden block text-blue-700 mb-1">Tanggal Bayar</span><?=$data_pembayaran['tgl_bayar']?>
                            </td>
                            <td class="py-2 px-4 md:table-cell block" data-label="Paket Laundry">
                                <span class="font-semibold md:hidden block text-blue-700 mb-1">Paket Laundry</span><?=$data_pembayaran['nama_paket']?>
                            </td>
                            <td class="py-2 px-4 md:table-cell block" data-label="Berat Cucian">
                                <span class="font-semibold md:hidden block text-blue-700 mb-1">Berat Cucian</span><?=$data_pembayaran['qty']?> kg
                            </td>
                            <td class="py-2 px-4 md:table-cell block" data-label="Harga/Kg">
                                <span class="font-semibold md:hidden block text-blue-700 mb-1">Harga/Kg</span>Rp.<?=number_format($data_pembayaran['harga'],0,',','.')?>
                            </td>
                            <td class="py-2 px-4 md:table-cell block font-semibold" data-label="Subtotal">
                                <span class="font-semibold md:hidden block text-blue-700 mb-1">Subtotal</span>
                                <span class="inline-block px-2 py-1 rounded-full bg-blue-100 text-blue-700">
                                    Rp.<?=number_format($total,0,',','.')?>
                                </span>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr class="bg-blue-200 font-bold md:table-row flex flex-col md:flex-row mb-4 md:mb-0 rounded md:rounded-none shadow-none w-full md:w-auto">
                            <td colspan="6" class="py-2 px-4 md:table-cell block text-right md:text-right">
                                <span class="font-semibold md:hidden block text-blue-700 mb-1"></span>
                                Total
                            </td>
                            <td class="py-2 px-4 text-blue-900 md:table-cell block font-bold text-right md:text-right">
                                Rp.<?=number_format($grand_total,0,',','.')?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>