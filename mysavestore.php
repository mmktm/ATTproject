<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร mysavestore รับค่า ID_user เข้ามา
    if(isset($_GET['mysavestore'])&& $_GET['mysavestore'] != '') {
        header('Content-type: application/json');

        //ตัวแปรรับค่า ID_User
		$mysavestore = $_GET['mysavestore'];
        
        $sql_mysavestore = " SELECT 
                                `user`.ID_User,
                                `user`.Username,
                                save.Status_Save,
                                save.Date_Save,
                                content.ID_Content,
                                content.Date_Content,
                                content.Status_Content,
                                content.Text_NameContent,
                                content.Images01,
                                con_in_cate.ID_Category0,
                                con_in_cate.ID_Category1,
                                con_in_cate.ID_Category2,
                                cate0.Name_Category AS Cate0,
                                cate1.Name_Category AS Cate1,
                                cate2.Name_Category AS Cate2 
                            
                            FROM
                                ((((( `user` INNER JOIN save ON user.ID_User = save.ID_User ) 
                                INNER JOIN content ON save.ID_Content = content.ID_Content )
                                LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
                                LEFT JOIN category cate0 ON con_in_cate.ID_Category0 = cate0.ID_Category )
                                LEFT JOIN category cate1 ON con_in_cate.ID_Category1 = cate1.ID_Category )
                                LEFT JOIN category cate2 ON con_in_cate.ID_Category2 = cate2.ID_Category 
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
                $j_mysavestore = json_encode($output_mysavestore);
            }
            echo "$j_mysavestore\n" ;
        }

    }
    mysqli_close($link);
?>