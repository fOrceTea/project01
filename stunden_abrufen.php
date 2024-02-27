<?php

$servername = "localhost";
$username = "username"; 
$password = "password"; 
$dbname = "dbUnternehmen"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen der Verbindung
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projektID = $_POST['projektID'];

    $sql = "SELECT * FROM tblStunden WHERE stndnProjektFID = $projektID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr><th>Stunden ID</th><th>Mitarbeiter ID</th><th>Datum</th><th>Startzeit</th><th>Endzeit</th></tr></thead>";
        echo "<tbody>";
 
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["stndnID"]."</td><td>".$row["stndnMbFID"]."</td><td>".$row["datum"]."</td><td>".$row["start"]."</td><td>".$row["end"]."</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "Keine Stunden gefunden.";
    }
}

$conn->close();
?>