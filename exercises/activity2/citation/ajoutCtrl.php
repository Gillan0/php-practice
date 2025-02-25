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

    <main>
        <article>
            <header><h1>Formaire de création de citations</h1></header>

            <?php 

            function validateDate($date, $format = 'Y-m-d') { 
                $d = DateTime::createFromFormat($format, $date); 
                return $d && $d->format($format) === $date; 
            } 

            $error_login = $error_citation = $error_author = $error_date = "";
            $display=null;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $login = isset($_POST["login"]) ? filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING) : "";
                $citation = isset($_POST["citation"]) ? filter_input(INPUT_POST, "citation", FILTER_SANITIZE_STRING) : "";
                $author = isset($_POST["auteur"]) ? filter_input(INPUT_POST, "auteur", FILTER_SANITIZE_STRING) : "";
                $date = isset($_POST["date"]) ? filter_input(INPUT_POST, "date", FILTER_SANITIZE_STRING) : Date("d-m-Y");

                $isValidCitation = true;

                if (empty($login)) {
                    $isValidCitation = false;
                    $error_login = "Login field must be filled";
                }  
                if (empty($citation)) {
                    $isValidCitation = false;
                    $error_citation = "Citation field must be filled";
                } 
                if (empty($author)) {
                    $isValidCitation = false;
                    $error_author = "Author field must be filled";
                } 
                if (empty($date)) {
                    $isValidCitation = false;
                    $error_date = "Date field must be filled";
                }
                if (!validateDate($date)) {
                    $isValidCitation = false;
                    $error_date = "Invalid date format";
                }

                if ($isValidCitation) {
                    $display = "{$login} sent the following citation : <br> \"{$citation}\" - {$author} - {$date}" ;
                } else {
                    $display ='<b style = "color:red"> Invalid Citation </b>';
                }
            }
            ?>


            <form method="post" name="FrameCitation" action="" autocomplete="off">
                <table border="1" bgcolor="#ccccff" >
                    <tbody>
                        <tr>
                            <th><label for="login">Login</label></th>
                            <td><input name="login" maxlength="64" size="32" required="required" value=<?php echo $login; ?>></td>
                            <?php echo "<td>{$error_login} </td>" ?>
                        </tr>
                        <tr>
                            <th><label for="citation">Citation</label></th>
                            <td><textarea cols="64" rows="5" name="citation" required="required"><?php echo $citation ?></textarea></td>
                            <?php echo "<td>{$error_citation} </td>" ?>
                        </tr>
                        <tr>
                            <th><label for="auteur">Auteur</label></th>
                            <td><input name="auteur" maxlength="128" size="64" value=<?php echo $author; ?>></td>
                            <?php echo "<td>{$error_author} </td>" ?>
                        </tr>
                        <tr>
                            <th><label for="date">Date de publication</label></th>
                            <td><input name="date" maxlength="16" size="64" type="date" value=<?php echo $date; ?>></td>
                            <?php echo "<td>{$error_date} </td>" ?>
                        </tr>
                        <tr>
                            <td colspan="3" align="center">
                                <input name="Envoyer" value="Enregistrer la citation" type="submit">
                                <input name="Effacer" value="Annuler" type="reset">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

            <?php echo $display ?>

        </article>
    </main>

    </div>

	<?php
		include "../../../ressources/php/footer.php";
	?>

</body>
</html>