<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$database   = "tugaskelompok3";

$koneksi    = mysqli_connect($host, $user, $pass, $database);
if(!$koneksi){
    die("Tidak bisa terkoneksi ke database");
}

$IdPembelian     = "";
$JumlahPembelian = "";
$HargaBeli       = "";
$IdPengguna      = "";
$idBarang        = "";
$error           = "";
$sukses          = "";

if(isset($_GET['op'])){
  $op = $_GET['op'];
}else{
  $op = "";
}

if($op == 'delete'){
  $idPembelian    = $_GET['IdPembelian'];
  $sql1          =  "DELETE from Pembelian WHERE IdPembelian ='$IdPembelian'";
  $q1            = mysqli_query($koneksi,$sql1);
  if($q1){
    $sukses      = "Berhasil hapus data";
  }else{
    $error       = "Gagal melakukan delete data";
  }
}

if($op == 'edit'){
  $IdPembelian        = $_GET['IdPembelian'];
  $sql1               = "SELECT * FROM Pembelian WHERE IdPembelian = '$IdPembelian'";
  $q1                 = mysqli_query($koneksi,$sql1);
  $r1                 = mysqli_fetch_array($q1);
  $IdPembelian        = $r1['IdPembelian'];
  $JumlahPembelian    = $r1['JumlahPembelian'];
  $HargaBeli          = $r1['HargaBeli'];
  $IdPengguna         = $r1['IdPengguna'];
  $IdBarang           = $r1['IdBarang'];

  if($IdPembelian == ''){
    $error = "Data Tidak Ditemukan";
  }
}

