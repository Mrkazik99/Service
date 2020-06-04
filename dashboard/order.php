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
        <script src="/serwis/assets/js/sweetalerts.js"></script>
        <link rel="stylesheet" href="/serwis/assets/css/main.css">
    </head>

    <body id="fullscreen" onload="drawNav();">
        <?php
            require_once("nav.html");
            require_once("checkErrors.php");
        ?>
        <div id="main-container" style="text-align:center;">
            <?php
                if(!isset($_GET['id'])||$_GET['id']==''||!is_numeric($_GET['id'])) {
                    echo "Nie wybrano naprawy";
                } else {
                    $id = $_GET['id'];
                    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id=".$id);
                    $stmt->execute();
                    if($stmt->rowCount() >0) {
                        foreach($stmt as $order) {
echo <<<EOL
kurwa mać siema xDDD $id
EOL;
                        }
                    } else {
                        echo 'Nie znaleziono serwisu o podanym identyfikatorze.';
                    }
                    $stmt->closeCursor();

                }
            ?>
        </div>
    </body>

</html>