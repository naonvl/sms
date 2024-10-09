<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];

switch ($pilih){
	case "gettahunajaran":
		$departemen	= $_POST["departemen"];
		
?>		
			<select name="idtahunajaran" id="idtahunajaran" class="chosen-select form-control" >
				<option value=""></option>
				<?php select_thnajaran_unit($departemen, ""); ?>
			</select>	
<?php
		break;	

	
	default:
}
?>