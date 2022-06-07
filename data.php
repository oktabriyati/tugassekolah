<?php
$server   = 'localhost';
$username = 'root';
$password = '';
$database = 'sekolah';

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    die('Gagal terhubung: ' . mysqli_connect_error());
}
$no_id = "";
$nm_siswa = "";
$ttl = "";
$alamat = "";
$nm_ortu = "";
$sukses = "";
$error = "";

if(isset($_GET['op'])){
    $op = $_GET ['op'];
}else{
    $op = "";
}

if($op == 'delete'){
    $no_id      = $_GET['no_id'];
    $sql        = "delete from tbl_siswa where no_id = '$no_id'";
    $q1         = mysqli_query($conn,$sql);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $serror = "Gagal melakukan delete data";
    }
}

if($op == 'update'){
    $no_id    = $_GET['no_id'];
    $sql      = "select * from tbl_siswa where no_id = '$no_id'";
    $q1       = mysqli_query($conn,$sql);
    $r1       = mysqli_fetch_array($q1);
    $no_id    = $r1['no_id'];
    $nm_siswa = $r1['nm_siswa'];
    $ttl      = $r1['ttl'];
    $alamat   = $r1['alamat'];
    $nm_ortu  = $r1['nm_ortu'];

    if($no_id == ''){
        $error ="data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $no_id = $_POST['no_id'];
    $nm_siswa = $_POST['nm_siswa'];
    $ttl = $_POST['ttl'];
    $alamat = $_POST['alamat'];
    $nm_ortu = $_POST['nm_ortu'];

    if ($no_id && $nm_siswa && $ttl && $alamat && $nm_ortu) {
        if($op == 'update'){ // untuk update 
            $sql  = "update tbl_siswa set no_id = '$no_id',nm_siswa='$nm_siswa', ttl = '$ttl', alamat = '$alamat', nm_ortu  = '$nm_ortu' where no_id = '$no_id'";
            $q1  = mysqli_query($conn,$sql);
            if ($q1){
                $sukses = "data berhasil diupdate";
            }else{
                $error = "data gagal diupdate";
            }
        }else{ // untuk insert 
             $sql = "insert into tbl_siswa(no_id, nm_siswa, ttl, alamat, nm_ortu) values ('$no_id' , '$nm_siswa' , '$alamat', '$ttl', '$nm_ortu')";
        $q1 = mysqli_query($conn, $sql);
        if ($q1) {
            $sukses = "berhasil memasukkan data";
        } else {
            $error = "gagal memasukkan data";
        }
        }
       
    } else {
        $error = "Silahkan masukkan semua data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">Beranda</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="data.php">Data Murid</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tentang.html">Tentang Sekolah</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Create / Edit
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:3;url=data.php"); // 5detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:3;url=data.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="no_id" class="col-sm-2 col-form-label">No Id Siswa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_id" name="no_id" value="<?php echo $no_id ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama siswa" class="col-sm-2 col-form-label">Nama Siswa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nm_siswa" name="nm_siswa" value="<?php echo $nm_siswa ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ttl" class="col-sm-2 col-form-label">Tempat Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ttl" name="ttl" value="<?php echo $ttl ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama ortu" class="col-sm-2 col-form-label">Nama Ortu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama ortu" name="nm_ortu" value="<?php echo $nm_ortu ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary ">
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Siswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No Id Siswa </th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Tempat Tanggal Lahir</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Nama Ortu</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2   = "select * from tbl_siswa order by no_id desc";
                        $q2   = mysqli_query($conn, $sql2);
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $no_id = $r2['no_id'];
                            $nm_siswa = $r2['nm_siswa'];
                            $ttl = $r2['ttl'];
                            $alamat = $r2['alamat'];
                            $nm_ortu = $r2['nm_ortu'];

                        ?>
                            <tr>
                                <td scope="row"><?php echo $no_id ?></td>
                                <td scope="row"><?php echo $nm_siswa ?></td>
                                <td scope="row"><?php echo $ttl ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $nm_ortu ?></td>
                                <td scope="row">
                                <a href="data.php?op=update&no_id=<?php echo $no_id?>">
                                    <button type="button" class="btn btn-light">Update</button>
                                </a>
                                <a href="data.php?op=delete&no_id=<?php echo $no_id?>" onclick="return confirm('Yakin mau hapus data?')">
                                    <button type="button" class="btn btn-dark">Delete</button>
                                </a>
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
</body>

</html>