<?php

function repartizare ($link)
{

    /* Students list */

    $student_list = array();
    $medii_list = array();
    $nr_credite_list = array();
    $specializari_repartizate_list = array();

    $sql = "SELECT * FROM studenti";

    if ($result = mysqli_query($link, $sql)) {
        // Fetch one and one row
        while ($row = mysqli_fetch_row($result)) {
        $student_list[] = $row;
        }
        mysqli_free_result($result);
    }
 
    for ($i = 0; $i < count($student_list); $i++)
    {
        $medie = 0;
        $nr_credite = 0;
        $student_id = $student_list[$i][0];
        $nr = 0;
    
        $sql = "SELECT M.nume_materie, M.nr_credite, SN.nota, SN.promovat, SN.id
                FROM materii M
                LEFT JOIN student_has_note SN
                ON M.id = SN.materie_id
                WHERE SN.student_id = $student_id;
        ";
        
        if ($result = mysqli_query($link, $sql)) {
            
            // Fetch one and one row
            while ($row = mysqli_fetch_row($result)) {
        
                if ($row[3] == 1)
                {
                    $medie += $row[2];
                    $nr_credite += $row[1] * $row[2];
                }

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

        $medii_list[$i] = $medie;
        $nr_credite_list[$i] = $nr_credite;
    }


    /* Sortare */

    for ($i = 0; $i < count($student_list); $i++)
    {
        for ($j = $i + 1; $j < count($student_list); $j++)
        {
            if ($nr_credite_list[$i] < $nr_credite_list[$j])
            {
                $aux = $nr_credite_list[$j];
                $nr_credite_list[$j] = $nr_credite_list[$i];
                $nr_credite_list[$i] = $aux;

                $aux = $medii_list[$j];
                $medii_list[$j] = $medii_list[$i];
                $medii_list[$i] = $aux;
                
                $aux = $student_list[$j];
                $student_list[$j] = $student_list[$i];
                $student_list[$i] = $aux;
            }
            else 
            {
                if ($nr_credite_list[$i] == $nr_credite_list[$j])
                {
                    if ($medii_list[$i] < $medii_list[$j])
                    {
                        $aux = $nr_credite_list[$j];
                        $nr_credite_list[$j] = $nr_credite_list[$i];
                        $nr_credite_list[$i] = $aux;
        
                        $aux = $medie_list[$j];
                        $medii_list[$j] = $medii_list[$i];
                        $medii_list[$i] = $aux;
                        
                        $aux = $student_list[$j];
                        $student_list[$j] = $student_list[$i];
                        $student_list[$i] = $aux;
                    }
                }
            }
        }
        
    }

    /* Specializari */

    $nr_locuri_specializari = array();
    $denumiri_specializari = array();

    $sql = "SELECT * FROM specializari";

    if ($result = mysqli_query($link, $sql)) {
        // Fetch one and one row
        while ($row = mysqli_fetch_row($result)) 
        {
            $nr_locuri_specializari[$row[0]] = $row[2];
            $denumiri_specializari[$row[0]] = $row[1];
        }
        mysqli_free_result($result);
    }
    
    /* Repartizare */

    for ($i = 0; $i < count($student_list); $i++)
    {
        if (isset($student_list[$i][5]) && isset($student_list[$i][6]) && isset($student_list[$i][7]))
        {
            $specializare_id = 0;
            $student_id = $student_list[$i][0];

            if ($nr_locuri_specializari[$student_list[$i][5]] > 0)
            {
                $specializare_id = $student_list[$i][5];

                $nr_locuri_specializari[$student_list[$i][5]]--;
            }
            else 
            {
                if ($nr_locuri_specializari[$student_list[$i][6]] > 0)
                {
                    $specializare_id = $student_list[$i][6];
        
                    $nr_locuri_specializari[$student_list[$i][6]]--;
                }
                else 
                {
                    if ($nr_locuri_specializari[$student_list[$i][7]] > 0)
                    {
                        $specializare_id = $student_list[$i][7];
            
                        $nr_locuri_specializari[$student_list[$i][7]]--;
                    }
                }
            }

            $specializari_repartizate_list[$i] = $denumiri_specializari[$specializare_id];
            $sql = "UPDATE studenti SET specializare = $specializare_id WHERE id = $student_id";

            if(!(mysqli_query($link, $sql)))
            {
              echo (mysqli_error($link));
            }
        }
    }

    $data = new stdClass;
    $data -> studenti = $student_list;
    $data -> medii = $medii_list;
    $data -> credits = $nr_credite_list;
    $data -> specializari = $specializari_repartizate_list;

    return $data;
}


?>