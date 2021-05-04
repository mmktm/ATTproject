<?php 
    session_start();
    include('connect.php');

    $errors = array();

    if (isset($_POST['Login_Admin'])) {
        $Username = mysqli_real_escape_string($link, $_POST['Username']);
        $Password = mysqli_real_escape_string($link, $_POST['Password']);

        if (empty($Username)) {
            array_push($errors, "Username is required");
        }

        if (empty($Password)) {
            array_push($errors, "Password is required");
        }

        if (count($errors) == 0) {
            // $Password = md5($Password);
            $sql_login = "SELECT * FROM admin WHERE Username = '$Username' AND Passwordd = '$Password' ";
            $result_login = $link->query($sql_login);

            if (mysqli_num_rows($result_login) == 1) {
                $_SESSION['Username'] = $Username;
                $_SESSION['success'] = "Your are now logged in";
                header("location: index.php");
            } else {
                array_push($errors, "Wrong Username or Password");
                $_SESSION['error'] = "Wrong Username or Password!";
                header("location: login.php");
            }
        } else {
            array_push($errors, "Username & Password is required");
            $_SESSION['error'] = "Username & Password is required";
            header("location: login.php");
        }
    }

?>
