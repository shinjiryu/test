<?php
session_start();
include_once("koneksi.php");
include_once("include/inc-fungsi.php");
?>
<?php
include_once("koneksi.php");
?>
<?php
    if(isset($_POST['submit'])){
        $user = mysqli_real_escape_string($koneksi, $_POST['user']);
        $pass = mysqli_real_escape_string($koneksi, $_POST['pass']);

    $cek = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE username ='".$user."' ");
    if (mysqli_num_rows($cek) > 0){
        
        $d = mysqli_fetch_object($cek);
        if(md5($pass) == $d->password){
            
            
            $status_login = $_SESSION ['status_login'] = true;
            $uid = $_SESSION['uid']         =$d->id;
            $unama = $_SESSION['unama']     =$d->nama;
            $ulevel = $_SESSION['ulevel']     =$d->level;
        
            echo "<script>window.location = 'pengguna.php'</script>";

        } else{
            echo '<div class="alert alert-error">(password salah) </div>';

        }
    }else{
        echo '<div class="alert alert-error">(username tidak ditemukan) </div>';
         }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="image/favicon/download.png"/>
    <link rel="stylesheet" href="asset/css/css.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
          <form action="" method="post">
              <label>Username</label><br>
              <input type="text" class="from" name="user" placeholder="username" class="input-control" required><br>        
              <label>Password</label><br>
               <input type="password" class="from" name="pass" placeholder="password" class="input-control" required><br>
             <label for="" class="submit">
                <input type="submit" name="submit">
              </label><br>
              <p align="center">
              <a href="index.php" class="kembali">Kembali?</a></p>
          </form>
      </div>
</body>
</html>