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

    <?php
        
        $login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
        $citation = filter_input(INPUT_POST, "citation", FILTER_SANITIZE_STRING);
        $author = filter_input(INPUT_POST, "auteur", FILTER_SANITIZE_STRING);
        $date = filter_input(INPUT_POST, "date", FILTER_SANITIZE_STRING);

        $isValidCitation = true;

        if (empty($login) || empty($citation) || empty($author) || empty($date)) {
            $isValidCitation = false;
        }

        if ($isValidCitation) {
            echo "{$login} sent the following citation : <br> \"{$citation}\" - {$author} - {$date}" ;
        } else {
            echo '<b style = "color:red"> Invalid Citation </b>';
        }

        
    ?>
    

    </div>

	<?php
		include "../../../ressources/php/footer.php";
	?>

</body>
</html>