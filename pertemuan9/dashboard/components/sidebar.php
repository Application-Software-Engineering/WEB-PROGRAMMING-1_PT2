    <!-- Sidebar Bootstrap -->
    <div class="sidebar">
        <h4>Admin ASE</h4>
        <hr>

        <?php
        $query = "SELECT * FROM rbac a, menu b WHERE a.role_id = ".$_SESSION['role']." AND a.menu_id = b.id";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<a href="'.$row['url'].'"><i class="fas fa-user"></i>'.$row['namaMenu'].' </a>';
        }
        ?>
        <!-- <a href="../../pages/mahasiswa/tampilDatamhs.php"><i class="fas fa-user"></i> Data Mahasiswa</a>
        <a href="../../pages/dosen/tampilDataDosen.php"><i class="fas fa-user"></i> Data Dosen</a>
        <a href="../../pages/matkul/tampilDataMatkul.php"><i class="fas fa-cogs"></i> Data Matakuliah</a> -->

        <div class="logout">
            <a href="../../logout.php" class="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>