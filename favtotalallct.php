<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

if(isset($_POST['favtotalallct'])) { // มีตัวแปร favtotalallct 

    //select จำนวน content ทั้งหมด
    $sql_totalcontent = "SELECT ID_Content FROM content ORDER BY ID_Content DESC LIMIT 1";

    $result_totalcontent = $link->query($sql_totalcontent);
    $row_totalcontent = $result_totalcontent->fetch_assoc();//assocเลือกใช้ค่าแบบชื่อคอลัมอย่างเดียว
    $totalcontent = $row_totalcontent['ID_Content'] ;//ค่า totalcontent ที่ select ได้

    // echo $totalcontent."\n";

    for($i=1 ; $i <= $totalcontent ; $i++){
    
    //เลือกcontent ที่มีสถานะเป็น post และ fav
    $sql_favtotalallct = "SELECT
                                content.Title,
                                SUM(CASE WHEN content.ID_Content = favorite.ID_Content THEN	1 ELSE 0 END) AS fav
                            -- 	COUNT(favorite.ID_User)
                            FROM
                                content
                                LEFT JOIN favorite ON content.ID_Content = $i
                            WHERE
                                -- content.Status_Content = 'Post' AND 
                                favorite.Status_Fav = 'favorited'";

    $result_favtotalallct = $link->query($sql_favtotalallct);

    if($result_favtotalallct->num_rows <=0 ){
        echo "No favorite in $i\n" ;
    } else {
        while ($row_favtotalallct = $result_favtotalallct->fetch_assoc()){
        // $output_favtotalallct[] = $row_favtotalallct ;
        // $j_favtotalallct = json_encode($output_favtotalallct,JSON_NUMERIC_CHECK);
        $totalfav = $row_favtotalallct['fav'];
        }
        echo json_encode($totalfav,JSON_NUMERIC_CHECK)."\n"; //แค่ตัวเลข
        // echo $j_favtotalallct; //ติดloop 1 12 123
    }
}//echo $j_favtotalallct;
}
mysqli_close($link);
?> 