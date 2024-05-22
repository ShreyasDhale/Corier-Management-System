<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #preloader {
            background-image: url("circle.gif");
            background-color: white;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh;
            width: 100%;
            position: fixed;
            z-index: 100;
        }
    </style>
</head>

<body>
    <div id="preloader">
    </div>
    <script>
        var pre = document.getElementById("preloader");
        window.addEventListener("load", function () {
            pre.style.display = "none";
        })
    </script>
</body>

</html>