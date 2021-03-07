<?php
include 'connect.php';

if (isset($_GET)) {//echo "Welcome ";
	if ($_GET['ADD'] == 'true') {//echo "ADD ";
		
		//รับค่ามาเก็บไว้ในตัวแปร
		$Status_Content = 'Post';	//ใส่ตัวแปรในการกดsubmit
		// echo "$Status_Content \n ";
		$Text_nct = $_GET['Text_nct'];
		$Text_ct = $_GET['Text_ct'];
		$Link_VDO = $_GET['Link_VDO'];
		$Link_Map = $_GET['Link_Map'];
		
							
		$sql =" INSERT INTO `content` (`ID_Content`, `Date_Content`, `Status_Content`, `Text_NameContent`, `Text_Content`, `Link_VDO`, `Link_Map`, `Conter_Read`)
				VALUES (NULL, current_timestamp(), '$Status_Content', '$Text_nct', '$Text_ct', '$Link_VDO', '$Link_Map', '')";

		$result = mysqli_query($link, $sql);

		if ($result) {
			echo "เพิ่ม $Text_nct เรียบร้อยจ้า \n ";
			// echo "$Stt_ct \n ";
			// echo "$Text_nct \n ";
			// echo "$Text_ct \n ";
			// echo "$Link_VDO \n ";
			// echo "$Link_Map \n ";
		} else {
			echo "false";
		}

	} 
	// else echo "Welcome ";
   
}
	mysqli_close($link);
?>