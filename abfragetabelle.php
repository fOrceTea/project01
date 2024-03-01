<?php
// Initialize the session
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arbeitszeittabelle</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
    <style>
        .filterDiv {
            display: none;
        }

        .show {
            display: block;
        }
    </style>

</head>

<body>

    <div class="container">

        <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbUnternehmen";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Verbindung fehlgeschlagen: " . $conn->connect_error);
        }

        ?>




        <!-- ------------------------- -->
        <header>
            <h1>Stunden und Kunden</h1>
        </header>


        <main>
            <div class="btn-group" role="group" aria-label="Basic example">

                <!-- Mitarbeiter -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mitarbeiter
                    </button>
                    <div class="myBtnContainer">

                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                            <button class="btn active dropdown-item" type="button"
                                onclick="filterSelection('all')">Zeige
                                alle</button>

                            <?php
                            $sql = "SELECT * FROM tblMitarbeiter";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    ?>

                                    <button class="btn dropdown-item"
                                        onclick="filterSelection('mitarbeiterNr<?= $row['mbID']; ?>')">
                                        <?= $row['mbName']; ?>
                                    </button>


                                    <?php
                                }
                            } else {
                                echo "Keine Datensätze gefunden";
                            }

                            ?>
                        </div>

                    </div>
                </div>


                <!-- Kunde -->
                <div class="dropdown">

                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Kunde
                    </button>

                    <div class="myBtnContainer">

                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                            <button class="btn active dropdown-item" type="button"
                                onclick="filterSelection('all')">Zeige
                                alle</button>

                            <?php
                            $sql = "SELECT * FROM tblKunden";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    ?>

                                    <button class="btn dropdown-item" onclick="filterSelection('kdnIDNr<?= $row['kdnID']; ?>')">
                                        <?= $row['kndName']; ?>
                                    </button>

                                    <?php
                                }
                            } else {
                                echo "Keine Datensätze gefunden";
                            }

                            ?>
                        </div>

                    </div>
                </div>

                <!-- Projekt -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Projekt
                    </button>
                    <div class="myBtnContainer">

                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                            <button class="btn active dropdown-item" type="button"
                                onclick="filterSelection('all')">Zeige
                                alle</button>

                            <?php
                            $sql = "SELECT * FROM tblProjekte";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    ?>

                                    <button class="btn dropdown-item"
                                        onclick="filterSelection('projektNr<?= $row['projektID']; ?>')">
                                        <?= $row['projektName']; ?>
                                    </button>


                                    <?php
                                }
                            } else {
                                echo "Keine Datensätze gefunden";
                            }

                            ?>
                        </div>

                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-secondary" onclick="calculateTotalHours()">Stunden
                    berechnen: </button>
                </div>
                <div>
                    <span id="hoursCalculateTxt" class="btn btn-secondary">--</span>
                </div>


            </div>
            <table class="table">

                <?php

                $sql = "SELECT * FROM tblMitarbeiter, tblKunden, tblProjekte, tblStunden 
                        WHERE tblStunden.stndnProjektFID = tblProjekte.projektID
                        AND tblStunden.stndnMbFID = tblMitarbeiter.mbID
                        AND tblProjekte.projektKndFID = tblKunden.kdnID";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        ?>

                        <tr
                            class="filterDiv kdnIDNr<?= $row['kdnID']; ?> projektNr<?= $row['projektID']; ?> mitarbeiterNr<?= $row['mbID']; ?>">
                            <td>
                                <?= $row['mbName']; ?>
                            </td>
                            <td>
                                <?= $row['kndName']; ?>
                            </td>
                            <td>
                                <?= $row['projektName']; ?>
                            </td>
                            <td>
                                <?= $row['stndnStart']; ?>
                            </td>
                            <td>
                                <?= $row['stndnEnd']; ?>
                            </td>
                        </tr>

                        <?php
                    }
                    echo "";

                } else {
                    echo "Keine Datensätze gefunden";
                }

                $conn->close();
                ?>
            </table>



            <!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_filter_elements -->

            <script>
                filterSelection("all")

                function filterSelection(c) {
                    var x, i;
                    x = document.getElementsByClassName("filterDiv");
                    if (c == "all") c = "";
                    for (i = 0; i < x.length; i++) {
                        w3RemoveClass(x[i], "show");
                        if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
                    }

                }

                function w3AddClass(element, name) {
                    var i, arr1, arr2;
                    arr1 = element.className.split(" ");
                    arr2 = name.split(" ");
                    for (i = 0; i < arr2.length; i++) {
                        if (arr1.indexOf(arr2[i]) == -1) { element.className += " " + arr2[i]; }
                    }
                }

                function w3RemoveClass(element, name) {
                    var i, arr1, arr2;
                    arr1 = element.className.split(" ");
                    arr2 = name.split(" ");
                    for (i = 0; i < arr2.length; i++) {
                        while (arr1.indexOf(arr2[i]) > -1) {
                            arr1.splice(arr1.indexOf(arr2[i]), 1);
                        }
                    }
                    element.className = arr1.join(" ");
                }

                // Add active class to the current button (highlight it)
                var btnContainer = document.getElementsByClassName("myBtnContainer");
                var btns = btnContainer.getElementsByClassName("btn");
                for (var i = 0; i < btns.length; i++) {
                    btns[i].addEventListener("click", function () {
                        var current = document.getElementsByClassName("active");
                        current[0].className = current[0].className.replace(" active", "");
                        this.className += " active";
                    });
                }

                function calculateTotalHours() {
                    let table = document.querySelector("table");
                    let rows = table.querySelectorAll(".filterDiv.show");
                    let totalHours = 0;

                    for (var i = 0; i < rows.length; i++) {
                        let cells = rows[i].getElementsByTagName("td");
                        let startTime = new Date(cells[3].textContent).getTime();
                        let endTime = new Date(cells[4].textContent).getTime();
                        let hoursDifference = (endTime - startTime) / (1000 * 60 * 60);
                        totalHours += hoursDifference;
                    }

                    document.getElementById("hoursCalculateTxt").textContent = totalHours;
                }

                calculateTotalHours();

                setInterval(calculateTotalHours, 500);

            </script>

        </main>



        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrp/4.0.0/js/bootstrap.min.js"></script>

    </div>
</body>

</html>