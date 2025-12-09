<?php
if (!function_exists('get_connection_rating')) {

function get_connection_rating() {
    return mysqli_connect("localhost", "root", "", "movie_rating");
}

function get_user_rating($conn, $id_user, $id_film) {
    $conn = get_connection_rating();
    $stmt = $conn->prepare("SELECT id_rating FROM ratings WHERE id_user = ? AND id_film = ?");
    $stmt->bind_param("ii", $id_user, $id_film);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row ? $row['id_rating'] : 0;
}

function insert_rating($conn, $id_user, $id_film, $rating, $komentar) {
    $conn = get_connection_rating();
    $stmt = $conn->prepare("
        INSERT INTO ratings (id_user, id_film, rating, komentar, tanggal_rating)
        VALUES (?, ?, ?, ?, NOW())
    ");
    $stmt->bind_param("iiis", $id_user, $id_film, $rating, $komentar);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function update_rating($conn, $id_user, $id_film, $rating, $komentar) {
    $conn = get_connection_rating();
    $stmt = $conn->prepare("
        UPDATE ratings 
        SET rating = ?, komentar = ?, tanggal_rating = NOW()
        WHERE id_user = ? AND id_film = ?
    ");
    $stmt->bind_param("isii", $rating, $komentar, $id_user, $id_film);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function get_average_rating($conn, $id_film) {
    $conn = get_connection_rating();
    $stmt = $conn->prepare("SELECT AVG(rating) AS avg_rating FROM ratings WHERE id_film = ?");
    $stmt->bind_param("i", $id_film);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    
    $average = $res['avg_rating'] ?? 0;
    return $average > 0 ? round($average, 1) : 0;
}

function insert_comment($conn, $id_user, $id_film, $komentar) {
    $conn = get_connection_rating();
    $stmt = $conn->prepare("
        INSERT INTO comments (id_user, id_film, komentar, tanggal_komentar)
        VALUES (?, ?, ?, NOW())
    ");
    $stmt->bind_param("iis", $id_user, $id_film, $komentar);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function get_total_ratings($conn, $id_film) {
    $conn = get_connection_rating();
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM ratings WHERE id_film = ?");
    $stmt->bind_param("i", $id_film);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $res['total'] ?? 0;
}
}

?>