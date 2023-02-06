<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$database   = "tugaskelompok3";

$koneksi    = mysqli_connect($host, $user, $pass, $database);
if(!$koneksi){
    die("Tidak bisa terkoneksi ke database");
}

$IdPengguna     = "";
$NamaPengguna   = "";
$Password       = "";
$NamaDepan      = "";
$NamaBelakang   = "";
$NoHp           = "";
$Alamat         = "";
$IdAkses        = "";
$error          = "";
$sukses         = "";

if(isset($_GET['op'])){
  $op = $_GET['op'];
}else{
  $op = "";
}

if($op == 'delete'){
  $IdPengguna    = $_GET['IdPengguna'];
  $sql1          =  "DELETE from Pengguna WHERE IdPengguna ='$IdPengguna'";
  $q1            = mysqli_query($koneksi,$sql1);
  if($q1){
    $sukses      = "Berhasil hapus data";
  }else{
    $error       = "Gagal melakukan delete data";
  }
}

if($op == 'edit'){
  $IdPengguna         = $_GET['IdPengguna'];
  $sql1               = "SELECT * FROM Pengguna WHERE IdPengguna = '$IdPengguna'";
  $q1                 = mysqli_query($koneksi,$sql1);
  $r1                 = mysqli_fetch_array($q1);
  $IdPengguna         = $r1['IdPengguna'];
  $NamaPengguna       = $r1['NamaPengguna'];
  $NamaDepan          = $r1['NamaDepan'];
  $NamaBelakang       = $r1['NamaBelakang'];
  $NoHp               = $r1['NoHp'];
  $Alamat             = $r1['Alamat'];
  $IdAkses            = $r1['IdAkses'];

  if($IdPengguna == ''){
    $error = "Data Tidak Ditemukan";
  }
}

