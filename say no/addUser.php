<?php
header("content-type:text/javascript;charset=utf-8");
error_reporting(0);
error_reporting(E_ERROR | E_PARSE);
//conect to mysql
$link = mysqli_connect('localhost', 'root', '1234', "att-review");


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
		
		$Username = $_GET['Username'];
		$password = $_GET['password'];		
		$email = $_GET['email'];
		// $Status_User = Active;
		
		//print DATA
		// echo "$Username \n ";
		// echo "$password \n ";
		// echo "$email \n ";
		// echo "$Status_User \n ";
							
		$sql = "INSERT INTO user (ID_User, Date_User, Username, password, email, Status_User)
				VALUES (NULL,current_timestamp(),'$Username','$password','$email','$Status_User')";

		$result = mysqli_query($link, $sql);

		if ($result) {
			echo "เรียบร้อยจ้า \n ";
			echo "$Username \n ";
			echo "$password \n ";
			echo "$email \n ";
			echo "$Status_User \n ";
		} else {
			echo "false";
		}

	} 
	// else echo "Welcome ";
   
}
	mysqli_close($link);
?>