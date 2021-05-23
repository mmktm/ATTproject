<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //ถ้ามีการกดตัวแปร rankbyuser เข้ามา
    if(isset($_GET['rankbyuser'])) {
        
        $sql_rankbyuser = " SELECT
                                `user`.ID_User,
                                `user`.Username,
                                SUM( content.Counter_Read ) AS sumread 
                            FROM
                                post
                                JOIN `user` ON post.ID_User = `user`.ID_User
                                JOIN content ON post.ID_Content = content.ID_Content 
                            GROUP BY
                                `user`.ID_User 
                            ORDER BY
                                sumread DESC 
                                LIMIT 10 " ;

        $result_rankbyuser = $link->query($sql_rankbyuser);
        if($result_rankbyuser->num_rows <=0 ){
            echo "error" ;
        } else {
            while ($row_rankbyuser = $result_rankbyuser->fetch_assoc()){
                $output_rankbyuser[] = $row_rankbyuser ;
                $j_rankbyuser = json_encode($output_rankbyuser,JSON_NUMERIC_CHECK);
                // echo $row_rankbyuser['ID_User']."\n";
            }
            echo "$j_rankbyuser\n" ;

        }

    }
    mysqli_close($link);
?>