<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Table </title>
</head>

<body>

    <table border="1px">
        <?php

        function tableOfNum()
        {
            for ($i = 1; $i <= 6; $i++) {
                echo '<tr>';
                for ($j = 1; $j <= 5; $j++) {
                    echo "<td>$i * $j = " . $i * $j . '</td> ';
                }
                echo '</tr>';
            }
        }
        tableOfNum(); ?>
    </table>

</body>

</html>