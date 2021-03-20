<meta charset="UTF-8">
<?php 
    header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
    header('Content-type: application/json'); //ใช้ข้อมูลแบบ json
    include 'connectlc.php'; //เชื่อมต่อDATABASE local

            if (isset($_POST)) {//echo "Welcome ";

                //<form action="uploadimages.php" method="post" enctype="multipart/form-data">

                // $uptocontent = $_POST['uptocontent']; //รับค่าเข้าบทความนี้
                $upimage1 = $_FILES['upimage1'];
                // $upimage2 = $_POST['upimage2'];
                // $upimage3 = $_POST['upimage3'];
                // $upimage4 = $_POST['upimage4'];
                // $upimage5 = $_POST['upimage5'];
                // $upimage6 = $_POST['upimage6'];
                // $upimage7 = $_POST['upimage7'];
                // $upimage8 = $_POST['upimage8'];
                // $upimage9 = $_POST['upimage9'];
                // $upimage10 = $_POST['upimage10'];

                // $path = "uploadimages/";

                move_uploaded_file($_FILES['uploadimages']['tmp_name'],"./uploadimages");  	
                $sql_upimages = "INSERT INTO content(Images01)
                                VALUES ('".$upimage1."') " ;

                // $sql_upimage = "INSERT INTO `content` (`Images01`, `Images02`, `Images03`, `Images04`, `Images05`, `Images06`, `Images07`, `Images08`,Images09,Images10)
                //                 VALUES ('$upimage1', '$upimage2' , '$upimage3', '$upimage4' , '$upimage5' , '$upimage6' , '$upimage7' , '$upimage8' , '$upimage9' , '$upimage10' )
                //                 WHERE ID_Content = '{$uptocontent}' " ;

                $result_upimages = mysqli_query($link,$sql_upimages) or die("Error in qurey: $sql_upimages".mysqli_error());
                
                    if ($result) {
                        echo "Upload File Succesfuly\n ";
                    
                    } else {
                        echo "false";
                    }
            }
    mysqli_close($link);
?>