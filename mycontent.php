
<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีตัวแปร profile รับค่า ID_User เข้ามาและ ไม่ใช่ค่าว่าง
    if(isset($_GET['iduser']) && $_GET['iduser'] != ''){
        //รับค่า ID_User
		$iduser = $_GET['iduser'];
        
        //contentof เรียงลำดับจากid บทความ ล่าสุด
        $sql_contentof = " SELECT
                                `user`.ID_User,
                                `user`.Username,
                                `user`.Image,
                                post.Status_Post,
                                content.ID_Content,
                                content.Date_Content,
                                content.Time_Content,
                                content.Title,
                                category.Category,
                                content.Content,
                                content.Link_VDO,
                                content.Location,
                                content.Counter_Read,
                                content.Images01,
                                content.Images02,
                                content.Images03,
                                content.Images04,
                                content.Total_Fav,
                                content.Total_Com,
                                content.Total_Save,
                                content.Total_Share
                                
                            FROM
                                (((( content
                                    LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content )
                                    LEFT JOIN category ON con_in_cate.ID_Category = category.ID_Category )
                                    RIGHT JOIN post ON content.ID_Content = post.ID_Content )
                                    JOIN `user` ON post.ID_User = `user`.ID_User )
                            WHERE
                                post.ID_User = $iduser && content.Status_Content = 'posted'
                            ORDER BY
                                content.ID_Content DESC" ;

            $result_contentof = $link->query($sql_contentof);
            if($result_contentof->num_rows <=0 ){
                echo json_encode("No Content Data");
            } else {
                while ($row_contentof = $result_contentof->fetch_assoc()){
                    $output_contentof[] = $row_contentof ;
                    $j_contentof = json_encode($output_contentof,JSON_NUMERIC_CHECK);
                }
                echo "$j_contentof\n" ;
            }
    }
    mysqli_close($link);
?>