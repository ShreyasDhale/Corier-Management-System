<head>
    <script src="https://kit.fontawesome.com/354b185ae5.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    function logout() {
        if (confirm("Are You Sure To Logout")) { // Display confirmation dialog
            $.ajax({
                type: "GET", // HTTP method
                url: "includes/logout.php", // URL of the PHP script for handling logout
                success: function (data) { // Function to execute on success
                    // Optionally, you can handle success response here
                    location.href = "index.php"; // Redirect after successful logout
                },
                error: function (xhr, status, error) { // Function to execute on error
                    // Handle error if needed
                    confirm("Success");
                    console.error(xhr.responseText); // Log error message to console
                }
            });
        }
    }

</script>
<style>
    body {
        background: url("Images/Background1.jpg");
        opacity: 0.9;
        background-repeat: none;
        background-size: cover;
        background-attachment: fixed;
    }
</style>
<header>
    <?php
    session_start();
    $isAdmin = false;
    $usr = $_SESSION['usr'];
    include ('includes/Connection.php');
    $rs = $conn->query("SELECT isAdmin FROM login where user = '$usr'");
    if (!$rs) {
        die("Error executing query: " . $conn->errorCode());
    }
    if ($rs->rowCount() > 0) {
        while ($row = $rs->fetch()) {
            if ($row[0] == 1) {
                $isAdmin = true;
            } else {
                $isAdmin = false;
            }
        }
    }
    ?>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href=<?php if($isAdmin) echo "AdminHome.php"; else echo"parcels.php"?>><img src="Images/logo1.png" style="height: 40px; width: 75px;">
                &nbsp;<b><i>Corier Management System</i></b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarText">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="updateacc.php"><i class="fa-solid fa-gear"></i> Welcome
                            <strong style="color: white; font-size: 17px;"><i class="fa-solid fa-circle-user"></i>
                                <?= $usr ?>
                            </strong>
                        </a>
                    </li>
                    <?php
                    if ($isAdmin) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php" style="font-size: 17px;"><i
                                    class="fa-solid fa-gauge"></i><strong> Dashboard </strong></a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="UserListParcel.php" style="font-size: 17px;"><i
                                    class="fa-solid fa-gauge"></i><strong> List Parcels </strong></a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <button class="btn btn-danger" onclick="logout()"> <i
                                class="fa-sharp fa-solid fa-right-from-bracket"></i> <strong>Logout</strong></button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<section><br><br><br>

</section>