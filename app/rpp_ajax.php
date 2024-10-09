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
				<?php select_kelas($idtingkat, $idkelas); ?>
			</select>

<?php		
		break;	

	case "getkelas2":
		$idtingkat	= $_POST["idtingkat2"];
		
?>		
			<select name="idkelas2" id="idkelas2" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_kelas($idtingkat, $idkelas2); ?>
			</select>

<?php		
		break;	


	case "gettingkat_list":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('app/rpp_ajax.php','kelas_id','getkelas','idtingkat')" >
				<option value=""></option>
				<?php select_tingkat_unit($departemen, ""); ?>
			</select>	
<?php
		break;	

	case "gettingkat_list2":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="idtingkat2" id="idtingkat2" class="chosen-select form-control" onchange="loadHTMLPost2('app/rpp_ajax.php','kelas_id','getkelas2','idtingkat2')" >
				<option value=""></option>
				<?php select_tingkat_unit($departemen, $idtingkat2); ?>
			</select>		
<?php
		break;	

	case "getsemester":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="idsemester" id="idsemester" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_semester_all($departemen, "") ?>
			</select>		
<?php
		break;	
	
	default:
}
?>