<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Login</title>
</head>
<body>
<?php
	if(isset($_GET['alert'])){
		if($_GET['alert']=="gagal"){
			echo "<p>Maaf! Username & Password Salah.</p>";
		}else if($_GET['alert']=="belum_login"){
			echo "<p>Anda Harus Login Terlebih Dulu!</p>";
		}else if($_GET['alert']=="logout"){
			echo "<p>Anda Telah Logout!</p>";
		}
	}
	?>
    <main>
        <div>
            <div>
                <div>
                    <div>
                        <div>
                            <div>
                                <div>
                                    <div>
                                        <h3>selamat datang kembali</h3>
                                        <p>silahkan login</p>
                                    </div>
                                    <form action="aksi.php" method="post">
                                        <div>
                                            <label for="exampleInputEmail1">username</label>
                                            <input type="text" id="exampleInputEmail1" name="username">
                                        </div>
                                        <div>
                                            <label for="exampleInputEmail1">password</label>
                                            <input type="password" id="exampleInputEmail1" name="password">
                                        </div>
                                        <button type="submit">login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>