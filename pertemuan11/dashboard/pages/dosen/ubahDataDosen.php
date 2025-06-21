<!doctype html>
<?php include "../../components/header.php"; ?>


<?php 
    // Ambil ID mahasiswa yang akan diubah
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM dosen WHERE id = '$id'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
    }

    if (isset($_POST['update'])) {
        $nidDosen = $_POST['nid'];
        $namaDosen = $_POST['nama'];
        $alamatDosen = $_POST['alamat'];
        $matkulDosen = $_POST['matkul'];

        $sql = "UPDATE dosen SET nid = '$nidDosen', namaDosen = '$namaDosen', alamat = '$alamatDosen', mataKuliah = '$matkulDosen' WHERE id = '$id'";


        if ($conn->query($sql) === TRUE) {
            $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    Data berhasil Di ubah!
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

    <div class="header">
        <h4>Ubah Data Dosen</h4>
    </div>

    <div class="content" style="margin-top: 70px;">
    <form action="" method="post" class="border border-success p-4 rounded shadow">
                    <div class="mb-3">
                    <label class="form-label" for="">NID</label>
                    <input type="text" name="nid" class="form-control" maxlength="12" value="<?php echo $row['nid'];?>" required>
                    </div>

                    <div class="mb-3">
                    <label class="form-label" for="">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?php echo $row['namaDosen'];?>" required>
                    </div>

                    <div class="mb-3">
                    <select class="form-control" name="matkul" required>
                        <option value="">Pilih</option>
                        <option value="Web Programming" <?php  echo $row['mataKuliah'] == 'Web Programming' ? 'selected' : '' ?> >Web Programming</option>
                        <option value="Graphic Design" <?php echo $row['mataKuliah'] == 'Graphic Design' ? 'selected' : '' ?> >Graphic Design</option>
                        <option value="Algoritma" <?php echo $row['mataKuliah'] == 'Algoritma' ? 'selected' : '' ?> >Algoritma</option>
                    </select>
                    </div>

                    <div class="mb-3">
                    <label class="form-label" for="">Alamat</label>
                    <textarea class="form-control mb-3" name="alamat" id="" rows="3" required><?php echo $row['alamat'];?></textarea>
                    <button type="submit" name="update" class="form-control btn btn-warning mb-3">Update</button>
                    </div>
                </form>
    </div>

   <?php include "../../components/footer.php"; ?>