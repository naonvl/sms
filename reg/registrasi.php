<?php
	session_start();
	error_reporting(E_ALL & ~E_NOTICE);
	ob_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Sekolah Yayasan</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.2.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="../assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="../assets/css/chosen.min.css" />
		<link rel="stylesheet" href="../assets/css/datepicker.min.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="../assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="../assets/css/colorpicker.min.css" />
		<link rel="stylesheet" href="../assets/fonts/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<script type="text/javascript" src="../js/buttonajax.js"></script>

		<!----finance only------>
		<script src="../app/finance/script/tooltips.js" language="javascript"></script>
		<script src="../app/finance/script/tools.js" language="javascript"></script>
		<!------------------------->

		<link rel="stylesheet" href="../lightbox/lightbox.css" type="text/css" media="screen" />
		<script type="text/javascript" src="../lightbox/lightbox.js"></script>

		<style type="text/css">
			.text-radius{
				border-radius: 25px;
			}
		</style>
	</head>

	<script language="javascript">
		function cekinput(fid) {  
			var arrf = fid.split(',');
			for(i=0; i < arrf.length; i++) {
				if(document.getElementById(arrf[i]).value=='') {       

					if (document.getElementById(arrf[i]).name=='departemen') {
						alert('Unit tidak boleh kosong!');				
					}

					if (document.getElementById(arrf[i]).name=='tanggal') {
						alert('Tanggal tidak boleh kosong!');				
					}

					if (document.getElementById(arrf[i]).name=='nopendaftaran') {
						alert('No Pendaftaran tidak boleh kosong!');				
					}

					if (document.getElementById(arrf[i]).name=='nama') {
						alert('Nama Lengkap tidak boleh kosong!');				
					}

					if (document.getElementById(arrf[i]).name=='kelamin') {
						alert('Jenis Kelamin tidak boleh kosong!');				
					}

					return false
				} 

			}		 

			var rgxid = document.getElementById('rgxid').value;
			if(rgxid == "") {
				var nik = document.getElementById('nik').value;
				if(nik == "") {
					alert("No. Induk Kependudukan (NIK) tidak boleh kosong !!!");
					return false;
				}
				var idkelompok = document.getElementById('idkelompok').value;
				if(idkelompok == "") {
					alert("Jalur Masuk tidak boleh kosong !!!");
					return false;
				}
				var foto_file = document.getElementById('foto_file').value;
				if(foto_file == "") {
					alert("Foto Calon Siswa tidak boleh kosong !!!");
					return false;
				}
				var tmplahir = document.getElementById('tmplahir').value;
				if(tmplahir == "") {
					alert("Tempat Lahir Calon Siswa tidak boleh kosong !!!");
					return false;
				}
				var tgllahir = document.getElementById('tgllahir').value;
				if(tgllahir == "") {
					alert("Tanggal Lahir Calon Siswa tidak boleh kosong !!!");
					return false;
				}
				var agama = document.getElementById('agama').value;
				if(agama == "") {
					alert("Agama Calon Siswa tidak boleh kosong !!!");
					return false;
				}
				var alamatsiswa = document.getElementById('alamatsiswa').value;
				if(alamatsiswa == "") {
					alert("Alamat tidak boleh kosong !!!");
					return false;
				}
				var kodepossiswa = document.getElementById('kodepossiswa').value;
				if(kodepossiswa == "") {
					alert("Kode Pos tidak boleh kosong !!!");
					return false;
				}
				var hpsiswa = document.getElementById('hpsiswa').value;
				if(hpsiswa == "") {
					alert("Nomor HP tidak boleh kosong !!!");
					return false;
				}
				var emailsiswa = document.getElementById('emailsiswa').value;
				if(emailsiswa == "") {
					alert("E-mail tidak boleh kosong !!!");
					return false;
				}
			}
		}
			
	</script>

	<script type="text/javascript">
		function validasiFile(filename){
		    var inputFile = document.getElementById(''+filename+'');
		    var pathFile = inputFile.value;
		    var ekstensiOk = /(\.jpg|.png)$/i;
		    if(!ekstensiOk.exec(pathFile)){
		        alert('Silakan upload file yang memiliki ekstensi .jpg|.png');
		        inputFile.value = '';
		        return false;
		    }else{
		        //Pratinjau gambar
		        if (inputFile.files && inputFile.files[0]) {
		            var reader = new FileReader();
		            reader.onload = function(e) {
		                document.getElementById('pratinjauGambar').innerHTML = '<img src="'+e.target.result+'"/>';
		            };
		            reader.readAsDataURL(inputFile.files[0]);
		        }
		    }
		}
	</script>

	<script type="text/javascript">
		function validasiFile2(filename){
		    var inputFile = document.getElementById(''+filename+'');
		    var pathFile = inputFile.value;
		    var ekstensiOk = /(\.jpg|.png|.pdf)$/i;
		    if(!ekstensiOk.exec(pathFile)){
		        alert('Silakan upload file yang memiliki ekstensi .jpg|.png|.pdf');
		        inputFile.value = '';
		        return false;
		    }else{
		        //Pratinjau gambar
		        if (inputFile.files && inputFile.files[0]) {
		            var reader = new FileReader();
		            reader.onload = function(e) {
		                document.getElementById('pratinjauGambar').innerHTML = '<img src="'+e.target.result+'"/>';
		            };
		            reader.readAsDataURL(inputFile.files[0]);
		        }
		    }
		}
	</script>

	<script>
		function formatangka(field) {
			 //a = rci.amt.value;	 
			 a = document.getElementById(field).value;
			 //alert(a);
			 b = a.replace(/[^\d-.]/g,""); //b = a.replace(/[^\d]/g,"");
			 c = "";
			 panjang = b.length;
			 j = 0;
			 for (i = panjang; i > 0; i--)
			 {
				 j = j + 1;
				 if (((j % 3) == 1) && (j != 1))
				 {
				 	c = b.substr(i-1,1) + "," + c;
				 } else {
				 	c = b.substr(i-1,1) + c;
				 }
			 }
			 //rci.amt.value = c;
			 c = c.replace(",.",".");
			 c = c.replace(".,",".");
			 document.getElementById(field).value = c;		
			 
		}
	</script>

	<script type="text/javascript">
		var request;
		var dest;
		
		function loadHTMLPost2(URL, destination, button, getId){
			dest = destination;	
			str = getId + '=' + document.getElementById(getId).value;		
			//str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
			var str = str + '&button=' + button;
			
			if (window.XMLHttpRequest){
				request = new XMLHttpRequest();
				request.onreadystatechange = processStateChange;
				request.open("POST", URL, true);
				request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
				request.send(str);		
						
			} else if (window.ActiveXObject) {
				request = new ActiveXObject("Microsoft.XMLHTTP");
				if (request) {
					request.onreadystatechange = processStateChange;
					request.open("POST", URL, true);
					request.send();				
				}
			}
					
		}
		 
	</script>

	<script type="text/javascript">
		<!--
		var request;
		var dest;
		
		function loadHTMLPost3(URL, destination, button, getId, getId2){
			dest = destination;	
			str = getId + '=' + document.getElementById(getId).value;
			str2 = getId2 + '=' + document.getElementById(getId2).value;
			
			var str = str + '&button=' + button;
			var str2 = str2 + '&button=' + button;
			var str = str + '&' + str2;
			
			if (window.XMLHttpRequest){
				request = new XMLHttpRequest();
				request.onreadystatechange = processStateChange;
				request.open("POST", URL, true);
				request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
				request.send(str);		
			} else if (window.ActiveXObject) {
				request = new ActiveXObject("Microsoft.XMLHTTP");
				if (request) {
					request.onreadystatechange = processStateChange;
					request.open("POST", URL, true);
					request.send();
				}
			}
		}
				
		//-->		 
		
	</script>

	<?php
		include("../app/include/sambung.php");
		include("../app/include/functions.php");

		include("../app/class/class.select.php");

		$select = new select;
	?>          
	
	<body>

		<div class="page-content">
		      
			<div class="row">
				<div class="col-xs-12">
		            
		            <?php 
		            	$rgxid = $_SESSION["token"];
		            	$unit = $_GET['unit'];
		            	
						$ref = ""; //$segmen3; //$_GET['search'];
						//jika saat add data, maka data setelah save kosong
						if ($_POST['submit'] == 'Simpan') { $ref = ''; }
						//-----------------------------------------------/\
						
						$ref2 = notran(date('y-m-d'), 'frmregistrasi', '', '', ''); //---get no ref
						
						include("exec/insert_registrasi.php"); 
						
						$tanggal	= date("d-m-Y");
						$almayah = "";
						$almibu = "";
						$tgllahir = "";
						$kebutuhan_khusus_chk1 = "checked";
								
					?>
		            
					<!-- PAGE CONTENT BEGINS -->
					<form action="" method="post" name="registrasi" id="registrasi" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('tanggal,nopendaftaran,nama,kelamin');">
		            	
		            	<input type="hidden" id="replid" name="replid" value="<?php echo $registrasi->replid ?>" >
		            	<input type="hidden" id="rgxid" name="rgxid" value="<?php echo $rgxid ?>" >
		            	<input type="hidden" id="departemen_sekolah_id" name="departemen_sekolah_id" value="<?php echo $unit ?>" >
		            	
		            	<?php 
		            		$readonly = "";
		            		$disabled = "";

		            		if($rgxid && $unit== '') {
			            		$sqlreg = $select->list_registrasi('', '', $rgxid);
			            		$datareg = $sqlreg->fetch(PDO::FETCH_OBJ);
			            		$ref = $datareg->replid;
			            		$bukti_transfer = $datareg->info3;
			            		$unit = $datareg->departemen_sekolah_id;
			            		$departemen = $datareg->departemen;
			            		$nik = $datareg->nik;
			            		$idproses = $datareg->idproses;
			            		$tanggal = $datareg->tanggal;
			            		$idkelompok = $datareg->idkelompok;
			            		$foto_file = $datareg->foto_file;
			            		$nama = $datareg->nama;
			            		$panggilan = $datareg->panggilan;
			            		$tmplahir = $datareg->tmplahir;
			            		$tgllahir = $datareg->tgllahir;
			            		$kelamin = $datareg->kelamin;
			            		$agama = $datareg->agama;
			            		$alamatsiswa = $datareg->alamatsiswa;
			            		$kodepossiswa = $datareg->kodepossiswa;
			            		$hpsiswa = $datareg->hpsiswa;
			            		$telponsiswa = $datareg->telponsiswa;
			            		$emailsiswa = $datareg->emailsiswa;
			            		$verifikasi = $datareg->verifikasi;

			            		$file_raport = $datareg->file_raport;
			            		$file_memo_ortu = $datareg->file_memo_ortu;
			            		$file_ktp = $datareg->file_ktp;
			            		$file_akte = $datareg->file_akte;
			            		$file_kk = $datareg->file_kk;

			            		$lulus = $datareg->lulus;
			            	}

			            	if($departemen == "") {
			            		$rgxid = "";
			            	}

		            		if($rgxid == "" || $bukti_transfer == "" || $verifikasi == 0) {
		            			$sql = $select->get_departemen_sekolah($unit);
		            			$registrasi = $sql->fetch(PDO::FETCH_OBJ);
		            			$departemen = $registrasi->departemen;
		            			$agama = "Islam";
		            			$tanggal_awal 	= $registrasi->tanggal_awal;
		            			$tanggal_akhir 	= $registrasi->tanggal_akhir;
		            			$proteksi_regsitrasi = 0;
		            			if( date("Y-m-d H:i") >= $tanggal_awal && date("Y-m-d H:i") <= $tanggal_akhir) {
		            				$proteksi_regsitrasi = 1;
		            			}

		            			##cek registrasi verifikasi
		            			$sqlverif = $select->get_registrasi_verifikasi($unit);
		            			$jumlahverif =  numberreplace($sqlverif->rowCount());
		            	?>	
		            			<div class="col-sm-6">		
		            				<div class="row" style="padding-bottom: 10px;">
		            					<div class="widget-header widget-header-flat" style="text-align: center;">
											<h4 class="widget-title" style="font-weight: bold; color: green">
												<?php if($rgxid == "" && $unit) { ?>
													FORM PENDAFTARAN
												<?php 
													} else if($rgxid && $unit) { 
														$readonly = "readonly";
														$disabled = "disabled";
												?>
													DATA REGISTRASI<br>
													<?= $registrasi->nama ?>
													<?= $registrasi->alamat ?>

													<?php if($bukti_transfer != "") { ?>
														<div class="alert alert-success">
															<i class="ace-icon fa fa-hand-o-right"></i>
															Menunggu Verifikasi Pembayaran<br>
															Dalam waktu 1 x 24 jam
														</div>
													<?php } ?>
												<?php } ?>
											</h4>
										</div>
		            				</div>	
		            				<?php if($rgxid == "" && $unit != "") { ?>
			            				<div class="row" style="padding-bottom: 10px;">
			            					<div class="widget-header widget-header-flat" style="text-align: left;">
												<h4 class="widget-title" style="font-weight: bold; color: green">
													<?= $registrasi->nama ?>
													<?= $registrasi->alamat ?><br>
												</h4>
												<div class="alert alert-success">
													<?php if($proteksi_regsitrasi == 1) { ?>
														<table style="font-size: 14px; font-weight: bold;">
															<tr>
																<td>Kuota</td>
																<td>: 
																	<?php
																		$kuota =  ($registrasi->kuota - $jumlahverif);
																		if($kuota >= 0) {
																			echo $kuota;
																		} else {
																			echo '0';
																		}
																	?>
																</td>
															</tr>
															<tr>
																<td>Buka</td>
																<td>: <?= date('d-m-Y H:i', strtotime($registrasi->tanggal_awal)) ?></td>
															</tr>
															<tr>
																<td>Tutup</td>
																<td>: <?= date('d-m-Y H:i', strtotime($registrasi->tanggal_akhir)) ?></td>
															</tr>
														</table>
													<?php } else { ?>
														<table style="font-size: 14px; font-weight: bold;">
														<tr>
															<?php if( date("Y-m-d H:i") < $tanggal_awal) { ?>
																<td colspan="2" style="color: red">PENDAFTARAN BELUM BUKA</td>
															<?php } else if( date("Y-m-d H:i") > $tanggal_akhir) { ?>
																<td colspan="2" style="color: red">PENDAFTARAN SUDAH TUTUP</td>
															<?php } ?>
														</tr>
													</table>
													<?php } ?>
												</div>
											</div>
			            				</div>
			            			<?php } ?>			

			            			<?php if($proteksi_regsitrasi == 1) { ?>
										<div class="row">													
											<div class="form-group">
												<input type="hidden" name="departemen" id="departemen" value="<?= $departemen ?>" >

												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px; color: red">Unit *)</label>
												<div class="col-sm-3" style="padding-left: 25px; padding-right: 25px">
													<select name="departemen1" id="departemen1" class="chosen-select form-control" disabled >
														<option value=""></option>
														<?php select_departemen_reg($departemen); ?>
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">No. Pendaftaran *)</label>
												<div class="col-sm-4" style="padding-left: 25px; padding-right: 25px;">
													<input type="text" name="nopendaftaran" id="nopendaftaran" class="form-control text-radius" readonly value="<?php echo $ref2; ?>" >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">No. Induk Kependudukan (NIK) *) <i style="color: red">sebagai nomor ID saat login</i></label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px" id="nik_id">
													<input type="text" id="nik" name="nik" class="form-control" autocomplete="off" value="<?php echo $nik ?>" <?= $readonly ?> onblur="loadHTMLPost3('registrasi_ajax.php','nik_id','ceknik','replid','nik')" >
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Jenis Pendaftaran *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<select name="idproses" id="idproses" class="chosen-select form-control" <?= $disabled ?>/>
														<?php select_jenispendaftaran($idproses); ?>
													</select>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Tanggal Daftar *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" id="tanggal" name="tanggal" class="form-control" autocomplete="off" readonly value="<?php echo $tanggal ?>">
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Jalur Masuk *)</label>
												<div class="col-sm-4" style="padding-left: 25px; padding-right: 25px">
													<select name="idkelompok" id="idkelompok" class="chosen-select form-control" <?= $disabled ?> >
														<option value=""></option>
														<?php select_jalurmasuk2($idkelompok); ?>
													</select>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Photo *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<?php if($rgxid == "") { ?>
														<input type="file" id="foto_file" name="foto_file" />
								                        <br />
								                    <?php } ?>
							        				<?php if (!empty($foto_file)) { ?>
							        					<a href="../app/file_foto/<?php echo $foto_file ?>" rel="lightbox" style="text-decoration:none;" title="Photo View">
								        					<img src="../app/file_foto/<?php echo $foto_file; ?>" height="150" />
								        				</a>
							        				<?php } ?>
							                        <input size="25" type="hidden" id="photo2" name="photo2" value="<?php echo $foto_file; ?>">  
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Nama Lengkap *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" id="nama" name="nama" class="form-control" value="<?php echo $nama ?>" <?= $readonly ?> >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Nama Panggilan</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" id="panggilan" name="panggilan" class="form-control" value="<?php echo $panggilan ?>" <?= $readonly ?> >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Tempat Lahir *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" id="tmplahir" name="tmplahir" class="form-control" value="<?php echo $tmplahir ?>" <?= $readonly ?> >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Tanggal Lahir *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" id="tgllahir" name="tgllahir" class="form-control date-picker" data-date-format="dd-mm-yyyy" autocomplete="off" value="<?php echo $tgllahir ?>" <?= $readonly ?> >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Jenis Kelamin *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<select name="kelamin" id="kelamin" class="chosen-select form-control" <?= $disabled ?> >
														<option value=""></option>
														<?php select_kelamin($kelamin); ?>
													</select>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Agama *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<select name="agama" id="agama" class="chosen-select form-control" <?= $disabled ?> >
														<?php select_agama($agama); ?>
													</select>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Alamat *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" name="alamatsiswa" id="alamatsiswa" class="form-control" value="<?php echo $alamatsiswa; ?>" <?= $readonly ?> >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Kode POS *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" name="kodepossiswa" id="kodepossiswa" class="form-control" maxlength="5" value="<?php echo $kodepossiswa; ?>" <?= $readonly ?> >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">No. HP/Telepon *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" name="hpsiswa" id="hpsiswa" class="form-control" placeholder="Nomor HP" value="<?php echo $hpsiswa; ?>" <?= $readonly ?> >/<input type="text" name="telponsiswa" id="telponsiswa" class="form-control" placeholder="Telepon" value="<?php echo $telponsiswa; ?>" <?= $readonly ?> >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">E-mail *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" name="emailsiswa" id="emailsiswa" class="form-control" value="<?php echo $emailsiswa; ?>" <?= $readonly ?> >
												</div>
											</div>

											<?php if($rgxid) { ?>
												<div class="form-group">
													<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Upload Bukti Transfer</label>
													<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
														<input type="file" id="info3" name="info3" onchange="return validasiFile('info3')"/>
									                    <br />
								        				<?php if (!empty($bukti_transfer)) { ?>
								        					<a href="../app/file_transfer_registrasi/<?php echo $bukti_transfer ?>" rel="lightbox" style="text-decoration:none;" title="Photo View">
									        					<img src="../app/file_transfer_registrasi/<?php echo $bukti_transfer; ?>" height="150" />
									        				</a>
								        				<?php } ?>
								                        <input size="25" type="hidden" id="info32" name="info32" value="<?php echo $bukti_transfer; ?>">  
													</div>
												</div>
											<?php } ?>
										</div>
									<?php } ?>

								</div>
		            	<?php 
		            		##form upload berkas-berkas
		            		} else if($file_raport == "" || $file_memo_ortu == "" || $file_raport == "" || $file_ktp == "" || $file_akte == "" || $file_kk == "") {
		            			
						?>
								<div class="col-sm-6">		
		            				<div class="row" style="padding-bottom: 10px;">
		            					<div class="widget-header widget-header-flat" style="text-align: center;">
											<h4 class="widget-title" style="font-weight: bold; color: green">
												<?php if($rgxid == "" && $unit) { ?>
													FORM PENDAFTARAN
												<?php 
													} else if($rgxid && $unit) { 
														$readonly = "readonly";
														$disabled = "disabled";
												?>
													DATA REGISTRASI<br>
													<?= $registrasi->nama ?>
													<?= $registrasi->alamat ?>

													<?php if($bukti_transfer != "") { ?>
														<div class="alert alert-success">
															<i class="ace-icon fa fa-hand-o-right"></i>
															Silahkan upload berkas-berkas
														</div>
													<?php } ?>
												<?php } ?>
											</h4>
										</div>
		            				</div>	
		            				<?php if($rgxid == "" && $unit != "") { ?>
			            				<div class="row" style="padding-bottom: 10px;">
			            					<div class="widget-header widget-header-flat" style="text-align: left;">
												<h4 class="widget-title" style="font-weight: bold; color: green">
													<?= $registrasi->nama ?>
													<?= $registrasi->alamat ?><br>
												</h4>
												<div class="alert alert-success">
													<?php if($proteksi_regsitrasi == 1) { ?>
														<table style="font-size: 14px; font-weight: bold;">
															<tr>
																<td>Kuota</td>
																<td>: 
																	<?php
																		$kuota =  ($registrasi->kuota - $jumlahverif);
																		if($kuota >= 0) {
																			echo $kuota;
																		} else {
																			echo '0';
																		}
																	?>
																</td>
															</tr>
															<tr>
																<td>Buka</td>
																<td>: <?= date('d-m-Y H:i', strtotime($registrasi->tanggal_awal)) ?></td>
															</tr>
															<tr>
																<td>Tutup</td>
																<td>: <?= date('d-m-Y H:i', strtotime($registrasi->tanggal_akhir)) ?></td>
															</tr>
														</table>
													<?php } else { ?>
														<table style="font-size: 14px; font-weight: bold;">
														<tr>
															<?php if( date("Y-m-d H:i") < $tanggal_awal) { ?>
																<td colspan="2" style="color: red">PENDAFTARAN BELUM BUKA</td>
															<?php } else if( date("Y-m-d H:i") > $tanggal_akhir) { ?>
																<td colspan="2" style="color: red">PENDAFTARAN SUDAH TUTUP</td>
															<?php } ?>
														</tr>
													</table>
													<?php } ?>
												</div>
											</div>
			            				</div>
			            			<?php } ?>			

			            			<?php if($proteksi_regsitrasi == 0) { ?>
										<div class="row">													
											<div class="form-group">
												<input type="hidden" name="departemen" id="departemen" value="<?= $departemen ?>" >

												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px; color: red">Unit *)</label>
												<div class="col-sm-3" style="padding-left: 25px; padding-right: 25px">
													<select name="departemen1" id="departemen1" class="chosen-select form-control" disabled >
														<option value=""></option>
														<?php select_departemen_reg($departemen); ?>
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">No. Pendaftaran *)</label>
												<div class="col-sm-4" style="padding-left: 25px; padding-right: 25px;">
													<input type="text" name="nopendaftaran" id="nopendaftaran" class="form-control text-radius" readonly value="<?php echo $ref2; ?>" >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">No. Induk Kependudukan (NIK) *) <i style="color: red">sebagai nomor ID saat login</i></label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px" id="nik_id">
													<input type="text" id="nik" name="nik" class="form-control" autocomplete="off" value="<?php echo $nik ?>" <?= $readonly ?> onblur="loadHTMLPost3('registrasi_ajax.php','nik_id','ceknik','replid','nik')" >
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Jenis Pendaftaran *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<select name="idproses" id="idproses" class="chosen-select form-control" <?= $disabled ?>/>
														<?php select_jenispendaftaran($idproses); ?>
													</select>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Tanggal Daftar *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" id="tanggal" name="tanggal" class="form-control" autocomplete="off" readonly value="<?php echo $tanggal ?>">
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Jalur Masuk *)</label>
												<div class="col-sm-4" style="padding-left: 25px; padding-right: 25px">
													<select name="idkelompok" id="idkelompok" class="chosen-select form-control" <?= $disabled ?> >
														<option value=""></option>
														<?php select_jalurmasuk2($idkelompok); ?>
													</select>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Photo *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<?php if($rgxid == "") { ?>
														<input type="file" id="foto_file" name="foto_file" />
								                        <br />
								                    <?php } ?>
							        				<?php if (!empty($foto_file)) { ?>
							        					<a href="../app/file_foto/<?php echo $foto_file ?>" rel="lightbox" style="text-decoration:none;" title="Photo View">
								        					<img src="../app/file_foto/<?php echo $foto_file; ?>" height="150" />
								        				</a>
							        				<?php } ?>
							                        <input size="25" type="hidden" id="photo2" name="photo2" value="<?php echo $foto_file; ?>">  
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Nama Lengkap *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" id="nama" name="nama" class="form-control" value="<?php echo $nama ?>" <?= $readonly ?> >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Nama Panggilan</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" id="panggilan" name="panggilan" class="form-control" value="<?php echo $panggilan ?>" <?= $readonly ?> >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Tempat Lahir *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" id="tmplahir" name="tmplahir" class="form-control" value="<?php echo $tmplahir ?>" <?= $readonly ?> >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Tanggal Lahir *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" id="tgllahir" name="tgllahir" class="form-control date-picker" data-date-format="dd-mm-yyyy" autocomplete="off" value="<?php echo $tgllahir ?>" <?= $readonly ?> >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Jenis Kelamin *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<select name="kelamin" id="kelamin" class="chosen-select form-control" <?= $disabled ?> >
														<option value=""></option>
														<?php select_kelamin($kelamin); ?>
													</select>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Agama *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<select name="agama" id="agama" class="chosen-select form-control" <?= $disabled ?> >
														<?php select_agama($agama); ?>
													</select>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Alamat *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" name="alamatsiswa" id="alamatsiswa" class="form-control" value="<?php echo $alamatsiswa; ?>" <?= $readonly ?> >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Kode POS *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" name="kodepossiswa" id="kodepossiswa" class="form-control" maxlength="5" value="<?php echo $kodepossiswa; ?>" <?= $readonly ?> >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">No. HP/Telepon *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" name="hpsiswa" id="hpsiswa" class="form-control" placeholder="Nomor HP" value="<?php echo $hpsiswa; ?>" <?= $readonly ?> >/<input type="text" name="telponsiswa" id="telponsiswa" class="form-control" placeholder="Telepon" value="<?php echo $telponsiswa; ?>" <?= $readonly ?> >
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">E-mail *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="text" name="emailsiswa" id="emailsiswa" class="form-control" value="<?php echo $emailsiswa; ?>" <?= $readonly ?> >
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Upload KK *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="file" id="file_kk" name="file_kk" onchange="return validasiFile2('file_kk')" />
							                        <br />
							        				<?php if (!empty($file_kk)) { ?>
							        					<img src="../app/file_kk/<?php echo $file_kk; ?>" width="50" height="50" />
							        				<?php } ?>
							                        <input size="25" type="hidden" id="file_kk2" name="file_kk2" value="<?php echo $file_kk; ?>">  
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1">Upload Akte Kelahiran *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="file" id="file_akte" name="file_akte" onchange="return validasiFile2('file_akte')" />
							                        <br />
							        				<?php if (!empty($file_akte)) { ?>
							        					<img src="../app/file_akte/<?php echo $file_akte; ?>" width="50" height="50" />
							        				<?php } ?>
							                        <input size="25" type="hidden" id="file_akte2" name="file_akte2" value="<?php echo $file_akte; ?>">  
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Upload KTP Orang Tua *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="file" id="file_ktp" name="file_ktp" onchange="return validasiFile2('file_ktp')" />
							                        <br />
							        				<?php if (!empty($file_ktp)) { ?>
							        					<img src="../app/file_ktp/<?php echo $file_ktp; ?>" width="50" height="50" />
							        				<?php } ?>
							                        <input size="25" type="hidden" id="file_ktp2" name="file_ktp2" value="<?php echo $file_ktp; ?>">  
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Upload Rapor *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="file" id="file_raport" name="file_raport" onchange="return validasiFile2('file_raport')"/>
								                    <br />
							        				<?php if (!empty($file_raport)) { ?>
							        					<a href="../app/file_raport/<?php echo $file_raport ?>" rel="lightbox" style="text-decoration:none;" title="File Rapor View">
								        					<img src="../app/file_raport/<?php echo $file_raport; ?>" height="150" />
								        				</a>
							        				<?php } ?>
							                        <input size="25" type="hidden" id="file_raport2" name="file_raport2" value="<?php echo $file_raport; ?>">  
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Upload Pernyataan Sanggup Bayar *)</label>
												<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
													<input type="file" id="file_memo_ortu" name="file_memo_ortu" onchange="return validasiFile2('file_memo_ortu')" />
							                        <br />
							        				<?php if (!empty($file_memo_ortu)) { ?>
							        					<img src="../app/file_memo_ortu/<?php echo $file_memo_ortu; ?>" width="50" height="50" />
							        				<?php } ?>
							                        <input size="25" type="hidden" id="file_memo_ortu2" name="file_memo_ortu2" value="<?php echo $file_memo_ortu; ?>">  
												</div>
											</div>

										</div>
									<?php } ?>

								</div>
						<?php
		            		} else {
		            			if ($ref != "") {
									$sql=$select->list_registrasi($ref);			
									$registrasi=$sql->fetch(PDO::FETCH_OBJ);
									
									$ref2 	= $registrasi->nopendaftaran;
									$replid = $registrasi->replid;
									
									if($registrasi->almayah == 1) {
										$almayah = "checked";
									}
									if($registrasi->almibu == 1) {
										$almibu = "checked";
									}
									
									$tgllahir = date("d-m-Y", strtotime($registrasi->tgllahir));
									if($tgllahir == "01-01-1970") {
										$tgllahir = "";
									}
									
									if($registrasi->kebutuhan_khusus_chk == 1) { 
										$kebutuhan_khusus_chk = "checked"; 
									} else {
										$kebutuhan_khusus_chk = "";
									}
									if($registrasi->kebutuhan_khusus_chk == 2) { 
										$kebutuhan_khusus_chk1 = "checked"; 
									} else {
										$kebutuhan_khusus_chk1 = ""; 
									}
									
									$butuhkhususayah = "";
									if($registrasi->butuhkhususayah == 1) {
										$butuhkhususayah = "checked";
									}
									
								} 
		            	?>				
		            			<div class="col-sm-6">
									<div class="widget-box">
										<div class="widget-header widget-header-flat">
											<?php if($lulus == 0) { ?>
												<h4 class="widget-title" style="color: red">
													<i class="ace-icon fa fa-hand-o-right"></i>
													Lengkapi Data Calon Siswa
												</h4>
											<?php } else { ?>
												<h4 class="widget-title" style="color: green; font-size: 16px; font-weight: bold;">
													<i class="ace-icon fa fa-hand-o-right"></i>
													LULUS
												</h4>
											<?php } ?>
										</div>
									</div>
								</div>

								<div class="col-sm-6">
									<div class="widget-box">
										<div class="widget-header widget-header-flat">
											<?php if($lulus == 0) { ?>
												<h4 class="widget-title" style="color: red">
													Menunggu Hasil Seleksi
												</h4>
											<?php } else { ?>
												<h4 class="widget-title" style="color: green; font-size: 16px; font-weight: bold;">
													LULUS
												</h4>
											<?php } ?>
										</div>
									</div>
								</div>

								<div class="col-sm-6">
									<div class="widget-box">
										<div class="widget-header widget-header-flat">
											<h4 class="widget-title">Identitas Peserta Didik (Wajib diisi)</h4>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												<div class="row">
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Unit</label>
														<div class="col-sm-3" style="padding-left: 25px; padding-right: 25px">
															<select name="departemen" id="departemen" class="chosen-select form-control" >
																<option value=""></option>
																<?php select_departemen($registrasi->departemen); ?>
															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">No. Pendaftaran</label>
														<div class="col-sm-4" style="padding-left: 25px; padding-right: 25px;">
															<input type="text" name="nopendaftaran" id="nopendaftaran" class="form-control text-radius" readonly value="<?php echo $ref2; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Jenis Pendaftaran</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="idproses" id="idproses" class="chosen-select form-control"/>
																<option value=""></option>
																<?php select_jenispendaftaran($registrasi->idproses); ?>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Tanggal</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" id="tanggal" name="tanggal" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $tanggal ?>">
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Jalur Masuk</label>
														<div class="col-sm-4" style="padding-left: 25px; padding-right: 25px">
															<select name="idkelompok" id="idkelompok" class="chosen-select form-control" >
																<option value=""></option>
																<?php select_jalurmasuk2($registrasi->idkelompok); ?>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Photo</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="file" id="foto_file" name="foto_file" />
									                        <br />
									        				<?php if (!empty($registrasi->foto_file)) { ?>
									        					<a href="../app/file_foto/<?php echo $registrasi->foto_file ?>" rel="lightbox" style="text-decoration:none;" title="Photo View">
									        					<img src="../app/file_foto/<?php echo $registrasi->foto_file; ?>" height="150" />
										        				</a>
									        				<?php } ?>
									                        <input size="25" type="hidden" id="photo2" name="photo2" value="<?php echo $registrasi->foto_file; ?>">  
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Nama *)</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" id="nama" name="nama" class="form-control" value="<?php echo $registrasi->nama ?>">
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Nama Panggilan</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" id="panggilan" name="panggilan" class="form-control" value="<?php echo $registrasi->panggilan ?>">
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Tempat Lahir</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" id="tmplahir" name="tmplahir" class="form-control" value="<?php echo $registrasi->tmplahir ?>">
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Tanggal Lahir</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" id="tgllahir" name="tgllahir" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $tgllahir ?>">
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Jenis Kelamin</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="kelamin" id="kelamin" class="chosen-select form-control" >
																<option value=""></option>
																<?php select_kelamin($registrasi->kelamin); ?>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">NISN </label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px" id="nisn_id">
															<?php if($ref == '') { ?>
																<input type="text" id="nisn" name="nisn" class="form-control" onblur="loadHTMLPost3('app/siswa_nis_ajax.php','nisn_id','ceknisn','replid','nisn')" value="<?php echo $registrasi->nisn ?>">
															<?php } else { ?>
																<input type="text" id="nisn" name="nisn" class="form-control" onblur="loadHTMLPost3('app/siswa_nis_ajax_update.php','nisn_id','ceknisn','replid','nisn')" value="<?php echo $registrasi->nisn ?>">
															<?php } ?>
															<a href="https://nisn.data.kemdikbud.go.id/" target="_blank">Cek NISN</a>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">NO SERI IJASAH</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px" id="noijazah_id">
															<?php if($ref == '') { ?>
																<input type="text" id="noijazah" name="noijazah" class="form-control" onblur="loadHTMLPost3('app/siswa_noijazah_ajax.php','noijazah_id','ceknoijazah','replid','noijazah')" value="<?php echo $registrasi->noijazah ?>">
															<?php } else { ?>
																<input type="text" id="noijazah" name="noijazah" class="form-control" onblur="loadHTMLPost3('app/siswa_noijazah_ajax_update.php','noijazah_id','ceknoijazah','replid','noijazah')" value="<?php echo $registrasi->noijazah ?>">
															<?php } ?>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Tahun Ijasah</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="tahunijazah" id="tahunijazah" class="chosen-select form-control" >
																<option value=""></option>
																<?php tahun_select($registrasi->tahunijazah); ?>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">NOMOR SERI SKHUN</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px" id="skhun_id">
															<?php if($ref == '') { ?>
																<input type="text" id="skhun" name="skhun" class="form-control" onblur="loadHTMLPost3('app/siswa_skhun_ajax.php','skhun_id','cekskhun','replid','skhun')" value="<?php echo $registrasi->skhun ?>">
															<?php } else { ?>
																<input type="text" id="skhun" name="skhun" class="form-control" onblur="loadHTMLPost3('app/siswa_skhun_ajax_update.php','skhun_id','cekskhun','replid','skhun')" value="<?php echo $registrasi->skhun ?>">
															<?php } ?>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Tahun SKUN</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="tahunskhun" id="tahunskhun" class="chosen-select form-control" >
																<option value=""></option>
																<?php tahun_select($registrasi->tahunskhun); ?>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">No Ujian Nasional</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" id="noujian" name="noujian" class="form-control" value="<?php echo $registrasi->noujian ?>">
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">No. Induk Kependudukan (NIK)</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" id="nik" name="nik" class="form-control" value="<?php echo $registrasi->nik ?>">
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Agama</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="agama" id="agama" class="chosen-select form-control" >
																<option value=""></option>
																<?php select_agama($registrasi->agama); ?>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Berkebutuhan Khusus</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="radio" id="kebutuhan_khusus_chk" name="kebutuhan_khusus_chk" class="ace" value="1" <?php echo $kebutuhan_khusus_chk ?> ><span class="lbl">YA&nbsp;&nbsp;</span>
															<input type="radio" id="kebutuhan_khusus_chk1" name="kebutuhan_khusus_chk" class="ace" value="2" <?php echo $kebutuhan_khusus_chk1 ?> ><span class="lbl">TIDAK</span>
															<br>
															*) Jika YA, sebutkan
															<input type="text" name="kebutuhan_khusus" id="kebutuhan_khusus" class="form-control" value="<?php echo $registrasi->kebutuhan_khusus; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Alamat Tempat Tinggal</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="alamatsiswa" id="alamatsiswa" class="form-control" value="<?php echo $registrasi->alamatsiswa; ?>" >
															 /
															RT : <input type="text" name="rt" id="rt" class="form-control" value="<?php echo $registrasi->rt; ?>" >
															RW : <input type="text" name="rw" id="rw" class="form-control" value="<?php echo $registrasi->rw; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Kelurahan/Desa</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="kelurahan" id="kelurahan" class="form-control" value="<?php echo $registrasi->kelurahan ?>">
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Kode Pos Siswa</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="kodepossiswa" id="kodepossiswa" class="form-control" value="<?php echo $registrasi->kodepossiswa; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Kecamatan</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="kecamatan" id="kecamatan" class="form-control" value="<?php echo $registrasi->kecamatan; ?>" >
														</div>
													</div>	
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Kabupaten/Kota</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="kabupaten" id="kabupaten" class="form-control" value="<?php echo $registrasi->kabupaten; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Provinsi</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="provinsi" id="provinsi" class="form-control" value="<?php echo $registrasi->provinsi; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Alat Transportasi ke Sekolah</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="transportasi_kode" id="transportasi_kode" class="chosen-select form-control" />
																<option value=""></option>
																<?php select_transportasi($registrasi->transportasi_kode); ?>
															</select>
															(Lainnya sebutkan)
															<input type="text" name="transportasi" id="transportasi" sclass="form-control" value="<?php echo $registrasi->transportasi; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Jenis Tinggal</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="idjenis_tinggal" id="idjenis_tinggal" class="chosen-select form-control" >
																<option value=""></option>
																<?php select_jenistinggal($registrasi->idjenis_tinggal); ?>
															</select>
															&nbsp;
															Bersama Wali (sebutkan hubungan keluarga)
															<input type="text" name="jenis_tinggal" id="jenis_tinggal" sclass="form-control" value="<?php echo $registrasi->jenis_tinggal ?>">
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">No. Telp. Rumah/HP Siswa</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="telponsiswa" id="telponsiswa" class="form-control" value="<?php echo $registrasi->telponsiswa; ?>" >/
															<input type="text" name="hpsiswa" id="hpsiswa" class="form-control" value="<?php echo $registrasi->hpsiswa; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">E-mail Pribadi</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="emailsiswa" id="emailsiswa" class="form-control" value="<?php echo $registrasi->emailsiswa; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Apakah Sebagai Penerima KPS</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="checkbox" name="kps" id="kps" class="ace" value="1" <?php echo $kps ?> >
															<br>
															NO. KPS
															<input type="text" name="nokps" id="nokps" class="form-control" value="<?php echo $registrasi->nokps; ?>" ><i style="font-size: 8px">*) KPS= Kartu Perlindungan Sosial</i>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">NO. KIP</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="nokip" id="nokip" class="form-control" value="<?php echo $registrasi->nokip; ?>" >
															<br>
															NO. KKS
															<input type="text" name="nokks" id="nokks" class="form-control" value="<?php echo $registrasi->nokks; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Cita-Cita</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="citacita" id="citacita" class="chosen-select form-control" />
																<option value=""></option>
																<?php select_citacita($registrasi->citacita); ?>
															</select>
															<br>
															Lainnya (sebutkan)
															<input type="text" name="citacita_lain" id="citacita_lain" class="form-control" value="<?php echo $registrasi->citacita_lain ?>">
														</div>
													</div>
													
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="widget-box">
										<div class="widget-header widget-header-flat">
											<h4 class="widget-title">Data Ayah Kandung</h4>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												<div class="row">
														
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Nama Ayah</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="namaayah" id="namaayah" class="form-control" value="<?php echo $registrasi->namaayah ?>">
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Tahun Lahir</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="tahunayah" id="tahunayah" class="chosen-select form-control" />
																<option value=""></option>
																<?php tahun_select($registrasi->tahunayah); ?>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Almarhum</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="checkbox" name="almayah" id="almayah" class="ace" value="1" <?php echo $almayah ?> ><span class="lbl"></span>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Alamat Lengkap Ayah</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="alamatortu" id="alamatortu" class="form-control" value="<?php echo $registrasi->alamatortu; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Kode Pos Ayah</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="kodeposortu" id="kodeposortu" class="form-control" value="<?php echo $registrasi->kodeposortu; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">HP Ayah</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="hportu" id="hportu" class="form-control" value="<?php echo $registrasi->hportu; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Berkebutuhan Khusus</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="checkbox" name="butuhkhususayah" id="butuhkhususayah" class="ace" value="1" <?php echo $butuhkhususayah ?> ><span class="lbl"></span>
															<br>
															<input type="text" name="butuhkhususketayah" id="butuhkhususketayah" class="form-control" value="<?php echo $registrasi->butuhkhususketayah; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Pekrjaan Ayah</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="pekerjaanayah" id="pekerjaanayah" class="chosen-select form-control" />
																<option value=""></option>
																<?php select_jenispekerjaan_ayah($registrasi->pekerjaanayah); ?>
															</select>
															<br>
															Lain-Lain (sebutkan)
															<input type="text" name="pekerjaanayah_lain" id="pekerjaanayah_lain" class="form-control" value="<?php echo $registrasi->pekerjaanayah_lain; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Pendidikan Ayah</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="pendidikanayah" id="pendidikanayah" class="chosen-select form-control" />
																<option value=""></option>
																<?php select_pendidikan($registrasi->pendidikanayah); ?>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Penghasilan Ayah Bulanan</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="penghasilanayah_kode" id="penghasilanayah_kode" class="chosen-select form-control" />
																<option value=""></option>
																<?php select_penghasilan($registrasi->penghasilanayah_kode); ?>
															</select>
															<br>
															Lainnya (sebutkan)
															<input type="text" name="penghasilanayah" id="penghasilanayah" class="form-control" onkeyup="formatangka('penghasilanayah')" value="<?php echo $registrasi->penghasilanayah ?>">
														</div>
													</div>
													
												</div>
											</div>
										</div>
									</div>
								</div>
																		
								
								<div class="col-sm-6">
									<div class="widget-box">
										<div class="widget-header widget-header-flat">
											<h4 class="widget-title">Data Ibu Kandung</h4>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												<div class="row">
												
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Nama Ibu</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="namaibu" id="namaibu" class="form-control" value="<?php echo $registrasi->namaibu ?>"></td>
															<br>
															Tahun Lahir
															<select name="tahunibu" id="tahunibu" class="chosen-select form-control"/>
																<option value=""></option>
																<?php tahun_select($registrasi->tahunibu); ?>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Almarhum</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="checkbox" name="almibu" id="almibu" class="ace" value="1" <?php echo $almibu ?> ><span class="lbl"></span>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Alamat Ibu</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="alamatibu" id="alamatibu" class="form-control" value="<?php echo $registrasi->alamatibu; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Kode Ibu</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="kodeposibu" id="kodeposibu" class="form-control" value="<?php echo $registrasi->kodeposibu; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">HP Ibu</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="hpibu" id="hpibu" class="form-control" value="<?php echo $registrasi->hpibu; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Berkebutuhan Khusus</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="checkbox" name="butuhkhususibu" id="butuhkhususibu" class="ace" value="1" <?php echo $butuhkhususibu ?> ><span class="lbl"></span>
															<br>
															<input type="text" name="butuhkhususketibu" id="butuhkhususketibu" class="form-control" value="<?php echo $registrasi->butuhkhususketibu; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Pekrjaan Ibu</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="pekerjaanibu" id="pekerjaanibu" class="chosen-select form-control" />
																<option value=""></option>
																<?php select_jenispekerjaan($registrasi->pekerjaanibu); ?>
															</select>
															<br>
															Lain-Lain (sebutkan)
															<input type="text" name="pekerjaanibu_lain" id="pekerjaanibu_lain" class="form-control" value="<?php echo $registrasi->pekerjaanibu_lain; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Pendidikan Ibu</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="pendidikanibu" id="pendidikanibu" class="chosen-select form-control" />
																<option value=""></option>
																<?php select_pendidikan($registrasi->pendidikanibu); ?>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Penghasilan Ibu Bulanan</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="penghasilanibu_kode" id="penghasilanibu_kode" class="chosen-select form-control" />
																<option value=""></option>
																<?php select_penghasilan($registrasi->penghasilanibu_kode); ?>
															</select>
															Lainnya (sebutkan)
															<input type="text" name="penghasilanibu" id="penghasilanibu" class="form-control" onkeyup="formatangka('penghasilanibu')" value="<?php echo $registrasi->penghasilanibu ?>">
														</div>
													</div>
												
												</div>
											</div>
										</div>
									</div>
								</div>
												
								
								<div class="col-sm-6">
									<div class="widget-box">
										<div class="widget-header widget-header-flat">
											<h4 class="widget-title">Data Wali</h4>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												<div class="row">
												
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Nama Wali</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="wali" id="wali" class="form-control" value="<?php echo $registrasi->wali ?>">
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Tahun Lahir Wali</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="tahunwali" id="tahunwali" class="chosen-select form-control" />
																<option value=""></option>
																<?php tahun_select($registrasi->tahunwali); ?>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Pekerjaan Wali</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="pekerjaanwali" id="pekerjaanwali" class="chosen-select form-control" />
																<option value=""></option>
																<?php select_jenispekerjaan($registrasi->pekerjaanwali); ?>
															</select>
															Lain-Lain (sebutkan)
															<input type="text" name="pekerjaanwali_lain" id="pekerjaanwali_lain" class="form-control" value="<?php echo $registrasi->pekerjaanwali_lain; ?>" >
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Pendidikan Wali</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="pendidikanwali" id="pendidikanwali" class="chosen-select form-control" />
																<option value=""></option>
																<?php select_pendidikan($registrasi->pendidikanwali); ?>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Penghasilan Wali</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="penghasilanwali" id="penghasilanwali" class="form-control" onkeyup="formatangka('penghasilanwali')" value="<?php echo $registrasi->penghasilanwali ?>">
														</div>
													</div>
												
												</div>
											</div>
										</div>
									</div>
								</div>				
												
								<div class="col-sm-6">
									<div class="widget-box">
										<div class="widget-header widget-header-flat">
											<h4 class="widget-title">Data Periodik</h4>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												<div class="row">
												
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Tinggi Badan</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="tinggi" id="tinggi" class="form-control" onkeyup="formatangka('tinggi')" value="<?php echo $registrasi->tinggi ?>">&nbsp;cm
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Berat Badan</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="berat" id="berat" class="form-control" onkeyup="formatangka('berat')" value="<?php echo $registrasi->berat ?>">&nbsp;kg
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Golongan Darah</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<select name="darah" id="darah" class="chosen-select form-control" />
																<option value=""></option>
																<?php select_goldarah($registrasi->darah); ?>
															</select>
															&nbsp;&nbsp;
															File Fotokopi <input type="file" id="file_darah" name="file_darah" >
															<input type="hidden" id="file_darah2" name="file_darah2" value="<?php echo $registrasi->file_darah; ?>" >
															
															<?php if($registrasi->file_darah != '') { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="app/registrasi_download_darah.php?replid=<?php echo $registrasi->replid ?>" target="_blank" style="background-color: #0b28f4" >Download File</a>
															<?php } ?>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Jarak Tempat Tinggal ke Sekolah</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="jaraksekolah" id="jaraksekolah" class="form-control" value="<?php echo $registrasi->jaraksekolah ?>"> &nbsp;<i>meter</i>
															Lebih dari 1 km, sebutkan :
															<input type="text" name="jarak_km" id="jarak_km" class="form-control" onkeyup="formatangka('jarak_km')" value="<?php echo $registrasi->jarak_km ?>">&nbsp;Km
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Waktu Tempuh Berangkat ke Sekolah</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="waktutempuh" id="waktutempuh" class="form-control" value="<?php echo $registrasi->waktutempuh ?>">&nbsp;<i>menit</i>
															Lebih dari 60 menit, sebutkan :
															<input type="text" name="waktutempuh_menit" id="waktutempuh_menit" class="form-control" onkeyup="formatangka('waktutempuh_menit')" value="<?php echo $registrasi->waktutempuh_menit ?>">&nbsp;Menit
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="padding-left: 25px;">Jumlah Saudara Kandung</label>
														<div class="col-sm-6" style="padding-left: 25px; padding-right: 25px">
															<input type="text" name="jsaudara" id="jsaudara" class="form-control" onkeyup="formatangka('jsaudara')" value="<?php echo $registrasi->jsaudara; ?>" >
														</div>
													</div>
												
												</div>
											</div>
										</div>
									</div>
								</div>
						<?php
							}
						?>
						
						<!-- /.row -->
			              
						<div class="space-4"></div>
						<div class="col-sm-12">
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
			                        
			                        <?php if($rgxid == "") { ?>
			                        	<?php if($proteksi_regsitrasi == 1) { ?>
			                        		<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Submit" />
			                        		&nbsp;
			                        		<input type="button" name="submit" id="submit" class="btn btn-success" value="Login (jika sudah daftar)" onclick="self.location='http://158.140.190.252/sims/reg/sign'" />
			                        	<?php } ?>
			                        <?php } else if($rgxid != "" && $bukti_transfer == "") { ?>
			                        	<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Upload" />
			                        <?php } else if($file_raport == "" || $file_memo_ortu == "" || $file_raport == "" || $file_ktp == "" || $file_akte == "" || $file_kk == "") { ?>
			                        	<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Upload Berkas" />
			                        <?php } else if($verifikasi == 1) { ?>
			                        	<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
			                        <?php } ?>
									
									<?php if($rgxid) { ?>
										&nbsp;&nbsp;
			                        	<a href="http://158.140.190.252/sims/reg/logout.php">
											<i class="ace-icon fa fa-power-off btn btn-primary" style="height: 42px">&nbsp;Logout</i>
										</a>
			                        <?php } ?>
								</div>
							</div>
						</div>

					</form>
		            
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->


		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="../assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="../assets/js/jquery-ui.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/chosen.jquery.min.js"></script>
		<script src="../assets/js/fuelux.spinner.min.js"></script>
		<script src="../assets/js/bootstrap-datepicker.min.js"></script>
		<script src="../assets/js/bootstrap-timepicker.min.js"></script>
		<script src="../assets/js/moment.min.js"></script>
		<script src="../assets/js/daterangepicker.min.js"></script>
		<script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="../assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="../assets/js/jquery.knob.min.js"></script>
		<script src="../assets/js/jquery.autosize.min.js"></script>
		<script src="../assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="../assets/js/jquery.maskedinput.min.js"></script>
		<script src="../assets/js/bootstrap-tag.min.js"></script>

		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="../assets/js/dataTables.tableTools.min.js"></script>
		<script src="../assets/js/dataTables.colVis.min.js"></script>

		<!-- ace scripts -->
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				
				$('#id-disable-check').on('click', function() {
					var inp = $('#form-input-readonly').get(0);
					if(inp.hasAttribute('disabled')) {
						inp.setAttribute('readonly' , 'true');
						inp.removeAttribute('disabled');
						inp.value="This text field is readonly!";
					}
					else {
						inp.setAttribute('disabled' , 'disabled');
						inp.removeAttribute('readonly');
						inp.value="This text field is disabled!";
					}
				});
			
			
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize
			
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});
			
			
					$('#chosen-multiple-style .btn').on('click', function(e){
						var target = $(this).find('input[type=radio]');
						var which = parseInt(target.val());
						if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
						 else $('#form-field-select-4').removeClass('tag-input-style');
					});
				}
			
			
				$('[data-rel=tooltip]').tooltip({container:'body'});
				$('[data-rel=popover]').popover({container:'body'});
				
				$('textarea[class*=autosize]').autosize({append: "\n"});
				$('textarea.limited').inputlimiter({
					remText: '%n character%s remaining...',
					limitText: 'max allowed : %n.'
				});
			
				$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-phone').mask('(999) 999-9999');
				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
			
			
			
				$( "#input-size-slider" ).css('width','200px').slider({
					value:1,
					range: "min",
					min: 1,
					max: 8,
					step: 1,
					slide: function( event, ui ) {
						var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
						var val = parseInt(ui.value);
						$('#form-field-4').attr('class', sizing[val]).val('.'+sizing[val]);
					}
				});
			
				$( "#input-span-slider" ).slider({
					value:1,
					range: "min",
					min: 1,
					max: 12,
					step: 1,
					slide: function( event, ui ) {
						var val = parseInt(ui.value);
						$('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
					}
				});
			
			
				
				//"jQuery UI Slider"
				//range slider tooltip example
				$( "#slider-range" ).css('height','200px').slider({
					orientation: "vertical",
					range: true,
					min: 0,
					max: 100,
					values: [ 17, 67 ],
					slide: function( event, ui ) {
						var val = ui.values[$(ui.handle).index()-1] + "";
			
						if( !ui.handle.firstChild ) {
							$("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
							.prependTo(ui.handle);
						}
						$(ui.handle.firstChild).show().children().eq(1).text(val);
					}
				}).find('span.ui-slider-handle').on('blur', function(){
					$(this.firstChild).hide();
				});
				
				
				$( "#slider-range-max" ).slider({
					range: "max",
					min: 1,
					max: 10,
					value: 2
				});
				
				$( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
					// read initial values from markup and remove that
					var value = parseInt( $( this ).text(), 10 );
					$( this ).empty().slider({
						value: value,
						range: "min",
						animate: true
						
					});
				});
				
				$("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
			
				
				$('#photo , #photo_1, #photo_2, #photo_3, #photo_4').ace_file_input({
					no_file:'No File ...',
					btn_choose:'Choose',
					btn_change:'Change',
					droppable:false,
					onchange:null,
					thumbnail:false //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
				});
				//pre-show a file name, for example a previously selected file
				//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
			
			
				$('#id-input-file-3').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
				
				//$('#id-input-file-3')
				//.ace_file_input('show_file_list', [
					//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
					//{type: 'file', name: 'hello.txt'}
				//]);
			
				
				
			
				//dynamically change allowed formats by changing allowExt && allowMime function
				$('#id-file-format').removeAttr('checked').on('change', function() {
					var whitelist_ext, whitelist_mime;
					var btn_choose
					var no_icon
					if(this.checked) {
						btn_choose = "Drop images here or click to choose";
						no_icon = "ace-icon fa fa-picture-o";
			
						whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
						whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
					}
					else {
						btn_choose = "Drop files here or click to choose";
						no_icon = "ace-icon fa fa-cloud-upload";
						
						whitelist_ext = null;//all extensions are acceptable
						whitelist_mime = null;//all mimes are acceptable
					}
					var file_input = $('#id-input-file-3');
					file_input
					.ace_file_input('update_settings',
					{
						'btn_choose': btn_choose,
						'no_icon': no_icon,
						'allowExt': whitelist_ext,
						'allowMime': whitelist_mime
					})
					file_input.ace_file_input('reset_input');
					
					file_input
					.off('file.error.ace')
					.on('file.error.ace', function(e, info) {
						//console.log(info.file_count);//number of selected files
						//console.log(info.invalid_count);//number of invalid files
						//console.log(info.error_list);//a list of errors in the following format
						
						//info.error_count['ext']
						//info.error_count['mime']
						//info.error_count['size']
						
						//info.error_list['ext']  = [list of file names with invalid extension]
						//info.error_list['mime'] = [list of file names with invalid mimetype]
						//info.error_list['size'] = [list of file names with invalid size]
						
						
						/**
						if( !info.dropped ) {
							//perhapse reset file field if files have been selected, and there are invalid files among them
							//when files are dropped, only valid files will be added to our file array
							e.preventDefault();//it will rest input
						}
						*/
						
						
						//if files have been selected (not dropped), you can choose to reset input
						//because browser keeps all selected files anyway and this cannot be changed
						//we can only reset file field to become empty again
						//on any case you still should check files with your server side script
						//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
					});
				
				});
			
				$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
				.closest('.ace-spinner')
				.on('changed.fu.spinbox', function(){
					//alert($('#spinner1').val())
				}); 
				$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
				$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				$('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
			
				//$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
				//or
				//$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
				//$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
			
			
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
				//or change it into a date range picker
				$('.input-daterange').datepicker({autoclose:true});
			
			
				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('input[name=date-range-picker]').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					locale: {
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					}
				})
				.prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
			
			
				$('#timepicker1').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
				$('#date-timepicker1').datetimepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
			
				$('#colorpicker1').colorpicker();
			
				$('#simple-colorpicker-1').ace_colorpicker();
				//$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
				//$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
				//var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
				//picker.pick('red', true);//insert the color if it doesn't exist
			
			
				$(".knob").knob();
				
				
				var tag_input = $('#form-field-tags');
				try{
					tag_input.tag(
					  {
						placeholder:tag_input.attr('placeholder'),
						//enable typeahead by specifying the source array
						source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
						/**
						//or fetch data from database, fetch those that match "query"
						source: function(query, process) {
						  $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
						  .done(function(result_items){
							process(result_items);
						  });
						}
						*/
					  }
					)
			
					//programmatically add a new
					var $tag_obj = $('#form-field-tags').data('tag');
					$tag_obj.add('Programmatically Added');
				}
				catch(e) {
					//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
					tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
					//$('#form-field-tags').autosize({append: "\n"});
				}
				
				
				/////////
				$('#modal-form input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'large'
				})
				
				//chosen plugin inside a modal will have a zero width because the select element is originally hidden
				//and its width cannot be determined.
				//so we set the width after modal is show
				$('#modal-form').on('shown.bs.modal', function () {
					if(!ace.vars['touch']) {
						$(this).find('.chosen-container').each(function(){
							$(this).find('a:first-child').css('width' , '210px');
							$(this).find('.chosen-drop').css('width' , '210px');
							$(this).find('.chosen-search input').css('width' , '200px');
						});
					}
				})
				/**
				//or you can activate the chosen plugin after modal is shown
				//this way select element becomes visible with dimensions and chosen works as expected
				$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
				*/
			
				
				
				$(document).one('ajaxloadstart.page', function(e) {
					$('textarea[class*=autosize]').trigger('autosize.destroy');
					$('.limiterBox,.autosizejs').remove();
					$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
				});
			
			});
		</script>
	</body>
</html>
				