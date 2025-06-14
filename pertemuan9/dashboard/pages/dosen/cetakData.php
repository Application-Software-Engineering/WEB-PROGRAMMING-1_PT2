<?php
// file koneksi antara web dengan db

include "../../../koneksi.php";

// Set headers for Excel file
header("Content-Type: text/csv");
header("Content-Disposition: atachment; filename=dosen_data.csv");

$output = fopen("php://output","w");

fputcsv($output, ['NID', 'nama', 'mataKuliah', 'alamat']);

$sql = "SELECT NID, nama, mataKuliah, alamat FROM dosen";
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