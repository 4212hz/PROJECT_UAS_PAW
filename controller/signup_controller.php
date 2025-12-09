<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: ../proyek_akhir/view/dashboard/dashboard_view.php");
    exit();
}

include '../model/signup_model.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $status   = $_POST['status']; // id_origin (1 atau 2)

    // Validasi sederhana
    if (empty($nama) || empty($email) || empty($_POST['password']) || empty($status)) {
        echo "<script>alert('Semua field wajib diisi!'); history.back();</script>";
        exit;
    }

    // Panggil fungsi model
    if (get_signup($nama, $email, $password, $status)) {
        echo "<script>
                alert('Berhasil mendaftar!');
                window.location.href='../view/login_view.php';
              </script>";
    } else {
        echo "<script>alert('Gagal mendaftar, coba lagi.'); history.back();</script>";
    }
}

// Tampilkan form Sign Up
include '../view/signup.php';
?>
    