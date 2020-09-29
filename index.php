<!DOCTYPE html>
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
                    html: 'Kontynując korzystanie z naszej aplikacji akceptujesz warunki <a href="/serwis/reg.html">regulaminu</a>.'
                });
            }
        });
    </script>
    <div id="main-content">
        <h1>PC-Ekspert</h1>
        <p></p>
        <a href="dashboard"><button class="pick-action">Logowanie serwisu</button></a><br>
        <a href="rma"><button class="pick-action">Sprawdź swoje zgłoszenie</button></a>
    </div>
</body>

</html>