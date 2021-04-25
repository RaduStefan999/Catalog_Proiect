<?php 

function reassociate_profil($link, $student_id)
{
    /* GET PROFIL ID FROM STUDENT */

    $sql = "SELECT * FROM studenti WHERE id='$student_id'";

    $result = mysqli_query($link, $sql);

    $profil_an_id = -1;


    if ($row = mysqli_fetch_row($result))
    {
        $profil_an_id  = $row[3];
        mysqli_free_result($result);
    }

    if ($profil_an_id == -1)
    {
        die("ERROR couldn't get student");
    }

    /* GET PROFIL ID */

    $sql = "DELETE FROM student_has_note WHERE student_id='$student_id'";

    if(!(mysqli_query($link, $sql)))
    {
      echo (mysqli_error($link));
    }

    /* ASSOCIATE MATERII TO STUDENT */

    $sql = "SELECT * FROM profil_an_has_materii WHERE profil_an_id='$profil_an_id'";

    if ($result = mysqli_query($link, $sql)) 
    {
      // Fetch one and one row
      while ($row = mysqli_fetch_row($result)) 
      {
        $sql = "INSERT INTO student_has_note (student_id, materie_id) VALUES ('$student_id', '$row[2]')";

        if(!(mysqli_query($link, $sql)))
        {
          echo (mysqli_error($link));
        }
      }
      mysqli_free_result($result);
    }
}

?>