<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//codeรับค่าการกด save
//ต้องรับมา 2 ค่า 
//ID_User ($_POST['idusersave']) and ID_Content ($_POST['save'])
//เก็บค่า ID_Content ไว้ในตัวแปร save

//รับค่า idcontent
if(isset($_POST['save']) && $_POST['save'] != '' ){ //รับตัวแปร save และ save ต้องไม่ใช่ค่าว่าง

    $idusersave = $_POST['idusersave'] ; //iduser save
    $idcontentsave = $_POST['save'] ; //idcontent ที่ต้องการจะ save
    $statussave = 'saved'; 
    $Date_save = date("Y-m-d") ;
    $Time_save = date("H:i:s") ;

    $sql_checksave = " SELECT ID_User,ID_Content,Status_Save 
                        FROM save
                        WHERE ID_User = '$idusersave' && ID_Content = '$idcontentsave' && Status_Save = 'saved'" ;
        
        $result_checksave = $link->query($sql_checksave);
        $row_checksave = $result_checksave->fetch_assoc();
        $checksave = $row_checksave['Status_Save'];

    //ดึงค่าtotalsave
    $sql_totalsave = "SELECT
                            ID_Content,
                            Total_Save 
                        FROM
                            content 
                        WHERE
                            ID_Content = '$idcontentsave' ";

                        $result_totalsave = $link->query($sql_totalsave);
                        $row_totalsave = $result_totalsave->fetch_assoc();
                        $totalsave = $row_totalsave['Total_Save'];

       
        if($checksave == 'saved' ){ //เคย save ไว้หรือยัง?
           
            //unsave
            $sql_unsave = " UPDATE save 
                            SET Status_Save = 'unsave' 
                            WHERE ID_User = '$idusersave' && ID_Content = '$idcontentsave'" ;
                $result_unsave = $link->query($sql_unsave);

            //ลบจำนวน totalsave in table content
            $sql_deltotalsave = " UPDATE content
                                  SET Total_Save = '$totalsave'-1
                                  WHERE ID_Content = '$idcontentsave' ";
                $result_deltotalsave = $link->query($sql_deltotalsave);

                if($result_unsave && $result_deltotalsave){
                    echo "result_unsave is true \n"; }
                else{
                    echo "result_unsave is false ".mysqli_error($link)."\n" ;
                }

        }else{

            //save
            $sql_save = " INSERT INTO save ( ID_User, ID_Content, Status_Save,Date_Save,Time_Save )
                        VALUES ('$idusersave','$idcontentsave','$statussave','$Date_save','$Time_save')" ; //เก็บค่าการกดfav

                $result_save = $link->query($sql_save);

            //เพิ่มจำนวน totalsave in table content
            $sql_plustotalsave = " UPDATE content
                                   SET Total_Save = '$totalsave'+1
                                   WHERE ID_Content = '$idcontentsave' ";

                $result_plustotalsave = $link->query($sql_plustotalsave);

            if($result_save && $result_plustotalsave ){
                echo "result_save is true \n"; }
            else{
                echo "result_save is false ".mysqli_error($link)."\n" ;
            }

        }
}

mysqli_close($link);

?>