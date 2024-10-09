<script type="text/javascript" src="<?= $__folder ?>js/buttonajax.js"></script>

<script type="text/javascript">

	function checkvalidasi() {

		var old_ta = document.getElementById('old_ta').checked;
		var departemen_head = document.getElementById('departemen_head').value;
		var departemen_sekolah_id_head = document.getElementById('departemen_sekolah_id_head').value;
		var tahunajaran_id_head = document.getElementById('tahunajaran_id_head').value;
		var idtingkat_head = document.getElementById('idtingkat_head').value;
		var idkelas_head = document.getElementById('idkelas_head').value;
		var semester_id_head = document.getElementById('semester_id_head').value;
		
		if(old_ta == true) {
			$('input[name=departemen]').val(departemen_head);	
			var departemen = document.getElementById('departemen').value;

			$('input[name=departemen_sekolah_id]').val(departemen_sekolah_id_head);	
			var departemen_sekolah_id = document.getElementById('departemen_sekolah_id').value;

			$('input[name=tahunajaran_id]').val(tahunajaran_id_head);	
			var tahunajaran_id = document.getElementById('tahunajaran_id').value;

			$('input[name=idtingkat]').val(idtingkat_head);	
			var idtingkat = document.getElementById('idtingkat').value;

			$('input[name=idkelas]').val(idkelas_head);
			var idkelas = document.getElementById('idkelas').value;

			$('input[name=semester_id]').val(semester_id_head);
			var semester_id = document.getElementById('semester_id').value;
		} else {
			var departemen = document.getElementById('departemen').value;
			var departemen_sekolah_id = document.getElementById('departemen_sekolah_id').value;
			var tahunajaran_id = document.getElementById('tahunajaran_id').value;	
			var idtingkat = document.getElementById('idtingkat').value;
			var idkelas = document.getElementById('idkelas').value;
			var semester_id = document.getElementById('semester_id').value;
		}
		
		if(departemen == "") {
			alert("Unit tidak boleh kosong!!!");
			return false
		}

		if(departemen_sekolah_id == "") {
			alert("Nama Sekolah tidak boleh kosong!!!");
			return false
		}

		if(tahunajaran_id == "") {
			alert("Tahun Ajaran tidak boleh kosong!!!");
			return false
		}
		if(idtingkat == "") {
			alert("Tingkat tidak boleh kosong!!!");
			return false
		}
		if(idkelas == "") {
			alert("Kelas tidak boleh kosong!!!");
			return false
		}
		if(semester_id == "") {
			alert("Semester tidak boleh kosong!!!");
			return false
		}

		var guru_id = document.getElementById('guru_id').value;
		if(guru_id == "") {
			alert("Koordinator/Fasilitator tidak boleh kosong!!!");
			return false
		}

		var semua_siswa = document.getElementById('semua_siswa').checked;
		if(semua_siswa == false) {
			var idsiswa = document.getElementById('idsiswa').value;
			if(idsiswa == "") {
				alert("Siswa tidak boleh kosong!!!");
				return false
			}
		}

		var tema_id = document.getElementById('tema_id').value;
		if(tema_id == "") {
			alert("Tema tidak boleh kosong!!!");
			return false
		}

		var tema = document.getElementById('tema').value;
		if(tema == "") {
			alert("Topik tidak boleh kosong!!!");
			return false
		}

	} 
