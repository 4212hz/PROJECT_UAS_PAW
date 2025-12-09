<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "movie_rating");
}

function get_signup($nama, $email, $password, $status) {
    $conn = get_connection();

    $query = "INSERT INTO users (nama, email, password, id_origin) 
                VALUES ('$nama', '$email', '$password', '$status')";

    $result = mysqli_query($conn, $query);
    
    mysqli_close($conn);

    return $result ? true : false;

}
?>