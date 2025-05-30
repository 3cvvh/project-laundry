<?php 
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		<title>Laundry App</title>
		<meta name="description" content="Jet admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="keywords" content="Jet theme, bootstrap, bootstrap 5, admin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
		<link rel="canonical" href="Https://preview.keenthemes.com/jet-free" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<script src="https://cdn.tailwindcss.com"></script>
	</head>
	<body class="bg-gray-100 min-h-screen">
		<div class="flex flex-col min-h-screen">
			<header class="bg-white shadow">
				<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
					<h1 class="text-3xl font-bold text-blue-700">Edit Member</h1>
				</div>
			</header>
			<main class="flex-grow flex items-center justify-center">
				<div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-10 mt-10">
					<div class="mb-8 text-center">
						<h2 class="text-2xl font-semibold text-gray-800 mb-2">Form Ubah Data Member</h2>
						<p class="text-gray-500 text-sm">Silakan ubah data member di bawah ini dan klik submit untuk menyimpan perubahan.</p>
					</div>
					<?php 
						include "koneksi.php";
						$sql = 'select * from member where id_member = ' .$_GET['id_member'] ;
						$result = mysqli_query($conn, $sql);
						$data = mysqli_fetch_assoc($result);
					?>
					<form action="./proses_ubah_member.php" method="post" class="space-y-6">
						<input type="hidden" id="val-username" name="id_member" value="<?= $data['id_member']?>" readonly>
						<div>
							<label for="val-email" class="block text-sm font-medium text-gray-700 mb-1">Nama Member <span class="text-red-500">*</span></label>
							<input type="text" id="val-email" name="nama_member" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition" placeholder="Masukkan nama member..." value="<?= htmlspecialchars($data['nama_member']) ?>" required>
						</div>
						<div>
							<label for="val-alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Member <span class="text-red-500">*</span></label>
							<input type="text" id="val-alamat" name="alamat" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition" placeholder="Masukkan alamat..." value="<?= htmlspecialchars($data['alamat']) ?>" required>
						</div>
						<div>
							<label for="val-jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
							<select id="val-jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition" required>
								<option value="Laki-laki" <?= $data['jenis_kelamin']=='Laki-laki'?'selected':''; ?>>Laki-laki</option>
								<option value="Perempuan" <?= $data['jenis_kelamin']=='Perempuan'?'selected':''; ?>>Perempuan</option>
							</select>
						</div>
						<div>
							<label for="val-tlp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon <span class="text-red-500">*</span></label>
							<input type="text" id="val-tlp" name="tlp" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-blue-600 focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition" placeholder="Masukkan nomor telepon..." value="<?= htmlspecialchars($data['tlp']) ?>" required>
						</div>
						<div class="flex justify-between mt-10">
							<button type="submit" class="px-8 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Submit</button>
							<a href="./member.php" class="px-8 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">Kembali</a>
						</div>
					</form>
				</div>
			</main>
		</div>
	</body>
</html>