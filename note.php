<?php

  // Include config file
  require_once "./server/config.php";

  /* Students list */

  $materii_note_list = array();
  $student = 0;

  $medie = 0;
  $nr = 0;

  $URL_id = 0;

  if (isset($_GET['id'])) 
  {
    $URL_id = $_GET['id'];
  }
  else 
  {
      echo("No id");
  }

   /* Student select */

   $sql = "SELECT * FROM studenti WHERE id='$URL_id' ";

   if($result = (mysqli_query($link, $sql)))
   {
     if ($row = mysqli_fetch_row($result))
     {
         $student  = $row;
         mysqli_free_result($result);
     } 
   }
   else 
   {
     echo (mysqli_error($link));
   }
   
 
   /* Materii note list */
 
   $sql = "SELECT M.nume_materie, M.nr_credite, SN.nota, SN.promovat, SN.id
           FROM materii M
           LEFT JOIN student_has_note SN
           ON M.id = SN.materie_id
           WHERE SN.student_id = $URL_id;
   ";
 
   if ($result = mysqli_query($link, $sql)) {
     
     // Fetch one and one row
     while ($row = mysqli_fetch_row($result)) {
       $materii_note_list[] = $row;

       $medie += $row[2];
       $nr++;
     }
     mysqli_free_result($result);
   }
   else
   {
     echo (mysqli_error($link));
   }

   if ($nr != 0)
   {
       $medie = $medie/$nr;
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Note</title>
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
  <link rel="stylesheet" href="./css/note.css">
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

<div class="note_page">

  <h1 class="nume_student">Situatia <?php echo($student[1]) ?> </h1>
  <div class="medie">Medie: <?php echo($medie) ?> </div>

  <table id="note_list">
      <thead>
          <tr>
              <th><h1 class="note_field_label">Materie</h1></th>
              <th><h1 class="note_field_label">Nota</h1></th>
              <th><h1 class="note_field_label">Promovat</h1></th>
          </tr>
      </thead>
      <tbody>

        <?php 
        
        foreach ($materii_note_list as $materie_nota)
        {
            $promovat_status = "";

            if ($materie_nota[3] == 0)
            {
                $promovat_status = "Nu";
            }

            if ($materie_nota[3] == 1)
            {
                $promovat_status = "Da";
            }

            echo('  
              <tr>
                <td><h1 class="note_field">'.$materie_nota[0].'</h1></td>
                <td><h1 class="note_field">'.$materie_nota[2].'</h1></td>
                <td><h1 class="note_field">'.$promovat_status.'</h1></td>
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
        $('#note_list').DataTable({
          "searching": false,
          "paging": false,
          "ordering": false,
          "bInfo" : false
        });
    });
</script>

</html>