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

        function displayPattern($line)
        {
            for ($i = 0; $i < $line; $i++) {
                echo '<tr>';
                for ($j = 0; $j <= $i; $j++) {
                    echo '<td>' . ($j + 1) . '</td> ';
                }
                echo '</tr>';
            }
        }
        displayPattern(9);

        ?>
    </table>
</body>

</html>