<?php
    session_start();
    if(isset($_POST['customer-choice'])&&$_POST['customer-choice']=='') {
        $inputClient=1;
        $clientID=$_POST['count'];
    } else if(is_numeric($_POST['customer-choice'])) {
        $inputClient=0;
        $clientID=$_POST['customer-choice'];
    } else {
        $_SESSION['error'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timerProgressBar: false,showCloseButton: true});Toast.fire({icon: "error",title: "Wystąpił niezydentyfikowany problem.",text: "Jeżeli będzie to pojawiało się częściej skontaktuj się z pomocą techniczą."})</script>';
        header ('Location: index.php');
    }
    require_once 'connection.php';
    echo $_POST['customer-choice']. '<br>';
    echo $_POST['name']. '<br>';
    echo $_POST['phone']. '<br>';
    echo $_POST['type-choice']. '<br>';
    echo $_POST['brand']. '<br>';
    echo $_POST['model']. '<br>';
    echo $_POST['additional']. '<br>';
    echo $_POST['problem']. '<br>';
    echo $_POST['count'];
    echo '<br><br><br>Dane do bazy:<br>';
    echo 'Czy wprowadzamy? '.$inputClient. '<br>';
    echo 'Numer klienta: '.$clientID. '<br>';
    if($inputClient!=0) {
        $stmtClient = $pdo->prepare('INSERT INTO customers (`name`, `phone`) VALUES ("'. $_POST['name'] .'", "'. $_POST['phone'] .'")');
        $stmtClient->execute();
        $stmtClient->closeCursor();
        echo $_POST['name']. '<br>';
        echo $_POST['phone']. '<br>';
    }
    if(isset($_POST['warranty'])) {
        echo $_POST['warranty']. '<br>';
        echo $_POST['bill']. '<br>';
        $stmt = $pdo->prepare('INSERT INTO orders (`type`, `brand`, `model`, `additional`, `orderstatus`, `client`, `warranty`, `billnumber`, `problem`, `date1`) VALUES ("'. $_POST['type-choice'] .'", "'. $_POST['brand'] .'", "'. $_POST['model'] .'", "'. $_POST['additional'] .'", 1, "'. $clientID .'", 1, "'. $_POST['bill'] .'", "'. $_POST['problem'] .'", "'. date('Y-m-d') .'")');
    } else {
        $stmt = $pdo->prepare('INSERT INTO orders (`type`, `brand`, `model`, `additional`, `orderstatus`, `client`, `warranty`, `problem`, `date1`) VALUES ("'. $_POST['type-choice'] .'", "'. $_POST['brand'] .'", "'. $_POST['model'] .'", "'. $_POST['additional'] .'", 1, "'. $clientID .'", 0, "'. $_POST['problem'] .'", "'. date('Y-m-d') .'")');
    }
    $stmt->execute();
    $stmt->close;
    echo $_POST['type-choice']. '<br>';
    echo $_POST['brand']. '<br>';
    echo $_POST['model']. '<br>';
    echo $_POST['additional']. '<br>';



    header ('Location: index.php');
?>