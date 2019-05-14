<?php
	include('config.php');
	include('fungsi.php');

	// mendapatkan data edit
	if(isset($_GET['jenis'])) {
		$jenis	= $_GET['jenis'];
	}

	if (isset($_POST['tambah'])) {
		$jenis	= $_POST['jenis'];
		$nama 	= $_POST['nama'];

		tambahData($jenis,$nama);

		header('Location: '.$jenis.'.php');
	}

	include('header.php');
	include('subheader.php');
?>

<section class="content">
	<h2>Tambah <?php echo $jenis?></h2>

	<form class="ui form" method="post" action="tambah.php">
		<div class="inline field">
			<label>Nama <?php echo $jenis ?></label>
			<input type="text" name="nama" class="form-control form-control-user" placeholder="<?php echo $jenis?> baru">
			<input type="hidden" name="jenis" value="<?php echo $jenis?>">
		</div>
		<br>
		<input class="btn btn-primary btn-icon-split" style="padding: 5px;" type="submit" name="tambah" value="SIMPAN">
	</form>
</section>

<?php include('footer.php'); ?>