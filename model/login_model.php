<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "movie_rating");
}

function get_user_login($nama, $password) {
    $conn = get_connection();

    $query = "SELECT * FROM users WHERE nama='$nama' AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $query);
<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "movie_rating");
}

function get_user_login($nama, $password) {
    $conn = get_connection();

    // Ambil user berdasarkan nama/email
    $query = "SELECT * FROM users WHERE nama = ? OR email = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $nama, $nama);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);
            
            // Verifikasi password yang di-hash
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        
        mysqli_stmt_close($stmt);
    }
    
    return false;
}
?>
    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

?>
