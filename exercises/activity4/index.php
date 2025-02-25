<!DOCTYPE php>
<html>
<head>
	<title>Activity 4 - Database Content</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="/css/main_style.css">
    <link rel="icon" type="image/x-icon" href="/ressources/images/profile.png">
</head>
<body>
	<?php 
		include "../../ressources/php/header.php";
	?>

	<div class = "content"> 

    <h1>All citations in database</h1>

    <?php

    include "./main.php";

    $db = main();

    $db->fetchCitations();
    
    ?>

    <table border="1" bgcolor="#22d7f7" >
        <thead>
            <td>Login</td>
            <td>Auteur</td>
            <td>Date de citation</td>
            <td>Date d'enregistrement</td>
            <td>Lire</td>
        </thead>
        <tbody>
            
            <?php echo $db->showCitations();?>

        </tbody>
    </table>

    </div>

	<?php
		include "../../ressources/php/footer.php";
	?>

</body>
</html>