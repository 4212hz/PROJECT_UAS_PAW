<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "movie_rating");
}

function add_contact_us($name, $email, $phone, $message_type, $message) {
    $conn = get_connection();

    $query = "INSERT INTO contact_us (name, email, phone, message_type, message) 
              VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone, $message_type, $message);

    if (mysqli_stmt_execute($stmt)) {
        return true; 
    } else {
        return false;
    }
}

?>