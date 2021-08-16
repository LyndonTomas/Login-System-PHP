<?php
    session_start();

    include "./components/config.php";

    if (!isset($_SESSION['username'])){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include "./components/head.php";
    ?>
</head>
<body>
    <?php
        include "./components/nav.php";
    ?>
    <h1 class="pagetitle">Home Page</h1>
    <?php 
        echo "Welcome " . $_SESSION['username'];
    ?>
</body>
</html>