<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//code showยอดfav ของcontent นั้นๆ
//รับค่า ID_Content ($_POST['ID_Content'])

if(isset($_POST['ID_Content']) && $_POST['ID_Content'] != '' ){
    header('Content-type: application/json');
    
    $idcontentfav = $_POST['ID_Content'] ;

    $sql_favshow = " SELECT COUNT(ID_User) AS fav 
                        FROM favorite 
                        WHERE ID_Content = '$idcontentfav' && Status_Fav = '1'" ;
        
        $result_favshow = $link->query($sql_favshow);
            if($result_favshow){
                $row_favshow = $result_favshow->fetch_assoc();
                $output_favshow[] = $row_favshow ;
                $j_favshow = json_encode($output_favshow);
                echo "$j_favshow\n" ;
            }else{
                echo "result_favshow is false ".mysqli_error($link)."\n" ;
            }       
}

mysqli_close($link);

?>