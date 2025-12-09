<?php

$conn = mysqli_connect("localhost", "root", "", "spk_ahp");
$alternatif = mysqli_query($conn, "SELECT * FROM alternatif");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review/ratting Film</title>
    <link rel="icon" type="image/png" href="../view/img/favicon/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">  
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fc; /* Putih kebiruan */
            margin: 0;
            padding: 0;
            padding-top: 80px;
        }
        /* NAVBAR */
        .navbar {
            background-color: #0B1A39; 
            padding: 0px 80px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 90%;
            z-index: 1000;
        }
        .navbar.scrolled {
            background-color: linear-gradient(to right, #007bff, #00c8ff);
            /* background-color: #07132a;  */
            padding: 0px 80px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.5);
            transition: 0.3s ease;
        }
        .navbar.scrolled .title-1 {
            height: 60px; 
            transition: 0.3s;
        }
        .navbar.scrolled + .sidebar {
            top: 60px; /* tinggi navbar saat mengecil */
        }

        .title-1, .sign-in {
            font-weight: bold;
        }
        .title-1 {
            width: auto; 
            height: 80px;
        }
        .sign-in {
            background-color: #ffffff;
            padding: 10px;
            border-radius: 4px;
            color: #0B1A39;
        }
        .sign-in:hover {
            background-color: #dce2f5;
            color: #0B1A39;
        }
        .btn-rating, .btn-popular, .btn-genre {
            color: #d6dbeb;
        }
        /* RIGHT */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        /* MENU LINK */
        .nav-item {
            color: #e3e9ff;
            text-decoration: none;
            font-size: 15px;
            position: relative;
            padding-bottom: 4px;
            transition: 0.3s;
        }
        .nav-item:hover {
            color: #ffffff;
        }
        .nav-item::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0%;
            height: 2px;
            background: #ffb400;
            transition: width 0.3s;
        }
        .nav-item:hover::after {
            width: 100%;
        }
                /* Dropdown container */
        .dropdown-container {
            display: none;
            background-color: #142a5c;
            padding-left: 10px;
        }

        .dropdown-container a {
            padding-left: 35px;
            font-size: 14px;
        }

        
        /* BUTTON LOG OUT */
        .dropdown-logout {
            position: relative;
            display: inline-block;
            background-color: #ffffff;
            padding: 10px 14px 10px 5px;
            border-radius: 100px;
            margin-left: 20px;
        }
        .dropdown-logout > a {
            color: #0B1A39 !important;
            text-decoration: none;
        }
        .dropdown-logout:hover {
            background-color: #dce2f5;
        }
        .dropdown-logout:hover > a {
            color: #0B1A39 !important;
        }
        .dropdown-content-logout {
            display: none;
            position: absolute;
            top: 40px;
            /* right: 0; */
            background-color: #17397bff;
            width: 140px;
            border-radius: 100px;
            box-shadow: 0 0 6px rgba(0,0,0,0.3);
            z-index: 100;
        }
        .dropdown-content-logout a {
            color: white;
            padding: 10px 0px;
            margin-right: 12px;
            display: block;
            text-decoration: none;
            text-align: center;
            border-radius: 4px;
        }
        .dropdown-logout:hover .dropdown-content-logout {
            display: block;
        }
        .navbar a:hover {
            color: white;
        }
        .navbar a {
            text-decoration: none;
            margin-left: 15px;
        }
        .layout {
            display: flex;
            /* margin-top: 80px;  */
        }

        /* SIDEBAR KIRI */
        .sidebar {
            padding-top: 10px;
            width: 230px;
            background-color: #0B1A39;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 80px;
            transition: top .3s ease; /* supaya ikut navbar */
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
        }
        .sidebar a, .dropdown-btn {
            padding: 12px 20px;
            display: block;
            font-size: 15px;
            color: #d6dbeb;
            text-decoration: none;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            outline: none;
        }
        .sidebar a:hover, .dropdown-btn:hover {
            background-color: #11224d;
            color: #fff;
        }
        .sidebar a:hover {
            margin-left: -10px;      
            padding-left: 30px;  
            width: calc(100% + -40px); 
            padding-right: 0px 0px 0px 0px;
        }
        .content {
            margin-left: 230px;
            flex: 1;
            padding: 10px 20px;
            margin-top: -5px;
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 15px;
            /* margin-bottom: 15px; */
        }

         .table-container {
            background: #fff;
            padding: 5px 20px;
            margin-bottom: 10px;
            padding-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            /* width: 100%; */
            /* margin-top: 30px; */
        }
        .table-container h3 {
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: 600;
        }
        table {
            margin-top: 13px;
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        th {
            background: #e2e8f0;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        td {
            border-bottom: 1px solid #d1d5db;
        }
        td:last-child {
            width: 100px;
        }
        .btn-container {
            display: flex;
            justify-content: center;
            gap: 6px;
        }
        .btn-tambah {
            background: #0d6efd;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            
        }
        .btn-edit, .btn-delete {
            display: flex;
            padding: 5px 10px;
            gap: 5px;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }
        .btn-edit {
            background: #EF533A;
        }
        .btn-delete{
            background-color: #dc3545;
        }
        .btn-edit:hover, .btn-delete:hover, .btn-tambah:hover {
            opacity: 0.85;
        }
    </style>

</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="header-atas">
            <img class="title-1" src="../view/img/favicon/logo2.png" alt="">
        </div>

        <div class="nav-links">
            <a class="btn-genre nav-item" href="../controller/dashboard_controller.php">Home</a>
            <a class="btn-genre nav-item" href="../controller/genre_controller.php">Genres</a>
            <a class="btn-popular nav-item" href="#">Popularity</a>
            <a class="btn-master nav-item" href="../controller/admin_controller.php">Admin</a>
            <a class="btn-master nav-item" href="../controller/admin_controller.php"><i class="bi bi-bookmark-plus"></i> Watchlist</a>
            <div class="dropdown-logout" id="dropdownUser">
                <a href="#"><?php echo $_SESSION['nama']?> ▼</a>
                <div class="dropdown-content-logout">
                    <a href="../controller/logout_controller.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
        <div class="sidebar">
            <h2>Admin Panel</h2>
            <!-- <a href="../controller/dashboard_controller.php"><i class="bi bi-house"></i> Dashboard</a> -->
            <button class="dropdown-btn">
                <i class="bi bi-gear"></i> Kelola Data &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;▼
            </button>
            <div class="dropdown-container">
                <a href="kelola_user.php">Kelola User</a>
                <a href="kelola_film.php">Kelola Film</a>
                <a href="kelola_review.php">Kelola Review</a>
                <a href="kelola_komentar.php">Kelola Komentar</a>
            </div>
            <a href="laporan.php"><i class="bi bi-file-earmark-text"></i> Laporan</a>
            <!-- <a href="../controller/logout_controller.php"><i class="bi bi-box-arrow-right"></i> Logout</a> -->
        </div>

    <div class="layout">
        <div class="content">
            <div class="topbar">
                <h2>Kelola Data Alternatif</h2>
                <a href="tambahData.php" class="btn-tambah">+ Tambah</a>
            </div>
            <div class="table-container" id="alternatif">
                <h3>Data Alernatif</h3>
                
                <table>
                    <tr>
                        <th>No</th>
                        <th>Nama Alternatif</th>
                        <th>Aksi</th>
                    </tr>
                    <?php 
                        $no =1;
                        while($row = mysqli_fetch_assoc($alternatif)): 
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_alternatif']; ?></td>
                        <td>
                            <div class="btn-container">
                                <a href="editData.php?id=<?php echo $row["id"]?>" class="btn-edit"><i class="fa-solid fa-pen"></i> Edit</a>
                                <a href="index.php?id=<?php echo $row["id"]?>" onclick="return confirm('Anda yakin akan menghapus alternatif ini?')" class="btn-delete"><i class="fa-solid fa-trash"></i> Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
        
    </div>
   
</body>
</html>


<script>
    
    let dropdown = document.getElementsByClassName("dropdown-btn");

    for (let i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function () {
            this.classList.toggle("active");
            let content = this.nextElementSibling;
            content.style.display = content.style.display === "block" ? "none" : "block";
        });
    }


    window.addEventListener("scroll", function() {
        const navbar = document.querySelector(".navbar");
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
    function scrollLeft() {
        const container = document.querySelector('.fan-container');
        container.scrollBy({
            left: -300,
            behavior: 'smooth'
        });
    }

    function scrollRight() {
        const container = document.querySelector('.fan-container');
        container.scrollBy({
            left: 300,
            behavior: 'smooth'
        });
    }
</script>
