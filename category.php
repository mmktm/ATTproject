<?php 
header("content-type:text/javascript;charset=utf-8"); //ภาษาไทย
header('content-type: application/json'); //ใช้ข้อมูลแบบ json
include 'connect.php'; //เชื่อมต่อDATABASE cloud

    //กดปุ่ม home แสดงบทความทั้งหมด เรียงตามไอดีคอนเท้นล่าสุด
    if(isset($_GET['plus'])){

        $sql_allcate = " SELECT 
                                *
                            FROM
                                category " ;

            $result_allcate = $link->query($sql_allcate);
                if($result_allcate->num_rows <=0 ){
                    echo "error" ;
                } else {
                    while ($row_allcate = $result_allcate->fetch_assoc()){
                        $output_allcate[] = $row_allcate ;
                        $j_allcate = json_encode($output_allcate,JSON_NUMERIC_CHECK);
                    }
                    echo "$j_allcate\n" ;
                }

    }
    mysqli_close($link);

?>