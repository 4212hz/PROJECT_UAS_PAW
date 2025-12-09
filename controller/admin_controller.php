<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../proyek_akhir/view/login_view.php");
    exit();
}

include '../model/admin_model.php';

function admin_index() {
    // $data = get_all_admin();
    include '../view/admin/admin_view.php';
}

admin_index();


?>
