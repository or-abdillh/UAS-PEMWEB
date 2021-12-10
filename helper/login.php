<?php

require('./connection.php');

//Get data login from POST

if ( isset($_POST["login"]) ) {
    //save data to variabel
    $username = $_POST["username"];
    $password = $_POST["password"];

    //Create SQL
    $sql = "SELECT `username` FROM User WHERE `username` = '$username' AND `password` = '$password'";

    //Create query to db
    $res = mysqli_query($conn, $sql);

    //If query success create new session
    if ( mysqli_num_rows($res) > 0 ) {
        session_start();
        $_SESSION["login"] = true;
        header('Location: ../index.php');
    }
}