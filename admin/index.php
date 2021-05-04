<?php 
    session_start();
    
    if(!isset($_SESSION['Username'])){
        $_SESSION['msg'] = "You must login first";
        header('location: login.php');
    }

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['Username']);
        header('location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Admin</title>
    
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
    <div class="homeheader">
        <h2>Home Page</h2>
    </div>

    <div class="homecontent">
        <!--  notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <h3>
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

        <!-- logged in user information -->
        <?php if(isset($_SESSION['Username'])) : ?>

            <p>Welcome <strong><?php echo $_SESSION['Username']; ?></strong></p>
            <p><center><a href="index.php?logout='1'" style="color: red;">Logout</a></center></p>
            <?php endif ?>
    </div>
    
</body>
</html>