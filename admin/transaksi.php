<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
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
    <!-- Navbar -->
    <div class="bg-blue-700 py-6 px-4">
        <h1 class="text-4xl font-bold text-white mb-2">Welcome, Admin</h1>
    </div>
    <div class="bg-white py-4 px-4 shadow mb-8">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between">
            <h2 class="text-3xl font-bold text-blue-700">LAUNDRY’SS ADMIN</h2>
            <ul class="flex flex-wrap gap-6 mt-4 md:mt-0">
                <li><a href="index_admin.php" class="font-bold text-black">Dashboard</a></li>
                <li><a href="transaksi.php" class="font-bold text-blue-700">Transaksi</a></li>
                <li><a href="member.php" class="font-bold text-blue-700">Member</a></li>
                <li><a href="outlet.php" class="font-bold text-blue-700">Outlet</a></li>
                <li><a href="user.php" class="font-bold text-blue-700">User</a></li>
                <li><a href="paket.php" class="font-bold text-blue-700">Paket</a></li>
            </ul>
        </div>
    </div>
    <!-- Main Content -->
    <main class="p-8 max-w-7xl mx-auto">
        <div class="mb-8">
        <!-- Add Transaksi Button -->
        <div class="mb-6 flex justify-between items-center">
            <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow transition" onclick="document.getElementById('modalTransaksi').classList.remove('hidden')">
                Tambah Transaksi
            </button>
        </div>
        <!-- Transaksi Table -->
        <div class="bg-white rounded shadow p-2 md:p-6 overflow-x-auto">
            <div class="w-full overflow-x-auto">
            <table class="min-w-full table-auto text-xs md:text-sm">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-2 py-1 md:px-4 md:py-2 text-left">No</th>
                        <th class="px-2 py-1 md:px-4 md:py-2 text-left">Outlet</th>
                        <th class="px-2 py-1 md:px-4 md:py-2 text-left">Tanggal</th>
                        <th class="px-2 py-1 md:px-4 md:py-2 text-left">Batas Waktu</th>
                        <th class="px-2 py-1 md:px-4 md:py-2 text-left">Pembayaran</th>
                        <th class="px-2 py-1 md:px-4 md:py-2 text-left">Tanggal Dibayar</th>
                        <th class="px-2 py-1 md:px-4 md:py-2 text-left">Customer</th>
                        <th class="px-2 py-1 md:px-4 md:py-2 text-left">Paket</th>
                        <th class="px-2 py-1 md:px-4 md:py-2 text-left">Status Order</th>
                        <th class="px-2 py-1 md:px-4 md:py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php
                    include "koneksi.php";
                    $qry_transaksi=mysqli_query($conn,"select * from transaksi JOIN outlet ON outlet.id_outlet = transaksi.id_outlet JOIN member ON member.id_member = transaksi.id_member JOIN paket ON paket.id_paket = transaksi.id_paket");
                    $no=0;
                    while($data_transaksi=mysqli_fetch_array($qry_transaksi)){
                    $no++;?>
                    <tr class="border-b hover:bg-gray-50 md:table-row flex flex-col md:flex-row md:table-row w-full md:w-auto">
                        <td class="px-4 py-2 md:table-cell block" data-label="No"><?=$no?></td>
                        <td class="px-4 py-2 md:table-cell block" data-label="Outlet"><?=$data_transaksi['nama']?></td>
                        <td class="px-4 py-2 md:table-cell block" data-label="Tanggal"><?=$data_transaksi['tgl']?></td>
                        <td class="px-4 py-2 md:table-cell block" data-label="Batas Waktu"><?=$data_transaksi['batas_waktu']?></td>
                        <td class="px-4 py-2 md:table-cell block" data-label="Pembayaran"><?=$data_transaksi['dibayar']?></td>
                        <td class="px-4 py-2 md:table-cell block" data-label="Tanggal Dibayar"><?=$data_transaksi['tgl_bayar']?></td>
                        <td class="px-4 py-2 md:table-cell block" data-label="Customer"><?=$data_transaksi['nama_member']?></td>
                        <td class="px-4 py-2 md:table-cell block" data-label="Paket"><?=$data_transaksi['nama_paket']?></td>
                        <td class="px-4 py-2 md:table-cell block" data-label="Status Order"><?=$data_transaksi['status']?></td>
                        <td class="px-4 py-2 flex gap-2 md:table-cell block" data-label="Aksi">
                            <a href="./detail_transaksi.php?id_transaksi=<?php echo $data_transaksi['id_transaksi']?>" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition font-semibold">
                                Detail
                            </a>
                            <a href="./hapus_transaksi.php?id_transaksi=<?=$data_transaksi['id_transaksi']?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition font-semibold">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
        <!-- Modal -->
        <div id="modalTransaksi" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center border-b px-6 py-4">
                    <h2 class="text-lg font-semibold">Tambah Transaksi Laundry</h2>
                    <button class="text-gray-400 hover:text-gray-700" onclick="document.getElementById('modalTransaksi').classList.add('hidden')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <form method="POST" action="./proses_tambah_transaksi.php" enctype="multipart/form-data" class="px-6 py-4 space-y-4">
                    <input type="hidden" id="val-username" name="id_transaksi" value="<?= $data['id_transaksi']?>" readonly>
                    <div>
                        <label class="block text-gray-700 mb-1">Nama Outlet</label>
                        <select name="id_outlet" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">Pilih Outlet</option>
                            <?php
                            include "koneksi.php";
                            $qry_outlet=mysqli_query($conn,"select * from outlet");
                            while($data_outlet=mysqli_fetch_array($qry_outlet)){
                                echo '<option value="'.$data_outlet['id_outlet'].'">'.$data_outlet['nama'].' | '.$data_outlet['alamat'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Nama Member</label>
                        <select name="id_member" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">Pilih Member</option>
                            <?php
                            include "koneksi.php";
                            $qry_member=mysqli_query($conn,"select * from member");
                            while($data_member=mysqli_fetch_array($qry_member)){
                                echo '<option value="'.$data_member['id_member'].'">'.$data_member['nama_member'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Tanggal Order</label>
                        <input type="date" name="tgl" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Batas Waktu</label>
                        <input type="date" name="batas_waktu" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Nama Paket</label>
                        <select name="id_paket" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">Pilih Paket</option>
                            <?php
                            include "koneksi.php";
                            $qry_paket=mysqli_query($conn,"select * from paket");
                            while($data_paket=mysqli_fetch_array($qry_paket)){
                                echo '<option value="'.$data_paket['id_paket'].'">'.$data_paket['nama_paket'].' | '.$data_paket['jenis'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
                    <div>
                        <label class="block text-gray-700 mb-1">Status Order</label>
                        <?php
                        include "koneksi.php";
                        $result = mysqli_query($conn, "SHOW COLUMNS FROM transaksi LIKE 'status'");
                        $row = mysqli_fetch_array($result);
                        preg_match("/^enum\(\'(.*)\'\)$/", $row['Type'], $matches);
                        $enum_values = explode("','", $matches[1]);
                        ?>
                        <select name="status" class="w-full border border-gray-300 rounded px-3 py-2">
                            <option value="">Status order</option>
                            <?php foreach($enum_values as $status): ?>
                                <option value="<?= $status ?>"><?= ucfirst($status) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Status Bayar</label>
                        <?php
                        include "koneksi.php";
                        $result = mysqli_query($conn, "SHOW COLUMNS FROM transaksi LIKE 'dibayar'");
                        $row = mysqli_fetch_array($result);
                        preg_match("/^enum\(\'(.*)\'\)$/", $row['Type'], $matches);
                        $enum_values = explode("','", $matches[1]);
                        ?>
                        <select name="dibayar" class="w-full border border-gray-300 rounded px-3 py-2">
                            <option value="">Status Pembayaran</option>
                            <?php foreach($enum_values as $dibayar): ?>
                                <option value="<?= $dibayar ?>"><?= ucfirst($dibayar) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1" for="qty">Berat cucian</label>
                        <input type="number" name="qty" id="qty" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Masukkan jumlah berat cucian" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1" for="keterangan">Catatan</label>
                        <textarea name="keterangan" id="keterangan" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                    </div>
                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700" onclick="document.getElementById('modalTransaksi').classList.add('hidden')">Batal</button>
                        <input type="submit" name="simpan" value="Tambah Transaksi" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white font-semibold cursor-pointer">
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
<style>
</style>
</html>