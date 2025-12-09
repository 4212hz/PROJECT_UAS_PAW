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
            /* SLIDER */
            .slider-container {
                width: 100%;
                height: 550px;
                overflow: hidden;
                position: relative;
            }
            .slider {
                display: flex;
                width: 100%;
                animation: slide 12s infinite;
            }
            .slider-container::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(rgba(10, 20, 40, 0.85), rgba(10, 20, 40, 0.85));
                z-index: 2; 
            }
            .slider img {
                width: 100%;
                object-fit: cover;
                object-position: bottom;
                position: relative;
                z-index: 1;
            }
            @keyframes slide {
                0% { margin-left: 0%; }
                30% { margin-left: 0%; }

                33% { margin-left: -100%; }
                63% { margin-left: -100%; }

                66% { margin-left: -200%; }
                100% { margin-left: -200%; }
            }
            .slider-texts {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 100%;
                display: flex;
                justify-content: center;
                text-align: center;
                color: white;
                z-index: 3;
                animation: slide 12s infinite;
            }
            .text-slide {
                width: 100%;
                flex-shrink: 0;
            }
            .text-slide h1 {
                font-size: 45px;
                margin: 0;
                font-weight: bold;
            }
            .text-slide p {
                margin-top: 10px;
                font-size: 20px;
            }

            /* SECTION BACKGROUND */
            section {
                margin: 0;
                padding: 0;
            }
            .about-section {
                background-color: #f5f7fc; 
                padding: 40px 50px;
                color: #0B1A39;
                /* border-radius: 0 0 25px 25px; */
            }
            .about-content {
                /* margin-top: 40px; */
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 40px;
                color: #0B1A39;
                /* padding: 30px; */
                border-radius: 15px;
            }

            .about-text h3 {
                margin-bottom: 10px;
            }

            .about-text p {
                line-height: 1.6;
                color: #0B1A39;
            }
            .about-text ul {
                /* list-style: none; */
                /* padding-left: 3px; */
            }
            .about-text ul li {
                margin-bottom: 6px;
            }
            .about-image img {
                width: 400px;
                height: 400px;
                border-radius: 12px;
                border: 12px solid #0B1A39;
            }
            .about-section-header {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .about-section-header .line {
                width: 6px;
                height: 28px;
                background-color: #ffb400;
                border-radius: 3px;
            }
            .about-section-header h2 {
                margin: 0;
                font-size: 26px;
                font-weight: bold;
                color: #0B1A39;
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
                padding: 6px 10px;
                border-radius: 6px;
                font-weight: bold;
                font-size: 14px;
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
            /* Contact-us */
            .contact-us {
                padding: 40px 50px;
                height: 450px;
                background: linear-gradient(rgba(10, 20, 40, 0.85), rgba(10, 20, 40, 0.85)), 
                url('../view/img/img_slider/slide3.png');
                background-size: cover;
                background-position: center;
            }
            .contact-wrapper {
                display: grid;
                grid-template-columns: 1.1fr 1fr;
                gap: 40px;
                /* margin-top: 30px; */
                align-items: center;
            }

            .contact-left h2 {
                /* font-size: 3 2px; */
                color: white;
                /* margin: 20px 0px; */
            }
            .contact-left p {
                color: #cccc;
                /* line-height: 1.6; */
            }
            .info-card p {
                color: #0B1A39;
                /* line-height: 1.6; */
            }
            .contact-info-box {
                display: flex;
                gap: 20px;
                margin-top: 70px;
            }
            .info-card {
                background: white;
                color: #0B1A39;
                border-radius: 10px;
                text-align: center;
                padding: 10px 0px;
                width: 100%;
                box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            }
            .info-icon {
                width: 65px;
                height: 65px;
                background: #0B1A39;
                color: white;
                font-size: 24px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: -50px auto 10px;
            }
            /* FORM PUTIH */
            .contact-right {
                background: white;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            }
            .contact-right h2 {
                text-align: center;
                margin-bottom: 25px;
                color: #0B1A39;
            }

            .contact-right form input, .contact-right form textarea
             {
                padding: 12px;
                margin-bottom: 15px;
                border-radius: 8px;
                border: 1px solid #ddd;
                font-size: 14px;
            }
            .contact-right form textarea{
                width: 95%;
            }
            .contact-right input{
                width: 100%;
            }
            .form-row {
                display: flex;
                gap: 10px;
            }
            .form-row input {
                flex: 1;
            }
            .contact-right button {
                width: 100%;
                background: #0B1A39;
                color: white;
                border: none;
                padding: 14px;
                border-radius: 50px;
                font-weight: bold;
                cursor: pointer;
                transition: 0.3s;
            }
            .contact-right button:hover {
                background: #0B1A39;
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
        <!-- slide --> 
        <div class="slider-container">
            <div class="slider-texts">
                <div class="text-slide">
                    <h1>Welcome to Movie Review</h1>
                    <p>Nikmati pengalaman menilai dan menemukan film terbaik</p>
                </div>

                <div class="text-slide">
                    <h1>Top Movies This Week</h1>
                    <p>Lihat daftar film populer yang sedang trending</p>
                </div>

                <div class="text-slide">
                    <h1>Find Your Favorite Genre</h1>
                    <p>Pilih film berdasarkan kategori yang Anda suka</p>
                </div>
            </div>
            <div class="slider">
                <img src="../view/img/img_slider/slide1.png">
                <img src="../view/img/img_slider/slide2.png">
                <img src="../view/img/img_slider/slide3.png">
            </div>
        </div>

        <!-- MOST POPULAR SECTION -->
        <section class="about-section">
            <div class="about-section-header">
                <div class="line"></div>
                <h2>About Page</h2>
            </div>
            <div class="about-content">
                <div class="about-text">
                    <h3>Welcome to Our Movie Review Platform!</h3>
                    <p>
                        This website was created to provide the best experience for discovering your favorite movies.
                        We provide a rating system, reviews, comments, and weekly movie recommendations.
                    </p>

                    <h3>✨ Key Features</h3>
                    <ul>
                        <li>Rating movies</li>
                        <li>Write and read other users' reviews</li>
                        <li>Sort by genre</li>
                        <li>Weekly list of most popular movies</li>
                        <li>Watchlist to save your favorite movies</li>
                    </ul>

                    <h3>👥 Development Team</h3>
                    <p>This website was created by <strong>PAW Group</strong>as a web application development project.</p>
                </div>

                <div class="about-image">
                    <img src="../view/img/img_slider/slide2.png" alt="About Image">
                </div>
            </div>
        </section>

        <!-- MOST POPULAR SECTION -->
        <section class="popular-section">

            <div class="section-header">
                <div class="line"></div>
                <h2>10 Most popular movies this week</h2>
            </div>

            <div class="popular-container">
                <?php foreach($top_films as $index => $row): ?>
                <!-- 1 -->
                <div class="popular-card">
                    <a href="detailFilm_controller.php?id=<?php echo $row['id_film']; ?>" style="text-decoration:none; color:inherit;">
                    <div class="rank-badge">#<?php echo $index + 1; ?></div>
                    <img src="../view/img/img_poster/<?php echo htmlspecialchars($row['poster']); ?>" class="poster">
                    <div class="pop-info">
                        <p class="rating">⭐ <?php echo number_format($row['avg_rating'], 1); ?></p>
                        <h3><?php echo $row['judul_film']; ?></h3>
                        <p class="genre"><strong>Genre:</strong> <?php echo $row['name_genre']; ?></p>
                        <p class="year"><strong>Tahun:</strong> <?php echo $row['tahun_rilis']; ?></p>
                    </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>

            <a class="see-all" href="allFilm_controller.php">See All Movies</a>
        </section>

        <!-- Fan Favorites Section -->
        <div class="fan-section">
            <div class="section-header">
                <div class="line"></div>
                <h2> Fan favorites</h2>
                
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

            <!-- Tombol kanan kiri -->
            <button class="arrow-btn left" onclick="scrollLeft()">
                ❮
            </button>

            <button class="arrow-btn right" onclick="scrollRight()">
                ❯
            </button>
        </div>

        <div class="contact-us">
            

            <div class="contact-wrapper">

                <!-- KIRI: INFORMASI -->
                <div class="contact-left">
                    <div class="section-header">
                        <div class="line"></div>
                        <h2> Contact Us</h2>
                    </div>
                    <p class="subtitle">Tell Us Something</p>
                    <h2>Here You Can Give Feedback Or Just Ask Questions About Our Website</h2>

                    <p>
                        Please contact us if you have anything to say or just want to ask about this film website.
                    </p>

                    <div class="contact-info-box">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <h4>Nomor Telepon</h4>
                            <p>0819-9952-6675</p>
                            <p>0877-6946-7756</p>
                        </div>

                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <h4>Email</h4>
                            <p>support@movie.com</p>
                            <p>admin@movie.com</p>
                        </div>
                    </div>
                </div>

                <!-- KANAN: FORM PUTIH -->
                <div class="contact-right">
                    <h2>Send message</h2>
                    <form>
                        <div class="form-row">
                            <input type="text" placeholder="Nama Anda *" required>
                            <input type="email" placeholder="Email Anda" required>
                        </div>

                        <div class="form-row">
                            <input type="text" placeholder="Nomor Telepon *" required>
                            <input type="number" placeholder="Jumlah Tamu">
                        </div>

                        <div class="form-row">
                            <input type="date">
                            <input type="time">
                        </div>

                        <textarea placeholder="Pesan" rows="5"></textarea>

                        <button type="submit">Kirim Pesan</button>
                    </form>
                </div>
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
                <p>© Paw Group.</p>
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
