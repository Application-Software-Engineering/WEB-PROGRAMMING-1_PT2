<!doctype html>
<?php include "../../components/header.php"; ?>

<?php 
    if (isset($_POST['submit'])) {
      $nidDosen = $_POST['nid'];
      $namaDosen = $_POST['nama'];
      $alamatDosen = $_POST['alamat'];
      $matkulDosen = $_POST['matkul'];

      $sql = "INSERT INTO dosen (nid, namaDosen, alamat, mataKuliah) VALUES ('$nidDosen', '$namaDosen', '$alamatDosen', '$matkulDosen')";

      if ($conn->query($sql) === TRUE) {
          $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                  Data berhasil di Tambah!
                                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
          $conn->close();
          header("Location: tampilDataDosen.php");
          exit();
      } else {
          $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                  Error: ".$sql." - " . $conn->error . "
                                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
          $conn->close();
          header("Location: tampilDataDosen.php");
          exit();
      }
    }
?>

      <!-- Header dengan Logout -->
      <div class="header">
        <h4>Tambah Data Dosen</h4>
      </div>

        <div class="content" style="margin-top: 70px;">
        <form action="" method="post" class="border border-success p-4 rounded shadow">
        <div class="mb-3">
                    <label class="form-label" for="">NID</label>
                    <input type="text" name="nid" class="form-control" maxlength="12" required>
                    </div>

                    <div class="mb-3">
                    <label class="form-label" for="">Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                    <label class="form-label" for="">Mata Kuliah</label>
                    <!-- <input type="text" name="matkul" class="form-control" required> -->
                    <select class="form-control" name="matkul" required>
                        <option value="">Pilih</option>
                        <option value="Web Programming">Web Programming</option>
                        <option value="Graphic Design">Graphic Design</option>
                        <option value="Algoritma">Algoritma</option>
                    </select>
                    </div>

                    <div class="mb-3">
                    <label class="form-label" for="">Alamat</label>
                    <textarea class="form-control mb-3" name="alamat" id="" rows="3" required></textarea>
                    <button type="submit" name="submit" class="form-control btn btn-success mb-2">Submit</button>
                    </div>
                    <a href="./tampilDataDosen.php"><button type="button" class="form-control btn btn-primary" name="submit">Kembali</button></a>
                    </div>
                </form>
        </div>

    <?php include "../../components/footer.php"; ?>
