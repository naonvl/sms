<script type="text/javascript" src="js/buttonajax.js"></script>

<?php

if($find == "Preview") {
	$departemen	= $_POST['departemen'];	
	$daritgl	= $_POST['daritgl'];
	$ketgl		= $_POST['ketgl'];
	$idtingkat	= $_POST['idtingkat'];
	$idkelas	= $_POST['idkelas'];
	$nama		= $_POST['nama'];
	$all		= $_POST['all'];
} else {
	$departemen	= $_REQUEST['departemen'];	
	$daritgl	= $_REQUEST['daritgl'];
	$ketgl		= $_REQUEST['ketgl'];
	$idtingkat	= $_REQUEST['idtingkat'];
	$idkelas	= $_REQUEST['idkelas'];
	$nama		= $_REQUEST['nama'];
	$all		= $_REQUEST['all'];
}

if ($all == 1 && $all == true) {
	$all = "checked";
} else {
	$all = "";
}

if($daritgl == "") { $daritgl = date("d-m-Y"); }
if($ketgl == "") { $ketgl	 = date("d-m-Y"); }

?>

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){
		dest = destination;	
		
		str = getId + '=' + document.getElementById(getId).value;		
		
		var str = str + '&button=' + button; // + button + '|' + getId2;
		
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
	function excel_export() {
		var departemen	=	"SMA"; //document.getElementById('departemen').value;
		var daritgl		=	document.getElementById('daritgl').value;
		var ketgl		=	document.getElementById('ketgl').value;
		var idtingkat	=	document.getElementById('idtingkat').value;
		var nama		=	document.getElementById('nama').value;
			
		document.location.href = "app/rpt_presensi_harian_siswa_xls.php?departemen="+departemen+"&daritgl="+daritgl+"&ketgl="+ketgl+"&idtingkat="+idtingkat+"&nama="+nama+"";
	}

	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "<?php echo obraxabrix('rpt_presensi_harian_siswa_sps') ?>/xm8r389xemx23xb2378e23/"+id+" ";
		}
	}
</script>

