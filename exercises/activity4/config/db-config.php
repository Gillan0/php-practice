<?php

$db_user = getenv("DB_USER");
$db_password = getenv("DB_PASSWORD");
$db_host = getenv("DB_HOST");
$db_name = getenv("DB_NAME");


/**
 * Quick fix for duplication in environment variables
 * (Unknown origin, to fix later)
 * 
 * @param mixed $string
 * @return string
 */
function remove_duplicate($string) {
    return implode('', array_unique(explode("\n", $string)));
}

$db_user = remove_duplicate($db_user);
$db_password = remove_duplicate($db_password);
$db_host = remove_duplicate($db_host);
$db_name = remove_duplicate($db_name);

?>