<!DOCTYPE html>
<?php
session_start();
include "../koneksi.php";
$alert = 0;

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM auth WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $alert = 0;
        if (password_verify($password, $user["password"])) {
            $_SESSION['username'] = $user['username'];
            header('Location: pages/mahasiswa/tampilDatamhs.php');
            exit();
        } else {
            $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                  Login Gagal! Password Salah!
                                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                                $conn->close();
                                header("Location: login.php");
                                exit();
        }
    } else {
        $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                  Login Gagal! Username tidak ditemukan!
                                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                                $conn->close();
                                header("Location: login.php");
                                exit();
    }
}
?>
<html lang="id">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 1);
        }
        .sidebar {
            background-color: #343a40;
            color: white;
            padding: 1rem;
            border-top-left-radius: 1rem;
            border-bottom-left-radius: 1rem;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<div class="container login-container">
    <div class="card w-75 d-flex flex-row">
        <div class="col-md-5 sidebar d-flex flex-column justify-content-center align-items-center">
            <h2 class="mb-4">Admin ASE</h2>
            <p>Silahkan login untuk masuk ke dashboard</p>
        </div>
        <div class="col-md-7 p-5">
            <h3 class="mb-4">Login</h3>
            <?php
            if (isset($_SESSION["alert"])) {
                echo $_SESSION['alert'];
                unset($_SESSION['alert']);
            }
            ?>
            <form action="" method="post">
                    <div class="mb-3">
                    <label class="form-label" for="">Username</label>
                    <input type="text" name="username" class="form-control" required>
                    </div>    

                    <div class="mb-4">
                    <label class="form-label" for="">Password</label>
                    <input type="password" class="form-control mb-3" name="password" id="" rows="3" required></input>
                    <button type="submit" name="submit" class="btn btn-primary w-100">Masuk</button>
                    </div class="mt-3">
                    <a href="registrasi.php">Belum punya akun? Registrasi di sini.</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</html>