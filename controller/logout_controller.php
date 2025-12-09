<?php
session_start();
session_destroy();

echo "<script>
        alert('Anda telah logout!');
        window.location='../view/login_view.php';
      </script>";
exit();
?>