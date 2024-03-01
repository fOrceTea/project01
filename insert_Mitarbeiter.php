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
    $mbName = $_POST["mbName"];
    $sql = "INSERT INTO tblMitarbeiter (mbName) VALUES ('$mbName')";
    if ($conn->query($sql) === TRUE) {
        echo "Mitarbeiter erfolgreich hinzugefügt.";
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
    <title>Mitarbeiter hinzufügen</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">       
        <main>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <div class="form-group">
                    <label for="mbName">Mitarbeiter Name:</label>
                    <input type="text" class="form-control" id="mbName" name="mbName">
                </div>
                <button type="submit" class="btn btn-primary">Mitarbeiter hinzufügen</button>
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
