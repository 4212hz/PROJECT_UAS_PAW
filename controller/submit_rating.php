<?php
session_start();

include_once __DIR__ . '/../model/rating_model.php';

function get_connection() {
    return mysqli_connect("localhost", "root", "", "movie_rating");
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../controller/detailFilm_controller.php");
    exit();
}

if (!isset($_SESSION['id_user'])) {
    header("Location: ../view/login_view.php");
    exit();
}

$id_user = (int)$_SESSION['id_user'];
$id_film = isset($_POST['id_film']) ? (int)$_POST['id_film'] : 0;
$rating  = isset($_POST['rating']) ? (int)$_POST['rating'] : null;
$komentar = $_POST['comments'] ?? "";

if ($id_film <= 0 || $rating < 1 || $rating > 5) {
    header("Location: ../controller/detailFilm_controller.php?id=$id_film");
    exit();
}

$conn = get_connection();
$existing = get_user_rating($conn, $id_user, $id_film);

if ($existing == 0) {
    insert_rating($conn, $id_user, $id_film, $rating, $komentar);
} else {
    update_rating($conn, $id_user, $id_film, $rating, $komentar);
}

if (!empty($komentar)) {
    insert_comment($conn, $id_user, $id_film, $komentar);
}

mysqli_close($conn);

header("Location: ../controller/detailFilm_controller.php?id=$id_film");
exit();
