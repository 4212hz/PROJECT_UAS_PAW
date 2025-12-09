<?php
$success_msg = $_SESSION['success'] ?? '';
$error_msg = $_SESSION['error'] ?? '';
unset($_SESSION['success']);
unset($_SESSION['error']);

// Get current table from URL or session
$table = $_GET['table'] ?? $_SESSION['current_table'] ?? null;
if ($table) {
    $_SESSION['current_table'] = $table;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review/ratting Film - Admin Panel</title>
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
        .navbar.scrolled {
            padding: 0px 80px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.5);
            transition: 0.3s ease;
        }     
        .navbar.scrolled .title-1 {
            height: 60px; 
            transition: 0.3s;
        }       
        .navbar.scrolled + .sidebar {
            top: 60px;
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
        
        /* RIGHT NAV LINKS */
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
        
        /* ===== SIDEBAR ===== */
        .sidebar {
            padding-top: 10px;
            width: 230px;
            background-color: #0B1A39;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 80px;
            transition: top .3s ease;
            overflow-y: auto;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
            padding: 0 15px;
        }
        
        /* DROPDOWN BUTTON (TANPA &nbsp;) */
        .dropdown-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 20px;
            font-size: 15px;
            color: #d6dbeb;
            text-decoration: none;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            outline: none;
            transition: all 0.3s ease;
        }
        
        .dropdown-btn:hover {
            background-color: #11224d;
            color: #fff;
        }
        
        .dropdown-btn.active {
            background-color: #11224d;
            color: #fff;
        }
        
        .dropdown-btn i {
            margin-right: 10px;
            font-size: 16px;
            min-width: 24px;
            text-align: center;
        }
        
        .dropdown-text {
            flex-grow: 1;
            text-align: left;
        }
        
        .dropdown-arrow {
            font-size: 12px;
            transition: transform 0.3s ease;
        }
        
        .dropdown-btn.active .dropdown-arrow {
            transform: rotate(180deg);
        }
        
        /* DROPDOWN CONTAINER */
        .dropdown-container {
            display: none;
            background-color: #142a5c;
        }
        
        .dropdown-container a {
            padding: 10px 20px 10px 45px;
            font-size: 14px;
            display: block;
            text-decoration: none;
            color: #d6dbeb;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
        }
        
        .dropdown-container a:hover {
            background-color: #1a3370;
            color: #fff;
            border-left-color: #ffb400;
        }
        
        .dropdown-container a.active {
            background-color: #1a3370;
            color: #fff;
            border-left: 3px solid #ffb400;
        }
        
        /* REGULAR SIDEBAR LINKS */
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            font-size: 15px;
            color: #d6dbeb;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .sidebar a:hover {
            background-color: #11224d;
            color: #fff;
            padding-left: 25px;
        }
        
        .sidebar a i {
            margin-right: 10px;
            font-size: 16px;
            min-width: 24px;
            text-align: center;
        }
        .main-content {
            margin-left: 230px;
            padding: 20px;
            /* margin-top: 20px; */
        }
        
        /* WELCOME SECTION */
        .welcome-section {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
            margin-top: 50px;
        }
        
        .welcome-section h2 {
            color: #0B1A39;
            margin-bottom: 15px;
        }
        
        .welcome-section p {
            color: #6c757d;
            margin-bottom: 25px;
            font-size: 16px;
        }
        
        .welcome-section .icon {
            font-size: 48px;
            color: #0d6efd;
            margin-bottom: 20px;
        }
        
        /* CONTENT HEADER */
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .table-selector {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .table-selector select {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
            font-size: 14px;
            min-width: 200px;
        }
        
        .btn-refresh {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        
        /* NOTIFICATION STYLES */
        .notification {
            margin: 10px 0;
            padding: 12px 15px;
            border-radius: 4px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .notification.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .notification.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        /* TABLE CONTAINER */
        .table-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }       
        .table-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #0B1A39;
        }       
        .btn-tambah {
            background: #0d6efd;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }       
        .btn-tambah:hover {
            background: #0b5ed7;
        }
        
        /* TABLE STYLES */
        table {
            /* margin-top: 13px; */
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
        
        tr:hover {
            background: #f8f9fa;
        }
        
        /* ACTION BUTTONS */
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .btn-edit, .btn-delete {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-edit {
            background: #ffc107;
            color: #212529;
        }
        
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        
        .btn-edit:hover {
            background: #e0a800;
        }
        
        .btn-delete:hover {
            background: #c82333;
        }
        
        /* STATUS BADGES */
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .badge-admin {
            background: #0d6efd;
            color: white;
        }
        
        .badge-user {
            background: #198754;
            color: white;
        }
        
        /* IMAGE STYLES */
        .table-image {
            width: 80px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        
        /* RATING STARS */
        .rating-stars {
            color: #ffc107;
            font-size: 14px;
        }
        
        /* NO DATA MESSAGE */
        .no-data {
            text-align: center;
            padding: 40px;
            color: #6c757d;
            font-style: italic;
        }
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
            
            .sidebar {
                display: none;
            }
            
            .navbar {
                padding: 0px 20px;
                width: 95%;
            }
            
            .nav-links {
                gap: 10px;
            }
            
            .nav-item {
                font-size: 14px;
            }
            
            .welcome-section {
                padding: 20px;
                margin-top: 20px;
            }
        }
        
        @media (max-width: 480px) {
            .table-header {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="header-atas">
            <img class="title-1" src="../view/img/favicon/logo2.png" alt="Logo">
        </div>

        <div class="nav-links">
            <a class="btn-genre nav-item" href="../controller/dashboard_controller.php">Home</a>
            <a class="btn-genre nav-item" href="../controller/genre_controller.php">Genres</a>
            <a class="btn-popular nav-item" href="#">Popularity</a>
            <a class="btn-master nav-item active" href="../controller/admin_controller.php">Admin</a>
            <a class="btn-master nav-item" href="#"><i class="bi bi-bookmark-plus"></i> Watchlist</a>
            <div class="dropdown-logout" id="dropdownUser">
                <a href="#"><i></i> <?php echo htmlspecialchars($_SESSION['nama'] ?? 'Admin'); ?> ▼</a>
                <div class="dropdown-content-logout">
                    <a href="../controller/logout_controller.php"><i></i> Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <button class="dropdown-btn">
            <i class="bi bi-gear"></i>
            <span class="dropdown-text">Kelola Data</span>
            <span class="dropdown-arrow">▼</span>
        </button>
        <div class="dropdown-container">
            <a href="admin_controller.php?action=index&table=users" 
            class="<?php echo ($table == 'users') ? 'active' : ''; ?>">
            Kelola User
            </a>
            <a href="admin_controller.php?action=index&table=films" 
            class="<?php echo ($table == 'films') ? 'active' : ''; ?>">
            Kelola Film
            </a>
            <a href="admin_controller.php?action=index&table=ratings" 
            class="<?php echo ($table == 'ratings') ? 'active' : ''; ?>">
            Kelola Review
            </a>
            <a href="admin_controller.php?action=index&table=comments" 
            class="<?php echo ($table == 'comments') ? 'active' : ''; ?>">
            Kelola Komentar
            </a>
            <a href="admin_controller.php?action=index&table=genres" 
            class="<?php echo ($table == 'genres') ? 'active' : ''; ?>">
            Kelola Genre
            </a>
            <a href="admin_controller.php?action=index&table=film_popularity" 
            class="<?php echo ($table == 'film_popularity') ? 'active' : ''; ?>">
            Kelola Film Popularity
            </a>
            <a href="admin_controller.php?action=index&table=film_origin" 
            class="<?php echo ($table == 'film_origin') ? 'active' : ''; ?>">
            Kelola Film origin
            </a>
        </div>
        <a href="admin_controller.php?action=laporan"><i class="bi bi-file-earmark-text"></i> Laporan</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Notifications -->
        <?php if ($success_msg): ?>
            <div class="notification success">
                <i class="bi bi-check-circle-fill"></i> <?php echo htmlspecialchars($success_msg); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error_msg): ?>
            <div class="notification error">
                <i class="bi bi-exclamation-triangle-fill"></i> <?php echo htmlspecialchars($error_msg); ?>
            </div>
        <?php endif; ?>
        
        <?php if (!$table): ?>
            <!-- Welcome Section (Tampilan Awal) -->
            <div class="welcome-section">
                <div class="icon">
                    <i class="bi bi-speedometer2"></i>
                </div>
                <h2>Selamat Datang di Admin Panel</h2>
                <p>Pilih tabel yang ingin dikelola dari menu "Kelola Data" di sidebar.</p>
                <p>Anda dapat mengelola data Users, Films, Ratings, dan lainnya.</p>
            </div>
        <?php else: ?>
            <!-- Table Content (Hanya ditampilkan jika table dipilih) -->
            <div class="table-container">
                <?php
                // Include view spesifik berdasarkan tabel
                $table_view_file = __DIR__ . "/tables/{$table}_view.php";
                if (file_exists($table_view_file)) {
                    include $table_view_file;
                } else {
                    // Fallback ke default view
                    ?>
                    <div class="table-header">
                        <h3>Data <?php echo ucwords(str_replace('_', ' ', $table)); ?></h3>
                        <a href="admin_controller.php?action=tambah&table=<?php echo $table; ?>" class="btn-tambah">
                            <i class="bi bi-plus-circle"></i> Tambah Data
                        </a>
                    </div>
                    
                    <?php
                    // Assuming these functions exist in your controller/model
                    $data = get_all_data($table);
                    $columns = get_columns($table);
                    
                    if (empty($data)): ?>
                        <div class="no-data">
                            <i class="bi bi-inbox" style="font-size: 48px; margin-bottom: 10px;"></i>
                            <h3>Tidak ada data ditemukan</h3>
                            <p>Klik "Tambah Data" untuk menambahkan data baru</p>
                        </div>
                    <?php else: ?>
                        <div style="overflow-x: auto;">
                            <table>
                                <thead>
                                    <tr>
                                        <?php foreach ($columns as $col): ?>
                                            <th><?php echo ucwords(str_replace('_', ' ', $col)); ?></th>
                                        <?php endforeach; ?>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $row): ?>
                                        <tr>
                                            <?php foreach ($columns as $col): ?>
                                                <td>
                                                    <?php
                                                    if (in_array(strtolower($col), ['poster', 'gambar', 'image', 'foto']) && !empty($row[$col])) {
                                                        echo "<img src='../img/img_poster/{$row[$col]}' class='table-image'>";
                                                    } elseif (strlen($row[$col] ?? '') > 50) {
                                                        echo htmlspecialchars(substr($row[$col], 0, 50)) . '...';
                                                    } else {
                                                        echo htmlspecialchars($row[$col] ?? '');
                                                    }
                                                    ?>
                                                </td>
                                            <?php endforeach; ?>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="admin_controller.php?action=edit&table=<?php echo $table; ?>&id=<?php echo $row[$columns[0]]; ?>" class="btn-edit">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </a>
                                                    <a href="admin_controller.php?action=hapus&table=<?php echo $table; ?>&id=<?php echo $row[$columns[0]]; ?>" 
                                                       onclick="return confirm('Yakin ingin menghapus data ini?')" 
                                                       class="btn-delete">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                <?php } ?>
            </div>
            
            <!-- Footer Info -->
            <div style="margin-top: 20px; text-align: center; color: #6c757d; font-size: 14px;">
                <p>Total Data: <?php echo count($data ?? []); ?> | Table: <?php echo $table; ?> | <?php echo date('d M Y H:i:s'); ?></p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>

<script>
    // Dropdown functionality
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownBtn = document.querySelector('.dropdown-btn');
        const dropdownContainer = document.querySelector('.dropdown-container');
        
        // Check if any link in dropdown is active (table is selected)
        const activeLinks = dropdownContainer.querySelectorAll('a.active');
        if (activeLinks.length > 0) {
            dropdownContainer.style.display = 'block';
            dropdownBtn.classList.add('active');
        }
        
        // Toggle dropdown on click
        dropdownBtn.addEventListener('click', function() {
            this.classList.toggle('active');
            const isOpen = dropdownContainer.style.display === 'block';
            
            if (isOpen) {
                dropdownContainer.style.display = 'none';
            } else {
                dropdownContainer.style.display = 'block';
            }
        });
    });

    // Navbar scroll effect
    window.addEventListener("scroll", function() {
        const navbar = document.querySelector(".navbar");
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
</script>
