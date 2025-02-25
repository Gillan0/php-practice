<!DOCTYPE php>
<html>
<head>
	<title>WEBAPP Main Page</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="/css/main_style.css">	
    <link rel="icon" type="image/x-icon" href="/ressources/images/profile.png">
</head>
<body>
	<?php 
		include "../../../ressources/php/header.php";
	?>

	<div class = "content"> 
    <h2> Multiplication Table test</h2>

        

            <form name="form" action="" method="GET" autocomplete="off">
                <label>Number of the multiplication table:</label>
                <input type="number" name="number" value="<?php echo htmlspecialchars($number); ?>"><br>

                <label>Size of the multiplication table:</label>
                <input type="number" name="size" value="<?php echo htmlspecialchars($size); ?>"><br>

                <input type="submit">
            </form>

            <span style="color:red;"><?php echo $error; ?></span>

            <?php
            include "function.php";

            $isFormFilled = true;            
            $number = isset($_GET['number']) ? $_GET['number'] : "";
            $size = isset($_GET['size']) ? $_GET['size'] : "";
            $error = "";

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['number'], $_GET['size'])) {
                foreach ($_GET as $key => $value) {
                    if (trim($value) === "") {
                        $isFormFilled = false;
                        break;
                    }
                }

                if (!$isFormFilled) {
                    $error = "Please fill all values";
                } else {
                    $size = filter_input(INPUT_GET, "size", FILTER_SANITIZE_NUMBER_INT);
                    $number = filter_input(INPUT_GET, "number", FILTER_SANITIZE_NUMBER_INT);

                    if ($number !== false && $size !== false && $number >= 0 && $size > 0) {
                        echo multiplicationTable($number, $size);
                    } else {
                        $error = "Please enter a valid size and number";
                    }
                }
            }
            ?>
    
    
    </div>

	<?php
		include "../../../ressources/php/footer.php";
	?>

</body>
</html>