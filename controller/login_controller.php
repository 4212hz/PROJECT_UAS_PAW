<?php
session_start();
include '../model/login_model.php';

function login_index() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = $_POST['nama'];
        $password = $_POST['password'];

        if (empty($nama) || empty($password)) {
            echo "<script>
                    alert('Nama dan password wajib diisi!');
                    window.location.href='../view/login_view.php';
                  </script>";
            exit();
        }

        $user = get_user_login($nama, $password);

        if ($user) {
            $_SESSION['login'] = true;
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['role'] = $user['role'] ?? 'user';
            
            header("Location: ../controller/dashboard_controller.php");
            exit;
        } else {
            echo "<script>
                    alert('Username atau password salah!');
                    window.location.href='../view/login_view.php';
                  </script>";
            exit();
        }
    }

    include '../view/login_view.php';
}

login_index();
?>
