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
            require_once("getCustomers.php");
        ?>
        <div id="main-container">
            <div class="float-left maxW40">
                <h3 class="right-fixed">Przeterminowane naprawy</h3>
                <?php
                    $now = date('Y-m-d');
                    $past = date('Y-m-d', strtotime("-30 days"));
                    $stmt = $pdo->prepare('SELECT * FROM orders WHERE date1<\''.$past.'\' AND (orderstatus!=7 AND orderstatus!=8) ORDER BY date1 asc');
                    $stmt->execute();
                    if($stmt->rowCount()<1) {
                        echo 'Nie ma przeterminowanych serwisów.';
                    } else {
                        foreach($stmt as $expired) {
                            echo 'Pan/Pani: ' . $result[$expired['client']-1]['name'] . '<br>Telefon: ' . $result[$expired['client']-1]['phone'] . ' <br>Sprzęt: ' . $expired['brand'] . ' ' . $expired['model'] . '<br>Wyposażenie: ' . $expired['additional'] . '<br><section class="expired"> Dni od przyjęcia: ' . round((strtotime($now)-strtotime($expired['date1']))/(60*60*24)) . '</section> Data przyjęcia: ' . $expired['date1'] . ' <a href="order.php?id='.$expired['id'].'">Przejdź</a>' . '<br><br>';
                        }
                    }
                    $stmt->closeCursor();
                ?>
            </div>
            <div class="float-right maxW40">
                <h3 class="right-fixed">Ostatnio dodane</h3>
                <?php
                    $stmt = $pdo->prepare('SELECT * FROM orders WHERE orderstatus!=7 AND orderstatus!=8 ORDER BY date1 desc, id desc');
                    $stmt->execute();
                    if($stmt->rowCount()<1) {
                        echo 'Nie ma żdanych serwisów.';
                    } else {
                        foreach($stmt as $service) {
                            echo 'Pan/Pani: ' . $result[$service['client']-1]['name'] . '<br>Telefon: ' . $result[$service['client']-1]['phone'] . ' <br>Sprzęt: ' . $service['brand'] . ' ' . $service['model'] . '<br>Wyposażenie: ' . $service['additional'] . '<br>Data przyjęcia: ' . $service['date1'] . ' <a href="order.php?id='.$service['id'].'">Przejdź</a>' . '<br><br>';
                        }
                    }
                    $stmt->closeCursor();
                ?>
            </div>
            <div class="float-left maxW40">
                <h3 class="right-fixed">Zdiagnozowane</h3>
                <?php
                    $stmt = $pdo->prepare('SELECT * FROM orders WHERE orderstatus=2');
                    $stmt->execute();
                    if($stmt->rowCount()<1) {
                        echo 'Brak sprzętów po diagnozie.';
                    } else {
                        foreach($stmt as $diagnosed) {
                            echo 'Pan/Pani: ' . $result[$diagnosed['client']-1]['name'] . '<br>Telefon: ' . $result[$diagnosed['client']-1]['phone'] . ' <br>Sprzęt: ' . $diagnosed['brand'] . ' ' . $diagnosed['model'] . '<br>Wyposażenie: ' . $diagnosed['additional'] . '<br>Diagnoza: ' . $diagnosed['diagnose'] . '<br>Data przyjęcia: ' . $diagnosed['date1'] . ' <a href="order.php?id='.$diagnosed['id'].'">Przejdź</a>' . '<br><br>';
                        }
                    }
                    $stmt->closeCursor();
                ?>
            </div>
            <div class="float-right maxW40">
                <h3 class="right-fixed">Czekające na diagnoze</h3>
                <?php
                    $stmt = $pdo->prepare('SELECT * FROM orders WHERE orderstatus=1');
                    $stmt->execute();
                    if($stmt->rowCount()<1) {
                        echo 'Brak sprzętów bez diagnozy.';
                    } else {
                        foreach($stmt as $expired) {
                            echo 'Pan/Pani: ' . $result[$expired['client']-1]['name'] . '<br>Telefon: ' . $result[$expired['client']-1]['phone'] . ' <br>Sprzęt: ' . $expired['brand'] . ' ' . $expired['model'] . '<br>Wyposażenie: ' . $expired['additional'] . '<br>Data przyjęcia: ' . $expired['date1'] . ' <a href="order.php?id='.$expired['id'].'">Przejdź</a>' . '<br><br>';
                        }
                    }
                    $stmt->closeCursor();
                ?>
            </div>
            <p class="float-clear"></p>
        </div>
    </body>

</html>