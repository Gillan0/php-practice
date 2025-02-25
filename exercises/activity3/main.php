<?php

function load($class) {
    include __DIR__."/entity/".$class.".class.php";
}

spl_autoload_register("load");

function main() {

    $db = new CitationDatabase();

    $a1 = new Author("Rousseau", "Jean-Jacques", "1780-01-01");
    $a2 = new Author("Bonisseur de la Bath", "Hubert", "1963-01-01");

    $db->addCitation("xxx_darknite_xxx", $a1, "Pour connaître les hommes, il faut les voir agir.", date("Y-m-d"));
    $db->addCitation("xxx_darknite2_xxx", $a1, "Kirikou est petit", date("Y-m-d"));
    $db->addCitation("oss177fan", $a2, "Je vous mettrai un petit coup de P O L I S H", date("Y-m-d"));

    return $db;
}

function generateDatalistAuthors(CitationDatabase $db): string {
    $html_code = "";
    foreach($db->getAuthors() as $author) {
        $html_code .= "<option value=\" ".$author->__toString() ."\">";
    }
    echo "test";
    return $html_code;
}

?>
