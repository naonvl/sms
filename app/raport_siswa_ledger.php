<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  

	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='semester') {
			alert('Semester tidak boleh kosong!');				
		  }
		  
		  return false
		} 
										
	  }		 
	  		
	  
	}
		
</script>

<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "<?php echo $__folder ?><?php echo obraxabrix('siswa_view') ?>/xm8r389xemx23xb2378e23/"+id+" ";
		}
	}
</script>

<?php

$idtahunajaran 	= $_POST['idtahunajaran2'];
$semester_id= $_REQUEST['semester_id'];
$idtingkat2	= $_REQUEST['idtingkat2'];
$idkelas2	= $_REQUEST['idkelas2'];
$kelamin	= $_REQUEST['kelamin'];
$nama2		= $_REQUEST['nama2'];
$nis		= $_REQUEST['nis'];
$nik		= $_REQUEST['nik'];
$all		= $_REQUEST['all'];

$all2 = "";
if($all == 1) {
	$all2 = "checked";
}

if($_SESSION["adm"] == 0) {
	if($_SESSION["tipe_user"] == "Siswa") {
		$idtahunajaran 	= $_SESSION['idtahunajaran'];
		$semester_id= $_SESSION["semester_id"];
		$idkelas2	= $_SESSION["idkelas"];
		$idtingkat2 = $_SESSION["idtingkat"];
		$nama2 		= $_SESSION["nama"];	
		$nis		= $_SESSION['nis'];
		$nik		= $_SESSION['nik'];
		$all		= "";
		$all2 		= "";
	}
	
	if(!empty($_SESSION["idpegawai"])) {
		$sqlpeg = $select->list_pegawai($_SESSION["idpegawai"]);
		$datapeg = $sqlpeg->fetch(PDO::FETCH_OBJ);
		
		$sqlpa=$select->list_kelas("", "", $datapeg->nip);
		$datapa=$sqlpa->fetch(PDO::FETCH_OBJ);
				
		$semester_id= $_SESSION["semester_id"];
		$idkelas2	= $datapa->replid;
		$idtingkat2 = $datapa->idtingkat;
		$nama2		= $_REQUEST['nama2'];
		$nis		= $_REQUEST['nis'];
		$nik		= $_REQUEST['nik'];
		$all		= "";
		$all2 		= "";
	}
}

if($idtahunajaran == "") {
	$idtahunajaran = $_SESSION["idtahunajaran"];
}

?>

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

