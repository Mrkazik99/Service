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
        <script>
            function goPrint(id) {
                location.href = 'printOrder.php?id='+id;
            }
            function updateStatus(id, el) {
                var diag = false;
                if(el.value==2||el.value==9) {
                    diag = true;
                    var diagContent = document.getElementById("diagnose").value;
                }
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        location.reload(true);
                    }
                };
                if(diag) {
                    xmlhttp.open("GET", 'updater.php?id=' + id + '&status=' + el.value + '&content=' + diagContent, true);
                } else {
                    xmlhttp.open("GET", 'updater.php?id=' + id + '&status=' + el.value, true);
                }
                xmlhttp.send();
            }
        </script>
    </head>

    <body id="fullscreen" onload="drawNav();">
        <?php
            require_once("nav.html");
            require_once("checkErrors.php");
            require_once("getCustomers.php");
            $statuses = array(
                1=> 'czeka na diagnoze',
                2=> 'postawiono diagnoze',
                3=> 'zaakceptowane',
                4=> 'czeka na czesci',
                5=> 'testy',
                6=> 'do odbioru',
                7=> 'odebrane',
                8=> 'zutylizowane',
                9=> 'wysłane do serwisu zewnętrznego'
            );
            $iswarranty = array(
                0=> 'nie',
                1=> 'tak'
            );
        ?>
        <div id="main-container" style="text-align:center;">
            <div id="single-order">
                <?php
                    if(!isset($_GET['id'])||$_GET['id']==''||!is_numeric($_GET['id'])) {
                        echo "Nie wybrano naprawy";
                    } else {
                        $id = $_GET['id'];
                        $stmt = $pdo->prepare("SELECT * FROM orders WHERE id=".$id);
                        $stmt->execute();
                        if($stmt->rowCount() >0) {
                            foreach($stmt as $order) {
                                echo 'Klient:<p class="tab">' . $result[$order['client']-1]['name'] . '<br>' . $result[$order['client']-1]['phone'] . '</p>';
                                echo 'Sprzęt:<p class="tab">' . $order['type'] . '<br>' . $order['brand'] . ' ' . $order['model'] . '<br>Wyposażenie: ' . $order['additional'] . '<br>Gwarancyjny: ' . $iswarranty[$order['warranty']];
                                if($order['warranty']==1) {
                                    echo '<br>Nr rachunku: ' . $order['billnumber'];
                                }
                                echo '<br>Problem: ' . $order['problem'] . '<br>Status: ' . $statuses[$order['orderstatus']];
                                if($order['orderstatus']>1&&$order['orderstatus']<9) {
                                    echo '<br>Diagnoza: ' . $order['diagnose'];
                                } else if($order['orderstatus']==9) {
                                    echo '<br>Serwis zewnętrzny: ' . $order['diagnose'];
                                }
                                echo '<br>Data przyjęcia: ' . $order['date1'];
                                if($order['orderstatus']>1&&$order['orderstatus']<9) {
                                    echo '<br>Data diagnozy: ' . $order['date2'];
                                } else if($order['orderstatus']==9) {
                                    echo '<br>Data wysłania do serwisu zewnętrznego: ' . $order['date2'];
                                }
                                if($order['orderstatus']==7) {
                                    echo '<br>Data odebrania: ' . $order['date3'];
                                } else if ($order['orderstatus']==8) {
                                    echo '<br>Data utylizacji: ' . $order['date3'];
                                }
                                echo '</p><br><br><button onclick="goPrint(' . $order['id'] . ')">Generuj druczek</button>';
                                echo '<br><br><br><textarea rows="10" cols="100" id="diagnose" placeholder="Diagnoza lub nazwa serwisu zewnętrznego"></textarea>';
                                echo '<br><select onchange="updateStatus(' . $order['id'] . ', this)" id="statusSelector">';
                                foreach($statuses as $val => $lab) {
                                    if($val != $order['orderstatus']) {
                                        echo '<option value="' . $val . '">' . $lab . '</option>';
                                    } else {
                                        echo '<option selected disabled value="' . $val . '">' . $lab . '</option>';
                                    }
                                }
                                echo '</select>';
                            }
                        } else {
                            echo 'Nie znaleziono serwisu o podanym identyfikatorze.';
                        }
                        $stmt->closeCursor();

                    }
                ?>
            </div>
        </div>
    </body>

</html>