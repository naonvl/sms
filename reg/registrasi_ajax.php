<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

$dbpdo = DB::create();

$pilih = $_POST["button"];

switch ($pilih){
	
	case "ceknik":
		$replid		= $_POST["replid"];
		$nik 		= $_POST["nik"];
		
		$sqlstr 	= 	"select nik from calonsiswa where replid<>'$replid' and nik='$nik' limit 1";
		$sql		=	$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 		= 	$sql->fetch(PDO::FETCH_OBJ); 
		$id_code	= 	$data->nik;
				
		if($id_code != '') {
?>		
			<input type="text" id="nik" name="nik" class="form-control" autocomplete="off" value="" <?= $readonly ?> onblur="loadHTMLPost3('registrasi_ajax.php','nik_id','ceknik','replid','nik')" ><font color="#FF0000" size="-1">NIK sudah dipakai !</font>
<?php	
		} else {
?>
			<input type="text" id="nik" name="nik" class="form-control" autocomplete="off" value="<?php echo $nik ?>" <?= $readonly ?> onblur="loadHTMLPost3('registrasi_ajax.php','nik_id','ceknik','replid','nik')" >
<?php
		}
		
		break;
		
	default:
}
?>