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
            padding: 0px 80px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.5);
            transition: 0.3s ease;
        }
        .navbar.scrolled .title-1 {
            height: 60px; 
            transition: 0.3s;
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
        
        /* BUTTON LOG OUT */
        .dropdown-logout {
            position: relative;
            display: inline-block;
            background-color: #ffffff;
            padding: 10px 14px 10px 5px;
            border-radius: 100px;
            /* margin-left: 20px; */
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
        .navbar a {
            text-decoration: none;
            margin-left: 15px;
        }
        .btn-kembali {
            padding: 10px  10px 10px;
            border-radius: 30px;
            text-decoration: none;
            cursor: pointer;
            background: white;
            color: #000000ff;
        }
        .btn-kembali:hover {
            background-color: #dce2f5;
        }
        .see-all {
            display: block; 
            margin: 40px auto 0; 
            text-align: center;
            font-size: 16px;
            padding: 12px 20px;
            background: white;
            color: #0B1A39;
            width: 200px;
            text-decoration:none;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.25s;
        }
        .see-all:hover {
            background: #d5def0;
        }
        .fan-section {
            padding: 40px 50px;
            color: #0B1A39;
            background-color: white;
            position: relative;
        }
        .fan-section h2 {
            font-size: 28px;
            margin: 0;
            color: #0B1A39;
        }
        .subtitle {
            color: #666;
            margin-top: 5px;
        }
        .fan-container {
            margin-top: 25px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        }
        .fan-card {
            background: #f1f3fa;
            width: 220px;
            margin-bottom: 15px;
            min-width: 220px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .fan-card img {
            width: 100%;
            height: 290px;
            object-fit: cover;
        }
        .fan-info {
            padding: 12px;
            color: #0B1A39;
        }
        .rating {
            font-size: 14px;
            color: #ffae00;
        }
        .btn-watchlist,
        .btn-trailer {
            width: 100%;
            margin-top: 8px;
            padding: 8px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-watchlist {
            background: #0B1A39;
            color: white;
        }
        .btn-watchlist:hover {
            background: #070c17ff;
        }
        .btn-trailer {
            background: #d9deea;
            color: #0B1A39;
        }
        .btn-trailer:hover {
            background: #c5cbdb;
        }
        .arrow-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 45px;
            height: 65px;
            background: rgba(11, 26, 57, 0.3);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 10px;
            color: white;
            font-size: 28px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
            z-index: 10;
        }
        .arrow-btn:hover {
            background: rgba(11, 26, 57, 0.6);
        }
        .left {
            left: 10px;
        }
        .right {
            right: 10px;
        }
        .footer {
            background-color: rgba(11, 26, 57);
            padding: 10px 20px;
            color: white;
            }
        .footer-container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            text-align: center;
            }
        .footer-social a {
            width: 40px;
            height: 40px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            background: white;
            border-radius: 50%;
            margin: 0 10px;
            font-size: 24px;
            color: rgba(11, 26, 57);
            text-decoration: none;
        }
        .footer-logo img {
            width: 180px;
        }
        .footer-text p {
            margin: 5px 0;
            font-size: 16px;
        }
        .container {
            padding: 50px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }
        .card {
            background: white;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }
        .card h3 {
            margin-top: 15px;
            margin-bottom: 8px;
            color: #0B1A39;
        }
        .card p {
            font-size: 14px;
            color: #444;
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
            <a class="btn-kembali" href="../controller/dashboard_controller.php"><i class="bi bi-chevron-left"></i> Back</a>
            <div class="dropdown-logout">
                <a href="#"><?php echo $_SESSION['nama']?> ▼</a>
                <div class="dropdown-content-logout">
                    <a href="../controller/logout_controller.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Fan Favorites Section -->
    <div class="fan-section">
        <div class="section-header">
            <div class="line"></div>
            <h2> All Movies</h2>
            
        </div>
        <p class="subtitle">Film You Are Ready To Review</p>

        <div class="fan-container">
            <?php foreach($data as $row): ?>
            <div class="fan-card">
                <a href="detailFilm_controller.php?id=<?php echo $row['id_film']; ?>" style="text-decoration:none; color:inherit;">
                <img src="../view/img/img_poster/<?php echo htmlspecialchars($row['poster']); ?>">
                
                <div class="fan-info">
                    <span class="rating">⭐ <?php echo number_format($row['avg_rating'], 1); ?></span>
                    <h3><?php echo $row['judul_film']; ?></h3>
                    <p><strong>Tahun:</strong> <?php echo $row['tahun_rilis']; ?></p>
                    <p><strong>Genre:</strong> <?php echo $row['name_genre']; ?></p>
                </a>
                    <button class="btn-watchlist">+ Watchlist</button>
                    <button class="btn-trailer">▶ Trailer</button>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-social">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            </div>

            <div class="footer-logo">
            <img class="tittle-1" src="../view/img/favicon/logo2.png" alt="Logo">
            </div>

            <div class="footer-text">
            <p>© Kelompok Paw.</p>
            <p>Design: Posting review, rating, sorting review, komentar</p>
            </div>
        </div>
    </footer>
</body>
</html>


<script>
    window.addEventListener("scroll", function() {
        const navbar = document.querySelector(".navbar");
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
</script>
