<?php

  // Include config file
  require_once "./server/config.php";

  /* Students list */

  $student_list = array();

  $sql = "SELECT * FROM studenti";

  if ($result = mysqli_query($link, $sql)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_row($result)) {
      $student_list[] = $row;
    }
    mysqli_free_result($result);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Catalog</title>
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
  <link rel="stylesheet" href="./css/home.css">
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

<div class="student_page">
  <table id="student_list">
      <thead>
          <tr>
              <th>Nume</th>
              <th>An</th>
              <th>Note</th>
          </tr>
      </thead>
      <tbody>

        <?php 
        
        foreach ($student_list as $stundent)
        {
            echo('  
              <tr>
                <td>'.$stundent[1].'</td>
                <td>'.$stundent[2].'</td>
                <td><a href="note.php?id='.$stundent[0].'" class="btn btn-secondary">Vezi note</a></td>
              </tr>
            ');
        }
        
        ?>

        </tbody>
  </table>
</div>

</body>

<script>
    $(document).ready(function () {
        $('#student_list').DataTable();
    });
</script>

</html>