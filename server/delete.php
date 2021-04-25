<?php

// Initialize the session
session_start();
 
// Check if the user is already logged in, if not then redirect him to login page
if((isset($_SESSION["loggedin"]) === false) || ($_SESSION["loggedin"] === false)){
    header("location: ./../../login.php");
    exit;
}

// Include config file
require_once "./config.php";

if (isset($_GET['id'])) 
{
    $id = $_GET['id'];

    $sql = "DELETE FROM studenti WHERE id='$id' ";

    if(!(mysqli_query($link, $sql)))
    {
      echo (mysqli_error($link));
    }
} 
else 
{
    echo("No id");
}

header("location: ./../../catalog_view.php");
exit;

?>