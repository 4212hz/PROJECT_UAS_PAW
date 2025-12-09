<?php
// Data untuk tabel ratings
$data = get_all_data('ratings');
$columns = get_columns('ratings');
?>

<style>
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: -30px;
    margin-top: -15px;
    font-size: 15px;
}
/* STYLING TOMBOL TAMBAH */
.btn-tambah {
    background: #0d6efd;
    color: white;
    padding: 8px 16px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    display: inline-block;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-tambah:hover {
    background: #0b5ed7;
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
}

/* CONTAINER TOMBOL AKSI */
.btn-action-container {
    display: flex;
    gap: 8px;
}

/* STYLING TOMBOL EDIT */
.btn-edit {
    background: #ffc107;
    color: #212529;
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 13px;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-edit:hover {
    background: #e0a800;
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(255, 193, 7, 0.3);
    text-decoration: none;
    color: #212529;
}

/* STYLING TOMBOL DELETE */
.btn-delete {
    background: #dc3545;
    color: white;
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 13px;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-delete:hover {
    background: #c82333;
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(220, 53, 69, 0.3);
    text-decoration: none;
    color: white;
}
</style>

<div>
    <div class="topbar">
        <h3>Data Ratings</h3>
        <a href="admin_controller.php?action=tambah&table=ratings" class="btn-tambah">Tambah Rating</a>
    </div>
    
    <br><br>
    
    <?php if (empty($data)): ?>
        <p>Tidak ada data rating ditemukan.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Rating ID</th> 
                    <th>User</th> 
                    <th>Movie</th> 
                    <th>Rating</th> 
                    <th>Comment</th> 
                    <th>Comment ID</th> 
                    <th>Rating Date</th> 
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?php echo $row['id_rating']; ?></td>
                        <td><?php echo htmlspecialchars($row['nama'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($row['judul_film'] ?? '-'); ?></td>
                        <td>
                            <?php 
                            $rating = $row['rating'];
                            echo str_repeat('★', $rating) . str_repeat('☆', 5-$rating) . " ($rating)";
                            ?>
                        </td>
                        <td>
                            <?php 
                            if (strlen($row['komentar']) > 50) {
                                echo substr($row['komentar'], 0, 50) . '...';
                            } else {
                                echo htmlspecialchars($row['komentar']);
                            }
                            ?>
                        </td>
                        <td><?php echo $row['id_comment'] ?? '-'; ?></td>
                        <td><?php echo $row['tanggal_rating']; ?></td>
                        <td>
                            <div class="btn-action-container">
                                <a href="admin_controller.php?action=edit&table=ratings&id=<?php echo $row['id_rating']; ?>" class="btn-edit">✏️ Edit</a>
                                <a href="admin_controller.php?action=hapus&table=ratings&id=<?php echo $row['id_rating']; ?>" 
                                   onclick="return confirm('Yakin ingin menghapus rating ini?')" class="btn-delete">🗑️ Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>