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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mstndnMbFID = $_POST["stndnMbFID"];
    $projektID = $_POST["projektID"];
    $datum = $_POST["datum"];
    $start = $_POST["stndnStart"];
    $end = $_POST["stndnEnd"];

    $sql = "INSERT INTO tblStunden (stndnMbFID, stndnProjektFID, stndnStart, stndnEnd) VALUES ('$stndnMbFID', '$projektID', '$datum', '$start', '$end')";

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">       
        <main>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                    <label for="start">Mitarbeiter ID:</label>
                    <input type="text" class="form-control" id="stndnMbFID" name="stndnMbFID">
                </div>
                <div class="form-group">
                    <label for="projektID">Projekt ID:</label>
                    <input type="text" class="form-control" id="projektID" name="projektID">
                </div>
                <div class="form-group">
                    <label for="start">Startzeit:</label>
                    <input type="datetime" class="form-control" id="start" name="start">
                </div>
                <div class="form-group">
                    <label for="end">Endzeit:</label>
                    <input type="datetime" class="form-control" id="end" name="end">
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
