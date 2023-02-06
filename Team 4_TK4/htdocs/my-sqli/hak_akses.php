<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$database   = "tugaskelompok3";

$koneksi    = mysqli_connect($host, $user, $pass, $database);
if(!$koneksi){
    die("Tidak bisa terkoneksi ke database");
}


$idakses    = "";
$namaAkses   = "";
$keterangan   = "";
$error        = "";
$sukses       = "";

if(isset($_GET['op'])){
  $op = $_GET['op'];
}else{
  $op = "";
}

if($op == 'delete'){
  $idakses     = $_GET['IdAkses'];
  $sql1          = "DELETE from hakakses WHERE IdAkses = '$idakses'";
  $q1            = mysqli_query($koneksi,$sql1);
  if($q1){
    $sukses      = "Berhasil hapus data";
  }else{
    $error       = "Gagal melakukan delete";
  }
}

if($op == 'edit'){
  $idakses     = $_GET['IdAkses'];
  $sql1          = "SELECT * FROM hakakses WHERE IdAkses = '$idakses'";
  $q1            = mysqli_query($koneksi,$sql1);
  $r1            = mysqli_fetch_array($q1);
  $idakses     = $r1['IdAkses'];
  $namaAkses    = $r1['NamaAkses'];
  $keterangan    = $r1['Keterangan'];

  if($idakses== ''){
    $error = "Data Tidak Ditemukan";
  }
}

if (isset($_POST['simpan'])){ //Create
  $idakses     = $_POST['IdAkses'];
  $namaAkses    = $_POST['NamaAkses'];
  $keterangan    = $_POST['Keterangan'];


  if($idakses&& $namaAkses && $keterangan){
    if($op == 'edit'){ //UPDATE
      $sql1     = "UPDATE hakakses SET IdAkses= '$idakses', NamaAkses='$namaAkses', keterangan='$keterangan' WHERE IdAkses= '$idakses'";
      $q1       = mysqli_query($koneksi, $sql1);
      if($q1){
        $sukses       = "Data berhasil di Update";
      }else{
        $error        = "Data gagal di Update";
      }
    }else if ($op == 'insert'){ // insert
      $sql1     = "INSERT INTO hakakses(idakses, NamaAkses, Keterangan) VALUES('$idakses','$namaAkses','$keterangan')";
      $q1       = mysqli_query($koneksi, $sql1);
      if($q1){
          $sukses     = "Behasil memasukan data baru";
      }else{
          $error      = "Anda kurang beruntung";
      }
    } 
  }else{
          $error     = "Silahkan masukan semua data";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEAM 4 Tugas Kelompok 3 </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
      .mx-auto {width:800px}
      .card { margin-top: 10px;}
    </style>
</head>

<body>
    <div class="mx-auto">

     <!-- input data-->
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
        }
        ?>
        <?php
        if($sukses){
          ?>
          <div class="alert alert-success" role="alert">
              <?php echo $sukses ?>
          </div>
        <?php
        }
        ?>
        
        <form action="" method="POST">

      <!-- Id Barang-->
      <div class="mb-3 row">
       <label for="idBarang" class="form-label">Id Akses</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="idAkses" name="IdAkses" value="<?php echo $idakses?>">
        </div>
      </div>

      <!-- Nama Barang-->
      <div class="mb-3 row">
        <label for="NamaAkses" class="form-label">Nama Akses</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="NamaAkses" name="NamaAkses" value="<?php echo $namaAkses?>">
        </div>
      </div>
      <!-- Keterangan-->
      <div class="mb-3 row">
       <label for="Keterangan" class="form-label">Keterangan</label>
       <div class="col-sm-10"> 
        <input type="text" class="form-control" id="Keterangan" name="Keterangan" value="<?php echo $keterangan?>">
      </div>
      </div>
    <div class= "col-12">
      <input type= "submit" name="simpan" value="Simpan Data" class="btn btn-primary">
    </div>

    </form>
      </div>
    </div>

 <!-- output data -->
    <div class="card"> 
      <div class="card-header">
        List Hak Akses 
      </div>
    <div class="card-body">
    <div class="create" style="text-align: right">
        <a href="hak_akses.php?op=insert"><button type="button" class="btn btn-secondary">Tambah Data</button></a>
    </div>
    <table class = "table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Id Akses</th>
            <th scope="col">Nama Akses</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
          </tr>
      </thead>  
          <tbody>
            <?php
            $sql2   ="SELECT * from hakakses order by IdAkses desc";
            $q2     = mysqli_query($koneksi,$sql2);
            $urut   = 1;
            while($r2 = mysqli_fetch_array($q2)){
              
              $idakses      = $r2['IdAkses'];
              $namaAkses     = $r2['NamaAkses'];
              $keterangan     = $r2['Keterangan'];
              

            ?>
              <tr>
                <th scope="row"><?php echo $urut++ ?></th>
                <td scope="row"><?php echo $idakses?></td>
                <td scope="row"><?php echo $namaAkses ?></td>
                <td scope="row"><?php echo $keterangan ?></td>
                <td scope="row">
                  <a href="hak_akses.php?op=edit&IdAkses=<?php echo $idakses?>"><button type="button" class="btn btn-warning">Edit</button></a>
                  <a href="hak_akses.php?op=delete&IdAkses=<?php echo $idakses?>" onclick="return confirm('Yakin mau delete data?')" ><button type="button" class="btn btn-danger">Delete</button></a>

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