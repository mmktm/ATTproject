
<?php
header("content-type:text/javascript;charset=utf-8");
include 'connectlc.php'; //เชื่อมต่อDATABASE


if (isset($_POST)) {
		
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

		//แสดงรูปภาพของบทความ
		$sql_namecate = "	SELECT content.ID_Content,content.Text_NameContent,category.Name_Category
							FROM ((content INNER JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content)
							INNER JOIN category ON con_in_cate.ID_Category = category.ID_Category)
							WHERE content.ID_Content = '{$title}' " ;

		//แสดงไอดีและยอดถูกใจบทความ
		$sql_faverite = "	SELECT ID_Content,COUNT(ID_User)as fav FROM faverite
							WHERE Status_Fav = '1' AND ID_Content = '{$title}'
							GROUP BY ID_Content" ;

		//แสดงไอดีและยอดแชร์ของบทความ
		$sql_share = "	SELECT ID_Content,COUNT(ID_User) FROM `share`
						WHERE ID_Content = '{$title}' , Status_Share = '1'
						GROUP BY ID_Content " ;

		//เก็บค่าข้อมูลที่ได้ไว้ในตัวแปร result_			
		$result_title = mysqli_query($link, $sql_title);
		$result_datect = mysqli_query($link, $sql_datect);
		$result_image = mysqli_query($link, $sql_image);
		$result_idauthor = mysqli_query($link, $sql_idauthor);
		$result_nameauthor = mysqli_query($link,$sql_nameauthor);
		$result_idcate = mysqli_query($link,$sql_idcate);
		$result_namecate = mysqli_query($link,$sql_namecate);
		$result_faverite = mysqli_query($link,$sql_faverite);
		$result_share = mysqli_query($link,$sql_share);
		header('Content-type: application/json');
		//ดูข้อมูลที่queryมา
		if($result_namecate){
			while ($row = mysqli_fetch_assoc($result_namecate))
						{$output1[]=$row;}
			echo json_encode(array( "code" => 200, "data" => $output1)) ;
			echo "\n" ;
		} else {
			echo "false";
		}

	} 
	// else echo "Welcome ";
   
// }
	mysqli_close($link);
?>