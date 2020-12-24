<?php require_once("../database.php"); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un technicien</title>
</head>
<body>
    <a href="list.php">Liste des techniciens</a>
    <br><br>
    <?php
        if (isset($_GET['id'])) {
            $request = $conn->prepare("DELETE FROM technicien WHERE id_tech = :id");

            $request->execute(array('id' => $_GET['id']));

            if($request->rowCount()!=0){
                echo("Le technicien a été supprime");
            }
        }
    ?>
</body>
</html>
