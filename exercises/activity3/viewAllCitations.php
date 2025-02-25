<!DOCTYPE php>
<html>
<head>
	<title>WEBAPP Main Page</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="/css/main_style.css">
</head>
<body>
	<?php 
		include "../../ressources/php/header.php";
	?>

	<div class = "content"> 

    <h1>Hey</h1>

    <?php

    include "./main.php";

    $db = main();
    echo $db->__toString();

    ?>

    </div>

	<?php
		include "../../ressources/php/footer.php";
	?>

</body>
</html>