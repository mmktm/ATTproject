<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
date_default_timezone_set('Asia/Bangkok');//timezone
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //กดปุ่ม Post รับค่า ID_User เข้ามา
    // if(isset($_POST['ID_Userpost']) && $_POST['ID_Userpost'] != '')
    if(isset($_POST['Title']) && $_POST['Title'] != '') 
    {
        
        $Date_Content = date("Y-m-d") ;
        $Time_Content = date("H:i:s") ;
        $Status_Content = 'Post'; //status
        $ID_Userpost = $_POST['ID_Userpost']; //iduser
        $Title = $_POST['Title']; //title
        $Content = $_POST['Content'];//content
        $Link_VDO = $_POST['Link_VDO'];//link vdo
        $Location = $_POST['Location'];//link map
        $ID_Category1 = $_POST['ID_Category1']; //category1
        $ID_Category2 = $_POST['ID_Category2'];//category2
        $ID_Category3 = $_POST['ID_Category3'];//category3\

        //input image
        $Images01 = $_FILES['Images01']['name'];     
        $tmp_name01 = $_FILES['Images01']['tmp_name'];
        $ImagePath01 = 'uploadimages/'.$Images01;
        move_uploaded_file($tmp_name01,$ImagePath01);

        //input content
        $sql_content = " INSERT INTO content
                          (Date_Content,Time_Content,Status_Content, Title, Content, Link_VDO, Location,Images01,Images02,Images03,Images04)
                         VALUES
                          ('$Date_Content','$Time_Content','$Status_Content', '$Title', '$Content', '$Link_VDO', '$Location','$Images01','$Images02','$Images03','$Images04' ) " ;

            $result_content = $link->query($sql_content);
                if($result_content){
                    echo "result_content is success \n"; }
                else{
                    echo "result_content is false ".mysqli_error($link)."\n" ;
                }
        
                }
    mysqli_close($link);
    ?>