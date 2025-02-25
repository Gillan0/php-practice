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

    <main>
        <article>
            <header><h1>Formaire de création de citations</h1></header>

            <?php 
            
            include "main.php";

            $names = array("login", "citation", "author", "date");
            
            $form_variables = array();
            $form_base_value = array();
            $errors = array();

            foreach($names as $name) {
                $errors[$name] = "";
                $form_variables[$name] = "";
                $form_base_value[$name] = "";
            }

            $form_base_value["date"] = Date("Y-m-d");

            $db = main();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                foreach($names as $name) {
                    $form_variables[$name] = isset($_POST[$name]) ? filter_input(INPUT_POST, $name, FILTER_SANITIZE_STRING) : $form_base_value[$name];
                }
                
                try {

                    $unpack_author = explode("-", $form_variables["author"],2);
                    $author_surname = $unpack_author[0];
                    $author_name = explode("|", $unpack_author[1],2)[0];
                    $author_date = explode("|", $unpack_author[1],2)[1];

                    $db->addCitation($form_variables["login"],
                                new Author($author_surname, $author_name, $author_date),
                                $form_variables["citation"],
                                $form_variables["date"]);
            
                } catch(IllegalParametersException $e) { 
                    $e->getMessage();
                    echo "T nul";
                }
            }
            ?>


            <form method="post" name="FrameCitation" action="" autocomplete="off">
                <table border="1" bgcolor="#ccccff" >
                    <tbody>
                        <tr>
                            <th><label for="login">Login</label></th>
                            <td><input name="login" maxlength="64" size="32" required="required" value=<?php echo $form_variables["login"]; ?>></td>
                            <?php echo "<td>{$error_login} </td>" ?>
                        </tr>
                        <tr>
                            <th><label for="citation">Citation</label></th>
                            <td><textarea cols="64" rows="5" name="citation" required="required"><?php echo $form_variables["citation"] ?></textarea></td>
                            <?php echo "<td>{$error_citation} </td>" ?>
                        </tr>
                        <tr>
                            <th><label for="author">Auteur</label></th>
                            <td>
                            <input type="text" list="author" name="author" size="64"/>
                            <datalist id="author">
                                <?php
                                echo generateDatalistAuthors($db);
                                ?>
                            </datalist>
                            </td>
                            <?php echo "<td>{$error_author} </td>" ?>
                        </tr>
                        <tr>
                            <th><label for="date">Date de publication</label></th>
                            <td><input name="date" maxlength="16" size="64" type="date" value=<?php echo $form_variables["date"]; ?>></td>
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

            <?php echo $db->__toString() ?>

        </article>
    </main>

    </div>

	<?php
		include "../../ressources/php/footer.php";
	?>

</body>
</html>