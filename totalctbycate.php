<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //กดปุ่ม plus แสดงชื่อบทความทั้งหมด
    //total นับทั้งหมด ทุกสถานะ
    if(isset($_GET['plus'])){

        $sql_totalctbycate = " SELECT
                                category.ID_Category,
                                category.Category,
                                COUNT( con_in_cate.ID_Content ) AS Total
                         FROM
                                category
                                LEFT JOIN con_in_cate ON category.ID_Category = con_in_cate.ID_Category
                                LEFT JOIN post ON con_in_cate.ID_Content = post.ID_Content
                         GROUP BY
                                category.ID_Category " ;

            $result_totalctbycate = $link->query($sql_totalctbycate);
                if($result_totalctbycate->num_rows <=0 ){
                    echo "error" ;
                } else {
                    while ($row_totalctbycate = $result_totalctbycate->fetch_assoc()){
                        $output_totalctbycate[] = $row_totalctbycate ;
                        $j_totalctbycate = json_encode($output_totalctbycate,JSON_NUMERIC_CHECK);
                    }
                    echo "$j_totalctbycate\n" ;
                }

    }
    mysqli_close($link);

?>