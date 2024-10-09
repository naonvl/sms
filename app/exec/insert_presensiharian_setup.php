<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$hs=$insert->insert_presensiharian_setup();
		
	if($hs){
?>
		<div class="alert alert-success">Save Setup Presensi Harian Siswa successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Setup Presensi Harian Siswa Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_presensiharian_setup($_POST['id']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Setup Presensi Harian Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Presensi Harian Siswa Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_presensiharian_setup($_POST['id']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Setup Presensi Harian Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Setup Presensi Harian Siswa Error Delete</div>
<?php		

	}
}
?>
