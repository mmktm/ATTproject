<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//show status save

    //input iduser and idcontent 
    if(isset($_GET['iduser']) && $_GET['iduser'] != '') {
        
        $iduser = $_GET['iduser']; //iduser
        $idcontent = $_GET['idcontent']; //idcontent
        
            //Statussave
                $sql_statussave = " SELECT 
                                        save.ID_User,
                                        save.ID_Content,
                                        save.Status_Save 
                                    FROM content LEFT JOIN save ON content.ID_Content = save.ID_Content
			                        WHERE content.ID_Content = $idcontent AND save.ID_User = $iduser
			                        ORDER BY save.ID_Save DESC LIMIT 1" ;
                
                    $result_statussave = $link->query($sql_statussave);
                    
                    if($result_statussave->num_rows <=0 ){
                        echo json_encode("No Data in save");
                    } else {
                        while ($row_statussave = $result_statussave->fetch_assoc()){
                            $statussave = $row_statussave['Status_Save'];
                                
                                if($statussave == null){
                                    $statussave = ' ' ;
                                    $row_statussave['Status_Save'] = $statussave;
                                }
                            $output_statussave[] = $row_statussave ;
                            $j_statussave = json_encode($output_statussave,JSON_NUMERIC_CHECK);
                        }
                        echo "$j_statussave\n" ;
                    }
            }
            mysqli_close($link);
?>