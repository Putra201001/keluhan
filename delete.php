<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Periksa apakah ID kontak ada
if (isset($_GET['id'])) {
    // Pilih data yang akan dihapus
    $stmt = $pdo->prepare('SELECT * FROM kontak WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
    // Pastikan user mengkonfirmasi jika ingin mendelete
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // jika user mengklik tombol "ya", data di hapus
            $stmt = $pdo->prepare('DELETE FROM kontak WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Kamu Baru Saja Menghapus Laporan Tersebut!';
        } else {
            // jika usser mengklik tombol "Tidak", akan diarahkan kembali ke halaman read
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Hapus Laporan #<?=$contact['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Apa kamu yakin ingin menghapus Laporan #<?=$contact['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$contact['id']?>&confirm=yes">Ya</a>
        <a href="delete.php?id=<?=$contact['id']?>&confirm=no">Tidak</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>