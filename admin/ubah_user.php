<?php 
session_start();
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
					<h1 class="text-3xl font-bold text-blue-700">Edit User</h1>
				</div>
			</header>
    <main class="flex-grow flex items-center justify-center">
        <div class="w-full max-w-md bg-white rounded-lg shadow p-8 mt-10">
            <div class="mb-6 text-center">
                <h2 class="text-xl font-semibold text-gray-800 mb-1">Ubah Data User</h2>
                <p class="text-gray-500 text-xs">Edit data user di bawah ini lalu klik simpan.</p>
            </div>
            <?php 
                include "koneksi.php";
                $sql = 'select * from user where id_user = ' .$_GET['id_user'] ;
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_assoc($result);
            ?>
            <form action="proses_ubah_user.php" method="post" class="space-y-4">
				<input type="hidden" name="id_user" value="<?= $data['id_user']?>">
                <div>
                    <label class="block text-gray-700 text-sm mb-1 font-medium">Nama User<span class="text-red-500">*</span></label>
                    <input type="text" name="nama_user" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm" value="<?= $data['nama_user']?>" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm mb-1 font-medium">Username<span class="text-red-500">*</span></label>
                    <input type="text" name="username" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm" value="<?= $data['username']?>" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm mb-1 font-medium">Password<span class="text-red-500">*</span></label>
                    <input type="text" name="password" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm" value="<?php echo $data["password"] ?>" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm mb-1 font-medium">Nama Outlet<span class="text-red-500">*</span></label>
                    <select name="id_outlet" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm" required>
                        <option value="">Pilih Outlet</option>
                        <?php
                            include "koneksi.php";
                            $qry_outlet=mysqli_query($conn,"select * from outlet");
                            while($data_outlet=mysqli_fetch_array($qry_outlet)){
                                $selek = ($data_outlet['id_outlet']==$data['id_outlet']) ? "selected" : "";
                                echo '<option value="'.$data_outlet['id_outlet'].'" '.$selek.'>'.$data_outlet['nama'].'</option>';   
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm mb-1 font-medium">Role User<span class="text-red-500">*</span></label>
                    <?php
	                    include "koneksi.php";
	                        $result = mysqli_query($conn, "SHOW COLUMNS FROM user LIKE 'role'");
	                        $row = mysqli_fetch_array($result);
	                        preg_match("/^enum\(\'(.*)\'\)$/", $row['Type'], $matches);
	                        $enum_values = explode("','", $matches[1]);
	                        ?>
                            <select name="role" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                             <option value="<?php echo $data['role']?>"><?php echo $data["role"] ?></option>
                             <?php foreach($enum_values as $role): ?>
                            <option value="<?= $role ?>"><?= ucfirst($role) ?></option>
                            <?php endforeach; ?>
                        </select>
                </div>
                <div class="flex justify-end gap-2 pt-4">
                    <button type="submit" class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm">Simpan</button>
                    <a href="../admin/user.php" class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold text-sm">Kembali</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>