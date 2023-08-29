<?php
require_once '../../controllers/userC.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userController = new UserController();
    $user = $userController->login($username, $password);

    if ($user) {
        session_start();
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['role'] = $user->getRole();
        
        
        header('Location: index.php'); 
        exit();
    } else {
        
        $error_message = "Invalid username or password.";
    }
}

?>