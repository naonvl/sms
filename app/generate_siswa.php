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
		<div class="col-sm-3">
			<input type="submit" name="submit" class='btn btn-primary' value="Generate" >
		</div>
	</div>
</form>

<?php
if($_POST["submit"]) {
	
	$dbpdo = DB::create();
	//get pegawai
	$sqlcek 	= 	"select nis, nisn, nik, idangkatan, idangkatan1, departemen, departemen_sekolah_id, foto_file, nama, panggilan, idkelas, tglmasuk, kelamin, tmplahir, tgllahir, agama, warga, anakke, jsaudara, jtiri, jangkat, yatim, bahasa, desa_kode, kecamatan_kode, kota_kode, provinsi_kode, alamatsiswa, rt_siswa, rw_siswa, dusun, desa, kecamatan, kodepossiswa, jenistinggal, alamatortu, telponsiswa, hpsiswa, emailsiswa, telponortu, hportu, hpibu, transportasi_kode, kps, nokps, kip, nokip, namakip, nokks, no_akte_lahir, transportasi_lain, jaraksekolah, kesekolah, berat, tinggi, kesehatan, darah, file_darah, kelainan, asalsekolah_id, kota_asalsekolah, tglijazah, noijazah, tglskhun, skhun, noujian, nisnasal, nik_ayah, namaayah, nik_ibu, namaibu, tmplahirayah, tgllahirayah, tempat_bekerja_ayah, tmplahiribu, tgllahiribu, pekerjaanayah, pekerjaanibu, penghasilanayah_kode, penghasilanayah, penghasilanibu_kode, penghasilanibu, pendidikanayah, pendidikanibu, wnayah, wnibu, nik_wali, wali, tmplahirwali, tgllahirwali, pendidikanwali, pekerjaanwali, penghasilanwali_kode, penghasilanwali, tempat_bekerja_wali, alamatwali, hpwali, hubungansiswa, pekerjaanayah_lain, pekerjaanibu_lain, tempat_bekerja_ibu, pekerjaanwali_lain, rombel_id, nama_bank, no_rekening_bank, nama_pemilik_bank, pip, alasan_pip, idminat, jalurmasuk_id, jalurmasuk, jalurmasukprestasi_id, file_rekam_bk, file_memo_ortu, file_nilai_un, file_raport, file_kk, file_akte, file_ijazah, file_nhun, uid, aktif, ts, tahun_ijazah, tahunskhun, kebutuhan_khusus_chk, jenis_tinggal, kebutuhan_khusus_chk1, kebutuhan_khusus, citacita, citacita_lain, tahunayah, kodeposortu, butuhkhususketayah, tahunibu, kodeposibu, butuhkhususibu, butuhkhususketibu, tahunwali, jarak_km, waktutempuh, waktutempuh_menit, almayah, butuhkhususayah, almibu, alamatibu from siswa_smp order by replid";
	$sqlresult	=	$dbpdo->prepare($sqlcek);
	$sqlresult->execute();
	$insert = 0;
	while($datapeg	=	$sqlresult->fetch(PDO::FETCH_OBJ)) {
		
		//detail
		$strsql = "select replid from siswa where nis='$datapeg->nis'";
		$sqldet=$dbpdo->prepare($strsql);
		$sqldet->execute();
		$rows = $sqldet->rowCount();
		if($rows == 0) {
			echo $datapeg->nis.'>>'.$datapeg->nama.'<br>';
			$tgllahir = "0000-00-00";
			$tglmasuk = "0000-00-00";
			$departemen_sekolah_id = 0;
			$nama = petikreplace($datapeg->nama);
			$ts = date("Y-m-d H:i");
			$sqlstr = "insert into siswa (nis, nisn, nik, idangkatan, idangkatan1, departemen, departemen_sekolah_id, foto_file, nama, panggilan, idkelas, tglmasuk, kelamin, tmplahir, tgllahir, agama, warga, anakke, jsaudara, jtiri, jangkat, yatim, bahasa, desa_kode, kecamatan_kode, kota_kode, provinsi_kode, alamatsiswa, rt_siswa, rw_siswa, dusun, desa, kecamatan, kodepossiswa, jenistinggal, alamatortu, telponsiswa, hpsiswa, emailsiswa, telponortu, hportu, hpibu, transportasi_kode, kps, nokps, kip, nokip, namakip, nokks, no_akte_lahir, transportasi_lain, jaraksekolah, kesekolah, berat, tinggi, kesehatan, darah, file_darah, kelainan, asalsekolah_id, kota_asalsekolah, tglijazah, noijazah, tglskhun, skhun, noujian, nisnasal, nik_ayah, namaayah, nik_ibu, namaibu, tmplahirayah, tgllahirayah, tempat_bekerja_ayah, tmplahiribu, tgllahiribu, pekerjaanayah, pekerjaanibu, penghasilanayah_kode, penghasilanayah, penghasilanibu_kode, penghasilanibu, pendidikanayah, pendidikanibu, wnayah, wnibu, nik_wali, wali, tmplahirwali, tgllahirwali, pendidikanwali, pekerjaanwali, penghasilanwali_kode, penghasilanwali, tempat_bekerja_wali, alamatwali, hpwali, hubungansiswa, pekerjaanayah_lain, pekerjaanibu_lain, tempat_bekerja_ibu, pekerjaanwali_lain, rombel_id, nama_bank, no_rekening_bank, nama_pemilik_bank, pip, alasan_pip, idminat, jalurmasuk_id, jalurmasuk, jalurmasukprestasi_id, file_rekam_bk, file_memo_ortu, file_nilai_un, file_raport, file_kk, file_akte, file_ijazah, file_nhun, uid, aktif, ts, tahun_ijazah, tahunskhun, kebutuhan_khusus_chk, jenis_tinggal, kebutuhan_khusus_chk1, kebutuhan_khusus, citacita, citacita_lain, tahunayah, kodeposortu, butuhkhususketayah, tahunibu, kodeposibu, butuhkhususibu, butuhkhususketibu, tahunwali, jarak_km, waktutempuh, waktutempuh_menit, almayah, butuhkhususayah, almibu, alamatibu) values ('$datapeg->nis', '$datapeg->nisn', '$datapeg->nik', '$datapeg->idangkatan', '$datapeg->idangkatan1', '$datapeg->departemen', '$departemen_sekolah_id', '$datapeg->foto_file', '$nama', '$datapeg->panggilan', '$datapeg->idkelas', '$tglmasuk', '$datapeg->kelamin', '$datapeg->tmplahir', '$tgllahir', '$datapeg->agama', '$datapeg->warga', '$datapeg->anakke', '$datapeg->jsaudara', '$datapeg->jtiri', '$datapeg->jangkat', '$datapeg->yatim', '$datapeg->bahasa', '$datapeg->desa_kode', '$datapeg->kecamatan_kode', '$datapeg->kota_kode', '$datapeg->provinsi_kode', '$datapeg->alamatsiswa', '$datapeg->rt_siswa', '$datapeg->rw_siswa', '$datapeg->dusun', '$datapeg->desa', '$datapeg->kecamatan', '$datapeg->kodepossiswa', '$datapeg->jenistinggal', '$datapeg->alamatortu', '$datapeg->telponsiswa', '$datapeg->hpsiswa', '$datapeg->emailsiswa', '$datapeg->telponortu', '$datapeg->hportu', '$datapeg->hpibu', '$datapeg->transportasi_kode', '$datapeg->kps', '$datapeg->nokps', '$datapeg->kip', '$datapeg->nokip', '$datapeg->namakip', '$datapeg->nokks', '$datapeg->no_akte_lahir', '$datapeg->transportasi_lain', '$datapeg->jaraksekolah', '$datapeg->kesekolah', '$datapeg->berat', '$datapeg->tinggi', '$datapeg->kesehatan', '$datapeg->darah', '$datapeg->file_darah', '$datapeg->kelainan', '$datapeg->asalsekolah_id', '$datapeg->kota_asalsekolah', '$datapeg->tglijazah', '$datapeg->noijazah', '$datapeg->tglskhun', '$datapeg->skhun', '$datapeg->noujian', '$datapeg->nisnasal', '$datapeg->nik_ayah', '$datapeg->namaayah', '$datapeg->nik_ibu', '$datapeg->namaibu', '$datapeg->tmplahirayah', '$datapeg->tgllahirayah', '$datapeg->tempat_bekerja_ayah', '$datapeg->tmplahiribu', '$datapeg->tgllahiribu', '$datapeg->pekerjaanayah', '$datapeg->pekerjaanibu', '$datapeg->penghasilanayah_kode', '$datapeg->penghasilanayah', '$datapeg->penghasilanibu_kode', '$datapeg->penghasilanibu', '$datapeg->pendidikanayah', '$datapeg->pendidikanibu', '$datapeg->wnayah', '$datapeg->wnibu', '$datapeg->nik_wali', '$datapeg->wali', '$datapeg->tmplahirwali', '$datapeg->tgllahirwali', '$datapeg->pendidikanwali', '$datapeg->pekerjaanwali', '$datapeg->penghasilanwali_kode', '$datapeg->penghasilanwali', '$datapeg->tempat_bekerja_wali', '$datapeg->alamatwali', '$datapeg->hpwali', '$datapeg->hubungansiswa', '$datapeg->pekerjaanayah_lain', '$datapeg->pekerjaanibu_lain', '$datapeg->tempat_bekerja_ibu', '$datapeg->pekerjaanwali_lain', '$datapeg->rombel_id', '$datapeg->nama_bank', '$datapeg->no_rekening_bank', '$datapeg->nama_pemilik_bank', '$datapeg->pip', '$datapeg->alasan_pip', '$datapeg->idminat', '$datapeg->jalurmasuk_id', '$datapeg->jalurmasuk', '$datapeg->jalurmasukprestasi_id', '$datapeg->file_rekam_bk', '$datapeg->file_memo_ortu', '$datapeg->file_nilai_un', '$datapeg->file_raport', '$datapeg->file_kk', '$datapeg->file_akte', '$datapeg->file_ijazah', '$datapeg->file_nhun', '$datapeg->uid', '$datapeg->aktif', '$datapeg->ts', '$datapeg->tahun_ijazah', '$datapeg->tahunskhun', '$datapeg->kebutuhan_khusus_chk', '$datapeg->jenis_tinggal', '$datapeg->kebutuhan_khusus_chk1', '$datapeg->kebutuhan_khusus', '$datapeg->citacita', '$datapeg->citacita_lain', '$datapeg->tahunayah', '$datapeg->kodeposortu', '$datapeg->butuhkhususketayah', '$datapeg->tahunibu', '$datapeg->kodeposibu', '$datapeg->butuhkhususibu', '$datapeg->butuhkhususketibu', '$datapeg->tahunwali', '$datapeg->jarak_km', '$datapeg->waktutempuh', '$datapeg->waktutempuh_menit', '$datapeg->almayah', '$datapeg->butuhkhususayah', '$datapeg->almibu', '$datapeg->alamatibu')";
			echo $sqlstr.'<br><br>';
			$sqlx=$dbpdo->prepare($sqlstr);
			$sqlx->execute();
			
			$insert++;
		}
	}
	
?>    

	<table align="center" style="font-size: 36px; color: #07581c">
		<!--<tr>
			<td><?php echo "Jumlah Tambah Data : " . $insert; ?></td>
		</tr>-->
		<tr>
			<td><?php echo "Jumlah Update Data : " . $insert; ?></td>
		</tr>
	</table>

<?php    
}
?>



