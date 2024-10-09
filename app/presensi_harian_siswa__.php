<?php
@session_start();
if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");

date_default_timezone_set('Asia/Jakarta');

?>

<script src="../<?php echo $__folder ?>/assets/js/appcustom.js"></script>
<script type="text/javascript" src="../<?php echo $__folder ?>/js/buttonajax.js"></script>

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

<script>
	
	function TimedRefresh( t ) {

		setTimeout("location.reload(true);", t);
		
		for(i=1; i<=10000; i++) {
			t = t - 1;			
		}
		if(t == 0) {
			document.getElementById('tnis').value = "";	
		}
			
	}
	
	function refreshlod() {
		document.getElementById('tnis').value = "";	
	}
	
	function getpenerimaan() {
		var tnis = document.getElementById('tnis').value;
		if(tnis != "") {
			document.location.href = "presensi_harian_siswa.php?nis="+tnis;
		} else {
			document.location.href = "presensi_harian_siswa.php";
		}
		
	}
		 
</script>


<?php
$dbpdo = DB::create();

function kirim_wa($nisn, $jam, $namasekolah) {
	$dbpdo = DB::create();

	//----------/\-----------
	$sender = getapi_nomor_wa();

	$sqlcek 	= 	"select hportu phone, nama from siswa where (nisn='$nisn' or nis='$nisn')";	
	$resultcek1=$dbpdo->prepare($sqlcek);
	$resultcek1->execute();
	$data_epy1		= $resultcek1->fetch(PDO::FETCH_OBJ);
	$phone 			= $data_epy1->phone;
	$nama 			= strtoupper($data_epy1->nama);
	##----phone----------
	if($phone != "") {
		$phone_check_nol = substr($phone,0,1);
		if($phone_check_nol == 8) {
			$phone		=	'62'.$phone;
		}
		if($phone_check_nol == 0) {
			$phone_len	=	strlen($phone);
			$phone		=  	substr($phone,1, $phone_len-1);
			$phone		=	'62'.$phone;
		}
		if(substr($phone,0,3) == '+62') {
			$phone_len	=	strlen($phone);
			$phone		=  	substr($phone,3, $phone_len-3);
			$phone		=	'62'.$phone;
		}
		if(substr($phone,0,2) == '62') {
			//$phone_len	=	strlen($phone);
			//$phone		=  	substr($phone,3, $phone_len-3);
			$phone		=	$phone;
		}
		##-----/\-------

		$survey_date = date('d-m-Y', strtotime($survey_date));
		if($survey_date == "01-01-1970") {
			$survey_date = "";
		}
		
		$message = '*'.$namasekolah.'*'.

$message_wa.


'
Assalamualaikum Warohmatullaahi Wabarokaatuh'.
'
Anak Bapak/Ibu '. $nama.
'
telah tiba di sekolah pada pukul '.$jam;
		echo $message;
		//send_whatsapp_api($phone, $message, $sender);
	}
}
//anak bapak/ibu [nama anak] telaj tiba di sekolah pada pukul [jam absen]

$nis 					= 	$_REQUEST['nis'];
$departemen_sekolah_id 	=	$_SESSION["departemen_sekolah_id"];
$sqlstr = "select a.idkelas, a.nama, a.alamatsiswa, b.tingkat, c.kelas, a.departemen, a.departemen_sekolah_id, a.foto_file, d.nama nama_sekolah from siswa a left join kelas c on a.idkelas=c.replid left join tingkat b on c.idtingkat = b.replid left join departemen_sekolah d on a.departemen_sekolah_id=d.replid where a.departemen_sekolah_id='$departemen_sekolah_id' and (a.nis = '$nis' or a.nisn= '$nis')"; //and (a.nis<>'' and a.nisn<>'')
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
$data=$sql->fetch(PDO::FETCH_OBJ);
$nama 		= $data->nama;
$talamat 	= $data->alamatsiswa;
$foto_file 	= $data->foto_file;
$idkelas	= $data->idkelas;
$kelas 		= $data->tingkat . "-" . $data->kelas;
$departemen	= $data->departemen;
if($departemen == "") {
	$departemen 			=	$_SESSION["departemen"];
}
$departemen_sekolah_id = $data->departemen_sekolah_id;
if($departemen_sekolah_id == "") {
	$departemen_sekolah_id  = 	$_SESSION["departemen_sekolah_id"];
}
$nama_sekolah = $data->nama_sekolah;
if($nama_sekolah == "") {
	$nama_sekolah 	=	$_SESSION["nama_sekolah"];
}
$tanggal 	= date('Y-m-d');
$dlu		= date('Y-m-d H:i');

