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
    <header class="bg-white shadow">
				<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
					<h1 class="text-3xl font-bold text-blue-700">Edit outlet</h1>
				</div>
			</header>
    <main class="flex-grow flex items-center justify-center">
        <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-10 mt-10">
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Form Ubah Data Outlet</h2>
                <p class="text-gray-500 text-sm">Silakan ubah data outlet di bawah ini dan klik submit untuk menyimpan perubahan.</p>
            </div>
            <?php 
                include "koneksi.php";
                $sql = 'select * from outlet where id_outlet = ' .$_GET['id_outlet'] ;
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_assoc($result);
            ?>
            <form action="proses_ubah_outlet.php" method="post" class="space-y-6">
                <input type="hidden" id="val-username" name="id_outlet" value="<?= $data['id_outlet']?>" readonly>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="nama">Nama Outlet <span class="text-red-500">*</span></label>
                    <input type="text" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition" id="nama" name="nama" placeholder="Nama outlet" value="<?= htmlspecialchars($data['nama']) ?>" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="alamat">Alamat <span class="text-red-500">*</span></label>
                    <input type="text" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition" id="alamat" name="alamat" placeholder="Alamat" value="<?= htmlspecialchars($data['alamat']) ?>" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="tlp">Telepon <span class="text-red-500">*</span></label>
                    <input type="text" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition" id="tlp" name="tlp" placeholder="Telepon" value="<?= htmlspecialchars($data['tlp']) ?>" required>
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