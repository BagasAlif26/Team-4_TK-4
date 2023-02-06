<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "tugaskelompok3";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$idpelanggan         = "";
$nama_pelanggan      = "";
$nomor_HP            = "";
$alamat_pelanggan    = "";
$idpenjualan         = "";
$sukses              = "";
$error               = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $idpelanggan    = $_GET['idpelanggan'];
    $sql1           = "delete from pelanggan where idpelanggan = '$idpelanggan'";
    $q1             = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit'){
    $idpelanggan     = $_GET['idpelanggan'];
    $sql1   = "select * from pelanggan where idpelanggan = '$idpelanggan'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $nama_pelanggan     = $r1['nama_pelanggan'];
    $alamat_pelanggan   = $r1['alamat_pelanggan'];
    $nomor_HP           = $r1['nomor_HP'];
    $idpenjualan        = $r1['idpenjualan'];

    if($idpenjualan ==''){
        $error = "Data Tidak Ditemukan";
    }
}
   

if (isset($_POST['simpan'])) { //untuk create
    $nama_pelanggan     = $_POST['nama_pelanggan'];
    $nomor_HP           = $_POST['nomor_HP'];
    $alamat_pelanggan   = $_POST['alamat_pelanggan'];
    $idpenjualan        = $_POST['idpenjualan'];

    if ($nama_pelanggan && $nomor_HP  && $alamat_pelanggan && $idpenjualan) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update pelanggan set idpenjualan='$idpenjualan',nama_pelanggan='$nama_pelanggan',nomor_HP='$nomor_HP',alamat_pelanggan='$alamat_pelanggan' where idpelanggan ='$idpelanggan'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into pelanggan(nama_pelanggan,nomor_HP,alamat_pelanggan,idpenjualan) values ('$nama_pelanggan','$nomor_HP','$alamat_pelanggan','$idpenjualan')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:3;url=pelanggan.php"); // 3 detik redirect
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:3;url=pelanggan.php"); // 3 detik redirect
                }
                ?>
                <form action="" method="POST">
                <div class="mb-3 row">
                        <label for="idpelanggan" class="col-sm-2 col-form-label">idpel</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="idpelanggan" name="idpelanggan" value="<?php echo $idpelanggan?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_pelanggan" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo $nama_pelanggan?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nomor_HP" class="col-sm-2 col-form-label">nomor HP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nomor_HP" name="nomor_HP" value="<?php echo $nomor_HP?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat_pelanggan" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" value="<?php echo $alamat_pelanggan?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="idpenjualan" class="col-sm-2 col-form-label">idpenjualan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="idpenjualan" id="idpenjualan">
                            <option value="">- Pilih ID -</option>
                            <option value="66101" <?php if ($idpenjualan == "66101") echo "selected" ?>>66101</option>
                            <option value="66102" <?php if ($idpenjualan == "66102") echo "selected" ?>>66102</option>
                            <option value="66103" <?php if ($idpenjualan == "66103") echo "selected" ?>>66103</option>
                            <option value="66104" <?php if ($idpenjualan == "66104") echo "selected" ?>>66104</option>
                            <option value="66105" <?php if ($idpenjualan == "66105") echo "selected" ?>>66105</option>
                            <option value="66106" <?php if ($idpenjualan == "66106") echo "selected" ?>>66106</option>
                            <option value="66107" <?php if ($idpenjualan == "66107") echo "selected" ?>>66107</option>
                            <option value="66108" <?php if ($idpenjualan == "66108") echo "selected" ?>>66108</option>
                            <option value="66109" <?php if ($idpenjualan == "66109") echo "selected" ?>>66109</option>
                            <option value="66111" <?php if ($idpenjualan == "66111") echo "selected" ?>>66110</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Pelanggan
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">IDPEL</th>                       
                            <th scope="col">NAMA</th>
                            <th scope="col">NoHP</th>
                            <th scope="col">ALAMAT</th>
                            <th scope="col">IDPENJUALAN</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from pelanggan order by idpelanggan desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $idpelanggan        = $r2['idpelanggan'];
                            $nama_pelanggan     = $r2['nama_pelanggan'];
                            $nomor_HP           = $r2['nomor_HP'];
                            $alamat_pelanggan   = $r2['alamat_pelanggan'];
                            $idpenjualan        = $r2['idpenjualan'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $idpelanggan ?></td>
                                <td scope="row"><?php echo $nama_pelanggan ?></td>
                                <td scope="row"><?php echo $nomor_HP ?></td>
                                <td scope="row"><?php echo $alamat_pelanggan ?></td>
                                <td scope="row"><?php echo $idpenjualan ?></td>
                                <td scope="row">
                                    <a href="pelanggan.php?op=edit&idpelanggan=<?php echo $idpelanggan ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="pelanggan.php?op=delete&idpelanggan=<?php echo $idpelanggan?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
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
