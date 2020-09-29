<!DOCTYPE html>
<?php
    require_once 'connection.php';
    session_start();
    if(!isset($_SESSION['userName'])) {
        header('Location: login.php');
    }
?>
<html>

<head>
    <title>Serwis</title>
    <meta charset="utf-8">
    <script src="/service/assets/js/sweetalerts.js"></script>
    <link rel="stylesheet" href="/service/assets/css/main.css">
</head>

<body id="fullscreen" onload="drawNav();">
    <?php
        require_once("nav.html");
        require_once("checkErrors.php");
    ?>
    <div id="main-container">
        <?php
            $stmt = $pdo->prepare("SELECT * FROM orders");
            $stmt->execute();
            if($stmt->rowCount() >0) {
                foreach($stmt as $orders) {
                    echo "To będzie serwis (wszystkie)";
                }
            } else {
                echo 'Nie znaleziono serwisów';
            }
            $stmt->closeCursor();
        ?>
    </div>
</body>

</html>