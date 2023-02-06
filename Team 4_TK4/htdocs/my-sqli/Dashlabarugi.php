<?php
$host       = "localhost";
$user       = "root";
$password   = "";
$dbname     = "tugaskelompok3";

// membuat koneksi ke database
$conn = mysqli_connect($host, $user, $password, $dbname);

// cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// query untuk mengambil data dari tabel pembelian dan penjualan
$sql = "SELECT 
barang.IdBarang,
barang.NamaBarang,
barang.Keterangan,
(pembelian.HargaBeli * pembelian.JumlahPembelian) AS pembelian, 
(penjualan.HargaJual * penjualan.JumlahPenjualan) AS penjualan, 
((penjualan.HargaJual * penjualan.JumlahPenjualan) - (pembelian.HargaBeli * pembelian.JumlahPembelian)) AS laba_rugi
FROM barang
JOIN pembelian ON barang.idbarang = pembelian.idbarang
JOIN penjualan ON barang.idbarang = penjualan.idbarang
GROUP BY barang.idbarang;
";
$result = mysqli_query($conn, $sql);

// menampilkan tabel Laba Rugi Perusahaan
echo "<table border='1'>
<tr>
<th colspan='6'>Laba Rugi Perusahaan</th>
</tr>
<tr>
<th>IdBarang</th>
<th>NamaBarang</th>
<th>Keterangan</th>
<th>pembelian</th>
<th>penjualan</th>
<th>laba_rugi</th>
</tr>";

// menampilkan data dari query
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['IdBarang'] . "</td>";
    echo "<td>" . $row['NamaBarang'] . "</td>";
    echo "<td>" . $row['Keterangan'] . "</td>";
    echo "<td>" . $row['pembelian'] . "</td>";
    echo "<td>" . $row['penjualan'] . "</td>";
    echo "<td>" . $row['laba_rugi'] . "</td>";
    echo "</tr>";
}
echo "</table>";

// menutup koneksi ke database
mysqli_close($conn);
?>
