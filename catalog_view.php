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
require_once "./server/reassociate_profil.php";

$student_list = array();
$profil_an_list = array();

if($_SERVER["REQUEST_METHOD"] == "GET")
{
  /* Students list */

  $sql = "SELECT * FROM studenti";

  if ($result = mysqli_query($link, $sql)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_row($result)) {
      $student_list[] = $row;
    }
    mysqli_free_result($result);
  }

  /* Profiles list */

  $sql = "SELECT * FROM profil_an";

  if ($result = mysqli_query($link, $sql)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_row($result)) {
      $profil_an_list[] = $row;
    }
    mysqli_free_result($result);
  }

}

if($_SERVER["REQUEST_METHOD"] == "POST")
{

  $student_name = trim($_POST["name"]);
  $student_an = trim($_POST["an"]);
  $profil_an_id = trim($_POST["profil_an"]);

  $add_error = "";

  if (empty($student_name) || !isset($student_an) || !isset($profil_an_id))
  {
    $add_error = "Eroare la adaugare";
  }

  if (empty($add_error))
  {
    $sql = "INSERT INTO studenti (name, an, profil_an_id) VALUES ('$student_name', '$student_an', '$profil_an_id')";
    
    if(!(mysqli_query($link, $sql)))
    {
      echo (mysqli_error($link));
    }

    reassociate_profil($link, mysqli_insert_id($link));
  }

  header("location: catalog_view.php");
}

mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Catalog View</title>
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
</head>


<div class="modal fade" id="add_student_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <form id="add_student_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

          <div class="form-group">
            <label for="name" class="col-form-label">Nume:</label>
            <input type="text" class="form-control" id="student_name" name="name">
          </div>

          <div class="form-group">
            <label for="an" class="col-form-label">An:</label>
            <input type="number" class="form-control" id="student_an" name="an" min="1" max="5">
          </div>

          <div class="form-group">
            <label for="profil_an" class="col-form-label">Profil si an:</label>
            <select class="form-control" name="profil_an" id="profil_an">
              <?php 
          
                foreach ($profil_an_list as $profil_an)
                {
                    echo('<option value="'.$profil_an[0].'">'.$profil_an[1].'</option>');
                }
              
              ?>
            </select>
          </div>

        </form>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="add_student_form" class="btn btn-warning">Add</button>
      </div>

    </div>
  </div>
</div>


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

    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#add_student_modal">Adaugati Student</button>

    <table id="student_list">
        <thead>
            <tr>
                <th>Nume</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

          <?php 
          
          foreach ($student_list as $stundent)
          {
              echo('  
                <tr>
                  <td>'.$stundent[1].'</td>
                  <td><a href="catalog_edit.php?id='.$stundent[0].'" class="btn btn-warning">Edit</a></td>
                  <td><a href="server/delete.php?id='.$stundent[0].'" class="btn btn-danger">Delete</a></td>
                </tr>
              ');
          }
          
          ?>

          </tbody>
    </table>
  </div>
</div>

</body>

<script>
    $(document).ready(function () {
        $('#student_list').DataTable();
    });
</script>

</html>