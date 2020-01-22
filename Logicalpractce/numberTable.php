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

        function numberTable()
        {
            for ($i = 1; $i <= 10; $i++) {
                echo '<tr>';
                for ($j = 1; $j <= 10; $j++) {
                    echo "<td>" . $i * $j . '</td> ';
                }
                echo '</tr>';
            }
        }
        numberTable(); ?>
    </table>

</body>

</html>