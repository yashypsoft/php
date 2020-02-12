<?php
function display($month, $year, $name)
{
    $body = "<table border='1px'>
    <tr>
        <th>Sun</th>
        <th>Mon</th>
        <th>Tue</th>
        <th>Wen</th>
        <th>Tru</th>
        <th>Fri</th>
        <th>Sat</th>
    </tr>";
    $timestamp = mktime(null, null, null, $month, 1, $year);
    $today = date('d-m-Y', $timestamp);
    $z = (getdate($timestamp)['wday']);
    $lastDate = date("t", $timestamp);
    $extension = substr($name, strpos($name, '.') + 1);
    $type = @$_FILES['file']['type'];
    $temp = @$_FILES['file']['tmp_name'];


    if ($extension == 'jpg' || $extension == "jpeg" && $type == "image/jpeg") {
        $location = 'upload/';
        if (move_uploaded_file($temp, $location . $name)) {
            echo "<img src='$location$name' width='240px'> '";
        } else {
            echo "<img src='$location$name' width='240px'> '";
        }
    } else {
        echo "upload jpeg file only";
    }
    echo '<br>';
    $k = 1;
    for ($i = 0; $i < 5; $i++) {
        $body .= '<tr>';
        for ($j = 0; $j < 7; $j++) {
            if ($z <= $j) {
                $body .= "<td>$k</td>";
                if ($k < $lastDate) {
                    $k++;
                } else {
                    $k = " ";
                }
            } else {
                $body .= "<td></td>";
            }
        }
        $z = 0;
        $body .= '</tr>';
    }
    echo $body .= "</table>";
    $to_email = "yashypsoft@gmail.com";
    $subject = "Calender month";
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "From: vigo12qp@gmail.com";

    if (mail($to_email, $subject, $body, $headers)) {
        echo "Email successfully sent to $to_email...";
    } else {
        echo "Email sending failed...";
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

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="month">Month : </label>
        <input type="number" name="month" id="month"><br><br>
        <label for="year">Year :</label>
        <input type="number" name="year" id="year"><br><br>
        <input type="file" name="file" id="file"><br><br>
        <input type="submit" value="Display">

    </form>
    <div>

        <?php
        session_start();
        if (((isset($_SESSION["month"]) && isset($_SESSION['year']) && isset($_SESSION['fname'])) ||        (isset($_POST['month']) && isset($_FILES['file']['name']) && isset($_POST['year']))))
         {
            $_SESSION['month'] = isset($_POST['month']) ? $_POST['month'] : $_SESSION['month'];
            $_SESSION['year'] = isset($_POST['year']) ? $_POST['year'] : $_SESSION['year'];
            $_SESSION['fname'] = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : $_SESSION['fname'];
            $name = $_SESSION['fname'];
            $month = $_SESSION['month'];
            $year = $_SESSION['year'];

            if (preg_match('/^[0-9]{1}[1-2]{0,1}$/', $month) && preg_match('/^[0-9]{4}$/', $year) && !empty($name)) {
                display($month, $year, $name);
            } else {
                echo "enter valid Month and year";
            }
        }

        ?>


    </div>

</body>

</html>