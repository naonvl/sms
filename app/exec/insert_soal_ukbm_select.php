<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
	
	$hs=$insert->insert_soal_ukbm_select();
		
	if($hs){
?>
		<div class="alert alert-success">Save Seleksi Soal UKBM successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Seleksi Soal UKBM Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_soal_ukbm_select($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Seleksi Soal UKBM successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Seleksi Soal UKBM Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_soal_ukbm_select($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Seleksi Soal UKBM successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Seleksi Soal UKBM Error Delete</div>
<?php		

	}
}
?>
