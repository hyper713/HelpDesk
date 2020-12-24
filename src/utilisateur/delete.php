<?php require_once("../database.php"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="list.php">Liste des utilisateurs</a>
    <br><br>
    <?php
        if (isset($_GET['mat'])) {
            $request = $conn->prepare("DELETE FROM utilisateur WHERE matricule = :mat");

            $request->execute(array('mat' => $_GET['mat']));

            if($request->rowCount()!=0){
                echo("L'utilisateur a été supprime");
            }
        }
    ?>
</body>
</html>
