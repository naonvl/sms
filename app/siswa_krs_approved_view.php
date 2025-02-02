<script type="text/javascript" src="js/buttonajax.js"></script>

<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "<?php echo $__folder ?><?php echo obraxabrix('siswa_krs_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
		}
	}
</script>

<script>
	function export_excel(nis) {
		semester_id	= document.getElementById('semester_id').value;
		
		window.open('<?php echo $__folder ?>app/siswa_krs_xls.php?nis='+nis+'&semester_id='+semester_id, 'Ekspor KRS','200','200','resizable=1,scrollbars=1,status=0,toolbar=0');								
	}
	
	function print_krs(nis) {
		semester_id	= document.getElementById('semester_id').value;
		
		window.open('<?php echo $__folder ?>app/siswa_krs_print.php?nis='+nis+'&semester_id='+semester_id, 'Cetak KRS','200','200','resizable=1,scrollbars=1,status=0,toolbar=0');								
	}
	
</script>

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){
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
	function cekinput() {
		var idtahunajaran = document.getElementById('idtahunajaran').value;
		var idtingkat2 = document.getElementById('idtingkat2').value;

		if(idtahunajaran == "") {
			alert('Tahun Pelajaran tidak boleh kosong !');

			return false;	
		}

		if(idtingkat2 == "") {
			alert('Tingkat tidak boleh kosong !');

			return false;	
		}
		
	}
</script>

<?php
	$idtahunajaran	=	$_POST["idtahunajaran"];
	$idtingkat2		=	$_POST["idtingkat2"];
	$idkelas2		=	$_POST["idkelas2"];
	$semester_id	=	$_POST["semester_id"];
	$peminatan		=	$_POST["peminatan"];
	$kelompok_pelajaran_id = $_POST["kelompok_pelajaran_id"];
	$pelajaran_id	=	$_POST["pelajaran_id"];
	
	if(!empty($_SESSION["idpegawai"]) && $_SESSION['adm']!=1) {
		$sqlpeg = $select->list_pegawai($_SESSION["idpegawai"]);
		$datapeg = $sqlpeg->fetch(PDO::FETCH_OBJ);
		
		$sqlpa=$select->list_kelas("", "", $datapeg->nip);
		$datapa=$sqlpa->fetch(PDO::FETCH_OBJ);
		$idtingkat2 = $datapa->idtingkat;
		$idkelas2 = $datapa->replid;
		
		$semester_id = $_SESSION["semester_id"];
	}
	
	if($idtahunajaran == "") {
		$idtahunajaran = $_SESSION['idtahunajaran'];
	}

	if($_POST['submit'] == "Generate Mapel") {
		include("app/exec/insert_siswa_krs_approved.php");
	}
	
?>

<div class="page-content">				
	<div class="row">
		<div class="col-xs-12">
            
			<!-- PAGE CONTENT BEGINS -->
			<form class="form-horizontal" role="form" action="" method="post" name="kartu_rencana_studi" id="kartu_rencana_studi" enctype="multipart/form-data" onSubmit="return cekinput();" >
            	
            	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tahun Ajaran *)</label>
					<div class="col-sm-3">
						<select name="idtahunajaran" id="idtahunajaran" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_thnajaran($idtahunajaran); ?>
						</select>
					</div>
				</div>
				
            	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tingkat *)</label>
					<div class="col-sm-3">
						<select name="idtingkat2" id="idtingkat2" class="chosen-select form-control" onchange="loadHTMLPost2('app/siswa_list_ajax.php','kelas_id','getkelas','idtingkat2')" >
							<option value=""></option>
							<?php select_tingkat_unit("SMA", $idtingkat2); ?>
						</select>								
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas</label>
					<div class="col-sm-3" id="kelas_id">
						<select name="idkelas2" id="idkelas2" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_kelas($idtingkat2, $idkelas2); ?>
						</select>								
					</div>
				</div>
				   	
            	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semester</label>
					<div class="col-sm-2">
						<select name="semester_id" id="semester_id" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_semester_all("SMA", $semester_id); ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mata Pelajaran</label>
					<div class="col-sm-5">
						<select name="pelajaran_id" id="pelajaran_id" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_pelajaran_krs_report($pelajaran_id); ?>
						</select>
					</div>
				</div>
				
				<!--<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Peminatan</label>
					<div class="col-sm-3">
						<select name="peminatan" id="peminatan" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_peminatan2($peminatan); ?>
						</select>
					</div>
				</div>-->
				
				<!--<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelompok</label>
					<div class="col-sm-4">
						<select name="kelompok_pelajaran_id" id="kelompok_pelajaran_id" class="chosen-select form-control" >
							<option value=""></option>
							<?php select_kelompok_pelajaran($kelompok_pelajaran_id); ?>
						</select>
					</div>
				</div>-->
				
            	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">&nbsp;</label>
                    <div class="col-sm-3">
                      <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Preview"/>
                      &nbsp;
                      <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Generate Mapel"/>
                    </div>  
				</div>

			</form>
            
		</div><!-- /.col -->
	</div>
	
			
	<div class="row">
		<div class="col-xs-12">
                
            <?php
				$delete = $segmen3; //$_REQUEST['mxKz'];
                
				if ($delete == "xm8r389xemx23xb2378e23") {
					include 'class/class.delete.php';
					$delete2=new delete;
					$delete2->delete_siswa_krs($segmen4);
			?>
					<div class="alert alert-success">
						<strong>Delete Data successfully</strong>
					</div>
                    
                    <!--<meta http-equiv="Refresh" content="0;url=<?php echo $__folder ?><?php echo obraxabrix('siswa_krs_view') ?>" />-->
			<?php
                    
                    
				}
			?>
                
			<!-- PAGE CONTENT BEGINS -->
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
                                    <th>NIS &nbsp;&nbsp;</th>
									<th>Nama &nbsp;&nbsp;</th>
									<th>Tingkat &nbsp;&nbsp;</th>
									<th>Kelas &nbsp;&nbsp;</th>
									<th>Semester &nbsp;&nbsp;</th>
									<th>Approval</th>
									<th>Download</th>
								</tr>
							</thead>

							<tbody>
                                <?php			
									$i = 0;
            						$sql=$select->list_siswa_krs_approved_view("", $idtingkat2, $idkelas2, $semester_id, $pelajaran_id, $idtahunajaran);
						            while($siswa_krs_view=$sql->fetch(PDO::FETCH_OBJ)){
            							
            							//get PA (Pembimbing Akademik)
            							$idkelas = $siswa_krs_view->idkelas;
										$sqlpa=$select->list_kelas($idkelas);
										$datapa=$sqlpa->fetch(PDO::FETCH_OBJ);
										$pegawai_id = $datapa->idwali;
										
            							$i++;										
								?>
                                            
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $siswa_krs_view->nis ?></td>
											<td><?php echo $siswa_krs_view->nama_siswa ?></td>
											<td><?php echo $siswa_krs_view->tingkat ?></td>
											<td><?php echo $siswa_krs_view->kelas ?></td>
											<td><?php echo $siswa_krs_view->semester ?></td>
											<td align="center">
                                            
                                                <?php if (allowupd('siswa_krs_approved')==1 && ($_SESSION["idpegawai"] == $pegawai_id) ) { ?>
    												<a href="<?php echo $__folder ?><?php echo obraxabrix('siswa_krs_approved') ?>/<?php echo $siswa_krs_view->nis ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
    													<span class="green">
    														<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
    													</span>
    												</a>
                                                <?php } ?>
                                                
                                                <?php if ($_SESSION["adm"] == 1) { ?>
    												<a href="<?php echo $__folder ?><?php echo obraxabrix('siswa_krs_approved') ?>/<?php echo $siswa_krs_view->nis ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
    													<span class="green">
    														<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
    													</span>
    												</a>
                                                <?php } ?>
                                            </td>
                                            <td align="center">
                                            	<a href="JavaScript:export_excel('<?php echo $siswa_krs_view->nis ?>')">
													<img src="assets/img/excel.jpg" height="16" width="16" />
												</a>
												<!--&nbsp;&nbsp;
												<a href="JavaScript:print_krs('<?php echo $siswa_krs_view->nis ?>')" class="tooltip-error" data-rel="tooltip" title="Print KRS">
                                            		<span class="green">
														<i class="ace-icon glyphicon glyphicon-print bigger-120"></i>
													</span>
												</a>-->
                                            </td>
										</tr>
                                    
                                    <?php
                                        }
                                    ?>
                                    
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->
            			

		<!-- basic scripts -->

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