<div class="page-content">						
	<div class="row">
		<div class="col-xs-12">
            
            <?php
				$delete = $segmen3; //$_REQUEST['mxKz'];
                if ($delete == "xm8r389xemx23xb2378e23") {
					include 'class/class.delete.php';
					$delete2=new delete;
					$delete2->delete_rpt_absensi_harian_siswa($segmen4);
			?>
					<div class="alert alert-success">
						<strong>Hapus Data Sukses</strong>
					</div>
                    
                    <meta http-equiv="Refresh" content="0;url=<?php echo $nama_folder . '/' . obraxabrix('rpt_presensi_harian_siswa_sps'); ?>" />
			<?php
                    
                    
				}
			?>

            <!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
				
					<form class="form-horizontal" role="form" action="" method="post" name="rpt_presensi_harian_siswa" id="rpt_presensi_harian_siswa" class="form-horizontal" enctype="multipart/form-data" >
		            	
		            	<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'From Date'; } else { echo 'Dari Tanggal'; } ?></label>
							<div class="col-sm-3">
								<input type="text" id="daritgl" name="daritgl" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $daritgl ?>">								
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'To Date'; } else { echo 's/d Tanggal'; } ?></label>
							<div class="col-sm-3">
								<input type="text" id="ketgl" name="ketgl" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $ketgl ?>">								
							</div>
						</div>
						
						<div class="form-group">
		                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tingkat</label>		                    	<div class="col-sm-3">
		                    	<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('app/rpt_presensi_harian_siswa_ajax.php','kelas_id','getkelas','idtingkat')" >
									<option value=""></option>
									<?php select_tingkat_unit("SMA", $idtingkat); ?>
								</select>
							</div>		                    
						</div>
						
						<div class="form-group">
		                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas</label>		                    	<div class="col-sm-3" id="kelas_id">
		                    	<select name="idkelas" id="idkelas" class="chosen-select form-control" >
									<option value=""></option>
									<?php select_kelas($idtingkat, $idkelas); ?>
								</select>
							</div>		                    
						</div>
						
						<div class="form-group">
		                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama</label>
		                    <div class="col-sm-3">
		                    	 <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $nama ?>" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">&nbsp;</label>
		                    <div class="col-sm-3">
		                      <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Preview"/>
		                      &nbsp;&nbsp;<a href="JavaScript:excel_export()">
									<img src="assets/img/excel.jpg" />
								</a>
							</div>
						</div>
						
						
						
					</form>
				
				</div>
			</div>
			
			    
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
                                    <th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Level-Kelas &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Tanggal &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Hadir &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Ijin &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Sakit &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Alpa &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Terlambat &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Hapus &nbsp;&nbsp;</th>
								</tr>
							</thead>

							<tbody>
                                <?php			
									$i = 0;
            						$total = 0;													
									$sql=$selectview->rpt_presensi_harian_siswa($daritgl, $ketgl, $nis, $idkelas, $idtingkat, $nama, $departemen);												
									while ($rpt_presensi_harian_siswa_view=$sql->fetch(PDO::FETCH_OBJ)) {
										
										$i++;
										
										$kelas = $rpt_presensi_harian_siswa_view->tingkat . ' - ' . $rpt_presensi_harian_siswa_view->kelas;		

										$bg = "";
										$terlambat = 0;
										$min_terlambat = date("H:i", strtotime("06:30"));
										$max_terlambat = date("H:i", strtotime("14:00"));
										if(date('H:i', strtotime($rpt_presensi_harian_siswa_view->ts)) > $min_terlambat && date('H:i', strtotime($rpt_presensi_harian_siswa_view->ts)) < $max_terlambat) {
											$terlambat = 1;
											$bg = "background-color: red; color: yellow; font-weight: bold";
										}

										//rpt_presensi_harian_siswa_view->cuti;

										if($rpt_presensi_harian_siswa_view->ijin > 0 || $rpt_presensi_harian_siswa_view->sakit > 0 || $rpt_presensi_harian_siswa_view->alpa > 0) {
											$terlambat = 0;
										}
								?>
                                            
                                        <tr>
                                            <td><?php echo $i ?></td> 
                                            <td><?php echo $rpt_presensi_harian_siswa_view->nis ?></td>
											<td><?php echo $rpt_presensi_harian_siswa_view->nama ?></td>
											<td><?php echo $kelas ?></td>
											<td><?php echo date('d-m-Y', strtotime($rpt_presensi_harian_siswa_view->tanggal1)).' '.date('H:i', strtotime($rpt_presensi_harian_siswa_view->ts)); ?></td>
											<td align="center"><?php echo $rpt_presensi_harian_siswa_view->hadir ?></td>
											<td align="center"><?php echo $rpt_presensi_harian_siswa_view->ijin ?></td>
											<td align="center"><?php echo $rpt_presensi_harian_siswa_view->sakit ?></td>
											<td><?php echo $rpt_presensi_harian_siswa_view->alpa ?></td>
											<td align="center" style="<?= $bg ?>"><?php echo $terlambat ?></td>
											<td><?php echo $rpt_presensi_harian_siswa_view->keterangan ?></td>
                                            <td align="center">
                                            	<?php echo $rpt_presensi_harian_siswa_view->replid ?><br>
												<a href="JavaScript:hapus('<?php echo $rpt_presensi_harian_siswa_view->replid ?>')" class="tooltip-error" data-rel="tooltip" title="Delete">
													<span class="red">
														<i class="ace-icon fa fa-trash-o bigger-120"></i>
													</span>
												</a>
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

<!--[if !IE]> -->
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
			  null, null, null, null, null, null, null, null, null, null,  //kalau nambah kolom, null ditambahkan
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
