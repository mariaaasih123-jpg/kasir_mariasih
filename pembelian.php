<?php
include 'koneksi.php';

if (isset($_POST['beli'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah_beli = $_POST['jumlah'];

    $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang = '$id_barang'");
    $barang = mysqli_fetch_assoc($query);
    
    if ($barang['stok'] >= $jumlah_beli) {
        $total_harga = $barang['harga'] * $jumlah_beli;
        $stok_baru = $barang['stok'] - $jumlah_beli;

        mysqli_query($koneksi, "UPDATE barang SET stok = '$stok_baru' WHERE id_barang = '$id_barang'");
        
        mysqli_query($koneksi, "INSERT INTO pembelian (id_barang, jumlah, total_harga) VALUES ('$id_barang', '$jumlah_beli', '$total_harga')");
        
        echo "<script>alert('Pembelian Berhasil! Total Bayar: Rp " . number_format($total_harga, 0, ',', '.') . "'); window.location='pembelian.php';</script>";
    } else {
        echo "<script>alert('Stok tidak mencukupi!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Register</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f7f6;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}
