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

        for ($i = 1; $i <= 8; $i++) {
            echo '<tr>';
            for ($j = 1; $j <= 8; $j++) {
                if ($j % 2) {
                    echo "<td>1</td>";
                } else if ($i % 2) {
                    echo "<td>0</td>";
                }
                else{
                    
                    
                }
            }

            echo '</tr>';
        }
        ?>
    </table>

</body>

</html>