<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร myfavstore รับค่า ID_user เข้ามา
    if(isset($_GET['myfavstore'])&& $_GET['myfavstore'] != '') {
        header('Content-type: application/json');

        //ตัวแปรรับค่า ID_User
		$myfavstore = $_GET['myfavstore'];
        
        $sql_myfavstore = " SELECT 
                                `user`.ID_User,
                                `user`.Username,
                                favorite.Status_Fav,
	                            favorite.Date_Fav,
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
                                ((((( `user` INNER JOIN favorite ON user.ID_User = favorite.ID_User ) 
                                INNER JOIN content ON favorite.ID_Content = content.ID_Content )
                                LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
                                LEFT JOIN category cate0 ON con_in_cate.ID_Category0 = cate0.ID_Category )
                                LEFT JOIN category cate1 ON con_in_cate.ID_Category1 = cate1.ID_Category )
                                LEFT JOIN category cate2 ON con_in_cate.ID_Category2 = cate2.ID_Category 
                            WHERE
                                user.ID_User = $myfavstore AND favorite.Status_Fav = 1
                            ORDER BY
                                favorite.Date_Fav DESC" ;

        $result_myfavstore = $link->query($sql_myfavstore);
        if($result_myfavstore->num_rows <=0 ){
            echo "ไม่มีบทความที่ชื่นชอบ" ;
        } else {
            while ($row_myfavstore = $result_myfavstore->fetch_assoc()){
                $output_myfavstore[] = $row_myfavstore ;
                $j_myfavstore = json_encode($output_myfavstore);
            }
            echo "$j_myfavstore\n" ;
        }

    }
    mysqli_close($link);
?>