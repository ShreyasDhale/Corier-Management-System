<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    <script src="https://kit.fontawesome.com/354b185ae5.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function admin() {
            window.open("Admin/login.php","_targate1") ;
        }
        function user() {
            window.open("User/login.php","_targate");
        }
    </script>
</head>
<center>
<body style="background-color: lightgrey;">
    <form action="" class="login-form">
        <H1>Are You Admin or User</H1>
        <input type="button" value="Admin" onclick="admin()" class="btn btn-success" style="width: 120px;">
        <input type="button" value="User" onclick="user()" class="btn btn-warning" style="width: 120px;">
    </form>
</body>
</center>

</html>