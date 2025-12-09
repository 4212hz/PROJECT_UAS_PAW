<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../view/login_view.php");
    exit();
}

include '../model/watchlist_model.php';

if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id_film'])) {
    $id_user = $_SESSION['id_user'];
    $id_film = $_GET['id_film'];

    $result = add_to_watchlist($id_user, $id_film);

    if ($result == "success") {
        echo "<script>alert('Berhasil ditambahkan ke Watchlist!'); window.history.back();</script>";
    } elseif ($result == "exists") {
        echo "<script>alert('Film sudah ada di Watchlist!'); window.history.back();</script>";
    } else {
        echo "<script>alert('Gagal menambahkan Watchlist!'); window.history.back();</script>";
    }
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id_film'])) {
    $id_film = $_GET['id_film'];
    $id_user = $_SESSION['id_user'];
    $conn = get_connection(); 

    $query = "DELETE FROM userwatchlist 
              WHERE id_film = '$id_film' AND id_user = '$id_user'";

    if (mysqli_query($conn, $query)) {
        header("Location: watchlist_controller.php");
        exit;
    } else {
        echo "Gagal menghapus data";
    }
}


function watchlist_index() {
    if (!isset($_SESSION['id_user'])) {
        die("Session id_user tidak ditemukan.");
    }

    $id_user = $_SESSION['id_user'];
    $data = get_all_watchlist($id_user);

    include '../view/watchlist/watchlist_view.php';
}


watchlist_index();

?>