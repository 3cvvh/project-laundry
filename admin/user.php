<?php 
session_start();
$user_id = $_SESSION["id_user"];
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
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                <form method="get" class="w-full sm:w-1/2 flex">
                    <input type="text" name="search" placeholder="Cari user..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                        class="w-full px-4 py-2 border border-blue-400 rounded-l focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <?php if (!empty($_GET['search'])): ?>
                        <a href="user.php" class="flex items-center px-3 bg-gray-200 hover:bg-gray-300 border-t border-b border-r border-blue-400 rounded-r text-gray-600 transition" title="Hapus pencarian">
                            <span class="material-icons text-base">close</span>
                        </a>
                    <?php else: ?>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded-r transition duration-200">Cari</button>
                    <?php endif; ?>
                </form>
                <button id="openModalBtn"
                    class="border bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full sm:w-auto">Tambahkan user</button>
            </div>
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full bg-white border border-gray-200 text-sm rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Nama User</th>
                            <th class="px-4 py-3 text-left">Username</th>
                            <th class="px-4 py-3 text-left">Nama Outlet</th>
                            <th class="px-4 py-3 text-left">Role</th>
                            <th class="px-4 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php
                        include "koneksi.php";
                        // Search logic for all columns
                        $where = "";
                        if (isset($_GET['search']) && $_GET['search'] !== "") {
                            $search = mysqli_real_escape_string($conn, $_GET['search']);
                            $columns = ['user.nama_user', 'user.username', 'outlet.nama', 'user.role', 'user.id_user'];
                            $search_clauses = [];
                            foreach ($columns as $col) {
                                $search_clauses[] = "$col LIKE '%$search%'";
                            }
                            $where = "WHERE " . implode(" OR ", $search_clauses);
                        }
                        $qry_user = mysqli_query($conn, "SELECT * FROM user JOIN outlet ON outlet.id_outlet = user.id_outlet $where");
                        $no = 0;
                        $found = false;
                        while($data_user = mysqli_fetch_array($qry_user)){
                            $no++;
                            $found = true;
                        ?>
                        <tr class="border-b border-gray-200 hover:bg-blue-50 transition">
                            <td class="px-4 py-2"><?=$no?></td>
                            <td class="px-4 py-2"><?=$data_user['nama_user']?></td>
                            <td class="px-4 py-2"><?=$data_user['username']?></td>
                            <td class="px-4 py-2"><?=$data_user['nama']?></td>
                            <td class="px-4 py-2"><?=$data_user['role']?></td>
                            <td class="px-4 py-2 flex gap-2">
                                <?php if($_SESSION['role'] == 'admin' && $data_user["role"] != "admin"): ?>
                                <a class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded transition flex items-center" href="./ubah_user.php?id_user=<?=$data_user['id_user']?>
                                    ">
                                    <span class="material-icons text-base">edit</span>
                                </a>
                                <a href="hapus_user.php?id_user=<?=$data_user['id_user']?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition flex items-center">
                                    <span class="material-icons text-base">delete</span>
                                </a>
                                <?php elseif($data_user["id_user"] == $user_id || $data_user["role"] == "admin"): ?>
                                <a class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded transition flex items-center" href="./ubah_user.php?id_user=<?=$data_user['id_user']?>
                                    ">
                                    <span class="material-icons text-base">edit</span>
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php }
                        if (!$found) { ?>
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">Data tidak ditemukan.</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- Modal -->
            <div id="modalUser" class="fixed inset-0 bg-black bg-opacity-40 hidden flex items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
                    <div class="flex justify-between items-center border-b px-6 py-4">
                        <h2 class="text-lg font-semibold">Tambah User</h2>
                        <button class="text-gray-400 hover:text-gray-700" onclick="document.getElementById('modalUser').classList.add('hidden')">
                            <span class="material-icons">close</span>
                        </button>
                    </div>
                    <form method="POST" action="./proses_tambah_user.php" enctype="multipart/form-data" class="px-6 py-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-1">Nama User</label>
                            <input type="text" name="nama_user" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-1">Username</label>
                            <input type="text" name="username" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-1">Password User</label>
                            <input type="text" name="password" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-1">Nama Outlet</label>
                            <select name="id_outlet" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
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
                        <div class="mb-6">
                            <label class="block text-gray-700 mb-1">Role User</label>
                           <?php
                            include "koneksi.php";
                            $result = mysqli_query($conn, "SHOW COLUMNS FROM user LIKE 'role'");
                            $row = mysqli_fetch_array($result);
                            preg_match("/^enum\(\'(.*)\'\)$/", $row['Type'], $matches);
                            $enum_values = explode("','", $matches[1]);
                            ?>
                            <select name="role" class="w-full border border-gray-300 rounded px-3 py-2">
                                <option value="">Role User</option>
                                <?php foreach($enum_values as $role): ?>
                                    <option value="<?= $role ?>"><?= ucfirst($role) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="flex justify-end">
                            <input type="submit" name="simpan" value="Tambah User" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white font-semibold cursor-pointer">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        // Show modal on button click
        document.getElementById('openModalBtn').addEventListener('click', function() {
            document.getElementById('modalUser').classList.remove('hidden');
            document.getElementById('modalUser').classList.add('flex');
        });
        // Hide modal on close button
        document.querySelector('#modalUser button').addEventListener('click', function() {
            document.getElementById('modalUser').classList.add('hidden');
            document.getElementById('modalUser').classList.remove('flex');
        });
        // Hide modal when clicking outside modal content
        document.getElementById('modalUser').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
                this.classList.remove('flex');
            }
        });
    </script>
</body>
</html>