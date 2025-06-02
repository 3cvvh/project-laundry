<?php 
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'kasir') {
    header("Location: ../login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Laundry App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=dataset" />
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navbar Baru -->
    <header class="bg-white shadow mb-8">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
    
                <span class="text-xl font-bold text-blue-700 tracking-wide">Laundry Admin</span>
            </div>
        </div>
    </header>
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-8">
            <h1 class="text-2xl font-bold mb-4 text-gray-800">Ubah Detail Transaksi</h1>
            <?php 
include "koneksi.php";
if (!isset($_GET['id_transaksi'])) {
    echo "<div class='text-red-500'>ID Transaksi tidak ditemukan.</div>";
    exit;
}
$id_transaksi = intval($_GET['id_transaksi']);
$sql = "SELECT * FROM transaksi JOIN detail_transaksi ON detail_transaksi.id_transaksi=transaksi.id_transaksi WHERE transaksi.id_transaksi = $id_transaksi";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
?>
            <form action="./proses_ubah_detail_transaksi.php" method="post" class="space-y-6">
                <input type="hidden" name="id_transaksi" value="<?= $data['id_transaksi']?>">
                <div>
                    <label class="block font-semibold mb-1" for="dibayar">Status Pembayaran <span class="text-red-500">*</span></label>
                    <?php
	                    include "koneksi.php";
	                        $result = mysqli_query($conn, "SHOW COLUMNS FROM transaksi LIKE 'dibayar'");
	                        $row = mysqli_fetch_array($result);
	                        preg_match("/^enum\(\'(.*)\'\)$/", $row['Type'], $matches);
	                        $enum_values = explode("','", $matches[1]);
	                        ?>
                            <select name="dibayar" class="w-full border border-gray-300 rounded px-3 py-2">
                             <option value="<?php echo $data['dibayar']?>">Status Pembayaran</option>
                             <?php foreach($enum_values as $dibayar): ?>
                            <option value="<?= $dibayar ?>"><?= ucfirst($dibayar) ?></option>
                            <?php endforeach; ?>
                        </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1" for="tgl_bayar">Tanggal Bayar <span class="text-red-500">(Jika Status Pembayaran bukan &quot;dibayar&quot; tidak usah diisi)</span></label>
                    <input type="date" class="form-input w-full border border-gray-300 rounded px-3 py-2" id="tgl_bayar" name="tgl_bayar" value="<?= $data['tgl_bayar']?>">
                </div>
                <div>
                    <label class="block font-semibold mb-1" for="status">Status Order <span class="text-red-500">*</span></label>
                    <?php
	                    include "koneksi.php";
	                        $result = mysqli_query($conn, "SHOW COLUMNS FROM transaksi LIKE 'status'");
	                        $row = mysqli_fetch_array($result);
	                        preg_match("/^enum\(\'(.*)\'\)$/", $row['Type'], $matches);
	                        $enum_values = explode("','", $matches[1]);
	                        ?>
                            <select name="status" class="w-full border border-gray-300 rounded px-3 py-2">
                             <option value="<?php echo $data['status']?>">Status Order</option>
                             <?php foreach($enum_values as $status): ?>
                            <option value="<?= $status ?>"><?= ucfirst($status) ?></option>
                            <?php endforeach; ?>
                        </select>
                </div>
                <div class="flex space-x-4 pt-4">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Submit</button>
                    <a href="detail_transaksi.php?id_transaksi=<?= $data['id_transaksi'] ?>" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400 transition">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>