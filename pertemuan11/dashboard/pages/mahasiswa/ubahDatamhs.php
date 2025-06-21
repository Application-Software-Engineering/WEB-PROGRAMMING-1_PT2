<!doctype html>
<?php include "../../components/header.php"; ?>


<?php 
    $target_dir = "../../uploads/";

    // Ambil ID mahasiswa yang akan diubah
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM mhs WHERE id = '$id'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
    }

    if (isset($_POST['update'])) {
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
            $sql = "UPDATE mhs SET NIPD = '$nipdMhs', namaMhs = '$namaMhs', tanggalLahir = '$tglLahirMhs', photoProfile = '$photoProfile', alamat = '$alamatMhs' WHERE id = '$id'";
          } else {
              echo 'Sorry, there was an error uploading your file.';
          }
      }


      if ($conn->query($sql) === TRUE) {
          $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                  Data berhasil di Ubah!
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

    <div class="header">
        <h4>Ubah Data Mahasiswa ASE10</h4>
    </div>

    <div class="content" style="margin-top: 70px;">
    <form action="" method="post" enctype="multipart/form-data" class="border border-success p-4 rounded shadow">
                    <div class="mb-3">
                    <label class="form-label" for="">NIPD</label>
                    <input type="text" name="nipd" class="form-control" maxlength="12" value="<?php echo $row['NIPD'];?>" required>
                    </div>

                    <div class="mb-3">
                    <label class="form-label" for="">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?php echo $row['namaMhs'];?>" required>
                    </div>

                    <div class="mb-3">
                    <label class="form-label" for="">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" max="2006-12-31" value="<?php echo $row['tanggalLahir'];?>" required>
                    </div>

                    <div class="mb-3">
                    <label for="" class="form-label">Photo Profile Mahasiswa</label><br>
                    <img src="../../uploads/<?php echo htmlspecialchars($row['photoProfile']); ?>" alt=photoProfile style="width: 150px; height: 150px; object-fit: cover; display: block; margin-bottom: 10px;">
                    <input class="form-control" type="file" name="photoProfile" required>
                    </div>

                    <div class="mb-3">
                    <label class="form-label" for="">Alamat</label>
                    <textarea class="form-control mb-3" name="alamat" id="" rows="3" required><?php echo $row['alamat'];?></textarea>
                    </div>

                    <div class="mb-3">
                    <button type="submit" name="update" class="form-control btn btn-warning mb-3">Update</button>
                    </div>
                </form>
    </div>
   <?php include "../../components/footer.php"; ?>