<?php
	include('header.php');
?>

<div class="card shadow mb-4">
<div class="card-header py-3">
</div>
<div class="card-body">
	<div class="table-responsive">
	<h1>Matrix Perbandingan berpasangan</h1>
	<table class="table table-bordered" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>Kriteria</th>
<?php
	for ($i=0; $i <= ($n-1); $i++) {
		echo "<th>".getAlternatifNama($i)."</th>";
	}
?>
			</tr>
		</thead>
		<tbody>
<?php
	for ($x=0; $x <= ($n-1); $x++) {
		echo "<tr>";
		echo "<td>".getAlternatifNama($x)."</td>";
			for ($y=0; $y <= ($n-1); $y++) {
				echo "<td>".round($matrik[$x][$y],2)."</td>";
			}

		echo "</tr>";
	}
?>
		</tbody>
		<tfoot>
			<tr>
				<th>Jumlah</th>
<?php
		for ($i=0; $i <= ($n-1); $i++) {
			echo "<th>".round($jmlmpb[$i],2)."</th>";
		}
?>
			</tr>
		</tfoot>
	</table>


	<br>

	<h3 class="ui header">Matriks Nilai Kriteria</h3>
	<table class="table table-bordered" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>Kriteria</th>
<?php
	for ($i=0; $i <= ($n-1); $i++) {
		echo "<th>".getAlternatifNama($i)."</th>";
	}
?>
				<th>Local Priority</th>
			</tr>
		</thead>
		<tbody>
<?php
	for ($x=0; $x <= ($n-1); $x++) {
		echo "<tr>";
		echo "<td>".getAlternatifNama($x)."</td>";
			for ($y=0; $y <= ($n-1); $y++) {
				echo "<td>".round($matrikb[$x][$y],2)."</td>";
			}
		echo "<td>".round($pv[$x],2)."</td>";

		echo "</tr>";
	}
?>

		</tbody>
		<tfoot>
		<?php 
				$eigenv 	= 0;
				$hasile 	= 0;
				
					for ($x=0; $x <= ($n-1); $x++) {					
						for ($y=0; $y <= ($n-1); $y+0) { 
							for($z=0; $z <= ($n-1); $z++){
								
								$eigenv +=  ($matrik[$x][$y] * $pv[$z] );
								// echo '<br>';
								
								// echo round($eigenv, 2) . '=' . round($matrik[$x][$y], 2) .'*'.  round($pv[$z], 2);
								// echo '<br>';
								if($z == ($n-1)){
									// echo round($eigenv, 2) . '\n';
									$aa = $eigenv / $pv[$x] ;
									// echo round($pv[$x], 2);
									// echo $aa;
									$hasile += $aa;
									// echo $hasile . ' ';
									// echo $n . '\n';
									$eigenv = 0;
								}
								$y++;
								// // die();
							}
						}
					}
				
			?>
			<tr>
				<th colspan="<?php echo ($n+1)?>"> (λ maks)</th>
				<th><?php $max = (round($hasile,3) / ($n)); echo round($max, 2)?></th>
			</tr>
			<tr>
				<th colspan="<?php echo ($n+1)?>">Consistency Index</th>
				<th><?php $rasio = ( ($max - $n) / ($n-1)); echo round($rasio, 2)?></th>
			</tr>
			<tr>
				<th colspan="<?php echo ($n+1)?>">Consistency Ratio</th>
				<th><?php echo (round(($rasio / getNilaiIR($n)),2))?> </th>
			</tr>
		</tfoot>
	</table>



<?php

	if ($consRatio > 10) {
?>
		<div class="ui icon red message">
			<i class="close icon"></i>
			<i class="warning circle icon"></i>
			<div class="content">
				<div class="header">
					Nilai Consistency Ratio melebihi 10% !!!
				</div>
				<p>Mohon input kembali tabel perbandingan...</p>
			</div>
		</div>

		<br>

		<a href='javascript:history.back()'>
			<button class="ui left labeled icon button">
				<i class="left arrow icon"></i>
				Kembali
			</button>
		</a>

<?php

	} else {
		if ($jenis == getJumlahKriteria()) {
?>

<br>

<form action="hasil.php">
	<button class="ui right labeled icon button" style="float: right;">
		<i class="right arrow icon"></i>
		Lanjut
	</button>
</form>


<?php

		} else {

?>
<br>
	<a href="<?php echo "bobot.php?c=".($jenis + 1)?>">
	<button class="ui right labeled icon button" style="float: right;">
		<i class="right arrow icon"></i>
		Lanjut
	</button>
	</a>

<?php

		}
	}

	echo "</section>";
	include('footer.php');

?>