<script>
	function ledger_preview() {
		if(document.getElementById('semester').value == "") {
			alert("Semester tidak boleh kosong !!!");

			return false;
		}
		var idtahunajaran2 =document.getElementById('idtahunajaran2').value;
		//var semester	= document.getElementById('semester').value;
		//var semester = document.getElementById('semester').options.selectedIndex;

		var select = document.getElementById('semester');
		var selectedOptions = [];
		for (const option of select.options) {
		    if (option.selected) {
		        //selectedOptions.push(option.value);
		        selectedOptions.push(option.value);
		    	//alert(selectedOptions.push(option.value));
		    }
		}
		var semester = selectedOptions;
		/*var e = document.getElementById("semester");
		var selectedValue2 = e.options[e.selectedIndex].value;
		var selectedText2 = e.options[e.selectedIndex].;*/

		/*var param = "semester";
		var semester1 = $('#'+param).val();
		alert(semester1);*/
		/*var parray = semester1.split(",");

		for(z=0; z<count(parray); z++) {
			alert(parray[z]);
			//alert(document.getElementById('semester').options.selectedIndex);
		}*/
		
		var kelas		= document.getElementById('kelas').value;
		var tingkat		= ""; //document.getElementById('tingkat').value;
		/*
		
		var kelamin		= document.getElementById('kelamin').value;
		var nama		= document.getElementById('nama2').value;
		var nis			= document.getElementById('nis').value;
		var nik			= document.getElementById('nik').value;*/
		var all			= false; //document.getElementById('all').checked;
		
		/*if(semester_id == "") {
			alert('Semester tidak boleh kosong');
			return false;
		}*/
		
		if(all == true) {
			all = 1;
		}
		if(all == false) {
			all = 0;
		}
		
		window.open('<?php echo $__folder ?>app/raport_siswa_ledger_view.php?idtahunajaran2='+idtahunajaran2+'&semester='+semester+'&kelas='+kelas+'&tingkat='+tingkat, 'Raport Siswa Ledger View','825','450','resizable=1,scrollbars=1,status=0,toolbar=0');								
	}
	
	function ledger_excel() {
		var idtahunajaran2 =document.getElementById('idtahunajaran2').value;
		var semester_id	= document.getElementById('semester_id').value;
		var idtingkat	= document.getElementById('idtingkat2').value;
		var idkelas		= document.getElementById('idkelas2').value;
		var kelamin		= document.getElementById('kelamin').value;
		var nama		= document.getElementById('nama2').value;
		var nis			= document.getElementById('nis').value;
		var nik			= document.getElementById('nik').value;
		var all			= document.getElementById('all').checked;
		
		if(semester_id == "") {
			alert('Semester tidak boleh kosong');
			return false;
		}
		if(idtingkat == "") {
			alert('Tingkat tidak boleh kosong');
			return false;
		}
		if(idkelas == "") {
			alert('Kelas tidak boleh kosong');
			return false;
		}
		
		if(all == true) {
			all = 1;
		}
		if(all == false) {
			all = 0;
		}
		
		window.open('<?php echo $__folder ?>app/raport_siswa_ledger_xls.php?semester_id='+semester_id+'&idtingkat='+idtingkat+'&idkelas='+idkelas+'&kelamin='+kelamin+'&nama='+nama+'&nis='+nis+'&nik='+nik+'&all='+all+'&idtahunajaran2='+idtahunajaran2, 'Raport Siswa Ledger','200','200','resizable=1,scrollbars=1,status=0,toolbar=0');								
	}


	function ledger_excel_upload() {
		
		newWindow('<?php echo $__folder ?>app/generate_siswa_ledger.php','Upload Raport Siswa Ledger','800','500','resizable=1,scrollbars=1,status=0,toolbar=0');							
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
					$delete2->delete_siswa($segmen4);
			?>
					<div class="alert alert-success">
						<strong>Delete Data successfully</strong>
					</div>
                    
                    <!--<meta http-equiv="Refresh" content="0;url=main.php?menu=app&act=<?php echo obraxabrix('siswa_view') ?>" />-->
			<?php
                    
                    
				}
			?>
                
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
				
					<form class="form-horizontal" role="form" action="" method="post" name="siswa_lis" id="siswa_list" enctype="multipart/form-data" onsubmit="return cekinput('semester')" >
		            	
		            	<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tahun Pelajaran</label>
							<div class="col-lg-4">
								<select name="idtahunajaran2" id="idtahunajaran2" class="chosen-select form-control" />
									<option value=""></option>
									<?php select_tahun_pelajaran($idtahunajaran); ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semester *)</label>
							<div class="col-lg-4">
								<select multiple="" class="chosen-select form-control" id="semester" name="semester[]" data-placeholder="Pilih Semester...">
									<option value=""></option>
									<?php selectmulti_semester($semester); ?>
								</select>
							</div>
						</div>

						<!-- <div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tingkat</label>
							<div class="col-lg-4">
								<select name="tingkat" id="tingkat" class="chosen-select form-control" />
									<option value=""></option>
									<php select_tingkat_leger($tingkat); ?>
								</select>
							</div>
						</div> -->

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kelas</label>
							<div class="col-lg-4">
								<select name="kelas" id="kelas" class="chosen-select form-control" />
									<option value=""></option>
									<?php select_kelas_leger($kelas); ?>
								</select>
							</div>
						</div>

						<!-- <div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Peminatan</label>
							<div class="col-lg-4">
								<select name="idminat" id="idminat" class="chosen-select form-control" />
									<option value=""></option>
									<php select_peminatan2($idminat); ?>
								</select>
							</div>
						</div> -->

						<!-- <div class="form-group">
		                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Semua</label>
		                    
		                    <div class="col-sm-3">
		                    	 <input id="all" name="all" type="checkbox" class="ace" value="1" <?php echo $all2 ?> ><span class="lbl"></span>
							</div>
		                    
						</div> -->
						
						
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">&nbsp;</label>
		                    <div class="col-sm-3">
		                      <input type="button" name="button" id="submit" class='btn btn-primary' onclick="ledger_preview()" value="Preview"/>
		                      <!-- &nbsp;&nbsp;
		                      <input type="submit" name="submit" class='btn btn-success' value="Upload" onclick="ledger_excel_upload()" > -->
		                      <!-- &nbsp;&nbsp;
		                      <input type="submit" name="submit" class='btn btn-primary' value="Download" onclick="ledger_excel()" > -->

		                      &nbsp;
		                        <a href="<?php echo $__folder ?>app/raport_siswa_leger_download_format.php" target="_blank" title="Download Format File">
									<span class="blue">
										<i class="ace-icon fa fa-cloud-download bigger-220"></i>
									</span>
								</a>

		                      &nbsp;
								<a href="#"  onClick="JavaScript:ledger_excel_upload()" title="Upload Leger">
		        					<span class="blue">
										<i class="ace-icon fa fa-cloud-upload bigger-220"></i>
									</span>
		        				</a>

		        				<!-- &nbsp;
		                        <a href="<?php echo $__folder ?>app/pustaka_download_format.php" target="_blank" title="Download Format File">
									<span class="blue">
										<i class="ace-icon fa fa-cloud-download bigger-220"></i>
									</span>
								</a> -->
		                    </div>  
						</div>
						
						
						
					</form>
				
				</div>
			</div>
			
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->
            			

		<!-- basic scripts -->
