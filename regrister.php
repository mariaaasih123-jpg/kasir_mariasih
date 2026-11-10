<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; 
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
        $_SESSION['role'] = $row['role'];

    
        if ($row['role'] == 'admin') {
            header("Location: admin/dashboard.php");
        } elseif ($row['role'] == 'petugas') {
            header("Location: petugas/dashboard.php");
        } elseif ($row['role'] == 'pelanggan') {
            header("Location: pelanggan/dashboard.php");
        }
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Aplikasi kasir </title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: #f4f4f9; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }
        .login-card { 
            background: white; 
            padding: 30px; 
            border-radius: 8px; 
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1); 
            width: 320px; 
        }
        .login-card h2 { 
            text-align: center; 
            margin-bottom: 20px; 
            color: #333; 
        }
        .form-group { 
            margin-bottom: 15px; 
        }
        .form-group label { 
            display: block; 
            margin-bottom: 5px; 
            color: #666; 
        }
        .form-group input { 
            width: 100%; 
            padding: 8px; 
            box-sizing: border-box; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
        }
        .btn { 
            width: 100%; 
            background: #007bff; 
            color: white; 
            border: none; 
            padding: 10px; 
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 16px; 
        }
        .btn:hover { 
            background: #0056b3; 
        }
        .error { 
            color: red; 
            font-size: 13px; 
            text-align: center; 
            margin-bottom: 15px; 
            background: #ffebee; 
            padding: 8px; 
            border-radius: 4px; 
            border: 1px solid #ffcdd2;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Login Aplikasi</h2>
    
    <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>
    
    <form action="" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required autocomplete="off">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" name="login" class="btn">Masuk</button>
    </form>
</div>

</body>
</html>