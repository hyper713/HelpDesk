<?php require_once("../database.php"); ?>

<?php 
    $request = $conn->prepare("SELECT * FROM demande");
    $request->execute();
    $rows = $request->fetchAll(PDO::FETCH_ASSOC);

    print_r($rows);
?>