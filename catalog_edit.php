<?php

// Initialize the session
session_start();
 
// Check if the user is already logged in, if not then redirect him to login page
if((isset($_SESSION["loggedin"]) === false) || ($_SESSION["loggedin"] === false)){
    header("location: ./login.php");
    exit;
}

// Include config file
require_once "./server/config.php";

/* Profiles list */

$sql = "SELECT * FROM profil_an";

if ($result = mysqli_query($link, $sql)) {
  // Fetch one and one row
  while ($row = mysqli_fetch_row($result)) {
    $profil_an_list[] = $row;
  }
  mysqli_free_result($result);
}

mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Catalog Edit</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>

  <link rel="stylesheet" href="./css/navbar.css">
  <link rel="stylesheet" href="./css/sidebar.css">
  <link rel="stylesheet" href="./css/dashboard.css">
  <link rel="stylesheet" href="./css/edit.css">
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

<div class="dashboard_container">
  <div class="dashboard">

  <form>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="name">Nume</label>
        <input type="number" class="form-control" id="student_name" placeholder="Nume" name="nume">
      </div>
      
      <div class="form-group col-md-2">
        <label for="an">An</label>
        <input type="text" class="form-control" id="student_an" placeholder="An" name="an" min="1" max="5">
      </div>

      <div class="form-group col-md-4">
        <label for="profil_an">Profil si an</label>
        <select class="form-control" name="profil_an" id="profil_an">
          <?php 
            
            foreach ($profil_an_list as $profil_an)
            {
                echo('<option value="'.$profil_an[0].'">'.$profil_an[1].'</option>');
            }
          
          ?>
        </select>
      </div>
    </div>

    <h3>Matematica</h3>

    <div class="form-row">

      <div class="form-group col-md-6 inline_form_inputs">
        <label for="nota">Nota&nbsp;&nbsp;</label>
        <input type="number" class="form-control" id="materia_1_nota" placeholder="Nota" name="materia_1_nota" min="0" max="10">
      </div>

      <div class="form-group col-md-6 inline_form_inputs">
        <label for="promovat">Promovat&nbsp;&nbsp;</label>
        <select class="form-control" name="materia_1_promovat" id="materia_1_promovat">
          <option value="0">Nu</option>
          <option value="1">Da</option>
        </select>
      </div>

    </div>

    <h3>Matematica</h3>

    <div class="form-row">

      <div class="form-group col-md-6 inline_form_inputs">
        <label for="nota">Nota&nbsp;&nbsp;</label>
        <input type="number" class="form-control" id="materia_1_nota" placeholder="Nota" name="materia_1_nota" min="0" max="10">
      </div>

      <div class="form-group col-md-6 inline_form_inputs">
        <label for="promovat">Promovat&nbsp;&nbsp;</label>
        <select class="form-control" name="materia_1_promovat" id="materia_1_promovat">
          <option value="0">Nu</option>
          <option value="1">Da</option>
        </select>
      </div>

    </div>
    
    <button type="submit" class="btn btn-warning">Aply Changes</button>
  </form>

  </div>
</div>

</body>
</html>