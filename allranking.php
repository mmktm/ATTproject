<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร allranking เข้ามาและ ไม่ใช่ค่าว่าง
    if(isset($_GET['allranking'])) {
        header('Content-type: application/json');

        //ตัวแปรรับค่า ID_category
		//$allranking = $_GET['allranking'];
        
        $sql_allranking = " SELECT
                                    content.Counter_Read,
                                    content.ID_Content,
                                    content.Date_Content,
                                    content.Status_Content,
                                    content.Text_NameContent,
                                    content.Text_Content,
                                    content.Link_VDO,
                                    content.Link_Map,
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
                                    con_in_cate.ID_Category0,
                                    con_in_cate.ID_Category1,
                                    con_in_cate.ID_Category2,
                                    cate0.Name_Category AS Cate0,
                                    cate1.Name_Category AS Cate1,
                                    cate2.Name_Category AS Cate2
                                FROM
                                    (((content LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
                                    LEFT JOIN category cate0 ON con_in_cate.ID_Category0 = cate0.ID_Category )
                                    LEFT JOIN category cate1 ON con_in_cate.ID_Category1 = cate1.ID_Category)
                                    LEFT JOIN category cate2 ON con_in_cate.ID_Category2 = cate2.ID_Category 
                                WHERE
                                    -- ( con_in_cate.ID_Category0 = $allranking 
                                    -- OR con_in_cate.ID_Category1 = $allranking 
                                    -- OR con_in_cate.ID_Category2 = $allranking )
                                     content.Status_Content = 'Post'
                                ORDER BY
	                                content.Counter_Read DESC    " ;

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