</script>

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId, __folder){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;	
		str1 = __folder + '=' + document.getElementById(__folder).value;		
		var str = str + '&' + str1 + '&button=' + button;
		
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
	function deskripsi_raport_p5_proses(idtingkat, idkelas, semester_id, idtahunajaran, idtema, iddetail) 
	{
			var semester_id		= document.getElementById('semester_id').value;
			//var idtahunajaran	= document.getElementById('idtahunajaran2').value;
			var idtingkat		= document.getElementById('idtingkat').value;
			var idkelas			= document.getElementById('idkelas').value;
			
			window.open("app/deskripsi_raport_p5_proses.php?idtingkat="+idtingkat+"&idkelas="+idkelas+"&semester_id="+semester_id+"&idtahunajaran="+idtahunajaran+"&idtema="+idtema+"&iddetail="+iddetail,"Find","width=1000,height=600,left=50,top=10,toolbar=0,status=0,scroll=1,scrollbars=yes");
	}
</script>

<?php

	$departemen	= $_REQUEST['departemen_head'];
	$departemen_sekolah_id	= $_REQUEST['departemen_sekolah_id_head'];
	$tahunajaran_id	= $_REQUEST['tahunajaran_id_head'];
	$tingkat_id		= $_REQUEST['idtingkat_head'];
	$idkelas 		= $_REQUEST['idkelas_head'];
	$semester_id	= $_REQUEST['semester_id_head'];
	$pelajaran_id	= $_REQUEST['pelajaran_id'];
	$guru_id		= $_REQUEST['guru_id'];

	if($tahunajaran_id == "") {
		$tahunajaran_id = $_SESSION['idtahunajaran'];
	}
	if($semester_id == "") {
		$semester_id = $_SESSION['semester_id'];
	}

	$idpegawai 		= "";
	if($_SESSION['tipe_user'] == "Guru") {
		$idpegawai 		= $_SESSION["idpegawai"];
	}

?>

<div class="page-content">	
	<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
				<div class="alert alert-block alert-success">
					<button type="button" class="close" data-dismiss="alert">
						<i class="ace-icon fa fa-times"></i>
					</button>

					<i class="ace-icon fa fa-check green"></i>
					<strong class="yellow">
						Langkah-langkah input Rapor P5 Tahun Ajaran sebelumnya:<br>
						------------------------------------------------------------------------------------------<br>
						1. Pilih Tahun Ajaran sekarang<br>
						2. Pilih Tingkat sekarang<br>
						3. Pilih Kelas sekarang<br>
						4. Pilih Semester sekarang<br>
						5. Klik Tampilkan Siswa<br>
						6. Pilih nama-nama Siswa (di Kelompok Siswa)<br><br>

						7. Ceklist Tahun Ajaran sebelumnya <b><font style="color: red">(jangan tekan lagi Tampilkan Siswa)</font></b><br>
						8. Pilih Tingkat sebelumnya<br>
						9. Pilih Kelas sebelumnya<br>
						10. Pilih Semester sebelumnya<br>
						11. Klik Simpan (kalau sudah diisi semua)
					</strong>
				</div>
			</div>
	</div>	


	<div class="row">
		<div class="col-xs-12">
                
      <?php
				if($_POST['submit'] == "Simpan") {
					include("app/exec/raport_p5_insert.php");
				}
			?>
                
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
				
					<form class="form-horizontal" role="form" action="" method="post" name="deskripsi_raport_p5_view" id="deskripsi_raport_p5_view" enctype="multipart/form-data" >

						<input type="hidden" name="__folder" id="__folder" value="<?= $__folder ?>">
		            	
		        <div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Unit *)</label>
							<div class="col-sm-3">
								<select name="departemen_head" id="departemen_head" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','sekolah_id','getsekolah_tingkat_head','departemen_head','__folder')" >
									<option value=""></option>
									<?php select_departemen($departemen); ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Sekolah *)</label>
							<div class="col-sm-4" id="sekolah_id">
								<select name="departemen_sekolah_id_head" id="departemen_sekolah_id_head" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','tingkat_id','getkelas_tingkat_sekolah_head','departemen_sekolah_id_head','__folder')">
									<option value=""></option>
									<?php select_sekolah_unit($departemen, $departemen_sekolah_id); ?>
								</select>
							</div>
						</div>

		        <div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tahun Ajaran *)</label>
							<div class="col-sm-3">
								<select name="tahunajaran_id_head" id="tahunajaran_id_head" class="chosen-select form-control" >
									<option value=""></option>
									<?php select_thnajaran_all($tahunajaran_id) ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tingkat *)</label>
							<div class="col-sm-3" id="tingkat_id">
								<select name="idtingkat_head" id="idtingkat_head" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','kelas_id','getkelas_departemen_sekolah_head','idtingkat','__folder')" >
									<option value=""></option>
									<?php select_tingkat_sekolah($departemen_sekolah_id, $tingkat_id); ?>
								</select>								
							</div>
						</div>
						
		        		<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas *)</label>
							<div class="col-sm-3" id="kelas_id">
								<select name="idkelas_head" id="idkelas_head" class="chosen-select form-control" >
									<option value=""></option>
									<?php select_kelas($tingkat_id, $idkelas); ?>
								</select>								
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semester *)</label>
							<div class="col-sm-3">						
								<select name="semester_id_head" id="semester_id_head" class="chosen-select form-control" >
									<option value=""></option>
									<?php select_semester_all('SMA',$semester_id) ?>
								</select>						
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">&nbsp;</label>
                <div class="col-sm-5">
                  <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Tampilkan Siswa"/>
                </div>  
						</div>
					</form>
				</div>
			</div>
			
			<form class="form-horizontal" role="form" action="" method="post" name="raport_p5" id="raport_p5" enctype="multipart/form-data" onsubmit="return checkvalidasi()" >
				<div class="row">
					<div class="col-xs-12">
						<div class="clearfix">
							<div class="pull-right tableTools-container"></div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">&nbsp;</label>
                <div class="col-sm-5">
                  <input type="checkbox" class="ace" name="old_ta" id="old_ta" value="1"><span class="lbl">&nbsp;&nbsp;<b style="color: blue">Ceklist Tahun ajaran sebelumnya</b></span>
                </div>  
						</div>

						<div class="form-group">
		          <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Catatan</label>
		          
		          <div class="col-sm-6" style="color: #ff0000">
		          	<b>Setelah Tampilkan Siswa</b><br>
		          	Jika ingin input Rapor P5 Tahun Ajaran sebelumnya, pilih Tahun Ajaran, Tingkat, Kelas dan Semester sebelumnya (Tidak perlu tekan Tampilkan Siswa, langsung tekan Simpan saja).
							</div>                    
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Koordinator/Fasilitator *)</label>
							<div class="col-sm-4">						
								<select name="guru_id" id="guru_id" class="chosen-select form-control" >
									<option value=""></option>
									<?php //select_guru_mengajar($guru_id) ?>
									<?php 
											//select_guru_mengajar_view($guru_id, $idpegawai) 
											select_petugas($guru_id);
									?>
								</select>						
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelompok Siswa *)</label>
							<div class="col-sm-6">
								<select multiple="" class="chosen-select form-control" id="idsiswa" name="idsiswa[]" data-placeholder="Choose a Paper...">
	                	<option value=""></option>
	                  <?php select_siswa_multi($idsiswa, $idkelas); ?>
	              </select><br>
		            <input type="checkbox" name="semua_siswa" id="semua_siswa" class="ace" value="1"><span class="lbl" style="color: red">&nbsp; Ceklist, jika semua siswa kelas tersebut</span>							
							</div>
						</div>
					
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tema *)</label>
							<div class="col-sm-4">						
								<select name="tema_id" id="tema_id" class="chosen-select form-control" >
									<option value=""></option>
									<?php select_raport_p5_tema($deskripsi_raport_p5_data->tema_id) ?>
								</select>						
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Topik *)</label>
							<div class="col-sm-4">						
								<textarea id="tema" name="tema" class="form-control" autocomplete="off" rows="5"><?= $deskripsi_raport_p5_data->tema ?></textarea>					
							</div>
						</div>

						<!-- div.dataTables_borderWrap -->
						<div>
							<table id="simple-table" class="table table-striped table-bordered table-hover">

								<input type="hidden" name="departemen" id="departemen" value="<?= $departemen ?>">
								<input type="hidden" name="departemen_sekolah_id" id="departemen_sekolah_id" value="<?= $departemen_sekolah_id ?>">
								<input type="hidden" name="tahunajaran_id" id="tahunajaran_id" value="<?= $tahunajaran_id ?>">
								<input type="hidden" name="idtingkat" id="idtingkat" value="<?= $tingkat_id ?>">
								<input type="hidden" name="idkelas" id="idkelas" value="<?= $idkelas ?>">
								<input type="hidden" name="semester_id" id="semester_id" value="<?= $semester_id ?>">

								<thead>
									<tr>
	                  <th class="center" style="font-weight:bold ">No.</th>
										<th style="font-weight:bold ">Tahun Ajaran &nbsp;&nbsp;</th>
										<th style="font-weight:bold ">Dimensi &nbsp;&nbsp;</th>
									</tr>
								</thead>

								<tbody>
									<?php			
                    $i = 0;
        						$sql=$select->get_deskripsi_raport_p5("", $tahunajaran_id, '', '', '', '', $departemen, $departemen_sekolah_id);
				            while($deskripsi_raport_p5_view=$sql->fetch(PDO::FETCH_OBJ)){
	            							
									?>
	                                        
                    <input type="hidden" name="raport_p5_id_<?= $i ?>" id="raport_p5_id_<?= $i ?>" value="<?= $deskripsi_raport_p5_view->replid ?>">    
                    <tr>
                        <td><?php echo $i+1 ?></td>
												<td><?php echo $deskripsi_raport_p5_view->tahunajaran ?></td>
												<td>
													<table width="100%" border="1" style="border: 1px solid #93d145;" id="detail_<?= $y?>">
                        		<tr style="background: #d3fe7a">
                        			<td align="center">No.</td>
                        			<td align="center">Dimensi</td>
														</tr>													
														<?php
															$no = 0;
															$sql2=$select->get_deskripsi_raport_p5_dimensi($deskripsi_raport_p5_view->replid); 
                        			$rowsno=$sql2->rowCount();
                        			while($row_det=$sql2->fetch(PDO::FETCH_OBJ)) {	 
                      			?>
                      					<input type="hidden" name="raport_p5_dimensi_id_<?= $i.$no ?>" id="raport_p5_dimensi_id_<?= $i.$no ?>" value="<?= $row_det->replid ?>">

                        				<tr style="font-weight: bold;">
                        					<td align="center"><?php echo ($no+1); ?>.</td>
                            			<td><?php echo $row_det->dimensi ?></td>
                            			<td align="center">
					                        	<input type="checkbox" name="pilih_<?= $i.$no ?>" id="pilih_<?= $i.$no ?>" value="1" class="ace input-lg" checked ><span class="lbl bigger-120"></span>
					                        </td>
                            		</tr>
                            		<tr>
                        					<td align="center"></td>
                            			<td>
                            				<table width="100%" border="1" style="border: 1px solid #93d145;">
	                            				<?php
	                            					$x=0;
	                            					$sqlsub = $select->get_deskripsi_raport_p5_elemen($row_det->replid);
	                            					while($datasub = $sqlsub->fetch(PDO::FETCH_OBJ)) {
	                            				?>
	                            						<input type="hidden" name="raport_p5_elemen_id_<?= $i.$no.$x ?>" id="raport_p5_elemen_id_<?= $i.$no.$x ?>" value="<?= $datasub->replid ?>">

	                            						<tr style="background: #465fbe; color: white; font-weight: bold;">
					                            			<td align="center" width="2%">:></td>
					                            			<td colspan="2" align="left"><?= $datasub->elemen ?></td>
					                            			<td align="center">
					                            				<input type="checkbox" class="ace input-lg" name="select_elemen_<?= $i.$no.$x ?>" id="select_elemen_<?= $i.$no.$x ?>" value="1" checked ><span class="lbl bigger-120"></span>
						                            		</td>
																					</tr>

																					<!-- elemen dimensi -->
																					<?php
			                            					$y=0;
			                            					$sqlsubelemen = $select->get_deskripsi_raport_p5_nilai($row_det->replid, $datasub->replid);
			                            					while($datasubelemen = $sqlsubelemen->fetch(PDO::FETCH_OBJ)) {
			                            				?>
			                            						<input type="hidden" name="raport_p5_subelemen_id_<?= $i.$no.$x.$y ?>" id="raport_p5_subelemen_id_<?= $i.$no.$x.$y ?>" value="<?= $datasubelemen->replid ?>">

			                            						<tr style="background: #eff5f8">
							                            			<td align="center" width="2%"></td>
							                            			<td align="center" width="2%">*</td>
							                            			<td align="left"><?= $datasubelemen->deskripsi ?></td>
							                            			<td align="center">
							                            				<input type="checkbox" class="ace" name="select_subelemen_<?= $i.$no.$x.$y ?>" id="select_subelemen_<?= $i.$no.$x.$y ?>" value="1" checked ><span class="lbl"></span>
							                            			</td>
																							</tr>
			                            				<?php
			                            						$y++;
			                            					}
			                            				?>

			                            				<input type="hidden" name="jmldata_subelemen_<?= $i.$no.$x ?>" id="jmldata_subelemen_<?= $i.$no.$x ?>" value="<?= $y ?>">
	                            				<?php
	                            						$x++;
	                            					}
	                            				?>
	                            			</table>

                            			</td>

                            		</tr>
                            		<input type="hidden" name="jmldata_elemen_<?= $i.$no ?>" id="jmldata_elemen_<?= $i.$no ?>" value="<?= $x ?>">
                      			<?php
                      					$no++;
                      				}
                      			?>
													</table>
												</td>				
											                      
											</tr>

											<input type="hidden" name="jmldata_dimensi_<?= $i ?>" id="jmldata_dimensi_<?= $i ?>" value="<?= $no ?>">
                  <?php
                  		$i++;
                      }
                  ?>
								</tbody>
							</table>
						</div>

						<div class="space-4"></div>

						<div class="clearfix form-actions">
							<div class="col-md-offset-3 col-md-9">
		                        
                <?php if (allowadd('raport_p5')==1) { ?>
  								<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" onClick="return confirm('Yakin data sudah benar?')" />
                <?php } ?>
		                        
		            &nbsp;
								<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('raport_p5_view') ?>'" />
							</div>
						</div>

						<input type="hidden" name="jmldata" id="jmldata" value="<?= $i ?>">

					</div>
				</div>
			</form>

		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->
            			


<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='<?php echo $__folder ?>assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo $__folder ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="<?php echo $__folder ?>assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
  <script src="<?php echo $__folder ?>assets/js/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo $__folder ?>assets/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/chosen.jquery.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/fuelux.spinner.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/moment.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.knob.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.autosize.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-tag.min.js"></script>

<script src="<?php echo $__folder ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/dataTables.colVis.min.js"></script>

<!-- ace scripts -->
<script src="<?php echo $__folder ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/ace.min.js"></script>

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
	
		//set timepicker------
		$('#date_time').timepicker({
			minuteStep: 1,
			showSeconds: true,
			showMeridian: false
		}).next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
		
		$('#finish_time').timepicker({
			minuteStep: 1,
			showSeconds: true,
			showMeridian: false
		}).next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
		//-----------/\--------
		
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
