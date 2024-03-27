<?php
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM customer details WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
                $id = $row["id"];
                $first_name = $row["first name"];
                $last_name = $row["last name"];
                $email = $row["e-mail"];
                $DOB = $row["D.O.B"];
                $gender = $row["gender"];
                $contact = $row["contact"];
                $departure_city = $row["departure city"];
                $destination_city = $row["destination city"];
                $flight_number = $row["flight number"];
                
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Id</label>
                        <p><b><?php echo $row["id"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>First name</label>
                        <p><b><?php echo $row["first_name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Last name</label>
                        <p><b><?php echo $row["last_name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <p><b><?php echo $row["email"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>D.O.B</label>
                        <p><b><?php echo $row["DOB"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <p><b><?php echo $row["gender"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Contact</label>
                        <p><b><?php echo $row["contact"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Departure city</label>
                        <p><b><?php echo $row["departure_city"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Destination city</label>
                        <p><b><?php echo $row["destination_city"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Flight Number</label>
                        <p><b><?php echo $row["flight_number"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>