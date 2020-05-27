<?php
    session_start();
    if(isset($_POST['customer-choice'])) {
        echo 'Siema';
    } else if (isset($_POST['name'])) {
        echo 'Siema';
    } else {
        $_SESSION['error'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timerProgressBar: false,showCloseButton: true});Toast.fire({icon: "error",title: "Wystąpił niezydentyfikowany problem.",text: "Jeżeli będzie to pojawiało się częściej skontaktuj się z pomocą techniczą."})</script>';
        header ('Location: index.php');
    }
    require_once 'connection.php';























    header ('Location: index.php');
?>