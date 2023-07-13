<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Periksa apakah data POST tidak kosong
if (!empty($_POST)) {
    // Atur variabel yang akan disisipkan, kita harus memeriksa apakah variabel POST ada jika tidak kita dapat mengaturnya menjadi kosong
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Periksa apakah variabel "nama" POST ada, jika tidak default nilainya kosong, pada dasarnya sama untuk semua variabel
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $telp = isset($_POST['telp']) ? $_POST['telp'] : '';
    $isi_keluhan = isset($_POST['isi_keluhan']) ? $_POST['isi_keluhan'] : '';

    // Masukkan catatan baru ke dalam tabel kontak
    $stmt = $pdo->prepare('INSERT INTO kontak VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nama, $email, $telp, $isi_keluhan]);
    // Pesan keluaran 
    $msg = 'Berhasil Membuat Laporan!';
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
<?=template_footer()?>