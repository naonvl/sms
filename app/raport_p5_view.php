<script type="text/javascript" src="js/buttonajax.js"></script>

<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "<?php echo $__folder ?><?php echo obraxabrix('raport_p5_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
		}
	}

	function newform() {
		document.location.href = "<?php echo obraxabrix('raport_p5') ?>";
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
	function raport_p5_proses(idtingkat, idkelas, semester_id, idtahunajaran, idtema, iddetail, syscode, old, departemen, departemen_sekolah_id) 
	{
		window.open("app/raport_p5_proses.php?idtingkat="+idtingkat+"&idkelas="+idkelas+"&semester_id="+semester_id+"&idtahunajaran="+idtahunajaran+"&idtema="+idtema+"&iddetail="+iddetail+"&syscode="+syscode+"&old="+old+"&departemen="+departemen+"&departemen_sekolah_id="+departemen_sekolah_id,"Find","width=auto,height=600,left=50,top=10,toolbar=0,status=0,scroll=1,scrollbars=yes");
	}

	function raport_p5_print(idsiswa, idtingkat, idkelas, semester_id, idtahunajaran, idtema, iddetail, alumni, line, departemen_id, departemen_sekolah_id) 
	{
		window.open('<?php echo $__folder ?>app/raport_p5_print.php?idsiswa='+idsiswa+'&semester_id='+semester_id+'&idkelas='+idkelas+'&idtahunajaran='+idtahunajaran+'&idtema='+idtema+'&alumni='+alumni+'&idtingkat='+idtingkat+'&line='+line+'&departemen_id='+departemen_id+'&departemen_sekolah_id='+departemen_sekolah_id, 'Rapor P5 Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}

	function raport_p5_kelompok_print(idsiswa, idtingkat, idkelas, semester_id, idtahunajaran, idtema, iddetail, alumni, line, departemen_id, departemen_sekolah_id) 
	{
		window.open('<?php echo $__folder ?>app/raport_p5_kelompok_print.php?idsiswa='+idsiswa+'&semester_id='+semester_id+'&idkelas='+idkelas+'&idtahunajaran='+idtahunajaran+'&idtema='+idtema+'&iddetail='+iddetail+'&alumni='+alumni+'&idtingkat='+idtingkat+'&line='+line+'&departemen_id='+departemen_id+'&departemen_sekolah_id='+departemen_sekolah_id, 'Rapor P5 Print','825','450','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
</script>

<?php
$departemen		= $_REQUEST['departemen'];
$departemen_sekolah_id	= $_REQUEST['departemen_sekolah_id'];
$tahunajaran_id	= $_REQUEST['tahunajaran_id'];
$tingkat_id		= $_REQUEST['idtingkat'];
$idkelas 		= $_REQUEST['idkelas'];
$semester_id	= $_REQUEST['semester_id'];
$pelajaran_id	= $_REQUEST['pelajaran_id'];
$guru_id		= $_REQUEST['guru_id'];
$idtema_view 	= $_REQUEST['idtema_view'];
$all			= $_REQUEST['all'];
$idpegawai 		= "";

$all2 = "";
if($all == 1) {
	$all2 = "checked";
}

if($_SESSION['tipe_user'] == "Guru") {
	$idpegawai 		= $_SESSION["idpegawai"];
}

?>

<div class="page-content">	
	<div class="row">
		<div class="col-xs-12" align="left">
		
			<form class="form-horizontal" role="form" action="" method="post" name="user_view" id="user_view" class="form-horizontal" enctype="multipart/form-data" >
            	
				<div class="form-group">
					<div class="col-sm-3">
            			<button type="button" class="btn btn-white btn-info btn-bold" onclick="newform()">
							<i class="ace-icon fa fa-plus bigger-120 blue"></i>
							Input Rapor P5
						</button>
					</div>
				</div>
			</form>
		
		</div>

		<div class="col-xs-12">
                
            <?php
				$delete = $segmen3; //$_REQUEST['mxKz'];
                
				if ($delete == "xm8r389xemx23xb2378e23") {
					include 'class/class.delete.php';
					$delete2=new delete;
					$delete2->delete_raport_p5($segmen4);
			?>
					<div class="alert alert-success">
						<strong>Delete Data successfully</strong>
					</div>
                    
                    <meta http-equiv="Refresh" content="0;url=<?php echo $__folder ?><?php echo obraxabrix('raport_p5_view') ?>" />
			<?php
                    
                    
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
								<select name="departemen" id="departemen" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','sekolah_id','getsekolah_tingkat_p5view','departemen','__folder')" >
									<option value=""></option>
									<?php select_departemen($departemen); ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Sekolah *)</label>
							<div class="col-sm-4" id="sekolah_id">
								<select name="departemen_sekolah_id" id="departemen_sekolah_id" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','tingkat_id','getkelas_tingkat_sekolah_p5view','departemen_sekolah_id','__folder')">
									<option value=""></option>
									<?php select_sekolah_unit($departemen, $departemen_sekolah_id); ?>
								</select>
							</div>
						</div>
						
		            	<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tahun Ajaran</label>
							<div class="col-sm-3">
								<select name="tahunajaran_id" id="tahunajaran_id" class="chosen-select form-control" >
									<option value=""></option>
									<?php select_thnajaran_all($tahunajaran_id) ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tingkat</label>
							<div class="col-sm-3" id="tingkat_id">
								<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('<?php echo $__folder ?>app/raport_p5_ajax.php','kelas_id','getkelas_departemen_sekolah_p5view','idtingkat','__folder')" >
									<option value=""></option>
									<?php select_tingkat_sekolah($departemen_sekolah_id, $tingkat_id); ?>
								</select>								
							</div>
						</div>
						
		        		<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas</label>
							<div class="col-sm-3" id="kelas_id">
								<select name="idkelas" id="idkelas" class="chosen-select form-control" >
									<option value=""></option>
									<?php select_kelas($tingkat_id, $idkelas); ?>
								</select>								
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semester</label>
							<div class="col-sm-3">						
								<select name="semester_id" id="semester_id" class="chosen-select form-control" >
									<option value=""></option>
									<?php select_semester_all('SMA',$semester_id) ?>
								</select>						
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Koordinator/Fasilitator</label>
							<div class="col-sm-4">						
								<select name="guru_id" id="guru_id" class="chosen-select form-control" >
									<option value=""></option>
									<?php 
										select_petugas($guru_id);
										//select_guru_mengajar_view($guru_id, $idpegawai) 
									?>
								</select>						
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tema</label>
							<div class="col-sm-4">						
								<select name="idtema_view" id="idtema_view" class="chosen-select form-control" >
									<option value=""></option>
									<?php select_tema_raport_p5($idtema_view) ?>
								</select>						
							</div>
						</div>
												
						<div class="form-group">
		                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semua</label>
		                    
		                    <div class="col-sm-3">
		                    	 <input id="all" name="all" type="checkbox" class="ace" value="1" <?php echo $all2 ?> ><span class="lbl"></span>
							</div>
		                    
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">&nbsp;</label>
		                    <div class="col-sm-3">
		                      <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Preview"/>
		                    </div>  
						</div>
						
						
						
					</form>
				
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12">
					<div class="clearfix">
						<div class="pull-right tableTools-container"></div>
					</div>
					<!-- div.dataTables_borderWrap -->
					<div>
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
                                    <th class="center" style="font-weight:bold ">No.</th>
									<th style="font-weight:bold ">Topik &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Tahun Ajaran &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Semester &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Koordinator/Fasilitator &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Tingkat &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Kelas &nbsp;&nbsp;</th>
									<th>Edit/Hapus</th>
								</tr>
							</thead>

							<tbody>
                                <?php			
                                	$total_siswa = 0;
                                	$i = 0;
            						$sql=$select->list_raport_p5_view("", $tahunajaran_id, $tingkat_id, $semester_id, $guru_id, $all, '', $idtema_view, $idkelas, $departemen, $departemen_sekolah_id);
						            while($deskripsi_raport_p5_view=$sql->fetch(PDO::FETCH_OBJ)){
            							            							
            							$i++;
										
										$idsiswa = "0";
										$sqlsiswa = $select->get_siswa_raport_p5('', '', $deskripsi_raport_p5_view->syscode);
										while($datasiswa = $sqlsiswa->fetch(PDO::FETCH_OBJ)) {
											if($idsiswa == "0") {
												$idsiswa = $datasiswa->idsiswa;
											} else {
												$idsiswa = $idsiswa.','.$datasiswa->idsiswa;
											}
										}

										$color_tema = "";
										$title = "";
										if(numberreplace($deskripsi_raport_p5_view->count_nilai) == 0) {
											$color_tema = 'style="color: red"';
											$title = 'title="Belum ada penilaian"';
										}

										// jika input tahun ajaran sebelumnya
										$color_ta_old = "";
										if($deskripsi_raport_p5_view->line == 1) {
											$color_ta_old = "background-color: #5b0f90; color: white";
										}

								?>
                                            
                                        <tr>
                                            <td><?php echo $i ?></td>
											<td>
												<?php
													$departemen_id		=	$deskripsi_raport_p5_view->departemen_id;
													$departemen		=	$deskripsi_raport_p5_view->departemen;
													$departemen_sekolah_id		=	$deskripsi_raport_p5_view->departemen_sekolah_id;
													$idtingkat 		=	$deskripsi_raport_p5_view->idtingkat;
													$idkelas 		=	$deskripsi_raport_p5_view->idkelas;
													$idsemester 	=	$deskripsi_raport_p5_view->idsemester;
													$idtahunajaran 	=	$deskripsi_raport_p5_view->idtahunajaran;

												?>
												<b <?= $color_tema ?> <?= $title ?> ><?php echo $deskripsi_raport_p5_view->tema ?><br>
												Penilaian :</b>
												<a href="javascript:void(0);" name="Find" <?= $title ?> onClick="raport_p5_proses('<?php echo $idtingkat ?>','<?php echo $idkelas ?>','<?php echo $idsemester ?>','<?php echo $idtahunajaran ?>','<?php echo $deskripsi_raport_p5_view->deskripsi_p5_id ?>','<?php echo $idsiswa ?>','<?= $deskripsi_raport_p5_view->syscode ?>','<?= $deskripsi_raport_p5_view->line ?>','<?= $departemen ?>','<?= $departemen_sekolah_id ?>')"><img src="assets/img/rapor_proses.png" /></a>

												<?php if($deskripsi_raport_p5_view->count_nilai > 0) { ?>
													&nbsp;&nbsp;&nbsp;
													<b>Cetak Rapor P5 (per Kelompok) :</b>
													<a href="javascript:void(0);" name="Find" title="Cetak Rapor per Kelompok" onClick="raport_p5_kelompok_print('<?php echo $idtingkat ?>','<?php echo $idtingkat ?>','<?php echo $idkelas ?>','<?php echo $idsemester ?>','<?php echo $idtahunajaran ?>','<?php echo $deskripsi_raport_p5_view->deskripsi_p5_id ?>','<?php echo $idsiswa ?>','0','<?= $deskripsi_raport_p5_view->syscode ?>','<?= $departemen_id?>','<?= $departemen_sekolah_id ?>')"><img src="assets/img/rapor_icon.png" /></a>
												<?php } else { ?>
													&nbsp;&nbsp;&nbsp;
													<b>Belum bisa Cetak Rapor P5, karena belum ada penilaian</b>
												<?php } ?>
												<br><br>
												<table width="100%" border="1" style="border: 1px solid #93d145;" id="detail_<?= $y?>">
				                            		<tr style="background: #d3fe7a">
				                            			<td align="center">No.</td>
				                            			<td align="center">NIS</td>
				                            			<td align="center">Nama Siswa</td>
				                            			<td align="center">Tingkat/Kelas</td>
				                            			<td align="center">Cetak Rapor</td>
													</tr>													
													<?php
														$no = 0;
														$sql2=$selectview->get_siswa_raport_p5('', $idsiswa); 
				                            			$rowsno=$sql2->rowCount();
				                            			while($row_det=$sql2->fetch(PDO::FETCH_OBJ)) {	

				                            				$total_siswa++;
			                            			?>
			                            				<tr>
			                            					<td align="center"><?php echo ($no+1); ?>.</td>
					                            			<td><?php echo $row_det->nis ?></td>
					                            			<td><?php echo $row_det->nama ?></td>
					                            			<td align="center"><font style="color: red;"><?php echo $row_det->tingkat ?></font> / <?php echo $row_det->kelas ?></td>
					                            			<td align="center">
					                            				<?php if($deskripsi_raport_p5_view->count_nilai > 0) { ?>
						                            				<a href="javascript:void(0);" name="Find" title="Cetak Rapor per Siswa" onClick="raport_p5_print('<?php echo $row_det->replid ?>','<?php echo $idtingkat ?>','<?php echo $idkelas ?>','<?php echo $idsemester ?>','<?php echo $idtahunajaran ?>','<?php echo $deskripsi_raport_p5_view->deskripsi_p5_id ?>','<?php echo $idsiswa ?>',0,'<?= $deskripsi_raport_p5_view->syscode ?>','<?= $departemen_id?>','<?= $departemen_sekolah_id ?>')"><img src="assets/img/rapor_icon.png" height="20" /></a>
						                            			<?php } ?>
					                            			</td>
					                            		</tr>
			                            			<?php
			                            					$no++;
			                            				}
			                            			?>
												</table>
											</td>
											<td style="<?= $color_ta_old ?>"><?php echo $deskripsi_raport_p5_view->tahunajaran ?></td>
											<td><?php echo $deskripsi_raport_p5_view->semester ?></td>
											<td><?php echo $deskripsi_raport_p5_view->nama_guru ?></td>
											<td><?php echo $deskripsi_raport_p5_view->tingkat ?></td>
											<td><?php echo $deskripsi_raport_p5_view->kelas ?></td>
											<td align="center">
                                            
                                                <?php /*if (allowupd('raport_p5')==1) { ?>
    												<a href="<?php echo $__folder ?><?php echo obraxabrix('raport_p5_update') ?>/<?php echo $deskripsi_raport_p5_view->syscode ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
    													<span class="green">
    														<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
    													</span>
    												</a>
                                                <?php }*/ ?>
                                                
                                                <?php if (allowdel('raport_p5')==1) { ?>    
                                                    &nbsp;
    												<a href="JavaScript:hapus('<?php echo $deskripsi_raport_p5_view->syscode ?>')" class="tooltip-error" data-rel="tooltip" title="Delete">
    													<span class="red">
    														<i class="ace-icon fa fa-trash-o bigger-120"></i>
    													</span>
    												</a>
                                                <?php } ?>
                                            </td>
                                            
										</tr>
                                    
                                    <?php
                                        }
                                    ?>
                                    
							</tbody>

							<tr style="font-size: 14px; font-weight: bold; background-color: green; color: white">
								<td></td>
								<td>Total Siswa : <?= number_format($total_siswa) ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>

		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->
            			

		<!-- basic scripts -->

<script src="assets/js/jquery.2.1.1.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/jquery-ui.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/chosen.jquery.min.js"></script>
<script src="assets/js/fuelux.spinner.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/bootstrap-timepicker.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/daterangepicker.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/js/jquery.knob.min.js"></script>
<script src="assets/js/jquery.autosize.min.js"></script>
<script src="assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<script src="assets/js/bootstrap-tag.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.tableTools.min.js"></script>
<script src="assets/js/dataTables.colVis.min.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
		//initiate dataTables plugin
		var oTable1 = 
		$('#dynamic-table')
		//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
		.dataTable( {
			bAutoWidth: false,
			"aoColumns": [
			  { "bSortable": false },
			  null, null, null, null, null, null,  //kalau nambah kolom, null ditambahkan
			  { "bSortable": false }
			],
			"aaSorting": [],
	
			//,
			//"sScrollY": "200px",
			//"bPaginate": false,
	
			//"sScrollX": "100%",
			//"sScrollXInner": "120%",
			//"bScrollCollapse": true,
			//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
			//you may want to wrap the table inside a "div.dataTables_borderWrap" element
	
			//"iDisplayLength": 50
	    } );
		//oTable1.fnAdjustColumnSizing();
	
	
		//TableTools settings
		TableTools.classes.container = "btn-group btn-overlap";
		TableTools.classes.print = {
			"body": "DTTT_Print",
			"info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
			"message": "tableTools-print-navbar"
		}
	
		//initiate TableTools extension
		var tableTools_obj = new $.fn.dataTable.TableTools( oTable1, {
			"sSwfPath": "assets/swf/copy_csv_xls_pdf.swf",
			
			"sRowSelector": "td:not(:lasset-child)",
			"sRowSelect": "multi",
			"fnRowSelected": function(row) {
				//check checkbox when row is selected
				try { $(row).find('input[type=checkbox]').get(0).checked = true }
				catch(e) {}
			},
			"fnRowDeselected": function(row) {
				//uncheck checkbox
				try { $(row).find('input[type=checkbox]').get(0).checked = false }
				catch(e) {}
			},
	
			"sSelectedClass": "success",
	        "aButtons": [
				{
					"sExtends": "copy",
					"sToolTip": "Copy to clipboard",
					"sButtonClass": "btn btn-white btn-primary btn-bold",
					"sButtonText": "<i class='fa fa-copy bigger-110 pink'></i>",
					"fnComplete": function() {
						this.fnInfo( '<h3 class="no-margin-top smaller">Table copied</h3>\
							<p>Copied '+(oTable1.fnSettings().fnRecordsTotal())+' row(s) to the clipboard.</p>',
							1500
						);
					}
				},
				
				{
					"sExtends": "csv",
					"sToolTip": "Export to CSV",
					"sButtonClass": "btn btn-white btn-primary  btn-bold",
					"sButtonText": "<i class='fa fa-file-excel-o bigger-110 green'></i>"
				},
				
				{
					"sExtends": "pdf",
					"sToolTip": "Export to PDF",
					"sButtonClass": "btn btn-white btn-primary  btn-bold",
					"sButtonText": "<i class='fa fa-file-pdf-o bigger-110 red'></i>"
				},
				
				{
					"sExtends": "print",
					"sToolTip": "Print view",
					"sButtonClass": "btn btn-white btn-primary  btn-bold",
					"sButtonText": "<i class='fa fa-print bigger-110 grey'></i>",
					
					"sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small>Optional Navbar &amp; Text</small></a></div></div>",
					
					"sInfo": "<h3 class='no-margin-top'>Print view</h3>\
							  <p>Please use your browser's print function to\
							  print this table.\
							  <br />Press <b>escape</b> when finished.</p>",
				}
	        ]
	    } );
		//we put a container before our table and append TableTools element to it
	    $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));
		
		//also add tooltips to table tools buttons
		//addding tooltips directly to "A" buttons results in buttons disappearing (weired! don't know why!)
		//so we add tooltips to the "DIV" child after it becomes inserted
		//flash objects inside table tools buttons are inserted with some delay (100ms) (for some reason)
		setTimeout(function() {
			$(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function() {
				var div = $(this).find('> div');
				if(div.length > 0) div.tooltip({container: 'body'});
				else $(this).tooltip({container: 'body'});
			});
		}, 200);
		
		
		//lookup
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
		//end lookup
		
		
		//ColVis extension
		var colvis = new $.fn.dataTable.ColVis( oTable1, {
			"buttonText": "<i class='fa fa-search'></i>",
			"aiExclude": [0, 20],
			"bShowAll": true,
			//"bRestore": true,
			"sAlign": "right",
			"fnLabel": function(i, title, th) {
				return $(th).text();//remove icons, etc
			}
			
		}); 
		
		//style it
		$(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold')
		
		//and append it to our table tools btn-group, also add tooltip
		$(colvis.button())
		.prependTo('.tableTools-container .btn-group')
		.attr('title', 'Show/hide columns').tooltip({container: 'body'});
		
		//and make the list, buttons and checkboxed Ace-like
		$(colvis.dom.collection)
		.addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right')
		.find('li').wrapInner('<a href="javascript:void(0)" />') //'A' tag is required for better styling
		.find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');
	
	
		
		/////////////////////////////////
		//table checkboxes
		$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
		
		//select/deselect all rows according to table header checkbox
		$('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
			var th_checked = this.checked;//checkbox inside "TH" table header
			
			$(this).closest('table').find('tbody > tr').each(function(){
				var row = this;
				if(th_checked) tableTools_obj.fnSelect(row);
				else tableTools_obj.fnDeselect(row);
			});
		});
		
		//select/deselect a row when the checkbox is checked/unchecked
		$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
			var row = $(this).closest('tr').get(0);
			if(!this.checked) tableTools_obj.fnSelect(row);
			else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
		});
		
	
		
		
			$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
			e.stopImmediatePropagation();
			e.stopPropagation();
			e.preventDefault();
		});
		
		
		//And for the first simple table, which doesn't have TableTools or dataTables
		//select/deselect all rows according to table header checkbox
		var active_class = 'active';
		$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
			var th_checked = this.checked;//checkbox inside "TH" table header
			
			$(this).closest('table').find('tbody > tr').each(function(){
				var row = this;
				if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
				else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
			});
		});
		
		//select/deselect a row when the checkbox is checked/unchecked
		$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
			var $row = $(this).closest('tr');
			if(this.checked) $row.addClass(active_class);
			else $row.removeClass(active_class);
		});
	
		
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
		
	
		/********************************/
		//add tooltip for small view action buttons in dropdown menu
		$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
		
		//tooltip placement on right or left
		function tooltip_placement(context, source) {
			var $source = $(source);
			var $parent = $source.closest('table')
			var off1 = $parent.offset();
			var w1 = $parent.width();
	
			var off2 = $source.offset();
			//var w2 = $source.width();
	
			if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
			return 'left';
		}
	
	})
</script>
