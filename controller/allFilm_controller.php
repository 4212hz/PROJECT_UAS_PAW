<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../proyek_akhir/view/login_view.php");
    exit();
}

include '../model/allFilm_model.php';

function genre_index() {
    $data = get_all_films();
    include '../view/dashboard/all_films.php';
}

genre_index();


?>
