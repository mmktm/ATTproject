<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีการกดตัวแปร rankbyallct เข้ามา
    if(isset($_GET['rankbyallct'])) {

        //ตัวแปรรับค่า ID_category
		//$rankbyallct = $_GET['rankbyallct'];
        
        $sql_rankbyallct = " SELECT
                                    content.Counter_Read,
                                    content.ID_Content,
                                    content.Date_Content,
                                    content.Time_Content,
                                    content.Status_Content,
                                    content.Title,
                                    content.Content,
                                    content.Link_VDO,
                                    content.Location,
                                    content.Images01,
                                    content.Images02,
                                    content.Images03,
                                    content.Images04,
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

        $result_rankbyallct = $link->query($sql_rankbyallct);
        if($result_rankbyallct->num_rows <=0 ){
            echo "ไม่พบบทความเกี่ยวกับ ID_Category : $rankbyallct น้า" ;
        } else {
            while ($row_rankbyallct = $result_rankbyallct->fetch_assoc()){
                $output_rankbyallct[] = $row_rankbyallct ;
                $j_rankbyallct = json_encode($output_rankbyallct);
            }
            echo "$j_rankbyallct\n" ;
        }

    }
    mysqli_close($link);
?>