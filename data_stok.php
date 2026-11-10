<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    mysqli_query($koneksi, "INSERT INTO barang (nama_barang, harga, stok) VALUES ('$nama', '$harga', '$stok')");
    header("Location: barang.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang = '$id'");
    header("Location: barang.php");
}

$data = mysqli_query($koneksi, "SELECT * FROM barang");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Pendataan dan Stok Barang</h2>
<a href="pembelian.php" class="btn btn-hijau">Menu Pembelian / Kasir</a>
<a href="index.php" class="btn">Kembali</a>
<br><br>

<div class="box">
    <h3>Tambah Barang Baru</h3>
    <form method="POST">
        Nama Barang <input type="text" name="nama_barang" required>
        Harga <input type="number" name="harga" required>
        Stok Awal <input type="number" name="stok" required>
        <button type="submit" name="tambah" class="btn">Simpan Barang</button>
    </form>
</div>

<div class="box">
    <h3>Daftar Barang</h3>
    <table>
        <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?php echo $row['nama_barang']; ?></td>
            <td>Rp <?php echo number_format($row['harga']); ?></td>
            <td><b><?php echo $row['stok']; ?></b></td>
            <td><a href="?hapus=<?php echo $row['id_barang']; ?>" class="btn btn-hapus" onclick="return confirm('Hapus?')">Hapus</a></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Register</title>
    <style>

body {
    font-family: Arial;
    background: #f2f2f2;
    padding: 20px;
}

h2 {
    color: #333;
}

.box {
    background: white;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

input {
    width: 100%;
    padding: 8px;
    margin: 5px 0 15px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.btn {
    background: #2d89ef;
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
}

.btn-hapus {
    background: red;
}

.btn-hijau {
    background: green;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background: #2d89ef;
    color: white;
}