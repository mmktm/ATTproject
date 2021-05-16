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
    <title>Login Admin</title>
    
    <style type = "text/css">
        body {
            /* background-image:url('bg.jpg') ; */
            background-color: #414448 ;
            background-size: auto;
            font-family: "Ekkamai new" ; src :url(fonts/EkkamaiNew-Regular.ttf) ;
        }
    </style>

</head> 
<body>
    <div class="wrapper"> <!-- Register Admin -->
    <div class="boxlogin"><center><div class="text1"><strong>- Login Admin -</strong></center><br>

    <form action="login_db.php" method="post">
        <?php if (isset($_SESSION['error'])) : ?>
                <div class="error">
                    <h3>
                        <?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        ?>
                    </h3>
                </div>
            <?php endif ?>

        <div class = "input-group">
            <label for="Username">Username</label>
            <input type="text" name = "Username">
        </div>
        <div class = "input-group">
            <label for="Password">Password</label>
            <input type="password" name = "Password">
        </div>
        <div class = "input-group">
            <center><button type="submit" name = "Login_Admin" class ="sm">Login</button></center>
        </div>

        <center><p>Not yet an Admin ? <a href="register.php">Sing up</a></p></center>

    </form>
    
</body>
</html>