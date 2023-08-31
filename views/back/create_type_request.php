<?php
require_once '../../controllers/typeC.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
   
    $typeController = new TypeController();
    $newType = new Type(null,$name);
    $typeController->create($newType);
    
    header('Location: types_lists.php'); 
    exit();
}

?>
