<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร myfavstore รับค่า ID_user เข้ามา
    if(isset($_GET['myfavstore'])&& $_GET['myfavstore'] != '') {

        //ตัวแปรรับค่า ID_User
		$myfavstore = $_GET['myfavstore'];
        
        //iduser,username,statusfav,datefav,idcontent,datecontent,namecontent,image1,namecate
        $sql_myfavstore = " SELECT 
                                -- `user`.ID_User,
                                -- `user`.Username,
                                favorite.Status_Fav,
	                            favorite.Date_Fav,
                                favorite.Time_Fav,
                                content.ID_Content,
                                post.Username AS Author, /*เพิ่มชื่อผู้เขียน */
                                content.Date_Content,
                                content.Status_Content,
                                content.Title,
                                content.Images01,
                                content.Images02,
                                content.Images03,
                                content.Images04,
                                con_in_cate.ID_Category,
                                category.Category
                            FROM
                                `user` 
                                INNER JOIN favorite ON user.ID_User = favorite.ID_User
                                INNER JOIN content ON favorite.ID_Content = content.ID_Content
                                INNER JOIN post ON content.ID_Content = post.ID_Content /*เพิ่มชื่อผู้เขียน */
                                LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content
                                LEFT JOIN category ON con_in_cate.ID_Category = category.ID_Category
                            WHERE
                                user.ID_User = $myfavstore AND favorite.Status_Fav = 'favorited'
                                AND content.Status_Content = 'posted'
                            ORDER BY
                                favorite.Date_Fav DESC" ; 

        $result_myfavstore = $link->query($sql_myfavstore);
        if($result_myfavstore->num_rows <=0 ){
            echo "ไม่มีบทความที่ชื่นชอบ" ;
        } else {
            while ($row_myfavstore = $result_myfavstore->fetch_assoc()){
                $output_myfavstore[] = $row_myfavstore ;
                $j_myfavstore = json_encode($output_myfavstore,JSON_NUMERIC_CHECK);
            }
            echo "$j_myfavstore\n" ;
        }

    }
    mysqli_close($link);
?>