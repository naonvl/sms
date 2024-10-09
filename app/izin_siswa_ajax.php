<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

//include '../app/class/class.select.php';
//$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "getkelas":
		$idtingkat = $_POST["idtingkat"];	
			
?>		
		<!-- <option value=""></option>
		<php select_kelas($idtingkat, ""); ?> -->
		
		<select name="idkelas" id="idkelas" class="chosen-select form-control" onchange="loadHTMLPost2('app/izin_siswa_ajax.php','siswa_id','getsiswa','idkelas')" />
			<option value=""></option>
			<?php select_kelas($idtingkat, ""); ?>
		</select>

<?php	
		break;
	
	case "getsiswa":
		$idkelas = $_POST["idkelas"];	
			
?>		
		<!-- <option value=""></option>
		<php select_siswa($idkelas, ""); ?> -->
		
		<select name="idsiswa" id="idsiswa" class="chosen-select form-control" />
			<option value=""></option>
			<?php select_siswa($idkelas, ""); ?>
		</select>

<?php	

		break;
        				
	default:
	
}
?>