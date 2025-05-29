<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <title>Admin Laundry</title>
</head>

<body class="bg-gray-100 min-h-screen">
    <!-- Navbar mirip transaksi -->
    <nav class="bg-blue-700 py-4 px-4 rounded-b-xl shadow">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between">
            <h1 class="text-2xl sm:text-4xl font-bold text-white mb-2 sm:mb-0">Welcome, Admin</h1>
            <button id="nav-toggle" class="sm:hidden text-white focus:outline-none">
                <span class="material-icons">menu</span>
            </button>
            <ul id="nav-menu" class="w-full sm:w-auto flex-col sm:flex-row flex gap-2 sm:gap-6 mt-2 sm:mt-0 bg-blue-700 sm:bg-transparent rounded-xl sm:rounded-none p-2 sm:p-0 hidden sm:flex transition-all duration-200">
                <li>
                    <a href="index_kasir.php" class="font-bold text-white px-4 py-2 rounded-lg transition-all duration-200 hover:bg-white hover:text-blue-700 <?= basename($_SERVER['PHP_SELF']) == 'index_admin.php' ? 'bg-white text-blue-700' : '' ?>">Dashboard</a>
                </li>
                <li>
                    <a href="transaksi.php" class="font-bold px-4 py-2 rounded-lg transition-all duration-200 <?= basename($_SERVER['PHP_SELF']) == 'transaksi.php' ? 'bg-white text-blue-700' : 'text-white hover:bg-white hover:text-blue-700' ?>">Transaksi</a>
                </li>
                <li>
                    <a href="member.php" class="font-bold text-white px-4 py-2 rounded-lg transition-all duration-200 hover:bg-white hover:text-blue-700 <?= basename($_SERVER['PHP_SELF']) == 'member.php' ? 'bg-white text-blue-700' : '' ?>">Member</a>
                </li>
            </ul>
        </div>
    </nav>
    <script>
        // Navbar toggle for mobile
        document.addEventListener('DOMContentLoaded', function () {
            const navToggle = document.getElementById('nav-toggle');
            const navMenu = document.getElementById('nav-menu');
            navToggle?.addEventListener('click', function () {
                navMenu.classList.toggle('hidden');
                navMenu.classList.toggle('flex');
            });
            // Optional: close menu when clicking outside (mobile)
            document.addEventListener('click', function(event) {
                if (!navMenu.contains(event.target) && !navToggle.contains(event.target) && window.innerWidth < 640) {
                    navMenu.classList.add('hidden');
                    navMenu.classList.remove('flex');
                }
            });
            // Show menu on resize if desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 640) {
                    navMenu.classList.remove('hidden');
                    navMenu.classList.add('flex');
                } else {
                    navMenu.classList.add('hidden');
                    navMenu.classList.remove('flex');
                }
            });
        });
    </script>
    <main class="p-4">
        <div class="container mx-auto flex flex-col gap-4">
            <div class="container mx-auto mt-6 bg-white p-6 rounded-md shadow-md">
        <button id="openModalBtn"
                class="border bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Tambahkan
                member</button>
        <br><br>
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
                    $qry_member=mysqli_query($conn,"select * from member");
                    $no=0;
                    while($data_member=mysqli_fetch_array($qry_member)){
                        $no++;
                ?>
                    <tr class="border-b border-gray-200 hover:bg-blue-50 transition">
                        <td class="px-4 py-2"><?=$no?></td>
                        <td class="px-4 py-2"><?=$data_member['nama_member']?></td>
                        <td class="px-4 py-2"><?=$data_member['alamat']?></td>
                        <td class="px-4 py-2"><?=$data_member['jenis_kelamin']?></td>
                        <td class="px-4 py-2"><?=$data_member['tlp']?></td>
                        <td class="px-4 py-2 flex gap-2 justify-center items-center">
                            <a class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded transition" href="ubah_member.php?id_member=<?=$data_member['id_member']?>">Edit</a>
                            <a class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition" href="hapus_member.php?id_member=<?=$data_member['id_member']?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')">Hapus</a>
                        </td>
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
                   <a href="member.php"> <button  type="button" class="mr-0 md:mr-2 px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700" onclick="document.getElementById('modalOutlet').classList.add('hidden')">Batal</button></a>
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