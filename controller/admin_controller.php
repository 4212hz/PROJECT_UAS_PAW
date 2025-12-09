<?php
include '../model/admin_model.php';

session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$action = $_GET['action'] ?? 'index';
$table = $_GET['table'] ?? null;

switch($action) {
    case 'index':
        admin_index($table);
        break;
    case 'laporan':
        laporan_index($table);
        break;
    case 'tambah':
        admin_tambah($table);
        break;
    case 'edit':
        admin_edit($table);
        break;
    case 'hapus':
        admin_hapus($table);
        break;
    default:
        echo "Action tidak ditemukan";
        break;
}

function admin_index($table) {
    // Inisialisasi variabel dengan default value
    $data = [];
    $columns = [];
    $all_tables = [];
    
    // Hanya ambil data jika table dipilih
    if ($table) {
        $data = get_all_data($table);
        $columns = get_columns($table);
        $all_tables = get_all_tables();
        
        // Simpan di session untuk digunakan nanti
        $_SESSION['current_table'] = $table;
    } else {
        // Reset session jika tidak ada table yang dipilih
        unset($_SESSION['current_table']);
    }
    
    include '../view/admin/admin_view.php';
}

function laporan_index($table) {
    $laporan_rating = get_laporan_rating();
    $film_terbaik = get_film_rating_tertinggi();
    $film_terburuk = get_film_rating_terendah();
    $laporan_watchlist = get_laporan_watchlist();
    include '../view/admin/laporan_view.php';
}

function admin_tambah($table) {
    // Validasi: table harus dipilih
    if (!$table) {
        $_SESSION['error'] = "Silakan pilih tabel terlebih dahulu";
        header("Location: admin_controller.php?action=index");
        exit();
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $result = insert_data($table, $_POST, $_FILES);
        if ($result) {
            $_SESSION['success'] = "Data berhasil ditambahkan!";
            header("Location: admin_controller.php?action=index&table=$table");
            exit();
        } else {
            $error = "Gagal menambah data";
        }
    }
    
    $columns = get_columns_info($table);
    $all_tables = get_all_tables();
    $foreign_keys = get_foreign_keys($table);
    
    include '../view/admin/admin_form.php';
}

function admin_edit($table) {
    // Validasi: table harus dipilih
    if (!$table) {
        $_SESSION['error'] = "Silakan pilih tabel terlebih dahulu";
        header("Location: admin_controller.php?action=index");
        exit();
    }
    
    $id = $_GET['id'] ?? 0;
    $id_field = get_primary_key($table);
    
    // VALIDASI PRIMARY KEY
    if (!$id_field) {
        $_SESSION['error'] = "Primary key tidak ditemukan untuk tabel $table";
        header("Location: admin_controller.php?action=index&table=$table");
        exit();
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $result = update_data($table, $id, $_POST, $_FILES);
        if ($result) {
            $_SESSION['success'] = "Data berhasil diupdate!";
            header("Location: admin_controller.php?action=index&table=$table");
            exit();
        } else {
            $error = "Gagal mengupdate data";
        }
    }
    
    $row = get_by_id($table, $id_field, $id);
    if (!$row) {
        $_SESSION['error'] = "Data tidak ditemukan";
        header("Location: admin_controller.php?action=index&table=$table");
        exit();
    }
    
    $columns = get_columns_info($table);
    $all_tables = get_all_tables();
    $foreign_keys = get_foreign_keys($table);
    
    include '../view/admin/admin_form.php';
}

function admin_hapus($table) {
    // Validasi: table harus dipilih
    if (!$table) {
        $_SESSION['error'] = "Silakan pilih tabel terlebih dahulu";
        header("Location: admin_controller.php?action=index");
        exit();
    }
    
    $id = $_GET['id'] ?? 0;
    $id_field = get_primary_key($table);
    
    // VALIDASI PRIMARY KEY
    if (!$id_field) {
        $_SESSION['error'] = "Primary key tidak ditemukan untuk tabel $table";
        header("Location: admin_controller.php?action=index&table=$table");
        exit();
    }
    
    if ($id > 0) {
        $result = delete_data($table, $id_field, $id);
        if ($result) {
            $_SESSION['success'] = "Data berhasil dihapus!";
        } else {
            $_SESSION['error'] = "Gagal menghapus data";
        }
    }
    
    header("Location: admin_controller.php?action=index&table=$table");
    exit();
}
?>
