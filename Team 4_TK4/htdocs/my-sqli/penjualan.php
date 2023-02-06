<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$database   = "tugaskelompok3";

$koneksi    = mysqli_connect($host, $user, $pass, $database);
if(!$koneksi){
    die("Tidak bisa terkoneksi ke database");
}

$IdPenjualan     = "";
$JumlahPenjualan = "";
$HargaJual       = "";
$IdPengguna      = "";
$IdBarang        = "";
$error           = "";
$sukses          = "";

if(isset($_GET['op'])){
  $op = $_GET['op'];
}else{
  $op = "";
}

if($op == 'delete'){
  $IdPenjualan    = $_GET['IdPenjualan'];
  $sql1          =  "DELETE from Penjualan WHERE IdPenjualan ='$IdPenjualan'";
  $q1            = mysqli_query($koneksi,$sql1);
  if($q1){
    $sukses      = "Berhasil hapus data";
  }else{
    $error       = "Gagal melakukan delete data";
  }
}

if($op == 'edit'){
  $IdPenjualan        = $_GET['IdPenjualan'];
  $sql1               = "SELECT * FROM Penjualan WHERE IdPenjualan = '$IdPenjualan'";
  $q1                 = mysqli_query($koneksi,$sql1);
  $r1                 = mysqli_fetch_array($q1);
  $IdPenjualan        = $r1['IdPenjualan'];
  $JumlahPenjualan    = $r1['JumlahPenjualan'];
  $HargaJual          = $r1['HargaJual'];
  $IdPengguna         = $r1['IdPengguna'];
  $IdBarang           = $r1['IdBarang'];

  if($IdPenjualan == ''){
    $error = "Data Tidak Ditemukan";
  }
}

if (isset($_POST['simpan'])){ //Create
    $idPenjualan        = @$_POST['IdPenjualan'];
    $JumlahPenjualan    = $_POST['JumlahPenjualan'];
    $HargaJual          = $_POST['HargaJual'];
    $idPengguna         = @$_POST['IdPengguna'];
    $idBarang           = @$_POST['IdBarang'];


  if($IdPenjualan && $JumlahPenjualan && $HargaJual && $IdPengguna && $IdBarang){
    if($op == 'edit'){ //UPDATE
      $sql1     = "UPDATE Penjualan SET IdPenjualan ='$IdPenjualan', JumlahPenjualan='$JumlahPenjualan', HargaJual ='$HargaJual', IdPengguna='$IdPengguna', IdBarang='$IdBarang' WHERE IdPenjualan='$IdPenjualan'";
      $q1       = mysqli_query($koneksi, $sql1);
      if($q1){
        $sukses       = "Data berhasil di Update";
      }else{
        $error        = "Data gagal di Update";
      }
    }else{ // insert
      $sql1     = "INSERT INTO Penjualan (IdPenjualan,JumlahPenjualan,HargaJual,IdPengguna,IdBarang) VALUES('$IdPenjualan,$JumlahPenjualan,$Hargajual,$IdPengguna,$IdBarang')";
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
        header("refresh:5;url=penjualan.php");//5 : detik
        }
        ?>
        <?php
        if($sukses){
          ?>
          <div class="alert alert-success" role="alert">
              <?php echo $sukses ?>
          </div>
        <?php
          header("refresh:5;url=penjualan.php");//5 : detik
        }
        ?>
        
        <form action="" method="POST">

      <!-- Id Penjualan -->
      <div class="mb-3 row">
       <label for="idPenjualan" class="form-label">Id Penjualan</label>
        <div class="col-sm-10"> 
          <input type="int" class="form-control" id="idPenjualan" name="IdPenjualan" value="<?php echo $IdPenjualan?>">
        </div>
      </div>

      <!-- Jumlah Penjualan -->
      <div class="mb-3 row">
        <label for="JumlahPenjualan" class="form-label">Jumlah Penjualan</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="JumlahPenjualan" name="JumlahPenjualan" value="<?php echo $JumlahPenjualan?>">
        </div>
      </div>

      <!-- Harga Jual--> 
      <div class="mb-3 row">
        <label for="HargaJual" class="form-label">Harga Jual</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="HargaJual" name="HargaJual" value="<?php echo $HargaJual?>">
        </div>
      </div>

      <!-- Id Pengguna -->
      <div class="mb-3 row">
       <label for="idPengguna" class="form-label">Id Pengguna</label>
       <div class="col-sm-10">
       <select class="form-control" name="IdPengguna" id="idPengguna">
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
          <select class="form-control" name="IdBarang" id="idBarang">
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
            <th scope="col">Id Penjualan</th>
            <th scope="col">Jumlah Penjualan</th>
            <th scope="col">Harga Jual</th>
            <th scope="col">Id Pengguna</th>
            <th scope="col">Id Barang</th>
            <th scope="col">Aksi</th>
          </tr>
      </thead>  
          <tbody>
            <?php
            $sql2   ="SELECT * from penjualan order by IdPenjualan desc";
            $q2     = mysqli_query($koneksi,$sql2);
            $urut   = 1;
            while($r2 = mysqli_fetch_array($q2)){
              
                $IdPenjualan     = $r2['IdPenjualan'];
                $JumlahPenjualan = $r2['JumlahPenjualan'];
                $HargaJual       = $r2['HargaJual'];
                $IdPengguna      = $r2['IdPengguna'];
                $IdBarang        = $r2['IdBarang'];
              
            ?>
              <tr>
                <th scope="row"><?php echo $urut++ ?></th>
                <td scope="row"><?php echo $IdPenjualan ?></td>
                <td scope="row"><?php echo $JumlahPenjualan ?></td>
                <td scope="row"><?php echo $HargaJual ?></td>
                <td scope="row"><?php echo $IdPengguna ?></td>
                <td scope="row"><?php echo $IdBarang ?></td>
                <td scope="row">
                  <a href="penjualan.php?op=edit&IdPenjualan=<?php echo $IdPenjualan?>"><button type="button" class="btn btn-warning">Edit</button></a>
                  <a href="penjualan.php?op=delete&IdPenjualan=<?php echo $IdPenjualan?>" onclick="return confirm('Yakin mau delete data?')" ><button type="button" class="btn btn-danger">Delete</button></a>

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