<?php require_once("../database.php"); ?>

<?php 
    $request = $conn->prepare("SELECT * FROM technicien");
    $request->execute();
    $rows = $request->fetchAll(PDO::FETCH_ASSOC);

    print_r($rows);
?>