//===========save start
$sukses_absen = "";
if ( $nis != "") 
{
	$sqlsmt 	= "select replid from semester where departemen='$departemen' and aktif=1 limit 1 ";
	$sql1=$dbpdo->prepare($sqlsmt);
	$sql1->execute();
	$datasmt=$sql1->fetch(PDO::FETCH_OBJ);
	$idsemester	= $datasmt->replid;
	
	$sqlcek 	= "select replid from presensiharian where tanggal1 = '$tanggal' and tanggal2 = '$tanggal' and idkelas = '$idkelas' and idsemester='$idsemester' and departemen='$departemen' and departemen_sekolah_id='$departemen_sekolah_id' ";	
	$sql2=$dbpdo->prepare($sqlcek);
	$sql2->execute();
	$rowsph = $sql2->rowCount();
	$dataph=$sql2->fetch(PDO::FETCH_OBJ);
	$idpresensi	= $dataph->replid;
	
	if($rowsph == 0) {
		$sqlsiswa = "select nis from siswa where nis='$nis'";
		$sql3=$dbpdo->prepare($sqlsiswa);
		$sql3->execute();
		$numrowssiswa = $sql3->rowCount();
		
		if($numrowssiswa > 0 && $idkelas != "") {
			$sqlins		= "insert into presensiharian (idkelas, idsemester, tanggal1, tanggal2, hariaktif, ts, token, issync, departemen, departemen_sekolah_id) values ('$idkelas', '$idsemester', '$tanggal', '$tanggal', 1, '$dlu', 0, 0, '$departemen', '$departemen_sekolah_id')";
			$sql3=$dbpdo->prepare($sqlins);
			$sql3->execute();

			$sqlid		= "select last_insert_id() id";
			$sql4=$dbpdo->prepare($sqlid);
			$sql4->execute();
			$dataid=$sql4->fetch(PDO::FETCH_OBJ);
			$idpresensi = $dataid->id;	
		}	
	} 
	
	//-----------cek presensi harian per siswa
	$sqlcekphs	= "select replid from phsiswa where nis='$nis' and idpresensi='$idpresensi' and departemen='$departemen' and departemen_sekolah_id='$departemen_sekolah_id' ";
	$sql5=$dbpdo->prepare($sqlcekphs);
	$sql5->execute();
	$rowsphs=$sql5->rowCount();

	/*$time  = date('H:i');		
	$time_in = date('H:i', strtotime('06:30')); //sebelumnya lebih besar > 06:30 dianggap terlambat
	$time_mid = date('H:i', strtotime('08:00'));
	$time_out = date('H:i', strtotime('15:00'));

	$keterangan = "";
	if( ($time < $time_out) && ($time > $time_mid) ) {
		if($rowsphs == 1) {
			$keterangan = "Pulang Cepat";
		}
	}

	if( $time > $time_in ) {
		if($rowsphs == 0) {
			$keterangan = "Terlambat";
		}
	}*/
	//-----------end check---------
			
	if($rowsphs == 0) {
		$sqlsiswa = "select nis from siswa where nis='$nis'";
		$sql6=$dbpdo->prepare($sqlsiswa);
		$sql6->execute();
		$numrowssiswa=$sql6->rowCount();
	
		if($numrowssiswa > 0 && $idkelas != "") {
			$sqlphs		= "insert into phsiswa (idpresensi, nis, hadir, keterangan, ts, token, issync, departemen, departemen_sekolah_id) values ('$idpresensi', '$nis', 1, 'Kartu', '$dlu', 0, 0, '$departemen', '$departemen_sekolah_id')";
			$sql7=$dbpdo->prepare($sqlphs);
			$sql7->execute();
		
			$sukses_absen = "ABSENSI BERHASIL";

			## send wa
			kirim_wa($nis, $dlu, $nama_sekolah);

		} else {
			$sukses_absen = "NIS/NISN TIDAK TERDAFTAR";
		}
				
	} else {
		$sukses_absen = "SISWA SUDAH PERNAH ABSEN";
	}	
	//-----------
	
	
?>

	<?php //if($sukses != "") { ?>
	<script>
		//alert('ppppp');
		//document.location.href = "presensi_harian_siswa.php";
		//document.getElementById('tnis').value = "";
	</script>
	<?php //} ?>
<?php
		
}

