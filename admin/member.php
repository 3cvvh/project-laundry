<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <title>Admin Laundry</title>
</head>

<body class="bg-gray-100">
    <header class="bg-blue-700 p-4 text-white">
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold">Welcome, Admin</h1>
        </div>
    </header>
    <main class="p-4">
        <div class="flex flex-row">

            <h2 class="text-3xl font-bold text-blue-700 text-left mt-0.5">LAUNDRY ADMIN</h2>
            <nav class="my-2">

            <ul class="flex justify-around gap-20 text-blue-700">
                <li><a href="index_admin.php" type="button" class="ml-10 font-bold text-black">Dashboard</a></li>
                <li><a href="transaksi.php" class="font-bold">transaksi</a></li>
                <li><a href="member.php" class="font-bold">member</a></li>
                <li><a href="outlet.php" class="font-bold">Outlet</a></li>
                <li><a href="user.php" class="font-bold">User</a></li>
                <li><a href="paket.php" class="font-bold">paket</a></li>
            </ul>
            <div class="container mx-auto mt-6 bg-white p-6 rounded-md shadow-md">
        <button id="openModalBtn"
                class="border bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Tambahkan
                member</button>
        <br><br>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="w-full bg-white border border-gray-200 text-sm rounded-lg overflow-hidden">
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
<?php $hasil =  mysqli_query($conn, "SELECT*FROM member");
$data = mysqli_fetch_assoc($hasil);

?>
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
                <select name="jenis_kelamin" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition" required>
								<option value="Laki-laki" <?= $data['jenis_kelamin']=='Laki-laki'?'selected':''; ?>>Laki-laki</option>
								<option value="Perempuan" <?= $data['jenis_kelamin']=='Perempuan'?'selected':''; ?>>Perempuan</option>
							</select>
                <div class="mb-6">
                    <label class="block text-gray-700 mb-1">No Telepon</label>
                    <input type="text" name="tlp" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div class="flex justify-end">
                   <a href="member.php"> <button  type="button" class="mr-2 px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700" onclick="document.getElementById('modalOutlet').classList.add('hidden')">Batal</button></a>
                    <button type="submit" name="submit" class="mr-2 px-4 py-2 rounded bg-blue-500 hover:bg-gray-300 text-black">tambah member</button>
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