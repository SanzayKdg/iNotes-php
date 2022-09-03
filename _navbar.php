<?php
$showAlert = false;
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include '_loginModal.php'; ?> 
    <?php include '_signupModal.php'; ?>

    <?php
   
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $userid = $_GET['userid'];
        echo ' <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid">
            <a class="navbar-brand navbar-nav me-auto mb-2 mb-lg-0"" href="index.php?userid='.$userid.'">
            <p class="py-1 px-4 my-1 fs-3" style ="border:2px solid white; border-radius:80% 30% 80% 30% / 80% 30% 80% 30% ;">iNotes</p></a>';
        echo '<p class="text-light my-0 mx-4" style = "text-align:center;">Welcome, <br> ' . $_SESSION['username'] . '</p>
            <a href="_logout.php" class="btn btn-outline-light bg-danger">Log out</a>';
    } else {
        echo ' <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid">
            <a class="navbar-brand navbar-nav me-auto mb-2 mb-lg-0"" href="index.php?userid=NULL">
            <p class="py-1 px-4 my-1 fs-3" style ="border:2px solid white; border-radius:80% 30% 80% 30% / 80% 30% 80% 30% ;">iNotes</p></a>';
        echo '<div class="mx-2">
                        <button class="btn btn-outline-light bg-success mx-1" data-bs-toggle="modal"
                        data-bs-target="#loginModal">Login</button>
                    <button class="btn btn-outline-light bg-danger mx-1 " data-bs-toggle="modal"
                        data-bs-target="#signupModal">Register</button>
                </div>';
    }
    echo '</div>
        </div>
    </nav>';

    if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success!</strong> You can now login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
</body>

</html>