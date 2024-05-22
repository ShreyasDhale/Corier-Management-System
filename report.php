<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js">
    </script>
    <title>Document</title>
    <script>
        function report() {
            var ar;
            if (window.XMLHttpRequest)
                ar = new XMLHttpRequest();
            else
                ar = new ActiveXObject("Microsoft.XMLHTTP");
            ar.onreadystatechange = function () {
                if (ar.readyState == 4 && ar.status == 200)
                    document.getElementById("ans").innerHTML = ar.responseText;
            }
            var f = document.getElementById("track").value;
            var s = document.getElementById("from").value;
            var t = document.getElementById("to").value;
            var b = document.getElementById("btn").value;
            ar.open("POST", "ajax/report.php", true);
            ar.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ar.send("track=" + f + "&from=" + s + "&to=" + t + "&btn=" + b);
        }
        function print() {
            if (document.getElementById("ans").innerHTML == "") {
                alert("Plese Generate Report First");
                document.getElementById("btn2").disabled == true;
            }
            else {
                var button = document.getElementById("btn2");
                var makepdf = document.getElementById("ans");

                button.addEventListener("click", function () {
                    var mywindow = window.open("", "PRINT",
                        "height=720,width=1080");

                    mywindow.document.write(makepdf.innerHTML);

                    mywindow.document.close();
                    mywindow.focus();

                    mywindow.print();
                    mywindow.close();

                    return true;
                });
            }
        }

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <style>
        .alert {
            display: none;
        }
    </style>

</head>

<body>
    <?php session_start();
    $error = "";
    include("includes/header.php"); ?>
    <center><br>
        <div style="height: max-content;">
            <form class="login-form"
                style="width: 80%;padding: 40px; background-color: azure; height :max-content ;border-radius: 20px;">
                <h1 name="new_parcle" style="font-family: Arial;"><i class="fa-solid fa-file-lines"></i> Reports</h1><br>
                <div class="row">
                    <div class="col">
                        <h5>Choose Item Status</h5>
                        <select id="track" class="form-select">
                            <option value="select" selected>Select Item Status</option>
                            <?php
                            echo "
                            <option value=0>Item Accepted By Corier</option>
                            <option value=1>Shipped</option>
                            <option value=2>In-Transit</option>
                            <option value=3>Arrived at Destination</option>
                            <option value=4>Out For Delivery</option>
                            <option value=5>Delivered</option>
                            ";
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <h5>From Date</h5>
                        <input type="date" id="from" class="form-control" required>
                    </div>
                    <div class="col">
                        <h5>To Date</h5>
                        <input type="date" id="to" class="form-control" required>
                    </div>
                </div>
                <input type="button" value="Generate Report" class="btn btn-primary"
                    style="width: 15%; height: 10%;margin-top: 30px;" onclick="report()" id="btn">
                <input type="button" value="Print" class="btn btn-warning"
                    style="width: 15%; height: 10%;margin-top: 30px;" onclick="print()" id="btn2"><br><br>

                <div id="ans"></div>
            </form><br><br><br><br>
        </div>

    </center>
    <?php include("includes/footer.php"); ?>
</body>

</html>