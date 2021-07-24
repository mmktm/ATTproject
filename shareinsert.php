<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//code share *no unshare
//ต้องรับมา 2 ค่า ID_User ($_POST['iduser']) and ID_Content ($_POST['share'])

if(isset($_POST['share']) && $_POST['share'] != '' ){ //รับค่า idcontent ที่ต้องการจะ share

    $iduser = $_POST['iduser'] ; //iduser share
    $idcontentshare = $_POST['share'] ; //idcontent ที่จะ share
    $statusshare = 'shared';
    $Date_Share = date("Y-m-d") ;
    $Time_Share = date("H:i:s") ;

     //ดึงค่าtotalsave
     $sql_totalshare = "SELECT
                            ID_Content,
                            Total_Share 
                        FROM
                            content 
                        WHERE
                            ID_Content = '$idcontentshare' ";

                        $result_totalshare = $link->query($sql_totalshare);
                        $row_totalshare = $result_totalshare->fetch_assoc();
                        $totalshare = $row_totalshare['Total_Share'];


    $sql_share = " INSERT INTO share( ID_User, ID_Content, Status_Share,Date_Share ,Time_Share ) 
                    VALUES ('$iduser','$idcontentshare','$statusshare','$Date_Share','$Time_Share')" ;
        
        $result_share = $link->query($sql_share);

     //เพิ่มจำนวน totalshare in table content
     $sql_plustotalshare = " UPDATE content
                            SET Total_Share = '$totalshare'+1
                            WHERE ID_Content = '$idcontentshare' ";

        $result_plustotalshare = $link->query($sql_plustotalshare);

            if($result_share){
                echo "result_share is true \n"; }
            else{
                echo "result_share is false ".mysqli_error($link)."\n" ;
            }

        }

mysqli_close($link);

?>