if (isset($_POST['simpan'])){ //Create
  $idPengguna         = @$_POST['IdPengguna'];
  $NamaPengguna       = $_POST ['NamaPengguna'];
  $NamaDepan          = $_POST ['NamaDepan'];
  $NamaBelakang       = $_POST ['NamaBelakang'];
  $NoHp               = $_POST ['NoHp'];
  $Alamat             = $_POST ['Alamat'];
  $idAkses            = @$_POST['IdAkses'];


  if($IdPengguna && $NamaPengguna && $NamaDepan && $NamaBelakang && $NoHp && $Alamat && $IdAkses){
    if($op == 'edit'){ //UPDATE
      $sql1     = "UPDATE Pengguna SET IdPengguna ='$IdPengguna', NamaPengguna='$NamaPengguna', NamaDepan ='$NamaDepan', NamaBelakang='$NamaBelakang', NoHp='$NoHp', Alamat='$Alamat', IdAkses='$IdAkses' WHERE IdPengguna='$IdPengguna'";
      $q1       = mysqli_query($koneksi, $sql1);
      if($q1){
        $sukses       = "Data berhasil di Update";
      }else{
        $error        = "Data gagal di Update";
      }
    }else{ // insert
      $sql1     = "INSERT INTO Pengguna (IdPengguna ,NamaPengguna,NamaDepan,NamaBelakang,NoHp,Alamat,IdAkses) VALUES('$IdPengguna','$NamaPengguna','$NamaDepan','$NamaBelakang,'$NoHp','$Alamat','$IdAkses')";
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
        header("refresh:5;url=pengguna.php");//5 : detik
        }
        ?>
        <?php
        if($sukses){
          ?>
          <div class="alert alert-success" role="alert">
              <?php echo $sukses ?>
          </div>
        <?php
          header("refresh:5;url=pengguna.php");//5 : detik
        }
        ?>
        
        <form action="" method="POST">

      <!-- Id Pengguna-->
      <div class="mb-3 row">
       <label for="idPengguna" class="form-label">Id Pengguna</label>
        <div class="col-sm-10"> 
          <input type="int" class="form-control" id="idPengguna" name="IdPengguna" value="<?php echo $IdPengguna?>">
        </div>
      </div>

      <!-- Nama Pengguna-->
      <div class="mb-3 row">
        <label for="NamaPengguna" class="form-label">Nama Pengguna</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="NamaPengguna" name="NamaPengguna" value="<?php echo $NamaPengguna?>">
        </div>
      </div>

      <!-- Nama Depan--> 
      <div class="mb-3 row">
        <label for="NamaDepan" class="form-label">Nama Depan</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="NamaDepan" name="NamaDepan" value="<?php echo $NamaDepan?>">
        </div>
      </div>

      <!-- Nama Belakang--> 
      <div class="mb-3 row">
        <label for="NamaBelakang" class="form-label">Nama Belakang</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="NamaBelakang" name="NamaBelakang" value="<?php echo $NamaBelakang?>">
        </div>
      </div>

      <!-- NoHP --> 
      <div class="mb-3 row">
        <label for="NoHp" class="form-label">No HP</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="NoHp" name="NoHp" value="<?php echo $NoHp?>">
        </div>
      </div>

      <!-- Alamat -->
      <div class="mb-3 row">
       <label for="Alamat" class="form-label">Alamat</label>
       <div class="col-sm-10"> 
         <input type="text" class="form-control" id="Alamat" name="Alamat" value="<?php echo $Alamat?>">
        </div>
      </div>

      <!-- Id Akses -->
      <div class="mb-3 row">
       <label for="idAkses" class="form-label">Id Akses</label>
       <div class="col-sm-10"> 
       <select class="form-control" name="idAkses" id="idAkses">
            <option value="">- Pilih Id Akses -</option>
            <option value="1222000001" <?php if($IdAkses    == "1222000001") echo "selected"?>>1222000001</option>
            <option value="1223000002" <?php if($IdAkses    == "1223000002") echo "selected"?>>1223000002</option>
            <option value="1223000003" <?php if($IdAkses    == "1223000003") echo "selected"?>>1223000003</option>
            <option value="1223000004" <?php if($IdAkses    == "1223000004") echo "selected"?>>1223000004</option>
            <option value="1223000005" <?php if($IdAkses    == "1223000005") echo "selected"?>>1223000005</option>
            <option value="1223000006" <?php if($IdAkses    == "1223000006") echo "selected"?>>1223000006</option>
            <option value="1223000007" <?php if($IdAkses    == "1223000007") echo "selected"?>>1223000007</option>
            <option value="1223000008" <?php if($IdAkses    == "1223000008") echo "selected"?>>1223000008</option>
            <option value="1223000009" <?php if($IdAkses    == "1223000009") echo "selected"?>>1223000009</option>
            <option value="1223000010" <?php if($IdAkses    == "1223000010") echo "selected"?>>1223000010</option>
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
            <th scope="col">#</th>
            <th scope="col">Id Pengguna</th>
            <th scope="col">Nama Pengguna</th>
            <th scope="col">Nama Depan</th>
            <th scope="col">Nama Belakang</th>
            <th scope="col">No HP</th>
            <th scope="col">Alamat</th>
            <th scope="col">Id Akses</th>
            <th scope="col">Aksi</th>
          </tr>
      </thead>  
          <tbody>
            <?php
            $sql2   ="SELECT * from Pengguna order by IdPengguna desc";
            $q2     = mysqli_query($koneksi,$sql2);
            $urut   = 1;
            while($r2 = mysqli_fetch_array($q2)){
              
              $IdPengguna          = $r2['IdPengguna'];
              $NamaPengguna        = $r2['NamaPengguna'];
              $NamaDepan           = $r2['NamaDepan'];
              $NamaBelakang        = $r2['NamaBelakang'];
              $NoHp                = $r2['NoHp']; 
              $Alamat              = $r2['Alamat'];
              $IdAkses             = $r2['IdAkses'];
              
            ?>
              <tr>
                <th scope="row"><?php echo $urut++ ?></th>
                <td scope="row"><?php echo $IdPengguna ?></td>
                <td scope="row"><?php echo $NamaPengguna ?></td>
                <td scope="row"><?php echo $NamaDepan ?></td>
                <td scope="row"><?php echo $NamaBelakang ?></td>
                <td scope="row"><?php echo $NoHp ?></td>
                <td scope="row"><?php echo $Alamat ?></td>
                <td scope="row"><?php echo $IdAkses ?></td>
                <td scope="row">
                  <a href="pengguna.php?op=edit&IdPengguna=<?php echo $IdPengguna?>"><button type="button" class="btn btn-warning">Edit</button></a>
                  <a href="pengguna.php?op=delete&IdPengguna=<?php echo $IdPengguna?>" onclick="return confirm('Yakin mau delete data?')" ><button type="button" class="btn btn-danger">Delete</button></a>

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