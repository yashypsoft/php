<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Chess </title>
</head>

<body>

    <table border="1px">
        <?php
        $k = 1;
        for ($i = 1; $i <= 8; $i++) {
            echo '<tr>';
            if (($i % 2) == 0) {
                $k = 2;
            } else {
                $k = 1;
            }
            for ($j = 1; $j <= 8; $j++) {
                if ($k % 2 == 0) {
                    echo "<td style=\"background-color:black;\"></td>";
                } else {
                    echo "<td>&nbsp&nbsp&nbsp&nbsp</td>";
                }
                $k++;
            }
            echo '</tr>';
        }
        ?>
    </table>

</body>

</html>