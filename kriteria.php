<?php 
	include('config.php');
	include('fungsi.php');

	// menjalankan perintah edit
	if(isset($_POST['edit'])) {
		$id = $_POST['id'];

		header('Location: edit.php?jenis=kriteria&id='.$id);
		exit();
	}

	// menjalankan perintah delete
	if(isset($_POST['delete'])) {
		$id = $_POST['id'];
		deleteKriteria($id);
	}

	// menjalankan perintah tambah
	if(isset($_POST['tambah'])) {
		$nama = $_POST['nama'];
		tambahData('kriteria',$nama);
	}

	include('header.php');
	include('subheader.php');
?>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Kriteria</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
</div>
<div class="card-body">
	<div class="table-responsive">
	<table class="table table-bordered" width="100%" cellspacing="0">
		<thead>
		<tr>
			<th>No</th>
			<th>Nama Kriteri</th>
			<th>Option</th>
		</tr>
		</thead>
		<tbody>
			   

		<?php
			// Menampilkan list kriteria
			$query = "SELECT id,nama FROM kriteria ORDER BY id";
			$result	= mysqli_query($koneksi, $query);

			$i = 0;
			while ($row = mysqli_fetch_array($result)) {
				$i++;
		?>				
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $row['nama'] ?></td>
				<td>
					<form method="post" action="kriteria.php">
						<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
						<button type="submit" name="edit" class="btn btn-primary btn-icon-split">
							<span class="text">Edit</span>
						</button>
						<button type="submit" name="delete" class="btn btn-danger btn-icon-split">
							<span class="text">Delete</span>
						</button>
					</form>
				</td>
			</tr>
		

	<?php } ?>


		</tbody>
		<tfoot>
		<tr>
			<th>
			<a href="tambah.php?jenis=kriteria" class="btn btn-primary btn-icon-split">
				<span class="icon text-white-50">
					<i class="fas fa-plus"></i>
				</span>
				<span class="text">Tambah</span>
			</a>
			</th>
		</tr>
		</tfoot>
	</table>

	<br>



	<form action="alternatif.php">
		<button class="btn btn-success btn-icon-split">                
			<span class="text">Lanjut</span>
		</button>
	</form>

</section>

<?php include('footer.php'); ?>
