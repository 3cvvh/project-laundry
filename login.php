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
        if($pass === $row["password"]){ 
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Login</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pacifico:400&display=swap">
  <style>
    body {
      min-height: 100vh;
      background: linear-gradient(180deg, #2563eb 0%, #60a5fa 100%);
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
    .font-pacifico {
      font-family: 'Pacifico', cursive;
    }
    .glass {
      background: rgba(255,255,255,0.20);
      box-shadow: 0 8px 32px 0 rgba(37,99,235,0.15);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border-radius: 1.5rem;
      border: 1px solid rgba(96,165,250,0.25);
    }
    @media (max-width: 1024px) {
      .glass {
        padding-left: 2rem !important;
        padding-right: 2rem !important;
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
      }
    }
    @media (max-width: 640px) {
      .glass {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
        padding-top: 1.5rem !important;
        padding-bottom: 1.5rem !important;
      }
      .max-w-md, .max-w-lg {
        max-width: 100% !important;
      }
      .text-4xl { font-size: 2rem !important; }
      .text-2xl { font-size: 1.3rem !important; }
    }
    @media (max-width: 400px) {
      .glass {
        padding-left: 0.5rem !important;
        padding-right: 0.5rem !important;
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
      }
      .text-4xl { font-size: 1.3rem !important; }
      .text-2xl { font-size: 1rem !important; }
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center px-2" style="background: linear-gradient(180deg, #2563eb 0%, #60a5fa 100%);">
  <div class="absolute inset-0 -z-10 bg-gradient-to-b from-blue-600 via-blue-300 to-blue-100">
    <!-- Decorative background, can add SVG or shapes here if needed -->
  </div>
  <main class="w-full max-w-lg mx-auto">
    <div class="glass px-8 py-10 flex flex-col items-center">
      <h2 class="text-4xl font-pacifico text-blue-700 mb-1">Welcome</h2>
      <h3 class="text-2xl font-pacifico text-blue-800 mb-2">to the Laundry</h3>
      <p class="text-blue-900/90 text-sm mb-6">Login terlebih dahulu sebelum mengakses website laundry</p>
      <form action="" method="post" class="w-full max-w-md mx-auto bg-white/80 rounded-2xl shadow-md px-6 py-8 mt-2">
        <h4 class="text-center text-blue-700 font-semibold text-lg mb-6 tracking-widest">USER LOGIN</h4>
        <?php if(isset($error)): ?>
        <div class="text-red-500 text-sm mb-4 text-center">
            <p>Password salah!</p>
        </div>
        <?php elseif(isset($error1)): ?>
        <div class="text-red-500 text-sm mb-4 text-center">
            <p>Username salah!</p>
        </div>
        <?php endif; ?>
        <div class="flex flex-col gap-4">
          <div class="flex items-center bg-white rounded-full px-4 py-2 shadow">
            <span class="material-icons text-blue-400 mr-2">person</span>
            <input type="text" id="username" name="username" placeholder="Username" class="flex-1 bg-transparent outline-none text-blue-700 font-semibold" required>
          </div>
          <div class="flex items-center bg-white rounded-full px-4 py-2 shadow">
            <span class="material-icons text-blue-400 mr-2">lock</span>
            <input type="password" id="password" name="password" placeholder="Password" class="flex-1 bg-transparent outline-none text-blue-700 font-semibold" required>
          </div>
        </div>
        <div class="flex items-center justify-between mt-4 mb-6 text-xs text-blue-700">
        </div>
        <button type="submit" name="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-full transition duration-200 text-lg tracking-widest">LOGIN</button>
      </form>
    </div>
  </main>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</body>
</html>