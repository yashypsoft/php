<?php

function displayMonth($month, $year)
{

    $timestamp = mktime(null, null, null, $month, 1, $year);
    $today = date('d-m-Y', $timestamp);
    $z = (getdate($timestamp)['wday']);
    $lastDate = date("t", $timestamp);

    echo '<br>';
    echo " <table border=\"1px\">
    <tr>
        <th>Sun</th>
        <th>Mon</th>
        <th>Tue</th>
        <th>Wen</th>
        <th>Tru</th>
        <th>Fri</th>
        <th>Sat</th>
    </tr>";
    $k = 1;
    for ($i = 0; $i < 5; $i++) {
        echo '<tr>';
        for ($j = 0; $j < 7; $j++) {
            if ($z <= $j) {
                echo "<td>$k</td>";
                if ($k < $lastDate) {
                    $k++;
                } else {
                    $k = " ";
                }
            } else {
                echo "<td></td>";
            }
        }
        $z = 0;
        echo '</tr>';
    }
    echo "</table>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calender</title>
</head>

<body>

    <form action="" method="POST">
        <label for="smonth">Start Month : </label>
        <input type="number" name="smonth" id="smonth"><br><br>
        <label for="year">start Year :</label>
        <input type="number" name="syear" id="syear"><br><br>
        <label for="month">End Month : </label>
        <input type="number" name="emonth" id="emonth"><br><br>
        <label for="year">End Year :</label>
        <input type="number" name="eyear" id="eyear"><br><br>
        <input type="submit" value="Display">
    </form>
    <div>

        <?php
        session_start();
        if ((isset($_SESSION["smonth"]) && isset($_SESSION['syear'])) || ((isset($_POST['smonth']) && isset($_POST['syear'])))) {
            $_SESSION['smonth'] = isset($_POST['smonth']) ? $_POST['smonth'] : $_SESSION['smonth'];
            $_SESSION['syear'] = (isset($_POST['syear'])) ? $_POST['syear'] : $_SESSION['syear'];
            $_SESSION['emonth'] = isset($_POST['emonth']) ? $_POST['emonth'] : $_SESSION['emonth'];
            $_SESSION['eyear'] = (isset($_POST['eyear'])) ? $_POST['eyear'] : $_SESSION['eyear'];
            $smonth = $_SESSION['smonth'];
            $syear = $_SESSION['syear'];
            $emonth = $_SESSION['emonth'];
            $eyear = $_SESSION['eyear'];
            if (preg_match('/^[0-9]{1}[1-2]{0,1}$/', $smonth) && preg_match('/^[0-9]{4}$/', $syear)) {
                if ($syear == $eyear) {
                    for ($i = $smonth; $i <= $emonth; $i++) {
                        echo "<h3>$i / $syear</h3> ";
                        displayMonth($i, $syear);
                    }
                } else if ($eyear > $syear) {

                    for ($i = $smonth; $i <= 12; $i++) {
                        echo "<h3>$i / $syear</h3> ";
                        displayMonth($i, $syear);
                    }
                    for ($i = 1; $i <= $emonth; $i++) {
                        echo "<h3>$i / $eyear</h3> ";
                        displayMonth($i, $eyear);
                    }

                    $syear++;
                } else {
                    echo "enter valid interaval";
                }
            } else {
                echo "enter valid Month and year";
            }
        }
        ?>


    </div>

</body>

</html>