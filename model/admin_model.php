<?php

function get_connection() {
    $conn = mysqli_connect("localhost", "root", "", "movie_rating");
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
    return $conn;
}

function get_all_tables() {
    $conn = get_connection();
    $result = mysqli_query($conn, "SHOW TABLES");
    $tables = [];
    
    while ($row = mysqli_fetch_array($result)) {
        $tables[] = $row[0];
    }
    
    return $tables;
}

function get_all_data($table) {
    // Validasi: jika table null atau kosong, return array kosong
    if (!$table || trim($table) === '') {
        return [];
    }
    
    $conn = get_connection();
    
    switch ($table) {
        case "films":
            $sql = "SELECT films.*, genres.name_genre 
                    FROM films
                    LEFT JOIN genres ON genres.id_genre = films.id_genre
                    ORDER BY films.id_film DESC";
            break;
        case "users":
            $sql = "SELECT users.*, film_origin.asal
                    FROM users
                    LEFT JOIN film_origin ON film_origin.id_origin = users.id_origin
                    ORDER BY users.id_user DESC";
            break;
        case "ratings":
            $sql = "SELECT r.*, users.nama, films.judul_film
                    FROM ratings r
                    LEFT JOIN users ON users.id_user = r.id_user
                    LEFT JOIN films ON films.id_film = r.id_film
                    ORDER BY r.id_rating DESC";
            break;
        case "comments":
            $sql = "SELECT c.*, users.nama, films.judul_film
                    FROM comments c
                    LEFT JOIN users ON users.id_user = c.id_user
                    LEFT JOIN films ON films.id_film = c.id_film
                    ORDER BY c.id_comment DESC";
            break;
        case "film_popularity":
            $sql = "SELECT fp.*, films.judul_film, film_origin.asal
                    FROM film_popularity fp
                    LEFT JOIN films ON films.id_film = fp.id_film
                    LEFT JOIN film_origin ON film_origin.id_origin = fp.id_origin
                    ORDER BY fp.id_pop DESC";
            break;
        case "genres":
            $sql = "SELECT * FROM genres ORDER BY id_genre DESC";
            break;
        case "film_origin":
            $sql = "SELECT * FROM film_origin ORDER BY id_origin DESC";
            break;
        default:
            $sql = "SELECT * FROM $table ORDER BY 1 DESC";
            break;
    }
    
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function get_by_id($table, $id_field, $id) {
    if (!$table || !$id_field || !$id) {
        return null;
    }
    
    $conn = get_connection();
    $sql = "SELECT * FROM $table WHERE $id_field = '$id'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function get_columns($table) {
    // Validasi: jika table null atau kosong, return array kosong
    if (!$table || trim($table) === '') {
        return [];
    }
    
    $conn = get_connection();
    $result = mysqli_query($conn, "SHOW COLUMNS FROM $table");
    $columns = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $columns[] = $row['Field'];
    }
    return $columns;
}

function get_columns_info($table) {
    if (!$table) {
        return [];
    }
    
    $conn = get_connection();
    $result = mysqli_query($conn, "DESCRIBE $table");
    $columns = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $columns[] = [
            'name' => $row['Field'],
            'type' => $row['Type'],
            'null' => $row['Null'],
            'key' => $row['Key'],
            'default' => $row['Default'],
            'extra' => $row['Extra']
        ];
    }
    return $columns;
}

function get_primary_key($table) {
    // Hardcode mapping berdasarkan struktur database Anda
    $hardcoded_mapping = [
        'films' => 'id_film',
        'users' => 'id_user',
        'genres' => 'id_genre',
        'ratings' => 'id_rating',
        'comments' => 'id_comment',
        'film_origin' => 'id_origin',
        'film_popularity' => 'id_pop'
    ];
    
    return $hardcoded_mapping[$table] ?? null;
}

