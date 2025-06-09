<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
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
    <style>
        /* Modal animation */
        .modal-enter {
            opacity: 0;
            transform: scale(0.95);
        }

        .modal-enter-active {
            opacity: 1;
            transform: scale(1);
            transition: opacity 0.2s, transform 0.2s;
        }

        .modal-leave {
            opacity: 1;
            transform: scale(1);
        }

        .modal-leave-active {
            opacity: 0;
            transform: scale(0.95);
            transition: opacity 0.2s, transform 0.2s;
        }
    </style>
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
    <main class="p-4">
        <div class="container mx-auto bg-white p-6 rounded-md shadow-md">
            <button id="openModalBtn"
                class="border bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 hover:scale-105 transition-transform duration-150">Tambahkan
                Paket</button>
            <br><br>
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full bg-white border border-gray-200 text-sm rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Nama Outlet</th>
                            <th class="px-4 py-3 text-left">Jenis Paket</th>
                            <th class="px-4 py-3 text-left">Nama Paket</th>
                            <th class="px-4 py-3 text-left">Harga</th>
                            <th class="px-4 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "koneksi.php";
                        $qry_paket=mysqli_query($conn,"select * from paket JOIN outlet ON outlet.id_outlet= paket.id_outlet");
                        $no=0;
                        while($data_paket=mysqli_fetch_array($qry_paket)){
                            $no++;
                        ?>
                        <tr class="border-b border-gray-200 hover:bg-blue-50 transition">
                            <td class="px-4 py-2"><?=$no?></td>
                            <td class="px-4 py-2"><?=$data_paket['nama']?></td>
                            <td class="px-4 py-2"><?=$data_paket['jenis']?></td>
                            <td class="px-4 py-2"><?=$data_paket['nama_paket']?></td>
                            <td class="px-4 py-2">Rp<?=number_format($data_paket['harga'],0,',','.')?></td>
                            <td class="px-4 py-2 flex gap-2 justify-center items-center">
                                <a class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded transition"
                                    href="ubah_paket.php?id_paket=<?=$data_paket['id_paket']?>">Edit</a>
                                <a class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition"
                                    href="hapus_paket.php?id_paket=<?=$data_paket['id_paket']?>"
                                    onclick="return confirm('Apakah anda yakin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div id="modal"
            class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
            <div class="bg-white p-4 md:p-8 rounded-lg shadow-lg w-full max-w-xs sm:max-w-md relative mx-2">
                <button id="closeModalBtn"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl transition-colors duration-150">&times;</button>
                <h2 class="text-xl font-bold mb-4 text-blue-700">Tambah Paket</h2>
                <form method="POST" action="proses_tambah_paket.php" class="space-y-4">
                    <div>
                        <label class="block mb-1 font-semibold">Nama Outlet</label>
                        <select name="id_outlet"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            required>
                            <option value="">Pilih Outlet</option>
                            <?php
                            include "koneksi.php";
                            $qry_outlet=mysqli_query($conn,"select * from outlet");
                            while($data_outlet=mysqli_fetch_array($qry_outlet)){
                                echo '<option value="'.$data_outlet['id_outlet'].'">'.$data_outlet['nama'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold">Jenis</label>
                        <select name="jenis"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            required>
                            <option value="">Pilih Jenis</option>
                            <option value="kiloan">Kiloan</option>
                            <option value="selimut">Selimut</option>
                            <option value="bed_cover">Bed Cover</option>
                            <option value="kaos">Kaos</option>
                            <option value="lain">Lain</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold">Nama Paket</label>
                        <input type="text" name="nama_paket"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            required>
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold">Harga</label>
                        <input type="number" name="harga"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            required>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" name="simpan"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 hover:scale-105 transition-transform duration-150">Tambah
                            Paket</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const modal = document.getElementById('modal');

        openModalBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

        // Close modal on click outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    </script>
</body>

</html>