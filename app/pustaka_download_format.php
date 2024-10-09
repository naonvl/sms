<?php
	
    // header yang menunjukkan nama file yang akan didownload
    $file = "BUKU_INDUK_FORMAT.xlsx";
    $size = @filesize("BUKU_INDUK_FORMAT.xlsx");
	
	//$filename="ORL-1019-00002_products_main.jpg";
	$file="format_upload/".$file;
	//$len = @filesize($file); // Calculate File Size

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

