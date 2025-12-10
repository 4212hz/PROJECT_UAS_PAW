<?php
include '../model/detailFilm_model.php';
$filmData = prepare_film_detail_data($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($filmData['judul_film']); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        *{
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body { 
            color: #fff;
            padding: 20px; 
            background: linear-gradient(135deg, #0a1f44, #021528);
        }
        .bg-shape{
            position: fixed;
            width: 400px;
            height: 400px;
            border-radius: 30px;
            background: rgba(255,255,255,0.05);
            top: -50px;
            left: -50px;
            transform: rotate(45deg);
            filter: blur(10px);
        }
        .bg-shape2{
            position: fixed;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            bottom: -80px;
            right: -80px;
            filter: blur(10px);
        }
        .bg-shape,
        .bg-shape2 {
            z-index: -1;
        }
        .container { 
            max-width: 900px; 
            margin:auto; 
            background: rgba(255,255,255,0.07);
            padding:20px; 
            border-radius:10px; 
            box-shadow:0 4px 12px rgba(0,0,0,0.2); 
        }
        .btn-kembali {
            width: 100%;
            padding: 12px;
            border-radius: 30px;
            text-decoration: none;
            cursor: pointer;
            background: linear-gradient(to right, #007bff, #00c8ff);
            color: #fff;
            font-size: 16px;
            font-weight: 600;
        }
        .btn-kembali i { margin-right: 8px; }
        .btn-submit {
            width: 100%;
            padding: 12px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            background: linear-gradient(to right, #007bff, #00c8ff);
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
        }

        .btn-submit:hover {
            background: linear-gradient(to right, #0056b3, #00a1d6);
        }
        .poster { 
            width: 300px; 
            float:left; 
            margin-right:20px; 
            margin-top:20px; 
            border-radius:10px; 
        }
        .details { overflow:hidden; }
        .rating-form { margin-top:20px; }
        .review-box label{ font-size: 14px; font-weight: 500; }
        .review-box input, .review-box textarea{
            width: 90%;
            margin-top: 5px;
            margin-bottom: 20px;
            padding: 12px;
            border-radius: 6px;
            border: none;
            outline: none;
            background: rgba(255,255,255,0.15);
            color: #fff;
        }
        .review-box textarea{ width: 100%; }
        .clearfix::after { content:""; display:block; clear:both; }
        .comment-section { margin-top: 40px; }
        .comment {
            background: rgba(255,255,255,0.15);
            padding: 10px;
            margin-bottom: 12px;
            border-radius: 6px;
            position: relative;
        }
        .comment-text { white-space: pre-wrap; }
        .star-rating {
            direction: rtl;        
            display: inline-flex;    
            font-size: 90px;        
            line-height: 1;          
        }
        .star-rating input { display: none; }
        .star-rating label {
            color: #ccc;
            cursor: pointer;
            margin: 0 2px;
            transition: color 0.2s;
        }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: gold;
        }
    </style>
</head>
<body>
    <div class="bg-shape"></div>
    <div class="bg-shape2"></div>

    <div class="container clearfix">
        <div class="button">
            <a href="dashboard_controller.php" class="btn-kembali"><i class="bi bi-chevron-left"></i>Back</a>
        </div>

        <img class="poster" 
             src="../view/img/img_poster/<?php echo htmlspecialchars($filmData['poster']); ?>" 
             alt="<?php echo htmlspecialchars($filmData['judul_film']); ?>">

        <div class="details">
            <h1><?php echo htmlspecialchars($filmData['judul_film']); ?></h1>
            <p><strong>Genre:</strong> <?php echo htmlspecialchars($filmData['name_genre']); ?></p>
            <p><strong>Release Year:</strong> <?php echo htmlspecialchars($filmData['tahun_rilis']); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($filmData['deskripsi']); ?></p>

            <p><strong>Current rating:</strong> 
                <?php echo $filmData['avg_rating'] > 0 ? number_format($filmData['avg_rating'], 1) : '0'; ?> ⭐
            </p>

            <div class="review-box">
                <form class="rating-form" method="POST" action="../controller/submit_rating.php">
                    <label for="rating">Give a rating:</label> <br><br>

                    <div class="star-rating">
                        <?php for($i=5; $i>=1; $i--): ?>
                            <input type="radio" id="star<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" required>
                            <label for="star<?php echo $i; ?>" title="<?php echo $i; ?> stars">&#9733;</label>
                        <?php endfor; ?>
                    </div><br><br>

                    <label for="comments">Leave a Comment on this Movie:</label>
                    <textarea name="comments" rows="3"></textarea>

                    <input type="hidden" name="id_film" value="<?php echo $filmData['id_film']; ?>">

                    <button type="submit" class="btn-submit">Send To Review</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container comment-section">
        <h2>User Comments</h2>

        <?php if($filmData['comments'] && count($filmData['comments']) > 0): ?>
            <?php foreach($filmData['comments'] as $index => $c): ?>
                <?php
                    $short = substr($c['komentar'], 0, 100);
                    $full  = $c['komentar'];
                    $rating_value = $c['rating'] ?? 0;
                    $stars = $rating_value > 0 ? str_repeat('⭐', $rating_value) : '';
                ?>
                <div class="comment">
                    <p><strong><?php echo htmlspecialchars($c['user_name']); ?></strong> - 
                       <?php echo htmlspecialchars($c['tanggal_komentar']); ?></p>

                    <?php if($rating_value > 0): ?>
                        <div class="comment-rating"><?php echo $stars; ?> (<?php echo $rating_value; ?>/5)</div>
                    <?php endif; ?>

                    <?php if(strlen($full) > 100): ?>
                        <input type="checkbox" id="toggle-<?php echo $index; ?>" class="read-more-toggle">
                        <p class="comment-text comment-short"><?php echo htmlspecialchars($short); ?>...</p>
                        <p class="comment-text comment-full"><?php echo htmlspecialchars($full); ?></p>

                        <label for="toggle-<?php echo $index; ?>" class="read-more-btn">
                            <span class="read-more-text">Read More</span>
                            <span class="read-less-text">Read Less</span>
                        </label>
                    <?php else: ?>
                        <p class="comment-text"><?php echo htmlspecialchars($full); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There are no comments for this movie yet.</p>
        <?php endif; ?>
    </div>

</body>
</html>

