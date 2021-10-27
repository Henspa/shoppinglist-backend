<?php
require_once 'inc/headers.php';
require_once 'inc/functions.php';

try {
    $db = openDB();

} catch (PDOException $pdoex) {
    returnError($pdoex);
}