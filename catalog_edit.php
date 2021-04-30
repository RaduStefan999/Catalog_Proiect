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


$materii_note_list = array();
$profil_an_list = array();
$stundet = 0;



if($_SERVER["REQUEST_METHOD"] == "GET")
{
  /* Student select */

  if (isset($_GET['id'])) 
  {
      $id = $_GET['id'];

      $sql = "SELECT * FROM studenti WHERE id='$id' ";

      if($result = (mysqli_query($link, $sql)))
      {
        if ($row = mysqli_fetch_row($result))
        {
            $stundet  = $row;
            mysqli_free_result($result);
        } 
      }
      else 
      {
        echo (mysqli_error($link));
      }
  } 
  else 
  {
      echo("No id");
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

  /* Materii note list */

  if (isset($_GET['id'])) 
  {
      $id = $_GET['id'];

      $sql = "SELECT M.nume_materie, M.nr_credite, SN.nota, SN.promovat, SN.id
              FROM materii M
              LEFT JOIN student_has_note SN
              ON M.id = SN.materie_id
              WHERE SN.student_id = $id;
      ";

      if ($result = mysqli_query($link, $sql)) {
        
        // Fetch one and one row
        while ($row = mysqli_fetch_row($result)) {
          $materii_note_list[] = $row;
        }
        mysqli_free_result($result);
      }
      else
      {
        echo (mysqli_error($link));
      }
      
  } 
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

  <form id="add_student_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $_GET['id'] ?>" method="post">

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="name">Nume</label>
        <input type="text" class="form-control" id="student_name" placeholder="Nume" name="name" value="<?php echo($stundet[1]) ?>">
      </div>
      
      <div class="form-group col-md-2">
        <label for="an">An</label>
        <input type="number" class="form-control" id="student_an" placeholder="An" name="an" min="1" max="5" value="<?php echo($stundet[2]) ?>">
      </div>

      <div class="form-group col-md-4">
        <label for="profil_an">Profil si an</label>
        <select class="form-control" name="profil_an" id="profil_an">
          <?php 
            
            foreach ($profil_an_list as $profil_an)
            {
                if ($profil_an[0] == $stundet[2])
                {
                  echo('<option selected value="'.$profil_an[0].'">'.$profil_an[1].'</option>');
                }
                else 
                {
                  echo('<option value="'.$profil_an[0].'">'.$profil_an[1].'</option>');
                }
            }
          
          ?>
        </select>
      </div>
    </div>


    <?php 
            
    foreach ($materii_note_list as $materie_nota)
    {

      $options = "";

      if ($materie_nota[3] == 0)
      {
        $options = '<option selected value="0">Nu</option>
                    <option value="1">Da</option>';
      }

      if ($materie_nota[3] == 1)
      {
        $options = '<option value="0">Nu</option>
                    <option selected value="1">Da</option>';
      }

      echo('<h3>'.($materie_nota[0]).'</h3>

            <div class="form-row">

              <div class="form-group col-md-6 inline_form_inputs">
                <label for="nota">Nota&nbsp;&nbsp;</label>
                <input type="number" class="form-control" id="'.($materie_nota[4]).'_nota" placeholder="Nota" name="'.($materie_nota[4]).'_nota" min="0" max="10" value="'.($materie_nota[2]).'">
              </div>

              <div class="form-group col-md-6 inline_form_inputs">
                <label for="promovat">Promovat&nbsp;&nbsp;</label>
                <select class="form-control" name="'.($materie_nota[4]).'_promovat" id="'.($materie_nota[4]).'_promovat">'.$options.'</select>
              </div>

            </div>
    ');
    }
              
    ?>
    
    <button type="submit" class="btn btn-warning">Aply Changes</button>
  </form>

  </div>
</div>

</body>
</html>