<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../controller/login_controller.php");
    exit();
}

include '../model/watchlist_model.php';
$action = $_GET['action'] ?? 'index';

if ($action == 'add') {
    tambahWatchlist();
} else {
    tambahWatchlist_index();
}

function tambahWatchlist_index() {
    $films = get_all_films();
    include '../view/watchlist/tambahWatchlist_view.php';
}

function tambahWatchlist() {
    $id_user = $_SESSION['id_user'];
    $id_film = $_POST['id_film'] ?? '';
    
    if ($id_film == '') {
        echo "<script>alert('Silakan pilih film'); window.history.back();</script>";
        exit;
    }

    $result = add_to_watchlist($id_user, $id_film);

    if ($result == "success") {
        echo "<script>alert('Berhasil ditambahkan ke Watchlist'); window.location.href='watchlist_controller.php';</script>";
    } elseif ($result == "exists") {
        echo "<script>alert('Film sudah ada di Watchlist'); window.history.back();</script>";
    } else {
        echo "<script>alert('Gagal menambahkan Watchlist'); window.history.back();</script>";
    }
}
?>
