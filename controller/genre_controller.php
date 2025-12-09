<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../proyek_akhir/view/login_view.php");
    exit();
}

include '../model/genre_model.php';

function genre_index() {
    $data = get_all_films_grouped_by_genre(); // Ubah fungsi ini
    include '../view/genre/genre_view.php';
}

genre_index();

?>