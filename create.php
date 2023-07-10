<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $telp = isset($_POST['telp']) ? $_POST['telp'] : '';
    $isi_keluhan = isset($_POST['isi_keluhan']) ? $_POST['isi_keluhan'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO kontak VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nama, $email, $telp, $isi_keluhan]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Buat Laporan</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="nama">Nama</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="nama" id="nama">
        <label for="email">Email</label>
        <label for="telp">No. Telp</label>
        <input type="text" name="email" id="email">
        <input type="text" name="telp" id="telp">
        <label for="isi_keluhan">Isi Keluhan</label>
        <input type="text" name="isi_keluhan" id="isi_keluhan">
        <input type="submit" value="Buat">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
<footer class="footer">
	<p>Keluhan Pelanggan</p>
	<p>Copyright© Putra Pangestu - 2023</p>
</footer>