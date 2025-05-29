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
            <h2 class="text-3xl font-bold text-blue-700">LAUNDRY ADMIN</h2>
            <nav>
                <ul class="flex flex-wrap gap-6 text-blue-700 mt-4 md:mt-0">
                    <li><a href="index_admin.php" class="font-bold text-black">Dashboard</a></li>
                    <li><a href="transaksi.php" class="font-bold">Transaksi</a></li>
                    <li><a href="member.php" class="font-bold">Member</a></li>
                    <li><a href="outlet.php" class="font-bold">Outlet</a></li>
                    <li><a href="user.php" class="font-bold">User</a></li>
                    <li><a href="paket.php" class="font-bold">Paket</a></li>
                </ul>
            </nav>
        </div>
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