<!doctype html>
<?php include "../../components/header.php"; ?>


<?php 
    $target_dir = "../../uploads/";

    if (isset($_POST['submit'])) {
      $nipdMhs = $_POST['nipd'];
      $namaMhs = $_POST['nama'];
      $tglLahirMhs = $_POST['tgl_lahir'];
      $alamatMhs = $_POST['alamat'];

      $file_name = basename($_FILES['photoProfile']['name']);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
      $target_file = $target_dir.$namaMhs.'.'. $imageFileType;

      // Check if file is actual image
      $check = getimagesize($_FILES['photoProfile']['tmp_name']);
      if ($check !== false) {
          $uploadOk = 1;
      } else {
          echo 'File yang di upload bukan berupa gambar';
          $uploadOk = 0;
      }

      // Check file size
      if ($_FILES['photoProfile']['size'] > 500000) {
          echo 'Maaf file terlalu besar.';
          $uploadOk = 0;
      }

      // Allow certain file formats
      if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
          echo 'Maaf, hanya JPG, JPEG, PNG & GIF format yang diperbolehkan';
          $uploadOk = 0;
      }

      // Proccess upload
      if ($uploadOk == 1) {
          if (move_uploaded_file($_FILES['photoProfile']['tmp_name'], $target_file)) {
            $photoProfile = $namaMhs.'.'. $imageFileType;
            $sql = "INSERT INTO mhs (NIPD, namaMhs, tanggalLahir, alamat, photoProfile) VALUES ('$nipdMhs', '$namaMhs', '$tglLahirMhs', '$alamatMhs','$photoProfile')";
          } else {
              echo 'Sorry, there was an error uploading your file.';
          }
      }


      if ($conn->query($sql) === TRUE) {
          $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                  Data berhasil di Tambah!
                                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
          $conn->close();
          header("Location: tampilDatamhs.php");
          exit();
      } else {
          $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                  Error: ".$sql." - " . $conn->error . "
                                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
          $conn->close();
          header("Location: tampilDatamhs.php");
          exit();
      }
    }
?>

      <!-- Header dengan Logout -->
      <div class="header">
        <h4>Tambah Data Mahasiswa ASE10</h4>
      </div>

        <div class="content" style="margin-top: 70px;">
        <form action="" method="post" enctype="multipart/form-data" class="border border-success p-4 rounded shadow">
                    <div class="mb-3">
                    <label class="form-label" for="">NIPD</label>
                    <input type="text" name="nipd" class="form-control" maxlength="12" required>
                    </div>

                    <div class="mb-3">
                    <label class="form-label" for="">Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                    <label class="form-label" for="">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" max="2006-12-31" required>
                    </div>

                    <div class="mb-3">
                    <label for="" class="form-label">Photo Profile Mahasiswa</label>
                    <input class="form-control" type="file" name="photoProfile" required>
                    </div>

                    <div class="mb-3">
                    <label class="form-label" for="">Alamat</label>
                    <textarea class="form-control mb-3" name="alamat" id="" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                    <button type="submit" name="submit" class="form-control btn btn-success mb-2">Submit</button>
                    <a href="./tampilDatamhs.php"><button type="button" class="form-control btn btn-primary" name="submit">Kembali</button></a>
                    </div>
                </form>
        </div>

    <?php include "../../components/footer.php"; ?>
