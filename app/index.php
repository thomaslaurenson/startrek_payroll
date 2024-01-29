<?php
$host = "startrek-payroll-mysql";
$db_name = $_SERVER["MYSQL_DATABASE"];
$db_username = $_SERVER["MYSQL_USER"];
$db_password = $_SERVER["MYSQL_PASSWORD"];

$conn = new mysqli($host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_POST['s'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Payroll Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                background-color: #f8f9fa;
                padding-top: 50px;
            }

            form {
                max-width: 400px;
                margin: 0 auto;
                padding: 15px;
                background-color: #ffffff;
                border: 1px solid #dee2e6;
                border-radius: 5px;
                margin-top: 50px;
            }

            h2 {
                text-align: center;
                margin-bottom: 20px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <form action="" method="post">
                <h2>Payroll Login</h2>
                <div class="form-group">
                    <label for="user">User:</label>
                    <input type="text" class="form-control" name="user" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="s">OK</button>
            </form>
        </div>
    </body>

    </html>

    <?php
}

if ($_POST) {
    $user = $_POST['user'];
    error_log("USERNAME:" . $user);
    $pass = $_POST['password'];
    error_log("PASSWORD:" . $pass);

    $sql = "SELECT username, salary FROM users WHERE username = '$user' AND password = '$pass'";
    error_log("QUERY:" . $sql);

    if ($conn->multi_query($sql)) {
        do {
            echo "<div class='container'>";
            echo "<h2 class='text-center'>Welcome, " . $user . "</h2><br>";
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-light'><tr><th>Username</th><th>Salary</th></tr></thead><tbody>";

            if ($result = $conn->store_result()) {
                while ($row = $result->fetch_assoc()) {
                    $keys = array_keys($row);
                    echo "<tr>";
                    foreach ($keys as $key) {
                        echo "<td>" . $row[$key] . "</td>";
                    }
                    echo "</tr>\n";
                }
                $result->free();
            }

            if (!$conn->more_results()) {
                echo "</tbody></table></div>";
            }

        } while ($conn->next_result());
    }
}
?>

