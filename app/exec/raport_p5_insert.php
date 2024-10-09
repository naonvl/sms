<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Simpan" ){
	
    $hs=$insert->insert_raport_p5();
	
	if($hs){
        
?>
		<div class="alert alert-success">
			<strong>Simpan Rapor P5 sukses</strong>
		</div>
		
		<script>
			window.location = '<?php echo $__folder ?><?php echo obraxabrix('raport_p5_view') ?>';
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Simpan Rapor P5 Error</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_raport_p5($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Rapor P5 successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Rapor P5 Error Update</strong>
		</div>
<?php		

	}
}

?>
