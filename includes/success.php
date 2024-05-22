<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script>
        // Show the notification
        document.querySelector('.notification');

        // Hide the notification after 5 seconds
        setTimeout(function () {
            $('.notification').fadeOut();
        }, 4000);
    </script>
    <style>
        .update{
            display: none;
        }
        .save{
            display: none;
        }
        .delete{
            display: none;
        }
        .notification {
            background-color: green;
            padding: 20px;
            border-radius: 10px;
            position: fixed;
            bottom: 130px;
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
    <?php if (strcmp($msg,"save")==0) { ?>
    <style>
        .save{
            display: block;
        }
    </style>
    <?php }?>
     <?php if (strcmp($msg,"update")==0) { ?>
    <style>
        .update{
            display: block;
        }
    </style><?php }?>
     <?php if (strcmp($msg,"delete")==0) { ?>
    <style>
        .delete{
            display: block;
        }
    </style><?php }?>
    
    <div class="save notification">
        <div class="notification-header">
            <h2>Success !!</h2>
        </div>
        <p>Data Saved Successfully !!</p>
    </div>
    <div class="update notification">
        <div class="notification-header">
            <h2>Success !!</h2>
        </div>
        <p>Data Updated Successfully !!</p>
    </div>
    <div class="delete notification">
        <div class="notification-header">
            <h2>Success !!</h2>
        </div>
        <p>Data Deleted Successfully !!</p>
    </div>
</body>
</html>