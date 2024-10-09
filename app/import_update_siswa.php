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
			&nbsp;&nbsp;
            <a href="../app/siswa_download_dapodik_format.php" target="_blank" title="Download Format File">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Download Format File</label>
			</a>  
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
        		
				/*--------Keterangan pribadi---------*/
				$idangkatan 		=	$column[72]; //tahun ajaran
				$sql="select replid from tahunajaran where tahunajaran='$idangkatan' order by replid";
				$results=$dbpdo->query($sql);
				$row = $results->fetch(PDO::FETCH_OBJ);
				$idangkatan = numberreplace($row->replid);

				$idangkatan1 		=	$column[71]; //angkatan
				$sql="select replid from angkatan where angkatan='$idangkatan1' order by replid";
				$results=$dbpdo->query($sql);
				$row = $results->fetch(PDO::FETCH_OBJ);
				$idangkatan1 = numberreplace($row->replid);	

				$nis				=	$column[2];
				$nisn				=	$column[4];
				$nik				=	$column[60];
				$nama				=	petikreplace($column[1]);
				$tglmasuk			=	date("Y-m-d"); //, strtotime($column[43]));
				$kelamin			=	$column[3];
				$tmplahir			=	$column[5];
				$tgllahir			=	date("Y-m-d", strtotime($column[6]));
				$departemen			=	$column[7];
				$departemen_sekolah_id	=	$column[8];
				$idkelas			=	$column[9];
				$agama				=	$column[10];;
				$warga				=	1;
				$anakke				=	(empty($column[60])) ? 0 : $column[60];
				
				
				/*--------Keterangan tempat tinggal---------*/
				$nama_desa 			=	petikreplace($column[16]);
				$sqlstr = "select kode from desa where nama='$nama_desa'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$data=$sql->fetch(PDO::FETCH_OBJ);				
	            $desa_kode          =	$data->kode;
		        
		        $nama_kec 			=	petikreplace($column[17]);
		        $sqlstr = "select kode from kecamatan where nama='$nama_kec'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$data=$sql->fetch(PDO::FETCH_OBJ);	
	            $kecamatan_kode     =	$data->kode;
	            	        
				$alamatsiswa		=	petikreplace($column[12]);
				$rt_siswa			=	$column[13];
				$rw_siswa			=	$column[14];	
				$dusun				=	$column[15];	
				$desa				=	petikreplace($column[16]);	
				$kecamatan			=	petikreplace($column[17]);	
				$kodepossiswa		=	$column[18];	
				
				$jenis_tinggal		=	$column[19];
				$jenistinggal		=	$column[19];	
				$sql="select a.cde, a.dcr from 
					(select 'A' cde, 'Bersama Orang Tua' dcr, 0 nmr union all 
					select 'B' cde, 'Bersama Wali' dcr, 1 nmr union all
					select 'C' cde, 'Kost' dcr, 3 nmr) a where a.dcr='$jenistinggal' order by a.nmr";
				$results=$dbpdo->query($sql);
				$row = $results->fetch(PDO::FETCH_OBJ);
				$jenistinggal = $row->cde;
	
				$kps				=	$column[25];
				if($kps == "Tidak") {
					$kps = 0;
				}
				if($kps == "Ya") {
					$kps = 1;
				}
				$nokps				=	$column[26];
				$kip				=	$column[48];
				if($kip == "Tidak") {
					$kip = 0;
				}
				if($kip == "Ya") {
					$kip = 1;
				}				
				$nokip				=	$column[47];
				$namakip			=	petikreplace($column[49]);
				$nokks				=	$column[51];
				$no_akte_lahir		=	$column[52];
				$telponsiswa		=	$column[21];
				$hpsiswa			=	$column[22];
				$emailsiswa			=	$column[23];
				$transportasi_kode	=	petikreplace($column[20]);
				$sql="select a.cde, a.dcr from 
					(select 'A' cde, 'JALAN KAKI' dcr, 0 nmr union all 
					select 'B' cde, 'SEPEDA' dcr, 1 nmr union all 
					select 'C' cde, 'MOTOR' dcr, 2 nmr union all 
					select 'D' cde, 'MOBIL PRIBADI' dcr, 3 nmr union all 
					select 'E' cde, 'ANTAR JEMPUT SEKOLAH' dcr, 4 nmr union all 
					select 'F' cde, 'ANGKUTAN UMUM' dcr, 5 nmr union all 
					select 'G' cde, 'LAINNYA' dcr, 7 nmr union all 
					select 'H' cde, 'OJEG' dcr, 6 nmr) a where a.dcr='$transportasi_kode' order by nmr";
				$results=$dbpdo->query($sql);
				$row = $results->fetch(PDO::FETCH_OBJ);
				$transportasi_kode = $row->cde;
					
				$transportasi_lain	=	petikreplace($column[20]);
				$asalsekolah_id		=	0; //petikreplace($column[54]);
				$noijazah			=	$column[47];
				$skhun				=	$column[24];
				$noujian			=	$column[45];
				
				/*--------Keterangan orang tua---------*/
				$nik_ayah			=	$column[32];
				$namaayah			=	petikreplace($column[27]);
				$nik_ibu			=	$column[38];
				$namaibu			=	petikreplace($column[33]);
				$pekerjaanayah		=	petikreplace($column[30]);
				$sql="select replid, pekerjaan from jenispekerjaan where pekerjaan='$pekerjaanayah' order by replid";
				$results=$dbpdo->query($sql);
				$row = $results->fetch(PDO::FETCH_OBJ);
				$pekerjaanayah = $row->replid;
				$pekerjaanayah_lain	=	petikreplace($column[30]);
				
				$pekerjaanibu		=	petikreplace($column[36]);
				$sql="select replid, pekerjaan from jenispekerjaan where pekerjaan='$pekerjaanibu' order by replid";
				$results=$dbpdo->query($sql);
				$row = $results->fetch(PDO::FETCH_OBJ);
				$pekerjaanibu = $row->replid;
				$pekerjaanibu_lain	=	petikreplace($column[36]);
				
		        $kebutuhan_khusus_chk=	$column[58];
		        if($kebutuhan_khusus_chk == "Tidak Ada") {
					$kebutuhan_khusus_chk = 0;
				} else {
					$kebutuhan_khusus_chk = 1;
				}

				$kebutuhan_khusus_chk1 	=	$kebutuhan_khusus_chk;
				
		        $kebutuhan_khusus	=	$column[58];
		        if($kebutuhan_khusus == "Tidak Ada") {
					$kebutuhan_khusus = "";
				}
				
		        $tahunayah			=	$column[28];
		        $tahunibu			=	$column[34];
		        $tahunwali			=	numberreplace($column[40]);
		       
		        $almayah			=	$column[69];
		        if($almayah == "Sudah Meninggal") {
					$almayah = 1;
				} else {
					$almayah = 0;
				}
		        
		        $almibu				=	$column[70];
		        if($almibu == "Sudah Meninggal") {
					$almibu = 1;
				} else {
					$almibu = 0;
				}
				
		        //------end new
		        
		        
				$penghasilanayah_kode	=	$column[31];
				if($penghasilanayah_kode != "") {
					$sql="select replid, penghasilan from penghasilan where penghasilan='$penghasilanayah_kode' order by replid";
					$results=$dbpdo->query($sql);
					$rows=$results->rowCount();
					$row = $results->fetch(PDO::FETCH_OBJ);
					if($rows > 0) {
						$penghasilanayah_kode = numberreplace($row->replid);
					} else {
						$sqlstr="insert into penghasilan(penghasilan) values('$penghasilanayah_kode')";
						$results=$dbpdo->query($sqlstr);
						
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$penghasilanayah_kode = numberreplace($data->last_id);
					}
				} else {
					$penghasilanayah_kode = 0;
				}
				
				$penghasilanibu_kode	=	$column[37];
				if($penghasilanibu_kode != "") {
					$sql="select replid, penghasilan from penghasilan where penghasilan='$penghasilanibu_kode' order by replid";
					$results=$dbpdo->query($sql);
					$rows=$results->rowCount();
					$row = $results->fetch(PDO::FETCH_OBJ);
					if($rows > 0) {
						$penghasilanibu_kode = numberreplace($row->replid);
					} else {
						$sqlstr="insert into penghasilan(penghasilan) values('$penghasilanibu_kode')";
						$results=$dbpdo->query($sqlstr);
						
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$penghasilanibu_kode = numberreplace($data->last_id);
					}
				} else {
					$penghasilanibu_kode = 0;
				}
				
				/*--------Keterangan wali---------*/
				$nik_wali			=	$column[44];
				$wali				=	$column[39];				
				$pekerjaanwali		=	$column[42];
				$sql="select replid, pekerjaan from jenispekerjaan where pekerjaan='$pekerjaanwali' order by replid";
				$results=$dbpdo->query($sql);
				$row = $results->fetch(PDO::FETCH_OBJ);
				$pekerjaanwali = numberreplace($row->replid);
				$pekerjaanwali_lain	=	$column[42];
				$penghasilanwali_kode	=	$column[43];
				if($penghasilanwali_kode != "") {
					$sql="select replid, penghasilan from penghasilan where penghasilan='$penghasilanwali_kode' order by replid";
					$results=$dbpdo->query($sql);
					$rows=$results->rowCount();
					$row = $results->fetch(PDO::FETCH_OBJ);
					if($rows > 0) {
						$penghasilanwali_kode = numberreplace($row->replid);
					} else {
						$sqlstr="insert into penghasilan(penghasilan) values('$penghasilanwali_kode')";
						$results=$dbpdo->query($sqlstr);
						
						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$penghasilanwali_kode = numberreplace($data->last_id);
					}
				} else {
					$penghasilanwali_kode = 0;
				}
				
		        $tempat_bekerja_wali=   ""; //$_POST["tempat_bekerja_wali"];
		        
				$pip				=	$column[56];
				if($pip == "Ya") {
					$pip = 1;
				} else {
					$pip = 0;
				}
				$alasan_pip			=	$column[57];
				$tahunmasuk 		=	date('Y');
				$jsaudara 			=	numberreplace($column[67]);
				$jtiri				=	0;
				$jangkat 			=	0;
				$yatim 				=	0;
				$bahasa 			=	"";
				$jaraksekolah 		=	numberreplace($column[68]);
				$jarak_km 			=	numberreplace($column[68]);
				$berat 				=	numberreplace($column[64]);
				$tinggi				=	numberreplace($column[65]);
				$tglijazah 			=	date('Y-m-d', strtotime($column[73]));
				$tglskhun 			=	date('Y-m-d', strtotime($column[74]));
				$tgllahirayah 		=	"00:00:00";
				$tgllahiribu 		=	"00:00:00";
				$tgllahirwali  		=	"00:00:00";
				$penghasilanayah 	=	0;
				$penghasilanibu 	=	0;
				$penghasilanwali 	=	0;
				$pendidikanwali 	=	0;
				$rombel_id 			=	numberreplace($column[9]);
				$jalurmasuk_id 		=	0;
				$jalurmasukprestasi_id = 0;
				$aktif =	1;
				$dlu 	=	date('Y-m-d H:i');
				$uid 	=	"import";
				$tahun_ijazah = date('Y', strtotime($column[73]));
				$tahunskhun =	date('Y', strtotime($column[74]));
				$butuhkhususibu 	=	0;
				$butuhkhususayah 	=	0;
				$waktutempuh 		=	0;
				$waktutempuh_menit 	=	0;
				$alumni 			=	0;
				$idgugus 			=	0;
				
				if($nis != "" && $nama != "") {

					$sqlstr = "select replid from siswa where nis='$nis' and departemen='$departemen' and departemen_sekolah_id='$departemen_sekolah_id'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdata = $sql->rowCount();
					
					if($rowsdata == 0) {
						
						$sqlstr = "insert into siswa (departemen, departemen_sekolah_id, nis, nisn, nik, no_kk, idangkatan, idangkatan1, foto_file, nama, panggilan, idkelas, tglmasuk, tahunmasuk, kelamin, tmplahir, tgllahir, agama, warga, anakke, jsaudara, jtiri, jangkat, yatim, bahasa, desa_kode, kecamatan_kode, kota_kode, provinsi_kode, alamatsiswa, rt_siswa, rw_siswa, dusun, desa, kecamatan, kodepossiswa, jenistinggal, alamatortu, telponsiswa, hpsiswa, emailsiswa, telponortu, hportu, hpibu, transportasi_kode, kps, nokps, kip, nokip, namakip, nokks, no_akte_lahir, transportasi_lain, jaraksekolah, ketsekolah, berat, tinggi, kesehatan, darah, file_darah, kelainan, asalsekolah_id, kota_asalsekolah, tglijazah, noijazah, tglskhun, skhun, noujian, nisnasal, nik_ayah, namaayah, nik_ibu, namaibu, tmplahirayah, tgllahirayah, tempat_bekerja_ayah, tmplahiribu, tgllahiribu, pekerjaanayah, pekerjaanibu, penghasilanayah_kode, penghasilanayah, penghasilanibu_kode, penghasilanibu, pendidikanayah, pendidikanibu, wnayah, wnibu, nik_wali, wali, tmplahirwali, tgllahirwali, pendidikanwali, pekerjaanwali, penghasilanwali_kode, penghasilanwali, tempat_bekerja_wali, alamatwali, hpwali, hubungansiswa, pekerjaanayah_lain, pekerjaanibu_lain, tempat_bekerja_ibu, pekerjaanwali_lain, rombel_id, nama_bank, no_rekening_bank, nama_pemilik_bank, pip, alasan_pip, idminat, jalurmasuk_id, jalurmasuk, jalurmasukprestasi_id, file_rekam_bk, file_memo_ortu, file_nilai_un, file_raport, file_kk, file_akte, file_ijazah, file_nhun, uid, aktif, ts, tahun_ijazah, tahunskhun, kebutuhan_khusus_chk, jenis_tinggal, kebutuhan_khusus_chk1, kebutuhan_khusus, citacita, citacita_lain, tahunayah, kodeposortu, butuhkhususketayah, tahunibu, kodeposibu, butuhkhususibu, butuhkhususketibu, tahunwali, jarak_km, waktutempuh, waktutempuh_menit, almayah, butuhkhususayah, almibu, alamatibu, alumni, idgugus) values ('$departemen', '$departemen_sekolah_id', '$nis', '$nisn', '$nik', '$no_kk', '$idangkatan', '$idangkatan1', '$foto_file', '$nama', '$panggilan', '$idkelas', '$tglmasuk', '$tahunmasuk', '$kelamin', '$tmplahir', '$tgllahir', '$agama', '$warga', '$anakke', '$jsaudara', '$jtiri', '$jangkat', '$yatim', '$bahasa', '$desa_kode', '$kecamatan_kode', '$kota_kode', '$provinsi_kode', '$alamatsiswa', '$rt_siswa', '$rw_siswa', '$dusun', '$desa', '$kecamatan', '$kodepossiswa', '$jenistinggal', '$alamatortu', '$telponsiswa', '$hpsiswa', '$emailsiswa', '$telponortu', '$hportu', '$hpibu', '$transportasi_kode', '$kps', '$nokps', '$kip', '$nokip', '$namakip', '$nokks', '$no_akte_lahir', '$transportasi_lain', '$jaraksekolah', '$ketsekolah', '$berat', '$tinggi', '$kesehatan', '$darah', '$file_darah', '$kelainan', '$asalsekolah_id', '$kota_asalsekolah', '$tglijazah', '$noijazah', '$tglskhun', '$skhun', '$noujian', '$nisnasal', '$nik_ayah', '$namaayah', '$nik_ibu', '$namaibu', '$tmplahirayah', '$tgllahirayah', '$tempat_bekerja_ayah', '$tmplahiribu', '$tgllahiribu', '$pekerjaanayah', '$pekerjaanibu', '$penghasilanayah_kode', '$penghasilanayah', '$penghasilanibu_kode', '$penghasilanibu', '$pendidikanayah', '$pendidikanibu', '$wnayah', '$wnibu', '$nik_wali', '$wali', '$tmplahirwali', '$tgllahirwali', '$pendidikanwali', '$pekerjaanwali', '$penghasilanwali_kode', '$penghasilanwali', '$tempat_bekerja_wali', '$alamatwali', '$hpwali', '$hubungansiswa', '$pekerjaanayah_lain', '$pekerjaanibu_lain', '$tempat_bekerja_ibu', '$pekerjaanwali_lain', '$rombel_id', '$nama_bank', '$no_rekening_bank', '$nama_pemilik_bank', '$pip', '$alasan_pip', '$idminat', '$jalurmasuk_id', '$jalurmasuk', '$jalurmasukprestasi_id', '$file_rekam_bk', '$file_memo_ortu', '$file_nilai_un', '$file_raport', '$file_kk', '$file_akte', '$file_ijazah', '$file_nhun', '$uid', '$aktif', '$dlu', '$tahun_ijazah', '$tahunskhun', '$kebutuhan_khusus_chk', '$jenis_tinggal', '$kebutuhan_khusus_chk1', '$kebutuhan_khusus', '$citacita', '$citacita_lain', '$tahunayah', '$kodeposortu', '$butuhkhususketayah', '$tahunibu', '$kodeposibu', '$butuhkhususibu', '$butuhkhususketibu', '$tahunwali', '$jarak_km', '$waktutempuh', '$waktutempuh_menit', '$almayah', '$butuhkhususayah', '$almibu', '$alamatibu', '$alumni', '$idgugus')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
																
						$insert++;
					} else {
						$sqlstr = "update siswa set nisn='$nisn', nik='$nik', tglmasuk='$tglmasuk', kelamin='$kelamin', tmplahir='$tmplahir', tgllahir='$tgllahir', agama='$agama', warga='$warga', anakke='$anakke', desa_kode='$desa_kode', kecamatan_kode='$kecamatan_kode', alamatsiswa='$alamatsiswa', rt_siswa='$rt_siswa', rw_siswa='$rw_siswa', dusun='$dusun', desa='$desa', kecamatan='$kecamatan', kodepossiswa='$kodepossiswa', telponsiswa='$telponsiswa', hpsiswa='$hpsiswa', emailsiswa='$emailsiswa', jenistinggal='$jenistinggal', kps='$kps', nokps='$nokps', kip='$kip', nokip='$nokip', namakip='$namakip', nokks='$nokks', no_akte_lahir='$no_akte_lahir', transportasi_kode='$transportasi_kode', transportasi_lain='$transportasi_lain', asalsekolah_id='$asalsekolah_id', noijazah='$noijazah', skhun='$skhun', noujian='$noujian', nik_ayah='$nik_ayah', namaayah='$namaayah', nik_ibu='$nik_ibu', namaibu='$namaibu', pekerjaanayah='$pekerjaanayah', pekerjaanibu='$pekerjaanibu', penghasilanayah_kode='$penghasilanayah_kode', penghasilanibu_kode='$penghasilanibu_kode', nik_wali='$nik_wali', wali='$wali', pekerjaanwali='$pekerjaanwali', penghasilanwali_kode='$penghasilanwali_kode', tempat_bekerja_wali='$tempat_bekerja_wali', pekerjaanayah_lain='$pekerjaanayah_lain', pekerjaanibu_lain='$pekerjaanibu_lain', pekerjaanwali_lain='$pekerjaanwali_lain', pip='$pip', alasan_pip='$alasan_pip', kebutuhan_khusus_chk='$kebutuhan_khusus_chk', jenis_tinggal='$jenis_tinggal', kebutuhan_khusus='$kebutuhan_khusus', tahunayah='$tahunayah', tahunibu='$tahunibu', tahunwali='$tahunwali', almayah='$almayah', almibu='$almibu' where nis='$nis'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
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
        		
					/*--------Keterangan pribadi---------*/
					$idangkatan 		=	$column[72]; //tahun ajaran
					$sql="select replid from tahunajaran where tahunajaran='$idangkatan' order by replid";
					$results=$dbpdo->query($sql);
					$row = $results->fetch(PDO::FETCH_OBJ);
					$idangkatan = numberreplace($row->replid);

					$idangkatan1 		=	$column[71]; //angkatan
					$sql="select replid from angkatan where angkatan='$idangkatan1' order by replid";
					$results=$dbpdo->query($sql);
					$row = $results->fetch(PDO::FETCH_OBJ);
					$idangkatan1 = numberreplace($row->replid);					

					$nis				=	$column[2];
					$nisn				=	$column[4];
					$nik				=	$column[60];
					$nama				=	petikreplace($column[1]);
					$tglmasuk			=	date("Y-m-d"); //, strtotime($column[43]));
					$kelamin			=	$column[3];
					$tmplahir			=	$column[5];
					$tgllahir			=	date("Y-m-d", strtotime($column[6]));
					$departemen			=	$column[7];
					$departemen_sekolah_id	=	$column[8];
					$idkelas			=	$column[9];
					$agama				=	$column[10];;
					$warga				=	1;
					$anakke				=	(empty($column[60])) ? 0 : $column[60];
					
					
					/*--------Keterangan tempat tinggal---------*/
					$nama_desa 			=	petikreplace($column[16]);
					$sqlstr = "select kode from desa where nama='$nama_desa'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$data=$sql->fetch(PDO::FETCH_OBJ);				
		            $desa_kode          =	$data->kode;
			        
			        $nama_kec 			=	petikreplace($column[17]);
			        $sqlstr = "select kode from kecamatan where nama='$nama_kec'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$data=$sql->fetch(PDO::FETCH_OBJ);	
		            $kecamatan_kode     =	$data->kode;
		            	        
					$alamatsiswa		=	petikreplace($column[12]);
					$rt_siswa			=	$column[13];
					$rw_siswa			=	$column[14];	
					$dusun				=	$column[15];	
					$desa				=	petikreplace($column[16]);	
					$kecamatan			=	petikreplace($column[17]);	
					$kodepossiswa		=	$column[18];	
					
					$jenis_tinggal		=	$column[19];
					$jenistinggal		=	$column[19];	
					$sql="select a.cde, a.dcr from 
						(select 'A' cde, 'Bersama Orang Tua' dcr, 0 nmr union all 
						select 'B' cde, 'Bersama Wali' dcr, 1 nmr union all
						select 'C' cde, 'Kost' dcr, 3 nmr) a where a.dcr='$jenistinggal' order by a.nmr";
					$results=$dbpdo->query($sql);
					$row = $results->fetch(PDO::FETCH_OBJ);
					$jenistinggal = $row->cde;
		
					$kps				=	$column[25];
					if($kps == "Tidak") {
						$kps = 0;
					}
					if($kps == "Ya") {
						$kps = 1;
					}
					$nokps				=	$column[26];
					$kip				=	$column[48];
					if($kip == "Tidak") {
						$kip = 0;
					}
					if($kip == "Ya") {
						$kip = 1;
					}				
					$nokip				=	$column[47];
					$namakip			=	petikreplace($column[49]);
					$nokks				=	$column[51];
					$no_akte_lahir		=	$column[52];
					$telponsiswa		=	$column[21];
					$hpsiswa			=	$column[22];
					$emailsiswa			=	$column[23];
					$transportasi_kode	=	petikreplace($column[20]);
					$sql="select a.cde, a.dcr from 
						(select 'A' cde, 'JALAN KAKI' dcr, 0 nmr union all 
						select 'B' cde, 'SEPEDA' dcr, 1 nmr union all 
						select 'C' cde, 'MOTOR' dcr, 2 nmr union all 
						select 'D' cde, 'MOBIL PRIBADI' dcr, 3 nmr union all 
						select 'E' cde, 'ANTAR JEMPUT SEKOLAH' dcr, 4 nmr union all 
						select 'F' cde, 'ANGKUTAN UMUM' dcr, 5 nmr union all 
						select 'G' cde, 'LAINNYA' dcr, 7 nmr union all 
						select 'H' cde, 'OJEG' dcr, 6 nmr) a where a.dcr='$transportasi_kode' order by nmr";
					$results=$dbpdo->query($sql);
					$row = $results->fetch(PDO::FETCH_OBJ);
					$transportasi_kode = $row->cde;
						
					$transportasi_lain	=	petikreplace($column[20]);
					$asalsekolah_id		=	0; //petikreplace($column[54]);
					$noijazah			=	$column[47];
					$skhun				=	$column[24];
					$noujian			=	$column[45];
					
					/*--------Keterangan orang tua---------*/
					$nik_ayah			=	$column[32];
					$namaayah			=	petikreplace($column[27]);
					$nik_ibu			=	$column[38];
					$namaibu			=	petikreplace($column[33]);
					$pekerjaanayah		=	petikreplace($column[30]);
					$sql="select replid, pekerjaan from jenispekerjaan where pekerjaan='$pekerjaanayah' order by replid";
					$results=$dbpdo->query($sql);
					$row = $results->fetch(PDO::FETCH_OBJ);
					$pekerjaanayah = $row->replid;
					$pekerjaanayah_lain	=	petikreplace($column[30]);
					
					$pekerjaanibu		=	petikreplace($column[36]);
					$sql="select replid, pekerjaan from jenispekerjaan where pekerjaan='$pekerjaanibu' order by replid";
					$results=$dbpdo->query($sql);
					$row = $results->fetch(PDO::FETCH_OBJ);
					$pekerjaanibu = $row->replid;
					$pekerjaanibu_lain	=	petikreplace($column[36]);
					
			        $kebutuhan_khusus_chk=	$column[58];
			        if($kebutuhan_khusus_chk == "Tidak Ada") {
						$kebutuhan_khusus_chk = 0;
					} else {
						$kebutuhan_khusus_chk = 1;
					}
					$kebutuhan_khusus_chk1 	=	$kebutuhan_khusus_chk;

			        $kebutuhan_khusus	=	$column[58];
			        if($kebutuhan_khusus == "Tidak Ada") {
						$kebutuhan_khusus = "";
					}
					
			        $tahunayah			=	$column[28];
			        $tahunibu			=	$column[34];
			        $tahunwali			=	numberreplace($column[40]);
			       
			        $almayah			=	$column[69];
			        if($almayah == "Sudah Meninggal") {
						$almayah = 1;
					} else {
						$almayah = 0;
					}
			        
			        $almibu				=	$column[70];
			        if($almibu == "Sudah Meninggal") {
						$almibu = 1;
					} else {
						$almibu = 0;
					}
					
			        //------end new
			        
			        
					$penghasilanayah_kode	=	$column[31];
					if($penghasilanayah_kode != "") {
						$sql="select replid, penghasilan from penghasilan where penghasilan='$penghasilanayah_kode' order by replid";
						$results=$dbpdo->query($sql);
						$rows=$results->rowCount();
						$row = $results->fetch(PDO::FETCH_OBJ);
						if($rows > 0) {
							$penghasilanayah_kode = numberreplace($row->replid);
						} else {
							$sqlstr="insert into penghasilan(penghasilan) values('$penghasilanayah_kode')";
							$results=$dbpdo->query($sqlstr);
							
							$sqlstr 		= 	"select last_insert_id() last_id";
							$results		=	$dbpdo->query($sqlstr);
							$data 			=  	$results->fetch(PDO::FETCH_OBJ);
							$penghasilanayah_kode = numberreplace($data->last_id);
						}
					} else {
						$penghasilanayah_kode = 0;
					}
					
					$penghasilanibu_kode	=	$column[37];
					if($penghasilanibu_kode != "") {
						$sql="select replid, penghasilan from penghasilan where penghasilan='$penghasilanibu_kode' order by replid";
						$results=$dbpdo->query($sql);
						$rows=$results->rowCount();
						$row = $results->fetch(PDO::FETCH_OBJ);
						if($rows > 0) {
							$penghasilanibu_kode = numberreplace($row->replid);
						} else {
							$sqlstr="insert into penghasilan(penghasilan) values('$penghasilanibu_kode')";
							$results=$dbpdo->query($sqlstr);
							
							$sqlstr 		= 	"select last_insert_id() last_id";
							$results		=	$dbpdo->query($sqlstr);
							$data 			=  	$results->fetch(PDO::FETCH_OBJ);
							$penghasilanibu_kode = numberreplace($data->last_id);
						}
					} else {
						$penghasilanibu_kode = 0;
					}
					
					/*--------Keterangan wali---------*/
					$nik_wali			=	$column[44];
					$wali				=	$column[39];				
					$pekerjaanwali		=	$column[42];
					$sql="select replid, pekerjaan from jenispekerjaan where pekerjaan='$pekerjaanwali' order by replid";
					$results=$dbpdo->query($sql);
					$row = $results->fetch(PDO::FETCH_OBJ);
					$pekerjaanwali = numberreplace($row->replid);
					$pekerjaanwali_lain	=	$column[42];
					$penghasilanwali_kode	=	$column[43];
					if($penghasilanwali_kode != "") {
						$sql="select replid, penghasilan from penghasilan where penghasilan='$penghasilanwali_kode' order by replid";
						$results=$dbpdo->query($sql);
						$rows=$results->rowCount();
						$row = $results->fetch(PDO::FETCH_OBJ);
						if($rows > 0) {
							$penghasilanwali_kode = numberreplace($row->replid);
						} else {
							$sqlstr="insert into penghasilan(penghasilan) values('$penghasilanwali_kode')";
							$results=$dbpdo->query($sqlstr);
							
							$sqlstr 		= 	"select last_insert_id() last_id";
							$results		=	$dbpdo->query($sqlstr);
							$data 			=  	$results->fetch(PDO::FETCH_OBJ);
							$penghasilanwali_kode = numberreplace($data->last_id);
						}
					} else {
						$penghasilanwali_kode = 0;
					}
					
			        $tempat_bekerja_wali=   ""; //$_POST["tempat_bekerja_wali"];
			        
					$pip				=	$column[56];
					if($pip == "Ya") {
						$pip = 1;
					} else {
						$pip = 0;
					}
					$alasan_pip			=	$column[57];
					$tahunmasuk 		=	date('Y');
					$jsaudara 			=	numberreplace($column[67]);
					$jtiri				=	0;
					$jangkat 			=	0;
					$yatim 				=	0;
					$bahasa 			=	"";
					$jaraksekolah 		=	numberreplace($column[68]);
					$jarak_km 			=	numberreplace($column[68]);
					$berat 				=	numberreplace($column[64]);
					$tinggi				=	numberreplace($column[65]);
					$tglijazah 			=	date('Y-m-d', strtotime($column[73]));
					$tglskhun 			=	date('Y-m-d', strtotime($column[74]));
					$tgllahirayah 		=	"00:00:00";
					$tgllahiribu 		=	"00:00:00";
					$tgllahirwali  		=	"00:00:00";
					$penghasilanayah 	=	0;
					$penghasilanibu 	=	0;
					$penghasilanwali 	=	0;
					$pendidikanwali 	=	0;
					$rombel_id 			=	numberreplace($column[9]);
					$jalurmasuk_id 		=	0;
					$jalurmasukprestasi_id = 0;
					$aktif =	1;
					$dlu 	=	date('Y-m-d H:i');
					$uid 	=	"import";
					$tahun_ijazah = date('Y', strtotime($column[73]));
					$tahunskhun =	date('Y', strtotime($column[74]));
					$butuhkhususibu 	=	0;
					$butuhkhususayah 	=	0;
					$waktutempuh 		=	0;
					$waktutempuh_menit 	=	0;
					$alumni 			=	0;
					$idgugus 			=	0;
					
					if($nis != "" && $nama != "") {

						$sqlstr = "select replid from siswa where nis='$nis' and departemen='$departemen' and departemen_sekolah_id='$departemen_sekolah_id'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rowsdata = $sql->rowCount();
						
						if($rowsdata == 0) {
							
							$sqlstr = "insert into siswa (departemen, departemen_sekolah_id, nis, nisn, nik, no_kk, idangkatan, idangkatan1, foto_file, nama, panggilan, idkelas, tglmasuk, tahunmasuk, kelamin, tmplahir, tgllahir, agama, warga, anakke, jsaudara, jtiri, jangkat, yatim, bahasa, desa_kode, kecamatan_kode, kota_kode, provinsi_kode, alamatsiswa, rt_siswa, rw_siswa, dusun, desa, kecamatan, kodepossiswa, jenistinggal, alamatortu, telponsiswa, hpsiswa, emailsiswa, telponortu, hportu, hpibu, transportasi_kode, kps, nokps, kip, nokip, namakip, nokks, no_akte_lahir, transportasi_lain, jaraksekolah, ketsekolah, berat, tinggi, kesehatan, darah, file_darah, kelainan, asalsekolah_id, kota_asalsekolah, tglijazah, noijazah, tglskhun, skhun, noujian, nisnasal, nik_ayah, namaayah, nik_ibu, namaibu, tmplahirayah, tgllahirayah, tempat_bekerja_ayah, tmplahiribu, tgllahiribu, pekerjaanayah, pekerjaanibu, penghasilanayah_kode, penghasilanayah, penghasilanibu_kode, penghasilanibu, pendidikanayah, pendidikanibu, wnayah, wnibu, nik_wali, wali, tmplahirwali, tgllahirwali, pendidikanwali, pekerjaanwali, penghasilanwali_kode, penghasilanwali, tempat_bekerja_wali, alamatwali, hpwali, hubungansiswa, pekerjaanayah_lain, pekerjaanibu_lain, tempat_bekerja_ibu, pekerjaanwali_lain, rombel_id, nama_bank, no_rekening_bank, nama_pemilik_bank, pip, alasan_pip, idminat, jalurmasuk_id, jalurmasuk, jalurmasukprestasi_id, file_rekam_bk, file_memo_ortu, file_nilai_un, file_raport, file_kk, file_akte, file_ijazah, file_nhun, uid, aktif, ts, tahun_ijazah, tahunskhun, kebutuhan_khusus_chk, jenis_tinggal, kebutuhan_khusus_chk1, kebutuhan_khusus, citacita, citacita_lain, tahunayah, kodeposortu, butuhkhususketayah, tahunibu, kodeposibu, butuhkhususibu, butuhkhususketibu, tahunwali, jarak_km, waktutempuh, waktutempuh_menit, almayah, butuhkhususayah, almibu, alamatibu, alumni, idgugus) values ('$departemen', '$departemen_sekolah_id', '$nis', '$nisn', '$nik', '$no_kk', '$idangkatan', '$idangkatan1', '$foto_file', '$nama', '$panggilan', '$idkelas', '$tglmasuk', '$tahunmasuk', '$kelamin', '$tmplahir', '$tgllahir', '$agama', '$warga', '$anakke', '$jsaudara', '$jtiri', '$jangkat', '$yatim', '$bahasa', '$desa_kode', '$kecamatan_kode', '$kota_kode', '$provinsi_kode', '$alamatsiswa', '$rt_siswa', '$rw_siswa', '$dusun', '$desa', '$kecamatan', '$kodepossiswa', '$jenistinggal', '$alamatortu', '$telponsiswa', '$hpsiswa', '$emailsiswa', '$telponortu', '$hportu', '$hpibu', '$transportasi_kode', '$kps', '$nokps', '$kip', '$nokip', '$namakip', '$nokks', '$no_akte_lahir', '$transportasi_lain', '$jaraksekolah', '$ketsekolah', '$berat', '$tinggi', '$kesehatan', '$darah', '$file_darah', '$kelainan', '$asalsekolah_id', '$kota_asalsekolah', '$tglijazah', '$noijazah', '$tglskhun', '$skhun', '$noujian', '$nisnasal', '$nik_ayah', '$namaayah', '$nik_ibu', '$namaibu', '$tmplahirayah', '$tgllahirayah', '$tempat_bekerja_ayah', '$tmplahiribu', '$tgllahiribu', '$pekerjaanayah', '$pekerjaanibu', '$penghasilanayah_kode', '$penghasilanayah', '$penghasilanibu_kode', '$penghasilanibu', '$pendidikanayah', '$pendidikanibu', '$wnayah', '$wnibu', '$nik_wali', '$wali', '$tmplahirwali', '$tgllahirwali', '$pendidikanwali', '$pekerjaanwali', '$penghasilanwali_kode', '$penghasilanwali', '$tempat_bekerja_wali', '$alamatwali', '$hpwali', '$hubungansiswa', '$pekerjaanayah_lain', '$pekerjaanibu_lain', '$tempat_bekerja_ibu', '$pekerjaanwali_lain', '$rombel_id', '$nama_bank', '$no_rekening_bank', '$nama_pemilik_bank', '$pip', '$alasan_pip', '$idminat', '$jalurmasuk_id', '$jalurmasuk', '$jalurmasukprestasi_id', '$file_rekam_bk', '$file_memo_ortu', '$file_nilai_un', '$file_raport', '$file_kk', '$file_akte', '$file_ijazah', '$file_nhun', '$uid', '$aktif', '$dlu', '$tahun_ijazah', '$tahunskhun', '$kebutuhan_khusus_chk', '$jenis_tinggal', '$kebutuhan_khusus_chk1', '$kebutuhan_khusus', '$citacita', '$citacita_lain', '$tahunayah', '$kodeposortu', '$butuhkhususketayah', '$tahunibu', '$kodeposibu', '$butuhkhususibu', '$butuhkhususketibu', '$tahunwali', '$jarak_km', '$waktutempuh', '$waktutempuh_menit', '$almayah', '$butuhkhususayah', '$almibu', '$alamatibu', '$alumni', '$idgugus')";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
																	
							$insert++;
						} else {
							$sqlstr = "update siswa set nisn='$nisn', nik='$nik', tglmasuk='$tglmasuk', kelamin='$kelamin', tmplahir='$tmplahir', tgllahir='$tgllahir', agama='$agama', warga='$warga', anakke='$anakke', desa_kode='$desa_kode', kecamatan_kode='$kecamatan_kode', alamatsiswa='$alamatsiswa', rt_siswa='$rt_siswa', rw_siswa='$rw_siswa', dusun='$dusun', desa='$desa', kecamatan='$kecamatan', kodepossiswa='$kodepossiswa', telponsiswa='$telponsiswa', hpsiswa='$hpsiswa', emailsiswa='$emailsiswa', jenistinggal='$jenistinggal', kps='$kps', nokps='$nokps', kip='$kip', nokip='$nokip', namakip='$namakip', nokks='$nokks', no_akte_lahir='$no_akte_lahir', transportasi_kode='$transportasi_kode', transportasi_lain='$transportasi_lain', asalsekolah_id='$asalsekolah_id', noijazah='$noijazah', skhun='$skhun', noujian='$noujian', nik_ayah='$nik_ayah', namaayah='$namaayah', nik_ibu='$nik_ibu', namaibu='$namaibu', pekerjaanayah='$pekerjaanayah', pekerjaanibu='$pekerjaanibu', penghasilanayah_kode='$penghasilanayah_kode', penghasilanibu_kode='$penghasilanibu_kode', nik_wali='$nik_wali', wali='$wali', pekerjaanwali='$pekerjaanwali', penghasilanwali_kode='$penghasilanwali_kode', tempat_bekerja_wali='$tempat_bekerja_wali', pekerjaanayah_lain='$pekerjaanayah_lain', pekerjaanibu_lain='$pekerjaanibu_lain', pekerjaanwali_lain='$pekerjaanwali_lain', pip='$pip', alasan_pip='$alasan_pip', kebutuhan_khusus_chk='$kebutuhan_khusus_chk', jenis_tinggal='$jenis_tinggal', kebutuhan_khusus='$kebutuhan_khusus', tahunayah='$tahunayah', tahunibu='$tahunibu', tahunwali='$tahunwali', almayah='$almayah', almibu='$almibu' where nis='$nis'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
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



