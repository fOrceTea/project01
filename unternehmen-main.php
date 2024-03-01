<?php

// Initialize the session
session_start();
 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbUnternehmen";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GmbH</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


        <style>
            body {
                width: 100%;
            }
            table {
                width: 1290px;
            }

            footer {
                width: 100%;
                height: 110px;
            }
            .flex-container {
                height: 500px;
                width: 100%;
            }

            #divContent2,
            #divContent3,
            #divContent5,
            #divContent4 {
                display: none;
            }

            #divContent1 > iframe,
            #divContent2 > iframe,
            #divContent3 > iframe,
            #divContent5 > iframe,
            #divContent4 > iframe {
                width: 1290px;
                height: 100%;
            }

        </style>

<link rel="stylesheet" href="demo-stylesheet.css">


</head>

<body>

    <header class="bg-primary text-white p-3">
        

    </header>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">

        <div class="container-fluid">

            <a class="navbar-brand" href="#"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" onclick="foo1()">Stunden eintragen</a>
                    </li>

                    

                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="foo2()">Mitarbeiter eintragen</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="foo3()">Projekt eintragen</a>
                    </li>

                    
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="foo4()">Kunde eintragen</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="foo5()">Stundentabelle</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <div class="flex-container">
        <div id="divContent1" class="content bg-white p-3">
            <iframe src="insert_stunden.php" frameborder="0"></iframe>
        </div>
        <div id="divContent2" class="flex-container">
            <iframe src="insert_Mitarbeiter.php" frameborder="0"></iframe>    
        </div>
        <div id="divContent3" class="flex-container">
            <iframe src="insert_Projekt.php" frameborder="0"></iframe>    
        </div>
        <div id="divContent4" class="flex-container">
            <iframe src="insert_Kunden.php" frameborder="0"></iframe>    
        </div>
        <div id="divContent5" class="flex-container">
            <iframe src="abfragetabelle.php" frameborder="0"></iframe>    
        </div>
    </div>

    <footer>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="#" title="NEWS">NEWS</a></li>
                <li class="nav-item"><a class="nav-link" href="#" title="Links">Links</a></li>
                <li class="nav-item"><a class="nav-link" href="#" title="Impressum">Impressum</a></li>
                <li class="nav-item"><a class="nav-link" href="#" title="Datenschutzerklärung">Datenschutzerklärung</a></li>
            </ul>
        </nav>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05); font-weight: bold;">&#169;2024 Informationssystem</div>
    </footer>


    <script src="demoJS.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script> -->
</body>

</html>