?>


<script language="javascript">

function focusNext(elemName, evt) 
{
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode :
        ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13) 
	 {
		document.getElementById(elemName).focus();
      return false;
    }
    return true;
}

</script>

<script type="text/javascript">
	function lookup_siswa() {
		window.open('../app/presensi_harian_siswa_lup.php', 'Daftar Siswa','825','950','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
</script>

<!--//shortcut-->
<script type="text/javascript">
    document.onkeydown = function (e) {
    	switch (e.keyCode) {
    		//F7 ()
            case 118:
            	//document.getElementById('cash_amount').focus();
            	lookup_siswa();
                e.preventDefault();
                break;
            
            //F10 (Save)
            /*case 121:
            	submit_save = document.forms.pos.submit_save();
            	alert('xxxxx');
            	document.getElementById('cash_amount').focus();
                e.preventDefault();
                break;*/
                    
            //F7 (Bayar)
            // case 118:
            // 	document.getElementById('cash_amount').focus();
            //     e.preventDefault();
            //     break;
            
            //F2 (Kolom Kode Barang)
            case 113:
                document.getElementById('item_code2').focus();
                e.preventDefault();
                break;
                
            //F4 (Ke Kolom Member)
            case 115:
                document.getElementById('client_member_code2').focus();
                e.preventDefault();
                break;
                
            //F1 (Form Baru)
            // case 112:
            //     window.location = 'main.php?menu=app&act=<?php echo obraxabrix('pos') ?>';
            //     e.preventDefault();
            //     break;
                
            //F5 (Ke Kolom Voucher)
            /*case 116:
                document.getElementById('cash_voucher').focus();
                e.preventDefault();
                break;
            */
            
            //angka/Slash (Rubah Qty Terakahir)
                
            //Enter
            /*case 13:
                simpan();
                e.preventDefault();
                break;*/
            
        }
        //menghilangkan fungsi default tombol
        /*e.preventDefault();*/
        
    };
</script>

</head>

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style='background-color:#dfdec9' background="" onLoad="document.getElementById('tnis').focus(); JavaScript:refreshlod();">
	
	<div class="page-content">      
		<div class="row">
			<div class="col-xs-12">

				<!-- JavaScript:TimedRefresh(10000);-->

				<!-- <form name="main" method="post" action="" > -->
				<form class="form-horizontal" role="form" action="" method="post" name="absensi_siswa" id="absensi_siswa" class="form-horizontal" enctype="multipart/form-data" >

				    <input type="hidden" name="issubmit" id="issubmit" value="0" />
				    <input type="hidden" name="idkategori" id="idkategori" value="<?php echo $idkategori ?>" />
					<input type="hidden" name="idpenerimaan" id="idpenerimaan" value="<?php echo $idpenerimaan ?>" />
					<input type="hidden" name="nis" id="nis" value="<?php echo $nis ?>" />
					<input type="hidden" name="idtahunbuku" id="idtahunbuku" value="<?php echo $idtahunbuku ?>" />
					<input type="hidden" name="departemen" id="departemen" value="<?php echo $departemen ?>" />
					<input type="hidden" name="departemen_sekolah_id" id="departemen_sekolah_id" value="<?php echo $departemen_sekolah_id ?>" />
				    
				    <div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
						<div class="col-sm-8">						
							<font style="font-size: 24px; color: green;">ABSENSI HARIAN SISWA</font>					
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"  style="font-size: 24px">MASUKKAN NIS</label>
						<div class="col-sm-5">						
							<input type="hidden" name="ref" id="ref" size="25" value="<?php echo $ref ?>" >

							<input type="text" name="tnis" id="tnis" class="form-control" value="<?php echo $nis ?>" onblur="getpenerimaan()" onKeyPress="return focusNext('tnama',event)" onfocus="tnis" style="font-weight: bold; height: 50px; font-size: 20px;" >

							<strong style="color: red">Untuk pencarian NIS/Nama Siswa tekan F7</strong>
							<!-- <input type="text" name="tnis" id="tnis" class="form-control" value="<?php echo $nis ?>" onfocus="tnis" style="font-weight: bold; height: 50px; font-size: 20px;" > -->

							<!-- <a href="JavaScript:lookup_siswa('')" name="Find" title="Find"><img src="../assets/img/plus.png" /></a> -->

							<!-- <a href="javascript:void(0);" name="Find" title="Find" onClick='window.open("../app/presensi_harian_siswa_lup.php","Find","width=900,height=500,left=200,top=20,toolbar=0,status=0,scroll=1,scrollbars=no");'><img src="../assets/img/plus.png" /></a> -->

						</div>
					</div>

				    <div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
						<div class="col-sm-6" style="font-size: 28px; text-align: center;">						
							<strong><?php echo $sukses_absen; ?></strong>
						</div>
					</div>

					<?php if($nis != "") { ?>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
							<div class="col-sm-6" style="text-align: center;">						
								<?php
									$uploaddir 		= '../app/file_foto_siswa';
									if( $foto_file != "" || !empty($foto_file) ) {
										if (file_exists($uploaddir . '/' . $foto_file)) {
								?>
											<img src="../app/file_foto_siswa/<?= $foto_file; ?>" height="150" />
								<?php
										} else {
								?>
											<img src="../assets/img/no_image.jpg" height="150" />
								<?php
										}
									} else {
								?>
										<img src="../assets/img/no_image.jpg" height="150" />
								<?php		
									}
								?>
							</div>
						</div>
					<?php } ?>
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="font-size: 24px">Tanggal</label>
						<div class="col-sm-5">						
							<input type="text" name="tabsen" id="tabsen" class="form-control" readonly value="<?php echo $tanggal ?>"  onClick="Calendar.setup()" style="background-color:#99ff00; font-weight:bold; font-size: 24px">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="font-size: 24px">Sekolah</label>
						<div class="col-sm-5" style="font-weight:bold; font-size: 24px">						
							<?= $departemen ?>&nbsp;&nbsp;(<?= $nama_sekolah ?>)
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="font-size: 24px">NIS</label>
						<div class="col-sm-5">						
							<input type="text" name="nisx" id="nisx" class="form-control" readonly value="<?php echo $nis ?>" style="background-color: #99ff00; font-weight: bold; font-size: 24px" >
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="font-size: 24px">Nama</label>
						<div class="col-sm-5">						
							<input type="text" name="tnama" id="tnama" class="form-control" readonly value="<?php echo $nama ?>" style="background-color: #99ff00; font-weight: bold; font-size: 24px" >
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="font-size: 24px">Kelas</label>
						<div class="col-sm-5">						
							<!-- <strong><php echo $kelas ?></strong> -->
							<input type="text" name="kelas" id="kelas" class="form-control" readonly value="<?php echo $kelas ?>" style="background-color: #99ff00; font-weight: bold; font-size: 24px" >
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="font-size: 24px">Alamat</label>
						<div class="col-sm-5">						
							<input type="text" name="talamat" id="talamat" class="form-control" readonly value="<?php echo $talamat ?>" style="background-color: #99ff00; font-weight: bold; font-size: 24px" >
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>


	<?php if (strlen($errmsg) > 0) { ?>
	<script language="javascript">
		//alert('<?php echo $errmsg?>');		
	</script>
	<?php } ?>


</body>
</html>
<script language="javascript">
 Calendar.setup(
    {
      //inputField  : "tanggalshow","tanggal"
	  inputField  : "tabsen",         // ID of the input field
      ifFormat    : "%d-%m-%Y",    // the date format
      button      : "btntanggal"       // ID of the button
    }
   );

Calendar.setup(
    {
      inputField  : "tabsen",        // ID of the input field
      ifFormat    : "%d-%m-%Y",    // the date format	  
	  button      : "tabsen"       // ID of the button
    }
	
  );
 
</script>


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
