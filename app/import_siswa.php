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
	<br>
	<div class="form-group">
		<div class="col-sm-3">
			<input type="submit" name="submit" class='btn btn-primary' value="Upload" >
			&nbsp;&nbsp;
            <a href="../app/siswa_download_format.php" target="_blank" title="Download Format File">
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
        		
        		$departemen 		=	$column[1];
        		$departemen_sekolah_id=	numberreplace($column[2]);
				$idangkatan			=	numberreplace($column[3]); //numberreplace($column[9]); //2022/2023
				$idangkatan1		=	numberreplace($column[4]); //angkatan
				
				$jalurmasuk			=	"";
				$jalurmasuk_id		=	0;
				/*--------Keterangan pribadi---------*/
				$nis				=	$column[5];
				$nisn				=	"";
				
				$nik				=	petikreplace($column[26]);
				$no_kk				=	petikreplace($column[27]);
				$nama				=	petikreplace($column[7]);
				$panggilan			=	petikreplace($column[8]);
				$idkelas			=	numberreplace($column[10]);
				$tglmasuk			=	"00:00:00";
				$kelamin			=	trim($column[11]);
				$agama				=	$column[14];
				$tmplahir 			=	petikreplace($column[12]);
				//$tgllahir 			=	date('Y-m-d', strtotime($column[13]));
				$tgllahir           	= 	str_replace("/","-",$column[13]);
                $tgllahir           	=   date('Y-m-d', strtotime($tgllahir));

				$warga				=	1;
				$anakke				=	numberreplace($column[28]);
				$jsaudara			=	0;
				$jtiri				=	0;
				$jangkat			=	0;
				$yatim				=	0;
				$bahasa				=	0;
				
				$alamatsiswa		=	petikreplace($column[19]);
				$rtrw				=	""; //explode("/", $column[21]);
				$rt_siswa			=	""; //$rtrw[0];
				$rw_siswa			=	""; //$rtrw[1];
				$dusun				=	"";	
				$desa				=	"";	
				$kecamatan			=	"";
				$alamatortu			=	petikreplace($column[19]);
				$kodepossiswa		=	"";
				$telponsiswa		=	"";
				$hpsiswa			=	"";
				$emailsiswa			=	"";
				$jenistinggal		=	"";
				$kps				=	0;
				$nokps				=	"";
				$kip				=	0;
				$nokip				=	"";
				$namakip			=	"";
				$nokks				=	"";
				$no_akte_lahir		=	"";
				$hptmp = petikreplace($column[20]);
				$hptmp__ = explode("/", $hptmp);
				if(count($hptmp__) > 0) {
					$telponortu			=	$hptmp__[0];
					$hportu				=	$hptmp__[0];
					$hpibu				=	$hptmp__[1];
				} else {
					$telponortu			=	petikreplace($column[20]);
					$hportu				=	petikreplace($column[20]);
					$hpibu				=	"";
				}
				
				$transportasi_kode	=	"";
				$transportasi_lain	=	"";
				$jaraksekolah		=	0;
				$kesekolah			=	0;
				$alumni				=	0;
				
				/*--------Keterangan kesehatan---------*/
				$berat				=	numberreplace($column[29]);
				$tinggi				=	numberreplace($column[30]);
				$kesehatan			=	""; //riwayat penyakit
				$darah				=	petikreplace($column[31]);
				
				$kelainan			=	"";
				
				
				/*--------Keterangan pendidikan sebelumnya---------*/
				$asalsekolah_id		=	petikreplace($column[25]);
				$kota_asalsekolah	=	"";
				$tglijazah			=	"00:00:00";
				$noijazah			=	"";
				$tglskhun			=	"00:00:00";
				$skhun				=	"";
				$noujian			=	""; //$column[6];
				$nisnasal			=	"";
				
				/*--------Keterangan orang tua---------*/
				$nik_ayah			=	"";
				$namaayah			=	petikreplace($column[15]);
				$nik_ibu			=	"";
				$namaibu			=	petikreplace($column[16]);
				$tmplahirayah		=	"";
				$tgllahirayah		=	"00:00:00";
	            $tempat_bekerja_ayah=   "";
	            
				$tmplahiribu		=	"";
				$tgllahiribu		=	"00:00:00";
				$pekerjaanayah		=	petikreplace($column[17]);
				$pekerjaanayah_lain	=	"";
				$pekerjaanibu		=	petikreplace($column[18]);
				$pekerjaanibu_lain	=	"";
	            $tempat_bekerja_ibu =   "";
	            
				$penghasilanayah_kode	=	0;
				$penghasilanayah	=	0;
				$penghasilanibu_kode	=	0;
				$penghasilanibu		=	0;
				
				/*--------pendidikan formal orang tua tertinggi---------*/
				$pendidikanayah		=	"";
				$pendidikanibu		=	"";
				$wnayah				=	"";
				$wnibu				=	"";
				
				/*--------Keterangan wali---------*/
				$nik_wali			=	"";
				$wali				=	petikreplace($column[21]);
				$tmplahirwali		=	"";
				$tgllahirwali		=	"00:00:00";
				$pendidikanwali		=	'0';
				$pekerjaanwali		=	'0';
				$pekerjaanwali_lain	=	petikreplace($column[22]);
				$penghasilanwali_kode	=	0;
				$penghasilanwali	=	0;
	            $tempat_bekerja_wali=   "";
	            
				$alamatwali			=	petikreplace($column[23]);
				$hpwali				=	petikreplace($column[24]);
				$hubungansiswa		=	"";
				
				//new
		        $tahun_ijazah		=	0;
		        $tahunskhun			=	0;
		        $kebutuhan_khusus_chk=	0;
		        $jenis_tinggal		=	"";
		        $kebutuhan_khusus_chk1=	0;
		        $kebutuhan_khusus	=	"";
		        $citacita			=	"";
		        $citacita_lain		=	"";
		        $tahunayah			=	0;
		        $kodeposortu		=	"";
		        $butuhkhususketayah	=	"";
		        $tahunibu			=	0;
		        $kodeposibu			=	"";
		        $butuhkhususibu		=	0;
		        $butuhkhususketibu	=	"";
		        $tahunwali			=	0;
		        $jarak_km			=	0;
		        $waktutempuh		=	0;
		        $waktutempuh_menit	=	0;
		        
		        $almayah			=	'0';
		        $butuhkhususayah	=	0;
		        $almibu				=	'0';
		        $alamatibu			=	"";
		        //------end new
		        
				
				/*--------Lain lain ------*/
				$rombel_id			=	0;
				$nama_bank			=	"";
				$no_rekening_bank	=	"";
				$nama_pemilik_bank	=	"";
				$pip				=	0;
				$alasan_pip			=	"";
				$virtualaccount		=	"";
				$aktif				=	1;
				
				$idminat			=	"";
				
				$jalurmasukprestasi_id = 0;
				$idgugus 			=	0;
				
				$uid				=	'import_'.$_SESSION["loginname"];
				$dlu				=	date("Y-m-d H:i:s");
				
				if($nis != "") {
					
					$sqlstr = "select replid from siswa where nis='$nis' and departemen='$departemen' and departemen_sekolah_id='$departemen_sekolah_id'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdata = $sql->rowCount();
					
					if($rowsdata == 0) {
						
						$sqlstr = "insert into siswa (departemen, departemen_sekolah_id, nis, nisn, nik, no_kk, idangkatan, idangkatan1, foto_file, nama, panggilan, idkelas, tglmasuk, kelamin, tmplahir, tgllahir, agama, warga, anakke, jsaudara, jtiri, jangkat, yatim, bahasa, desa_kode, kecamatan_kode, kota_kode, provinsi_kode, alamatsiswa, rt_siswa, rw_siswa, dusun, desa, kecamatan, kodepossiswa, jenistinggal, alamatortu, telponsiswa, hpsiswa, emailsiswa, telponortu, hportu, hpibu, transportasi_kode, kps, nokps, kip, nokip, namakip, nokks, no_akte_lahir, transportasi_lain, jaraksekolah, kesekolah, berat, tinggi, kesehatan, darah, file_darah, kelainan, asalsekolah_id, kota_asalsekolah, tglijazah, noijazah, tglskhun, skhun, noujian, nisnasal, nik_ayah, namaayah, nik_ibu, namaibu, tmplahirayah, tgllahirayah, tempat_bekerja_ayah, tmplahiribu, tgllahiribu, pekerjaanayah, pekerjaanibu, penghasilanayah_kode, penghasilanayah, penghasilanibu_kode, penghasilanibu, pendidikanayah, pendidikanibu, wnayah, wnibu, nik_wali, wali, tmplahirwali, tgllahirwali, pendidikanwali, pekerjaanwali, penghasilanwali_kode, penghasilanwali, tempat_bekerja_wali, alamatwali, hpwali, hubungansiswa, pekerjaanayah_lain, pekerjaanibu_lain, tempat_bekerja_ibu, pekerjaanwali_lain, rombel_id, nama_bank, no_rekening_bank, nama_pemilik_bank, pip, alasan_pip, idminat, jalurmasuk_id, jalurmasuk, jalurmasukprestasi_id, file_rekam_bk, file_memo_ortu, file_nilai_un, file_raport, file_kk, file_akte, file_ijazah, file_nhun, uid, aktif, ts, tahun_ijazah, tahunskhun, kebutuhan_khusus_chk, jenis_tinggal, kebutuhan_khusus_chk1, kebutuhan_khusus, citacita, citacita_lain, tahunayah, kodeposortu, butuhkhususketayah, tahunibu, kodeposibu, butuhkhususibu, butuhkhususketibu, tahunwali, jarak_km, waktutempuh, waktutempuh_menit, almayah, butuhkhususayah, almibu, alamatibu, alumni, idgugus) values ('$departemen', '$departemen_sekolah_id', '$nis', '$nisn', '$nik', '$no_kk', '$idangkatan', '$idangkatan1', '$foto_file', '$nama', '$panggilan', '$idkelas', '$tglmasuk', '$kelamin', '$tmplahir', '$tgllahir', '$agama', '$warga', '$anakke', '$jsaudara', '$jtiri', '$jangkat', '$yatim', '$bahasa', '$desa_kode', '$kecamatan_kode', '$kota_kode', '$provinsi_kode', '$alamatsiswa', '$rt_siswa', '$rw_siswa', '$dusun', '$desa', '$kecamatan', '$kodepossiswa', '$jenistinggal', '$alamatortu', '$telponsiswa', '$hpsiswa', '$emailsiswa', '$telponortu', '$hportu', '$hpibu', '$transportasi_kode', '$kps', '$nokps', '$kip', '$nokip', '$namakip', '$nokks', '$no_akte_lahir', '$transportasi_lain', '$jaraksekolah', '$kesekolah', '$berat', '$tinggi', '$kesehatan', '$darah', '$file_darah', '$kelainan', '$asalsekolah_id', '$kota_asalsekolah', '$tglijazah', '$noijazah', '$tglskhun', '$skhun', '$noujian', '$nisnasal', '$nik_ayah', '$namaayah', '$nik_ibu', '$namaibu', '$tmplahirayah', '$tgllahirayah', '$tempat_bekerja_ayah', '$tmplahiribu', '$tgllahiribu', '$pekerjaanayah', '$pekerjaanibu', '$penghasilanayah_kode', '$penghasilanayah', '$penghasilanibu_kode', '$penghasilanibu', '$pendidikanayah', '$pendidikanibu', '$wnayah', '$wnibu', '$nik_wali', '$wali', '$tmplahirwali', '$tgllahirwali', '$pendidikanwali', '$pekerjaanwali', '$penghasilanwali_kode', '$penghasilanwali', '$tempat_bekerja_wali', '$alamatwali', '$hpwali', '$hubungansiswa', '$pekerjaanayah_lain', '$pekerjaanibu_lain', '$tempat_bekerja_ibu', '$pekerjaanwali_lain', '$rombel_id', '$nama_bank', '$no_rekening_bank', '$nama_pemilik_bank', '$pip', '$alasan_pip', '$idminat', '$jalurmasuk_id', '$jalurmasuk', '$jalurmasukprestasi_id', '$file_rekam_bk', '$file_memo_ortu', '$file_nilai_un', '$file_raport', '$file_kk', '$file_akte', '$file_ijazah', '$file_nhun', '$uid', '$aktif', '$dlu', '$tahun_ijazah', '$tahunskhun', '$kebutuhan_khusus_chk', '$jenis_tinggal', '$kebutuhan_khusus_chk1', '$kebutuhan_khusus', '$citacita', '$citacita_lain', '$tahunayah', '$kodeposortu', '$butuhkhususketayah', '$tahunibu', '$kodeposibu', '$butuhkhususibu', '$butuhkhususketibu', '$tahunwali', '$jarak_km', '$waktutempuh', '$waktutempuh_menit', '$almayah', '$butuhkhususayah', '$almibu', '$alamatibu', '$alumni', '$idgugus')";
						echo $nis.'>>'.$nama.'>>'.$kelamin.'>>'.$tgllahir.'<br>';
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
																
						$insert++;
					} else {
						$sqlstr = "update siswa set agama='$agama', tgllahir='$tgllahir', telponortu='$telponortu', hportu='$hportu', where nis='$nis' and departemen='$departemen' and departemen_sekolah_id='$departemen_sekolah_id'";
						echo 'update'.'>>'.$nis.'>>'.$nama.'>>'.$kelamin.'>>'.$tgllahir.'<br>';
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
        		
	        		$departemen 		=	$column[1];
	        		$departemen_sekolah_id=	numberreplace($column[2]);
					$idangkatan			=	numberreplace($column[3]); //numberreplace($column[9]); //2022/2023
					$idangkatan1		=	numberreplace($column[4]); //angkatan
					
					$jalurmasuk			=	"";
					$jalurmasuk_id		=	0;
					/*--------Keterangan pribadi---------*/
					$nis				=	$column[5];
					$nisn				=	$column[6];
					
					$nik				=	petikreplace($column[26]);
					$no_kk				=	petikreplace($column[27]);
					$nama				=	petikreplace($column[7]);
					$panggilan			=	petikreplace($column[8]);
					$idkelas			=	numberreplace($column[10]);
					$tglmasuk			=	date("Y-m-d", strtotime(petikreplace($column[39])));
					$tahunmasuk 		=	numberreplace(date("Y", strtotime(petikreplace($column[39]))));
					$kelamin			=	trim($column[11]);
					$agama				=	$column[14];
					$tmplahir 			=	petikreplace($column[12]);
					//$tgllahir 			=	date('Y-m-d', strtotime($column[13]));
					$tgllahir           	= 	str_replace("/","-",$column[13]);
                    $tgllahir           	=   date('Y-m-d', strtotime($tgllahir));

					$warga				=	1;
					
					$anaketmp = petikreplace($column[28]);
					$anake__ = explode("-", $anaketmp);
					if(count($anake__) > 0) {
						$anakke				=	numberreplace($anake__[0]);
						$jsaudara			=	numberreplace($anake__[1]);
					} else {
						$anakke				=	numberreplace($column[28]);
						$jsaudara			=	0;
					}
					
					$jtiri				=	0;
					$jangkat			=	0;
					$yatim				=	0;
					$bahasa				=	0;
					
					$alamatsiswa		=	petikreplace($column[19]);
					$rtrw				=	""; //explode("/", $column[21]);
					$rt_siswa			=	""; //$rtrw[0];
					$rw_siswa			=	""; //$rtrw[1];
					$dusun				=	"";	
					$desa				=	"";	
					$kecamatan			=	"";
					$alamatortu			=	petikreplace($column[19]);
					$kodepossiswa		=	"";
					$telponsiswa		=	"";
					$hpsiswa			=	petikreplace($column[38]);
					$emailsiswa			=	"";
					$jenistinggal		=	"";
					$kps				=	0;
					$nokps				=	"";
					$kip				=	0;
					$nokip				=	"";
					$namakip			=	"";
					$nokks				=	"";
					$no_akte_lahir		=	"";
					$hptmp = petikreplace($column[20]);
					$hptmp__ = explode("/", $hptmp);
					if(count($hptmp__) > 0) {
						$telponortu			=	$hptmp__[0];
						$hportu				=	$hptmp__[0];
						$hpibu				=	$hptmp__[1];
					} else {
						$telponortu			=	petikreplace($column[20]);
						$hportu				=	petikreplace($column[20]);
						$hpibu				=	"";
					}
					
					$transportasi_kode	=	"";
					$transportasi_lain	=	"";
					$jaraksekolah		=	0;
					$kesekolah			=	0;
					$alumni				=	0;
					
					/*--------Keterangan kesehatan---------*/
					$berat				=	numberreplace($column[29]);
					$tinggi				=	numberreplace($column[30]);
					$kesehatan			=	""; //riwayat penyakit
					$darah				=	petikreplace($column[31]);
					
					$kelainan			=	"";
					
					
					/*--------Keterangan pendidikan sebelumnya---------*/
					$asalsekolah_id		=	petikreplace($column[25]);
					$kota_asalsekolah	=	"";
					$tglijazah			=	"00:00:00";
					$noijazah			=	"";
					$tglskhun			=	"00:00:00";
					$skhun				=	"";
					$noujian			=	""; //$column[6];
					$nisnasal			=	"";
					
					/*--------Keterangan orang tua---------*/
					$nik_ayah			=	"";
					$namaayah			=	petikreplace($column[15]);
					$nik_ibu			=	"";
					$namaibu			=	petikreplace($column[16]);
					$tmplahirayah		=	petikreplace($column[32]);
					$tgllahirayah		=	date("Y-m-d", strtotime(petikreplace($column[33])));
		            $tempat_bekerja_ayah=   "";
		            
					$tmplahiribu		=	petikreplace($column[35]);
					$tgllahiribu		=	date("Y-m-d", strtotime(petikreplace($column[36])));
					$pekerjaanayah		=	petikreplace($column[17]);
					$pekerjaanayah_lain	=	"";
					$pekerjaanibu		=	petikreplace($column[18]);
					$pekerjaanibu_lain	=	"";
		            $tempat_bekerja_ibu =   "";
		            
					$penghasilanayah_kode	=	0;
					$penghasilanayah	=	0;
					$penghasilanibu_kode	=	0;
					$penghasilanibu		=	0;
					
					/*--------pendidikan formal orang tua tertinggi---------*/
					$pendidikanayah		=	petikreplace($column[34]);
					$pendidikanibu		=	petikreplace($column[37]);
					$wnayah				=	"";
					$wnibu				=	"";
					
					/*--------Keterangan wali---------*/
					$nik_wali			=	"";
					$wali				=	petikreplace($column[21]);
					$tmplahirwali		=	"";
					$tgllahirwali		=	"00:00:00";
					$pendidikanwali		=	'0';
					$pekerjaanwali		=	'0';
					$pekerjaanwali_lain	=	petikreplace($column[22]);
					$penghasilanwali_kode	=	0;
					$penghasilanwali	=	0;
		            $tempat_bekerja_wali=   "";
		            
					$alamatwali			=	petikreplace($column[23]);
					$hpwali				=	petikreplace($column[24]);
					$hubungansiswa		=	"";
					
					//new
			        $tahun_ijazah		=	0;
			        $tahunskhun			=	0;
			        $kebutuhan_khusus_chk=	0;
			        $jenis_tinggal		=	"";
			        $kebutuhan_khusus_chk1=	0;
			        $kebutuhan_khusus	=	"";
			        $citacita			=	"";
			        $citacita_lain		=	"";
			        $tahunayah			=	0;
			        $kodeposortu		=	"";
			        $butuhkhususketayah	=	"";
			        $tahunibu			=	0;
			        $kodeposibu			=	"";
			        $butuhkhususibu		=	0;
			        $butuhkhususketibu	=	"";
			        $tahunwali			=	0;
			        $jarak_km			=	0;
			        $waktutempuh		=	0;
			        $waktutempuh_menit	=	0;
			        
			        $almayah			=	'0';
			        $butuhkhususayah	=	0;
			        $almibu				=	'0';
			        $alamatibu			=	"";
			        //------end new
			        
					
					/*--------Lain lain ------*/
					$rombel_id			=	0;
					$nama_bank			=	"";
					$no_rekening_bank	=	"";
					$nama_pemilik_bank	=	"";
					$pip				=	0;
					$alasan_pip			=	"";
					$virtualaccount		=	"";
					$aktif				=	1;
					
					$idminat			=	"";
					
					$jalurmasukprestasi_id = 0;
					$idgugus 			=	0;
					
					$uid				=	'import_'.$_SESSION["loginname"];
					$dlu				=	date("Y-m-d H:i:s");
					
					if($nis != "" && $nis != "Column6") {
						
						$sqlstr = "select replid from siswa where nis='$nis' and departemen='$departemen' and departemen_sekolah_id='$departemen_sekolah_id'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						$rowsdata = $sql->rowCount();
						
						if($rowsdata == 0) {
							
							$sqlstr = "insert into siswa (departemen, departemen_sekolah_id, nis, nisn, nik, no_kk, idangkatan, idangkatan1, foto_file, nama, panggilan, idkelas, tglmasuk, tahunmasuk, kelamin, tmplahir, tgllahir, agama, warga, anakke, jsaudara, jtiri, jangkat, yatim, bahasa, desa_kode, kecamatan_kode, kota_kode, provinsi_kode, alamatsiswa, rt_siswa, rw_siswa, dusun, desa, kecamatan, kodepossiswa, jenistinggal, alamatortu, telponsiswa, hpsiswa, emailsiswa, telponortu, hportu, hpibu, transportasi_kode, kps, nokps, kip, nokip, namakip, nokks, no_akte_lahir, transportasi_lain, jaraksekolah, kesekolah, berat, tinggi, kesehatan, darah, file_darah, kelainan, asalsekolah_id, kota_asalsekolah, tglijazah, noijazah, tglskhun, skhun, noujian, nisnasal, nik_ayah, namaayah, nik_ibu, namaibu, tmplahirayah, tgllahirayah, tempat_bekerja_ayah, tmplahiribu, tgllahiribu, pekerjaanayah, pekerjaanibu, penghasilanayah_kode, penghasilanayah, penghasilanibu_kode, penghasilanibu, pendidikanayah, pendidikanibu, wnayah, wnibu, nik_wali, wali, tmplahirwali, tgllahirwali, pendidikanwali, pekerjaanwali, penghasilanwali_kode, penghasilanwali, tempat_bekerja_wali, alamatwali, hpwali, hubungansiswa, pekerjaanayah_lain, pekerjaanibu_lain, tempat_bekerja_ibu, pekerjaanwali_lain, rombel_id, nama_bank, no_rekening_bank, nama_pemilik_bank, pip, alasan_pip, idminat, jalurmasuk_id, jalurmasuk, jalurmasukprestasi_id, file_rekam_bk, file_memo_ortu, file_nilai_un, file_raport, file_kk, file_akte, file_ijazah, file_nhun, uid, aktif, ts, tahun_ijazah, tahunskhun, kebutuhan_khusus_chk, jenis_tinggal, kebutuhan_khusus_chk1, kebutuhan_khusus, citacita, citacita_lain, tahunayah, kodeposortu, butuhkhususketayah, tahunibu, kodeposibu, butuhkhususibu, butuhkhususketibu, tahunwali, jarak_km, waktutempuh, waktutempuh_menit, almayah, butuhkhususayah, almibu, alamatibu, alumni, idgugus) values ('$departemen', '$departemen_sekolah_id', '$nis', '$nisn', '$nik', '$no_kk', '$idangkatan', '$idangkatan1', '$foto_file', '$nama', '$panggilan', '$idkelas', '$tglmasuk', '$tahunmasuk', '$kelamin', '$tmplahir', '$tgllahir', '$agama', '$warga', '$anakke', '$jsaudara', '$jtiri', '$jangkat', '$yatim', '$bahasa', '$desa_kode', '$kecamatan_kode', '$kota_kode', '$provinsi_kode', '$alamatsiswa', '$rt_siswa', '$rw_siswa', '$dusun', '$desa', '$kecamatan', '$kodepossiswa', '$jenistinggal', '$alamatortu', '$telponsiswa', '$hpsiswa', '$emailsiswa', '$telponortu', '$hportu', '$hpibu', '$transportasi_kode', '$kps', '$nokps', '$kip', '$nokip', '$namakip', '$nokks', '$no_akte_lahir', '$transportasi_lain', '$jaraksekolah', '$kesekolah', '$berat', '$tinggi', '$kesehatan', '$darah', '$file_darah', '$kelainan', '$asalsekolah_id', '$kota_asalsekolah', '$tglijazah', '$noijazah', '$tglskhun', '$skhun', '$noujian', '$nisnasal', '$nik_ayah', '$namaayah', '$nik_ibu', '$namaibu', '$tmplahirayah', '$tgllahirayah', '$tempat_bekerja_ayah', '$tmplahiribu', '$tgllahiribu', '$pekerjaanayah', '$pekerjaanibu', '$penghasilanayah_kode', '$penghasilanayah', '$penghasilanibu_kode', '$penghasilanibu', '$pendidikanayah', '$pendidikanibu', '$wnayah', '$wnibu', '$nik_wali', '$wali', '$tmplahirwali', '$tgllahirwali', '$pendidikanwali', '$pekerjaanwali', '$penghasilanwali_kode', '$penghasilanwali', '$tempat_bekerja_wali', '$alamatwali', '$hpwali', '$hubungansiswa', '$pekerjaanayah_lain', '$pekerjaanibu_lain', '$tempat_bekerja_ibu', '$pekerjaanwali_lain', '$rombel_id', '$nama_bank', '$no_rekening_bank', '$nama_pemilik_bank', '$pip', '$alasan_pip', '$idminat', '$jalurmasuk_id', '$jalurmasuk', '$jalurmasukprestasi_id', '$file_rekam_bk', '$file_memo_ortu', '$file_nilai_un', '$file_raport', '$file_kk', '$file_akte', '$file_ijazah', '$file_nhun', '$uid', '$aktif', '$dlu', '$tahun_ijazah', '$tahunskhun', '$kebutuhan_khusus_chk', '$jenis_tinggal', '$kebutuhan_khusus_chk1', '$kebutuhan_khusus', '$citacita', '$citacita_lain', '$tahunayah', '$kodeposortu', '$butuhkhususketayah', '$tahunibu', '$kodeposibu', '$butuhkhususibu', '$butuhkhususketibu', '$tahunwali', '$jarak_km', '$waktutempuh', '$waktutempuh_menit', '$almayah', '$butuhkhususayah', '$almibu', '$alamatibu', '$alumni', '$idgugus')";
							echo $nis.'>>'.$nama.'>>'.$kelamin.'>>'.$tgllahir.'<br>';
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
																	
							$insert++;
						} else {
							$sqlstr = "update siswa set nisn='$nisn', nama='$nama', panggilan='$panggilan',  agama='$agama', tgllahir='$tgllahir', telponortu='$telponortu', hportu='$hportu' where nis='$nis' and departemen='$departemen' and departemen_sekolah_id='$departemen_sekolah_id'";
							echo 'update'.'>>'.$nis.'>>'.$nama.'>>'.$kelamin.'>>'.$tgllahir.'<br>';
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



