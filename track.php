<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function track() {
            var ar;
            if (window.XMLHttpRequest)
                ar = new XMLHttpRequest();
            else
                ar = new ActiveXObject("Microsoft.XMLHTTP");
            ar.onreadystatechange = function () {
                if (ar.readyState == 4 && ar.status == 200)
                    document.getElementById("ans").innerHTML = ar.responseText;
            }
            var f = document.getElementById("ref").value;
            ar.open("POST", "ajax/track.php", true);
            ar.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ar.send("ref=" + f);
        }
    </script>
</head>

<body>
    <div>
        <?php include("includes/header.php") ?>
    </div>
    <center>
        <h2><i class="nav-icon fas fa-boxes"></i> Track Parcel</h2>
        <form style="width: 80%; border-radius: 20px; background-color: azure; padding: 30px; height: max-content;">
            <h4 style="float: left;">Enter Referance Id</h4>
                <input type="text" id="ref" class="form-control"><br>
                <input type="button" value="track" onclick="track()" class="btn btn-primary">
            <div id="ans"></div>
        </form>
    </center>
    <div>
        <?php include("includes/footer.php") ?>
    </div>
</body>

</html>