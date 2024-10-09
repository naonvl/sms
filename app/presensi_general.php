<script type="text/javascript" src="<?php echo $__folder ?>js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='tanggal') {
			alert('Tanggal tidak boleh kosong!');				
		  }
		  
		  return false
		} 
										
	  }		 
	}
		
</script>

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId, getId1, getId2){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		str2 = getId1 + '=' + document.getElementById(getId1).value;
		str3 = getId2 + '=' + document.getElementById(getId2).value;
		var str = str + '&' + str2 + '&' + str3 + '&button=' + button;
		
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
	var request;
	var dest;
	
	function loadHTMLPost3(URL, destination, button, getId){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;	
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
	var request;
	var dest;
	
	function loadHTMLPost4(URL, destination, button, getId, getId1){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;
		str1 = getId1 + '=' + document.getElementById(getId1).value;
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

<script>
	var idpegawai = '';
	var idpegawai3 = '';
	
	var hadir = '';
	var hadir3 = '';
	
	var cuti = '';
	var cuti3 = '';
	
	var sakit = '';
	var sakit3 = '';
	
	var izin = '';
	var izin3 = '';
	
	var alpa = '';
	var apla3 = '';
	
	function checklist(lne) {
		
		var idpegawai__ = document.getElementById('idpegawai__').value;
		if(idpegawai == "") { idpegawai = idpegawai__; }

		var hadir__ = document.getElementById('hadir__').value;
		if(hadir == "") { hadir = hadir__; }

		var cuti__ = document.getElementById('cuti__').value;
		if(cuti == "") { cuti = cuti__; }

		var sakit__ = document.getElementById('sakit__').value;
		if(sakit == "") { sakit = sakit__; }

		var izin__ = document.getElementById('izin__').value;
		if(izin == "") { izin = izin__; }

		var alpa__ = document.getElementById('alpa__').value;
		if(alpa == "") { alpa = alpa__; }


		idpegawai = idpegawai + '|' + document.getElementById('idpegawai_'  + lne).value;
		$('#idpegawai_id').html('<input type="hidden" size="100" id="idpegawai" name="idpegawai" value="'+ idpegawai +'" >');
		
		var hadira = document.getElementById('absena_' + lne).checked;
		var cutia = document.getElementById('absenb_' + lne).checked;
		var sakita = document.getElementById('absenc_' + lne).checked;
		var izina = document.getElementById('absend_' + lne).checked;
		var alpaa = document.getElementById('absene_' + lne).checked;
		
		if (hadira || cutia || sakita || izina || alpaa) {
			
			if(hadira) {
				hadir = hadir + '|' + document.getElementById('absena_' + lne).value;
				$('#hadir_id').html('<input type="hidden" size="100" id="hadir" name="hadir" value="'+ hadir +'" >');
				
				cuti = cuti + '|';
				$('#cuti_id').html('<input type="hidden" size="100" id="cuti" name="cuti" value="'+ cuti +'" >');			
				sakit = sakit + '|';
				$('#sakit_id').html('<input type="hidden" size="100" id="sakit" name="sakit" value="'+ sakit +'" >');
				
				izin = izin + '|';
				$('#izin_id').html('<input type="hidden" size="100" id="izin" name="izin" value="'+ izin +'" >');
				
				alpa = alpa + '|';
				$('#alpa_id').html('<input type="hidden" size="100" id="alpa" name="alpa" value="'+ alpa +'" >');
			} else {
				hadir = hadir;
				$('#hadir_id').html('<input type="hidden" size="100" id="hadir" name="hadir" value="'+ hadir +'" >');
			}
			
			if(cutia) {
				cuti = cuti + '|' + document.getElementById('absenb_' + lne).value;
				$('#cuti_id').html('<input type="hidden" size="100" id="cuti" name="cuti" value="'+ cuti +'" >');
				
				hadir = hadir + '|';
				$('#hadir_id').html('<input type="hidden" size="100" id="hadir" name="hadir" value="'+ hadir +'" >');
				
				sakit = sakit + '|';
				$('#sakit_id').html('<input type="hidden" size="100" id="sakit" name="sakit" value="'+ sakit +'" >');
				
				izin = izin + '|';
				$('#izin_id').html('<input type="hidden" size="100" id="izin" name="izin" value="'+ izin +'" >');
				
				alpa = alpa + '|';
				$('#alpa_id').html('<input type="hidden" size="100" id="alpa" name="alpa" value="'+ alpa +'" >');
			} else {
				cuti = cuti;
				$('#cuti_id').html('<input type="hidden" size="100" id="cuti" name="cuti" value="'+ cuti +'" >');
			}
			
			if(sakita) {
				sakit = sakit + '|' + document.getElementById('absenc_' + lne).value;
				$('#sakit_id').html('<input type="hidden" size="100" id="sakit" name="sakit" value="'+ sakit +'" >');
				
				hadir = hadir + '|';
				$('#hadir_id').html('<input type="hidden" size="100" id="hadir" name="hadir" value="'+ hadir +'" >');
				
				cuti = cuti + '|';
				$('#cuti_id').html('<input type="hidden" size="100" id="cuti" name="cuti" value="'+ cuti +'" >');
				izin = izin + '|';
				$('#izin_id').html('<input type="hidden" size="100" id="izin" name="izin" value="'+ izin +'" >');
				
				alpa = alpa + '|';
				$('#alpa_id').html('<input type="hidden" size="100" id="alpa" name="alpa" value="'+ alpa +'" >');
			} else {
				sakit = sakit;
				$('#sakit_id').html('<input type="hidden" size="100" id="sakit" name="sakit" value="'+ sakit +'" >');
			}
			
			
			if(izina) {
				izin = izin + '|' + document.getElementById('absend_' + lne).value;
				$('#izin_id').html('<input type="hidden" size="100" id="izin" name="izin" value="'+ izin +'" >');
				
				hadir = hadir + '|';
				$('#hadir_id').html('<input type="hidden" size="100" id="hadir" name="hadir" value="'+ hadir +'" >');
				
				cuti = cuti + '|';
				$('#cuti_id').html('<input type="hidden" size="100" id="cuti" name="cuti" value="'+ cuti +'" >');
				sakit = sakit + '|';
				$('#sakit_id').html('<input type="hidden" size="100" id="sakit" name="sakit" value="'+ sakit +'" >');
				
				alpa = alpa + '|';
				$('#alpa_id').html('<input type="hidden" size="100" id="alpa" name="alpa" value="'+ alpa +'" >');
			} else {
				izin = izin;
				$('#izin_id').html('<input type="hidden" size="100" id="izin" name="izin" value="'+ izin +'" >');
			}
			
			
			if(alpaa) {
				alpa = alpa + '|' + document.getElementById('absene_' + lne).value;
				$('#alpa_id').html('<input type="hidden" size="100" id="alpa" name="alpa" value="'+ alpa +'" >');
				
				hadir = hadir + '|';
				$('#hadir_id').html('<input type="hidden" size="100" id="hadir" name="hadir" value="'+ hadir +'" >');
				
				cuti = cuti + '|';
				$('#cuti_id').html('<input type="hidden" size="100" id="cuti" name="cuti" value="'+ cuti +'" >');
				sakit = sakit + '|';
				$('#sakit_id').html('<input type="hidden" size="100" id="sakit" name="sakit" value="'+ sakit +'" >');
				
				izin = izin + '|';
				$('#izin_id').html('<input type="hidden" size="100" id="izin" name="izin" value="'+ izin +'" >');
			} else {
				alpa = alpa;
				$('#alpa_id').html('<input type="hidden" size="100" id="alpa" name="alpa" value="'+ alpa +'" >');
			}
			
		} 
		
	}
</script>

<style>
	.hide {
		opacity: 0;
	}
</style>            

<?php
	
	$all 		= $_POST["all"];
	$idpegawai 	= $_POST["idpegawai"];
			
?>
                        
<div class="page-content">
    		  
	<div class="row">
		<div class="col-xs-12">
            
            <?php 
				$ref = $segmen3; //$_GET['search'];
				
				//jika saat add data, maka data setelah save kosong
				if ($_POST['submit'] == 'Save') { $ref = ''; }
				//-----------------------------------------------/\
				
				//$ref2 = notran(date('y-m-d'), 'frmpresensi_general', '', '', ''); 
					
				include("app/exec/insert_presensi_general.php");
				
				$tanggal = date("d-m-Y");
				if ($ref != "") {
					$sql=$select->list_presensi_general($ref);
					$row_soal_pegawai=$sql->fetch(PDO::FETCH_OBJ);	
					
					$ref2 		= $row_soal_pegawai->tanggal;	
					$tanggal 	= date("d-m-Y", strtotime($row_soal_pegawai->tanggal));
					$idpegawai	= $row_soal_pegawai->idpegawai;
				} else {
					$ref 		= date("d-m-Y");
					$sql=$select->list_presensi_general($ref);
					$rows=$sql->rowCount();	
					if($rows == 0) {
						$ref = "";
					}

					$sql=$select->list_presensi_general($ref);
					$row_soal_pegawai=$sql->fetch(PDO::FETCH_OBJ);	
					
					$ref2 		= $row_soal_pegawai->tanggal;	
					$tanggal 	= date("d-m-Y");
					$idpegawai	= $row_soal_pegawai->idpegawai;

				}		
			?>
            			
			<!-- PAGE CONTENT BEGINS -->
			<form class="form-horizontal" role="form" action="" method="post" name="soal_pegawai" id="soal_pegawai" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('tanggal');" >
            	
            	<input type="hidden" id="ref" name="ref" readonly="" style="font-size: 12px" class="form-control" value="<?php echo $ref2 ?>"> 
            	
            	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Date'; } else { echo 'Tanggal'; } ?> *)</label>
					<div class="col-sm-3">
						<input type="text" id="tanggal" name="tanggal" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $tanggal ?>">				
					</div>
				</div>
				
            	<!-- <div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Guru/Pegawai</label>
					<div class="col-sm-5">
						<select name="idpegawai" id="idpegawai" class="chosen-select form-control" >
							<option value=""></option>
							<php
								select_petugas($idpegawai); 
							?>
						</select>
					</div>
				</div> -->
				
				<div id="pegawai_id"></div>
				            	
            	<?php  
            		if($ref == "") {
            			include("presensi_general_detail.php");
					} else {
						include("presensi_general_detail_update.php");
					}
            		
            	?>
            	<input type="hidden" name="idpegawai__" id="idpegawai__" value="<?= $idpegawai__ ?>">
            	<input type="hidden" name="hadir__" id="hadir__" value="<?= $hadir__ ?>">
            	<input type="hidden" name="cuti__" id="cuti__" value="<?= $cuti__ ?>">
            	<input type="hidden" name="sakit__" id="sakit__" value="<?= $sakit__ ?>">
            	<input type="hidden" name="izin__" id="izin__" value="<?= $izin__ ?>">
            	<input type="hidden" name="alpa__" id="alpa__" value="<?= $alpa__ ?>">

            	<div id="hadir_id">
            		<input type="hidden" name="hadir" id="hadir" value="<?= $hadir__ ?>">
            	</div>
            	<div id="idpegawai_id">
            		<input type="hidden" name="idpegawai" id="idpegawai" value="<?= $idpegawai__ ?>">
            	</div>
            	<div id="cuti_id">
            		<input type="hidden" name="cuti" id="cuti" value="<?= $cuti__ ?>">
            	</div>
				<div id="sakit_id">
					<input type="hidden" name="sakit" id="sakit" value="<?= $sakit__ ?>">
				</div>
				<div id="izin_id">
					<input type="hidden" name="izin" id="izin" value="<?= $izin__ ?>">
				</div>
				<div id="alpa_id">
					<input type="hidden" name="alpa" id="alpa" value="<?= $alpa__ ?>">
				</div>
						              
				<div class="space-4"></div>

				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
                        
                        <?php if (allowadd('frmpresensi_ukbm')==1) { ?>
    						<?php if($ref=='') { ?>
    							<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Save" onClick="return confirm('Apakah sudah yakin data sudah benar?')" />
    						<?php } ?>
                        <?php } ?>
                        
                        <?php if (allowupd('frmpresensi_ukbm')==1) { ?>
    						<?php if($ref!='') { ?>
    							<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" onClick="return confirm('Apakah sudah yakin data sudah benar?')" />
    						<?php } ?>
                        <?php } ?>
                        
                        <?php /*if (allowdel('frmpresensi_ukbm')==1) { ?>
                            &nbsp;
    						<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
                        <?php }*/ ?>
                        
						&nbsp;
						<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('presensi_general_view') ?>'" />
                                                
                                 
					</div>
				</div>

			</form>
            
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->


<script src="<?php echo $__folder ?>assets/js/jquery.2.1.1.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="<?php echo $__folder ?>assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='<?php echo $__folder ?>assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='<?php echo $__folder ?>assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo $__folder ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="<?php echo $__folder ?>assets/js/bootstrap.min.js"></script>

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

<!-- page specific plugin scripts -->
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
		//initiate dataTables plugin
		var oTable1 = 
		$('#dynamic-table')
		//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
		.dataTable( {
			bAutoWidth: false,
			"aoColumns": [
			  { "bSortable": false },
			  null, null, null, null, null, null,   //kalau nambah kolom, null ditambahkan
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
			"sSwfPath": "<?php echo $__folder ?>assets/swf/copy_csv_xls_pdf.swf",
			
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

				