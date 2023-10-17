
<?php 
include_once("include/header.php"); 
include_once("include/inc-fungsi.php") ;
include_once("database/koneksi.php") ; 
?>
<?php

$nama       = "";
$username   = "";
$password   = "";
$level      = "";
$sukses     = "";
$error      = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = "";
}
if ($id != "") {
    $sql1                   = "select * from pengguna where id = '$id'";
    $q1                     = mysqli_query($koneksi, $sql1);
    $r1                     = mysqli_fetch_array($q1);
    $nama                   = $r1['nama'];
    $username               = $r1['username'];
    $password               = $r1['password'];
    $level                  = $r1['level'];
}
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1   = "delete from pengguna where id = '$id'";
    $q1     = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses     = "Berhasil hapus data";
    }
}

if($id == 'edit'){
    $id            = $_GET['id'];
    $sql1          = "SELECT * from pengguna where id = '$id'";
    $q1            = mysqli_query($koneksi,$sql1);
    $r1            = mysqli_fetch_array($q1);
    $nama          = $r1['nama'];
    $username      = $r1['username'];
    $password      = $r1['password'];
    

    if($nama == ''){
        $error = "Data tidak di temukan";
    }
}

if(isset($_POST['simpan'])){
        $nama                           = $_POST['nama'];
        $username                       = $_POST['username'];
        $password                       = $_POST['password'];
        $level                          = $_POST['level'];
    
        if ($nama == '' or $username == '' or $password  == '' or $level == '') {
            $error = "Silahkan masukan semua data ";
        }
    
        if ($nama != '') {
            $sql1   = "select nama from pengguna where nama = '$nama'";
            $q1     = mysqli_query($koneksi, $sql1);
            $n1     = mysqli_num_rows($q1);
            if ($n1 > 0) {
                $error = "Nama yang anda masukan sudar Terdaftar";
            }
        }
    
        if ($username != '') {
            $sql1   = "select username from pengguna where username = '$username'";
            $q1     = mysqli_query($koneksi, $sql1);
            $n1     = mysqli_num_rows($q1);
            if ($n1 > 0) {
                $error = "Username yang anda masukan sudar Terdaftar";
            }
    }
        if (strlen($password) < 6) {
            $error  = "Password hanya 6 karakter";
        }
    
        if (empty($error)) {
    
            if ($id != "") {
                $sql1   = "update pengguna set nama = '$nama',username='$username',password='$password',tgl_isi=now() where id = '$id'";
            } else {
                $sql1   = "insert into pengguna (nama,username,level,password) values ('$nama','$username','$level',md5($password))";
            }
    
            $sql1       = mysqli_query($koneksi, $sql1);
            if ($sql1) {
                $sukses     = "sukses memasukan data";
            } else {
                $error      = "gagal masukan data";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .mx-auto { width: 800px;}
        .card {margin-top: 10px;}
    </style>
</head>
<body>
    <div class="mx-auto">
         <!-- untuk memasukan data -->
         <div class="card">
                <div class="card-header">
                     Create / Edit Data
                </div>
              <div class="card-body">
                <?php
                if($error){
                    ?>
                    <div class="alert alert-danger" role="alert">
                           <?php echo $error ?>
                    </div>
                    <?php
                        header("refresh:3;url=pengguna.php");
                }
                ?>
                <?php
                if($sukses){
                    ?>
                    <div class="alert alert-success" role="alert">
                           <?php echo $sukses ?>
                    </div>
                    <?php
                        header("refresh:3;url=pengguna.php");
                }
                ?>
                    <form action="" method="POST">
                      <div class="mb-3 row">
                         <label for="nim" class="col-sm-2 col-form-label">Nama</label>
                         <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama"value="<?php echo $nama ?>">
                         </div>
                      </div>
                      <div class="mb-3 row">
                         <label for="nama" class="col-sm-2 col-form-label">Username</label>
                         <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username ?>">
                         </div>
                      </div>
                      <div class="mb-3 row">
                         <label for="alamat" class="col-sm-2 col-form-label">Password</label>
                         <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $password ?>">
                         </div>
                      </div>
                      <div class="mb-3 row">
                         <label for="level" class="col-sm-2 col-form-label">Level</label>
                         <div class="col-sm-10">
                            <select class="form-control" id="level" name="level">
                                <option value="">- Pilih Sebagai -</option>
                                <option value="siswa" <?php if ($level == "siswa") echo "selected"?>> siswa</option>
                                <option value="guru" <?php if ($level == "guru") echo "selected"?>> guru</option>
                            </select>
                         </div>
                      </div>
                      <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" onclick="return confirm('Yakin mau Simpan Data?')" class="btn btn-primary"/>
                      </div>
                    </form>
              </div>
         </div>

         <!-- untuk mengeluarkan data -->
         <div class="card-header text-white bg-secondary">
                     Data Mahasiswa 
                </div>
              <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">username</th>
                                <th scope="col">Level</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            <tbody>
                                <?php
                                $sql2   = "SELECT * from pengguna order by id desc";
                                $q2    = mysqli_query($koneksi,$sql2);
                                $urut   =1;
                                while($r2 = mysqli_fetch_array($q2)){
                                    $id          = $r2['id'];
                                    $nama        = $r2['nama'];
                                    $username    = $r2['username'];
                                    $level       = $r2['level'];
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $urut++?> </th>
                                        <td scope="row"><?php echo $nama ?> </td>
                                        <td scope="row"><?php echo $username ?> </td>
                                        <td scope="row"><?php echo $level ?> </td>
                                        <td scope="row">
                                            <a href="pengguna.php?op=edit&id=<?php echo $id?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                            <a href="pengguna.php?op=delete&id=<?php echo $id?>"><button type="button" class="btn btn-danger">Delete</button></a>
                                            
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </thead>
                    </table>
              </div>
         </div>
    </div>

    <?php include_once("include/footer.php"); ?>