<?php
header("content-type:text/javascript;charset=utf-8");
error_reporting(0);
error_reporting(E_ERROR | E_PARSE);
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

if (isset($_GET)) {
	if ($_GET['ADD'] == 'true') {
				
		$Username = $_GET['Username'];
		//เข้าตาราง user colume Username ว่ามีค่าตรงกับค่า $Username ที่พึ่งรับมาหรือไม่
		$result = mysqli_query($link, "SELECT * FROM user WHERE Username = '$Username'");

		if ($result) {
			//เก็บค่าทั้ง row ของ $Username ไว้ในตัวแปร $output
			while($row=mysqli_fetch_assoc($result)){
			$output[]=$row;

			}	// while
			//print output
			echo json_encode($output);

		} //if

	} else echo "Welcome connectdailaewjaaaa";	// if2 เชื่อมได้หรือยัง?
   
}	// if1


	mysqli_close($link);
?>