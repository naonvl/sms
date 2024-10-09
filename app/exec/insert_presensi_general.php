<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
	$hs=$insert->insert_presensi_general();
		
	if($hs){
		
?>
		<div class="alert alert-success">Save Presensi PPK successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Presensi PPK Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$insert->insert_presensi_general();
	
	if($hs){			
?>
		<div class="alert alert-success">Update Presensi PPK successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Presensi PPK Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_presensi_ukbm($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Presensi PK successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Presensi PPK Error Delete</div>
<?php		

	}
}
?>
