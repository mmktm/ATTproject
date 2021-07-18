<?php 

//มีปัญหาตรงยิงบนlocalแล้วerror

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud

$response = new stdClass;
$response->status = null ;
$response->message = null ;

if(isset($_POST['ID_User']) && $_POST['ID_User'] != '') {
        
    $ID_User = $_POST['ID_User']; //iduser

    $destination_dir = "avatar/";
    $base_filename = basename($_FILES["file"]["name"]);
    $target_file = $destination_dir.$base_filename;

    if(!$_FILES["file"]["error"]){
        $moveFile = move_uploaded_file($_FILES["file"]["tmp_name"],$target_file);
        if($moveFile){
            $response->status = true;
            $response->message = "File uploaded succcessfully";

                //Profile edit (update)
                $sql_pfedit = " UPDATE user SET Image = '$base_filename' 
                                WHERE ID_User = '$ID_User' && Status_User = 'Active' " ;

                    $result_pfedit = $link->query($sql_pfedit);

                    if($result_pfedit){
                        echo "result_pfedit is true \n"; }
                    else{
                        echo "result_pfedit is false (Status-user) ".mysqli_error($link)."\n" ;
                    }
        }else{
            $response->status = false;
            $response->message = "File uploaded failed".$target_file ;
            
        }
    }
    else{
        $response->status = false;
        $response->message = $_FILES["file"]["error"];
    }
}

echo json_encode($response);

mysqli_close($link);
?>