<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    if(isset($_GET)){
        header('Content-type: application/json');

        //ตัวแปรรับค่าการค้นหาบทความ
		$searchbycontent = $_GET['searchbycotent'];
        
        $sql_searchbycontent = " SELECT Text_NameContent FROM content
                                 WHERE Text_NameContent LIKE '%{$searchbycontent}%' " ;

        $result_searchbycontent = mysqli_query($link,$sql_searchbycontent);
        $row_searchbycontent = mysqli_fetch_assoc($result_searchbycontent);
        $output_searchbycontent[] = $row_searchbycontent ;
        $j_searchbycontent = json_encode($output_searchbycontent);

        echo $j_searchbycontent ;
    }

    mysqli_close($link);
?>