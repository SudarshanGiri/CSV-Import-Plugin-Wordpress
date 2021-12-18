<?php
global $tableName;
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
$host = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET;
$connect =  new PDO($host, DB_USER, DB_PASSWORD);
$query = "SELECT * FROM $tableName";
$statement = $connect->prepare($query);
$statement->execute();
echo $statement->rowCount();
?>
