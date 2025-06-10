<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'owner') {
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
    <style>
        .gradient-bg {
            background: linear-gradient(90deg, #2563eb 0%, #1e40af 100%);
        }
        .card-shadow {
            box-shadow: 0 4px 24px 0 rgba(37,99,235,0.08), 0 1.5px 6px 0 rgba(0,0,0,0.03);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-blue-200 min-h-screen">
    <!-- Navbar/Sidebar -->
    <header class="gradient-bg p-4 text-white shadow-lg">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-2">
            <h1 class="text-3xl font-extrabold w-full text-center md:text-left tracking-tight drop-shadow">Laundry Owner</h1>
            <nav class="flex justify-center md:justify-end mt-2 md:mt-0">
                <a href="logout.php" onclick="return confirm('Anda yakin ingin logout?')" 
                   class="flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 font-bold transition whitespace-nowrap shadow-lg border border-red-600 hover:scale-105 active:scale-95 duration-150">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1"/>
                    </svg>
                    <span class="hidden sm:inline">Logout</span>
                </a>
            </nav>
        </div>
    </header>
    <main class="p-6 max-w-7xl mx-auto flex flex-col items-center">
        <div class="w-full flex flex-col md:flex-row md:justify-center md:items-center gap-6 mb-8">
            <div class="bg-white rounded-2xl card-shadow p-8 flex flex-col justify-center items-center w-full md:w-1/3 border border-blue-100">
                <h2 class="text-2xl font-extrabold text-blue-700 mb-2 text-center tracking-tight">Welcome To Laundry</h2>
                <p class="text-gray-600 mb-4 text-center">Terimakasih telah bergabung di Laundry<br>Anda login menggunakan akun <span class="font-bold text-blue-700">owner</span>.</p>
                <div class="mt-2 flex flex-col items-center">
                    <span class="inline-block px-4 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Dashboard Owner</span>
                </div>
            </div>
        </div>
        <div class="w-full flex justify-center">
            <div class="bg-white rounded-2xl card-shadow p-8 w-full md:w-4/5 lg:w-3/4 xl:w-2/3 border border-blue-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">Halaman Dashboard Owner</h3>
                        <p class="text-gray-500 text-sm">Histori Data Transaksi Laundry</p>
                    </div>
                    <a href="cetak_all.php" target="_blank" class="mt-2 md:mt-0 px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold shadow transition duration-150">Cetak Generate Laporan</a>
                </div>
                <!-- Search Bar -->
                <form method="get" class="mb-4 flex w-full md:w-1/2">
                    <input type="text" name="search" placeholder="Cari transaksi..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                        class="w-full px-4 py-2 border border-blue-400 rounded-l focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <?php if (!empty($_GET['search'])): ?>
                        <a href="index_owner.php" class="flex items-center px-3 bg-gray-200 hover:bg-gray-300 border-t border-b border-r border-blue-400 rounded-r text-gray-600 transition" title="Hapus pencarian">
                            <span class="material-icons text-base">close</span>
                        </a>
                    <?php else: ?>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded-r transition duration-200">Cari</button>
                    <?php endif; ?>
                </form>
                <div class="overflow-x-auto rounded shadow">
                    <table class="min-w-full bg-white border border-gray-200 text-sm rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-blue-600 text-white hidden md:table-row">
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
                        // Search logic for all columns
                        $where = "";
                        if (isset($_GET['search']) && $_GET['search'] !== "") {
                            $search = mysqli_real_escape_string($conn, $_GET['search']);
                            $columns = [
                                'outlet.nama', 'transaksi.tgl', 'transaksi.batas_waktu', 'transaksi.dibayar',
                                'transaksi.tgl_bayar', 'member.nama_member', 'paket.nama_paket', 'transaksi.status'
                            ];
                            $search_clauses = [];
                            foreach ($columns as $col) {
                                $search_clauses[] = "$col LIKE '%$search%'";
                            }
                            $where = "WHERE " . implode(" OR ", $search_clauses);
                        }
                        $qry_transaksi=mysqli_query($conn,"select * from transaksi JOIN outlet ON outlet.id_outlet = transaksi.id_outlet JOIN member ON member.id_member = transaksi.id_member JOIN paket ON paket.id_paket = transaksi.id_paket $where");
                        $no=0;
                        $found = false;
                        while($data_transaksi=mysqli_fetch_array($qry_transaksi)){
                        $no++;
                        $found = true;
                        ?>
                            <tr class="border border-gray-200 hover:shadow-lg hover:bg-blue-50 transition-all duration-200 md:table-row flex flex-col md:flex-row mb-6 md:mb-0 bg-white md:bg-transparent rounded-xl md:rounded-none shadow md:shadow-none w-full md:w-auto">
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="No">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">No</span><?=$no?>
                                </td>
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="Outlet">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">Outlet</span><?=$data_transaksi['nama']?>
                                </td>
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="Tanggal">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">Tanggal</span><?=$data_transaksi['tgl']?>
                                </td> 
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="Batas Waktu">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">Batas Waktu</span><?=$data_transaksi['batas_waktu']?>
                                </td> 
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="Pembayaran">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">Pembayaran</span><?=$data_transaksi['dibayar']?>
                                </td> 
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="Tanggal Dibayar">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">Tanggal Dibayar</span><?=$data_transaksi['tgl_bayar']?>
                                </td> 
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="Customer">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">Customer</span><?=$data_transaksi['nama_member']?>
                                </td>
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="Paket">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">Paket</span><?=$data_transaksi['nama_paket']?>
                                </td>
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="Status Order">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">Status Order</span>
                                    <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                                        <?php
                                            if($data_transaksi['status']=='baru') echo 'bg-yellow-100 text-yellow-700';
                                            elseif($data_transaksi['status']=='proses') echo 'bg-blue-100 text-blue-700';
                                            elseif($data_transaksi['status']=='selesai') echo 'bg-green-100 text-green-700';
                                            elseif($data_transaksi['status']=='diambil') echo 'bg-purple-100 text-purple-700';
                                            else echo 'bg-gray-100 text-gray-700';
                                        ?>">
                                        <?=$data_transaksi['status']?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 md:py-2 flex gap-2 md:table-cell block border-b-0" data-label="Aksi">
                                    <a href="./detail_transaksi.php?id_transaksi=<?php echo $data_transaksi['id_transaksi']?>" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg transition font-semibold shadow">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        <?php }
                        if (!$found) { ?>
                            <tr>
                                <td colspan="10" class="text-center py-6 text-gray-500">Data tidak ditemukan.</td>
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