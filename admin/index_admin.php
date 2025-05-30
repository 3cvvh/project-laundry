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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <title>Admin Laundry</title>
</head>

<body class="bg-gray-100 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-700 py-4 px-4 rounded-b-xl shadow">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between">
            <h1 class="text-2xl sm:text-4xl font-bold text-white mb-2 sm:mb-0">Welcome, Admin</h1>
            <div class="flex items-center gap-2">
                <button id="nav-toggle" class="sm:hidden text-white focus:outline-none">
                <span class="material-icons">menu</span>
            </button>
                <ul id="nav-menu" class="w-full sm:w-auto flex-col sm:flex-row flex gap-4 sm:gap-6 mt-2 sm:mt-0 bg-blue-700 sm:bg-transparent rounded-xl sm:rounded-none p-2 sm:p-0 hidden sm:flex">
                    <li>
                        <a href="index_kasir.php" class="font-bold text-white px-4 py-2 rounded-lg transition-all duration-200 hover:bg-white hover:text-blue-700 <?= basename($_SERVER['PHP_SELF']) == 'index_admin.php' ? 'bg-white text-blue-700' : '' ?>">Dashboard</a>
                    </li>
                    <li>
                        <a href="transaksi.php" class="font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'transaksi.php' ? 'bg-white text-blue-700' : 'text-white hover:bg-white hover:text-blue-700' ?>">Transaksi</a>
                    </li>
                    <li>
                        <a href="member.php" class="font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'transaksi.php' ? 'bg-white text-blue-700' : 'text-white hover:bg-white hover:text-blue-700' ?>">Member</a>
                    </li>
                    <li>
                    <a href="outlet.php" class="font-bold text-white px-4 py-2 rounded-lg transition-all duration-200 hover:bg-white hover:text-blue-700 <?= basename($_SERVER['PHP_SELF']) == 'outlet.php' ? 'bg-white text-blue-700' : '' ?>">Outlet</a>
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
        </main>

        

</body>

</html>