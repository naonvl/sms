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
		break;	
	
	default:
}
?>