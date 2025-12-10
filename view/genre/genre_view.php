<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genres - Movie Review</title>
    <link rel="icon" type="image/png" href="../view/img/favicon/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">  
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fc;
            margin: 0;
            padding: 0;
            padding-top: 80px;
        }
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
        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }
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

        .section-header {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section-header .line {
            width: 6px;
            height: 28px;
            background-color: #ffb400;
            border-radius: 3px;
        }
        .section-header h2 {
            margin: 0;
            font-size: 26px;
            font-weight: bold;
            color: #0B1A39;
        }
        
        .fan-section {
            padding: 40px 50px;
            color: #0B1A39;
            background-color: white;
        }
        .fan-section:nth-child(even) {
            background-color: #f5f7fc;
        }
        .fan-section h2 {
            font-size: 28px;
            margin: 0;
            color: #0B1A39;
        }
        .subtitle {
            color: #666;
            margin-top: 5px;
            margin-bottom: 20px;
        }
        .fan-container {
            display: flex;
            gap: 18px;
            overflow-x: auto;
            padding-bottom: 20px;
            scroll-behavior: smooth;
            scroll-snap-type: x mandatory;
        }
        
        .fan-container::-webkit-scrollbar {
            height: 10px;
        }
        .fan-container::-webkit-scrollbar-track {
            background: #e0e5f0;
            border-radius: 10px;
        }
        .fan-container::-webkit-scrollbar-thumb {
            background: #0B1A39;
            border-radius: 10px;
        }
        .fan-container::-webkit-scrollbar-thumb:hover {
            background: #070c17ff;
        }
        
        .fan-card {
            background: #f1f3fa;
            width: 220px;
            min-width: 220px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            scroll-snap-align: start;
            transition: transform 0.3s;
        }
        .fan-card:hover {
            transform: translateY(-6px);
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
        .fan-info h3 {
            margin: 8px 0;
            font-size: 16px;
        }
        .fan-info p {
            margin: 4px 0;
            font-size: 14px;
        }
        .rating {
            font-size: 14px;
            color: #ffae00;
            font-weight: bold;
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
            transition: 0.3s;
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
            transition: 0.3s;
        }
        .footer-social a:hover {
            transform: scale(1.1);
        }
        .footer-logo img {
            width: 180px;
        }
        .footer-text p {
            margin: 5px 0;
            font-size: 16px;
        }
        .page-header {
            background-color: #0B1A39;
            padding: 30px 50px;
            color: white;
        }
        .page-header h1 {
            margin: 0;
            font-size: 32px;
        }
        .page-header p {
            margin: 10px 0 0 0;
            color: #d6dbeb;
        }
    </style>
</head>
<body>
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

    <div class="page-header">
        <h1>Browse Movies by Genre</h1>
        <p>Explore movies from different genres - Action, Comedy, Drama, Horror, and Romance</p>
    </div>

    <?php foreach($data as $genre_data): ?>
        <?php if(count($genre_data['films']) > 0): ?>
        <!-- Fan Favorites Section -->
        <div class="fan-section">
            <div class="section-header">
                <div class="line"></div>
                <h2>Genre <?php echo htmlspecialchars($genre_data['genre']['name_genre']); ?></h2>
            </div>
            <p class="subtitle">Films You Are Ready To Review</p>

            <div class="fan-container">
                <?php foreach($genre_data['films'] as $row): ?>
                <div class="fan-card">
                    <a href="detailFilm_controller.php?id=<?php echo $row['id_film']; ?>" style="text-decoration:none; color:inherit;">
                        <img src="../view/img/img_poster/<?php echo htmlspecialchars($row['poster']); ?>" alt="<?php echo htmlspecialchars($row['judul_film']); ?>">
                        
                        <div class="fan-info">
                            <span class="rating">⭐ <?php echo number_format($row['avg_rating'], 1); ?></span>
                            <h3><?php echo htmlspecialchars($row['judul_film']); ?></h3>
                            <p><strong>Tahun:</strong> <?php echo $row['tahun_rilis']; ?></p>
                            <p><strong>Genre:</strong> <?php echo htmlspecialchars($row['name_genre']); ?></p>
                        </a>
                            <button class="btn-watchlist">+ Watchlist</button>
                            <button class="btn-trailer">▶ Trailer</button>
                        </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    <?php endforeach; ?>

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
