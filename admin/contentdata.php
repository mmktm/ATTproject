<?php 
    session_start();
    include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Content Data</title>
    
    <style type = "text/css">
        body {
            /* background-image:url('bg.jpg') ; */
            background-color: #F6F4E6 ; 
            background-size: auto;
            font-family: "Ekkamai new" ; src :url(fonts/EkkamaiNew-Regular.ttf) ;
        }
    </style>

</head> 
<body>
    <center><div class="text1"><strong>- Content Data -</strong></center><br>
    <a href="index.php" ><div style='text-align:right ; color:red;' >Back</a></div>
        <?php
            $ctkeyword = null;
                if(isset($_POST["ctkeyword"])){
                    $ctkeyword = $_POST["ctkeyword"];
                }
        ?>
            <form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                <tr>
                <center><th>Keyword
                <input name="ctkeyword" type="text" id="ctkeyword" placeholder="title" value="<?php echo $ctkeyword;?>">
                <input type="submit" class="box2" value="Search"></th></center>
                </tr>
            </form>

        <?php
                $sql_Content = " SELECT
                                        `user`.ID_User,
                                        `user`.Username,
                                        post.Status_Post,
                                        content.ID_Content,
                                        content.Date_Content,
                                        content.Time_Content,
                                        content.Title,
                                        content.Content,
                                        content.Link_VDO,
                                        content.Location,
                                        content.Counter_Read,
                                        content.Images01,
                                        content.Images02,
                                        content.Images03,
                                        content.Images04,
                                        cate1.Category AS Cate1,
                                        cate2.Category AS Cate2,
                                        cate3.Category AS Cate3
                                    FROM
                                        content
                                        LEFT JOIN con_in_cate ON content.ID_Content = con_in_cate.ID_Content
                                        LEFT JOIN category cate1 ON con_in_cate.ID_Category1 = cate1.ID_Category
                                        LEFT JOIN category cate2 ON con_in_cate.ID_Category2 = cate2.ID_Category
                                        LEFT JOIN category cate3 ON con_in_cate.ID_Category3 = cate3.ID_Category
                                        RIGHT JOIN post ON content.ID_Content = post.ID_Content
                                        JOIN `user` ON post.ID_User = `user`.ID_User 
                                    WHERE
                                        post.Status_Post = 'Post' AND content.Title LIKE '%".$ctkeyword."%' " ;

                $result_Content = $link->query($sql_Content);
                    if($result_Content->num_rows <=0 ){
                        echo "<center>" ."No Content-Title : '$ctkeyword'"."</center>" ;
                    } else {
                        echo "<table border='1' align='center' width='80%'>";
                            //หัวข้อตาราง
                            echo "<tr align='center' bgcolor='#CCCCCC'>
                                    <th width='5%'>ID_Content</th>
                                    <th width='5%'>ID_User</th>
                                    <th width='10%'>Username</th>
                                    <th width='5%'>Status_Post</th>
                                    <th width='8%'>Date</th>
                                    <th width='8%'>Time</th>
                                    <th width='50%'>Title</th>
                                 </tr>";

                            
                                while ($row_Content = $result_Content->fetch_assoc()){

                                    $idcontent = $row_Content['ID_Content'];
                                    $iduser = $row_Content['ID_User'];
                                    $username = $row_Content['Username'];
                                    $statuspost = $row_Content['Status_Post'];
                                    $datect = $row_Content['Date_Content'];
                                    $timect = $row_Content['Time_Content'];
                                    $title = $row_Content['Title'];
                                    $content= $row_Content['Content'];
                                    $vdo = $row_Content['Link_VDO'];
                                    $location= $row_Content['Location'];
                                    $read = $row_Content['Counter_Read'];
                                    $images01 = $row_Content['Images01'];
                                    $images02 = $row_Content['Images02'];
                                    $images03 = $row_Content['Images03'];
                                    $images04 = $row_Content['Images04'];
                                    $cate1 = $row_Content['Cate1'];
                                    $cate2 = $row_Content['Cate2'];
                                    $cate3 = $row_Content['Cate3'];

        ?>                            
                                <tr>
                                    <td><?php echo $idcontent; ?></td>
                                    <td><?php echo $iduser; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td><?php echo $statuspost; ?></td>
                                    <td><?php echo $datect; ?></td>
                                    <td><?php echo $timect; ?></td>
                                    <td><?php echo $title; ?></td>
                                   
                                    
                                </tr>

                                <?php 
                                }}
                                echo "</table>";
                                mysqli_close($link);
                                ?>
                                    <!-- // echo "<tr>";
                                    // echo "<td>" .$row_User["ID_User"]       .  "</td> "; 
                                    // echo "<td>" .$row_User["Username"]      .  "</td> ";  
                                    // echo "<td>" .$row_User["Passwordd"]     .  "</td> ";
                                    // echo "<td>" .$row_User["Email"]         .  "</td> ";
                                    // echo "<td>" .$row_User["Image"]        .  "</td> ";
                                    // echo "<td>" .$row_User["Status_User"]   .  "</td> ";
                                    // echo "<td>" .$row_User["Date_User"]     .  "</td> ";
                                    // echo "<td>" .$row_User["Time_User"]     .  "</td> ";
                                    //แก้ไขข้อมูล
                                    // echo "<td><a href='UserUpdateForm.php?ID=$row[0]'>edit</a></td> ";
                                    
                                    //ลบข้อมูล
                                    // echo "<td><a href='UserDelete.php?ID=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\">del</a></td> ";
                    //                 echo "</tr>";
                    //             }
                    //         echo "</table>";
                    // }
                            //5. close connection
                            // mysqli_close($link);
        ?> -->
</body>
</html>
<!-- <th width='10%' height='10%'>Content</th>
                                    <th width='5%'>VDO</th>
                                    <th width='5%'>Location</th>
                                    <th width='5%'>Read</th>
                                    <th width='5%'>Images01</th>
                                    <th width='5%'>Images02</th>
                                    <th width='5%'>Images03</th>
                                    <th width='5%'>Images04</th>
                                    <th width='5%'>Category</th>
                                    <th width='5%'>Category</th>
                                    <th width='5%'>Category</th> -->

                                     <!-- <td><?php echo $content; ?></td>
                                    <td><?php echo $vdo; ?></td>
                                    <td><?php echo $location; ?></td>
                                    <td><?php echo $read; ?></td>
                                    <td><?php echo $images01; ?></td>
                                    <td><?php echo $images02; ?></td>
                                    <td><?php echo $images03; ?></td>
                                    <td><?php echo $images04; ?></td>
                                    <td><?php echo $cate1; ?></td>
                                    <td><?php echo $cate2; ?></td>
                                    <td><?php echo $cate3; ?></td> -->