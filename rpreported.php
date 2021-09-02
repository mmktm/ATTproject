<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //กดตัวแปร rpreported
    if(isset($_GET['rpreported'])) {

		$rpreported = $_GET['rpreported'];
        
        // $sql_rpreported = " SELECT * FROM report INNER JOIN content ON report.ID_Content = content.ID_Content 
        //                         ORDER BY
        //                             report.Date_Report DESC" ;

        $sql_rpreported =" SELECT 
                                report.ID_Report,
								report.ID_User,
								report.Username,
								report.Statement,
								report.Status_Report,
								report.Date_Report,
								report.Time_Report,
								`user`.ID_User AS ID_Author,
                                `user`.Username AS Author,
                                `user`.Image,
                                content.ID_Content,
                                content.Date_Content,
                                content.Time_Content,
								content.Status_Content,
                                content.Title,
                                category.Category,
                                content.Content,
                                content.Link_VDO,
                                content.Latitude,
                                content.Longitude,
                                content.Images01,
                                content.Images02,
                                content.Images03,
                                content.Images04,
								content.Counter_Read,
                                content.Total_Fav,
                                content.Total_Com,
                                content.Total_Save,
                                content.Total_Share
                        
                            FROM
                                content
                                        LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content
                                        JOIN category ON con_in_cate.ID_Category = category.ID_Category
                                        RIGHT JOIN post ON content.ID_Content = post.ID_Content
                                        JOIN `user` ON post.ID_User = `user`.ID_User
                                        JOIN report ON content.ID_Content = report.ID_Content
                            WHERE report.Status_Report = 'reported'
                            ORDER BY
                                report.Date_Report DESC" ;

        $result_rpreported = $link->query($sql_rpreported);
        if($result_rpreported->num_rows <=0 ){
            echo "no report" ;
        } else {
            while ($row_rpreported = $result_rpreported->fetch_assoc()){
                $output_rpreported[] = $row_rpreported ;
                $j_rpreported = json_encode($output_rpreported,JSON_NUMERIC_CHECK);
            }
            // echo "$result_rpreported->num_rows\n";
            echo "$j_rpreported\n" ;
        }
    }
    mysqli_close($link);
?>