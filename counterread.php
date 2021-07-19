<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //กดตัวแปร click ส่งค่า 1 เข้ามา
    if(isset($_POST['Click']) && $_POST['Click'] != '') {

        $_POST['Click'] = '1';
		$click = $_POST['Click']; // $click = 1
        $idcontent = $_POST['ID_Content'] ;
        
        $sql_selectcountread = " SELECT Counter_Read FROM content WHERE ID_Content = '$idcontent'" ;
            $result_selectcountread = $link->query($sql_selectcountread);
            $row_selectcountread = $result_selectcountread->fetch_assoc();
            $selectcountread = $row_selectcountread['Counter_Read']; // $selectcountread
                // echo "$selectcountread\n";

        $countread = $selectcountread + $click ;
            // echo "$countread\n";

        $sql_countread = " UPDATE content SET Counter_Read = '$countread' WHERE ID_Content = '$idcontent'" ;
            $result_countread = $link->query($sql_countread);
        
            if($result_countread == '1'){
                echo "update counter read successful \n"; }
            else{
                echo "update counter read false ".mysqli_error($link)."\n" ;
            }
        
    }
    mysqli_close($link);
?>