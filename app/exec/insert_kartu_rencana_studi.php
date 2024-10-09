<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_kartu_rencana_studi();
		
	if($hs){
?>
		<div class="alert alert-success">Save Setup Mapel Rapor successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Setup Mapel Rapor Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_kartu_rencana_studi($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Setup Mapel Rapor successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Mapel Rapor Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_kartu_rencana_studi($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Setup Mapel Rapor successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Mapel Rapor Error Delete</div>
<?php		

	}
}
?>
