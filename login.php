<?php
       include "database.php";
       session_start();
   
       $login_message = "";
   
       if (isset($_SESSION["login"])){
           $username = $_SESSION["username"];
           if ($username == "dikapratama397@gmail.com"){
            header("location: dashboardadmin1.php");
           } else if ($username == "dpratama397@gmail.com"){
            header("location: dashboardadmin2.php");
           }else if ($username == "karindawartanti@gmail.com"){
            header("location: dashboardwarga.php");
           }
           
       }
       
       if(isset($_POST['login'])){
           $username = $_POST['username'];
           $password = $_POST['password'];
           
           $sql = "SELECT * FROM users WHERE 
           username='$username' AND 
           password='$password'
           ";
   
           $result = $db->query($sql);
   
           if($result->num_rows > 0){
               $data = $result->fetch_assoc();
               $_SESSION["username"] = $data["username"];
               if($username === "dikapratama397@gmail.com"){
                header("location: dashboardadmin1.php");
               }else if($username === "dpratama397@gmail.com"){
                header("location: dashboardadmin2.php");
               }else if($username === "karindawartanti@gmail.com"){
                header("location: dashboardwarga.php");
               }
            //    $_SESSION["login"] = true;
   
           }else{
              $login_message = "Akun Tidak Ditemukan";
           }
       }

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel="stylesheet">
    <title>Website Sistem Informasi</title>
</head>
<body>
    <a href="index.php" class="btn">Back</a></button>
    <div class="wrapper">
        <h2>Welcome</h2>
        <i> <?= $login_message ?></i>
        <form action="login.php" method="POST">
            <div class="input-field">
                <input type="email" id="username" name="username" placeholder="Username" required>
                <i class="bx bxs-user"></i>
            </div>
            <div class="input-field">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="bx bxs-lock-alt"></i>
            </div>
            <a href="#" class="forgot">
                <p>Forgot password?</p>
            </a>
            <button type="submit" name="login">Login</button>
            <p>Don't have an account? <a href="register.php" class="sign-up">Sign up</a></p>
        </form>
    </div>
</body>
</html>