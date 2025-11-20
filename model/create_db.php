<?php
$host = "localhost";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

echo "Koneksi MySQL OK<br>";

$sql = "CREATE DATABASE IF NOT EXISTS movie_rating 
        CHARACTER SET utf8mb4 
        COLLATE utf8mb4_unicode_ci";

if ($conn->query($sql) === TRUE) {
    echo "Database 'movie_rating' berhasil dibuat / sudah ada.<br>";
} else {
    die("Gagal membuat database: " . $conn->error);
}

$conn->select_db("movie_rating");
echo "Database 'movie_rating' dipilih.<br><br>";

$all_sql = [

"CREATE TABLE IF NOT EXISTS film_origin (
    id_origin INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    asal ENUM('SEKOLAH','LUAR_SEKOLAH') NOT NULL
) ENGINE=InnoDB",

"CREATE TABLE IF NOT EXISTS users (
    id_user INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    id_origin INT UNSIGNED NULL,
    tanggal_daftar DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_origin) REFERENCES film_origin(id_origin)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB",

"CREATE TABLE IF NOT EXISTS genres (
    id_genre INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_genre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB",

"INSERT INTO genres (nama_genre) VALUES 
 ('Action'),('Drama'),('Comedy'),('Horror'),('Romance')
",

"CREATE TABLE IF NOT EXISTS films (
    id_film INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    judul_film VARCHAR(200) NOT NULL,
    deskripsi TEXT,
    id_genre INT UNSIGNED NULL,
    tahun_rilis YEAR,
    poster VARCHAR(255),
    FOREIGN KEY (id_genre) REFERENCES genres(id_genre)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB",

"CREATE TABLE IF NOT EXISTS film_popularity (
    id_pop INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_film INT UNSIGNED NOT NULL,
    id_origin INT UNSIGNED NOT NULL,
    viral_score INT CHECK (viral_score BETWEEN 0 AND 100),
    update_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_film) REFERENCES films(id_film)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (id_origin) REFERENCES film_origin(id_origin)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB",

"CREATE TABLE IF NOT EXISTS ratings (
    id_rating INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_user INT UNSIGNED NOT NULL,
    id_film INT UNSIGNED NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    komentar TEXT,
    tanggal_rating DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (id_film) REFERENCES films(id_film)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB",

"CREATE TABLE IF NOT EXISTS comments (
    id_comment INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_user INT UNSIGNED NOT NULL,
    id_film INT UNSIGNED NOT NULL,
    komentar TEXT,
    tanggal_komentar DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (id_film) REFERENCES films(id_film)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB"

];

foreach ($all_sql as $query) {

    if ($conn->query($query) === TRUE) {
        echo "<span ;'>OK:</span> " . substr($query, 0, 40) . " ...<br>";
    } else {
        echo "<span ;'>ERROR:</span> " . $conn->error . "<br>";
    }
}

echo "<br><strong>SELESAI: Semua tabel berhasil dibuat!</strong>";

$conn->close();
?>