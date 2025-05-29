<?php
include "admin/koneksi.php";
session_start();
if(isset($_POST["submit"])){
    $user = $_POST["username"];
    $pass = $_POST["password"];
    $query = "SELECT*FROM user WHERE username = '$user'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_assoc($result);
        if($pass === $row["password"]){
            if($row["role"] === "admin"){
                $_SESSION["login"] = true;
                $_SESSION["id_user"] = $row["id_user"];
                 header("Location: admin/index_admin.php");
            }elseif($row["role"] === "kasir"){
                $_SESSION["login"] = true;
                $_SESSION["id_user"] = $row["id_user"];
             header("Location: kasir/index_kasir.php");
        }elseif($row["role"] === "owner"){
                $_SESSION["login"] = true;
                $_SESSION["id_user"] = $row["id_user"];
                header("Location: owner/index_owner.php");
            }
            exit;
    }
    $error = true;
    
}
$error1 = true;    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Login</title>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <main class="w-full max-w-md mx-auto">
        <div class="bg-white shadow-lg rounded-lg px-8 py-10">
            <div class="mb-8 text-center">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang Kembali</h3>
                <p class="text-gray-500">Silahkan login untuk melanjutkan</p>
            </div>
            <?php if(isset($error)): ?>
            <div class="text-red-500 text-sm mb-4">
                <p> Password salah!</p>
            </div>
            <?php elseif(isset($error1)): ?>
            <div class="text-red-500 text-sm mb-4">
                <p>Username salah!</p>
            </div>
            <?php endif; ?>
            <form action="" method="post" class="space-y-6">
                <div>
                    <label for="username" class="block text-gray-700 font-semibold mb-1">Username</label>
                    <input type="text" id="username" name="username" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div>
                    <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <button type="submit" name="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded transition duration-200">Login</button>
            </form>
        </div>
    </main>
</body>
</html>