<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");

include 'class/class.selectview.php';

$selectview = new selectview;

?>

<!-- bootstrap & fontawesome -->
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


<!-- text fonts -->
<link rel="stylesheet" href="../assets/fonts/fonts.googleapis.com.css" />

<!-- ace styles -->
<link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

<!--[if lte IE 9]>
	<link rel="stylesheet" href="../assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
<![endif]-->

<!--[if lte IE 9]>
  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
<![endif]-->

<!-- inline styles related to this page -->

<!-- ace settings handler -->
<script src="../assets/js/ace-extra.min.js"></script>

<?php
	$departemen 	=	$_SESSION['departemen'];
	$nama_sekolah 	=	$_SESSION['nama_sekolah'];
	$departemen_sekolah_id =	$_SESSION['departemen_sekolah_id'];

	if($_POST['submit'] == "Cari") {
		$nis 		=	$_POST["nis"];
		$nisn 		=	$_POST["nisn"];
		$nama 		=	$_POST["nama"];
	}
?>

<form class="form-horizontal" role="form" action="" method="post" name="presensi_harian_siswa" id="presensi_harian_siswa" class="form-horizontal" enctype="multipart/form-data" >
	<table>
		<tr>
			<th>&nbsp;</th>
	    	<th>Unit : <?= $departemen ?></th>
	    	<th colspan="5">Sekolah : <?= $nama_sekolah ?></th>
	    </tr>
		<tr>
			<th>&nbsp;</th>
	    	<th><input type="text" id="nis" name="nis" placeholder="nis siswa" autocomplete="off" class="form-control" style="width: 150px" value="<?= $nis ?>"></th>
	    	<th><input type="text" id="nisn" name="nisn" placeholder="nisn siswa" autocomplete="off" class="form-control" style="width: 150px" value="<?= $nisn ?>"></th>
	    	<th><input type="text" id="nama" name="nama" placeholder="nama siswa" autocomplete="off" class="form-control" style="width: 300px" autofocus value="<?= $nama ?>"></th>
	    	<th></th>
	        <th></th>
	    	<th>
	    		&nbsp;
	    		<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Cari" />
	    	</th>
	    </tr>
	</table>
</form>

<form name="frm" id="frm" method="post" action="presensi_harian_siswa_lup.php">

    <script langauge="javascript">
    	function post_value(j){
        	var aa= document.getElementById('frm');
            
        	var zz= "nis" + j;        	
            opener.document.absensi_siswa.tnis.value = aa.elements[zz].value;

            var yy= "nis2" + j;        	
            opener.document.absensi_siswa.nisx.value = aa.elements[yy].value;

            var xx= "nama" + j;        	
            opener.document.absensi_siswa.tnama.value = aa.elements[xx].value;

            var ww= "kelas" + j;        	
            opener.document.absensi_siswa.kelas.value = aa.elements[ww].value;

            var bb= "departemen" + j;        	
            opener.document.absensi_siswa.departemen.value = aa.elements[bb].value;

            var cc= "departemen_sekolah_id" + j;        	
            opener.document.absensi_siswa.departemen_sekolah_id.value = aa.elements[cc].value;

        	opener.document.absensi_siswa.tnis.focus();

        	self.close();

    	}
    </script>

<div class="page-content">						
	<div class="row">
		<div class="col-xs-12">
      <!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<div class="clearfix">
						<div class="pull-right tableTools-container"></div>
					</div>
					<!-- div.dataTables_borderWrap -->
					
						<div>
							<table id="dynamic-table" class="table table-striped table-bordered table-hover" style="font-size: 12px">
								<thead>
									<tr>
										<th>Unit</th>
										<th>Nama Sekolah</th>
			                        	<th>NIS</th>
			                        	<th>NISN</th>
			                        	<th>Nama</th>
			                        	<th>Kelas</th>
			                        	<th>Pilih</th>
			                        </tr>
		                       </thead>	      
	                      	<tbody>
	                      	<?php
	                            
	    						$sql=$selectview->get_siswa_presensi($nis, $nisn, $nama, $departemen, $departemen_sekolah_id);
	    						while($row_item=$sql->fetch(PDO::FETCH_OBJ)){
	    						
	        						$j++;
	    						
	    					?>
	    						   						
	    	                    <tr>
	    	                    	<td><?php echo $row_item->departemen ?></td>
	    	                    	<td><?php echo $row_item->nama_sekolah ?></td>
	                                <td>
	                                	<input type="hidden" id="departemen<?php echo $j; ?>" name="departemen<?php echo $j; ?>" value="<?php echo $row_item->departemen ?>" >
	                                	<input type="hidden" id="departemen_sekolah_id<?php echo $j; ?>" name="departemen_sekolah_id<?php echo $j; ?>" value="<?php echo $row_item->departemen_sekolah_id ?>" >
	                                    <input type="hidden" id="nis<?php echo $j; ?>" name="nis<?php echo $j; ?>" value="<?php echo $row_item->nis ?>" >
	                                    <input type="hidden" id="nis2<?php echo $j; ?>" name="nis2<?php echo $j; ?>" value="<?php echo $row_item->nis ?>" >
	                                    <?php echo $row_item->nis ?>
	                                    <input type="hidden" id="kelas<?php echo $j; ?>" name="kelas<?php echo $j; ?>" value="<?php echo $row_item->tingkat."/".$row_item->kelas ?>" >
	                                </td>
	    	                    	<td><?php echo $row_item->nisn ?></td>
	    	                    	<td><input type="hidden" id="nama<?php echo $j; ?>" name="nama<?php echo $j; ?>" value="<?php echo $row_item->nama ?>" ><font style="font-size: auto"><?php echo $row_item->nama ?></font></td>
	                                <td><?php echo $row_item->tingkat."/".$row_item->kelas ?></td>
	    	                    	<td align="center"><input type="image" src="../assets/img/icn_edit.png" value="" onClick="post_value(<?php echo $j; ?>);"></td>
	    	                    </tr>
	                        
	                        <?php } ?>
	                        
	                     		</tbody>
							</table>
							</div>
						</div>
				</div>

			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
</form>

<script src="../assets/js/jquery.2.1.1.min.js"></script>

<!--[if !IE]> -->
<script type="text/javascript">
	window.jQuery || document.write("<script src='../assets/js/jquery.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='../assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="../assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
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
		//initiate dataTables plugin
		var oTable1 = 
		$('#dynamic-table')
		//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
		.dataTable( {
			bAutoWidth: false,
			"aoColumns": [
			  { "bSortable": false },
			  null, null, null, null, null, //kalau nambah kolom, null ditambahkan
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
			"sSwfPath": "../assets/swf/copy_csv_xls_pdf.swf",
			
			"sRowSelector": "td:not(:lasset_type-child)",
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
