<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Save" ){
	
    $date	=	date('Y-m-d');
    
    $ref=notran($date, 'frmpinjam_alat', '', '', ''); //---get no ref
    
	$hs=$insert->insert_pinjam_alat($ref);
	
	if($hs){
        
        notran($date, 'frmpinjam_alat', 1, '', '') ; //----eksekusi ref
        
?>
		<div class="alert alert-success">
			<strong>Save Peminjaman Alat successfully</strong>
		</div>
		
		<script>
			document.location.href = "<?php echo $__folder ?><?php echo obraxabrix('pinjam_alat').'/'.$ref ?>";
		</script>
		
<?php					
	}else{
?>
		<div class="alert alert-error">
			<strong>Peminjaman Alat Error Save</strong>
		</div>
<?php		
	}	
}

if ($post == "Update" ){
	$hs=$update->update_pinjam_alat($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Update Peminjaman Alat successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Peminjaman Alat Error Update</strong>
		</div>
<?php		

	}
}


if ($post == "Kembali" ){
	$hs=$update->kembali_pinjam_alat($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Peminjaman Alat Kembali successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Peminjaman Alat Kembali Error Update</strong>
		</div>
<?php		

	}
}

if ($post == "Delete" ){
	$hs=$delete->delete_pinjam_alat($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Delete Peminjaman Alat successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Peminjaman Alat Error Delete</strong>
		</div>
<?php		

	}
}


if ($post == "Checkout" ){
	$hs=$update->update_pinjam_alat($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">
			<strong>Checkout successfully</strong>
		</div>
<?php
	}else{
?>
		<div class="alert alert-error">
			<strong>Checkout Error Update</strong>
		</div>
<?php		

	}
}

?>
