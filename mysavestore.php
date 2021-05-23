<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร mysavestore รับค่า ID_user เข้ามา
    if(isset($_GET['mysavestore'])&& $_GET['mysavestore'] != '') {

        //ตัวแปรรับค่า ID_User
		$mysavestore = $_GET['mysavestore'];
        
        $sql_mysavestore = " SELECT 
                                `user`.ID_User,
                                `user`.Username,
                                save.Status_Save,
                                save.Date_Save,
                                save.Time_Save,
                                content.ID_Content,
                                content.Date_Content,
                                content.Status_Content,
                                content.Title,
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
                                ((((( `user` INNER JOIN save ON user.ID_User = save.ID_User )
                                INNER JOIN content ON save.ID_Content = content.ID_Content )
                                LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
                                LEFT JOIN category cate1 ON con_in_cate.ID_Category1 = cate1.ID_Category )
                                LEFT JOIN category cate2 ON con_in_cate.ID_Category2 = cate2.ID_Category )
                                LEFT JOIN category cate3 ON con_in_cate.ID_Category3 = cate3.ID_Category
                            WHERE
                                user.ID_User = $mysavestore AND save.Status_Save = 1
                            ORDER BY
                                save.Date_Save DESC" ;

        $result_mysavestore = $link->query($sql_mysavestore);
        if($result_mysavestore->num_rows <=0 ){
            echo "ไม่มีบทความที่บันทึก" ;
        } else {
            while ($row_mysavestore = $result_mysavestore->fetch_assoc()){
                $output_mysavestore[] = $row_mysavestore ;
                $j_mysavestore = json_encode($output_mysavestore,JSON_NUMERIC_CHECK);
            }
            echo "$j_mysavestore\n" ;
        }

    }
    mysqli_close($link);
?>