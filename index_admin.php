<?php 


?>
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
            <a href="admin/logout.php" class="bg-red-600 px-4 py-2 rounded hover:bg-red-700 font-bold">Logout</a>
        </div>
    </header>
    <main class="p-4">
        <div class="flex flex-row">

            <h2 class="text-3xl font-bold text-blue-700 text-left mt-0.5">LAUNDRY’SS ADMIN</h2>
            <nav class="my-2">

            <ul class="flex justify-around gap-20 text-blue-700">
                <li><a href="/laundry/index_admin.php" type="button" class="ml-10 font-bold text-black">Dashboard</a></li>
                <li><a href="/laundry/admin/transaksi.php" class="font-bold">transaksi</a></li>
                <li><a href="/laundry/admin/member.php" class="font-bold">member</a></li>
                <li><a href="/laundry/admin/outlet.php" class="font-bold">Outlet</a></li>
                <li><a href="/laundry/admin/user.php" class="font-bold">User</a></li>
                <li><a href="/laundry/admin/paket.php" class="font-bold">paket</a></li>
            </ul>
            
        </div>
   

        <main class="container mx-auto py-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center">
                    <h3 class="text-lg font-semibold">Jumlah User</h3>
                    <p class="text-4xl font-bold">1</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center">
                    <h3 class="text-lg font-semibold">Jumlah Transaksi</h3>
                    <p class="text-4xl font-bold">3</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center">
                    <h3 class="text-lg font-semibold">Jumlah Pelanggan</h3>
                    <p class="text-4xl font-bold">3</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center">
                    <h3 class="text-lg font-semibold">Jumlah Outlet</h3>
                    <p class="text-4xl font-bold">2</p>
                </div>
            </div>
        </main>

</body>

</html>