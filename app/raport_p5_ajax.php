<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

switch ($pilih){
	case "getkelas":
		$idtingkat	= $_POST["idtingkat_head"];
		
?>		
			<select name="idkelas_head" id="idkelas_head" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_kelas($idtingkat, $idkelas); ?>
			</select>

<?php		
		break;	

	case "getkelas_p5":
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
			<select name="kota_kode" id="kota_kode" class="chosen-select form-control" onChange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','kecamatan','getkecamatan','kota_kode')" >										<option value=""></option>
				<?php select_kota($provinsi_kode, $row_siswa->kota_kode); ?>
			</select>

<?php		
		break;
	
	case "getkota_update":
		$provinsi_kode	= $_POST["provinsi_kode"];		
?>		
			<select name="kota_kode" id="kota_kode" class="chosen-select form-control" onChange="loadHTMLPost2('../../<?php echo $__folder ?>app/raport_p5_ajax.php','kecamatan','getkecamatan_update','kota_kode')" >										
			<option value=""></option>
				<?php select_kota($provinsi_kode, $row_siswa->kota_kode); ?>
			</select>

<?php		
		break;
		
	case "getkecamatan":
		$kota_kode	= $_POST["kota_kode"];
?>		
			<select name="kecamatan_kode" id="kecamatan_kode" class="chosen-select form-control" onChange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','kelurahan','getdesa','kecamatan_kode')" >								<option value=""></option>
					<?php select_kecamatan($kota_kode, $row_siswa->kecamatan_kode); ?>
			</select>
				
				

<?php		
		break;
		
	case "getkecamatan_update":
		$kota_kode	= $_POST["kota_kode"];
?>		
			<select name="kecamatan_kode" id="kecamatan_kode" class="chosen-select form-control" onChange="loadHTMLPost2('../../<?php echo $__folder ?>app/raport_p5_ajax.php','kelurahan','getdesa','kecamatan_kode')" >								<option value=""></option>
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
			<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','kelas_id','getkelas','idtingkat')" >
				<option value=""></option>
				<?php select_tingkat_unit($departemen, ""); ?>
			</select>
<?php
		break;	

	case "gettingkat_upd":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('../app/raport_p5_ajax.php','kelas_id','getkelas','idtingkat')" >
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
			<select name="departemen_sekolah_id" id="departemen_sekolah_id" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','kelas_id','getkelas_unit_sekolah','departemen_sekolah_id')" >
				<option value=""></option>
				<?php select_sekolah_unit($departemen, ""); ?>
			</select>
<?php
		break;

	case "getsekolah_kelas":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="departemen_sekolah_id" id="departemen_sekolah_id" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','tingkat_id','getkelas_sekolah','departemen_sekolah_id')" >
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
		$__folder = $_POST["__folder"];
		
?>		
			<select name="departemen_sekolah_id" id="departemen_sekolah_id" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','tingkat_id','getkelas_tingkat_sekolah','departemen_sekolah_id','__folder')" >
				<option value=""></option>
				<?php select_sekolah_unit($departemen, ""); ?>
			</select>
<?php
		break;

	case "getsekolah_tingkat_setup5":
		$departemen_id	= $_POST["departemen_id"];
		$__folder = $_POST["__folder"];
		
?>		
			<select name="departemen_sekolah_id" id="departemen_sekolah_id" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','id_tingkat','getkelas_tingkat_sekolah_setup5','departemen_sekolah_id','__folder')" >
				<option value=""></option>
				<?php select_sekolah_unit_id($departemen_id, ""); ?>
			</select>
<?php
		break;

	case "getsekolah_tingkat_p5view":
		$departemen	= $_POST["departemen"];
		$__folder = $_POST["__folder"];
		
?>		
			<select name="departemen_sekolah_id" id="departemen_sekolah_id" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','tingkat_id','getkelas_tingkat_sekolah_p5view','departemen_sekolah_id','__folder')" >
				<option value=""></option>
				<?php select_sekolah_unit($departemen, ""); ?>
			</select>
<?php
		break;

	case "getsekolah_tingkat_head":
		$departemen	= $_POST["departemen_head"];
		$__folder = $_POST["__folder"];
		
?>		
			<select name="departemen_sekolah_id_head" id="departemen_sekolah_id_head" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','tingkat_id','getkelas_tingkat_sekolah_head','departemen_sekolah_id_head','__folder')" >
				<option value=""></option>
				<?php select_sekolah_unit($departemen, ""); ?>
			</select>
<?php
		break;

	case "getkelas_tingkat_sekolah":
		$departemen_sekolah_id	= $_POST["departemen_sekolah_id"];
		$__folder = $_POST["__folder"];
		
?>		
			<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','kelas_id','getkelas_departemen_sekolah','idtingkat','__folder')" >
				<option value=""></option>
				<?php select_tingkat_sekolah($departemen_sekolah_id, $row_kelas->idtingkat); ?>
			</select>

<?php		
		break;

	case "getkelas_tingkat_sekolah_setup5":
		$departemen_sekolah_id	= $_POST["departemen_sekolah_id"];
		$__folder = $_POST["__folder"];
		
?>		
			<select name="tingkat_id" id="tingkat_id" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','kelas_id','getkelas_departemen_sekolah_setup5','id_tingkat','__folder')" >
				<option value=""></option>
				<?php select_tingkat_sekolah($departemen_sekolah_id, $row_kelas->idtingkat); ?>
			</select>

<?php		
		break;

	case "getkelas_tingkat_sekolah_p5view":
		$departemen_sekolah_id	= $_POST["departemen_sekolah_id"];
		$__folder = $_POST["__folder"];
		
?>		
			<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','kelas_id','getkelas_departemen_sekolah_p5view','idtingkat','__folder')" >
				<option value=""></option>
				<?php select_tingkat_sekolah($departemen_sekolah_id, $row_kelas->idtingkat); ?>
			</select>

<?php		
		break;

	case "getkelas_tingkat_sekolah_head":
		$departemen_sekolah_id	= $_POST["departemen_sekolah_id_head"];
		$__folder = $_POST["__folder"];
		
?>		
			<select name="idtingkat_head" id="idtingkat_head" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','kelas_id','getkelas_departemen_sekolah_head','idtingkat_head','__folder')" >
				<option value=""></option>
				<?php select_tingkat_sekolah($departemen_sekolah_id, $row_kelas->idtingkat); ?>
			</select>

<?php		
		break;

	case "getkelas_departemen_sekolah":
		$idtingkat2	= $_POST["idtingkat2"];
		$__folder = $_POST["__folder"];
		
?>		
			<select name="idkelas2" id="idkelas2" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_kelas($idtingkat2, ""); ?>
			</select>
<?php		
		break;


	case "getkelas_departemen_sekolah_p5view":
		$idtingkat	= $_POST["idtingkat"];
		$__folder = $_POST["__folder"];
		
?>		
			<select name="idkelas" id="idkelas" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_kelas($idtingkat, ""); ?>
			</select>
<?php		
		break;

	case "getkelas_departemen_sekolah_head":
		$idtingkat2	= $_POST["idtingkat_head"];
?>		
			<select name="idkelas_head" id="idkelas_head" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_kelas($idtingkat2, ""); ?>
			</select>
<?php		
		break;

	case "get_tingkat_sekolah":
		$departemen_sekolah_id	= $_POST["departemen_sekolah_id"];
		
?>		
			<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','kelas_id','getkelas_departemen_sekolah','idtingkat2')" >
				<option value=""></option>
				<?php select_tingkat_sekolah($departemen_sekolah_id, $row_kelas->idtingkat); ?>
			</select>

<?php		
		break;

	case "get_sekolah_tingkat":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="departemen_sekolah_id" id="departemen_sekolah_id" class="chosen-select form-control" onchange="loadHTMLPost2('../app/raport_p5_ajax.php','tingkat_id','getkelas_tingkat_sekolah','departemen_sekolah_id')" >
				<option value=""></option>
				<?php select_sekolah_unit($departemen, ""); ?>
			</select>
<?php
		break;

	
	default:
}
?>