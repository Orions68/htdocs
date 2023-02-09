<?php
function turns($turn, $id, $idi)
{
    if ($id > 9)
    {
        echo '<label id="' . $idi . '"><input type="radio" value="' . $turn . '" name="time" id="' . $id . '">Cita: ' . $id . ' -- ' . $turn . '</label><br>';
    }
    else
    {
        echo '<label id="' . $idi . '"><input type="radio" value="' . $turn . '" name="time" id="' . $id . '">Cita: ' . $id . ' --- ' . $turn . '</label><br>';
    }
}
?>