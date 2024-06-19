<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'login');

function acak($panjang)
{
    $karakter = '1234567890';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
        $pos = rand(0, strlen($karakter) - 1);
        $string .= $karakter[$pos]; // Replace curly braces with square brackets
    }
    return $string;
}

function register($dataRegister)
{
    global $db;

    $username = htmlspecialchars(stripcslashes($dataRegister['username']));
    $password = mysqli_real_escape_string($db, htmlspecialchars($dataRegister['password']));
    $passwordConfirm = mysqli_real_escape_string($db, htmlspecialchars($dataRegister['password_confirm']));

    $cekUser = mysqli_query($db, "SELECT username, password FROM users WHERE username = '$username' OR password = '$password'");

    // cek username dan email
    if (mysqli_num_rows($cekUser) > 0) {
        echo "
            <script>
                swal('Maaf','Username / email telah dipakai!','info');
            </script>
        ";
        return false;
    }

    // cek konfirmasi password
    if ($password != $passwordConfirm) {
        echo "
            <script>
                swal('Maaf', 'Password konfirmasi harus sama','info');
            </script>
        ";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $sukses = mysqli_query($db, "INSERT INTO users (username, password) VALUES ('$username', '$password')");

    if ($sukses > 0) {
        echo "
    <script>
        swal('Berhasil','Akun anda berhasil didaftarkan!','success');
    </script>
    ";
    } else {
        echo "
            <script>
            swal('Maaf',Akun anda gagal didaftarkan','warning');
            </script>
        ";
        return false;
    }

    return mysqli_affected_rows($db);
}

function login($dataLogin)
{
    global $db;

    $username = $dataLogin['username'];
    $password = $dataLogin['password'];

    $cekUser = mysqli_query($db, "SELECT * FROM users WHERE username = '$username' OR password = '$password'");

    if (mysqli_num_rows($cekUser) === 1) {
        $hasil = mysqli_fetch_assoc($cekUser);

        if (password_verify($password, $hasil["password"])) {
            if ($hasil['status'] == 'aktif') {

                if ($hasil['level'] == 'admin1') {
                    $_SESSION['user'] = $hasil['username'];
                    $_SESSION['role'] = 'admin1';
                    $_SESSION['login'] = true;
                    header('Location: dashboardadmin1.php');
                } elseif ($hasil['level'] == 'admin2') {
                    $_SESSION['user'] = $hasil['username'];
                    $_SESSION['role'] = 'admin2';
                    $_SESSION['login'] = true;
                    header('Location: dashboardadmin2.php');
                }elseif ($hasil['role'] == 'warga') {
                    $_SESSION['user'] = $hasil['username'];
                    $_SESSION['role'] = 'warga';
                    $_SESSION['login'] = true;
                    header('Location: dashboardwarga.php');
                }

                if (isset($_POST['rememberme'])) {
                    setcookie('login', $hasil['username'], time() + 3600);
                    setcookie('level', $hasil['role'], time() + 3600);
                    setcookie('id', $hasil['id'], time() + 3600);
                    setcookie('key', hash('sha256', $hasil['username']), time() + 3600);
                }
            } elseif ($hasil['status'] == 'tidak aktif') {
                echo "
                    <script>
                        swal('Maaf','Akun anda dinonaktifkan oleh admin!','info');
                    </script>
                ";
                return false;
            }
        } else {
            echo "
                <script>
                swal('Maaf','Username / password salah!','warning');
                </script>
            ";
            return false;
        }
    } else {
        echo "
            <script>
                swal('Maaf','Username / password salah!','warning');
            </script>
        ";
        return false;
    }

    return mysqli_affected_rows($db);
}

?>