<script src="assets/js/jquery.2.1.1.min.js"></script>
<script type="text/javascript">
	window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
</script>
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
<script src="<?php echo $__folder ?>assets/js/bootstrap-multiselect.min.js"></script>

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
	function editVendorTgl(i,ref){
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				$("#dialog1 .w3-modal-content").css("width","900px");
				$("#modal_header").html("Edit Tanggal Vendor "+ref);
				$("#modal_content").html(xmlhttp.responseText);
				$("#dialog1").css("display","block");
			}
		}
		xmlhttp.open("GET","assets/ajax/lap_po_vendor_tgl.php?ref="+ref,true);
		xmlhttp.send();
	}
	
	function editVendor(i,ref){
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				$("#dialog1 .w3-modal-content").css("width","900px");
				$("#modal_header").html("Edit Vendor "+ref);
				$("#modal_content").html(xmlhttp.responseText);
				$("#dialog1").css("display","block");
			}
		}
		xmlhttp.open("GET","assets/ajax/lap_po_vendor.php?ref="+ref,true);
		xmlhttp.send();
	}
	function editTglDelivery(i,ref,tgl,so_date,uid_pic){
		$("#d2_po").val(ref);
		$("#d2_date").val(tgl);
		$("#so_date").val(so_date);
		$("#uid_pic").val(uid_pic);
		$("#dialog2").css("display","block");
	}
	function closeDialog(){
		$("#dialog1").css("display","none");
		$("#dialog2").css("display","none");
		$("#d1_po").val("");
		$("#d2_po").val("");
		$("#d2_date").val("");
	}
	function editTglDeliveryVendor(i,ref,tgl,so_date,uid_pic){
		$("#d2_po_vendor").val(ref);
		$("#d2_date_vendor").val(tgl);
		$("#so_date_vendor").val(so_date);
		$("#uid_pic_vendor").val(uid_pic);
		$("#dialog2_vendor").css("display","block");
	}
	function closeDialogVendor(){
		//$("#dialog1").css("display","none");
		$("#dialog2_vendor").css("display","none");
		//$("#d1_po").val("");
		$("#d2_po_vendor").val("");
		$("#d2_date_vendor").val("");
	}	
	function editTglDeliveryFGood(i,ref,tgl,so_date,uid_pic){
		$("#d2_po_fgood").val(ref);
		$("#d2_date_fgood").val(tgl);
		$("#so_date_fgood").val(so_date);
		$("#uid_pic_fgood").val(uid_pic);
		$("#dialog2_fgood").css("display","block");
	}
	function closeDialogFGood(){
		//$("#dialog1").css("display","none");
		$("#dialog2_fgood").css("display","none");
		//$("#d1_po").val("");
		$("#d2_po_fgood").val("");
		$("#d2_date_fgood").val("");
	}	



	//--------------------
	$('.multiselect').multiselect({
	 enableFiltering: true,
	 buttonClass: 'btn btn-white btn-primary',
	 templates: {
		button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"></button>',
		ul: '<ul class="multiselect-container dropdown-menu"></ul>',
		filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
		filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default btn-white btn-grey multiselect-clear-filter" type="button"><i class="fa fa-times-circle red2"></i></button></span>',
		li: '<li><a href="javascript:void(0);"><label></label></a></li>',
		divider: '<li class="multiselect-item divider"></li>',
		liGroup: '<li class="multiselect-item group"><label class="multiselect-group"></label></li>'
	 }
	});

	jQuery(function($) {
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
		
		$('#dynamic-table').DataTable({
			"iDisplayLength": 10
		});
		
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
	});
</script>

