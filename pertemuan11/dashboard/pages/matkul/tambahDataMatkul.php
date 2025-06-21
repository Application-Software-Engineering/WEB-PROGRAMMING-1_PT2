<!doctype html>
<?php include "../../components/header.php"; ?>

<?php 
    if (isset($_POST['submit'])) {
      $namaMatkul = $_POST['nama'];
      $deskripsiMatkul = $_POST['deskripsi'];

      $sql = "INSERT INTO matkul (namaMatkul, deskripsi) VALUES ('$namaMatkul', '$deskripsiMatkul')";

      if ($conn->query($sql) === TRUE) {
          $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                  Data berhasil di Tambah!
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

      <!-- Header dengan Logout -->
      <div class="header">
        <h4>Tambah Data Mata Kuliah</h4>
      </div>

        <div class="content" style="margin-top: 70px;">
        <form action="" method="post" class="border border-success p-4 rounded shadow">
                    <div class="mb-3">
                    <label class="form-label" for="">Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                    </div>    

                    <div class="mb-3">
                    <label class="form-label" for="">Deskripsi</label>
                    <textarea class="form-control mb-3" name="deskripsi" id="" rows="3" required></textarea>
                    <button type="submit" name="submit" class="form-control btn btn-success mb-2">Submit</button>
                    </div>
                    <a href="./tampilDataMatkul.php"><button type="button" class="form-control btn btn-primary" name="submit">Kembali</button></a>
                    </div>
                </form>
        </div>

    <?php include "../../components/footer.php"; ?>
