<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีการกดตัวแปร allranking เข้ามา
    if(isset($_GET['allranking'])) {

        //ตัวแปรรับค่า ID_category
		//$allranking = $_GET['allranking'];
        
        $sql_allranking = " SELECT
                                    content.Counter_Read,
                                    content.ID_Content,
                                    content.Date_Content,
                                    content.Status_Content,
                                    content.Title,
                                    content.Content,
                                    content.Link_VDO,
                                    content.Location,
                                    content.Images01,
                                    content.Images02,
                                    content.Images03,
                                    content.Images04,
                                    content.Images05,
                                    content.Images06,
                                    content.Images07,
                                    content.Images08,
                                    content.Images09,
                                    content.Images10,
                                    con_in_cate.ID_Category1,
                                    con_in_cate.ID_Category2,
                                    con_in_cate.ID_Category3,
                                    cate1.Category AS Cate1,
                                    cate2.Category AS Cate2,
                                    cate3.Category AS Cate3
                                FROM
                                    (((content LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
                                    LEFT JOIN category cate1 ON con_in_cate.ID_Category1 = cate1.ID_Category )
                                    LEFT JOIN category cate2 ON con_in_cate.ID_Category2 = cate2.ID_Category)
                                    LEFT JOIN category cate3 ON con_in_cate.ID_Category3 = cate3.ID_Category 
                                WHERE
                                     content.Status_Content = 'Post'
                                ORDER BY
	                                content.Counter_Read DESC   
                                    LIMIT 10 " ;

        $result_allranking = $link->query($sql_allranking);
        if($result_allranking->num_rows <=0 ){
            echo "ไม่พบบทความเกี่ยวกับ ID_Category : $allranking น้า" ;
        } else {
            while ($row_allranking = $result_allranking->fetch_assoc()){
                $output_allranking[] = $row_allranking ;
                $j_allranking = json_encode($output_allranking);
            }
            echo "$j_allranking\n" ;
        }

    }
    mysqli_close($link);
?>