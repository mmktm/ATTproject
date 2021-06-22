<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

if(isset($_POST['favtotelallct'])) { // มีตัวแปร favtotelallct 

    //select จำนวน content ทั้งหมด
    $sql_totelcontent = "SELECT ID_Content FROM content ORDER BY ID_Content DESC LIMIT 1";

    $result_totelcontent = $link->query($sql_totelcontent);
    $row_totelcontent = $result_totelcontent->fetch_assoc();//assocเลือกใช้ค่าแบบชื่อคอลัมอย่างเดียว
    $totelcontent = $row_totelcontent['ID_Content'] ;//ค่า totelcontent ที่ select ได้

    // echo $totelcontent."\n";

    for($i=1 ; $i <= $totelcontent ; $i++){
    
    //เลือกcontent ที่มีสถานะเป็น post และ fav
    $sql_favtotelallct = "SELECT
                                content.Title,
                                SUM(CASE WHEN content.ID_Content = favorite.ID_Content THEN	1 ELSE 0 END) AS fav
                            -- 	COUNT(favorite.ID_User)
                            FROM
                                content
                                LEFT JOIN favorite ON content.ID_Content = $i
                            WHERE
                                -- content.Status_Content = 'Post' AND 
                                favorite.Status_Fav = '1'";

    $result_favtotelallct = $link->query($sql_favtotelallct);

    if($result_favtotelallct->num_rows <=0 ){
        echo "No favorite in $i\n" ;
    } else {
        while ($row_favtotelallct = $result_favtotelallct->fetch_assoc()){
        // $output_favtotelallct[] = $row_favtotelallct ;
        // $j_favtotelallct = json_encode($output_favtotelallct,JSON_NUMERIC_CHECK);
        $totalfav = $row_favtotelallct['fav'];
        }
        echo json_encode($totalfav,JSON_NUMERIC_CHECK)."\n"; //แค่ตัวเลข
        // echo $j_favtotelallct; //ติดloop 1 12 123
    }
}//echo $j_favtotelallct;
}
mysqli_close($link);
?> 