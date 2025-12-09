<?php
// Data untuk tabel film_origin
$data = get_all_data('film_origin');
$columns = get_columns('film_origin');
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

/* STYLING BADGE ASAL */
.badge-asal {
    background: #6c757d;
    color: white;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
    display: inline-block;
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
        <h3>Data Film Origin</h3>
        <a href="admin_controller.php?action=tambah&table=film_origin" class="btn-tambah">Tambah Origin</a>
    </div>

    <br><br>
    
    <?php if (empty($data)): ?>
        <p>Tidak ada data origin ditemukan.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Origin ID</th>
                    <th>Origin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?php echo $row['id_origin']; ?></td>
                        <td>
                            <span class="badge-asal"><?php echo $row['asal']; ?></span>
                        </td>
                        <td>
                            <div class="btn-action-container">
                                <a href="admin_controller.php?action=edit&table=film_origin&id=<?php echo $row['id_origin']; ?>" class="btn-edit">✏️ Edit</a>
                                <a href="admin_controller.php?action=hapus&table=film_origin&id=<?php echo $row['id_origin']; ?>" 
                                   onclick="return confirm('Yakin ingin menghapus origin ini?')" class="btn-delete">🗑️ Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>