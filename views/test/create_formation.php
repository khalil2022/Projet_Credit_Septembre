<?php
require_once '../../controllers/formationC.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $typeId = $_POST['typeId'];

    $formationController = new FormationController();
    $newFormation = new Formation(null, $title, $description, $startDate, $endDate, $typeId);
    $formationController->create($newFormation);
    
    header('Location: index.php'); // Redirect to the formation list view
    exit();
}

?>
