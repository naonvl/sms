<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_deskripsi_raport_p5();
		
	if($hs){
?>
		<div class="alert alert-success">Save Setup Deskripsi Rapor P5 successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Setup Deskripsi Rapor P5 Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_deskripsi_raport_p5($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Setup Deskripsi Rapor P5 successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Deskripsi Rapor P5 Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_deskripsi_raport_p5($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Setup Deskripsi Rapor P5 successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Deskripsi Rapor P5 Error Delete</div>
<?php		

	}
}
?>
