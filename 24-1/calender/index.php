<?php
function display($month, $year)
{
    $timestamp = mktime(null, null, null, $month, 1, $year);
    $today = date('d-m-Y', $timestamp);
    $z = (getdate($timestamp)['wday']);
    // print_r(getdate($timestamp));
    $lastDate = date("t", $timestamp);

    echo '<br>';
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
                echo "<td>&nbsp</td>";
            }
        }
        $z = 0;


        echo '</tr>';
    }
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
        <label for="month">Month : </label>
        <input type="number" name="month" id="month"><br><br>
        <label for="year">Year :</label>
        <input type="number" name="year" id="year"><br><br>
        <input type="submit" value="Display">
    </form>
    <div>
        <table border="1px">
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wen</th>
                <th>Tru</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
            <?php
            session_start();
            if ((isset($_SESSION["month"]) && isset($_SESSION['year'])) || ((isset($_POST['month']) && isset($_POST['year'])))) {
                $_SESSION['month'] = isset($_POST['month']) ? $_POST['month'] : $_SESSION['month'];
                $_SESSION['year'] = (isset($_POST['year'])) ? $_POST['year'] : $_SESSION['year'];
                $month = $_SESSION['month'];
                $year = $_SESSION['year'];
                if (preg_match('/^[0-9]{1}[1-2]{0,1}$/', $month) && preg_match('/^[0-9]{4}$/', $year)) {
                    display($month, $year);
                } else {
                    echo "enter valid Month and year";
                }
            }
            ?>

        </table>
    </div>

</body>

</html>