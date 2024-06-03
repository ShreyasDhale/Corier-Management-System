<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: grey; /* Light gray background */
        }

        .container {
            margin-top: 50px; /* Add space from top */
            border-radius: 10px;
            width: 40%;
            background-color: #ffffff; /* White background */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add shadow */
            padding: 30px;
        }

        h2 {
            color: #343a40; /* Dark text color */
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            border-radius: 5px;
            border: 1px solid #ced4da; /* Gray border */
            padding: 10px;
            margin-bottom: 20px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus {
            outline: none;
            border-color: #007bff; /* Blue border on focus */
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Blue shadow on focus */
        }

        button[type="submit"] {
            border-radius: 5px;
            padding: 10px;
            background-color: #007bff; /* Blue button background */
            border: none;
            color: #ffffff; /* White text color */
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
 <?php 
    session_start();
 ?>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h2 class="text-center mb-4">Payment Form</h2>
                <form id="paymentForm" action="checkout.php" method="post">
                    <div class="mb-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" value=<?= $_SESSION['bill']?> class="form-control" id="amount" name="amount" disabled>
                    </div>
                    <input type="submit" value="Pay Now" class="btn btn-primary btn-block">
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>

</body>

</html>
