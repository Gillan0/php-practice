<?php

function load($class) {
    include __DIR__."/entity/".$class.".class.php";
}

spl_autoload_register("load");


function main() {

    include "./config/db-config.php";

    $db = new CitationDatabase($db_user, $db_password, $db_host, $db_name);

    return $db;
}

function generateDatalistAuthors(CitationDatabase $db): string {
    $html_code = "";
    foreach($db->getAuthorsCached() as $author) {
        $html_code .= "<option value=\" ".$author->__toString() ."\">";
    }
    return $html_code;
}

?>
