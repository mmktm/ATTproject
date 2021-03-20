<?php
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connectlc.php'; //เชื่อมต่อDATABASE local

if (isset($_POST)) {//echo "Welcome ";
	// if ($_GET['ADD'] == 'true') {//echo "ADD ";
		
		header('Content-type: application/json');
		//ตัวแปรรับค่าการค้นหาบทความ Search_content(S_ct)
		$title = $_POST['title'];
		//echo $title ;

		//แสดงชื่อบทความ
		$sql_title = "	SELECT Text_NameContent FROM content
						WHERE ID_Content = '{$title}' " ;

		//แสดงวันเวลาที่โพสบทความ
		$sql_datect = "	SELECT Date_Content FROM content
						WHERE ID_Content = '{$title}' " ;

		//แสดงรูปภาพของบทความ
		$sql_image = "	SELECT Images01,Images02,Images03,Images04,Images05,Images06,Images07,Images08,Images09,Images10 FROM content
						WHERE ID_Content = '{$title}' " ;

		//แสดงid_userที่โพสบทความนั้นๆ
		$sql_idauthor = "	SELECT ID_User FROM post
							WHERE ID_Content = '{$title}' and Status_Post='Post' " ;

		//แสดงชื่อบทความและชื่อผู้เขียน
		$sql_nameauthor = "	SELECT content.Text_NameContent,`user`.Username AS author 
							FROM ((content INNER JOIN post ON content.ID_Content = post.ID_Content)
							INNER JOIN `user` ON post.ID_User= `user`.ID_User)
							WHERE content.ID_Content = '{$title}' " ;

		//แสดงไอดีหมวดหมู่
		$sql_idcate = " SELECT ID_Category FROM con_in_cate
						WHERE ID_Content = '{$title}' " ;

		//แสดงid_content,name_content and name_category
		$sql_namecate = "	SELECT content.ID_Content,content.Text_NameContent,category.Name_Category
							FROM ((content INNER JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content)
							INNER JOIN category ON con_in_cate.ID_Category = category.ID_Category)
							WHERE content.ID_Content = '{$title}' " ;
		//แสดงid andยอดถูกใจบทความ
		$sql_favorite = "	SELECT ID_Content,COUNT(ID_User)as fav FROM favorite
							WHERE Status_Fav = '1' AND ID_Content = '{$title}'
							GROUP BY ID_Content" ;

		//แสดงไอดีและยอดแชร์ของบทความ
		$sql_share = "	SELECT ID_Content,COUNT(ID_User) FROM `share`
						WHERE  Status_Share = '1' AND ID_Content = '{$title}'
						GROUP BY ID_Content " ;

					
		//เก็บค่าข้อมูลที่ได้ไว้ในตัวแปร result_			
		$result_title = mysqli_query($link, $sql_title);
		$result_datect = mysqli_query($link, $sql_datect);
		$result_image = mysqli_query($link, $sql_image);
		$result_idauthor = mysqli_query($link, $sql_idauthor);
		$result_nameauthor = mysqli_query($link,$sql_nameauthor);
		$result_idcate = mysqli_query($link,$sql_idcate);
		$result_namecate = mysqli_query($link,$sql_namecate);
		$result_favorite = mysqli_query($link,$sql_favorite);
		$result_share = mysqli_query($link,$sql_share);
		
		//เก็บตัวแปรเป็นแถวในarray
		$row_title = mysqli_fetch_assoc($result_title);
		$row_datect = mysqli_fetch_assoc($result_datect);
		$row_image = mysqli_fetch_assoc($result_image);
		$row_idauthor = mysqli_fetch_assoc($result_idauthor);
		$row_nameauthor = mysqli_fetch_assoc($result_nameauthor);
		$row_idcate = mysqli_fetch_assoc($result_idcate);
		$row_namecate = mysqli_fetch_assoc($result_namecate);
		$row_favorite = mysqli_fetch_assoc($result_favorite);
		$row_share = mysqli_fetch_assoc($result_share);

		//ตัวแปรที่แสดงข้อมูล
		$output_title[] = $row_title ;
		$output_datect[] = $row_datect ;
		$output_image[] = $row_image ;
		$output_idauthor[] = $row_idauthor ;
		$output_nameauthor[] = $row_nameauthor ;
		$output_idcate[] = $row_idcate ;
		$output_namecate[] = $row_namecate ;
		$output_favorite[] = $row_favorite ;
		$output_share[] = $row_share ;

		//เก็บข้อมูลรูปแบบ json_encode
		$j_title = json_encode($output_title);
		$j_datect = json_encode($output_datect);
		$j_image = json_encode($output_image);
		$j_idauthor = json_encode($output_idauthor);
		$j_nameauthor = json_encode($output_nameauthor);
		$j_idcate = json_encode($output_idcate);
		$j_namecate = json_encode($output_namecate);
		$j_favorite = json_encode($output_favorite);
		$j_share = json_encode($output_share);


		echo $j_title ;
		echo $j_datect ;
		echo $j_image ;
		echo $j_idauthor ;
		echo $j_nameauthor ;
		echo $j_idcate ;
		echo $j_namecate ;
		echo $j_favorite ;
		echo $j_share ;

		// //ดูข้อมูลที่queryมา
		// if($result_namecate){
		// 	while ($row = mysqli_fetch_assoc($result_namecate))
		// 				{$output1[]=$row;}
		// 	echo json_encode(array( "code" => 200, "data" => $output1)) ;
		// 	echo "\n" ;
		// } else {
		// 	echo "false";
		// }

	} 
	// else echo "Welcome ";
   
// }
	
		// if ($result_title & $result_datect ) {
		// 	while($row=mysqli_fetch_assoc($result_title))
		// 			{ $output[] = $row ; }

		// 	//ดูข้อมูลที่queryมา
		// 	echo json_encode($output) ;
		// 	echo "\n" ;
			
		// 	while($row=mysqli_fetch_assoc($result_datect))
		// 		{$output1[]=$row;}

		// 	//ดูข้อมูลที่queryมา
		// 	echo json_encode($output1) ;
		// 	echo "\n" ;
		
		// if($result_faverite){
		// 	while ($row = mysqli_fetch_assoc($result_faverite))
		// 				{$output1[]=$row;}

		// 	//ดูข้อมูลที่queryมา
		// 	echo json_encode($output1) ;
		// 	echo "\n" ;
		

		// } else {
		// 	echo "false";
		// }
	// 	if($result_namecate){
	// 		while ($row = mysqli_fetch_assoc($result_namecate))
	// 					{$output1[]=$row;}

	// 		//ดูข้อมูลที่queryมา
	// 		echo json_encode($output1) ;
	// 		echo "\n" ;
		

	// 	} else {
	// 		echo "false";
	// 	}

	// } 
	// else echo "Welcome ";
   
// }
	mysqli_close($link);
?>