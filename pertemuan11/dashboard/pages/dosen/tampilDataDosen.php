    <?php 
    include "../../components/header.php"; 
    ?>

    <!-- Header dengan Logout -->
    <div class="header">
        <h4>Data Dosen</h4>
    </div>

    <!-- Body Content -->
    <div class="content" style="margin-top: 70px;">
        <!-- <h1 class='text-center'>Data Mahasiswa ASE10</h1> -->
        <?php
        if (isset($_SESSION['alert'])) {
            echo $_SESSION['alert']; // Display the alert message
            unset($_SESSION['alert']); // Remove message after displaying
        }
        ?>
        <form action="cetakData.php" method="post">
            <button type="submit" class="btn btn-primary mb-3 float-end"><i class="fa fa-print"></i> Export Data</button>
        </form>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NID</th>
                    <th>Nama</th>
                    <th>Mata Kuliah</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include "../../../koneksi.php";
                    $sql = "SELECT id,nid,namaDosen,alamat,mataKuliah FROM dosen";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>".$i++."</th>"; 
                            echo "<td>".$row['nid']."</td>";
                            echo "<td>".$row['namaDosen']."</td>";
                            echo "<td>".$row['mataKuliah']."</td>";
                            echo "<td>".$row['alamat']."</td>";
                            echo "<td>
                                    <a href='ubahDataDosen.php?id=".$row['id']."'>
                                        <button class='btn btn-primary'>Ubah</button></a> | 
                                    <a href='prosesHapus.php?id=".$row['id']."'>
                                        <button class='btn btn-danger'>Hapus</button></a>
                                </td>";
                            echo "</tr>";
                        }
                    }    
                ?>
            </tbody>
        </table>
        <a href="./tambahDataDosen.php"><button type="button" class="form-control btn btn-success mb-3" name="submit">Tambah Data</button></a>
    </div>

<?php include "../../components/footer.php"; ?>