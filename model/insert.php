<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "movie_rating";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
echo "Koneksi OK\n<br>";


$cleanup = [
    "SET FOREIGN_KEY_CHECKS = 0",
    "TRUNCATE TABLE comments",
    "TRUNCATE TABLE ratings",
    "TRUNCATE TABLE film_popularity",
    "TRUNCATE TABLE films",
    "TRUNCATE TABLE users",
    "TRUNCATE TABLE genres",
    "TRUNCATE TABLE film_origin",
    "SET FOREIGN_KEY_CHECKS = 1"
];

foreach ($cleanup as $q) {
    if (!$conn->query($q)) {
        echo "Cleanup error: " . $conn->error . "<br>";
    }
}
echo "Tables truncated. Ready to insert data.<br><br>";

 
$queries = [];


$queries[] = "INSERT INTO film_origin (id_origin, asal) VALUES (1, 'SEKOLAH')";
$queries[] = "INSERT INTO film_origin (id_origin, asal) VALUES (2, 'LUAR_SEKOLAH')";


$queries[] = "INSERT INTO genres (id_genre, nama_genre) VALUES (1, 'Action')";
$queries[] = "INSERT INTO genres (id_genre, nama_genre) VALUES (2, 'Drama')";
$queries[] = "INSERT INTO genres (id_genre, nama_genre) VALUES (3, 'Comedy')";
$queries[] = "INSERT INTO genres (id_genre, nama_genre) VALUES (4, 'Horror')";
$queries[] = "INSERT INTO genres (id_genre, nama_genre) VALUES (5, 'Romance')";


$users = [
['Alya Pratama','alya1@gmail.com',1],
['Dimas Nugraha','dimas2@gmail.com',2],
['Laras Putri','laras3@gmail.com',1],
['Bagas Ramadhan','bagas4@gmail.com',2],
['Siti Marlina','siti5@gmail.com',1],
['Rafi Akbar','rafi6@gmail.com',2],
['Nadia Putra','nadia7@gmail.com',1],
['Rendra Maulana','rendra8@gmail.com',2],
['Putri Ayuni','putri9@gmail.com',1],
['Fajar Nugroho','fajar10@gmail.com',2],

['Reza Mahendra','reza11@gmail.com',1],
['Clara Anjani','clara12@gmail.com',2],
['Hendra Saputra','hendra13@gmail.com',1],
['Marisa Cahaya','marisa14@gmail.com',2],
['Riko Aditya','riko15@gmail.com',1],
['Bella Rahma','bella16@gmail.com',2],
['Dion Prasetya','dion17@gmail.com',1],
['Chika Lestari','chika18@gmail.com',2],
['Zidan Maulana','zidan19@gmail.com',1],
['Nia Azzahra','nia20@gmail.com',2],

['Tegar Putra','tegar21@gmail.com',1],
['Anita Syifa','anita22@gmail.com',2],
['Ilham Perdana','ilham23@gmail.com',1],
['Mega Purnama','mega24@gmail.com',2],
['Rahmat Surya','rahmat25@gmail.com',1],
['Wulan Shafira','wulan26@gmail.com',2],
['Fikri Ramli','fikri27@gmail.com',1],
['Ochi Raina','ochi28@gmail.com',2],
['Rangga Putra','rangga29@gmail.com',1],
['Felicia Anisa','felicia30@gmail.com',2],

['Hafiz Julianto','hafiz31@gmail.com',1],
['Shania Dewi','shania32@gmail.com',2],
['Agus Prabowo','agus33@gmail.com',1],
['Vina Maharani','vina34@gmail.com',2],
['Kevin Pratama','kevin35@gmail.com',1],
['Fiona Karisma','fiona36@gmail.com',2],
['Arya Dimas','arya37@gmail.com',1],
['Nabila Rahmi','nabila38@gmail.com',2],
['Riko Fernando','riko39@gmail.com',1],
['Gita Savitri','gita40@gmail.com',2],

['Yoga Kurniawan','yoga41@gmail.com',1],
['Selvi Oktaviani','selvi42@gmail.com',2],
['Imam Kurnia','imam43@gmail.com',1],
['Lia Pramesti','lia44@gmail.com',2],
['Raffa Herlangga','raffa45@gmail.com',1],
['Syifa Amalia','syifa46@gmail.com',2],
['Bima Putra','bima47@gmail.com',1],
['Dewi Melani','dewi48@gmail.com',2],
['Haris Ramadhani','haris49@gmail.com',1],
['Tika Sari','tika50@gmail.com',2],

['Zulfikar Prasetya','zul51@gmail.com',1],
['Salsa Nuraini','salsa52@gmail.com',2],
['Ikhsan Hidayat','ikhsan53@gmail.com',1],
['Mala Sari','mala54@gmail.com',2],
['Azzam Fadillah','azzam55@gmail.com',1],
['Novi Lestari','novi56@gmail.com',2],
['Fauzi Akbar','fauzi57@gmail.com',1],
['Rika Amelia','rika58@gmail.com',2],
['Andi Saputra','andi59@gmail.com',1],
['Salsa Ayu','salsa60@gmail.com',2],

['Dewangga Pratama','dewangga61@gmail.com',1],
['Marini Kurnia','marini62@gmail.com',2],
['Fahmi Irawan','fahmi63@gmail.com',1],
['Citra Nirmala','citra64@gmail.com',2],
['Alvin Prakoso','alvin65@gmail.com',1],
['Sari Nurmala','sari66@gmail.com',2],
['Rafi Hidayat','rafih67@gmail.com',1],
['Rena Dwi','rena68@gmail.com',2],
['Galang Putra','galang69@gmail.com',1],
['Mira Suci','mira70@gmail.com',2],

['Sultan Rifai','sultan71@gmail.com',1],
['Almira Dewi','almira72@gmail.com',2],
['Yusuf Ramli','yusuf73@gmail.com',1],
['Anjani Cahaya','anjani74@gmail.com',2],
['Rama Bastian','rama75@gmail.com',1],
['Ghea Pramesti','ghea76@gmail.com',2],
['Habibi Arfan','habibi77@gmail.com',1],
['Nisa Rahmadani','nisa78@gmail.com',2],
['Fikram Darma','fikram79@gmail.com',1],
['Wida Amelia','wida80@gmail.com',2],

['Yanuar Prabowo','yanuar81@gmail.com',1],
['Viona Lestari','viona82@gmail.com',2],
['Farel Ramadhan','farel83@gmail.com',1],
['Mawar Sari','mawar84@gmail.com',2],
['Zaky Pratama','zaky85@gmail.com',1],
['Rania Putri','rania86@gmail.com',2],
['Fadel Alvaro','fadel87@gmail.com',1],
['Nadira Ayu','nadira88@gmail.com',2],
['Bryan Firmansyah','bryan89@gmail.com',1],
['Gisella Rahma','gisella90@gmail.com',2],

['Darren Fitra','darren91@gmail.com',1],
['Shakila Anjani','shakila92@gmail.com',2],
['Rendi Maulana','rendi93@gmail.com',1],
['Farah Nabila','farah94@gmail.com',2],
['Ilham Hadi','ilham95@gmail.com',1],
['Dita Kurnia','dita96@gmail.com',2],
['Akbar Syah','akbar97@gmail.com',1],
['Salsa Putri','salsaputri98@gmail.com',2],
['Raya Intan','raya99@gmail.com',1],
['Anwar Setiawan','anwar100@gmail.com',2]
];

