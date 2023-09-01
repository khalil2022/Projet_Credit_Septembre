<?php
require_once '../../controllers/userC.php';

$userId = $_GET['id'];
   
$userController = new UserController();
$userController->delete($userId);
    
header('Location: users_lists.php'); 
exit();


?>
