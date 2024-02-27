<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbUnternehmen";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mbID = $_SESSION["id"]; // Assuming you have stored member ID in session after login
    $projektID = $_POST["projektID"];
    $datum = $_POST["datum"];
    $start = $_POST["start"];
    $end = $_POST["end"];

    // Insert data into database
    $sql = "INSERT INTO tblStunden (stndnMbFID, stndnProjektFID, datum, start, end) VALUES ('$mbID', '$projektID', '$datum', '$start', '$end')";

    if ($conn->query($sql) === TRUE) {
        echo "Stunden erfolgreich aufgezeichnet.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arbeitszeittabelle</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Stunden und Kunden</h1>
        </header>

        <main>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <div class="form-group">
                    <label for="projektID">Projekt ID:</label>
                    <input type="text" class="form-control" id="projektID" name="projektID">
                </div>
                <div class="form-group">
                    <label for="datum">Datum:</label>
                    <input type="date" class="form-control" id="datum" name="datum">
                </div>
                <div class="form-group">
                    <label for="start">Startzeit:</label>
                    <input type="time" class="form-control" id="start" name="start">
                </div>
                <div class="form-group">
                    <label for="end">Endzeit:</label>
                    <input type="time" class="form-control" id="end" name="end">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </main>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </div>
</body>

</html>

<?php
// Close connection
$conn->close();
?>
