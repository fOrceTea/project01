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

$sql_mitarbeiter = "SELECT * FROM tblMitarbeiter";
$result_mitarbeiter = $conn->query($sql_mitarbeiter);

$sql_projekte = "SELECT * FROM tblProjekte";
$result_projekte = $conn->query($sql_projekte);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stndnMbFID = $_POST["stndnMbFID"];
    $projektID = $_POST["projektID"];
    $start = $_POST["start"];
    $end = $_POST["end"];
    $sql = "INSERT INTO tblStunden (stndnMbFID, stndnProjektFID, stndnStart, stndnEnd) VALUES ('$stndnMbFID', '$projektID', '$start', '$end')";
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
                    <label for="stndnMbFID">Mitarbeiter:</label>
                    <select class="form-control" id="stndnMbFID" name="stndnMbFID">
                        <?php
                        if ($result_mitarbeiter->num_rows > 0) {
                            while ($row = $result_mitarbeiter->fetch_assoc()) {
                                echo "<option value='" . $row["mbID"] . "'>" . $row["mbName"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="projektID">Projekt:</label>
                    <select class="form-control" id="projektID" name="projektID">
                        <?php
                        if ($result_projekte->num_rows > 0) {
                            while ($row = $result_projekte->fetch_assoc()) {
                                echo "<option value='" . $row["projektID"] . "'>" . $row["projektName"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="start">Startzeit:</label>
                    <input type="datetime-local" class="form-control" id="start" name="start">
                </div>
                <div class="form-group">
                    <label for="end">Endzeit:</label>
                    <input type="datetime-local" class="form-control" id="end" name="end">
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
