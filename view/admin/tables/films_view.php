<?php
// Data untuk tabel films
$data = get_all_data('films');
$columns = get_columns('films');
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
        <h3>Data Films</h3>
        <a href="admin_controller.php?action=tambah&table=films" class="btn-tambah">Tambah Film</a>
    </div>
    
    <br><br>
    
    <?php if (empty($data)): ?>
        <p>Tidak ada data film ditemukan.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Film ID</th>
                    <th>Movie Title</th> 
                    <th>Descriptiom</th> 
                    <th>Genre</th> 
                    <th>Year Of Relase</th> 
                    <th>Poster</th> 
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?php echo $row['id_film']; ?></td>
                        <td><?php echo htmlspecialchars($row['judul_film']); ?></td>
                        <td>
                            <?php 
                            if (strlen($row['deskripsi']) > 100) {
                                echo substr($row['deskripsi'], 0, 100) . '...';
                            } else {
                                echo htmlspecialchars($row['deskripsi']);
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($row['name_genre'] ?? '-'); ?></td>
                        <td><?php echo $row['tahun_rilis']; ?></td>
                        <td>
                            <?php if (!empty($row['poster'])): ?>
                                <img src="../view/img/img_poster/<?php echo $row['poster']; ?>" width="80" height="100">
                            <?php else: ?>
                                <em>No poster</em>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-action-container">
                                <a href="admin_controller.php?action=edit&table=films&id=<?php echo $row['id_film']; ?>" class="btn-edit">✏️ Edit</a>
                                <a href="admin_controller.php?action=hapus&table=films&id=<?php echo $row['id_film']; ?>" 
                                   onclick="return confirm('Yakin ingin menghapus film ini?')" class="btn-delete">🗑️ Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>