<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <title>Admin Laundry</title>
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
    <header class="bg-blue-700 p-4 text-white">
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold">Welcome, Admin</h1>
        </div>
    </header>
    <main class="p-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h2 class="text-3xl font-bold text-blue-700">LAUNDRY’SS ADMIN</h2>
            <nav>
                <ul class="flex flex-wrap gap-6 text-blue-700 mt-4 md:mt-0">
                    <li><a href="/laundry/index_admin.php" class="font-bold text-black">Dashboard</a></li>
                    <li><a href="/laundry/admin/transaksi.php" class="font-bold">Transaksi</a></li>
                    <li><a href="/laundry/admin/member.php" class="font-bold">Member</a></li>
                    <li><a href="/laundry/admin/outlet.php" class="font-bold">Outlet</a></li>
                    <li><a href="/laundry/admin/user.php" class="font-bold">User</a></li>
                    <li><a href="/laundry/admin/paket.php" class="font-bold">Paket</a></li>
                </ul>
            </nav>
        </div>
        <div class="container mx-auto bg-white p-6 rounded-md shadow-md">
            <button id="openModalBtn"
                class="border bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Tambahkan
                outlet</button>
            <br><br>
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full bg-white border border-gray-200 text-sm rounded-lg overflow-hidden">
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
                        <button type="button" class="mr-2 px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700" onclick="document.getElementById('modalOutlet').classList.add('hidden')">Batal</button>
                        <input type="submit" name="simpan" value="Tambah Outlet" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white font-semibold cursor-pointer">
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