foreach ($users as $u) {
    $name = $conn->real_escape_string($u[0]);
    $email = $conn->real_escape_string($u[1]);
    $pass = password_hash("pass123", PASSWORD_DEFAULT);
    $origin = (int)$u[2];
    $queries[] = "INSERT INTO users (nama, email, password, id_origin) VALUES ('$name', '$email', '$pass', $origin)";
}

$filmTitles = [
"Shadow Breaker","Moon Legend","Silent Echo","Broken Fate","Night Runner",
"Digital Dream","Lost Horizon","Red Silence","Blue Karma","Golden Path",
"Dark Chronicle","Wild Storm","Eternal Rise","Silver Shade","Fire Pulse"
];

for ($i=1;$i<=100;$i++){
    $title = $filmTitles[($i-1) % count($filmTitles)] . " " . $i;
    $desc = "Deskripsi untuk " . $title;
    $genre = ($i % 5) + 1; // 1..5
    $year = 1995 + ($i % 30); // realistic years
    $poster = "poster_" . $i . ".jpg";
    $title_e = $conn->real_escape_string($title);
    $desc_e = $conn->real_escape_string($desc);
    $queries[] = "INSERT INTO films (judul_film, deskripsi, id_genre, tahun_rilis, poster) VALUES ('$title_e', '$desc_e', $genre, $year, '$poster')";
}

for ($i=1;$i<=100;$i++){
    $origin = ($i % 2) + 1; // 1 or 2
    $score = rand(10,100);
    $queries[] = "INSERT INTO film_popularity (id_film, id_origin, viral_score) VALUES ($i, $origin, $score)";
}

$ratingComments = [
"Bagus banget!","Lumayan seru","Kurang tertata plotnya","Acting oke","Soundtrack keren",
"Kurang menarik","Sangat menghibur","Ending mengejutkan","Rekomendasi!","Biasa saja"
];
for ($i=1;$i<=100;$i++){
    $u = rand(1,100);
    $f = rand(1,100);
    $r = rand(1,5);
    $c = $conn->real_escape_string($ratingComments[$i % count($ratingComments)] . " (rating $r)");
    $queries[] = "INSERT INTO ratings (id_user, id_film, rating, komentar) VALUES ($u, $f, $r, '$c')";
}

$commentSamples = [
"Suka banget film ini!","Gak sesuai ekspektasi","Plotnya menarik","Cinematography juara",
"Dialognya kurang nendang","Lucu dan menghibur","Seru dari awal sampai akhir","Kurang bumbu",
"Adegan favorit banyak","Nggak cocok buat saya"
];
for ($i=1;$i<=100;$i++){
    $u = rand(1,100);
    $f = rand(1,100);
    $k = $conn->real_escape_string($commentSamples[$i % count($commentSamples)]);
    $queries[] = "INSERT INTO comments (id_user, id_film, komentar) VALUES ($u, $f, '$k')";
}


$ok = 0;
$fail = 0;
foreach ($queries as $idx => $q) {
    if ($conn->query($q) === TRUE) {
        $ok++;
    } else {
        $fail++;
        echo "Error on query #".($idx+1).": " . $conn->error . "<br>Query: " . htmlspecialchars($q) . "<br><br>";
    }
}

echo "<br><strong>Done.</strong> Successful: $ok, Failed: $fail<br>";

$conn->close();
?>
