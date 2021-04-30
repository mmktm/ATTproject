<?php
// header("content-type:text/javascript;charset=utf-8");
// header('content-type: application/json');

error_reporting(0);
error_reporting(E_ERROR | E_PARSE);
// connect to mysql
$host = '35.240.165.55';
$username = 'root' ;
$pass = 'root1628';
$table_database = 'pj-att';

$link = mysqli_connect( $host , $username , $pass , $table_database );
mysqli_set_charset($link,"utf8");


if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    
    exit;
}

if (!$link->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $link->error);
    exit();
	}

echo "Connect to Cloud Successfully \n";

?>