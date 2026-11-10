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
 <h3>Daftar Stok Barang</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $kasir_maria = mysqli_query($koneksi., "SELECT * FROM barang");
            while ($row = mysqli_fetch_assoc($kasir_maria)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_barang']; ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?= $row['stok']; ?></td>
                <td>
                    <a href="barang.php?hapus=<?= $row['id_barang']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
