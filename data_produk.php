<?php
session_start();in
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
include '../koneksi.php';

if (isset($_POST['tambah'])) {
    $kategori_id = $_POST['kategori_id'];
    $nama_alat = mysqli_real_escape_string($conn, $_POST['nama_alat']);
    $stok = $_POST['stok'];
    $kondisi = $_POST['kondisi'];

    $query = "INSERT INTO produk (kategori_id, nama_produk, stok, kondisi) VALUES ('$kategori_id', '$nama_alat', '$stok', '$kondisi')";
    mysqli_query($conn, $query);
    header("Location: data_produk.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM alat WHERE id='$id'");
    header("Location: data_barang.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Data barang- Admin</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f9; }
        
        .sidebar { width: 250px; background: #343a40; color: white; position: fixed; height: 100%; padding: 20px; box-sizing: border-box; }
        .sidebar h2 { font-size: 18px; text-align: center; margin-bottom: 30px; }
        .sidebar a { display: block; color: #cfd8dc; text-decoration: none; padding: 10px; margin-bottom: 5px; border-radius: 4px; }
        .sidebar a:hover { background: #495057; color: white; }
        .content { margin-left: 250px; padding: 30px; box-sizing: border-box; }
        .card { background: white; padding: 20px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 10px; }
        table, th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #007bff; color: white; }
        .form-group { margin-bottom: 12px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #2835a7; color: white; border: none; padding: 10px 15px; cursor: pointer; border-radius: 4px; font-size: 14px; }
        button:hover { background: #b9bdd3; }
        .btn-danger { background: #8c58a6; padding: 5px 10px; color: white; text-decoration: none; border-radius: 3px; font-size: 13px; }
        .btn-danger:hover { background: #bc7ab7; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Panel Admin</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="data_produk.php" style="background: #495057; color: white;">CRUD Alat</a>
        <a href="data_user.php">CRUD User</a>
        <a href="../logout.php" style="color: #bc3669; margin-top: 30px;">Logout</a>
    </div>

    <div class="content">
        <h2>Manajemen data barang</h2>
        <div class="card">
            <h3>Tambah barang Baru</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Kategori Alat</label>
                    <select name="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php
                        $kat = mysqli_query($conn, "SELECT * FROM kategori");
                        while ($k = mysqli_fetch_assoc($kat)) {
                            echo "<option value='{$k['id']}'>{$k['nama_kategori']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama produk</label>
                    <input type="text" name="nama_barang" placeholder="Contoh: Projector Epson" required>
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" min="1" placeholder="Jumlah stok" required>
                </div>
                <div class="form-group">
                    <label>Kondisi produknya</label>
                    <select name="kondisi">
                        <option value="baik">Baik</option>
                        <option value="rusak">Rusak</option>
                        <option value="hilang">Kadaluwarsa</option>
                    </select>
                </div>
                <button type="submit" name="tambah">Simpan barang</button>
            </form>
        </div>
        <div class="card">
            <h3>Daftar produk yang Tersedia</h3>
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama produk</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Kondisi</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $no = 1;
                $query = "SELECT produk.*, kategori.nama_kategori FROM produk JOIN kategori ON produk.kategori_id = kategori.id";
                $result = mysqli_query($conn, $query);
                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['nama_produk']; ?></td>
                    <td><?php echo $row['nama_kategori']; ?></td>
                    <td><?php echo $row['stok']; ?></td>
                    <td><?php echo ucfirst($row['kondisi']); ?></td>
                    <td>
                        <a href="data_produk.php?hapus=<?php echo $row['id']; ?>" class="btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                    </td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align: center;'>Belum ada data produk.</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>

</body>
</html>