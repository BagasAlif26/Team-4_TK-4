<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$database   = "tugaskelompok3";

$koneksi    = mysqli_connect($host, $user, $pass, $database);
if(!$koneksi){
    die("Tidak bisa terkoneksi ke database");
}

$IdSupplier     = "";
$NamaSupplier   = "";
$Alamat         = "";
$IdPembelian    = "";
$IdBarang       = "";
$error          = "";
$sukses         = "";

if(isset($_GET['op'])){
  $op = $_GET['op'];
}else{
  $op = "";
}

if($op == 'delete'){
  $IdSupplier      = $_GET['IdSupplier'];
  $sql1          =  "DELETE from Supplier WHERE IdSupplier='$IdSupplier'";
  $q1            = mysqli_query($koneksi,$sql1);
  if($q1){
    $sukses      = "Berhasil hapus data";
  }else{
    $error       = "Gagal melakukan delete data";
  }
}

if($op == 'edit'){
  $IdSupplier          = $_GET['IdSupplier'];
  $sql1               = "SELECT * FROM Supplier WHERE IdSupplier = '$IdSupplier'";
  $q1                 = mysqli_query($koneksi,$sql1);
  $r1                 = mysqli_fetch_array($q1);
  $IdSupplier         = $r1['IdSupplier'];
  $NamaSupplier       = $r1['NamaSupplier'];
  $Alamat             = $r1['Alamat'];
  $IdPembelian        = $r1['IdPembelian'];
  $IdBarang           = $r1['IdBarang'];

  if($IdSupplier == ''){
    $error = "Data Tidak Ditemukan";
  }
}

if (isset($_POST['simpan'])){ //Create
  $IdSupplier         = $_POST['IdSupplier'];
  $NamaSupplier       = $_POST ['NamaSupplier'];
  $Alamat             = $_POST ['Alamat'];
  $IdPembelian        = $_POST ['IdPembelian'];
  $IdBarang           = $_POST['IdBarang'];


  if($IdSupplier && $NamaSupplier && $Alamat && $IdPembelian && $IdBarang){
    if($op == 'edit'){ //UPDATE
      $sql1     = "UPDATE supplier SET IdSupplier='$IdSupplier', NamaSupplier='$NamaSupplier', Alamat='$Alamat', IdPembelian='$IdPembelian', IdBarang='$IdBarang' WHERE IdSupplier='$IdSupplier'";
      $q1       = mysqli_query($koneksi, $sql1);
      if($q1){
        $sukses       = "Data berhasil di Update";
      }else{
        $error        = "Data gagal di Update";
      }
    }else{ // insert
      $sql1     = "INSERT INTO Supplier(IdSupplier ,NamaSupplier,Alamat,IdPembelian,IdBarang) VALUES('$IdSupplier','$NamaSupplier','$Alamat','$IdPembelian','$IdBarang')";
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
        header("refresh:5;url=supplier.php");//5 : detik
        }
        ?>
        <?php
        if($sukses){
          ?>
          <div class="alert alert-success" role="alert">
              <?php echo $sukses ?>
          </div>
        <?php
          header("refresh:5;url=supplier.php");//5 : detik
        }
        ?>
        
        <form action="" method="POST">

      <!-- Id Supplier -->
      <div class="mb-3 row">
       <label for="idSupplier" class="form-label">IdSupplier</label>
        <div class="col-sm-10"> 
          <input type="int" class="form-control" id="idSupplier" name="IdSupplier" value="<?php echo $IdSupplier?>">
        </div>
      </div>

      <!-- Nama Supplier -->
      <div class="mb-3 row">
        <label for="NamaSupplier" class="form-label">Nama Supplier</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="NamaSupplier" name="NamaSupplier" value="<?php echo $NamaSupplier?>">
        </div>
      </div>
      <!-- Alamat-->
      <div class="mb-3 row">
       <label for="Alamat" class="form-label">Alamat</label>
       <div class="col-sm-10"> 
        <input type="text" class="form-control" id="Alamat" name="Alamat" value="<?php echo $Alamat?>">
      </div>
      </div>  
      <!-- Id Pembelian-->
      <div class="mb-3 row">
       <label for="idPembelian" class="form-label">Id Pembelian</label>
       <div class="col-sm-10"> 
       <select class="form-control" name="IdPembelian" id="IdPembelian">
            <option value="">- Pilih Id Pembelian -</option>
            <option value="55101" <?php if($IdPembelian == "55101") echo "selected"?>>55101</option>
            <option value="55102" <?php if($IdPembelian == "55102") echo "selected"?>>55102</option>
            <option value="55103" <?php if($IdPembelian == "55103") echo "selected"?>>55103</option>
            <option value="55104" <?php if($IdPembelian == "55104") echo "selected"?>>55104</option>
            <option value="55105" <?php if($IdPembelian == "55105") echo "selected"?>>55105</option>
            <option value="55106" <?php if($IdPembelian == "55106") echo "selected"?>>55106</option>
            <option value="55107" <?php if($IdPembelian == "55107") echo "selected"?>>55107</option>
            <option value="55108" <?php if($IdPembelian == "55108") echo "selected"?>>55108</option>
            <option value="55109" <?php if($IdPembelian == "55109") echo "selected"?>>55109</option>
            <option value="55110" <?php if($IdPembelian == "55110") echo "selected"?>>55110</option>
          </select>
        </div>
      </div>

      <!-- Id Barang-->
      <div class="mb-3 row">
       <label for="idBarang" class="form-label">Id Barang</label>
        <div class="col-sm-10"> 
          <select class="form-control" name="IdBarang" id="IdBarang">
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
    <div class="card text-dark bg-info mb-3"> 
      <div class="card-header">
        Database Output
      </div>
    <div class="card-body">
      
    <table class = "table table-dark table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Id Supplier</th>
            <th scope="col">Nama Supplier</th>
            <th scope="col">Alamat</th>
            <th scope="col">Id Pembelian</th>
            <th scope="col">Id Barang</th>
            <th scope="col">Aksi</th>
          </tr>
      </thead>  
          <tbody>
            <?php
            $sql2   ="SELECT * from Supplier order by IdSupplier desc";
            $q2     = mysqli_query($koneksi,$sql2);
            $urut   = 1;
            while($r2 = mysqli_fetch_array($q2)){
              
              $IdSupplier          = $r2['IdSupplier'];
              $NamaSupplier        = $r2['NamaSupplier'];
              $Alamat              = $r2['Alamat'];
              $IdPembelian         = $r2['IdPembelian'];
              $IdBarang            = $r2['IdBarang'];
              

            ?>
              <tr>
                <th scope="row"><?php echo $urut++ ?></th>
                <td scope="row"><?php echo $IdSupplier ?></td>
                <td scope="row"><?php echo $NamaSupplier ?></td>
                <td scope="row"><?php echo $Alamat ?></td>
                <td scope="row"><?php echo $IdPembelian ?></td>
                <td scope="row"><?php echo $IdBarang ?></td>
                <td scope="row">
                  <a href="supplier.php?op=edit&IdSupplier=<?php echo $IdSupplier?>"><button type="button" class="btn btn-warning">Edit</button></a>
                  <a href="supplier.php?op=delete&IdSupplier=<?php echo $IdSupplier?>" onclick="return confirm('Yakin mau delete data?')" ><button type="button" class="btn btn-danger">Delete</button></a>

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