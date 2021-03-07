<?php
header("content-type:text/javascript;charset=utf-8");
error_reporting(0);
error_reporting(E_ERROR | E_PARSE);

// conect to mysql
$host = 'localhost';
$username = 'root' ;
$pass = '1234';
$table_database = 'att-review';

$link = mysqli_connect( $host , $username , $pass , $table_database );
// $link = mysqli_connect('localhost', 'root', '1234', "att-review");
mysqli_set_charset($link,"utf-8");


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

//echo "Connected Successfully \n";

?>