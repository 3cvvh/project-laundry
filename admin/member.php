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
        <div class="container mx-auto flex flex-col gap-4">
            <div class="container mx-auto mt-6 bg-white p-6 rounded-md shadow-md">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                    <form method="get" class="w-full sm:w-1/2 flex">
                        <input type="text" name="search" placeholder="Cari member..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                            class="w-full px-4 py-2 border border-blue-400 rounded-l focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <?php if (!empty($_GET['search'])): ?>
                            <a href="member.php" class="flex items-center px-3 bg-gray-200 hover:bg-gray-300 border-t border-b border-r border-blue-400 rounded-r text-gray-600 transition" title="Hapus pencarian">
                                <span class="material-icons text-base">close</span>
                            </a>
                        <?php else: ?>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded-r transition duration-200">Cari</button>
                        <?php endif; ?>
                    </form>
                    <button id="openModalBtn"
                        class="border bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full sm:w-auto">Tambahkan member</button>
                </div>
                <div class="w-full overflow-x-auto rounded-lg shadow mt-6">
                    <table class="min-w-[350px] md:min-w-[600px] w-full bg-white border border-gray-200 text-sm rounded-lg overflow-hidden">
                        <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nama Member</th>
                        <th class="px-4 py-3 text-left">Alamat</th>
                        <th class="px-4 py-3 text-left">Jenis Kelamin</th>
                        <th class="px-4 py-3 text-left">Nomor Telepon</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include "koneksi.php";
                    // Search logic for all columns
                    $where = "";
                    if (isset($_GET['search']) && $_GET['search'] !== "") {
                        $search = mysqli_real_escape_string($conn, $_GET['search']);
                        $columns = ['nama_member', 'alamat', 'jenis_kelamin', 'tlp', 'id_member'];
                        $search_clauses = [];
                        foreach ($columns as $col) {
                            $search_clauses[] = "$col LIKE '%$search%'";
                        }
                        $where = "WHERE " . implode(" OR ", $search_clauses);
                    }
                    $qry_member = mysqli_query($conn, "SELECT * FROM member $where");
                    $no = 0;
                    $found = false;
                    while($data_member = mysqli_fetch_array($qry_member)){
                        $no++;
                        $found = true;
                ?>
                    <tr class="border-b border-gray-200 hover:bg-blue-50 transition">
                        <td class="px-4 py-2"><?=$no?></td>
                        <td class="px-4 py-2"><?=$data_member['nama_member']?></td>
                        <td class="px-4 py-2"><?=$data_member['alamat']?></td>
                        <td class="px-4 py-2"><?=$data_member['jenis_kelamin']?></td>
                        <td class="px-4 py-2"><?=$data_member['tlp']?></td>
                        <td class="px-4 py-2 flex gap-2 justify-center items-center">
                            <a class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded transition flex items-center" href="ubah_member.php?id_member=<?=$data_member['id_member']?>
                                ">
                                <span class="material-icons text-base">edit</span>
                            </a>
                            <a class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition flex items-center" href="hapus_member.php?id_member=<?=$data_member['id_member']?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')">
                                <span class="material-icons text-base">delete</span>
                            </a>
                        </td>
                    </tr>
                <?php
                    }
                    if (!$found) {
                ?>
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500">Data tidak ditemukan.</td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <div>
            <div>
                <div>
                <div class="mt-6">
    </div>
     <div id="modal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md relative">
            <button id="closeModalBtn"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            <h2 class="text-xl font-bold mb-4 text-blue-700">Tambah member </h2>
            <form method="POST" action="proses_tambah_member.php" enctype="multipart/form-data" class="px-6 py-4">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Nama member</label>
                    <input type="text" name="nama" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Alamat</label>
                    <input type="text" name="alamat" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition" required>
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 mb-1">No Telepon</label>
                    <input type="text" name="tlp" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div class="flex flex-col md:flex-row justify-end gap-2">
                    <button type="submit" name="submit" class="mr-0 md:mr-2 px-4 py-2 rounded bg-blue-500 hover:bg-gray-300 text-black">tambah member</button>
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
                                                    </div>
                                                </div>
            </div>

            </body>

</html>