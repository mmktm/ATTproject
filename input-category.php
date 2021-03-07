<?php
header("content-type:text/javascript;charset=utf-8");
error_reporting(0);
error_reporting(E_ERROR | E_PARSE);
//conect to mysql
$link = mysqli_connect('35.240.165.55', 'root', '5qOChd6jzq9vswa7', "ttt");


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

if (isset($_GET)) {//echo "Welcome ";
	if ($_GET['ADD'] == 'true') {//echo "ADD ";
		
		//รับค่ามาเก็บไว้ในตัวแปร
		$Name_Category = $_GET['Name_Category'];	
		// echo "$Name_Category \n ";
		$sql = " INSERT INTO `category` (`Name_Category`) VALUES ('$Name_Category')";					
		

		$result = mysqli_query($link, $sql);

		if ($result) {
			echo "เรียบร้อยจ้า \n เพิ่ม $Name_Category ในฐานข้อมูลแน้วว";
		} else {
			echo "false";
		}

	} 
	// else echo "Welcome ";
   
}
	mysqli_close($link);
?>