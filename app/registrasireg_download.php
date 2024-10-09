<?php
	include("include/sambung.php");
	
	$dbpdo = DB::create();
	
    // membaca id file dari link
    $ref = $_REQUEST['ref'];
    $type = $_REQUEST['type'];
 	
    // membaca informasi file dari tabel berdasarkan id nya
    if($type == 1) {
    	$query  = "select info3 from calonsiswa where replid='$ref'";
	    $hasil  = $dbpdo->prepare($query);
	    $hasil->execute();
	    $data = $hasil->fetch(PDO::FETCH_OBJ);

	    $file = $data->info3;
	    $size = @filesize($data->info3);

	    $file="file_transfer_registrasi/".$file;
		
    }
    if($type == 2) {
    	$query  = "select file_kk from calonsiswa where replid='$ref'";
	    $hasil  = $dbpdo->prepare($query);
	    $hasil->execute();
	    $data = $hasil->fetch(PDO::FETCH_OBJ);

	    $file = $data->file_kk;
	    $size = @filesize($data->file_kk);

	    $file="file_kk/".$file;
		
    }
    if($type == 3) {
    	$query  = "select file_akte from calonsiswa where replid='$ref'";
	    $hasil  = $dbpdo->prepare($query);
	    $hasil->execute();
	    $data = $hasil->fetch(PDO::FETCH_OBJ);

	    $file = $data->file_akte;
	    $size = @filesize($data->file_akte);

	    $file="file_akte/".$file;
		
    }
    if($type == 4) {
    	$query  = "select file_ktp from calonsiswa where replid='$ref'";
	    $hasil  = $dbpdo->prepare($query);
	    $hasil->execute();
	    $data = $hasil->fetch(PDO::FETCH_OBJ);

	    $file = $data->file_ktp;
	    $size = @filesize($data->file_ktp);

	    $file="file_ktp/".$file;
		
    }
    if($type == 5) {
    	$query  = "select file_memo_ortu from calonsiswa where replid='$ref'";
	    $hasil  = $dbpdo->prepare($query);
	    $hasil->execute();
	    $data = $hasil->fetch(PDO::FETCH_OBJ);

	    $file = $data->file_memo_ortu;
	    $size = @filesize($data->file_memo_ortu);

	    $file="file_memo_ortu/".$file;
		
    }
    if($type == 6) {
    	$query  = "select file_raport from calonsiswa where replid='$ref'";
	    $hasil  = $dbpdo->prepare($query);
	    $hasil->execute();
	    $data = $hasil->fetch(PDO::FETCH_OBJ);

	    $file = $data->file_raport;
	    $size = @filesize($data->file_raport);

	    $file="file_raport/".$file;
		
    }

    //file_raport, file_kk, file_akte, file_ktp, file_memo_ortu	
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.basename($file));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: private');
	header('Pragma: private');
	header('Content-Length: ' . filesize($file));
	ob_clean();
	flush();
	readfile($file);

	exit;

	
?>

