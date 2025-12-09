<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "movie_rating");
}

function get_all_films() {
    $conn = get_connection();
    $query = "
        SELECT f.*, g.name_genre, COALESCE(AVG(r.rating), 0) AS avg_rating
        FROM films f
        JOIN genres g ON f.id_genre = g.id_genre
        LEFT JOIN ratings r ON f.id_film = r.id_film
        GROUP BY f.id_film
        ORDER BY f.id_film ASC
    ";
    $result = mysqli_query($conn, $query);

    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    mysqli_close($conn);

    return $rows;
}


?>

