<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='receiver') {
			alert('Nama Peminjam tidak boleh kosong!');				
		  }
		  if (document.getElementById(arrf[i]).name=='mobile') {
			alert('No. HP tidak boleh kosong!');				
		  }
		  if (document.getElementById(arrf[i]).name=='memo') {
			alert('Kegiatan tidak boleh kosong!');				
		  }
		  if (document.getElementById(arrf[i]).name=='need') {
			alert('Keperluan belum dipilih!');				
		  }
		  if (document.getElementById(arrf[i]).name=='warehouse_id_from') {
			alert('Nama Lab. belum dipilih!');				
		  }
		  
		  return false
		} 
										
	  }		 
	  
	  //proteksi detail(jika tidak dipilih, maka tidak bisa di save)
	  var jmlpilih = 0;
	  var m_item_code = document.getElementById('item_code').value;
	  var s_item = m_item_code.split('|');
	  
	  /*if(!empty(m_item_code)) {
		  m_item_code = m_item_code.split('|');
		  alert(cunt(m_item_code));*/
		  /*for(q=0; q<count(m_item_code); q++) {
		     var m_item = m_item_code(q);
		     alert(m_item);
		  }*/
	 //}
	 if(s_item.length > 0) {
	  	for(q=0; q<s_item.length; q++) {
		    var m_item = s_item[q];
		    if( m_item != "" ) {
			   jmlpilih = 1;	
			}
		}
	  }
	  
	  var ref = document.getElementById('ref').value;
	  if(jmlpilih == 0 && ref == "") {
	  	 alert('Alat belum dipilih !');
	  	 return false;
	  }
	  	  
	}
		
</script>

<script>

	function number_format(number, decimals, dec_point, thousands_sep) {
		number = (number + '')
		.replace(/[^0-9+\-Ee.]/g, '');
	  
	  var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
		  var k = Math.pow(10, prec);
		  return '' + (Math.round(n * k) / k)
			.toFixed(prec);
		};
	  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
	  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
		.split('.');
	  if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	  }
	  if ((s[1] || '')
		.length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1)
		  .join('0');
	  }
	  return s.join(dec);
	}
	
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

<style>
	.hide {
		opacity: 0;
	}
</style>

<script>
	var pilih = '';
	var pilih3 = '';
	
	var refref = '';
	var refref3 = '';
	
	var old_id = '';
	var old_id3 = '';
	
	var delete_id = '';
	var delete_id3 = '';
	
	var qtyqty = '';
	var qtyqty3 = '';
	
	function checklist(lne) {
		var slc = document.getElementById('book_slc_' + lne).checked;
		
		if (slc) {
			pilih = pilih + '|' + document.getElementById('book_slc_' + lne).checked;
			/*if(pilih == true) {
				pilih = "1";
			}*/	
			$('#pilih').html('<input type="hidden" size="100" id="book_slc" name="book_slc" value="'+ pilih +'" >');
			
			refref = refref + '|' + document.getElementById('item_code_'  + lne).value;
			$('#item_code_id').html('<input type="hidden" size="100" id="item_code" name="item_code" value="'+ refref +'" >');
			qtyqty = qtyqty + '|' + document.getElementById('qty_'  + lne).value;
			$('#qty_id').html('<input type="hidden" size="50" id="qty" name="qty" value="'+ qtyqty +'" >');
			
			/*old_id = old_id + '|' + document.getElementById('old_'  + lne).value;
			$('#old_id').html('<input type="hidden" size="100" id="old_id" name="old_id" value="'+ old_id +'" >');*/
			
		} else {
			pilih3 = false; //document.getElementById('book_slc_' + lne).checked;
			/*if(pilih3 == false) {
				pilih3 = "";
			}*/
			pilih = pilih.replace(pilih3,"");
				
			$('#pilih').html('<input type="hidden" size="100" id="book_slc" name="book_slc" value="'+ pilih +'" >');
			
			refref3 = document.getElementById('item_code_'  + lne).value;
			refref = refref.replace(refref3,"");
			$('#item_code_id').html('<input type="hidden" size="100" id="item_code" name="item_code" value="'+ refref +'" >');

			qtyqty3 = document.getElementById('qty_'  + lne).value;
			qtyqty = qtyqty.replace(qtyqty3,"");
			$('#qty_id').html('<input type="hidden" size="100" id="qty" name="qty" value="'+ qtyqty +'" >');
						
			/*old_id3 = document.getElementById('old_'  + lne).value;
			old_id = old_id.replace(old_id3,"");
			$('#old_id').html('<input type="hidden" size="100" id="old_id" name="old_id" value="'+ old_id +'" >');*/
			
		}
	}
	
	
	function checklist_update(lne) {
		var slc = document.getElementById('book_slc_' + lne).value;
		
		if (slc) {
			pilih = pilih + '|' + document.getElementById('book_slc_' + lne).checked;
			/*if(pilih == true) {
				pilih = "1";
			}*/	
			$('#pilih').html('<input type="hidden" size="100" id="book_slc" name="book_slc" value="'+ pilih +'" >');
			
			refref = refref + '|' + document.getElementById('item_code_'  + lne).value;
			$('#item_code_id').html('<input type="hidden" size="100" id="item_code" name="item_code" value="'+ refref +'" >');
			
			old_id = old_id + '|' + document.getElementById('old_'  + lne).value;
			$('#old_id').html('<input type="hidden" size="100" id="old_id" name="old_id" value="'+ old_id +'" >');
			
			delete_id = delete_id + '|' + document.getElementById('delete_'  + lne).checked;
			$('#del_id').html('<input type="hidden" size="100" id="delete_id" name="delete_id" value="'+ delete_id +'" >');
			
		} else {
			pilih3 = false; //document.getElementById('book_slc_' + lne).checked;
			/*if(pilih3 == false) {
				pilih3 = "";
			}*/
			pilih = pilih.replace(pilih3,"");
				
			$('#pilih').html('<input type="hidden" size="100" id="book_slc" name="book_slc" value="'+ pilih +'" >');
			
			refref3 = document.getElementById('item_code_'  + lne).value;
			refref = refref.replace(refref3,"");
			$('#item_code_id').html('<input type="hidden" size="100" id="item_code" name="item_code" value="'+ refref +'" >');
			
			old_id3 = document.getElementById('old_'  + lne).value;
			old_id = old_id.replace(old_id3,"");
			$('#old_id').html('<input type="hidden" size="100" id="old_id" name="old_id" value="'+ old_id +'" >');
			
			delete_id3 = document.getElementById('delete_'  + lne).checked;
			delete_id = delete_id.replace(delete_id3,"");
			$('#del_id').html('<input type="hidden" size="100" id="delete_id" name="delete_id" value="'+ delete_id +'" >');
			
		}
	}
	
	
