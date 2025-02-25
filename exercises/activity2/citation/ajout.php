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
            <form method="post" name="FrameCitation" action="viewCitation.php" autocomplete="off">
                <table border="1" bgcolor="#ccccff" frame="above">
                    <tbody>
                        <tr>
                            <th><label for="login">Login</label></th>
                            <td><input name="login" maxlength="64" size="32"></td>
                        </tr>
                        <tr>
                            <th><label for="citation">Citation</label></th>
                            <td><textarea cols="128" rows="5" name="citation"></textarea></td>
                        </tr>
                        <tr>
                            <th><label for="auteur">Auteur</label></th>
                            <td><input name="auteur" maxlength="128" size="64"></td>
                        </tr>
                        <tr>
                            <th><label for="date">Date de publication</label></th>
                            <td><input name="date" maxlength="16" size="64" type="date" value = <?php echo Date('Y-m-d') ?>></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input name="Envoyer" value="Enregistrer la citation" type="submit">
                                <input name="Effacer" value="Annuler" type="reset">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </article>
    </main>

    </div>

	<?php
		include "../../../ressources/php/footer.php";
	?>

</body>
</html>