<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/354b185ae5.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Show the notification
        document.querySelector('.notification');

        // Hide the notification after 5 seconds
        setTimeout(function () {
            $('.notification').fadeOut();
        }, 5000);
    </script>
    <style>
        .notification {
            background-color: red;
            padding: 20px;
            border-radius: 10px;
            position: fixed;
            bottom: 20px;
            right: 20px;
            animation: slide-in-right 0.5s;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .notification h2 {
            margin: 0;
            color: white;
        }

        .notification p {
            margin: 0;
            color: white;
        }

        @Keyframes slide-in-right {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(0%);
            }
        }
    </style>
</head>

<body>
    <div class="notification">
        <div class="notification-header">
            <h2>Failed</h2>
        </div>
    </div>

</body>

</html>