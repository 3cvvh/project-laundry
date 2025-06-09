<?php 
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
require_once "function_select.php";
$user = count(select("SELECT * FROM user"));
$transaksi = count(select("SELECT * FROM transaksi"));
$pelanggan = count(select("SELECT * FROM member"));
$oulet = count(select("SELECT * FROM outlet"));
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Laundry App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=dataset" />
</head>

<body class="bg-gray-100 min-h-screen">
    <!-- Sidebar/Navbar -->
    <nav class="bg-blue-700 py-4 px-4 rounded-b-xl shadow relative">
        <div class="max-w-7xl mx-auto flex items-center justify-between flex-wrap">
            <h1 class="text-2xl sm:text-4xl font-extrabold text-white mb-2 sm:mb-0 tracking-tight drop-shadow">Welcome Admin</h1>
            <div class="flex items-center gap-2">
                <!-- Mobile Sidebar Toggle -->
                <button id="nav-toggle" class="sm:hidden text-white focus:outline-none transition hover:scale-110">
                    <span class="material-icons">menu</span>
                </button>
                <!-- Sidebar for mobile -->
                <div id="sidebar" class="fixed inset-0 z-50 bg-black bg-opacity-40 hidden">
                    <div class="absolute left-0 top-0 h-full w-72 bg-gradient-to-b from-blue-800 via-blue-700 to-blue-600 shadow-2xl flex flex-col p-6 rounded-r-2xl border-r-4 border-blue-300">
                        <button id="close-sidebar" class="self-end mb-4 text-white text-3xl focus:outline-none hover:text-blue-200 transition">
                            &times;
                        </button>
                        <ul class="flex flex-col gap-4 mt-4">
                            <li>
                                <a href="index_admin.php" class="flex items-center gap-3 font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'index_admin.php' ? 'bg-white text-blue-700 shadow' : 'text-white hover:bg-blue-100 hover:text-blue-700' ?>">
                                    <span class="material-icons">dashboard</span> Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="transaksi.php" class="flex items-center gap-3 font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'transaksi.php' ? 'bg-white text-blue-700 shadow' : 'text-white hover:bg-blue-100 hover:text-blue-700' ?>">
                                    <span class="material-icons">receipt_long</span> Transaksi
                                </a>
                            </li>
                            <li>
                                <a href="member.php" class="flex items-center gap-3 font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'member.php' ? 'bg-white text-blue-700 shadow' : 'text-white hover:bg-blue-100 hover:text-blue-700' ?>">
                                    <span class="material-icons">people</span> Member
                                </a>
                            </li>
                            <li>
                                <a href="outlet.php" class="flex items-center gap-3 font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'outlet.php' ? 'bg-white text-blue-700 shadow' : 'text-white hover:bg-blue-100 hover:text-blue-700' ?>">
                                    <span class="material-icons">store</span> Outlet
                                </a>
                            </li>
                            <li>
                                <a href="user.php" class="flex items-center gap-3 font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'user.php' ? 'bg-white text-blue-700 shadow' : 'text-white hover:bg-blue-100 hover:text-blue-700' ?>">
                                    <span class="material-icons">admin_panel_settings</span> User
                                </a>
                            </li>
                            <li>
                                <a href="paket.php" class="flex items-center gap-3 font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'paket.php' ? 'bg-white text-blue-700 shadow' : 'text-white hover:bg-blue-100 hover:text-blue-700' ?>">
                                    <span class="material-icons">inventory_2</span> Paket
                                </a>
                            </li>
                            <li>
                                <a href="logout.php" onclick="return confirm('Anda yakin ingin logout?')" 
                                   class="flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 font-bold transition shadow-lg border border-red-600 hover:scale-105 active:scale-95 duration-150 mt-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1"/>
                                    </svg>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Navbar for desktop -->
                <ul id="nav-menu" class="w-full sm:w-auto flex-col sm:flex-row flex gap-2 sm:gap-6 mt-2 sm:mt-0 bg-blue-700 sm:bg-transparent rounded-xl sm:rounded-none p-2 sm:p-0 hidden sm:flex transition-all duration-200">
                    <li>
                        <a href="index_admin.php" class="flex items-center gap-2 font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'index_admin.php' ? 'bg-white text-blue-700 shadow' : 'text-white hover:bg-blue-100 hover:text-blue-700' ?>"><span class="material-icons">dashboard</span> Dashboard</a>
                    </li>
                    <li>
                        <a href="transaksi.php" class="flex items-center gap-2 font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'transaksi.php' ? 'bg-white text-blue-700 shadow' : 'text-white hover:bg-blue-100 hover:text-blue-700' ?>"><span class="material-icons">receipt_long</span> Transaksi</a>
                    </li>
                    <li>
                        <a href="member.php" class="flex items-center gap-2 font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'member.php' ? 'bg-white text-blue-700 shadow' : 'text-white hover:bg-blue-100 hover:text-blue-700' ?>"><span class="material-icons">people</span> Member</a>
                    </li>
                    <li>
                        <a href="outlet.php" class="flex items-center gap-2 font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'outlet.php' ? 'bg-white text-blue-700 shadow' : 'text-white hover:bg-blue-100 hover:text-blue-700' ?>"><span class="material-icons">store</span> Outlet</a>
                    </li>
                    <li>
                        <a href="user.php" class="flex items-center gap-2 font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'user.php' ? 'bg-white text-blue-700 shadow' : 'text-white hover:bg-blue-100 hover:text-blue-700' ?>"><span class="material-icons">admin_panel_settings</span> User</a>
                    </li>
                    <li>
                        <a href="paket.php" class="flex items-center gap-2 font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'paket.php' ? 'bg-white text-blue-700 shadow' : 'text-white hover:bg-blue-100 hover:text-blue-700' ?>"><span class="material-icons">inventory_2</span> Paket</a>
                    </li>
                </ul>
                <a href="logout.php" onclick="return confirm('Anda yakin ingin logout?')" 
                   class="hidden sm:flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 font-bold ml-2 transition whitespace-nowrap shadow-lg border border-red-600 hover:scale-105 active:scale-95 duration-150">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1"/>
                    </svg>
                    <span class="hidden sm:inline">Logout</span>
                </a>
            </div>
        </div>
    </nav>
    <script>
        // Sidebar and Navbar toggle for mobile
        document.addEventListener('DOMContentLoaded', function () {
            const navToggle = document.getElementById('nav-toggle');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('close-sidebar');
            navToggle?.addEventListener('click', function () {
                sidebar.classList.remove('hidden');
                sidebar.classList.add('flex');
            });
            closeSidebar?.addEventListener('click', function () {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('flex');
            });
            // Close sidebar when clicking outside
            sidebar?.addEventListener('click', function (e) {
                if (e.target === sidebar) {
                    sidebar.classList.add('hidden');
                    sidebar.classList.remove('flex');
                }
            });
        });
    </script>
    <main class="container mx-auto py-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center">
                <h3 class="text-lg font-semibold">Jumlah User</h3>
                <p class="text-4xl font-bold"><?php echo $user; ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center">
                <h3 class="text-lg font-semibold">Jumlah Transaksi</h3>
                <p class="text-4xl font-bold"><?php echo $transaksi ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center">
                <h3 class="text-lg font-semibold">Jumlah Pelanggan</h3>
                <p class="text-4xl font-bold"><?php echo $pelanggan ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center">
                <h3 class="text-lg font-semibold">Jumlah Outlet</h3>
                <p class="text-4xl font-bold"><?= $oulet; ?></p>
            </div>
        </div>
        <!-- Tabel Transaksi -->
        <div class="mt-10 flex justify-center">
            <div class="bg-white rounded-2xl shadow-md p-8 w-full md:w-4/5 lg:w-3/4 xl:w-2/3 border border-blue-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-xl font-bold text-blue-700 mb-4 md:mb-0">Data Transaksi Terbaru</h2>
                </div>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "koneksi.php";
                            $qry_transaksi = mysqli_query($conn, "SELECT * FROM transaksi 
                                JOIN outlet ON outlet.id_outlet = transaksi.id_outlet 
                                JOIN member ON member.id_member = transaksi.id_member 
                                JOIN paket ON paket.id_paket = transaksi.id_paket
                                ORDER BY transaksi.id_transaksi DESC LIMIT 10");
                            $no = 0;
                            while($data_transaksi = mysqli_fetch_array($qry_transaksi)){
                                $no++;
                            ?>
                            <tr class="border border-gray-200 hover:shadow-lg hover:bg-blue-50 transition-all duration-200 md:table-row flex flex-col md:flex-row mb-6 md:mb-0 bg-white md:bg-transparent rounded-xl md:rounded-none shadow md:shadow-none w-full md:w-auto">
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="No">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">No</span><?= $no ?>
                                </td>
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="Outlet">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">Outlet</span><?= $data_transaksi['nama'] ?>
                                </td>
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="Tanggal">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">Tanggal</span><?= $data_transaksi['tgl'] ?>
                                </td>
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="Batas Waktu">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">Batas Waktu</span><?= $data_transaksi['batas_waktu'] ?>
                                </td>
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="Pembayaran">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">Pembayaran</span><?= $data_transaksi['dibayar'] ?>
                                </td>
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="Tanggal Dibayar">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">Tanggal Dibayar</span><?= $data_transaksi['tgl_bayar'] ?>
                                </td>
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="Customer">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">Customer</span><?= $data_transaksi['nama_member'] ?>
                                </td>
                                <td class="px-4 py-3 md:py-2 md:table-cell block border-b md:border-b-0" data-label="Paket">
                                    <span class="font-semibold md:hidden block text-blue-700 mb-1">Paket</span><?= $data_transaksi['nama_paket'] ?>
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
                                        <?= $data_transaksi['status'] ?>
                                    </span>
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