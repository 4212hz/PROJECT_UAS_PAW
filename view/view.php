<?php
include_once "koneksi.php";
include_once "model/film.php";

$films = getAllFilms();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Film</title>
</head>
<body>

<h2>Daftar Film</h2>

<table border=1 cellspacing=0>
    <tr>
    
        <th>judul film</th>
        <th>deskripsi</th>
        <th>genre</th>
        <th>tahun rilis</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($films)) : ?>
        <tr>
            <td><?= $row['judul_film']; ?></td>
            <td><?= $row['deskripsi']; ?></td>
            <td><?= $row['nama_genre']; ?></td>
            <td><?= $row['tahun_rilis']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>