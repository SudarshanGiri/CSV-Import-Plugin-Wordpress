
<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
global $tableName;

header('Content-type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

set_time_limit(0);

ob_implicit_flush(1);

session_start();

if(isset($_SESSION['csv_file_name']))
{
//  $connect = new PDO("mysql:host=localhost; dbname=ahs", "root", "");
$host = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET;
$connect =  new PDO($host, DB_USER, DB_PASSWORD);

 $file_data = fopen('file/' . $_SESSION['csv_file_name'], 'r');

 fgetcsv($file_data);

 while($row = fgetcsv($file_data))
 {
  $data = array(
   ':name' => $row[0],
   ':shape' => $row[1],
   ':weight' => $row[2],
   ':treatment' => $row[3],
   ':price' => $row[4]
  );

  $query = "INSERT INTO wp_rubies(name, shape, weight, treatment, price) 
     VALUES (:name, :shape, :weight, :treatment, :price)";

  $statement = $connect->prepare($query);

  $statement->execute($data);

  sleep(1);

  if(ob_get_level() > 0)
  {
   ob_end_flush();
  }
 }

 unset($_SESSION['csv_file_name']);
}

?>
