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
    <script src="/serwis/assets/js/jquerry.js"></script>
    <script src="/serwis/assets/js/searchEngine.js"></script>
    <link rel="stylesheet" href="/serwis/assets/css/main.css">
</head>

<body id="fullscreen">
    <?php
        require_once("nav.html");
        require_once("checkErrors.php");
        require_once("getCustomers.php");
    ?>
    <div id="main-container">
        <div id="sorting">
            <input type="text" placeholder="Wpisz szukaną frazę" id="search" onkeyup="research(this.value);">
            <button onclick='document.cookie="sort=";window.location.reload(true);'>Od najnowszych</button>
            <button onclick='document.cookie="sort=asc";window.location.reload(true);'>Od najstarszych</button><br>
            <label for="stat7">Pokaż odebrane</label><input type="checkbox" onchange="stat7(this);" id="stat7" class="check-slider"><br>
            <label for="stat8">Pokaż zutylizowane</label><input type="checkbox" onchange="stat8(this);" id="stat8" class="check-slider">
        </div>
        <div id="result">
            <?php
                $now = date('Y-m-d');
                $statuses = array(
                    1=> 'czeka na diagnoze',
                    2=> 'postawiono diagnoze',
                    3=> 'zaakceptowane',
                    4=> 'czeka na czesci',
                    5=> 'testy',
                    6=> 'do odbioru',
                    7=> 'odebrane',
                    8=> 'zutylizowane'
                );
                if(!isset($_COOKIE['sort'])||$_COOKIE['sort']=="") {
                    $stmt = $pdo->prepare("SELECT * FROM orders ORDER BY date1 desc");
                } else {
                    $stmt = $pdo->prepare("SELECT * FROM orders ORDER BY date1 asc");
                }
                $stmt->execute();
                $i=1;
                if($stmt->rowCount() >0) {
                    foreach($stmt as $orders) {
                        switch($orders['orderstatus']) {
                            case 7:
                                echo '<div class="order" name="hide7">';
                                break;
                            case 8: 
                                echo '<div class="order" name="hide8">';
                                break;
                            default:
                                echo '<div class="order">';
                                break;
                        }
                        echo 'Pan/Pani: ' . $result[$orders['client']-1]['name'] . '<br>Telefon: ' . $result[$orders['client']-1]['phone'] . ' <br>Sprzęt: ' . $orders['brand'] . ' ' . $orders['model'] . '<br>Wyposażenie: ' . $orders['additional'] . '<br>Status: ' . $statuses[$orders['orderstatus']] . '<br><section class="expired"> Dni od przyjęcia: ' . round((strtotime($now)-strtotime($orders['date1']))/(60*60*24)) . '</section> Data przyjęcia: ' . $orders['date1'] . ' <a href="order.php?id='.$orders['id'].'">Przejdź</a>' . '<br><br></div>';
                    }
                } else {
                    echo 'Nie znaleziono aktywnych serwisów';
                }
                $stmt->closeCursor();
            ?>
        </div>
    </div>
    <script>
        document.body.onload = function() {
            checkSearch();
            drawNav();
        }
    </script>
</body>

</html>