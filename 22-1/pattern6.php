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
            for ($i = 1; $i <= $row; $i++) {
                echo  '<tr>';
                for ($j = 1; $j <= $col; $j++) {

                    if ($j == 1  || $j == $col || $i == 1 || $i == $row) {
                        echo  '<td>*</td>';
                    } else {
                        echo '<td>&nbsp&nbsp</td>';
                    }
                }
                echo  '</tr>';
            }
        }

        displayPattern(15, 25);



        ?>
    </table>
</body>

</html>