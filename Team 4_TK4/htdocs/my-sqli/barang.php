<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$database   = "tugaskelompok3";

$koneksi    = mysqli_connect($host, $user, $pass, $database);
if(!$koneksi){
    die("Tidak bisa terkoneksi ke database");
}

$IdBarang     = "";
$NamaBarang   = "";
$Keterangan   = "";
$Satuan       = "";
$IdPengguna   = "";
$error        = "";
$sukses       = "";

if(isset($_GET['op'])){
  $op = $_GET['op'];
}else{
  $op = "";
}

if($op == 'delete'){
  $IdBarang      = $_GET['IdBarang'];
  $sql1          =  "DELETE from Barang WHERE IdBarang='$IdBarang'";
  $q1            = mysqli_query($koneksi,$sql1);
  if($q1){
    $sukses      = "Berhasil hapus data";
  }else{
    $error       = "Gagal melakukan delete data";
  }
}

if($op == 'edit'){
  $IdBarang      = $_GET['IdBarang'];
  $sql1          = "SELECT * FROM Barang WHERE IdBarang = '$IdBarang'";
  $q1            = mysqli_query($koneksi,$sql1);
  $r1            = mysqli_fetch_array($q1);
  $IdBarang      = $r1['IdBarang'];
  $NamaBarang    = $r1['NamaBarang'];
  $Keterangan    = $r1['Keterangan'];
  $Satuan        = $r1['Satuan'];
  $IdPengguna    = $r1['IdPengguna'];

  if($IdBarang == ''){
    $error = "Data Tidak Ditemukan";
  }
}

if (isset($_POST['simpan'])){ //Create
  $IdBarang      = $_POST['IdBarang'];
  $NamaBarang    = $_POST['NamaBarang'];
  $Keterangan    = $_POST['Keterangan'];
  $Satuan        = $_POST['Satuan'];
  $IdPengguna    = $_POST['IdPengguna'];


  if($IdBarang && $NamaBarang && $Keterangan && $Satuan && $IdPengguna){
    if($op == 'edit'){ //UPDATE
      $sql1     = "UPDATE barang SET IdBarang='$IdBarang', NamaBarang='$NamaBarang', Keterangan='$Keterangan', Satuan='$Satuan', IdPengguna='$IdPengguna' WHERE IdBarang='$IdBarang'";
      $q1       = mysqli_query($koneksi, $sql1);
      if($q1){
        $sukses       = "Data berhasil di Update";
      }else{
        $error        = "Data gagal di Update";
      }
    }else{ // insert
      $sql1     = "INSERT INTO Barang(IdBarang ,NamaBarang,Keterangan,Satuan,IdPengguna) VALUES('$IdBarang','$NamaBarang','$Keterangan','$Satuan','$IdPengguna')";
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
      .mx-auto {
        width:800px
      }
      .card { 
        margin-top: 10px;
      }
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
        header("refresh:5;url=barang.php");//5 : detik
        }
        ?>
        <?php
        if($sukses){
          ?>
          <div class="alert alert-success" role="alert">
              <?php echo $sukses ?>
          </div>
        <?php
          header("refresh:5;url=barang.php");//5 : detik
        }
        ?>
        
        <form action="" method="POST">

      <!-- Id Barang-->
      <div class="mb-3 row">
       <label for="idBarang" class="form-label">IdBarang</label>
        <div class="col-sm-10"> 
          <input type="int" class="form-control" id="idBarang" name="IdBarang" value="<?php echo $IdBarang?>">
        </div>
      </div>

      <!-- Nama Barang-->
      <div class="mb-3 row">
        <label for="NamaBarang" class="form-label">Nama Barang</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="NamaBarang" name="NamaBarang" value="<?php echo $NamaBarang?>">
        </div>
      </div>
      <!-- Keterangan-->
      <div class="mb-3 row">
       <label for="Keterangan" class="form-label">Keterangan</label>
       <div class="col-sm-10"> 
        <input type="text" class="form-control" id="Keterangan" name="Keterangan" value="<?php echo $Keterangan?>">
      </div>
      </div>
      <!-- Satuan-->
      <div class="mb-3 row">
       <label for="Satuan" class="form-label">Satuan</label>
       <div class="col-sm-10"> 
        <input type="text" class="form-control" id="Satuan" name="Satuan" value="<?php echo $Satuan?>">
      </div>
      </div>
      <!-- Id Pengguna-->
      <div class="mb-3 row">
       <label for="idPengguna" class="form-label">Id Pengguna</label>
        <div class="col-sm-10"> 
          <select class="form-control" name="IdPengguna" id="idPengguna">
            <option value="">- Pilih Id Pengguna -</option>
            <option value="1222000001" <?php if($IdPengguna == "1222000001") echo "selected"?>>1222000001</option>
            <option value="1223000002" <?php if($IdPengguna == "1223000002") echo "selected"?>>1223000002</option>
            <option value="1223000003" <?php if($IdPengguna == "1223000003") echo "selected"?>>1223000003</option>
            <option value="1223000004" <?php if($IdPengguna == "1223000003") echo "selected"?>>1223000004</option>
            <option value="1223000005" <?php if($IdPengguna == "1223000005") echo "selected"?>>1223000005</option>
            <option value="1223000006" <?php if($IdPengguna == "1223000006") echo "selected"?>>1223000006</option>
            <option value="1223000007" <?php if($IdPengguna == "1223000007") echo "selected"?>>1223000007</option>
            <option value="1223000008" <?php if($IdPengguna == "1223000008") echo "selected"?>>1223000008</option>
            <option value="1223000009" <?php if($IdPengguna == "1223000009") echo "selected"?>>1223000009</option>
            <option value="1223000010" <?php if($IdPengguna == "1223000010") echo "selected"?>>1223000010</option>
          </select>
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
        Database Output
      </div>
    <div class="card-body">
      
    <table class = "table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Id Barang</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Satuan</th>
            <th scope="col">Id Pengguna</th>
            <th scope="col">Aksi</th>
          </tr>
      </thead>  
          <tbody>
            <?php
            $sql2   ="SELECT * from Barang order by IdBarang desc";
            $q2     = mysqli_query($koneksi,$sql2);
            $urut   = 1;
            while($r2 = mysqli_fetch_array($q2)){
              
              $IdBarang       = $r2['IdBarang'];
              $NamaBarang     = $r2['NamaBarang'];
              $Keterangan     = $r2['Keterangan'];
              $Satuan         = $r2['Satuan'];
              $IdPengguna     = $r2['IdPengguna'];
              

            ?>
              <tr>
                <th scope="row"><?php echo $urut++ ?></th>
                <td scope="row"><?php echo $IdBarang ?></td>
                <td scope="row"><?php echo $NamaBarang ?></td>
                <td scope="row"><?php echo $Keterangan ?></td>
                <td scope="row"><?php echo $Satuan ?></td>
                <td scope="row"><?php echo $IdPengguna ?></td>
                <td scope="row">
                  <a href="barang.php?op=edit&IdBarang=<?php echo $IdBarang?>"><button type="button" class="btn btn-warning">Edit</button></a>
                  <a href="barang.php?op=delete&IdBarang=<?php echo $IdBarang?>" onclick="return confirm('Yakin mau delete data?')" ><button type="button" class="btn btn-danger">Delete</button></a>

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