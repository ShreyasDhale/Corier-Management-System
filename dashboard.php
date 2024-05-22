<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .row {
            width: 90%;
            height: 250px;
            display: flex;
            margin: auto;
            background-color: ;
        }

        .col {
            text-align: center;
            width: 200px;
            height: 200px;
            margin: auto;
        }

        .col1 {
            padding: 10px;
            width: 180px;
            height: 180px;
            margin: 5% auto;
            box-shadow: 0 0 15px 1px black;
            background-color: white;
            transition: 0.5s;
        }

        .col1:hover {
            width: 200px;
            height: 200px;
        }
    </style>
    <script>
        function addbr() {
            location.href = "branch.php";
        }
        function list() {
            location.href = "deletebr.php";
        }
        function liststaff() {
            location.href = "liststaff.php";
        }
        function addadmin() {
            location.href = "signup.php";
        }
        function order() {
            location.href = "AdminListParcel.php";
        }
        function report() {
            location.href = "report.php";
        }
        
    </script>
</head>

<body>
    <div>
        <?php include("includes/header.php") ?>
    </div>
    <center>
        
            <h3 style="color: white;"><i class="fa-solid fa-gauge"></i> Dashboard</h3>
        <div class="row">
            <div class="col">
                <div class="col1" onclick="addbr()">
                    Add New Branch <br><br>
                    <i class="fa-solid fa-building fa-6x"></i>
                </div>
            </div>
            <div class="col">
                <div class="col1" onclick="list()">
                    List/Delete Branches <br><br>
                    <i class="fa-solid fa-city fa-6x"></i>
                </div>
            </div>
            <div class="col">
                <div class="col1" onclick="addadmin()">
                    New Staff Signup<br><br>
                    <i class="fa-solid fa-users fa-6x"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="col1" onclick="order()">
                    Orderd Parcels And Update Status<br>
                    <i class="fa-sharp fa-solid fa-pen-to-square fa-6x"></i>
                </div>
            </div>
            <div class="col">
                <div class="col1" onclick="liststaff()">
                    List/Delete Staff<br><br>
                    <i class="fa-solid fa-users fa-6x"></i>
                </div>
            </div>
            <div class="col">
                <div class="col1" onclick="report()">
                    Reports <br><br>
                    <i class="fa-solid fa-file-lines fa-6x"></i> 
                </div>
            </div>
        </div>
    </center>
    <div>
        <?php include("includes/footer.php") ?>
    </div>
</body>

</html>