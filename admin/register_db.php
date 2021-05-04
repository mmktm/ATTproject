<?php 
    session_start();
    include('connect.php');
    date_default_timezone_set('Asia/Bangkok');//timezone
    
    $errors = array();

    if (isset($_POST['Regis_Admin'])) {
        $Username = mysqli_real_escape_string($link, $_POST['Username']);
        $Email = mysqli_real_escape_string($link, $_POST['Email']);
        $Password_1 = mysqli_real_escape_string($link, $_POST['Password_1']);
        $Password_2 = mysqli_real_escape_string($link, $_POST['Password_2']);
        $Date_Admin = date("Y-m-d") ;
        $Time_Admin = date("H:i:s") ;


        if (empty($Username)) {
            array_push($errors, "Username is required");
            $_SESSION['error'] = "Username is required";
        }
        if (empty($Email)) {
            array_push($errors, "Email is required");
            $_SESSION['error'] = "Email is required";
        }
        if (empty($Password_1)) {
            array_push($errors, "Password is required");
            $_SESSION['error'] = "Password is required";
        }
        if ($Password_1 != $Password_2) {
            array_push($errors, "The two passwords do not match");
            $_SESSION['error'] = "The two passwords do not match";
        }

        $user_check_query = " SELECT * FROM admin WHERE Username = '$Username' OR Email = '$Email' LIMIT 1";
        $query_check = $link->query($user_check_query);
        $result_check = mysqli_fetch_assoc($query_check);

        if ($result_check) { // if user exists
            if ($result_check['Username'] === $Username) {
                array_push($errors, "Username already exists");
            }
            if ($result['Email'] === $Email) {
                array_push($errors, "Email already exists");
            }
        }

        if (count($errors) == 0) {
            // $password = md5($password_1);

            $sql_regis = " INSERT INTO admin (Username, Email, Passwordd , Date_Admin , Time_Admin) 
                                VALUES ('$Username', '$Email', '$Password_1', '$Date_Admin', '$Time_Admin')";
            $result_regis = $link->query($sql_regis);

            $_SESSION['Username'] = $Username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        } else {
            header("location: register.php");
        }
    }

?>
