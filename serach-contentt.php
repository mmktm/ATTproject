<?php
include 'connectlc.php'; //connect local

if (isset($_POST)) {//echo "Welcome ";
	header('Content-type: application/json');
		
		//ตัวแปรรับค่าการค้นหาบทความ Search_content(S_ct)
		$S_ct = $_POST['S_ct'];

		//ค้นหาตามชื่อบทความ
		$sql_scontent = "SELECT ID_Content,Text_NameContent FROM content
						WHERE Text_NameContent LIKE '%{$S_ct}%' ";
			
			$result_scontent = mysqli_query($link, $sql_scontent) ;
			$row_scontent = mysqli_fetch_assoc($result_scontent) ;
			$output_scontent[] = $row_scontent ; 
			$j_scontent = json_encode($output_scontent) ;

		//ค้นหาตาม category
		$sql_scategory = "SELECT * FROM category
						 WHERE Name_Category LIKE '%{$S_ct}%' ";

			$result_scategory = mysqli_query($link, $sql_scategory) ;
			$row_scategory = mysqli_fetch_assoc($result_scategory) ;
			$output_scategory[] = $row_scategory ; 
			$j_scategory = json_encode($output_scategory) ;
		
		echo "BY CONTENT";
		echo $j_scontent;
		echo "BY CATEGORY";
		echo $j_scategory;
		
	}
	mysqli_close($link);
?>