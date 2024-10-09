<?php
	@session_start();

	if (($_SESSION["logged"] == 0)) {
		echo 'Access denied';
		exit;
	}

	include_once ("../app/include/sambung.php");
	include_once ("../app/include/functions.php");
	include_once ("../app/include/inword.php");

	include_once ("../app/class/class.select.php");
	include_once ("../app/class/class.selectview.php");
?>

<!-- PAGE CONTENT BEGINS -->
<form class="form-horizontal" role="form" action="" method="post" name="daftarnilai_input" id="daftarnilai_input" enctype="multipart/form-data" >
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload File</label>
		<div class="col-sm-3">
			<input type="file" name="file" id="file" accept=".csv">
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-3">
			<input type="submit" name="submit" class='btn btn-primary' value="Upload" >
		</div>
	</div>
</form>

<?php
if($_POST["submit"]) {
	$select 	= new select;
	$selectview = new selectview;

	$dbpdo = DB::create();
	
	//function tgl indonesia
	function bulan_indo_to_number($bulan) {
		if($bulan == "Januari") { $bulan_angka = 1; }
		if($bulan == "Februari") { $bulan_angka = 2; }
		if($bulan == "Pebruari") { $bulan_angka = 2; }
		if($bulan == "Maret") { $bulan_angka = 3; }
		if($bulan == "April") { $bulan_angka = 4; }
		if($bulan == "Mei") { $bulan_angka = 5; }
		if($bulan == "Juni") { $bulan_angka = 6; }
		if($bulan == "Juli") { $bulan_angka = 7; }
		if($bulan == "Agustus") { $bulan_angka = 8; }
		if($bulan == "September") { $bulan_angka = 9; }
		if($bulan == "Oktober") { $bulan_angka = 10; }
		if($bulan == "Nopember") { $bulan_angka = 11; }
		if($bulan == "November") { $bulan_angka = 11; }
		if($bulan == "Desember") { $bulan_angka = 12; }
		
		return $bulan_angka;
	}

    $fileName 	= $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
    	    	
    	//$file = fopen($fileName, "r");
    	
    	//cek delimiter (, or ;)
        $filecek = fopen($fileName, "r");        
        $cekcolumn1 = fgetcsv($filecek, 10000, ";");
        $datacol = $cekcolumn1[0];
        //----------------------
       	
       	if (preg_match("/,/",$datacol) == 0) {
       		$file = fopen($fileName, "r");
        	$column = fgetcsv($file, 10000, ";");
		} 
		//echo $datacol;
		if (preg_match("/,/",$datacol) == 1) {
			$file = fopen($fileName, "r");
			$column = fgetcsv($file, 10000, ",");
		}
        
        $jmlnilai = 0;
        $x = 0;
        $insert = 0;
        $update = 0;
        
        if (preg_match("/,/",$datacol) == 0) {
        	while (($column = fgetcsv($file, 20000, ";")) !== FALSE) {
        	        	
        	if($x > 0) {
        		
					$bagian				= 	$column[56];
					$nip				=	$column[2];
					$nip1				=	$column[4];
					$nrk				=	$column[3];
					$nama				=	petikreplace($column[1]);
					$panggilan			=	"";
					$kelamin			=	$column[5];
					if($kelamin == "Laki-laki") {
						$kelamin = "L";
					}
					if($kelamin == "Perempuan") {
						$kelamin = "P";
					}
					$gelar				=	"";
					$tmplahir			=	petikreplace($column[6]);
					$tgllahir			=	date('Y-m-d', strtotime($column[7]));
					$agama				=	petikreplace($column[49]);
					$suku				=	"";
					$nikah				=	"";
		            $jenis_id           =   "";
					$noid				=	"";
					$alamat				=	petikreplace($column[43]);
					$telpon				=	"";
					$handphone			=	"";
					$email				=	petikreplace($column[51]);
					$keterangan			=	"";
					
					$karpeg				=	petikreplace($column[48]);
					$no_sertifikasi		=	"";
					$idjenis_sertifikasi=	"0";
					$npwp				=	petikreplace($column[41]);
					$nuptk				=	petikreplace($column[42]);
					$tmt_cpns			=	date("Y-m-d", strtotime($column[9]));
					$unit_cpns			=	"00:00:00";
					$no_sk_masuk		=	$column[14];			
					$idstatus_pegawai	=	"1";
					$nik				=	petikreplace($column[8]);
					$nama_ibu			=	petikreplace($column[30]);
					$nama_pasangan		=	petikreplace($column[31]);
					$tempat_lahir_pasangan	=	petikreplace($column[33]);
					$tanggal_lahir_pasangan	=	date('Y-m-d', strtotime($column[34]));
					$tanggal_nikah		=	"00:00:00";
					$tempat_nikah		=	"";
					$pekerjaan_pasangan	=	"";
					$instansi_pasangan	=	"";
					$nip_pasangan		=	"";
					$keluarga_tanggungan	=	"0";
					$usia				=	"0";
					$ajar_lain			=	"";
					$jumlah_jam_ajar_lain	=	"0";
					$nama_bank			=	"";
					$unit_bank			=	"";
					$no_rek				=	"";
					$nama_pemilik		=	"";
					$desa				=	"";
					$kecamatan			=	"";
					$kode_pos			=	"";
					$tanggal_pensiun	=	date('Y-m-d', strtotime($column[47]));
					
					$no_sk_tetap		=	petikreplace($column[15]);
					$tanggal_sk_tetap	=	date('Y-m-d', strtotime($column[14]));
					
					$uid				=	'import_'.$_SESSION["loginname"];
					$dlu				=	date("Y-m-d H:i:s");

					$info1 				=	$column[55];
					
					if($nip != "") {
						
						$sqlstr = "select replid from pegawai where nip='$nip'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rowsdata = $sql->rowCount();
						
						if($rowsdata == 0) {
							
							$sqlstr = "insert into pegawai (bagian, nip, nip1, nrk, nama, panggilan, kelamin, gelar, tmplahir, tgllahir, agama, suku, nikah, jenis_id, noid, alamat, telpon, handphone, email, karpeg, no_sertifikasi, idjenis_sertifikasi, npwp, nuptk, tmt_cpns, unit_cpns, no_sk_masuk, idstatus_pegawai, nik, nama_ibu, nama_pasangan, tempat_lahir_pasangan, tanggal_lahir_pasangan, tanggal_nikah, tempat_nikah, pekerjaan_pasangan, instansi_pasangan, nip_pasangan, keluarga_tanggungan, usia, ajar_lain, jumlah_jam_ajar_lain, nama_bank, unit_bank, no_rek, nama_pemilik, desa, kecamatan, kode_pos, tanggal_pensiun, foto_file, keterangan, no_sk_tetap, tanggal_sk_tetap, ts, info1) values ('$bagian', '$nip', '$nip1', '$nrk', '$nama', '$panggilan', '$kelamin', '$gelar', '$tmplahir', '$tgllahir', '$agama', '$suku', '$nikah', '$jenis_id', '$noid', '$alamat', '$telpon', '$handphone', '$email', '$karpeg', '$no_sertifikasi', '$idjenis_sertifikasi', '$npwp', '$nuptk', '$tmt_cpns', '$unit_cpns', '$no_sk_masuk', '$idstatus_pegawai', '$nik', '$nama_ibu', '$nama_pasangan', '$tempat_lahir_pasangan', '$tanggal_lahir_pasangan', '$tanggal_nikah', '$tempat_nikah', '$pekerjaan_pasangan', '$instansi_pasangan', '$nip_pasangan', '$keluarga_tanggungan', '$usia', '$ajar_lain', '$jumlah_jam_ajar_lain', '$nama_bank', '$unit_bank', '$no_rek', '$nama_pemilik', '$desa', '$kecamatan', '$kode_pos', '$tanggal_pensiun', '$foto_file', '$keterangan', '$no_sk_tetap', '$tanggal_sk_tetap', '$dlu', '$info1')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
										
							$insert++;
						} else {
							
							$update++;
						}
						
						
					}				
								
				}
				
				$x++;
			
        	}
		}
		
		$x = 0;
		//===========================KOMA=============================
		if (preg_match("/,/",$datacol) == 1) {
	        while (($column = fgetcsv($file, 20000, ",")) !== FALSE) {
	        	if($x > 0) {
        		
					$bagian				= 	$column[56];
					$nip				=	$column[2];
					$nip1				=	$column[4];
					$nrk				=	$column[3];
					$nama				=	petikreplace($column[1]);
					$panggilan			=	"";
					$kelamin			=	$column[5];
					if($kelamin == "Laki-laki") {
						$kelamin = "L";
					}
					if($kelamin == "Perempuan") {
						$kelamin = "P";
					}
					$gelar				=	"";
					$tmplahir			=	petikreplace($column[6]);
					$tgllahir			=	date('Y-m-d', strtotime($column[7]));
					$agama				=	petikreplace($column[49]);
					$suku				=	"";
					$nikah				=	"";
		            $jenis_id           =   "";
					$noid				=	"";
					$alamat				=	petikreplace($column[43]);
					$telpon				=	"";
					$handphone			=	"";
					$email				=	petikreplace($column[51]);
					$keterangan			=	"";
					
					$karpeg				=	petikreplace($column[48]);
					$no_sertifikasi		=	"";
					$idjenis_sertifikasi=	"0";
					$npwp				=	petikreplace($column[41]);
					$nuptk				=	petikreplace($column[42]);
					$tmt_cpns			=	date("Y-m-d", strtotime($column[9]));
					$unit_cpns			=	"00:00:00";
					$no_sk_masuk		=	$column[14];			
					$idstatus_pegawai	=	"1";
					$nik				=	petikreplace($column[8]);
					$nama_ibu			=	petikreplace($column[30]);
					$nama_pasangan		=	petikreplace($column[31]);
					$tempat_lahir_pasangan	=	petikreplace($column[33]);
					$tanggal_lahir_pasangan	=	date('Y-m-d', strtotime($column[34]));
					$tanggal_nikah		=	"00:00:00";
					$tempat_nikah		=	"";
					$pekerjaan_pasangan	=	"";
					$instansi_pasangan	=	"";
					$nip_pasangan		=	"";
					$keluarga_tanggungan	=	"0";
					$usia				=	"0";
					$ajar_lain			=	"";
					$jumlah_jam_ajar_lain	=	"0";
					$nama_bank			=	"";
					$unit_bank			=	"";
					$no_rek				=	"";
					$nama_pemilik		=	"";
					$desa				=	"";
					$kecamatan			=	"";
					$kode_pos			=	"";
					$tanggal_pensiun	=	date('Y-m-d', strtotime($column[47]));
					
					$no_sk_tetap		=	petikreplace($column[15]);
					$tanggal_sk_tetap	=	date('Y-m-d', strtotime($column[14]));
					
					$uid				=	'import_'.$_SESSION["loginname"];
					$dlu				=	date("Y-m-d H:i:s");

					$info1 				=	$column[55];
					
					if($nip != "") {
						
						$sqlstr = "select replid from pegawai where nip='$nip'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rowsdata = $sql->rowCount();
						
						if($rowsdata == 0) {
							
							$sqlstr = "insert into pegawai (bagian, nip, nip1, nrk, nama, panggilan, kelamin, gelar, tmplahir, tgllahir, agama, suku, nikah, jenis_id, noid, alamat, telpon, handphone, email, karpeg, no_sertifikasi, idjenis_sertifikasi, npwp, nuptk, tmt_cpns, unit_cpns, no_sk_masuk, idstatus_pegawai, nik, nama_ibu, nama_pasangan, tempat_lahir_pasangan, tanggal_lahir_pasangan, tanggal_nikah, tempat_nikah, pekerjaan_pasangan, instansi_pasangan, nip_pasangan, keluarga_tanggungan, usia, ajar_lain, jumlah_jam_ajar_lain, nama_bank, unit_bank, no_rek, nama_pemilik, desa, kecamatan, kode_pos, tanggal_pensiun, foto_file, keterangan, no_sk_tetap, tanggal_sk_tetap, ts, info1) values ('$bagian', '$nip', '$nip1', '$nrk', '$nama', '$panggilan', '$kelamin', '$gelar', '$tmplahir', '$tgllahir', '$agama', '$suku', '$nikah', '$jenis_id', '$noid', '$alamat', '$telpon', '$handphone', '$email', '$karpeg', '$no_sertifikasi', '$idjenis_sertifikasi', '$npwp', '$nuptk', '$tmt_cpns', '$unit_cpns', '$no_sk_masuk', '$idstatus_pegawai', '$nik', '$nama_ibu', '$nama_pasangan', '$tempat_lahir_pasangan', '$tanggal_lahir_pasangan', '$tanggal_nikah', '$tempat_nikah', '$pekerjaan_pasangan', '$instansi_pasangan', '$nip_pasangan', '$keluarga_tanggungan', '$usia', '$ajar_lain', '$jumlah_jam_ajar_lain', '$nama_bank', '$unit_bank', '$no_rek', '$nama_pemilik', '$desa', '$kecamatan', '$kode_pos', '$tanggal_pensiun', '$foto_file', '$keterangan', '$no_sk_tetap', '$tanggal_sk_tetap', '$dlu', '$info1')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
										
							$insert++;
						} else {
							
							$update++;
						}
						
					}				
								
				}
				
				$x++;
			}
		}
    }
?>    

<table align="center" style="font-size: 36px; color: #07581c">
	<tr>
		<td><?php echo "Jumlah Tambah Data : " . $insert; ?></td>
	</tr>
	<tr>
		<td><?php echo "Jumlah Update Data : " . $update; ?></td>
	</tr>
</table>

<?php    
}
?>



