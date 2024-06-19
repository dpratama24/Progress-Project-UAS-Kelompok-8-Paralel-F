<?php

        include 'database.php';

        if(isset($_POST['register'])){

        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordconfirm = $_POST['password_confirm'];
        $role = $_POST['role'];

        $query = " SELECT * FROM users WHERE username = '$username' && password = '$password' ";

        $result = mysqli_query($db, $query);

        if(mysqli_num_rows($result) > 0){

            $error[] = 'user already exist!';

        }else{

            if($password != $passwordconfirm){
                $error[] = 'password not matched!';
            }else{
                $query = "INSERT INTO users (username, password, passsword_confirm, role) VALUES('$username','$password','$passwordconfirm','$role')";
                mysqli_query($db, $query);
                header('location:login.php');
            }
        }

        };


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ketua RW - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card o-hidden border-0 shadow-lg my-5" style="max-width: 800px; width: 100%;">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Registrasi Akun</h1>
                        </div>
                        <form method="POST" action="proses_registrasi.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="nama_warga" class="form-control form-control-user" id="exampleFirstName" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <input type="email" name="username" class="form-control form-control-user" id="exampleInputEmail" placeholder="Alamat Email" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="role" id="exampleFormControlSelect1">
                                    <option>-pilih role-</option>
                                    <option value="admin1">Admin 1</option>
                                    <option value="admin2">Admin 2</option>
                                    <option value="warga">Warga</option>
                                </select>
                                <small id="emailHelp" class="form-text text-muted">Pilih Role : Admin 1, Admin 2, Warga</small>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="password_confirm" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Ulangi Password" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block" name="register">
                                Register
                            </button>
                            <hr>
                        </form>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="login.php">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>
</html>
