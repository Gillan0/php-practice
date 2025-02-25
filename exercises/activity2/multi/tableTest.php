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
    <?php 
        include "function.php";
        echo multiplicationTable(5,10);
    ?>
    </div>

	<?php
		include "../../../ressources/php/footer.php";
	?>

</body>
</html>