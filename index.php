<?php
    include "./components/config.php";

    session_start();

    error_reporting(0);

    if (isset($_SESSION['username'])){
        header("Location: index.php");
    }
     
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if($result->num_rows > 0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            header("Location: welcome.php");
        }else{
            echo "<script>alert('Email or password is wrong')</script>";
        }
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
    <h1 class="pagetitle">Login System: PHP</h1>

    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text">
                Login
            </p>
            <!-- email -->
            <div class="input-group">
                <input type="email" placeholder="email" name="email" value="<?php echo $email;?>" required>
            </div>
            <!-- password -->
            <div class="input-group">
                <input type="password" placeholder="password" name="password" value="<?php echo $password;?>" required>
            </div>
            <!-- Login -->
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a></p>
        </form>
    </div>
</body>
</html>