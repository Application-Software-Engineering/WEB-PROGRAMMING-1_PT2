<!doctype html>
<?php include "../../components/header.php"; ?>

<?php 
    // Ambil ID mahasiswa yang akan diubah
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM matkul WHERE id = '$id'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
    }

    if (isset($_POST['update'])) {
        $namaMatkul = $_POST['nama'];
        $deskripsiMatkul = $_POST['deskripsi'];

        $sql = "UPDATE dosen SET namaMatkul = '$namaMatkul', deskripsi = '$deskripsiMatkul' WHERE id = '$id'";


        if ($conn->query($sql) === TRUE) {
            $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    Data berhasil Di ubah!
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                  </div>";
            $conn->close();
            header("Location: tampilDataMatkul.php");
            exit();
        } else {
            $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    Error: ".$sql." - " . $conn->error . "
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                  </div>";
            $conn->close();
            header("Location: tampilDataMatkul.php");
            exit();
        }
    }

?>

    <div class="header">
        <h4>Ubah Data Matkul</h4>
    </div>

    <div class="content" style="margin-top: 70px;">
    <form action="" method="post" class="border border-success p-4 rounded shadow">
                    <div class="mb-3">
                    <label class="form-label" for="">Nama</label>
                    <input type="text" name="nama" class="form-control" maxlength="12" value="<?php echo $row['namaMatkul'];?>" required>
                    </div>

                    <div class="mb-3">
                    <label class="form-label" for="">Deskripsi</label>
                    <textarea class="form-control mb-3" name="deskripsi" id="" rows="3" required><?php echo $row['deskripsi'];?></textarea>
                    <button type="submit" name="update" class="form-control btn btn-warning mb-3">Update</button>
                    </div>
                </form>
    </div>

   <?php include "../../components/footer.php"; ?>