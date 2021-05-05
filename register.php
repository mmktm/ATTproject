<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type:application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud


    $Username = $_POST['Username'];
    $Passwordd = $_POST['Passwordd'];
    $Email = $_POST['Email'];
    $Status_User = 'Active';
    $Date_User = date("Y-m-d") ;
    $Time_User = date("H:i:s") ;

        // Variable to check
        // $Email = "john.doe@example.com";

        // Remove all illegal characters from email
        $Email = filter_var($Email, FILTER_SANITIZE_EMAIL);

        // Validate e-mail
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL) === false) {
            echo("$Email is a valid email address\n");
                
            $sql_checkregis = " SELECT * FROM `user` 
                                WHERE Username = '$Username' OR Email = '$Email'" ;

            $result_checkregis = $link->query($sql_checkregis);

            if($result_checkregis->num_rows == 1 ){
                echo json_encode("error : username or email already exists"); 
            }else{
                
                $sql_insertregis = "INSERT INTO user (Username, Passwordd , Email, Status_User,Date_User,Time_User)
                                    VALUES ('$Username','$Passwordd','$Email','$Status_User','$Date_User','$Time_User')" ; //.md5 เข้ารหัส

                    $result_insertregis = $link->query($sql_insertregis);
                    if($result_insertregis){
                        echo json_encode("success");
                    }
            }
        
        } else {
            echo("$Email is not a valid email address\n");
        }
    // $sql_checkregis = " SELECT * FROM `user` 
    //                     WHERE Username = '$Username' OR Email = '$Email'" ;
        
    //     $result_checkregis = $link->query($sql_checkregis);

    //         if($result_checkregis->num_rows == 1 ){
    //             echo json_encode("error"); 
    //         }else{
                
    //             $sql_insertregis = "INSERT INTO user (Username, Passwordd , Email, Status_User,Date_User,Time_User)
	// 			                    VALUES ('$Username','$Passwordd','$Email','$Status_User','$Date_User','$Time_User')" ; //.md5 เข้ารหัส

    //                 $result_insertregis = $link->query($sql_insertregis);
    //                 if($result_insertregis){
    //                     echo json_encode("success");
    //                 }
    // }

mysqli_close($link);

?>