if (isset($_POST['simpan'])){ //Create
    $idPembelian     = @$_POST['IdPembelian'];
    $JumlahPembelian = $_POST['JumlahPembelian'];
    $HargaBeli       = $_POST['HargaBeli'];
    $idPengguna      = @$_POST['IdPengguna'];
    $idBarang        = @$_POST['IdBarang'];


  if($IdPembelian && $JumlahPembelian && $HargaBeli && $IdPengguna && $IdBarang){
    if($op == 'edit'){ //UPDATE
      $sql1     = "UPDATE Pembelian SET IdPembelian ='$IdPembelian', JumlahPembelian='$JumlahPembelian', HargaBeli ='$HargaBeli', IdPengguna='$IdPengguna', IdBarang='$IdBarang' WHERE IdPembelian='$IdPembelian'";
      $q1       = mysqli_query($koneksi, $sql1);
      if($q1){
        $sukses       = "Data berhasil di Update";
      }else{
        $error        = "Data gagal di Update";
      }
    }else{ // insert
      $sql1     = "INSERT INTO Pembelian (IdPembelian ,JumlahPembelian,HargaBeli,IdPengguna,IdBarang) VALUES('$IdPembelian,$JumlahPembelian,$HargaBeli,$IdPengguna,$IdBarang')";
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
        //header("refresh:5;url=Pembelian.php");//5 : detik
        }
        ?>
        <?php
        if($sukses){
          ?>
          <div class="alert alert-success" role="alert">
              <?php echo $sukses ?>
          </div>
        <?php
          //header("refresh:5;url=Pembelian.php");//5 : detik
        }
        ?>
        
        <form action="" method="POST">

      <!-- Id Pembelian -->
      <div class="mb-3 row">
       <label for="idPembelian" class="form-label">Id Pembelian</label>
        <div class="col-sm-10"> 
          <input type="int" class="form-control" id="idPembelian" name="idPembelian" value="<?php echo $IdPembelian?>">
        </div>
      </div>

      <!-- Jumlah Pembelian -->
      <div class="mb-3 row">
        <label for="JumlahPembelian" class="form-label">Jumlah Pembelian</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="JumlahPembelian" name="JumlahPembelian" value="<?php echo $JumlahPembelian?>">
        </div>
      </div>

      <!-- Harga Beli --> 
      <div class="mb-3 row">
        <label for="HargaBeli" class="form-label">Harga Beli</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="HargaBeli" name="HargaBeli" value="<?php echo $HargaBeli?>">
        </div>
      </div>

      <!-- Id Pengguna -->
      <div class="mb-3 row">
       <label for="idPengguna" class="form-label">Id Pengguna</label>
       <div class="col-sm-10"> 
       <select class="form-control" name="idPengguna" id="idPengguna">
            <option value="">- Pilih Id Akses -</option>
            <option value="1222000001" <?php if($IdPengguna    == "1222000001") echo "selected"?>>1222000001</option>
            <option value="1223000002" <?php if($IdPengguna    == "1223000002") echo "selected"?>>1223000002</option>
            <option value="1223000003" <?php if($IdPengguna    == "1223000003") echo "selected"?>>1223000003</option>
            <option value="1223000004" <?php if($IdPengguna    == "1223000004") echo "selected"?>>1223000004</option>
            <option value="1223000005" <?php if($IdPengguna    == "1223000005") echo "selected"?>>1223000005</option>
            <option value="1223000006" <?php if($IdPengguna    == "1223000006") echo "selected"?>>1223000006</option>
            <option value="1223000007" <?php if($IdPengguna    == "1223000007") echo "selected"?>>1223000007</option>
            <option value="1223000008" <?php if($IdPengguna    == "1223000008") echo "selected"?>>1223000008</option>
            <option value="1223000009" <?php if($IdPengguna    == "1223000009") echo "selected"?>>1223000009</option>
            <option value="1223000010" <?php if($IdPengguna    == "1223000010") echo "selected"?>>1223000010</option>
          </select>
        </div>
      </div>
      <!-- Id Barang-->
      <div class="mb-3 row">
       <label for="idBarang" class="form-label">Id Barang</label>
        <div class="col-sm-10"> 
          <select class="form-control" name="idBarang" id="idBarang">
            <option value="">- Pilih Id Barang -</option>
            <option value="44501" <?php if($IdBarang == "44501") echo "selected"?>>44501</option>
            <option value="44502" <?php if($IdBarang == "44502") echo "selected"?>>44502</option>
            <option value="44503" <?php if($IdBarang == "44503") echo "selected"?>>44503</option>
            <option value="44504" <?php if($IdBarang == "44504") echo "selected"?>>44504</option>
            <option value="44505" <?php if($IdBarang == "44505") echo "selected"?>>44505</option>
            <option value="44506" <?php if($IdBarang == "44506") echo "selected"?>>44506</option>
            <option value="44507" <?php if($IdBarang == "44507") echo "selected"?>>44507</option>
            <option value="44508" <?php if($IdBarang == "44508") echo "selected"?>>44508</option>
            <option value="44509" <?php if($IdBarang == "44509") echo "selected"?>>44509</option>
            <option value="44510" <?php if($IdBarang == "44510") echo "selected"?>>44510</option>
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
            <th scope="col">Id Pembelian</th>
            <th scope="col">Jumlah Pembelian</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Id Pengguna</th>
            <th scope="col">Id Barang</th>
            <th scope="col">Aksi</th>
          </tr>
      </thead>  
          <tbody>
            <?php
            $sql2   ="SELECT * from Pembelian order by IdPembelian desc";
            $q2     = mysqli_query($koneksi,$sql2);
            $urut   = 1;
            while($r2 = mysqli_fetch_array($q2)){
              
                $IdPembelian     = $r2['IdPembelian'];
                $JumlahPembelian = $r2['JumlahPembelian'];
                $HargaBeli       = $r2['HargaBeli'];
                $IdPengguna      = $r2['IdPengguna'];
                $IdBarang        = $r2['IdBarang'];
              
            ?>
              <tr>
                <th scope="row"><?php echo $urut++ ?></th>
                <td scope="row"><?php echo $IdPembelian ?></td>
                <td scope="row"><?php echo $JumlahPembelian ?></td>
                <td scope="row"><?php echo $HargaBeli ?></td>
                <td scope="row"><?php echo $IdPengguna ?></td>
                <td scope="row"><?php echo $IdBarang ?></td>
                <td scope="row">
                  <a href="pembelian.php?op=edit&IdPembelian=<?php echo $IdPembelian?>"><button type="button" class="btn btn-warning">Edit</button></a>
                  <a href="pembelian.php?op=delete&IdPembelian=<?php echo $IdPembelian?>" onclick="return confirm('Yakin mau delete data?')" ><button type="button" class="btn btn-danger">Delete</button></a>

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