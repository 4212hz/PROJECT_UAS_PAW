<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "movie_rating");
}

function get_all_watchlist($id_user) {
    $conn = get_connection();
    $query = "SELECT 
            f.*, 
            g.name_genre, 
            COALESCE(AVG(r.rating), 0) AS avg_rating
          FROM userwatchlist uw
          JOIN films f ON uw.id_film = f.id_film
          JOIN genres g ON f.id_genre = g.id_genre
          LEFT JOIN ratings r ON f.id_film = r.id_film
          WHERE uw.id_user = '$id_user'
          GROUP BY f.id_film
          ORDER BY f.id_film ASC";

    $result = mysqli_query($conn, $query);

    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    mysqli_close($conn);
    return $rows;
}

function get_all_films() {
    $conn = get_connection();
    $query = "SELECT id_film, judul_film FROM films";
    return mysqli_query($conn, $query);
}

function add_to_watchlist($id_user, $id_film) {
    $conn = get_connection();

    $cek = mysqli_query($conn, 
        "SELECT id_watchlist FROM userwatchlist 
         WHERE id_user='$id_user' AND id_film='$id_film'"
    );

    if (mysqli_num_rows($cek) > 0) {
        return "exists";
    }

    $query = "INSERT INTO userwatchlist (id_user, id_film) 
              VALUES ('$id_user', '$id_film')";

    if (mysqli_query($conn, $query)) {
        return "success";
    } else {
        return "error";
    }
}



?>