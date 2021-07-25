<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

//show status fav

    //input iduser and idcontent 
    if(isset($_GET['iduser']) && $_GET['iduser'] != '') {
        
        $iduser = $_GET['iduser']; //iduser
        $idcontent = $_GET['idcontent']; //idcontent
        
            //Statusfav
                $sql_statusfav = " SELECT 
                                        favorite.ID_User,
                                        favorite.ID_Content,
                                        favorite.Status_Fav 
                                    
                                    FROM content LEFT JOIN favorite ON content.ID_Content = favorite.ID_Content
                                    WHERE content.ID_Content = $idcontent AND favorite.ID_User = $iduser
                                    ORDER BY favorite.ID_Favorite DESC LIMIT 1" ;
                
                    $result_statusfav = $link->query($sql_statusfav);
                    
                    if($result_statusfav->num_rows <=0 ){
                        echo json_encode("No Data in favorite");
                    } else {
                        while ($row_statusfav = $result_statusfav->fetch_assoc()){
                            $statusfav = $row_statusfav['Status_Fav'];
                                
                                if($statusfav == null){
                                    $statusfav = ' ' ;
                                    $row_statusfav['Status_Fav'] = $statusfav;
                                }
                            $output_statusfav[] = $row_statusfav ;
                            $j_statusfav = json_encode($output_statusfav,JSON_NUMERIC_CHECK);
                        }
                        echo "$j_statusfav\n" ;
                    }
            }
            mysqli_close($link);
?>