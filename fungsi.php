<?php
session_start();

if(!isset($_SESSION['username'])){
	header('Location: login.php');
}

// mencari ID kriteria
// berdasarkan urutan ke berapa (C1, C2, C3)
function getKriteriaID($no_urut) {
	include('config.php');
	$query  = "SELECT id FROM kriteria ORDER BY id";
	$result = mysqli_query($koneksi, $query);

	while ($row = mysqli_fetch_array($result)) {
		$listID[] = $row['id'];
	}

	return $listID[($no_urut)];
}

// mencari ID alternatif
// berdasarkan urutan ke berapa (A1, A2, A3)
function getAlternatifID($no_urut) {
	include('config.php');
	$query  = "SELECT id FROM alternatif ORDER BY id";
	$result = mysqli_query($koneksi, $query);

	while ($row = mysqli_fetch_array($result)) {
		$listID[] = $row['id'];
	}

	return $listID[($no_urut)];
}

// mencari nama kriteria
function getKriteriaNama($no_urut) {
	include('config.php');
	$query  = "SELECT nama FROM kriteria ORDER BY id";
	$result = mysqli_query($koneksi, $query);

	while ($row = mysqli_fetch_array($result)) {
		$nama[] = $row['nama'];
	}

	return $nama[($no_urut)];
}

// mencari nama alternatif
function getAlternatifNama($no_urut) {
	include('config.php');
	$query  = "SELECT nama FROM alternatif ORDER BY id";
	$result = mysqli_query($koneksi, $query);

	while ($row = mysqli_fetch_array($result)) {
		$nama[] = $row['nama'];
	}

	return $nama[($no_urut)];
}

// mencari priority vector alternatif
function getAlternatifPV($id_alternatif,$id_kriteria) {
	include('config.php');
	$query = "SELECT nilai FROM pv_alternatif WHERE id_alternatif=$id_alternatif AND id_kriteria=$id_kriteria";
	$result = mysqli_query($koneksi, $query);
	while ($row = mysqli_fetch_array($result)) {
		$pv = $row['nilai'];
	}

	return $pv;
}

// mencari priority vector kriteria
function getKriteriaPV($id_kriteria) {
	include('config.php');
	$query = "SELECT nilai FROM pv_kriteria WHERE id_kriteria=$id_kriteria";
	$result = mysqli_query($koneksi, $query);
	while ($row = mysqli_fetch_array($result)) {
		$pv = $row['nilai'];
	}
	return $pv;
}

// mencari jumlah alternatif
function getJumlahAlternatif() {
	include('config.php');
	$query  = "SELECT count(*) FROM alternatif";
	$result = mysqli_query($koneksi, $query);
	while ($row = mysqli_fetch_array($result)) {
		$jmlData = $row[0];
	}

	return $jmlData;
}

// mencari jumlah kriteria
function getJumlahKriteria() {
	include('config.php');
	$query  = "SELECT count(*) FROM kriteria";
	$result = mysqli_query($koneksi, $query);
	while ($row = mysqli_fetch_array($result)) {
		$jmlData = $row[0];
	}

	return $jmlData;
}

// menambah data kriteria / alternatif
function tambahData($tabel,$nama) {
	include('config.php');

	$query 	= "INSERT INTO $tabel (nama) VALUES ('$nama')";
	$tambah	= mysqli_query($koneksi, $query);

	if (!$tambah) {
		echo "Gagal mmenambah data".$tabel;
		exit();
	}
}

// hapus kriteria
function deleteKriteria($id) {
	include('config.php');

	// hapus record dari tabel kriteria
	$query 	= "DELETE FROM kriteria WHERE id=$id";
	mysqli_query($koneksi, $query);

	// hapus record dari tabel pv_kriteria
	$query 	= "DELETE FROM pv_kriteria WHERE id_kriteria=$id";
	mysqli_query($koneksi, $query);

	// hapus record dari tabel pv_alternatif
	$query 	= "DELETE FROM pv_alternatif WHERE id_kriteria=$id";
	mysqli_query($koneksi, $query);

	$query 	= "DELETE FROM perbandingan_kriteria WHERE kriteria1=$id OR kriteria2=$id";
	mysqli_query($koneksi, $query);

	$query 	= "DELETE FROM perbandingan_alternatif WHERE pembanding=$id";
	mysqli_query($koneksi, $query);
}

