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
        <style>
            #contact {
                height:8%;
                font-weight:bold;
                text-align:center;
            }
            .part {
                height:42%;
                width:95%;
            }
            .date {
                text-align:right;
                width:100%;
                margin:0px;
            }
            .title {
                font-size:24;
                text-align:center;
                font-weight:bold;
                width:100%;
                margin:0px;
            }
            .type {
                font-style:italic;
                text-align:center;
                width:100%;
                margin-top:0px;
            }
            .left {
                float:left;
                width:50%;
                text-align:center;
            }
            .right {
                float:right;
                width:50%;
                text-align:center;
            }
        </style>
    </head>

    <body id="fullscreen">
        <div id="main-container" style="height:260mm;width:209mm;">
            <p id="contact">
                PC-EKSPERT Jarosław Nowak<br>
                ul. Tuszewska 45/10 (pasaż intermarche)<br>
                Tel. (46) 837 74 60
            <hr>
            </p>
            <?php
                require_once("getCustomers.php");
                if(!isset($_GET['id'])||$_GET['id']==''||!is_numeric($_GET['id'])) {
                    echo "Nie wybrano naprawy";
                } else {
                    $id = $_GET['id'];
                    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id=".$id);
                    $stmt->execute();
                    if($stmt->rowCount() >0) {
                        foreach($stmt as $order) {
                            $name = $result[$order['client']-1]['name'];
                            $lastname = $result[$order['client']-1]['phone'];
                            $type = $order['type'];
                            $brand = $order['brand'];
                            $model = $order['model'];
                            $additional = $order['additional'];
                            $problem = $order['problem'];
echo <<<EOL
<section class="part">
    <p class="title">
        Zgłoszenie serwisowe<br>
        Oryginał
    </p><br><br>
    Klient: $name, telefon kontaktowy: $lastname<br><br>
    Sprzęt: $type $brand $model<br><br>
    Wyposażenie dodatkowe: $additional<br><br>
    Objawy: $problem<br><br><br><br>
    <p class="left">
        Podpis serwisanta:<br><br><br><br><br>
        ...................................................
    </p>
    <p class="right">
        Podpis klienta:<br><br><br><br><br>
        ...................................................
    </p>
</section>
<hr><br>
<section class="part">
    <p class="title">
        Zgłoszenie serwisowe<br>
        Kopia
    </p><br><br>
    Klient: $name, telefon kontaktowy: $lastname<br><br>
    Sprzęt: $type $brand $model<br><br>
    Wyposażenie dodatkowe: $additional<br><br>
    Objawy: $problem<br><br><br><br>
    <p class="left">
        Podpis serwisanta:<br><br><br><br><br>
        ...................................................
    </p>
    <p class="right">
        Podpis klienta:<br><br><br><br><br>
        ...................................................
    </p>
</section>
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