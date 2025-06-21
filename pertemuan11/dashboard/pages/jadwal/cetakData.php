<?php
// file koneksi antara web dengan db

include "../../../koneksi.php";

// Set headers for Excel file
header("Content-Type: text/csv");
header("Content-Disposition: atachment; filename=jadwal_data.csv");

$output = fopen("php://output","w");

fputcsv($output, ['Kelas', 'Mata Kuliah', 'Dosen', 'Hari', 'Jam', 'Ruangan', 'Semester', 'Tahun Ajaran']);

$sql = "SELECT c.nama_kelas, 
        b.namaMatkul, 
        d.namaDosen, 
        e.nama_hari, 
        CONCAT(f.jam_mulai, ' - ', f.jam_selesai) AS jam,
        g.nama_ruangan, 
        a.semester, 
        a.tahun_ajaran 
        FROM jadwal_kuliah a 
        LEFT JOIN matkul b ON a.id_matkul=b.id
        LEFT JOIN kelas c ON a.id_kelas=c.id
        LEFT JOIN dosen d ON a.id_dosen=d.id
        LEFT JOIN hari e ON a.id_hari=e.id
        LEFT JOIN jam_kuliah f ON a.id_jam_kuliah=f.id
        LEFT JOIN ruangan g ON a.id_ruangan=g.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();
exit;
?>