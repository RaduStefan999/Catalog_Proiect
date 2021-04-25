<?php

// Initialize the session
session_start();
 
// Check if the user is already logged in, if not then redirect him to login page
if((isset($_SESSION["loggedin"]) === false) || ($_SESSION["loggedin"] === false)){
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Catalog Edit</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="./css/navbar.css">
  <link rel="stylesheet" href="./css/sidebar.css">
</head>
<body>

<div class="navbar">

  <div></div>
  <div class="title">Catalog Studenti</div>
  <div class="menu_buttons">
    <a href="./index.php">Studenti</a>
    <a href="./login.php">Profesori</a>
  </div>

</div>

<div class="sidebar">

  <div class="sidebar_content">

    <div class="sidebar_element">
      <i class="fa fa-address-book"></i>
      <a href="./catalog_view.php" class="sidebar_element_name">Lista Studenti</a>
    </div>

    <div class="sidebar_element">
      <i class="fa fa-sign-out"></i>
      <a href="./server/logout.php" class="sidebar_element_name">Logout</a>
    </div>

  </div>

</div>

</body>
</html>