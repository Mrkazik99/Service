<!DOCTYPE html>
<html>

<head>
    <title>Serwis</title>
    <meta charset="utf-8">
    <script src="/service/assets/js/sweetalerts.js"></script>
    <link rel="stylesheet" href="/service/assets/css/main.css">
</head>

<body>
    <?php
    if(!isset($_GET["token"])&&!isset($_GET["pass"])) {
echo <<<EOL
        <form name="tokenForm" action="index.php" method="get">
            <input type="text" name="token"><br>
            <input type="text" name="pass"><br>
            <input type="submit" value="Sprawdź status naprawy">
        </form>
EOL;
    } else {
        echo $_GET["token"];
        echo $_GET["pass"];
    }
    ?>
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
            html: 'Kontynując korzystanie z naszej aplikacji akceptujesz warunki <a href="/serwis/reg.html">regulaminu</a>.'
        })
    </script>
</body>

</html>