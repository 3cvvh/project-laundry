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
    <!-- Navbar -->
    <nav class="bg-blue-700 py-4 px-4 rounded-b-xl shadow">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between">
            <h1 class="text-2xl sm:text-4xl font-bold text-white mb-2 sm:mb-0">Welcome Admin</h1>
            <div class="flex items-center gap-2">
                <button id="nav-toggle" class="sm:hidden text-white focus:outline-none">
                <span class="material-icons">menu</span>
            </button>
                <ul id="nav-menu" class="w-full sm:w-auto flex-col sm:flex-row flex gap-4 sm:gap-6 mt-2 sm:mt-0 bg-blue-700 sm:bg-transparent rounded-xl sm:rounded-none p-2 sm:p-0 hidden sm:flex">
                    <li>
                        <a href="index_admin.php" class="font-bold text-white px-4 py-2 rounded-lg transition-all duration-200 hover:bg-white hover:text-blue-700 <?= basename($_SERVER['PHP_SELF']) == 'index_admin.php' ? 'bg-white text-blue-700' : '' ?>">Dashboard</a>
                    </li>
                    <li>
                        <a href="transaksi.php" class="font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'transaksi.php' ? 'bg-white text-blue-700' : 'text-white hover:bg-white hover:text-blue-700' ?>">Transaksi</a>
                    </li>
                    <li>
                        <a href="member.php" class="font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'transaksi.php' ? 'bg-white text-blue-700' : 'text-white hover:bg-white hover:text-blue-700' ?>">Member</a>
                    </li>
                    <li>
                    <a href="outlet.php" class="font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'outlet.php' ? 'bg-white text-blue-700' : 'text-white hover:bg-white hover:text-blue-700' ?>">Outlet</a>
                </li>
                    <li>
                        <a href="user.php" class="font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'transaksi.php' ? 'bg-white text-blue-700' : 'text-white hover:bg-white hover:text-blue-700' ?>">User</a>
                    </li>
                    <li>
                        <a href="paket.php" class="font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'transaksi.php' ? 'bg-white text-blue-700' : 'text-white hover:bg-white hover:text-blue-700' ?>">Paket</a>
                    </li>
                </ul>
                <a href="logout.php" onclick="return confirm('Anda yakin ingin logout?')" 
                   class="flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 font-bold ml-2 transition whitespace-nowrap shadow-lg border border-red-600 hover:scale-105 active:scale-95 duration-150">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1"/>
                    </svg>
                    <span class="hidden sm:inline">Logout</span>
                </a>
            </div>
        </div>
    </nav>
    <script>
        // Navbar toggle for mobile
        document.addEventListener('DOMContentLoaded', function () {
            const navToggle = document.getElementById('nav-toggle');
            const navMenu = document.getElementById('nav-menu');
            navToggle?.addEventListener('click', function () {
                navMenu.classList.toggle('hidden');
            });
        });
    </script>
    <main class="p-4">
        <div class="container mx-auto bg-white p-6 rounded-md shadow-md">
            <button id="openModalBtn"
                class="border bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Tambahkan
                outlet</button>
            <br><br>
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-[350px] md:min-w-[600px] w-full bg-white border border-gray-200 text-sm rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Nama Outlet</th>
                            <th class="px-4 py-3 text-left">Alamat</th>
                            <th class="px-4 py-3 text-left">No Telepon</th>
                            <th class="px-4 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    include "koneksi.php";
                    $qry_outlet=mysqli_query($conn,"select * from outlet");
                    $no=0;
                    while($data_outlet=mysqli_fetch_array($qry_outlet)){
                    $no++;?>
                    <tr class="border-b border-gray-200 hover:bg-blue-50 transition">
                        <td class="px-4 py-2"><?=$no?></td>
                        <td class="px-4 py-2"><?=$data_outlet['nama']?></td>
                        <td class="px-4 py-2"><?=$data_outlet['alamat']?></td>
                        <td class="px-4 py-2"><?=$data_outlet['tlp']?></td>
                        <td class="px-4 py-2 flex gap-2">
                            <a class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded transition" href="ubah_outlet.php?id_outlet=<?=$data_outlet['id_outlet']?>
                                ">
                                <span class="material-icons text-base">edit</span>
                            </a>
                            <a href="hapus_outlet.php?id_outlet=<?=$data_outlet['id_outlet']?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">
                                <span class="material-icons text-base">delete</span>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div id="modal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md relative">
            <button id="closeModalBtn"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            <h2 class="text-xl font-bold mb-4 text-blue-700">Tambah outlet </h2>
            <form method="POST" action="proses_tambah_outlet.php" enctype="multipart/form-data" class="px-6 py-4">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Nama Outlet</label>
                    <input type="text" name="nama" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Alamat</label>
                    <input type="text" name="alamat" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 mb-1">No Telepon</label>
                    <input type="text" name="tlp" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div class="flex justify-end">
                    <input type="submit" name="simpan" value="Tambah Outlet" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white font-semibold cursor-pointer">
                </div>
            </form>
        </div>
    </div>
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