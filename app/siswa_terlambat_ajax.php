<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

switch ($pilih){
	case "gettingkat_kelas":
		$idsiswa	= $_POST["idsiswa"];
		
		$sql = $select->list_siswa('', $idsiswa);
		$data = $sql->fetch(PDO::FETCH_OBJ);
?>		
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tingkat *)</label>
				<div class="col-sm-3">
					<select name="idtingkat1" id="idtingkat1" disabled class="chosen-select form-control">
						<option value=""></option>
						<?php select_tingkat_unit("SMA", $data->idtingkat); ?>
					</select>		
					<input type="hidden" name="idtingkat" id="idtingkat" value="<?= $data->idtingkat ?>" >	
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas *)</label>
				<div class="col-sm-3" id="kelas_id">
					<select name="idkelas1" id="idkelas1" disabled class="chosen-select form-control" >
						<option value=""></option>
						<?php select_kelas($data->idtingkat, $data->idkelas); ?>
					</select>		
					<input type="hidden" name="idkelas" id="idkelas" value="<?= $data->idkelas ?>">
				</div>
			</div>

			<?php  
				$sqldet = $select->list_siswa_terlambat('', '', '', $idsiswa);
				$rowsdet = $sqldet->rowCount();
				if($rowsdet > 0) {
			?>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Detail Terlambat</label>
					<div class="col-sm-8" id="kelas_id">
						<table border="1" width="100%">							
							<tr style="background-color: green; color: #ffffff;">
								<td align="center">No.</td>
								<td align="center">Tanggal</td>
								<td align="center">Jam</td>
								<td align="center">Alasan</td>
								<td align="center">Penyelesaian</td>
							</tr>
							<?php 
								$i = 0;
								while($datadet = $sqldet->fetch(PDO::FETCH_OBJ)) { 

									$i++;							
							?>
								<tr>
									<td align="center"><?= $i ?></td>
									<td>&nbsp;<?= date('d-m-Y', strtotime($datadet->tanggal)) ?></td>
									<td>&nbsp;<?= date('H:i:s', strtotime($datadet->jam)) ?></td>
									<td>&nbsp;<?= $datadet->alasan ?></td>
									<td>&nbsp;<?= $datadet->penanganan ?></td>
								</tr>
							<?php } ?>
						</table>
					</div>
				</div>
			<?php 
				}
			?>

<?php		
		break;	
	
	default:
}
?>