<?php

session_start();

include '../model/contact_model.php';

function contact_controller() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message_type = $_POST['message_type'];
        $message = $_POST['message'];

        if (empty($name) || empty($email) || empty($phone) || empty($message_type) || empty($message)) {
            echo "<script>
                    alert('Seluruh field wajib diisi!');
                    window.location.href='../view/login_view.php';
                </script>";
            exit();
        }

        $user = add_contact_us($name, $email, $phone, $message_type, $message);

        if ($user) {
                header("Location: ../controller/dashboard_controller.php");
                exit;
            } 
        }
    }
    contact_controller();
?>