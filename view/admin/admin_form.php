<?php
$mode = isset($row) ? 'edit' : 'tambah';

$id_field = get_primary_key($table);
$row_id = isset($row) ? $row[$id_field] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($mode); ?> Data - <?php echo strtoupper($table); ?></title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body{
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            overflow: hidden;
            background: linear-gradient(rgba(10, 20, 40, 0.85), rgba(10, 20, 40, 0.85));
            background-size: cover;
            background-position: center;
            padding: 20px;
        }
        .container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            height: 90vh;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }
        .form-container {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-header h1 {
            font-size: 24px;
            color: #fff;
            margin-bottom: 10px;
        }
        .form-header a {
            color: #00c8ff;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .form-header a:hover {
            color: #007bff;
        }
        .error-message {
            background: rgba(220, 53, 69, 0.2);
            color: #ff6b6b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #dc3545;
        }
        .form-table {
            width: 100%;
            border-collapse: collapse;
        }
        .form-table tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .form-table td {
            padding: 15px;
            vertical-align: top;
        }
        .form-label {
            width: 35%;
            font-weight: 500;
            font-size: 14px;
            color: #e0e0e0;
        }
        .form-label .required {
            color: #ff4757;
            margin-left: 2px;
        }
        .form-input {
            width: 65%;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
            font-size: 14px;
            transition: all 0.3s;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.2);
            background: rgba(255, 255, 255, 0.12);
        }
        select {
            background: rgba(20, 30, 48, 0.9) !important;
        }
        
        select option {
            background: rgba(20, 30, 48, 0.95);
            color: #fff;
            padding: 10px;
        }
        
        select option:hover,
        select option:focus,
        select option:checked {
            background: linear-gradient(to right, #007bff, #00c8ff);
            color: white;
        }
        
        select option[value=""] {
            color: rgba(255, 255, 255, 0.5);
        }
        
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        input[type="range"] {
            padding: 0;
            height: 30px;
        }
        input[type="range"]::-webkit-slider-thumb {
            background: #007bff;
            border-radius: 50%;
            cursor: pointer;
            height: 20px;
            width: 20px;
        }
        input[type="range"]::-webkit-slider-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            height: 8px;
        }
        output {
            display: inline-block;
            margin-left: 10px;
            padding: 5px 10px;
            background: #007bff;
            border-radius: 5px;
            color: white;
            font-weight: 500;
            min-width: 40px;
            text-align: center;
        }
        .current-image {
            margin-top: 10px;
        }
        .current-image img {
            width: 100px;
            height: 130px;
            object-fit: cover;
            border-radius: 5px;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }
        .image-label {
            font-size: 12px;
            color: #aaa;
            margin-bottom: 5px;
        }
        .form-actions {
            text-align: center;
            padding: 30px 15px;
        }
        .form-actions button {
            padding: 12px 40px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-submit {
            background: linear-gradient(to right, #007bff, #00c8ff);
            color: white;
            margin-right: 10px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
        }
        .btn-cancel {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
        }
        .select-wrapper {
            position: relative;
        }
        .select-wrapper::after {
            content: "▼";
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.5);
            pointer-events: none;
        }
        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }
        ::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }
        .help-text {
            font-size: 12px;
            color: #aaa;
            margin-top: 5px;
            display: block;
        }
        .star-rating {
            display: flex;
            gap: 5px;
            align-items: center;
        }
        .star-rating label {
            font-size: 20px;
            color: #ffc107;
            cursor: pointer;
        }
        .star-rating input[type="radio"] {
            display: none;
        }
        .star-rating input[type="radio"]:checked ~ label {
            color: #ffd700;
        }
        
        @-moz-document url-prefix() {
            select {
                color: white;
                text-shadow: 0 0 0 #fff;
            }
            select option {
                background: rgba(20, 30, 48, 0.95);
                color: white;
            }
        }
        
        @media screen and (-webkit-min-device-pixel-ratio:0) {
            select {
                color: white;
            }
            select option {
                background: rgba(20, 30, 48, 0.95);
                color: white;
            }
        }
        
        select::-ms-expand {
            display: none;
        }
        select::-ms-value {
            background: transparent;
            color: white;
        }
        
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                height: auto;
            }
            .form-container {
                padding: 20px;
            }
            .form-table td {
                display: block;
                width: 100%;
                padding: 10px 0;
            }
            .form-label {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <div class="form-header">
            <h1><?php echo ucfirst($mode); ?> Data: <?php echo strtoupper(str_replace('_', ' ', $table)); ?></h1>
            <a href="admin_controller.php?action=index&table=<?php echo $table; ?>">
                <span>←</span> Kembali ke Daftar
            </a>
        </div>

        <?php if (isset($error)): ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" 
              action="admin_controller.php?action=<?php echo $mode; ?>&table=<?php echo $table; ?><?php echo isset($row) ? '&id=' . $row_id : ''; ?>">
            
            <?php if (isset($row)): ?>
                <input type="hidden" name="id" value="<?php echo $row_id; ?>">
            <?php endif; ?>
            
            <table class="form-table">
                <?php foreach ($columns as $col): ?>
                    <?php
                    $col_name = $col['name'];
                    $col_type = strtolower($col['type']);
                    
                    // Skip auto increment pada form tambah
                    if ($mode == 'tambah' && $col['extra'] == 'auto_increment') continue;
                    
                    // Skip primary key pada form edit
                    if ($mode == 'edit' && $col_name == get_primary_key($table)) continue;
                    
                    $required = ($col['null'] == 'NO' && $col['default'] === null) ? 'required' : '';
                    $value = $row[$col_name] ?? '';
                    
                    // Cek foreign key
                    $is_foreign = isset($foreign_keys[$col_name]);
                    $is_enum = strpos($col_type, 'enum') !== false;
                    $is_text = strpos($col_type, 'text') !== false;
                    $is_int = strpos($col_type, 'int') !== false;
                    $is_file = in_array(strtolower($col_name), ['poster', 'gambar', 'image', 'foto']);
                    ?>
                    
                    <?php if (!$is_file || ($is_file && $mode == 'edit' && empty($value))): ?>
                    <tr>
                        <td class="form-label">
                            <strong><?php echo ucwords(str_replace('_', ' ', $col_name)); ?></strong>
                            <?php if ($required): ?><span class="required">*</span><?php endif; ?>
                        </td>
                        <td class="form-input">
                    <?php endif; ?>
                            
                            <?php if ($is_file): ?>
                                <?php if ($mode == 'edit' && !empty($value)): ?>
                                    <div class="current-image">
                                        <div class="image-label">Gambar saat ini:</div>
                                        <img src="../view/img/img_poster/<?php echo $value; ?>" alt="<?php echo $col_name; ?>">
                                        <input type="hidden" name="old_<?php echo $col_name; ?>" value="<?php echo $value; ?>">
                                        <br><br>
                                        <div class="image-label">Unggah gambar baru:</div>
                                <?php endif; ?>
                                <input type="file" name="<?php echo $col_name; ?>" <?php echo $required; ?>>
                            
                            <?php elseif ($col_name == 'password' && $table == 'users'): ?>
                                <input type="password" 
                                       name="<?php echo $col_name; ?>" 
                                       <?php echo ($mode == 'tambah') ? $required : ''; ?>
                                       value=""
                                       placeholder="Masukkan password">
                                <?php if ($mode == 'edit'): ?>
                                    <span class="help-text">Kosongkan jika tidak ingin mengubah password</span>
                                <?php endif; ?>
                            
                            <?php elseif ($is_text): ?>
                                <textarea name="<?php echo $col_name; ?>" 
                                          rows="5"
                                          <?php echo $required; ?>
                                          placeholder="Masukkan <?php echo str_replace('_', ' ', $col_name); ?>"><?php echo htmlspecialchars($value); ?></textarea>
                            
                            <?php elseif ($is_enum): ?>
                                <?php
                                $enum_values = get_enum_values($table, $col_name);
                                if (!empty($enum_values)):
                                ?>
                                <div class="select-wrapper">
                                    <select name="<?php echo $col_name; ?>" <?php echo $required; ?>>
                                        <option value="">-- Pilih --</option>
                                        <?php foreach ($enum_values as $enum_value): ?>
                                            <option value="<?php echo $enum_value; ?>" 
                                                    <?php echo ($value == $enum_value) ? 'selected' : ''; ?>>
                                                <?php echo ucfirst($enum_value); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php endif; ?>
                            
                            <?php elseif ($is_foreign && isset($foreign_keys[$col_name])): ?>
                                <?php
                                $foreign_table = $foreign_keys[$col_name]['table'];
                                $foreign_column = $foreign_keys[$col_name]['column'];
                                
                                // Tentukan kolom display berdasarkan tabel
                                $display_column = 'nama';
                                if ($foreign_table == 'films') $display_column = 'judul_film';
                                if ($foreign_table == 'genres') $display_column = 'name_genre';
                                if ($foreign_table == 'film_origin') $display_column = 'asal';
                                
                                $options = get_foreign_options($foreign_table, $foreign_column, $display_column);
                                ?>
                                <div class="select-wrapper">
                                    <select name="<?php echo $col_name; ?>" <?php echo $required; ?>>
                                        <option value="">-- Pilih --</option>
                                        <?php foreach ($options as $opt_value => $opt_label): ?>
                                            <option value="<?php echo $opt_value; ?>" 
                                                    <?php echo ($value == $opt_value) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($opt_label); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            
                            <?php elseif ($col_name == 'rating'): ?>
                                <div class="select-wrapper">
                                    <select name="<?php echo $col_name; ?>" <?php echo $required; ?>>
                                        <option value="">-- Pilih Rating --</option>
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <option value="<?php echo $i; ?>" <?php echo ($value == $i) ? 'selected' : ''; ?>>
                                                <?php echo str_repeat('★', $i) . str_repeat('☆', 5-$i); ?> (<?php echo $i; ?>)
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            
                            <?php elseif ($col_name == 'viral_score'): ?>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <input type="range" 
                                           name="<?php echo $col_name; ?>" 
                                           min="0" 
                                           max="100" 
                                           value="<?php echo $value ?: '50'; ?>"
                                           oninput="this.nextElementSibling.value = this.value"
                                           <?php echo $required; ?>>
                                    <output><?php echo $value ?: '50'; ?></output>
                                </div>
                                <span class="help-text">Geser untuk mengatur skor (0-100)</span>
                            
                            <?php elseif ($col_name == 'tahun_rilis'): ?>
                                <input type="number" 
                                       name="<?php echo $col_name; ?>" 
                                       min="1900" 
                                       max="2100" 
                                       value="<?php echo $value; ?>"
                                       <?php echo $required; ?>
                                       placeholder="Tahun rilis">
                            
                            <?php elseif ($is_int): ?>
                                <input type="number" 
                                       name="<?php echo $col_name; ?>" 
                                       value="<?php echo $value; ?>"
                                       <?php echo $required; ?>
                                       placeholder="Masukkan <?php echo str_replace('_', ' ', $col_name); ?>">
                            
                            <?php else: ?>
                                <input type="text" 
                                       name="<?php echo $col_name; ?>" 
                                       value="<?php echo htmlspecialchars($value); ?>"
                                       <?php echo $required; ?>
                                       placeholder="Masukkan <?php echo str_replace('_', ' ', $col_name); ?>">
                            <?php endif; ?>
                            
                    <?php if (!$is_file || ($is_file && $mode == 'edit' && empty($value))): ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                
                <tr>
                    <td colspan="2" class="form-actions">
                        <button type="submit" class="btn-submit">
                            <?php echo ($mode == 'edit') ? 'UPDATE DATA' : 'SIMPAN DATA'; ?>
                        </button>
                        <button type="button" onclick="window.history.back()" class="btn-cancel">
                            BATAL
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<script>
// Untuk range slider viral_score
document.addEventListener('DOMContentLoaded', function() {
    var rangeInputs = document.querySelectorAll('input[type="range"]');
    rangeInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            this.nextElementSibling.value = this.value;
        });
    });
    
    // Tambahkan background gradient
    document.body.style.background = "linear-gradient(rgba(10, 20, 40, 0.85), rgba(10, 20, 40, 0.85)), url('../view/img/img1.jpg')";
    document.body.style.backgroundSize = "cover";
    document.body.style.backgroundPosition = "center";
    
    var selects = document.querySelectorAll('select');
    selects.forEach(function(select) {
        // Set background color untuk semua options
        Array.from(select.options).forEach(function(option) {
            option.style.backgroundColor = 'rgba(20, 30, 48, 0.95)';
            option.style.color = '#fff';
        });
    });
});
</script>

</body>
</html>