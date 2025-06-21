<?php 
include "../../components/header.php";
include "../../../koneksi.php";

$sql = "SELECT b.namaMenu FROM rbac a, menu b WHERE a.role_id = 3 AND a.menu_id = b.id;";
$result = $conn->query($sql);

?>

<!-- <div class="header">
    <h4>Tambah Data Mahasiswa ASE10</h4>
</div> -->

<div class="content" style="margin-top: 70px;">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
  Open modal
</button>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<input type="checkbox" name=""> '.$row['namaMenu'].'<br>';
            }
        }
        ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
</div>
<?php include "../../components/footer.php"; ?>
