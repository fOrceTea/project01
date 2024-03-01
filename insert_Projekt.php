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

$sql_kunden = "SELECT * FROM tblKunden";
$result_kunden = $conn->query($sql_kunden);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projektKndFID = $_POST["projektKndFID"];
    $projektName = $_POST["projektName"];
    $sql = "INSERT INTO tblProjekte (projektKndFID, projektName) VALUES ('$projektKndFID', '$projektName')";
    if ($conn->query($sql) === TRUE) {
        echo "Projekt erfolgreich hinzugefügt.";
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
    <title>Projekt anlegen</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">       
        <main>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <div class="form-group">
                    <label for="projektKndFID">Kunde:</label>
                    <select class="form-control" id="projektKndFID" name="projektKndFID">
                        <?php
                        if ($result_kunden->num_rows > 0) {
                            while ($row = $result_kunden->fetch_assoc()) {
                                echo "<option value='" . $row["kdnID"] . "'>" . $row["kndName"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="projektName">Projekt Name:</label>
                    <input type="text" class="form-control" id="projektName" name="projektName">
                </div>
                <button type="submit" class="btn btn-primary">Projekt anlegen</button>
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
