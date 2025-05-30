
<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'owner') {
    header("Location: ../login.php");
    exit;
}
?><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laundry Owner Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-blue-700 p-4 text-white">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Laundry  Owner</h1>
            <nav>
                <a href="logout.php" class="ml-4 px-4 py-2 bg-red-500 rounded hover:bg-red-600 text-white font-semibold">Logout</a>
            </nav>
        </div>
    </header>
    <main class="p-6 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="col-span-1 bg-white rounded-lg shadow p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-bold text-blue-700 mb-2">Welcome To Laundry </h2>
                    <p class="text-gray-600 mb-4">Terimakasih telah bergabung di Laundry<br>Anda login menggunakan akun owner.</p>
                </div>
            </div>
            <div class="col-span-1 md:col-span-2 bg-white rounded-lg shadow p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Halaman Dashboard Owner</h3>
                        <p class="text-gray-500 text-sm">Histori Data Transaksi  Laundry</p>
                    </div>
                    <a href="cetak_all.php" target="_blank" class="mt-2 md:mt-0 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 font-semibold">Cetak Generate Laporan</a>
                </div>
                <div class="overflow-x-auto rounded shadow">
                    <table class="min-w-full bg-white border border-gray-200 text-sm rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-blue-600 text-white">
                                <th class="px-4 py-2 text-left">No</th>
                                <th class="px-4 py-2 text-left">Outlet</th>
                                <th class="px-4 py-2 text-left">Tanggal</th>
                                <th class="px-4 py-2 text-left">Batas Waktu</th>
                                <th class="px-4 py-2 text-left">Pembayaran</th>
                                <th class="px-4 py-2 text-left">Tanggal Dibayar</th>
                                <th class="px-4 py-2 text-left">Customer</th>
                                <th class="px-4 py-2 text-left">Paket</th>
                                <th class="px-4 py-2 text-left">Status Order</th>
                                <th class="px-2 py-1 md:px-4 md:py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        include "koneksi.php";
                        $qry_transaksi=mysqli_query($conn,"select * from transaksi JOIN outlet ON outlet.id_outlet = transaksi.id_outlet JOIN member ON member.id_member = transaksi.id_member JOIN paket ON paket.id_paket = transaksi.id_paket");
                        $no=0;
                        while($data_transaksi=mysqli_fetch_array($qry_transaksi)){
                        $no++;?>
                            <tr class="border-b border-gray-200 hover:bg-blue-50 transition md:table-row flex flex-col md:flex-row mb-4 md:mb-0 bg-white md:bg-transparent rounded md:rounded-none shadow md:shadow-none">
                                <td class="px-4 py-2 md:table-cell" data-label="No"><?=$no?></td>
                                <td class="px-4 py-2 md:table-cell" data-label="Outlet"><?=$data_transaksi['nama']?></td>
                                <td class="px-4 py-2 md:table-cell" data-label="Tanggal"><?=$data_transaksi['tgl']?></td> 
                                <td class="px-4 py-2 md:table-cell" data-label="Batas Waktu"><?=$data_transaksi['batas_waktu']?></td> 
                                <td class="px-4 py-2 md:table-cell" data-label="Pembayaran"><?=$data_transaksi['dibayar']?></td> 
                                <td class="px-4 py-2 md:table-cell" data-label="Tanggal Dibayar"><?=$data_transaksi['tgl_bayar']?></td> 
                                <td class="px-4 py-2 md:table-cell" data-label="Customer"><?=$data_transaksi['nama_member']?></td>
                                <td class="px-4 py-2 md:table-cell" data-label="Paket"><?=$data_transaksi['nama_paket']?></td>
                                <td class="px-4 py-2 md:table-cell" data-label="Status Order"><?=$data_transaksi['status']?></td>
                                <td class="px-4 py-2 flex gap-2 md:table-cell block" data-label="Aksi">
                                    <a href="./detail_transaksi.php?id_transaksi=<?php echo $data_transaksi['id_transaksi']?>" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition font-semibold">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>