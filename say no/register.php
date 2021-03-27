<?php
	$db = mysqli_connect('localhost','root','1234','att-review');
	if (!$db) {
		echo "Database connection faild";
	}
	else{
		echo "Connection Success";
	}

	$email = $_POST['email'];
	$password = $_POST['pass'];

	// // $sql = "SELECT username FROM login WHERE username = '".$username."'";
	$sql =" INSERT INTO `user` (`ID_User`, `Date_User`, `Username`, `Password`, `Email`, `Status_User`) VALUES (NULL, current_timestamp(), 'deejaa', '".$password."' , '".$email."', '')";

	// $result = mysqli_query($db,$sql);
	// $count = mysqli_num_rows($result);

	// if ($count == 1) {
	// 	echo json_encode("Error");
	// }else{
	// 	$insert = "INSERT INTO user (username,password)VALUES('".$username."','".$password."')";
	// 	$query = mysqli_query($db,$insert);
	// 	if ($query) {
	// 		echo json_encode("Success");
	// 	}
	// }

?>
