<?php
include 'connect.php';

if (isset($_GET)) {//echo "Welcome ";
	if ($_GET['ADD'] == 'true') {//echo "ADD ";
		
		//ตัวแปรรับค่าการค้นหาบทความ Search_content(S_ct)
		$S_ct = $_GET['S_ct'];
		$sql = "SELECT ID_Content,Text_NameContent FROM content
				WHERE Text_NameContent LIKE '%{$S_ct}%' ";
					
		$result_S_ct = mysqli_query($link, $sql);
	
		if ($result_S_ct) {
			while(	$row=mysqli_fetch_assoc($result_S_ct)){
					$output[]=$row;} //while

			//ดูข้อมูลที่queryมา
			echo json_encode($output);
			//echo " $result_S_ct " ;
		} else {
			echo "false";
		}
	} 
	// else echo "Welcome ";
   
}
	mysqli_close($link);
?>