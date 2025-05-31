<?php
if($_POST){
    $nama_user = $_POST['nama_user'];
    $username = $_POST['username'];
    $password= $_POST['password'];
    $id_outlet = $_POST['id_outlet'];
    $role = $_POST['role'];
    $Password = password_hash($password, PASSWORD_DEFAULT);

if(empty($username)){
    echo "<script>alert('Username tidak boleh kosong');location.href='user.php';</script>";
    } elseif(empty($password)){
    echo "<script>alert('Password tidak boleh kosong');location.href='user.php';</script>";
    } else {
    include "koneksi.php";
    $insert=mysqli_query($conn,"insert into user
    (id_user, nama_user, username, password, id_outlet, role) 
    value
    ('"."','".$nama_user."','".$username."','".$password."','".$id_outlet."','".$role."')") or
    die(mysqli_error($conn));
if($insert){
    echo "<script>alert('Sukses menambahkan user');location.href='user.php';</script>";
} else {
    echo "<script>alert('Gagal menambahkan user');location.href='user.php';</script>";
}
}
}
?>