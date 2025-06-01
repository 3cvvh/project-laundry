<?php
include "admin/koneksi.php";
session_start();
if(isset($_SESSION["login"])){
    if($_SESSION["role"] === "admin"){
        header("Location: admin/index_admin.php");
        exit;
    }elseif($_SESSION["role"] === "kasir"){
        header("Location: kasir/index_kasir.php");
        exit;
    }elseif($_SESSION["role"] === "owner"){
        header("Location: owner/index_owner.php");
        exit;
    }
}
if(isset($_POST["submit"])){
    $user = $_POST["username"];
    $pass = $_POST["password"];
    $query = "SELECT*FROM user WHERE username = '$user'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_assoc($result);
        if($pass === $row["password"]){{ 
            $_SESSION["role"] = $row["role"];
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
    } else {
        $error1 = true;
    }
}
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
            <h2 class="text-3xl font-bold text-blue-600 mb-6 text-left">Login</h2>
            <?php if(isset($error)): ?>
            <div class="text-red-500 text-sm mb-4">
                <p>Password salah!</p>
            </div>
            <?php elseif(isset($error1)): ?>
            <div class="text-red-500 text-sm mb-4">
                <p>Username salah!</p>
            </div>
            <?php endif; ?>
            <form action="" method="post" class="space-y-6">
                <div>
                    <label for="username" class="block text-gray-700 font-semibold mb-1">Username</label>
                    <input type="text" id="username" name="username" class="w-full px-4 py-2 border border-blue-400 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <button type="submit" name="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded transition duration-200 text-lg">Log in</button>
            </form>
        </div>
    </main>
</body>
</html>