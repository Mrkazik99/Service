<!DOCTYPE html>
<?php
    require_once 'connection.php';
    session_start();
    if(isset($_POST['login'])&&isset($_POST['pass'])){
        sleep(1);
    }
    if(!isset($_SESSION['userName'])) {
        $_SESSION['userName']="kurwa";
    } else if (isset($_SESSION['userName'])&&isset($_SESSION['lastIp'])&&isset($_COOKIE['session'])){
        header('Location: index.php');
    } else {
        header('Location: index.php');
    }
?>
<html>

<head>
    <title>Serwis</title>
    <meta charset="utf-8">
    <script src="/service/assets/js/sweetalerts.js"></script>
    <script src="/service/assets/js/jquerry.js"></script>
    <link rel="stylesheet" href="/service/assets/css/main.css">
</head>

<body id="main-body">
    <script>
        console.log(navigator.cookieEnabled)
        $(document).ready( function(){
            if(!navigator.cookieEnabled){
                document.body.innerHTML="";
                document.body.style.background="#000000";
                swal.fire({
                    title:"Włącz obsługę Plików Cookies", 
                    icon:"warning", 
                    allowOutsideClick:false}).then((result) => {window.location.reload(true)});
            } else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: false,
                    showCloseButton: true
                });
                Toast.fire({
                    icon: 'info',
                    title: 'Ta strona wykorzystuje pliki cookies.',
                    html: 'Kontynując korzystanie z naszej aplikacji akceptujesz warunki <a href="/service/reg.html">regulaminu</a>.'
                });
            }
        });
    </script>
    <div id="main-content">
        <h1>Zaloguj się do, aby zarządzać swoim serwisem.</h1>
        <form id="loginForm" class="form" name="loginForm" action="login.php" method="post">
            <label for="login">Login lub email:</label><br>
            <input class="input" type="text" name="login"><br>
            <label for="pass">Hasło:</label><br>
            <input class="input" type="password" name="pass"><br>
            <input class="input" type="submit" value="Zaloguj"><br>
        </form>
    </div>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timerProgressBar: false,
            showCloseButton: true
        })
        Toast.fire({
            icon: 'info',
            title: 'Ta strona wykorzystuje pliki cookies.',
            html: 'Kontynując korzystanie z naszej aplikacji akceptujesz warunki <a href="/service/reg.html">regulaminu</a>.'
        })
    </script>
</body>

</html>