function get_foreign_keys($table) {
    if (!$table) {
        return [];
    }
    
    $conn = get_connection();
    $sql = "SELECT 
                COLUMN_NAME,
                REFERENCED_TABLE_NAME,
                REFERENCED_COLUMN_NAME
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = DATABASE()
            AND TABLE_NAME = '$table'
            AND REFERENCED_TABLE_NAME IS NOT NULL";
    
    $result = mysqli_query($conn, $sql);
    $foreign_keys = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $foreign_keys[$row['COLUMN_NAME']] = [
            'table' => $row['REFERENCED_TABLE_NAME'],
            'column' => $row['REFERENCED_COLUMN_NAME']
        ];
    }
    return $foreign_keys;
}

function get_foreign_options($foreign_table, $value_column, $display_column) {
    if (!$foreign_table || !$value_column) {
        return [];
    }
    
    $conn = get_connection();
    
    // Cek apakah kolom display ada
    $check_sql = "SHOW COLUMNS FROM $foreign_table LIKE '$display_column'";
    $check_result = mysqli_query($conn, $check_sql);
    
    // Jika kolom display tidak ada, gunakan value_column
    if (!$check_result || mysqli_num_rows($check_result) == 0) {
        $display_column = $value_column;
    }
    
    // Query dengan error handling
    $sql = "SELECT $value_column, $display_column FROM $foreign_table ORDER BY $value_column";
    
    try {
        $result = mysqli_query($conn, $sql);
        $options = [];
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $display = $row[$display_column] ?? "ID: " . $row[$value_column];
                $options[$row[$value_column]] = $display;
            }
        }
        
        return $options;
    } catch (Exception $e) {
        // Jika error, return array kosong
        error_log("Error in get_foreign_options: " . $e->getMessage());
        return [];
    }
}

function insert_data($table, $data, $files = []) {
    if (!$table || empty($data)) {
        return false;
    }
    
    $conn = get_connection();
    
    // Handle file upload
    foreach ($files as $field => $file) {
        if ($file['error'] == 0) {
            $filename = time() . '_' . $file['name'];
            $upload_dir = '../view/img/img_poster/';
            
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            if (move_uploaded_file($file['tmp_name'], $upload_dir . $filename)) {
                $data[$field] = $filename;
            }
        }
    }
    
    // Handle password hashing
    if ($table == 'users' && isset($data['password']) && !empty($data['password'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    }
    
    // Remove empty values
    $filtered_data = array_filter($data, function($value) {
        return $value !== '';
    });
    
    $columns = implode(', ', array_keys($filtered_data));
    $values = "'" . implode("', '", array_values($filtered_data)) . "'";
    
    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    return mysqli_query($conn, $sql);
}

function update_data($table, $id, $data, $files = []) {
    if (!$table || !$id || empty($data)) {
        error_log("ERROR update_data: Missing parameters - table:$table, id:$id");
        return false;
    }
    
    $conn = get_connection();
    
    // Dapatkan primary key dengan benar
    $id_field = get_primary_key($table);
    
    // DEBUG DETAILED
    error_log("DEBUG update_data: table=$table, id=$id, id_field=$id_field");
    error_log("DEBUG POST data received: " . print_r($data, true));
    
    // Jika id_field masih null, kita tidak bisa melanjutkan
    if (!$id_field) {
        error_log("ERROR: Cannot determine primary key for table $table");
        return false;
    }
    
    // Handle file upload
    foreach ($files as $field => $file) {
        if ($file['error'] == 0) {
            $filename = time() . '_' . $file['name'];
            $upload_dir = '../view/img/img_poster/';
            
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            if (move_uploaded_file($file['tmp_name'], $upload_dir . $filename)) {
                $data[$field] = $filename;
                
                // Delete old file if exists
                $old_file = $_POST['old_' . $field] ?? '';
                if ($old_file && file_exists($upload_dir . $old_file)) {
                    unlink($upload_dir . $old_file);
                }
            }
        }
    }
    
    // Handle password update
    if ($table == 'users' && isset($data['password'])) {
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
    }
    
    // Remove old_* fields and empty values
    // PERBAIKAN: Juga hapus field 'id' jika ada, karena itu dari form hidden
    $filtered_data = [];
    foreach ($data as $key => $value) {
        // Skip field yang tidak boleh ada di SET clause
        if (!str_starts_with($key, 'old_') && 
            $key !== 'id' && // HAPUS FIELD 'id' KARENA TIDAK ADA DI TABEL
            $value !== '') {
            $filtered_data[$key] = mysqli_real_escape_string($conn, $value);
        }
    }
    
    if (empty($filtered_data)) {
        error_log("ERROR: No data to update for table $table");
        return false;
    }
    
    $set_parts = [];
    foreach ($filtered_data as $column => $value) {
        $set_parts[] = "`$column` = '$value'";
    }
    
    // BUILD SQL dengan backticks untuk menghindari masalah reserved words
    $sql = "UPDATE `$table` SET " . implode(', ', $set_parts) . " WHERE `$id_field` = '$id'";
    
    error_log("DEBUG FINAL SQL: $sql");
    
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        error_log("MySQL Error: " . mysqli_error($conn));
        error_log("SQL that failed: $sql");
    }
    
    return $result;
}

function delete_data($table, $id_field, $id) {
    if (!$table || !$id_field || !$id) {
        return false;
    }
    
    $conn = get_connection();
    
    $sql = "DELETE FROM `$table` WHERE `$id_field` = '$id'";
    
    error_log("DEBUG SQL DELETE: $sql");
    
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        error_log("MySQL Delete Error: " . mysqli_error($conn));
    }
    
    return $result;
}

