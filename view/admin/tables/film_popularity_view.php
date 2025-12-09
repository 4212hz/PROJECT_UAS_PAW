<?php
// Data untuk tabel film_popularity
$data = get_all_data('film_popularity');
$columns = get_columns('film_popularity');
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
.btn-action-container {
    display: flex;
    gap: 8px;
}
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
        <h3>Data Film Popularity</h3>
        <a href="admin_controller.php?action=tambah&table=film_popularity" class="btn-tambah">Tambah Popularity</a>
    </div>
    
    <br><br>
    
    <?php if (empty($data)): ?>
        <p>Tidak ada data popularity ditemukan.</p>
    <?php else: ?>
        <table >
            <thead>
                <tr>
                    <th>Popular ID</th>
                    <th>Film</th>
                    <th>Origin</th>
                    <th>Viral Scroll</th>
                    <th>Update At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?php echo $row['id_pop']; ?></td>
                        <td><?php echo htmlspecialchars($row['judul_film'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($row['asal'] ?? '-'); ?></td>
                        <td>
                            <div style="background: #f0f0f0; height: 20px; width: 100px; border-radius: 10px;">
                                <div style="
                                    background: <?php 
                                        $score = $row['viral_score'];
                                        if ($score >= 80) echo '#28a745';
                                        elseif ($score >= 50) echo '#ffc107';
                                        else echo '#dc3545';
                                    ?>;
                                    height: 100%;
                                    width: <?php echo $score; ?>%;
                                    border-radius: 10px;
                                    text-align: center;
                                    color: white;
                                    font-size: 12px;
                                    line-height: 20px;
                                ">
                                    <?php echo $score; ?>%
                                </div>
                            </div>
                        </td>
                        <td><?php echo $row['update_at']; ?></td>
                        <td>
                            <div class="btn-action-container">
                                <a href="admin_controller.php?action=edit&table=film_popularity&id=<?php echo $row['id_pop']; ?>" class="btn-edit">✏️ Edit</a>
                                <a href="admin_controller.php?action=hapus&table=film_popularity&id=<?php echo $row['id_pop']; ?>" 
                                   onclick="return confirm('Yakin ingin menghapus popularity data ini?')" class="btn-delete">🗑️ Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>