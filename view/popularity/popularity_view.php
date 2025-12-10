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

    
        .popular-section {
            background-color: #0B1A39; 
            padding: 40px 50px;
            color: white;
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
            color: white;
        }
        .popular-container {
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 25px;
        }
        .popular-card {
            background: #f5f7fc;
            color: #0B1A39;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            position: relative;
            transition: 0.25s;
        }
        .popular-card:hover {
            transform: translateY(-6px);
        }
        .popular-card .poster {
            width: 100%;
            height: 330px;
            object-fit: cover;
        }
        .pop-info {
            padding: 15px;
        }
        .pop-info h3 {
            margin: 0 0 6px;
            font-weight: bold;
            color: #0B1A39;
        }
        .pop-info .desc {
            font-size: 14px;
            color: #334;
            margin: 6px 0 10px;
        }
        .pop-info p {
            margin: 4px 0;
        }
       .rank-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #007bff;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: bold;
        font-size: 15px;
        z-index: 20;
        box-shadow: 0 2px 6px rgba(0,0,0,0.25);
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
            display: flex;
            gap: 18px;
            overflow-x: auto;
            padding-bottom: 20px;
        }
        .fan-container::-webkit-scrollbar {
            height: 8px;
        }
        .fan-container::-webkit-scrollbar-thumb {
            background: #0B1A39;
            border-radius: 10px;
        }
        .fan-card {
            position: relative;
            background: #f1f3fa;
            width: 220px;
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
            padding: 40px 50px;
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* 5 kolom */
            gap: 25px;
        }

        .card {
        position: relative;
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
            <a class="btn-genre nav-item" href="../controller/dashboard_controller.php">Home</a>
            <a class="btn-genre nav-item" href="">Genres</a>
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
 

    <!-- Popular Films Section - Top Rated -->
    <div class="fan-section">
        <div class="section-header">
            <div class="line"></div>
            <h2>Top popular films 1-10</h2>
        </div>
        <p class="subtitle">The Most Popular Films Based on User Ratings</p>

       <div class="fan-container">
            
<?php if(isset($result) && is_array($result) && !empty($result)): ?>
    <?php $rank = 1; foreach($result as $row): ?>

        <div class="fan-card">

            <!-- RANK BADGE -->
            <div class="rank-badge">#<?php echo $rank; ?></div>

            <a href="../controller/detailFilm_controller.php?id=<?php echo $row['id_film']; ?>" style="text-decoration:none; color:inherit;">
                <img src="../view/img/img_poster/<?php echo htmlspecialchars($row['poster']); ?>" 
                     alt="<?php echo htmlspecialchars($row['judul_film']); ?>">
                
                <div class="fan-info">
                    <span class="rating">⭐ <?php echo number_format($row['avg_rating'], 1); ?></span>
                    <h3><?php echo htmlspecialchars($row['judul_film']); ?></h3>
                    <p><strong>Tahun:</strong> <?php echo $row['tahun_rilis']; ?></p>
                    <p><strong>Genre:</strong> <?php echo htmlspecialchars($row['name_genre']); ?></p>
                </div>
            </a>

            <button class="btn-watchlist">+ Watchlist</button>
            <button class="btn-trailer">▶ Trailer</button>
        </div>

    <?php $rank++; endforeach; ?>
<?php else: ?>
    <p style="text-align: center; color: #666;">No films available.</p>
<?php endif; ?>

</div>


        <div class="line"></div>
        <h2>all films</h2></div>
<div class="container">

<?php if(isset($all_films) && !empty($all_films)): ?>
    <?php $rank_all = 1; foreach($all_films as $film): ?>
    
        <div class="card">

            <!-- RANK -->
            <div class="rank-badge">#<?php echo $rank_all; ?></div>

            <a href="../controller/detailFilm_controller.php?id=<?php echo $film['id_film']; ?>" 
               style="text-decoration:none; color:inherit;">
               
                <img src="../view/img/img_poster/<?php echo $film['poster']; ?>" 
                     alt="<?php echo htmlspecialchars($film['judul_film']); ?>" 
                     style="width:100%; height:300px; object-fit:cover; border-radius:10px;">

                <h3><?php echo htmlspecialchars($film['judul_film']); ?></h3>
                <p><strong>Tahun:</strong> <?php echo $film['tahun_rilis']; ?></p>
                <p><strong>Genre:</strong> <?php echo htmlspecialchars($film['name_genre']); ?></p>
            </a>

            <button class="btn-watchlist">+ Watchlist</button>
            <button class="btn-trailer">▶ Trailer</button>

        </div>

    <?php $rank_all++; endforeach; ?>
<?php else: ?>
    <p style="text-align:center; color:#555;">Belum ada film.</p>
<?php endif; ?>

</div>







        <!-- Tombol kanan kiri -->
        <button class="arrow-btn left" onclick="scrollLeft()">
            ❮
        </button>

        <button class="arrow-btn right" onclick="scrollRight()">
            ❯
        </button>
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
