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
	
	case "gettingkat":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/siswa_ajax.php','kelas_id','getkelas','idtingkat')" >
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

	
	default:
}
?>