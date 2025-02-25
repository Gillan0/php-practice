<!DOCTYPE php>
<html>
<head>
	<title>Forms in PHP</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="/css/main_style.css">
    <link rel="icon" type="image/x-icon" href="/ressources/images/profile.png">
</head>
<body>
	<?php 
		include "../../ressources/php/header.php";
	?>

	<div class="content">

        <h2> Activity 2 : Factorial GET method </h2>

        <form name="form" action="" method="GET" autocomplete="off">
            <label>Compute the factorial of </label> <br>
            <input type="number" name="fact">
            <input type="submit">
        </form>

        <?php

            if (isset($_GET["fact"])){
                $input = filter_input(INPUT_GET, "fact", FILTER_SANITIZE_NUMBER_INT);
                if ($input !== false && $input >= 0) {
                    $result = 1;
                    for ($i = 1; $i <= $input; $i++) {
                        $result *= $i;
                    }
                    echo "The factorial of {$input} is {$result}";
                } else {
                    echo "Gimme a proper input";
                }

            } else {
                echo "Please enter a prompt";
            }
        ?>

        <h2> Activity 2 : Factorial POST method </h2>

        <form name="form" action="" method="POST" autocomplete="off">
            <label>Compute the factorial of </label> <br>
            <input type="number" name="fact_post">
            <input type="submit">
        </form>

        <?php
            if (isset($_POST["fact_post"])){
                $input = filter_input(INPUT_POST, "fact_post", FILTER_SANITIZE_NUMBER_INT);
                if ($input !== false && $input >= 0) {
                    $result = 1;
                    for ($i = 1; $i <= $input; $i++) {
                        $result *= $i;
                    }
                    echo "The factorial of {$input} is {$result}";
                } else {
                    echo "Gimme a proper input";
                }

            } else {
                echo "Please enter a prompt";
            }
        ?>

        <h2> Activity 2 : All Factorial GET method </h2>

        <form name="form" action="" method="GET" autocomplete="off">
            <label>Compute the factorial of </label> <br>
            <input type="number" name="fact_suite">
            <input type="submit">
        </form>

        <?php
            if (isset($_GET["fact_suite"])){
                $input = filter_input(INPUT_GET, "fact_suite", FILTER_SANITIZE_NUMBER_INT);
                if ($input !== false && $input >= 0) {
                    $result = 1;
                    echo "0!={$result}<br>";
                    for ($i = 1; $i <= $input; $i++) {
                        $result *= $i;
                        echo "{$i}! is {$result}<br>";
                    }
                } else {
                    echo "Gimme a proper input";
                }

            } else {
                echo "Please enter a prompt";
            }
        ?>

</div>

<?php

    include "../../ressources/php/footer.php";
?>

</body>
</html>