function get_enum_values($table, $column) {
    if (!$table || !$column) {
        return [];
    }
    
    $conn = get_connection();
    $sql = "SHOW COLUMNS FROM $table WHERE Field = '$column'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if (preg_match("/^enum\(\'(.*)\'\)$/", $row['Type'], $matches)) {
        $enum = explode("','", $matches[1]);
        return $enum;
    }
    
    return [];
}


/* =============================
   1. LAPORAN RATING FILM
============================= */

function get_laporan_rating() {
    $conn = get_connection();
    $query = "
        SELECT 
            f.judul_film,
            COUNT(r.id_rating) AS jumlah_rating,
            ROUND(AVG(r.rating), 2) AS rata_rata_rating
        FROM films f
        LEFT JOIN ratings r ON f.id_film = r.id_film
        GROUP BY f.id_film, f.judul_film
    ";
    return mysqli_query($conn, $query);
}

function get_film_rating_tertinggi() {
    $conn = get_connection();
    $query = "
        SELECT 
            f.judul_film, 
            ROUND(AVG(r.rating), 2) AS rata_rata_rating
        FROM films f
        JOIN ratings r ON f.id_film = r.id_film
        GROUP BY f.id_film, f.judul_film
        ORDER BY rata_rata_rating DESC
        LIMIT 1
    ";
    return mysqli_query($conn, $query);
}

function get_film_rating_terendah() {
    $conn = get_connection();
    $query = "
        SELECT 
            f.judul_film, 
            ROUND(AVG(r.rating), 2) AS rata_rata_rating
        FROM films f
        JOIN ratings r ON f.id_film = r.id_film
        GROUP BY f.id_film, f.judul_film
        ORDER BY rata_rata_rating ASC
        LIMIT 1
    ";
    return mysqli_query($conn, $query);
}

/* =============================
   2. LAPORAN WATCHLIST
============================= */

function get_laporan_watchlist() {
    $conn = get_connection();
    $query = "
        SELECT 
            f.judul_film,
            COUNT(w.id_watchlist) AS jumlah_watchlist
        FROM userwatchlist w
        JOIN films f ON w.id_film = f.id_film
        GROUP BY f.id_film, f.judul_film
        ORDER BY jumlah_watchlist DESC
    ";
    return mysqli_query($conn, $query);
}



?>
