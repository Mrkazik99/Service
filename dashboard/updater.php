<?php
    require_once 'connection.php';
    $date = date('Y-m-d');
    $id = $_GET['id'];
    $status = $_GET['status'];
    if($status == 2 || $status == 9) {
        $content = $_GET['content'];
        $stmt = $pdo->prepare('UPDATE `orders` SET `orderstatus` = ' . $status . ', `diagnose` = "' . $content . '", `date2` = now() WHERE id =' . $id);
    } else if($status == 7 || $status == 8) {
        $stmt = $pdo->prepare('UPDATE `orders` SET `orderstatus` = ' . $status . ', `date3` = now() WHERE id =' . $id);
    } else {
        $stmt = $pdo->prepare('UPDATE `orders` SET `orderstatus` = ' . $status . ' WHERE id =' . $id);
    }
    // if($status==2||$status==9) {
    //     $content = $_GET['content'];
    //     $stmt = $pdo->prepare('UPDATE `orders` SET `orderstatus` = ' . $status . ', `diagnose` = "' . $content . '" WHERE id =' . $id);
    // } else {
    //     $stmt = $pdo->prepare('UPDATE `orders` SET `orderstatus` = ' . $status . ' WHERE id =' . $id);
    // }
    $stmt->execute();
    //header('Location: order.php?id=' . $id);
?>