<?php
include '../app/class/class.insert.php';
include '../app/class/class.update.php';
include '../app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Submit" ){
		
	$tanggal	=	date('Y-m-d', strtotime($_POST["tanggal"]));
	
	//$ref=notran($tanggal, 'frmregistrasi', '', '', ''); //---get no ref
	
	$rgxid=$insert->insert_registrasi_simple($ref);
	
	if($rgxid){

		//notran($tanggal, 'frmregistrasi', 1, '', '') ; //----eksekusi ref
?>
		<div class="alert alert-success">Registrasi Sukses</div>
		
		<script>
			window.location = 'http://158.140.190.252/sims/reg/registrasi_info?rgxid=<?= $rgxid ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">Registrasi Error Save</div>
<?php		
	}	
}

if ($post == "Upload" ){
	
	$hs=$update->update_registrasi_upload($_POST['rgxid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Upload Bukti Transfer Sukses</div>
<?php
	}else{
?>
		<div class="alert alert-error">Upload Bukti Transfer Error</div>
<?php		

	}
}

if ($post == "Upload Berkas" ){
	
	$hs=$update->update_registrasi_upload_berkas($_POST['rgxid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Upload Berkas Sukses</div>
<?php
	}else{
?>
		<div class="alert alert-error">Upload Berkas Error</div>
<?php		

	}
}

if ($post == "Update" ){
	
	$hs=$update->update_registrasi($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Registrasi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Registrasi Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_registrasi($_POST['replid']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Registrasi successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Registrasi Error Delete</div>
<?php		

	}
}
?>
