<?php
    include '_dbconnect.php';

    if($_SERVER['REQUEST_METHOD'] == true){
        $loginEmail = $_POST['loginEmail'];
        $loginPassword = $_POST['loginPassword'];
        
        $sql = "SELECT * FROM `users` WHERE `user_email` = '$loginEmail'";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result);

        if($rows === 1){
            $row = mysqli_fetch_assoc($result);
            $id = $row['user_id'];
            $fname = $row['first_name'];
            if(password_verify($loginPassword, $row['user_password'])){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $fname;
                $_SESSION['useremail'] = $loginEmail;
                header("location: index.php?userid=$id");
            }
            else{
                echo 'Unable to login';
                header("location: index.php?userid=$id");
            }
            
        }else{
            echo 'Unable to login';
            header("location: index.php?userid=$id");
        }
    }
