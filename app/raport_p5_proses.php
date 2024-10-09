<?php
		@session_start();

		if (($_SESSION["logged"] == 0)) {
			echo 'Access denied';
			exit;
		}

		include_once ("include/queryfunctions.php");
		include_once ("include/functions.php");
		include_once ("include/inword.php");

		include 'class/class.selectview.php';
		include 'class/class.select.php';

		$selectview = new selectview;
		$select = new select;

		$dbpdo = DB::create();

		$departemen = $_REQUEST['departemen'];
		$departemen_sekolah_id = $_REQUEST['departemen_sekolah_id'];
		$idtahunajaran		= $_REQUEST['idtahunajaran'];
		$semester_id 		= $_REQUEST['semester_id'];
		$idtingkat	 		= $_REQUEST['idtingkat'];
		$idkelas	 		= $_REQUEST['idkelas'];
		$idtema 		= $_REQUEST['idtema'];
		$iddetail 		= $_REQUEST['iddetail'];
		$syscode 				= $_REQUEST['syscode'];
		$disabled			= $_REQUEST['disabled'];
		$old			= $_REQUEST['old'];

		//proteksi input nilai
		$date = date("d-m-Y");	

		$input_nilai = 0;
		if($idtahunajaran == $_SESSION["idtahunajaran"] && $semester_id == $_SESSION["semester_id"] && allowlvl("frmdaftarnilai") != 2) {
			$input_nilai = 1;
		}

		if(allowlvl("frmdaftarnilai") == 2 || $_SESSION["adm"] == 1 ) {
			$input_nilai = 1;
		}

		if($semester_id == 24 && $idtingkat == 27) {
			$numeric_semester = "1 (Satu)";
		}
		if($semester_id == 20 && $idtingkat == 27) {
			$numeric_semester = "2 (Dua)";
		}

		if($semester_id == 24 && $idtingkat == 28) {
			$numeric_semester = "3 (Tiga)";
		}
		if($semester_id == 20 && $idtingkat == 28) {
			$numeric_semester = "4 (Empat)";
		}

		if($semester_id == 24 && $idtingkat == 46) {
			$numeric_semester = "5 (Lima)";
		}
		if($semester_id == 20 && $idtingkat == 46) {
			$numeric_semester = "6 (Enam)";
		}

?>

<script language="javascript">
	function checkvalidasi() {
		var jmldata = document.getElementById('jmldata').value;
		for(i=0; i<jmldata; i++) {
			var rangkuman_check = false;

			var nama = document.getElementById('nama_'+i).value;			
			var jmldet = document.getElementById('jmldet_'+i).value;
			for(j=0; j<jmldet; j++) {
				var jmldet1 = document.getElementById('jmldet1_'+i+j).value;
				for(k=0; k<jmldet1; k++) {
						var jmldet2 = document.getElementById('jmldet2_'+i+j+k).value;
						for(l=0; l<jmldet2; l++) {
								var rangkuman_proses_id = document.getElementById('rangkuman_proses_id_'+i+j+k+l).checked;
								if(rangkuman_check == false) {
									rangkuman_check = rangkuman_proses_id;
								}
						}
				}
			}
			
			if(rangkuman_check == false) {
					alert('Siswa : '+nama+'\n Catatan Proses belum dipilih !!!');	

					return false;
			}			
		}
		
	} 
</script>

<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/font-awesome/4.2.0/css/font-awesome.min.css" />

<!-- page specific plugin styles -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/jquery-ui.custom.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/chosen.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/datepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/daterangepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/colorpicker.min.css" />


<!-- text fonts -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/fonts/fonts.googleapis.com.css" />

<!-- ace styles -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

<!--[if lte IE 9]>
	<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
<![endif]-->

<!--[if lte IE 9]>
  <link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/ace-ie.min.css" />
<![endif]-->

<!-- inline styles related to this page -->

<!-- ace settings handler -->
<script src="../<?php echo $__folder ?>assets/js/ace-extra.min.js"></script>


