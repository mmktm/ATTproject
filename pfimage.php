<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud

$response = new stdClass;
$response->status = null ;
$response->message = null ;

$destination_dir = "avatar/";
$base_filename = basename($_FILES["file"]["name"]);
$target_file = $destination_dir.$base_filename;

if(!$_FILES["file"]["error"]){
    
    if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)){
        $response->status = true;
        $response->message = "File uploaded succcessfully";

    }else{
        $response->status = false;
        $response->message = "File uploaded failed";
        
    }
}else{
    $response->status = false;
    $response->message = "File uploaded failed";
}

echo json_encode($response);

mysqli_close($link);
?>