<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "baru nih";

$koneksi    = mysqli_connect("localhost", "root", "", "baru nih", 3307);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
    
}
$nickname   = "";
$email      = "";
$password   = "";
$diamond    = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from mahasiswa where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from mahasiswa where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nickname   = $r1['nickname'];
    $email      = $r1['email'];
    $password   = $r1['password'];
    $diamond    = $r1['diamond'];

    if ($nickname == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nickname   = $_POST['nickname'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $diamond    = $_POST['diamond'];

    if ($nickname && $email && $password && $diamond) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update mahasiswa set nickname = '$nickname',emaill='$email',password ='$password',diamond='$diamond' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into mahasiswa(nickname,email,password,diamond) values ('$nickname','$email','$password','$diamond')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "sedang diproses..";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "isi form dibawah terlebih dahulu";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Diamond ML 2023</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }
       
        html {
            background-image:url("bg ml.jpg");
            background-size:cover;
            background-repeat:no-repeat;
            background-position:center;
            height:100%;
            width:100%;
            display:table-cell;
            vertical-align:middle;
        }    

        body {
            overflow-x:hidden;
            height:100vh;
            background-attachment:fixed;
            background-image:url("bg ml.jpg");
            background-position:center;
            background-repeat:no-repeat;
            background-size:cover;
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
            <div class="card-header text-white bg-secondary">
                Free Diamond Mobile Legends
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nickname" class="col-sm-2 col-form-label">Nickname</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo $nickname ?>" autofocus required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" placeholder="Alamat E-mail"
                            input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="password" name="password" value="<?php echo $password ?>" minlength=8>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="diamond" class="col-sm-2 col-form-label">Diamond</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="diamond" id="diamond">
                                <option value="">- Pilih Diamond -</option>
                                <option value="500 diamond" <?php if ($diamond == "500 diamond") echo "selected" ?>>500 diamond</option>
                                <option value="1000 diamond" <?php if ($diamond == "1000 diamond") echo "selected" ?>>1000 diamond</option>
                                <option value="3000 diamond" <?php if ($diamond == "3000 diamond") echo "selected" ?>>3000 diamond</option>
                                <option value="5000 diamond" <?php if ($diamond == "5000 diamond") echo "selected" ?>>5000 diamond</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Claim diamond" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                sedang diproses...
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NICKNAME</th>
                            <th scope="col">DIAMOND</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">PASSWORD</th>
                            <th scope="col">UBAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from mahasiswa order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id        = $r2['id'];
                            $nickname  = $r2['nickname'];
                            $email     = $r2['email'];
                            $password  = $r2['password'];
                            $diamond   = $r2['diamond'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++?></th>
                                <td scope="row"><?php echo $nickname?></td>
                                <td scope="row"><?php echo $email?></td>
                                <td scope="row"><?php echo $password?></td>
                                <td scope="row"><?php echo $diamond?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</body>

</html>