<div class="page-content">
      
	<div class="row">
		<div class="col-xs-12">

			<table width="auto" border="0" cellpadding="0" cellspacing="0" style="font-family: Arial; font-size: 14px">
				<tr>
					<td align="left"><b>PROSES NILAI RAPOR P5</b></td>
				</tr>
			</table>

			<br>
      
      <form class="form-horizontal" role="form" action="" method="post" name="daftarnilai_input" id="daftarnilai_input" enctype="multipart/form-data" onsubmit="return checkvalidasi()">           

      	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Unit *)</label>
					<div class="col-sm-3">
						<select name="departemenx" id="departemenx" disabled class="chosen-select form-control">
							<option value=""></option>
							<?php select_departemen($departemen); ?>
						</select>
						<input type="hidden" name="departemen" id="departemen" value="<?= $departemen ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Sekolah *)</label>
					<div class="col-sm-4" id="sekolah_id">
						<select name="departemen_sekolah_idx" id="departemen_sekolah_idx" disabled class="chosen-select form-control">
							<option value=""></option>
							<?php select_sekolah_unit($departemen, $departemen_sekolah_id); ?>
						</select>
						<input type="hidden" name="departemen_sekolah_id" id="departemen_sekolah_id" value="<?= $departemen_sekolah_id ?>">
					</div>
				</div>

      	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tahun Ajaran *)</label>
					<div class="col-sm-3">
						<select name="idtahunajaran__" id="idtahunajaran__" disabled class="chosen-select form-control" >
							<option value=""></option>
							<?php select_thnajaran_all($idtahunajaran) ?>
						</select>
					</div>
				</div>

      	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tingkat *)</label>
					<div class="col-sm-3">
						<select name="idtingkat1" id="idtingkat1" disabled="" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_tingkat_unit($departemen, $idtingkat); ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas *)</label>
					<div class="col-sm-3">
						<select name="idkelas1" id="idkelas1" disabled="" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_kelas($idtingkat, $idkelas); ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semester</label>
					<div class="col-sm-3">
						: <?= $numeric_semester ?>
					</div>
				</div>
				
				
				<table class="table table-bordered table-condensed table-hover table-striped" style="font-size: 12px">	
		
					<?php
						if($_POST['submit']) {
								$time_start = date('Y-m-d H:i');

								$uid		=	$_SESSION["loginname"];
								$dlu		=	date("Y-m-d H:i:s");
								$idtema 		=		$_POST['idtema'];

								$jmldata = $_POST['jmldata'];
								for($x=0; $x<$jmldata; $x++) {
										$idsiswa 		=		$_POST["idsiswa_".$x.""];
										$nama 			=		$_POST["nama_".$x.""];
										$rangkuman_proses_id = numberreplace($_POST['rangkuman_proses_id_'.$x.'']);
										
										$jmldet 	=	$_POST['jmldet_'.$x.''];
										for($y=0; $y<$jmldet; $y++) {
												$iddimensi 		=	$_POST['iddimensi_'.$x.$y.''];

												$jmldet1 	=	$_POST['jmldet1_'.$x.$y.''];
												for($z=0; $z<$jmldet1; $z++) {

														$jmldet2 	=	$_POST['jmldet2_'.$x.$y.$z.''];
														for($s=0; $s<$jmldet2; $s++) {
															$idnilai 		=		$_POST['idnilai_'.$x.$y.$z.$s.''];
															$datanilai_id =		$_POST['datanilai_id_'.$x.$y.$z.$s.''];
															$raport_line =		$_POST['raport_line_'.$x.$y.$z.$s.''];
															$nilai 			=		$_POST['nilai_'.$x.$y.$z.$s.''];
															$line 			=		$_POST['line_'.$x.$y.$z.$s.''];
															$syscode 		=		$_POST['syscode_'.$x.$y.$z.$s.''];
															$raport_p5_id =		$_POST['raport_p5_id_'.$x.$y.$z.$s.''];
															
															$mulai 		=	0;
															$sedang 	=	0;
															$sesuai 	=	0;
															$sangat 	=	0;
															if($nilai == 1) { $mulai = 1; }
															if($nilai == 2) { $sedang = 2; }
															if($nilai == 3) { $sesuai = 3; }
															if($nilai == 4) { $sangat = 4; }

															/*$sqlstr = "select replid, syscode from raport_p5 where departemen='SMA' and idtingkat='$idtingkat' and	idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and	idsemester='$semester_id'	and idsiswa='$idsiswa' and deskripsi_p5_id='$idtema' and syscode='$raport_line' ";
															$sqlx=$dbpdo->prepare($sqlstr);
															$sqlx->execute();
															$rows = $sqlx->rowCount();
															$data_raport_p5 = $sqlx->fetch(PDO::FETCH_OBJ);
															$idnilaip5 = $data_raport_p5->syscode;
															$idheader = $data_raport_p5->replid;*/

															$sqlstr = "update raport_p5 set rangkuman_proses_id='$rangkuman_proses_id', uid='$uid', updated='$dlu' where syscode='$syscode' and idsiswa='$idsiswa' ";
															$sql=$dbpdo->prepare($sqlstr);
															$sql->execute();

															$sqlstr = "update raport_p5_nilai set mulai='$mulai', sedang='$sedang', sesuai='$sesuai', sangat='$sangat' where replid='$idnilai' and syscode='$syscode' and raport_p5_id='$raport_p5_id' and line='$line'";
															$sqlx=$dbpdo->prepare($sqlstr);
															$sqlx->execute();
														}
												}
										}
								}
								
					?>		
								<tr align="center" style="font-weight: bold; font-size: 16px; background-color: #d2fdd4">
									<td colspan="7">
										<?php 
											/*$time_finish = date('Y-m-d H:i');
											echo "Time Start : ".$time_start."<br>";*/
											echo "Proses Rapor P5 Sukses..."."<br>"; 
											//echo "Time Finish : ".$time_finish."<br>";
										?>	
									</td>
								</tr>
					<?php
								exit;
							}
					?>

					<tr align="center" style="font-weight: bold">
						<td>No.</td>
						<td>NIS</td>
						<td>Nama Lengkap</td>
						<td>Penilaian</td>
					</tr>

					<input type="hidden" name="idtema" id="idtema" value="<?= $idtema ?>">

					<?php			
							//cek penugasan guru
            	//if(allow_guru_kelas('', $_SESSION['idguru'], $idtingkat, $idkelas) != "" || $_SESSION['adm'] == 1) {
            
            		if($alumni == 1) {
									$sql=$selectview->list_siswa_riwayat('', '', $idtingkat, $idkelas, $nama, $all, 'SMA', '', '', '1', '1');
								} else {
	                if($old == 0) {
										$sql=$selectview->get_siswa_raport_p5('', $iddetail, $idtingkat, $idkelas, $nama, $all, 'SMA', '', '', '1');
									} else {
										$sql=$selectview->list_siswa_riwayat_raport_p5('', '', $idtingkat, $idkelas, $nama, $all, 'SMA', '', '', '1', '', '', '', $iddetail);
									}
								}

							//}

							$i = 0;
							$rowsiswa=$sql->rowCount();
							while($siswa_view=$sql->fetch(PDO::FETCH_OBJ)){
							
								$idsiswa = $siswa_view->replid;
							
								if($idtahunajaran == "") {
									$idtahunajaran = $_SESSION['idtahunajaran'];
								}
					?>
								<input type="hidden" name="idsiswa_<?= $i ?>" id="idsiswa_<?= $i ?>" value="<?= $siswa_view->replid ?>">
								<input type="hidden" name="nama_<?= $i ?>" id="nama_<?= $i ?>" value="<?= $siswa_view->nama ?>">

								<tr>
										<td><?= ($i+1) ?></td>
										<td><?= $siswa_view->nis ?></td>
										<td><?= $siswa_view->nama ?></td>
										<td>
												<?php
													$sqlz=$select->list_deskripsi_raport_p5($idtema);
													$deskripsi_raport_p5_view=$sqlz->fetch(PDO::FETCH_OBJ);

													$sqltema = $select->list_raport_p5('', '', '', '', '', '', '', $syscode, $idsiswa);
													$datatema = $sqltema->fetch(PDO::FETCH_OBJ);
													$tema = $datatema->tema;
													$nama_tema = $datatema->nama_tema;
												?>
												<b>Topik : <?php echo $tema ?></b><br>
												<b>Tema : <?php echo $nama_tema ?></b><br><br>
												<table width="100%" border="1" style="border: 1px solid #93d145; padding: 10px; font-size: 11px" id="detail_<?= $y?>">
                      		<tr style="background: #d3fe7a; font-weight: bold;">
                      			<td align="center">No.</td>
                      			<td align="center" colspan="5">Dimensi</td>
                      			<td align="center" style="background-color: #90b5f3">Catatan Proses</td>
                      			<td align="center">Mulai Berkembang</td>
                      			<td align="center">Sedang Berkembang</td>
                      			<td align="center">Berkembang Sesuai Harapan</td>
                      			<td align="center">Sangat Berkembang</td>
													</tr>					
													<?php
														$no = 0;
														$sql2=$select->list_raport_p5_dimensi('', '', '', '', '', $idsiswa, $syscode, $datatema->replid); 	 
	                    			while($row_det=$sql2->fetch(PDO::FETCH_OBJ)) {	
	                  			?>
	                  						<tr style="font-weight: bold; background-color: #c3bfca;">
			                  					<td align="center"><?php echo ($no+1); ?>.</td>
			                      			<td colspan="5">
			                      					<?php echo $row_det->dimensi ?>
			                      			</td>
			                      		</tr>

			                      		<?php
																	$j = 0;
																	$sql3=$select->list_raport_p5_elemen('', $row_det->dimensi_id, $idsiswa, $syscode, $datatema->replid); 
				                    			while($row_elemen=$sql3->fetch(PDO::FETCH_OBJ)) {	
				                  			?>
				                  						<tr style="font-weight: bold; background-color: #ebf0d6;">
						                  					<td align="center"></td>
						                  					<td align="center" width="2%">:></td>
						                      			<td colspan="4">
						                      					<?php echo $row_elemen->elemen ?>
						                      			</td>
						                      		</tr>

						                      		<?php
																				$x = 0;
																				$sql4=$select->list_raport_p5_subelemen('', $row_elemen->replid, $idsiswa, $syscode); 
							                    			while($row_subelemen=$sql4->fetch(PDO::FETCH_OBJ)) {	

							                    					if($row_subelemen->mulai == 0 && $row_subelemen->sedang == 0 && $row_subelemen->sesuai == 0 && $row_subelemen->sangat == 0) {
						                      						$mulai 		=	"";
																							$sedang 	=	"";
																							$sesuai 	=	"checked";
																							$sangat 	=	"";
						                      					} else {
						                      						$mulai 		=	"";
																							$sedang 	=	"";
																							$sesuai 	=	"";
																							$sangat 	=	"";
																							if($row_subelemen->mulai == 1) { $mulai = "checked"; }
																							if($row_subelemen->sedang == 2) { $sedang = "checked"; }
																							if($row_subelemen->sesuai == 3) { $sesuai = "checked"; }
																							if($row_subelemen->sangat == 4) { $sangat = "checked"; }
						                      					}

						                      					$rangkuman_proses_id 	=	"";
						                      					if($datatema->rangkuman_proses_id == $row_subelemen->replid) {
						                      							$rangkuman_proses_id 	=	"checked";
						                      					}
							                  			?>
							                  						<tr style="font-weight: bold; background-color: #ffffff;">
									                  					<td align="center"></td>
									                  					<td align="center"></td>
									                  					<td align="center" width="2%">*</td>
									                      			<td colspan="3">
									                      					<?php echo $row_subelemen->deskripsi ?>
									                      			</td>

									                      			<input type="hidden" name="raport_p5_id_<?= $i.$no.$j.$x ?>" id="raport_p5_id_<?= $i.$no.$j.$x ?>" value="<?= $row_elemen->raport_p5_id ?>">
									                      				<input type="hidden" name="idnilai_<?= $i.$no.$j.$x ?>" id="idnilai_<?= $i.$no.$j.$x ?>" value="<?= $row_subelemen->replid ?>">
									                    					<input type="hidden" name="line_<?= $i.$no.$j.$x ?>" id="line_<?= $i.$no.$j.$x ?>" value="<?= $row_subelemen->line ?>">
									                    					<input type="hidden" name="syscode_<?= $i.$no.$j.$x ?>" id="syscode_<?= $i.$no.$j.$x ?>" value="<?= $row_subelemen->syscode ?>">

									                      			<td align="center" style="background-color: #ebf2ca;">
									                      				<input type="radio" class="ace" name="rangkuman_proses_id_<?= $i ?>" id="rangkuman_proses_id_<?= $i.$no.$j.$x ?>" value="<?= $row_subelemen->replid ?>" <?= $rangkuman_proses_id ?> ><span class="lbl"></span>
									                      			</td>
									                      			<td align="center">
									                      				<input type="radio" class="ace" name="nilai_<?= $i.$no.$j.$x ?>" id="nilai1_<?= $i.$no.$j.$x ?>" value="1" <?= $mulai ?>><span class="lbl"></span>
									                      			</td>
									                      			<td align="center">
									                      				<input type="radio" class="ace" name="nilai_<?= $i.$no.$j.$x ?>" id="nilai1_<?= $i.$no.$j.$x ?>" value="2" <?= $sedang ?>><span class="lbl"></span>
									                      			</td>
									                      			<td align="center">
									                      				<input type="radio" class="ace" name="nilai_<?= $i.$no.$j.$x ?>" id="nilai1_<?= $i.$no.$j.$x ?>" value="3" <?= $sesuai ?>><span class="lbl"></span>
									                      			</td>
									                      			<td align="center">
									                      				<input type="radio" class="ace" name="nilai_<?= $i.$no.$j.$x ?>" id="nilai1_<?= $i.$no.$j.$x ?>" value="4" <?= $sangat ?>><span class="lbl"></span>
									                      			</td>
									                      		</tr>
							                  			<?php
							                  					$x++;
							                  				}
							                  			?>

							                  			<input type="hidden" name="jmldet2_<?= $i.$no.$j ?>" id="jmldet2_<?= $i.$no.$j ?>" value="<?= $x ?>" >
				                  			<?php
				                  					$j++;
				                  				}
				                  			?>

				                  			<input type="hidden" name="jmldet1_<?= $i.$no ?>" id="jmldet1_<?= $i.$no ?>" value="<?= $j ?>" >
	                  			<?php
	                  					$no++;
	                  				}
	                  			?>

                  			<input type="hidden" name="jmldet_<?= $i ?>" id="jmldet_<?= $i ?>" value="<?= $no ?>" >

											</table>
										</td>
								</tr>
					<?php
							$i++;
						}
					?>

					<input type="hidden" name="jmldata" id="jmldata" value="<?= $i ?>" >

					<tr>
							<td></td>
							<td></td>
							<td>
								<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Proses Nilai" onClick="return confirm('Apakah yakin data sudah benar?')" />
							</td>
					</tr>
				</table>
			</form>
            
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->



<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='../<?php echo $__folder ?>assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='../<?php echo $__folder ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
  <script src="../<?php echo $__folder ?>assets/js/excanvas.min.js"></script>
<![endif]-->
<script src="../<?php echo $__folder ?>assets/js/jquery-ui.custom.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/chosen.jquery.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/fuelux.spinner.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/moment.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/daterangepicker.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap-colorpicker.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.knob.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.autosize.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.maskedinput.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/bootstrap-tag.min.js"></script>

<script src="../<?php echo $__folder ?>assets/js/jquery.dataTables.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/dataTables.tableTools.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/dataTables.colVis.min.js"></script>

<!-- ace scripts -->
<script src="../<?php echo $__folder ?>assets/js/ace-elements.min.js"></script>
<script src="../<?php echo $__folder ?>assets/js/ace.min.js"></script>

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