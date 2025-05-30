<?php 
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
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
    <!-- Navbar -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-blue-700">Edit Paket</h1>
        </div>
    </header>
    <main class="flex-grow flex items-center justify-center">
        <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-10 mt-10">
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Form Ubah Data Paket</h2>
                <p class="text-gray-500 text-sm">Silakan ubah data paket di bawah ini dan klik submit untuk menyimpan perubahan.</p>
            </div>
            <?php 
                include "koneksi.php";
                $sql = 'select * from paket where id_paket = ' .$_GET['id_paket'] ;
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_assoc($result);
            ?>
            <form action="proses_ubah_paket.php" method="post" class="space-y-6">
                <input type="hidden" id="val-username" name="id_paket" value="<?= $data['id_paket']?>" readonly>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="id_outlet">Nama Outlet <span class="text-red-500">*</span></label>
                    <select name="id_outlet" id="id_outlet" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition" required>
                        <option value="">Pilih Outlet</option>
                        <?php
                            $qry_outlet=mysqli_query($conn,"select * from outlet");
                            while($data_outlet=mysqli_fetch_array($qry_outlet)){
                                $selek = ($data_outlet['id_outlet']==$data['id_outlet']) ? "selected" : "";
                                echo '<option value="'.$data_outlet['id_outlet'].'" '.$selek.'>'.$data_outlet['nama'].'</option>';   
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="jenis">Jenis <span class="text-red-500">*</span></label>
                    <select name="jenis" id="jenis" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition" required>
                        <option value="">Pilih Jenis</option>
                        <option value="kiloan" <?= $data['jenis']=='kiloan'?'selected':''; ?>>Kiloan</option>
                        <option value="selimut" <?= $data['jenis']=='selimut'?'selected':''; ?>>Selimut</option>
                        <option value="bed_cover" <?= $data['jenis']=='bed_cover'?'selected':''; ?>>Bed Cover</option>
                        <option value="kaos" <?= $data['jenis']=='kaos'?'selected':''; ?>>Kaos</option>
                        <option value="lain" <?= $data['jenis']=='lain'?'selected':''; ?>>Lain</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="nama_paket">Nama Paket <span class="text-red-500">*</span></label>
                    <input type="text" id="nama_paket" name="nama_paket" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition" placeholder="Nama paket..." value="<?= htmlspecialchars($data['nama_paket']) ?>" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="harga">Harga <span class="text-red-500">*</span></label>
                    <input type="number" id="harga" name="harga" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition" placeholder="Harga..." value="<?= htmlspecialchars($data['harga']) ?>" required>
                </div>
                <div class="flex justify-between mt-10">
                    <button type="submit" class="px-8 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Submit</button>
                    <a href="paket.php" class="px-8 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">Kembali</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>