<!DOCTYPE php>
<html>
<head>
	<title>Activité 1</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="/css/main_style.css">
	<link rel="icon" type="image/x-icon" href="/ressources/images/profile.png">
</head>
<body>
	<?php 
		include "../../ressources/php/header.php";
	?>

	<div class = "content"> 

        <h2> Activité 1 : Afficher l'heure actuelle </h2>

        <label> Date du Jour : <?php print (Date("l F d, Y")); ?> </label>
        <br>
        <label> Heure actuelle (format hh:mm:ss) : <?php echo date('l jS \of F Y h:i:s A');
 ?> </label>
        

    </div>

	<?php
		include "../../ressources/php/footer.php";
	?>

</body>
</html>