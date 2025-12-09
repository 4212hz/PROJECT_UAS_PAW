<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "movie_rating");
}

function get_user_login($nama, $password) {
    $conn = get_connection();

    // Ambil user berdasarkan nama/email
    $nama = mysqli_real_escape_string($conn, $nama);
    $query = "SELECT * FROM users WHERE nama = '$nama' OR email = '$nama' LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password yang di-hash
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }
    
    return false;
}
?>