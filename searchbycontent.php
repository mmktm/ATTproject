<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร searchbycontent รับค่า คำค้นหา เข้ามาและ ไม่ใช่ค่าว่าง
    if(isset($_GET['searchbycontent']) && $_GET['searchbycontent'] != ''){

        //ตัวแปรรับค่าการค้นหาบทความ
		$searchbycontent = $_GET['searchbycontent'];
        
        $sql_searchbycontent = " SELECT * FROM content
                                 WHERE Status_Content = 'Post' AND Title LIKE '%{$searchbycontent}%' " ;

        $result_searchbycontent = $link->query($sql_searchbycontent);
        if($result_searchbycontent->num_rows <=0 ){
            echo "ไม่พบบทความชื่อ $searchbycontent น้า" ;
        } else {
            while ($row_searchbycontent = $result_searchbycontent->fetch_assoc()){
                $output_searchbycontent[] = $row_searchbycontent ;
                $j_searchbycontent = json_encode($output_searchbycontent);
                
            }
            echo "$j_searchbycontent\n" ;

        }
    }

    mysqli_close($link);
?>