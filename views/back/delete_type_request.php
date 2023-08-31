<?php
require_once '../../controllers/typeC.php';

$typeId = $_GET['id'];
   
$typeController = new TypeController();
$typeController->delete($typeId);
    
header('Location: types_lists.php'); 
exit();


?>
