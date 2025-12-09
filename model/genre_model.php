<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "movie_rating");
}

// Fungsi untuk mendapatkan semua genre
function get_all_genres() {
    $conn = get_connection();
    $query = "SELECT * FROM genres ORDER BY id_genre ASC";
    $result = mysqli_query($conn, $query);
    
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    mysqli_close($conn);
    
    return $rows;
}

// Fungsi untuk mendapatkan film berdasarkan genre
function get_films_by_genre($id_genre) {
    $conn = get_connection();
    $query = "
        SELECT f.*, g.name_genre, COALESCE(AVG(r.rating), 0) AS avg_rating
        FROM films f
        JOIN genres g ON f.id_genre = g.id_genre
        LEFT JOIN ratings r ON f.id_film = r.id_film
        WHERE f.id_genre = $id_genre
        GROUP BY f.id_film
        ORDER BY avg_rating DESC
    ";
    $result = mysqli_query($conn, $query);
    
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    mysqli_close($conn);
    
    return $rows;
}

// Fungsi untuk mendapatkan semua film yang dikelompokkan per genre
function get_all_films_grouped_by_genre() {
    $genres = get_all_genres();
    $result = [];
    
    foreach($genres as $genre) {
        $result[] = [
            'genre' => $genre,
            'films' => get_films_by_genre($genre['id_genre'])
        ];
    }
    
    return $result;
}

?>