// hapus alternatif
function deleteAlternatif($id) {
	include('config.php');

	// hapus record dari tabel alternatif
	$query 	= "DELETE FROM alternatif WHERE id=$id";
	mysqli_query($koneksi, $query);

	// hapus record dari tabel pv_alternatif
	$query 	= "DELETE FROM pv_alternatif WHERE id_alternatif=$id";
	mysqli_query($koneksi, $query);

	// hapus record dari tabel ranking
	$query 	= "DELETE FROM ranking WHERE id_alternatif=$id";
	mysqli_query($koneksi, $query);

	$query 	= "DELETE FROM perbandingan_alternatif WHERE alternatif1=$id OR alternatif2=$id";
	mysqli_query($koneksi, $query);
}

// memasukkan nilai priority vektor kriteria
function inputKriteriaPV ($id_kriteria,$pv) {
	include ('config.php');

	$query = "SELECT * FROM pv_kriteria WHERE id_kriteria=$id_kriteria";
	$result = mysqli_query($koneksi, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	// jika result kosong maka masukkan data baru
	// jika telah ada maka diupdate
	if (mysqli_num_rows($result)==0) {
		$query = "INSERT INTO pv_kriteria (id_kriteria, nilai) VALUES ($id_kriteria, $pv)";
	} else {
		$query = "UPDATE pv_kriteria SET nilai=$pv WHERE id_kriteria=$id_kriteria";
	}


	$result = mysqli_query($koneksi, $query);
	if(!$result) {
		echo "Gagal memasukkan / update nilai priority vector kriteria";
		exit();
	}

}

// memasukkan nilai priority vektor alternatif
function inputAlternatifPV ($id_alternatif,$id_kriteria,$pv) {
	include ('config.php');

	$query  = "SELECT * FROM pv_alternatif WHERE id_alternatif = $id_alternatif AND id_kriteria = $id_kriteria";
	$result = mysqli_query($koneksi, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	// jika result kosong maka masukkan data baru
	// jika telah ada maka diupdate
	if (mysqli_num_rows($result)==0) {
		$query = "INSERT INTO pv_alternatif (id_alternatif,id_kriteria,nilai) VALUES ($id_alternatif,$id_kriteria,$pv)";
	} else {
		$query = "UPDATE pv_alternatif SET nilai=$pv WHERE id_alternatif=$id_alternatif AND id_kriteria=$id_kriteria";
	}

	$result = mysqli_query($koneksi, $query);
	if (!$result) {
		echo "Gagal memasukkan / update nilai priority vector alternatif";
		exit();
	}

}


// memasukkan bobot nilai perbandingan kriteria
function inputDataPerbandinganKriteria($kriteria1,$kriteria2,$nilai) {
	include('config.php');

	$id_kriteria1 = getKriteriaID($kriteria1);
	$id_kriteria2 = getKriteriaID($kriteria2);

	$query  = "SELECT * FROM perbandingan_kriteria WHERE kriteria1 = $id_kriteria1 AND kriteria2 = $id_kriteria2";
	$result = mysqli_query($koneksi, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	// jika result kosong maka masukkan data baru
	// jika telah ada maka diupdate
	if (mysqli_num_rows($result)==0) {
		$query = "INSERT INTO perbandingan_kriteria (kriteria1,kriteria2,nilai) VALUES ($id_kriteria1,$id_kriteria2,$nilai)";
	} else {
		$query = "UPDATE perbandingan_kriteria SET nilai=$nilai WHERE kriteria1=$id_kriteria1 AND kriteria2=$id_kriteria2";
	}

	$result = mysqli_query($koneksi, $query);
	if (!$result) {
		echo "Gagal memasukkan data perbandingan";
		exit();
	}

}

// memasukkan bobot nilai perbandingan alternatif
function inputDataPerbandinganAlternatif($alternatif1,$alternatif2,$pembanding,$nilai) {
	include('config.php');


	$id_alternatif1 = getAlternatifID($alternatif1);
	$id_alternatif2 = getAlternatifID($alternatif2);
	$id_pembanding  = getKriteriaID($pembanding);

	$query  = "SELECT * FROM perbandingan_alternatif WHERE alternatif1 = $id_alternatif1 AND alternatif2 = $id_alternatif2 AND pembanding = $id_pembanding";
	$result = mysqli_query($koneksi, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	// jika result kosong maka masukkan data baru
	// jika telah ada maka diupdate
	if (mysqli_num_rows($result)==0) {
		$query = "INSERT INTO perbandingan_alternatif (alternatif1,alternatif2,pembanding,nilai) VALUES ($id_alternatif1,$id_alternatif2,$id_pembanding,$nilai)";
	} else {
		$query = "UPDATE perbandingan_alternatif SET nilai=$nilai WHERE alternatif1=$id_alternatif1 AND alternatif2=$id_alternatif2 AND pembanding=$id_pembanding";
	}

	$result = mysqli_query($koneksi, $query);
	if (!$result) {
		echo "Gagal memasukkan data perbandingan";
		exit();
	}

}

// mencari nilai bobot perbandingan kriteria
function getNilaiPerbandinganKriteria($kriteria1,$kriteria2) {
	include('config.php');

	$id_kriteria1 = getKriteriaID($kriteria1);
	$id_kriteria2 = getKriteriaID($kriteria2);

	$query  = "SELECT nilai FROM perbandingan_kriteria WHERE kriteria1 = $id_kriteria1 AND kriteria2 = $id_kriteria2";
	$result = mysqli_query($koneksi, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	if (mysqli_num_rows($result)==0) {
		$nilai = 1;
	} else {
		while ($row = mysqli_fetch_array($result)) {
			$nilai = $row['nilai'];
		}
	}

	return $nilai;
}

// mencari nilai bobot perbandingan alternatif
function getNilaiPerbandinganAlternatif($alternatif1,$alternatif2,$pembanding) {
	include('config.php');

	$id_alternatif1 = getAlternatifID($alternatif1);
	$id_alternatif2 = getAlternatifID($alternatif2);
	$id_pembanding  = getKriteriaID($pembanding);

	$query  = "SELECT nilai FROM perbandingan_alternatif WHERE alternatif1 = $id_alternatif1 AND alternatif2 = $id_alternatif2 AND pembanding = $id_pembanding";
	$result = mysqli_query($koneksi, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}
	if (mysqli_num_rows($result)==0) {
		$nilai = 1;
	} else {
		while ($row = mysqli_fetch_array($result)) {
			$nilai = $row['nilai'];
		}
	}

	return $nilai;
}

// menampilkan nilai IR
function getNilaiIR($jmlKriteria) {
	include('config.php');
	$query  = "SELECT nilai FROM ir WHERE jumlah=$jmlKriteria";
	$result = mysqli_query($koneksi, $query);
	while ($row = mysqli_fetch_array($result)) {
		$nilaiIR = $row['nilai'];
	}

	return $nilaiIR;
}

// mencari Principe Eigen Vector (λ maks)
function getEigenVector($matrik_a,$matrik_b,$n) {
	$eigenvektor = 0;
	for ($i=0; $i <= ($n-1) ; $i++) {
		$eigenvektor += ($matrik_a[$i] * (($matrik_b[$i]) / $n));
		
	}

	return $eigenvektor;
}

// mencari Cons Index
function getConsIndex($matrik_a,$matrik_b,$n) {
	$eigenvektor = getEigenVector($matrik_a,$matrik_b,$n);
	$consindex = ($eigenvektor - $n)/($n-1);

	return $consindex;
}

// Mencari Consistency Ratio
function getConsRatio($matrik_a,$matrik_b,$n) {
	$consindex = getConsIndex($matrik_a,$matrik_b,$n);
	$consratio = $consindex / getNilaiIR($n);

	return $consratio;
}

// menampilkan tabel perbandingan bobot
function showTabelPerbandingan($jenis,$kriteria) {
	include('config.php');

	if ($kriteria == 'kriteria') {
		$n = getJumlahKriteria();
	} else {
		$n = getJumlahAlternatif();
	}
	

	$query = "SELECT nama FROM $kriteria ORDER BY id";
	$result	= mysqli_query($koneksi, $query);
	if (!$result) {
		echo "Error koneksi database!!!";
		exit();
	}

	// buat list nama pilihan
	while ($row = mysqli_fetch_array($result)) {
		$pilihan[] = $row['nama'];
	}
	

	// tampilkan tabel
	?>

<div class="card shadow mb-4">
<div class="card-header py-3">
</div>
<div class="card-body">
	<div class="table-responsive">
		<form action="proses.php" method="post">
			<table class="table table-bordered" width="100%" cellspacing="0">
			<thead>
				<tr>
				<th>pilih yang lebih penting</th>
				<th>pilih yang lebih penting</th>
				<th>Nilai Perbandingan</th>
				</tr>
			</thead>
			<tbody>

	<?php

	//inisialisasi
	$urut = 0;

	for ($x=0; $x <= ($n - 2); $x++) {
		for ($y=($x+1); $y <= ($n - 1) ; $y++) {

			$urut++;
	?>		
			<tr>
				<td>
					<input type="radio" class="stv-radio-button" name="pilih<?php echo $urut?>" value="1" id="buttonk1<?= $urut?>" checked />
					<label for="buttonk1<?= $urut?>"><?php echo $pilihan[$x]; ?></label>
				</td>
				<td>
					<input type="radio" class="stv-radio-button" name="pilih<?php echo $urut?>" value="2" id="buttonk2<?= $urut?>" />
					<label for="buttonk2<?= $urut?>"><?php echo $pilihan[$y]; ?></label>
				</td>
				<td>
					<div class="stv-radio-buttons-wrapper">
			<?php
			if ($kriteria == 'kriteria') {
				$nilai = getNilaiPerbandinganKriteria($x,$y);
			} else {
				$nilai = getNilaiPerbandinganAlternatif($x,$y,($jenis-1));
			}		
			?>
						<ul>
							<li style="list-style-type: none;">
								<input type="radio" class="stv-radio-button" name="bobot<?php echo $urut?>" value="1" id="button1<?= $urut?>" <?php if($nilai == 1) echo "checked"; ?> /> 
								<label for="button1<?= $urut?>">1</label>
								<input type="radio" class="stv-radio-button" name="bobot<?php echo $urut?>" value="2" id="button2<?= $urut?>" <?php if($nilai == 2) echo "checked"; ?>/>
								<label for="button2<?= $urut?>">2</label>
								<input type="radio" class="stv-radio-button" name="bobot<?php echo $urut?>" value="3" id="button3<?= $urut?>" <?php if($nilai == 3) echo "checked"; ?>/>
								<label for="button3<?= $urut?>">3</label>
								<input type="radio" class="stv-radio-button" name="bobot<?php echo $urut?>" value="4" id="button4<?= $urut?>" <?php if($nilai == 4) echo "checked"; ?>/>
								<label for="button4<?= $urut?>">4</label>
								<input type="radio" class="stv-radio-button" name="bobot<?php echo $urut?>" value="5" id="button5<?= $urut?>" <?php if($nilai == 5) echo "checked"; ?>/>
								<label for="button5<?= $urut?>">5</label>
								<input type="radio" class="stv-radio-button" name="bobot<?php echo $urut?>" value="6" id="button6<?= $urut?>" <?php if($nilai == 6) echo "checked"; ?>/>
								<label for="button6<?= $urut?>">6</label>
								<input type="radio" class="stv-radio-button" name="bobot<?php echo $urut?>" value="7" id="button7<?= $urut?>" <?php if($nilai == 7) echo "checked"; ?>/>
								<label for="button7<?= $urut?>">7</label>
								<input type="radio" class="stv-radio-button" name="bobot<?php echo $urut?>" value="8" id="button8<?= $urut?>" <?php if($nilai == 8) echo "checked"; ?>/>
								<label for="button8<?= $urut?>">8</label>
								<input type="radio" class="stv-radio-button" name="bobot<?php echo $urut?>" value="9" id="button9<?= $urut?>" <?php if($nilai == 9) echo "checked"; ?>/>
								<label for="button9<?= $urut?>">9</label>
								<input type="radio" class="stv-radio-button" name="bobot<?php echo $urut?>" value="10" id="button10<?= $urut?>" <?php if($nilai == 10) echo "checked"; ?>/>
								<label for="button10<?= $urut?>">10</label>

							</li>
							<li style="list-style-type: none;">
								<input type="radio" class="stv-radio-button" name="bobot<?= $urut?>" value="<?= round(1/1, 2);?>"   id="button1<?= $urut . round(1/1, 2) ?>"  <?php if($nilai == round(1/1, 2)) echo "checked"; ?> /> <label for="button1<?=  $urut . round(1/1, 2) ?>" style="font-size:12px;"><?= round(1/1, 2); ?></label>
								<input type="radio" class="stv-radio-button" name="bobot<?= $urut?>" value="<?= round(1/2, 2); ?>"  id="button2<?=  $urut . round(1/2, 2) ?>" <?php if($nilai  == round(1/2, 2)) echo "checked"; ?>/> <label for="button2<?=   $urut . round(1/2, 2) ?>" style="font-size:12px;"><?= round(1/2, 2);?></label>
								<input type="radio" class="stv-radio-button" name="bobot<?= $urut?>" value="<?= round(1/3, 2); ?>"  id="button3<?=  $urut . round(1/3, 2) ?>" <?php if($nilai  == round(1/3, 2)) echo "checked"; ?>/> <label for="button3<?=   $urut . round(1/3, 2) ?>" style="font-size:12px;"><?= round(1/3, 2);?></label>
								<input type="radio" class="stv-radio-button" name="bobot<?= $urut?>" value="<?= round(1/4, 2); ?>"  id="button4<?=  $urut . round(1/4, 2) ?>" <?php if($nilai  == round(1/4, 2)) echo "checked"; ?>/> <label for="button4<?=   $urut . round(1/4, 2) ?>" style="font-size:12px;"><?= round(1/4, 2);?></label>
								<input type="radio" class="stv-radio-button" name="bobot<?= $urut?>" value="<?= round(1/5, 2); ?>"  id="button5<?=  $urut . round(1/5, 2) ?>" <?php if($nilai  == round(1/5, 2)) echo "checked"; ?>/> <label for="button5<?=   $urut . round(1/5, 2) ?>" style="font-size:12px;"><?= round(1/5, 2);?></label>
								<input type="radio" class="stv-radio-button" name="bobot<?= $urut?>" value="<?= round(1/6, 2); ?>"  id="button6<?=  $urut . round(1/6, 2) ?>" <?php if($nilai  == round(1/6, 2)) echo "checked"; ?>/> <label for="button6<?=   $urut . round(1/6, 2) ?>" style="font-size:12px;"><?= round(1/6, 2);?></label>
								<input type="radio" class="stv-radio-button" name="bobot<?= $urut?>" value="<?= round(1/7, 2); ?>"  id="button7<?=  $urut . round(1/7, 2) ?>" <?php if($nilai  == round(1/7, 2)) echo "checked"; ?>/> <label for="button7<?=   $urut . round(1/7, 2) ?>" style="font-size:12px;"><?= round(1/7, 2);?></label>
								<input type="radio" class="stv-radio-button" name="bobot<?= $urut?>" value="<?= round(1/8, 2); ?>"  id="button8<?=  $urut . round(1/8, 2) ?>" <?php if($nilai  == round(1/8, 2)) echo "checked"; ?>/> <label for="button8<?=   $urut . round(1/8, 2) ?>" style="font-size:12px;"><?= round(1/8, 2);?></label>
								<input type="radio" class="stv-radio-button" name="bobot<?= $urut?>" value="<?= round(1/9, 2); ?>"  id="button9<?=  $urut . round(1/9, 2) ?>" <?php if($nilai  == round(1/9, 2)) echo "checked"; ?>/> <label for="button9<?=   $urut . round(1/9, 2) ?>" style="font-size:12px;"><?= round(1/9, 2);?></label>
								<input type="radio" class="stv-radio-button" name="bobot<?= $urut?>" value="<?= round(1/10, 2); ?>" id="button10<?=  $urut . round(1/10, 2) ?>" <?php if($nilai  == round(1/10, 2)) echo "checked"; ?>/> <label for="button10<?= $urut . round(1/10, 2) ?>" style="font-size:12px;"><?= round(1/10, 2);?></label>
							</li>
						</ul>
					</div>
				</td>
				</tr>
				
			<?php
		}
	}

	?>
		</tbody>
	</table>
	<input type="text" name="jenis" value="<?php echo $jenis; ?>" hidden>
	<br><br><input class="btn btn-primary btn-icon-split" style="padding: 5px;" type="submit" name="submit" value="SUBMIT">
	</form>
</div>

	<?php
}

?>
