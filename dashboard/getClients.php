<?php
    require_once 'connection.php';
    echo'<datalist id="customer-name">';
    $stmt1 = $pdo->prepare('SELECT * FROM customers');
    $stmt1->execute();
    foreach($stmt1 as $clients) {
        echo '<option value="'.$clients['id'].'" label="'.$clients['name'].'">'.$clients['phone'];
    }
    $stmt1->closeCursor();
    echo '</datalist><datalist id="type-list">';
    $stmt2 = $pdo->prepare('SELECT * FROM types');
    $stmt2->execute();
    foreach($stmt2 as $types) {
        echo '<option value="'.$types['name'].'"</option>';
    }
    $stmt2->closeCursor();
    echo '</datalist>';
?>