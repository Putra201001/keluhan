<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Periksa apakah id kontak ada
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // Bagian ini mirip dengan create.php, tetapi sebagai gantinya ini untuk mengupdate record bukan insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $telp = isset($_POST['telp']) ? $_POST['telp'] : '';
        $isi_keluhan = isset($_POST['isi_keluhan']) ? $_POST['isi_keluhan'] : '';
        
        // ini skrip untuk memperbarui data sesuai id
        $stmt = $pdo->prepare('UPDATE kontak SET id = ?, nama = ?, email = ?, telp = ?, isi_keluhan = ? WHERE id = ?');
        $stmt->execute([$id, $nama, $email, $telp, $isi_keluhan, $_GET['id']]);
        $msg = 'Update Laporan Berhasil!';
    }
    // Dapatkan kontak dari tabel kontak
    $stmt = $pdo->prepare('SELECT * FROM kontak WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Laporan #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="nama">Nama</label>
        <input type="text" name="id" value="<?=$contact['id']?>" id="id">
        <input type="text" name="nama" value="<?=$contact['nama']?>" id="nama">
        <label for="email">Email</label>
        <label for="notelp">No. Telp</label>
        <input type="text" name="email" value="<?=$contact['email']?>" id="email">
        <input type="text" name="telp" value="<?=$contact['telp']?>" id="telp">
        <label for="isi_keluhan">Isi Keluhan</label>
        <input type="text" name="isi_keluhan" value="<?=$contact['isi_keluhan']?>" id="title">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
<?=template_footer()?>