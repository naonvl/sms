<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

$dbpdo = DB::create();

$pilih = $_POST["button"];

switch ($pilih){
	
	case "cekuser":
		$id			= $_POST["id"];
		$usrid 		= $_POST["usrid"];
		$__folder 	= $_POST["__folder"];
		
		$sqlstr 	= 	"select usrid from usr where usrid='$usrid' limit 1";
		$sql		=	$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 		= 	$sql->fetch(PDO::FETCH_OBJ); 
		$id_code	= 	$data->usrid;

		if($id_code != '') {
?>		
			<input type="text" id="usrid" name="usrid" placeholder="User ID" class="col-xs-10 col-sm-3" autocomplete="off" value="" onblur="loadHTMLPost4('<?= $__folder ?>app/usr_ajax.php','user_id','cekuser','id','usrid','__folder')" ><font color="#FF0000" size="-1">&nbsp; User ID sudah dipakai !</font>
<?php	
		} else {
?>
			<input type="text" id="usrid" name="usrid" placeholder="User ID" class="col-xs-10 col-sm-3" autocomplete="off" value="<?php echo $usrid ?>" onblur="loadHTMLPost4('<?= $__folder ?>app/usr_ajax.php','user_id','cekuser','id','usrid','__folder')" >
<?php
		}
		
		break;

	case "cekuser_update":
		$id			= $_POST["id"];
		$usrid 		= $_POST["usrid"];
		$__folder 	= $_POST["__folder"];
		
		$sqlstr 	= 	"select usrid from usr where id<>'$id' and usrid='$usrid' limit 1";
		$sql		=	$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 		= 	$sql->fetch(PDO::FETCH_OBJ); 
		$id_code	= 	$data->usrid;

		if($id_code != '') {
?>		
			<input type="text" id="usrid" name="usrid" placeholder="User ID" class="col-xs-10 col-sm-3" autocomplete="off" value="" onblur="loadHTMLPost4('<?= $__folder ?>app/usr_ajax.php','user_id','cekuser_update','id','usrid','__folder')" ><font color="#FF0000" size="-1">&nbsp; User ID sudah dipakai !</font>
<?php	
		} else {
?>
			<input type="text" id="usrid" name="usrid" placeholder="User ID" class="col-xs-10 col-sm-3" autocomplete="off" value="<?php echo $usrid ?>" onblur="loadHTMLPost3('<?= $__folder ?>app/usr_ajax.php','user_id','cekuser_update','id','usrid','__folder')" >
<?php
		}
		
		break;
		
	default:
}
?>