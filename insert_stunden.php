<?php
$servername = "localhost";
$username = "username"; 
$password = "password"; 
$dbname = "database"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stndnMbFID = $_POST['stndnMbFID'];
$stndnProjektFID = $_POST['stndnProjektFID'];
$datum = $_POST['datum'];
$start = $_POST['start'];
$end = $_POST['end'];

$sql = "INSERT INTO tblStunden (stndnMbFID, stndnProjektFID, datum, start, end) 
        VALUES ('$stndnMbFID', '$stndnProjektFID', '$datum', '$start', '$end')";

if ($conn->query($sql) === TRUE) {
    echo "Datensatz erfolgreich eingefügt";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
