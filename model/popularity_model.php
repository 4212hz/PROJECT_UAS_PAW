<?php

function get_popularity_data($id_film = null) {
    $conn = get_connection();

    
    $query_top = "
        SELECT f.*, g.name_genre, COALESCE(AVG(r.rating), 0) AS avg_rating
        FROM films f
        JOIN genres g ON f.id_genre = g.id_genre
        LEFT JOIN ratings r ON f.id_film = r.id_film
        GROUP BY f.id_film
        ORDER BY avg_rating DESC
        LIMIT 10
    ";
    $top = mysqli_query($conn, $query_top);

    $top_films = [];
    while ($row = mysqli_fetch_assoc($top)) {
        $top_films[] = $row;
    }

    mysqli_close($conn);

    return [
        "top_films" => $top_films
    ];
}
?>
