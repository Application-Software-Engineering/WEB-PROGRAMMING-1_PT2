    <?php 
    include "../../components/header.php"; 
    
    ?>

    <!-- Header dengan Logout -->
    <div class="header">
        <h4>Data Jadwal</h4>
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
                    <th>Kelas</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Ruangan</th>
                    <th>Semester</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // $sql = "SELECT id, id_kelas, id_matkul, id_dosen, id_ruangan, id_hari, id_jam_kuliah, semester, tahun_ajaran FROM jadwal_kuliah";
                    $sql = "SELECT b.namaMatkul, 
                                c.nama_kelas, 
                                d.namaDosen, 
                                e.nama_hari, 
                                f.jam_mulai, 
                                f.jam_selesai, 
                                g.nama_ruangan, 
                                a.semester, 
                                a.tahun_ajaran, 
                                a.id 
                            FROM jadwal_kuliah a 
                            LEFT JOIN matkul b ON a.id_matkul=b.id
                            LEFT JOIN kelas c ON a.id_kelas=c.id
                            LEFT JOIN dosen d ON a.id_dosen=d.id
                            LEFT JOIN hari e ON a.id_hari=e.id
                            LEFT JOIN jam_kuliah f ON a.id_jam_kuliah=f.id
                            LEFT JOIN ruangan g ON a.id_ruangan=g.id";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>".$i++."</th>"; 
                            echo "<td>".$row['nama_kelas']."</td>";
                            echo "<td>".$row['namaMatkul']."</td>";
                            echo "<td>".$row['namaDosen']."</td>";
                            echo "<td>".$row['nama_hari']."</td>";
                            echo "<td>".$row['jam_mulai'].' - '.$row['jam_selesai']."</td>";
                            echo "<td>".$row["nama_ruangan"]."</td>";
                            echo "<td>".$row["semester"]."</td>";
                            echo "<td>".$row["tahun_ajaran"]."</td>";
                            // echo "<td><img src='../../uploads/". htmlspecialchars($row['photoProfile']) . "' alt='Profile Preview' style='width: 80px; height: 80px; object-fit: cover; display: block; margin-bottom: 10px;'></td>";
                                echo "<td>
                                        <a href='ubahDataJadwal.php?id=".$row['id']."'>
                                            <button class='btn btn-warning'>Ubah</button></a> | 
                                        <a href='prosesHapus.php?id=".$row['id']."'>
                                            <button class='btn btn-danger'>Hapus</button></a>
                                    </td>";

                            echo "</tr>";
                        }
                    } 
                ?>
            </tbody>
        </table>
        <a href="./tambahDataJadwal.php"><button type="button" class="form-control btn btn-success mb-3" name="submit">Tambah Data</button></a>
    </div>

<?php include "../../components/footer.php"; ?>