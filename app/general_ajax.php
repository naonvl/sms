<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

switch ($pilih){
	case "getkelas":
		$idtingkat	= $_POST["idtingkat"];
		
?>		
			<select name="idkelas" id="idkelas" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_kelas($idtingkat, ""); ?>
			</select>

<?php		
		break;
	
	case "getkota":
		$provinsi_kode	= $_POST["provinsi_kode"];
?>		
			<select name="kota_kode" id="kota_kode" class="chosen-select form-control" onChange="loadHTMLPost2('<?php echo $__folder ?>app/general_ajax.php','kecamatan','getkecamatan','kota_kode')" >										<option value=""></option>
				<?php select_kota($provinsi_kode, $row_siswa->kota_kode); ?>
			</select>

<?php		
		break;
	
	case "getkota_update":
		$provinsi_kode	= $_POST["provinsi_kode"];		
?>		
			<select name="kota_kode" id="kota_kode" class="chosen-select form-control" onChange="loadHTMLPost2('../../<?php echo $__folder ?>app/general_ajax.php','kecamatan','getkecamatan_update','kota_kode')" >										
			<option value=""></option>
				<?php select_kota($provinsi_kode, $row_siswa->kota_kode); ?>
			</select>

<?php		
		break;
		
	case "getkecamatan":
		$kota_kode	= $_POST["kota_kode"];
?>		
			<select name="kecamatan_kode" id="kecamatan_kode" class="chosen-select form-control" onChange="loadHTMLPost2('<?php echo $__folder ?>app/general_ajax.php','kelurahan','getdesa','kecamatan_kode')" >								<option value=""></option>
					<?php select_kecamatan($kota_kode, $row_siswa->kecamatan_kode); ?>
			</select>
				
				

<?php		
		break;
		
	case "getkecamatan_update":
		$kota_kode	= $_POST["kota_kode"];
?>		
			<select name="kecamatan_kode" id="kecamatan_kode" class="chosen-select form-control" onChange="loadHTMLPost2('../../<?php echo $__folder ?>app/general_ajax.php','kelurahan','getdesa','kecamatan_kode')" >								<option value=""></option>
					<?php select_kecamatan($kota_kode, $row_siswa->kecamatan_kode); ?>
				</select>

<?php		
		break;
		
	case "getdesa":
		$kecamatan_kode	= $_POST["kecamatan_kode"];
		
?>		
			<select name="desa_kode" id="desa_kode" class="chosen-select form-control" >										<option value=""></option>
				<?php select_desa($kecamatan_kode, $row_siswa->desa_kode); ?>
			</select>

<?php		
		break;

	case "gettingkat":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/general_ajax.php','kelas_id','getkelas','idtingkat')" >
				<option value=""></option>
				<?php select_tingkat_unit($departemen, ""); ?>
			</select>
<?php
		break;	

	case "gettingkat_upd":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('../app/general_ajax.php','kelas_id','getkelas','idtingkat')" >
				<option value=""></option>
				<?php select_tingkat_unit($departemen, ""); ?>
			</select>
<?php
		break;		

	case "gettingkat_list":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="idtingkat2" id="idtingkat2" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/siswa_list_ajax.php','kelas_id','getkelas','idtingkat2')" >
				<option value=""></option>
				<?php select_tingkat_unit($departemen, $idtingkat2); ?>
			</select>	
<?php
		break;	

	case "getsekolah":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="departemen_sekolah_id" id="departemen_sekolah_id" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/general_ajax.php','kelas_id','getkelas_unit_sekolah','departemen_sekolah_id')" >
				<option value=""></option>
				<?php select_sekolah_unit($departemen, ""); ?>
			</select>
<?php
		break;

	case "getsekolah_kelas":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="departemen_sekolah_id" id="departemen_sekolah_id" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/general_ajax.php','tingkat_id','getkelas_sekolah','departemen_sekolah_id')" >
				<option value=""></option>
				<?php select_sekolah_unit($departemen, ""); ?>
			</select>
<?php
		break;	

	case "getkelas_sekolah":
		$departemen_sekolah_id	= $_POST["departemen_sekolah_id"];
		
?>		
			<select name="idtingkat" id="idtingkat" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_tingkat_sekolah($departemen_sekolah_id, $row_kelas->idtingkat); ?>
			</select>

<?php		
		break;

	case "getkelas_unit_sekolah":
		$departemen_sekolah_id	= $_POST["departemen_sekolah_id"];
		
?>		
			<select name="idkelas" id="idkelas" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_kelas_sekolah($departemen_sekolah_id, ""); ?>
			</select>

<?php		
		break;

	case "getsekolah_tingkat":
		$departemen	= $_POST["departemen"];
?>		
			<select name="departemen_sekolah_id" id="departemen_sekolah_id" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/general_ajax.php','tingkat_id','getkelas_tingkat_sekolah','departemen_sekolah_id')" >
				<option value=""></option>
				<?php select_sekolah_unit($departemen, ""); ?>
			</select>
<?php
		break;

	case "getkelas_tingkat_sekolah":
		$departemen_sekolah_id	= $_POST["departemen_sekolah_id"];
		
?>		
			<select name="idtingkat2" id="idtingkat2" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/general_ajax.php','kelas_id','getkelas_departemen_sekolah','idtingkat2')" >
				<option value=""></option>
				<?php select_tingkat_sekolah($departemen_sekolah_id, $row_kelas->idtingkat); ?>
			</select>

<?php		
		break;

	case "getkelas_departemen_sekolah":
		$idtingkat2	= $_POST["idtingkat2"];
		
?>		
			<select name="idkelas2" id="idkelas2" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_kelas($idtingkat2, ""); ?>
			</select>
<?php		
		break;

	case "get_tingkat_sekolah":
		$departemen_sekolah_id	= $_POST["departemen_sekolah_id"];
		
?>		
			<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/general_ajax.php','kelas_id','getkelas_departemen_sekolah','idtingkat2')" >
				<option value=""></option>
				<?php select_tingkat_sekolah($departemen_sekolah_id, $row_kelas->idtingkat); ?>
			</select>

<?php		
		break;

	case "get_sekolah_tingkat":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="departemen_sekolah_id" id="departemen_sekolah_id" class="chosen-select form-control" onchange="loadHTMLPost2('../app/general_ajax.php','tingkat_id','getkelas_tingkat_sekolah','departemen_sekolah_id')" >
				<option value=""></option>
				<?php select_sekolah_unit($departemen, ""); ?>
			</select>
<?php
		break;

	case "getsekolah_tingkat1":
		$departemen1	= $_POST["departemen1"];
		
?>		
			<select name="departemen_sekolah_id1" id="departemen_sekolah_id1" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/general_ajax.php','tingkat_id1','getkelas_tingkat_sekolah1','departemen_sekolah_id1')" >
				<option value=""></option>
				<?php select_sekolah_unit($departemen1, ""); ?>
			</select>
<?php
		break;

	case "getkelas_tingkat_sekolah1":
		$departemen_sekolah_id1	= $_POST["departemen_sekolah_id1"];
		
?>		
			<select name="idtingkat3" id="idtingkat3" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/general_ajax.php','kelas_id2','getkelas_departemen_sekolah1','idtingkat3')" >
				<option value=""></option>
				<?php select_tingkat_sekolah($departemen_sekolah_id1, ""); ?>
			</select>

<?php		
		break;

	case "getkelas_departemen_sekolah1":
		$idtingkat3	= $_POST["idtingkat3"];
		
?>		
			<select name="idkelas3" id="idkelas3" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_kelas($idtingkat3, ""); ?>
			</select>
<?php		
		break;

	default:
}
?>