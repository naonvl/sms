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


		<select name="idkelas" id="idkelas" class="chosen-select form-control" onchange="loadHTMLPost2('app/pelanggaran_siswa_ajax.php','siswa_id','getsiswa','idkelas')" >
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

		<select name="idsiswa" id="idsiswa" class="chosen-select form-control" >
			<option value=""></option>
			<?php select_siswa($idkelas, ""); ?>
		</select>	
		

<?php	
		break;

	case "gettingkat_list":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/pelanggaran_siswa_ajax.php','kelas_id','getkelas','idtingkat')" >
				<option value=""></option>
				<?php select_tingkat_unit($departemen, $idtingkat2); ?>
			</select>	
<?php
		break;	
				
	default:
	
}
?>