<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Update" ){
	
	$hs=$update->update_surat_masuk_disposisi($_POST['ref']);
	
	if($hs){			
?>
		<div class="alert alert-success">Disposisi Surat Masuk successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Disposisi Surat Masuk Error</div>
<?php		

	}
}

?>
