<?php
include 'connect.php';

if (isset($_GET)) {//echo "Welcome ";
	if ($_GET['ADD'] == 'true') {//echo "ADD ";
		
		//ตัวแปรรับค่าการค้นหาบทความ Search_content(S_ct)
		$S_ct = $_GET['S_ct'];
		$sql = "SELECT ID_Content,Text_NameContent FROM content
				WHERE Text_NameContent LIKE '%{$S_ct}%' ";

		$sf = "	SELECT ID_Content,COUNT(ID_User) FROM faverite
				WHERE Status_Fav='1'
				GROUP BY ID_Content;" ;
					
		$result_S_ct = mysqli_query($link, $sql);
		$result_sf = mysqli_query($link,$sf);
	
		if ($result_S_ct & $result_sf) {
			while($row=mysqli_fetch_assoc($result_S_ct)){
			$output[]=$row;}

			//ดูข้อมูลที่queryมา
			echo json_encode($output) ;
			echo "\n" ;

			while($row = mysqli_fetch_assoc($result_sf)){
					$output1[]=$row;}

			echo json_encode($output1) ;
			echo "\n" ;
			// echo "เรียบร้อยจ้า \n ค้นหา $S_ct ในฐานข้อมูล พบ $rrr['ID_Content'] & $rrr['Text_NameContent']";
		} else {
			echo "false";
		}

	} 
	// else echo "Welcome ";
   
}
	mysqli_close($link);
?>