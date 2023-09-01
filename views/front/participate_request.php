<?php 
session_start();

require_once '../../controllers/formationC.php';

$idUser=$_SESSION['user_id'];
$idFormation=$_GET['formation_id'];
$action=$_GET['action'];

$formationsController = new FormationController();

if($action=="participe")
$formationsController->participate($idUser,$idFormation);
else
$formationsController->removeParticipation($idUser,$idFormation);

header('Location: index.php'); 
exit();

?>