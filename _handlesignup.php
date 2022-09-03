<?php
$showAlert = false;
    include '_dbconnect.php';
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // fetching data from form
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $email =$_POST['email'];
        $password =$_POST['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // inserting data into database
        $sql = "INSERT INTO `users` (`first_name`, `last_name`, `user_email`, `user_password`, `date`) VALUES ('$firstName', '$lastName', '$email', '$hash', current_timestamp())";
        $result = mysqli_query($conn, $sql);

        // displays after successful sign in and redirect to homepage
        $showAlert = true;
        header("location: index.php?signupsuccess=true");
    }

?>