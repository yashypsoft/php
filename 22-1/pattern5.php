<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <?php
        function displayPattern($row, $col)
        {
            $k = 1;
            for ($i = 1; $i <= $row; $i++) {
                echo '<tr>';
                $k = $i;
                for ($j = 1; $j <= $col; $j++) {
                    echo "<td>$k</td>";
                    $k += $row;
                }
                echo '</tr>';
            }
        }

        displayPattern(5, 3);


        ?>
    </table>
</body>

</html>