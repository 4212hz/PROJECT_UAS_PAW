<?php
if (!function_exists('get_connection_rating')) {

function get_connection_rating() {
    return mysqli_connect("localhost", "root", "", "movie_rating");
}

function get_user_rating($conn, $id_user, $id_film) {
    $conn = get_connection_rating();

    $id_user = mysqli_real_escape_string($conn, $id_user);
    $id_film = mysqli_real_escape_string($conn, $id_film);

    $sql = "
        SELECT id_rating 
        FROM ratings 
        WHERE id_user = '$id_user' AND id_film = '$id_film'
    ";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return $row ? $row['id_rating'] : 0;
}

function insert_rating($conn, $id_user, $id_film, $rating, $komentar) {
    $conn = get_connection_rating();

    $id_user = mysqli_real_escape_string($conn, $id_user);
    $id_film = mysqli_real_escape_string($conn, $id_film);
    $rating = mysqli_real_escape_string($conn, $rating);
    $komentar = mysqli_real_escape_string($conn, $komentar);

    $sql = "
        INSERT INTO ratings (id_user, id_film, rating, komentar, tanggal_rating)
        VALUES ('$id_user', '$id_film', '$rating', '$komentar', NOW())
    ";

    return mysqli_query($conn, $sql);
}

function update_rating($conn, $id_user, $id_film, $rating, $komentar) {
    $conn = get_connection_rating();

    $id_user = mysqli_real_escape_string($conn, $id_user);
    $id_film = mysqli_real_escape_string($conn, $id_film);
    $rating = mysqli_real_escape_string($conn, $rating);
    $komentar = mysqli_real_escape_string($conn, $komentar);

    $sql = "
        UPDATE ratings
        SET rating = '$rating', komentar = '$komentar', tanggal_rating = NOW()
        WHERE id_user = '$id_user' AND id_film = '$id_film'
    ";

    return mysqli_query($conn, $sql);
}

function get_average_rating($conn, $id_film) {
    $conn = get_connection_rating();

    $id_film = mysqli_real_escape_string($conn, $id_film);

    $sql = "SELECT AVG(rating) AS avg_rating FROM ratings WHERE id_film = '$id_film'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    $average = $res['avg_rating'] ?? 0;
    return $average > 0 ? round($average, 1) : 0;
}

function insert_comment($conn, $id_user, $id_film, $komentar) {
    $conn = get_connection_rating();

    $id_user = mysqli_real_escape_string($conn, $id_user);
    $id_film = mysqli_real_escape_string($conn, $id_film);
    $komentar = mysqli_real_escape_string($conn, $komentar);

    $sql = "
        INSERT INTO comments (id_user, id_film, komentar, tanggal_komentar)
        VALUES ('$id_user', '$id_film', '$komentar', NOW())
    ";

    return mysqli_query($conn, $sql);
}

function get_total_ratings($conn, $id_film) {
    $conn = get_connection_rating();

    $id_film = mysqli_real_escape_string($conn, $id_film);

    $sql = "SELECT COUNT(*) AS total FROM ratings WHERE id_film = '$id_film'";

    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res['total'] ?? 0;
}

}
?>