</script>

<?php
	$name			= 	$_POST['name'];
	$memo			=	$_POST['memo'];
	$warehouse_id_from		=	$_POST['warehouse_id_from'];
	$booked			=	date("d-m-Y", strtotime($_POST['booked']));
	$booked_finish	=	date("d-m-Y", strtotime($_POST['booked_finish']));
	$date			= 	date("d-m-Y", strtotime($_POST['date']));
	$arriving		= 	date("d-m-Y", strtotime($_POST['arriving']));
	$checkout_date 	= "";
						
	$days			= 	datediff($booked, $booked_finish);
	$total_days		=	$days['days'];
	
	$from_time		=	date("H:i", strtotime($_POST["from_time"]));
	$to_time		=	$_POST["to_time"];
	
?>

<div class="page-content">
      
	<div class="row">
		<div class="col-xs-12">
            
            <?php 
				$ref = $segmen3; //$_GET['search'];
				
				//jika saat add data, maka data setelah save kosong
				if ($_POST['submit'] == 'Save') { $ref = ''; }
				//-----------------------------------------------/\
					
				$ref2 = notran(date('y-m-d'), 'frmpinjam_alat', '', '', ''); 
				
				include("app/exec/pinjam_alat_insert.php"); 
				
				if($_POST['submit'] == "Tampilkan Alat") {
					
					$date			= date("d-m-Y");
					/*$booked			= date("d-m-Y");
					$booked_finish	= date("d-m-Y");
					$arriving		= date("d-m-Y");*/
					$checkout_date 	= "";
								
				} else {
										
					$date			= date("d-m-Y");
					/*$booked			= date("d-m-Y");
					$booked_finish	= date("d-m-Y");
					$arriving		= date("d-m-Y");
					$checkout_date 	= "";*/
					
				}
				
				$m_disabled = "";
				
				$receiver	=	$_SESSION["loginname"];
				$sql=$select->list_usr_registration($receiver);
				$row_book=$sql->fetch(PDO::FETCH_OBJ);
				$receiver = $row_book->name;
				if($receiver == "") {
					$receiver	=	$_SESSION["loginname"];
				}
				$mobile			= $row_book->mobile;
				if($mobile != "") {
					$m_disabled = "readonly";
				}
				
				if ($ref != "") {
					$sql=$select->list_pinjam_alat($ref);
					$row_registration=$sql->fetch(PDO::FETCH_OBJ);
					
					$ref2			= $row_registration->ref;
					$receiver		= $row_registration->receiver;
					$mobile			= $row_registration->mobile;
					$memo			= $row_registration->memo;
					$need			= $row_registration->need;
					$employee_id 	= $row_registration->employee_id;
					$date			= date("d-m-Y", strtotime($row_registration->date));
					$booked			= date("d-m-Y", strtotime($row_registration->booked));
					$booked_finish	= date("d-m-Y", strtotime($row_registration->booked_finish));
					$arriving		= date("d-m-Y", strtotime($row_registration->arriving));
					$checkout_date 	= date("d-m-Y", strtotime($row_registration->date));
					
					$from_time		= date("H:i", strtotime($row_registration->booked));
					$to_time		= date("H:i", strtotime($row_registration->booked_finish));
					
					$days			= 	datediff($booked, $booked_finish);
					$total_days		=	$days['days'];

					//check return
					$sqlrtn = $select->list_pinjam_alat_detail($ref, 'C');
					$datartn = $sqlrtn->rowCount();
					$return = "";
					if($datartn >0 ) {
						$return = "checked";
					}
					
				}		
			?>
            
            <?php if($ref == "") { ?>
				<!-- PAGE CONTENT BEGINS -->
				<form class="form-horizontal" role="form" action="" method="post" name="registration2" id="registration2" enctype="multipart/form-data" onSubmit="return cekinput('bookid');" >
	            	
	            	<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tanggal Pinjam</label>
						<div class="col-sm-3">
							<div class="input-daterange input-group">
								<input type="text" id="booked" name="booked" style="font-size: 12px" class="form-control" data-date-format="dd-mm-yyyy" readonly="" value="<?php echo $booked ?>">
								
								<span class="input-group-addon">
									s/d
								</span>
								
								<input type="text" id="booked_finish" name="booked_finish" style="font-size: 12px" class="form-control" data-date-format="dd-mm-yyyy" readonly="" value="<?php echo $booked_finish ?>">	
							</div>							
						</div>
					</div>
					
					<?php /*
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">&nbsp;</label>
	                    <div class="col-sm-3">
	                      <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Tampilkan Kamar"/>
						</div>
					</div>*/ ?>
					
				</form>
					
				</div>
			</div>
		<?php } ?>
		
		
		<div class="row">
			<div class="col-xs-12">
				<!--<div class="clearfix">
					<div class="pull-right tableTools-container"></div>
				</div>-->
				
				<form class="form-horizontal" role="form" action="" method="post" name="registration" id="registration" enctype="multipart/form-data" onSubmit="return cekinput('receiver,need,memo');" >
					
					<div class="hide">
            			<input type="text" id="total_days" name="total_days" value="<?php echo $total_days ?>" />
            			<input type="text" id="ref" name="ref" value="<?php echo $ref ?>" />
            		</div>
            		
					<?php if($ref == "") { ?>
						<div class="hide">
					<?php } ?>						
	            		<!--<input type="text" id="booked" name="booked" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $booked ?>">
													
						<input type="text" id="booked_finish" name="booked_finish" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $booked_finish ?>">	-->
						
						
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tanggal Kegiatan</label>
							<div class="col-sm-3">
								<div class="input-daterange input-group">
									<input type="text" id="booked" name="booked" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $booked ?>">
									
									<span class="input-group-addon">
										s/d
									</span>
									
									<input type="text" id="booked_finish" name="booked_finish" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $booked_finish ?>">	
								</div>							
							</div>
						</div>
	            	<?php if($ref == "") { ?>
	            		</div>
	            	<?php } ?>
	            	
	            	<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Jam Pinjam</label>
						<div class="col-sm-3">
							<div class="input-timerange input-group">
								<input class="form-control input-mask-time" type="text" id="from_time" name="from_time" readonly="" value="<?php echo $from_time ?>" />
								
								<span class="input-group-addon">
									s/d
								</span>
								<input class="form-control input-mask-time" type="text" id="to_time" name="to_time" readonly="" value="<?php echo $to_time ?>" />		
							</div>							
						</div>
					</div>
					
	                <!-- <div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">No Pesan *)</label>
						<div class="col-lg-3">
							<input type="text" id="ref" name="ref" class="form-control" readonly="" value="<?php echo $ref2 ?>">
						</div>
					</div> -->
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Booking Date'; } else { echo 'Tanggal Booking'; } ?> *)</label>
						<div class="col-sm-3">
							<input type="text" id="date" name="date" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" value="<?php echo $date ?>">								
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Peminjam *)</label>
						<div class="col-sm-3">
							<input type="text" id="receiver" name="receiver" class="form-control" autocomplete="off" value="<?php echo $receiver ?>">
						</div>
					</div>		
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Keperluan *)</label>
						<div class="col-sm-3">
							<input type="text" id="need" name="need" class="form-control" autocomplete="off" value="<?php echo $need ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kegiatan *)</label>
						<div class="col-sm-6">
							<textarea name="memo" id="memo" class="autosize-transition form-control"><?php echo $memo ?></textarea>
						</div>
					</div>

					<?php if($segmen4 == 'kembali') { ?>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Return Date'; } else { echo 'Tanggal Kembali'; } ?> *)</label>
							<div class="col-sm-3">
								<input type="text" id="date_return" name="date_return" style="font-size: 12px" class="form-control date-picker" data-date-format="dd-mm-yyyy" autocomplete="off" value="<?php echo $date_return ?>">								
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Penerima</label>
							<div class="col-sm-3">
								<input type="text" id="employee_id" name="employee_id" class="form-control" autocomplete="off" value="<?php echo $employee_id ?>">
							</div>
						</div>	

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Kembali</label>
							<div class="col-sm-6">
								<input type="checkbox" name="return" id="return" class="ace" value="1" <?= $return ?> ><span class="lbl"></span>
							</div>
						</div>
						
					<?php } ?>
					
					<input type="hidden" id="warehouse_id_from" name="warehouse_id_from" class="form-control" autocomplete="off" value="<?php echo $warehouse_id_from ?>">
					
					<div id="pilih">
						<input type="hidden" size="100" id="item_code" name="item_code" value="" >
					</div>
					<div id="item_code_id"></div>
					<div id="old_id"></div>
					<div id="del_id"></div>
					<div id="qty_id"></div>
							
	                <?php 
						if($ref == "") {
							include("pinjam_alat_detail.php");
						} else {
							include("pinjam_alat_detail_update.php");
						}
					?>
	                
					<div class="space-4"></div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-3 col-md-9">
	                    
	                        <?php if (allowupd('frmloan_goods_booking','')==1 && $segmen4 != 'kembali') { ?>
	                            <?php if($ref!='') { ?>
	    							<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
	    						<?php } ?>
	                        <?php } ?>

	                        <?php if (allowupd('frmreturn_goods','')==1) { ?>
	                            <?php if($segmen4 == 'kembali') { ?>
	    							<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Kembali" />
	    						<?php } ?>
	                        <?php } ?>
	                        							
							<?php if (allowadd('frmloan_goods_booking','')==1) { ?>
								<?php if($ref=='') { ?>
									<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Save" />
								<?php } ?>
			                <?php } ?>
	                  		
	                  		<?php if($ref!='' && $segmen4 != 'kembali') { ?>
		                        <?php if (allowdel('frmloan_goods_booking','')==1) { ?>
		                            &nbsp;
		    						<input type="submit" name="submit" class="btn btn-danger" value="Delete" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
		                        <?php } ?>
		                        
	                        <?php } ?>
	                        
	                        <?php /*if($segmen4 == 'kembali') { ?>
		                        &nbsp;
								<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder ?>/<?php echo  obraxabrix('pinjam_alat_list') ?>'" />
							<?php } else {*/ ?>                 
								&nbsp;
								<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder ?>/<?php echo  obraxabrix('pinjam_alat_view') ?>'" />
							<?php //} ?>
	                                 
						</div>
					</div>
				</form>
				
            
		</div><!-- /.col -->
	</div><!-- /.row -->
		
</div><!-- /.page-content -->


<!-- basic scripts -->

<!--[if !IE]> -->
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

<!--Editor wysiwyg-->
<!--<script src="<?php echo $__folder ?>assets/js/markdown.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-markdown.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/jquery.hotkeys.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootstrap-wysiwyg.min.js"></script>
<script src="<?php echo $__folder ?>assets/js/bootbox.min.js"></script>-->

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
			  null, null, null,   //kalau nambah kolom, null ditambahkan
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
		/*$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
			var row = $(this).closest('tr').get(0);
			if(!this.checked) tableTools_obj.fnSelect(row);
			else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
		});*/
		
	
		
		
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
	
	
		$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
		.closest('.ace-spinner')
		.on('changed.fu.spinbox', function(){
			//alert($('#spinner1').val())
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


				