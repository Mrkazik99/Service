<?php
    $stmtC = $pdo->prepare('SELECT * FROM customers');
    $stmtC->execute();
    $result = $stmtC->fetchAll(PDO::FETCH_ASSOC);
    $stmtC->closeCursor();
?>