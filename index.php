<?php

  // Include config file
  require_once "./server/config.php";
  require_once "./server/repartizare.php";

  // Reface repartizarea

  $list = repartizare($link);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Repartizare</title>
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
  <div class="title">Repartizare Studenti</div>
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
              <th>Credite</th>
              <th>Media</th>
              <th>Specializare</th>
              <th>Note</th>
          </tr>
      </thead>
      <tbody>

        <?php 
        
        for ($i = 0; $i < count($list->studenti); $i++)
        {
            echo('  
            <tr>
              <td>'.$list->studenti[$i][1].'</td>
              <td>'.$list->credits[$i].'</td>
              <td>'.$list->medii[$i].'</td>
              <td>'.$list->specializari[$i].'</td>
              <td><a href="note.php?id='.$list->studenti[$i][0].'" class="btn btn-secondary">Vezi note</a></td>
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