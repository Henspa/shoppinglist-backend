<?php
require_once 'inc/headers.php';
require_once 'inc/functions.php';
require_once 'inc/delete.php';

$input = json_decode(file_get_contents('php://input'));
$description = filter_var($input->description,FILTER_SANITIZE_STRING);
$amount = filter_var($input->amount,FILTER_SANITIZE_INT);

try {
    $db = openDB();
    
    $query = $db->prepare('insert into item(description) values(:description)','insert into item(amount) values(:amount)');
    $query->bindValue(':description',$description,PDO::PARAM_STR);
    $query->bindValue(':amount',$amount,PDO::PARAM_INT);
    $query->execute();
    header('HTTP/1.1 200 OK');
    $data = array('id' => $db->lastInsertId(),'description' => $description);
    print json_encode($data);
} catch (PDOException $pdoex) {
    returnError($pdoex);
}