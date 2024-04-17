<?php
require "Validator.php";
require "Database.php";
$config = require("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $db = new Database($config);
    $errors = [];

    if (!Validator::email($_POST["email"])){
        $errors["login"] = "Invalid email or password";
    }

    if (!Validator::password($_POST["password"])){
        $errors["login"] = "Invalid email or password";
    }

    $query = "SELECT * FROM users WHERE email = :email AND password = :password";
    $params = [
        ":email" => $_POST["email"],
        ":password" => $_POST["password"]
    ];
    $user = $db->execute($query, $params)->fetch();
    if (!$user || !password_verify($_POST["password"], $user["password"])){
        $errors["login"] = "Invalid email or password";
    }
    
    if(empty($errors)){
        $_SESSION["user"] = true;
        $_SESSION["email"] = $_POST["email"];
    }
};

$title = "LOGIN";
require "views/auth/login.view.php";