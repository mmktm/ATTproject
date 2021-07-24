<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud


//code insert comment
//ต้องรับมา 3 ค่า ID_User ($_POST['idusercom']), ID_Content ($_POST['com']) and textcom = $_POST['textcom']

//กดช่อง com รับค่า ID_Content ที่ต้องการมา
if(isset($_POST['com']) && $_POST['com'] != '' ){ //รับค่าตัวแปร com และ com ต้องไม่ใช่ค่าว่าง

    $idusercom = $_POST['idusercom'] ; //iduser ที่ comment
    $idcontentcom = $_POST['com'] ; //idcontent ที่ต้องการ comment
    $textcom = $_POST['textcom'] ;
    $statuscom = '1';
    $Date_Comment = date("Y-m-d") ;
    $Time_Comment = date("H:i:s") ;

    //ดึงค่าtotalcom
    $sql_totalcom = " SELECT
                        ID_Content,
                        Total_Com 
                      FROM
                        content
                      WHERE
                        ID_Content = '$idcontentcom' ";

                        $result_totalcom = $link->query($sql_totalcom);
                        $row_totalcom = $result_totalcom->fetch_assoc();
                        $totalcom = $row_totalcom['Total_Com'];

    $sql_com = " INSERT INTO `comment` (ID_User,ID_Content,Comment,Status_Comment,Date_Comment,Time_Comment)
                                VALUES ('$idusercom','$idcontentcom','$textcom','$statuscom','$Date_Comment','$Time_Comment')" ;
        
        $result_com = $link->query($sql_com);

    //เพิ่มจำนวน totalcom in table content
    $sql_plustotalcom = " UPDATE content
                          SET Total_Com = '$totalcom'+1
                          WHERE ID_Content = '$idcontentcom' ";
        $result_plustotalcom = $link->query($sql_plustotalcom);

        if($result_com && $result_plustotalcom){
            echo "result_com is true \n"; }
        else{
            echo "result_com is false ".mysqli_error($link)."\n" ;
            }

        }

mysqli_close($link);

?>