<?php
    include "./components/config.php";

    error_reporting(0);

    session_start();

    
    if (isset($_SESSION['username'])){
        header("Location: index.php");
    }



    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $cpassword = md5($_POST['cpassword']);

        if($password == $cpassword){
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            if(!$result->num_rows  > 0){
                $sql = "INSERT INTO users (username, email, password) 
                VALUES('$username', '$email', '$password')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $username = "";
                    $email = "";
                    $_POST['password'] = "";
                    $_POST['cpassword'] = "";
                    header("Location: ./index.php");
                    exit();
                }else{
                echo "<script>alert('Server Error. Try again!')</script>";
                }
            }else{
                echo "<script>alert('Email already exists! Please Try something else.')</script>";
                }
        }else{
            echo "<script>alert('Password is not matched. Try again!')</script>";
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
        <form method="POST" class="login-email">
            <p class="login-text">
                Register
            </p>
            <!-- username -->
            <div class="input-group">
                <input type="text" placeholder="username" name="username" value="<?php echo $username;?>" required>
            </div>
            <!-- email -->
            <div class="input-group">
                <input type="email" placeholder="email" name="email" value="<?php echo $email;?>" required>
            </div>
            <!-- password -->
            <div class="input-group">
                <input type="password" placeholder="password" name="password" value="<?php echo $_POST['password'];;?>" required>
            </div>
            <!-- confirm password -->
            <div class="input-group">
                <input type="password" placeholder="confirm password" name="cpassword" value="<?php echo $_POST['cpassword'];?>" required>
            </div>
            <!-- Login -->
            <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Have an account? <a href="index.php">Login Here</a></p>
        </form>
    </div>
</body>
</html>