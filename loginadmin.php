<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type:application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    $Email = $_POST['Email'];
    $Passwordd = $_POST['Passwordd'];

    $userdata = array();
    

    $sql_checkloginad = " SELECT * FROM `admin` 
                        WHERE Email = '$Email' AND Passwordd = '$Passwordd'" ;
        
        $result_checkloginad = $link->query($sql_checkloginad);
        $userdata = $result_checkloginad->fetch_assoc();

        
            if($result_checkloginad->num_rows == 1 ){

                echo json_encode("Login Success");
                // echo json_encode($userdata,JSON_NUMERIC_CHECK);
                // while ($row_checklogin = $result_checklogin->fetch_assoc()){
                //     $output_checklogin[] = $row_checklogin ;
                //     $j_checklogin = json_encode($output_checklogin);
                // }
                // echo "$j_checklogin\n" ;

            }else{
                echo json_encode("error");
                // echo "error ".mysqli_error($link)."\n" ;
            }

mysqli_close($link);

?>