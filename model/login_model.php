<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "movie_rating");
}

function get_user_login($nama, $password) {
    $conn = get_connection();

    $query = "SELECT * FROM users WHERE nama='$nama' AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}
?>