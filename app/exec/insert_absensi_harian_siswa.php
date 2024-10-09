<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
		
	$ref=$insert->insert_absensi_harian_siswa();
	
	if($ref){
		
?>
		<div class="alert alert-success">Simpan Absensi Izin Siswa successfully</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('rpt_absensi_harian_siswa') ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">Assesmen dan Observasi Error Save</div>
<?php		
	}	
}

if ($post == "Update" ){
	
	$hs=$update->update_rpt_absensi_harian_siswa($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Absensi Izin Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Absensi Izin Siswa Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	
	$hs=$delete->delete_rpt_absensi_harian_siswa($_POST['replid']);
	
	if($hs){			
?>
		<div class="alert alert-success">Hapus Absensi Izin Siswa successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Absensi Izin Siswa Error Hapus</div>
<?php		

	}
}
?>
