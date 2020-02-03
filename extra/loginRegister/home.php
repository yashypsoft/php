<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.3.0/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.3.0/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.3.0/dist/js/uikit-icons.min.js"></script>
    <title>HOME</title>
</head>

<body>
    <div class="uk-container">
        <div>
            <?php
            session_start();
            require_once 'config.php';
            if (!isset($_SESSION['loginflag'])) {
                header("Location: index.php");
            }
            $id = $_SESSION['id'];
            $email = load('users', 'email', $id);
            $table = "";
            $queryRun = fetchRr('usersessionlog', ['id' => $id]);
            while ($row = mysqli_fetch_assoc($queryRun)) {
                $table .= "<tr>";
                foreach ($row as $key => $value) {
                    $table .= "<td>$value</td>";
                }
                $table .=  "</tr>";
            }
            ?>
        </div>
        <h1>Welcome</h1>
        <p><?= $email ?></p>
        <a href="logout.php" class="uk-button uk-button-default">Logout</a>

        <table class="uk-table uk-table-divider">

            <?= $table; ?>

        </table>

    </div>

</body>

</html>