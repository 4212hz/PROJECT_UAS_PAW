<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../proyek_akhir/controller/login_controller.php");
    exit();
}

include '../model/dashboard_model.php';

function dashboard_index() {
    $top_films = get_top_films(10); 
    $data = get_all_dashboard();
    include '../view/dashboard/dashboard_view.php';
}

dashboard_index()

?>
