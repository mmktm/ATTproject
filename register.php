<?php 
header("Content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type:application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    $Username = $_POST['Username'];
    $Passwordd = $_POST['Passwordd'];	
    $Email = $_POST['Email'];
    $Status_User = 'Active';

    $sql_checkregis = " SELECT * FROM `user` 
                        WHERE Username = '$Username' OR Email = '$Email'" ;
        
        $result_checkregis = $link->query($sql_checkregis);

            if($result_checkregis->num_rows == 1 ){
                echo json_encode("error"); 
            }else{
                
                $sql_insertregis = "INSERT INTO user (Username, Passwordd , Email, Status_User)
				                    VALUES ('$Username','$Passwordd','$Email','$Status_User')" ;

                    $result_insertregis = $link->query($sql_insertregis);
                    if($result_insertregis){
                        echo json_encode("success");
                    }
            }

mysqli_close($link);

?>