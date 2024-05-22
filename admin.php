<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/354b185ae5.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            var html = '<tr><td><input placeholder="In Feet" class="form-control" type="number" name="height[]" required></td><td><input placeholder="In Feet" class="form-control" type="number" name="Width[]" required></td><td><input placeholder="In Feet" class="form-control" type="number" name="Length[]" required></td><td><input placeholder="In KG" class="form-control" type="number" name="Weight[]" required></td><td><input placeholder="In Rupees" class="form-control" type="number" name="Price[]" required></td><td><input class="btn btn-danger form-control" type="button" name="remove" id="remove" value="Remove"></td></tr>';
            var x = 1;
            var max = 3;
            $("#add").click(function () {
                if (x <= max) {
                    $("#table_field").append(html);
                    x++;
                }
            });
            $("#table_field").on('click', '#remove', function () {
                $(this).closest('tr').remove();
                x--;
            });

        });
    </script>
    <style>
        body {
            background-color: lightgrey;
        }

        .home {
            background-image: url("Images/Background.jpg");
            background-position: top;
            background-repeat: no-repeat;
            background-size: cover;
            height: 80vh;
            padding-bottom: 40px;
        }
        .home a{
            text-decoration: None;
            text-align: center;
            padding: center center;
        }
    </style>

</head>
<body>
    <section>
        <?php include("../includes/header.php") ?>
    </section>
    <section>
        
    </section>
    <section>
        <?php include("../includes/footer.php") ?>
    </section>
</body>

</html>