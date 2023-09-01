<?php
require_once '../../controllers/formationC.php';

$formationId = $_GET['id'];
   
$formationController = new FormationController();
$formationController->delete($formationId);
    
header('Location: formations_lists.php'); 
exit();


?>
