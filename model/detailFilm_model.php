<?php

if (!function_exists('get_connection_detailFilm')) {

function get_connection_detailFilm() {
    return mysqli_connect("localhost", "root", "", "movie_rating");
}

function get_detailFilm_by_id($id_film) {
    $conn = get_connection_detailFilm();

    $id_film = mysqli_real_escape_string($conn, $id_film);

    $sql = "
        SELECT films.*, genres.name_genre FROM films 
        JOIN genres ON films.id_genre = genres.id_genre
        WHERE films.id_film = '$id_film'
    ";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    mysqli_close($conn);
    return $row;
}

function get_comments_by_film($id_film) {
    $conn = get_connection_detailFilm();

    $id_film = mysqli_real_escape_string($conn, $id_film);

    $sql = "
        SELECT c.id_comment, u.nama AS user_name, c.komentar, 
               c.tanggal_komentar, r.rating
        FROM comments c
        JOIN users u ON c.id_user = u.id_user
        LEFT JOIN ratings r ON c.id_user = r.id_user AND c.id_film = r.id_film
        WHERE c.id_film = '$id_film'
        ORDER BY c.tanggal_komentar DESC
    ";

    $result = mysqli_query($conn, $sql);

    $comments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row;
    }

    mysqli_close($conn);
    return $comments;
}

function prepare_film_detail_data($data) {
    $film = $data['film'];

    return [
        'id_film' => $film['id_film'],
        'judul_film' => $film['judul_film'],
        'name_genre' => $film['name_genre'],
        'tahun_rilis' => $film['tahun_rilis'],
        'deskripsi' => $film['deskripsi'],
        'poster' => $film['poster'],

        'avg_rating' => $data['avg_rating'],
        'total_ratings' => $data['total_ratings'],
        'rating_percentage' => ($data['avg_rating'] / 5) * 100,

        'comments' => $data['comments']
    ];
}

}
?>
