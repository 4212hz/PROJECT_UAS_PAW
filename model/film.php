
<?php

    include_once "koneksi.php";  

    function getAllFilms() {
        global $conn; 

        $sql = "SELECT f.deskripsi, f.judul_film, g.nama_genre, f.tahun_rilis
                FROM films f
                LEFT JOIN genres g ON f.id_genre = g.id_genre
                ORDER BY f.id_film DESC";

        $result = mysqli_query($conn, $sql);
        return $result;
    }

?>
