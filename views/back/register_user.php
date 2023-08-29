<?php
require_once '../../controllers/userC.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = "student";

    $userController = new UserController();
    $newUser = new User(null, $username, $password, $role);
    $userController->register($newUser);
    
    header('Location: index.php'); 

    exit();
}

?>