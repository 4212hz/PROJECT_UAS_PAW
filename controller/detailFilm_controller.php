<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../view/login_view.php");
    exit();
}

include_once '../model/detailFilm_model.php';
include_once '../model/rating_model.php';

function detailFilm_index() {
    global $conn;

    if (!isset($_GET['id'])) {
        echo "ID film tidak ditemukan!";
        exit();
    }

    $id_film = (int)$_GET['id'];

    // hitung rata-rata rating
    $avg_rating = get_average_rating($conn, $id_film);
    
    // hitung total user yang memberi rating
    $total_ratings = get_total_ratings($conn, $id_film);

    // ambil detail film
    $row = get_detailFilm_by_id($id_film);

    if (!$row) {
        echo "Film tidak ditemukan!";
        exit();
    }

    // ambil komentar dengan rating
    $comments = get_comments_by_film($id_film);

    // kirim ke view
    $data['avg_rating'] = $avg_rating;
    $data['total_ratings'] = $total_ratings;
    $data['film'] = $row;
    $data['comments'] = $comments;

    include_once '../view/dashboard/detail_film.php';
}

detailFilm_index();

?>