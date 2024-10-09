<script type="text/javascript" src="<?php echo $__folder ?>js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {

		  if (document.getElementById(arrf[i]).name=='usrid') {
			alert('User Name belum diisi!');
		  }

		  if (document.getElementById(arrf[i]).name=='pwd') {
			alert('Password belum diisi!');
		  }

		  if (document.getElementById(arrf[i]).name=='code') {
			alert('ID belum diisi!');
		  }

		  if (document.getElementById(arrf[i]).name=='name') {
			alert('Nama Agen belum diisi!');
		  }

		  if (document.getElementById(arrf[i]).name=='client_type') {
			alert('Paket belum diisi!');
		  }

		  /*if (document.getElementById(arrf[i]).name=='contact_person3') {
			alert('PIN belum diisi!');
		  }*/

		  if (document.getElementById(arrf[i]).name=='phone') {
			alert('No. WA belum diisi!');
		  }

		  if (document.getElementById(arrf[i]).name=='email') {
			alert('E-mail belum diisi!');
		  }

		  return false
		}

	  }

	  	//proteksi upline
	  	//var name = document.getElementById('name').value;
	  	var client_syscode = document.getElementById('client_syscode').value;
	  	var admin = document.getElementById('admin').value;
	  	if(admin != "1") {
		  	if(client_syscode == "") {
				alert('Referral belum diisi!');
				return false;
			}
		}

	
		var agree = document.getElementById('agree').checked;
		if(agree == false) {
			alert('Silahkan baca dan sepakati ketentuan menjadi member dikibar.com');
			return false;
		}
		
		var pin = document.getElementById('contact_person3').value;
		if(admin != "1") {
			if(pin == "") {
				alert('PIN belum diisi!');
				return false;
			}
		}

		/*var client_type = document.getElementById('client_type').value;

		var amount = document.getElementById('amount').value;
		amount = amount.replace(/[^\d-.]/g,"");
		amount = amount.replace(",","");

		var stockist = document.getElementById('stockist').checked;
		var stockist2 = document.getElementById('stockist2').value;

		if(stockist == true || stockist2 == 1) {*/

			/*if(amount < 300000) {
				alert('Saldo minimal 300,000 (tiga ratus ribu rupiah) !!!');
				return false
			}*/
			/*if(client_type == 5) {
				if(amount < 300000) {
					alert('Saldo minimal basic 300,000 (tiga ratus ribu rupiah) !!!');
					return false
				}
			}*/

			/*if(client_type == 6) {
				if(amount < 15000000) {
					alert('Saldo minimal platinum 15,000,000 (lima belas juta rupiah) !!!');
					return false
				}
			}*/

		//}

		/*if(amount == 0) {
			alert('Registrasi Gagal, Saldo Anda tidak mencukupi!');
			return false
		}*/



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

<script type="text/javascript">
	var request;
	var dest;

	function loadHTMLPost2(URL, destination, button, getId){
		dest = destination;
		str = getId + '=' + document.getElementById(getId).value;
		//str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
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

	function loadHTMLPost3(URL, destination, button, getId){
		dest = destination;
		str = getId + '=' + document.getElementById(getId).checked;
		//str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
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
	<!--
	var request;
	var dest;

	function loadHTMLPost4(URL, destination, button, getId, getId2, getId3){
		dest = destination;
		str = getId + '=' + document.getElementById(getId).value;
		str2 = getId2 + '=' + document.getElementById(getId2).value;
		str3 = getId3 + '=' + document.getElementById(getId3).value;

		var str = str + '&button=' + button;
		var str2 = str2 + '&button=' + button;
		var str3 = str3 + '&button=' + button;
		var str = str + '&' + str2 + '&' + str3;

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

	//-->

</script>

<div class="page-content">

	<div class="row">
		<div class="col-xs-12">

            <?php
				$ref = $segmen3; //$_GET['search'];
				
				if($segmen2 == 'p') {
					$sql_p=$select->list_client($ref, '', '', '', '6', '');
					$row_client_p=$sql_p->fetch(PDO::FETCH_OBJ);
					$client_syscode = $row_client_p->syscode;
					$_SESSION["loginname"] = $row_client_p->usrid;
					$ref	=	"";
				} else {
					$client_syscode = $_SESSION["client_code"];
				}
								
				$date=date("Y-m-d");
				$ref2=notran($date, 'frmclient', '', '', '6'); //---get no ref
				$ref3=notran($date, 'frmclient2', '', '', '6'); //---get no ref
				
				include("app/exec/client_insert.php");

				$stockist = "";
				$active	= "";
				$position_left = "checked";
				$position_right = "";
				$token = gentoken();
				$__free = "";
				$client_type = 6;
				
				if ($ref != "") {
					$sql=$select->list_client($ref, '', '', '', '6', '');
					$row_client=$sql->fetch(PDO::FETCH_OBJ);

					$ref2	=	$row_client->code;
					$ref3	=	$row_client->code2;
					$client_syscode = $row_client->client_syscode;
					$old_client_type = $row_client->old_client_type;
					if($old_client_type == "" || $old_client_type == "0") {
						$old_client_type = $row_client->client_type;
					}
					$client_type = $row_client->client_type;

					if($row_client->stockist == 1) {
						$stockist	= "checked";
					} else {
						$stockist	= "";
					}

					if($row_client->active == 1) {
						$active	= "checked";
					} else {
						$active	= "";
					}

					$__free = "";
					if($row_client->__free == 1) {
						$__free = "checked";
					}

					$position_left = "";
					if($row_client->position == 1) {
						$position_left = "checked";
					}

					if($row_client->position == 2) {
						$position_right = "checked";
					}
					
					$suspend = "";
					if($row_client->suspend == 1) {
						$suspend = "checked";
					}

					$token = $row_client->token;
					
				}
				
			?>

			<!-- PAGE CONTENT BEGINS -->
			<form class="form-horizontal" role="form" action="" method="post" name="client" id="client" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('usrid,pwd,code,client_type,name,phone,email');" >

            	<input type="hidden" id="syscode" name="syscode" value="<?php echo $ref ?>" >
            	<input type="hidden" id="old_client_syscode" name="old_client_syscode" value="<?php echo $row_client->client_syscode ?>" >
            	<input type="hidden" id="old_client_type" name="old_client_type" class="form-control" readonly="" value="<?php echo $old_client_type ?>">
            	<input type="hidden" id="admin" name="admin" class="form-control" readonly="" value="<?php echo $_SESSION["adm"] ?>">
            	<input type="hidden" id="token" name="token" class="form-control" readonly="" value="<?php echo $token ?>">

            	<?php if( $ref == '' ) { ?>
	            	<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> User Name *) </label>
						<?php if($segmen2 != 'p') { ?>
							<div class="col-sm-9" id="user_name">
								<input type="text" id="usrid" name="usrid" placeholder="User Name" autocomplete="off" class="col-xs-10 col-sm-3" required="" onblur="loadHTMLPost2('<?php echo $__folder ?>app/client_ajax.php','user_name','getusername','usrid')" value="<?php echo $row_usr->usrid ?>">
							</div>
						<?php } else { ?>
							<div class="col-sm-9" id="user_name">
								<input type="text" id="usrid" name="usrid" placeholder="User Name" autocomplete="off" class="col-xs-10 col-sm-3" required="" onblur="loadHTMLPost2('<?php echo $__folder ?>app/client_ajax.php','user_name','getusername_ref','usrid')" value="<?php echo $row_usr->usrid ?>">
							</div>
						<?php } ?>
					</div>

	                <div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Password *) </label>
						<div class="col-sm-9">
							<input type="password" id="pwd" name="pwd" placeholder="Password" required="" class="col-xs-10 col-sm-3" value="<?php echo $row_usr->pwdori ?>" />
						</div>
					</div>
				<?php } ?>
				
				<?php /*
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'PIN'; } else { echo 'PIN'; } ?> *)</label>
					<div class="col-sm-2" id="id_pin">
						<?php if( $ref == '' ) { ?>
							<select id="contact_person3" name="contact_person3" class="chosen-select form-control" style="height: 35px" onchange="loadHTMLPost2('<?php echo $__folder ?>app/client_ajax.php','client_type_id','getpaket','contact_person3')">
								<option value=""></option>
								<?php select_client_pin($row_client->contact_person3) ?>
							</select>
						<?php } else { ?>						
							<input type="text" id="contact_person3" name="contact_person3" class="form-control" readonly value="<?php echo $row_client->contact_person3 ?>">
						<?php } ?>
					</div>
				</div>*/ ?>

            	<!--<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'ID'; } else { echo 'ID'; } ?></label>
					<div class="col-sm-3">-->
						<input type="hidden" id="code" name="code" class="form-control" readonly="" value="<?php echo $ref2 ?>">
						<input type="hidden" id="code_view" name="code_view" class="form-control" readonly="" value="<?php echo $ref2 ?>">
					<!--</div>
				</div>-->
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'ID'; } else { echo 'ID'; } ?>*)</label>
					<div class="col-sm-3">
						<input type="text" id="code2" name="code2" class="form-control" readonly="" value="<?php echo $ref3 ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Type'; } else { echo 'Paket'; } ?>*)</label>
					<div class="col-sm-3" id="client_type_id">
						<input type="hidden" id="client_type" name="client_type" value="<?php echo $client_type ?>" />
						<select id="client_type2" name="client_type2" disabled="" class="chosen-select form-control" style="height: 35px">
							<option value=""></option>
							<?php select_client_type($client_type) ?>
						</select>
					</div>
				</div>
					
				<?php /* if( $ref == '' || $_SESSION["adm"] == 1 ) { ?>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Type'; } else { echo 'Paket'; } ?>*)</label>
						<div class="col-sm-3" id="client_type_id">
							<input type="hidden" id="client_type" name="client_type" value="<?php echo $row_client->client_type ?>" />
							<select id="client_type2" name="client_type2" disabled="" class="chosen-select form-control" style="height: 35px">
								<option value=""></option>
								<?php select_client_type($row_client->client_type) ?>
							</select>
						</div>
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Agent'; } else { echo 'Agen'; } ?> *)</label>
						<div class="col-sm-3">
							<input type="hidden" id="client_type" name="client_type" value="<?php echo $row_client->client_type ?>" />
							<select id="client_type2" name="client_type2" class="chosen-select form-control" disabled="" style="height: 35px">
								<option value=""></option>
								<?php select_client_type($row_client->client_type) ?>
							</select>
						</div>
					</div>
				<?php } */ 
				
				?>

				<?php if( $ref == '' || $_SESSION["adm"] == 1 ) { ?>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Referral'; } else { echo 'Referral'; } ?>*)</label>
						<div class="col-sm-5">
							<?php if( $_SESSION["adm"] == 1 ) { ?>
								<select id="client_syscode" name="client_syscode" class="chosen-select form-control" style="height: 35px" onchange="loadHTMLPost2('<?php echo $__folder ?>app/client_saldo_ajax.php','view_saldo','getsaldo','client_syscode')" >
									<option value=""></option>
									<?php //select_client_member_registrasi($ref, $row_client->client_syscode) ?>
									<?php select_client_referral($row_client->client_syscode); ?>
								</select>
							<?php } else if($segmen2 == 'p') { ?>
								<input type="hidden" id="client_syscode" name="client_syscode" value="<?php echo $client_syscode ?>" />
								<select id="client_syscode2" name="client_syscode2" class="chosen-select form-control" disabled="" style="height: 35px">
									<option value=""></option>
									<?php select_client_referral($client_syscode); ?>
								</select>
							<?php } else { ?>
								<input type="hidden" id="client_syscode" name="client_syscode" value="<?php echo $client_syscode ?>" />
								<select id="client_syscode2" name="client_syscode2" class="chosen-select form-control" disabled="" style="height: 35px">
									<option value=""></option>
									<?php select_client_referral($client_syscode); ?>
								</select>
							<?php } ?>
						</div>
					</div>
				<?php } else { ?>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Referral'; } else { echo 'Referral'; } ?></label>
						<div class="col-sm-5">
							<input type="hidden" id="client_syscode" name="client_syscode" value="<?php echo $row_client->client_syscode ?>" />
							<select id="client_syscode2" name="client_syscode2" class="chosen-select form-control" disabled="" style="height: 35px">
								<?php //select_client($row_client->client_syscode); //select_client_member($ref, $row_client->client_syscode) ?>
								<?php select_client_referral($client_syscode); ?>
							</select>
						</div>
					</div>
				<?php } ?>

            	<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Agent Name'; } else { echo 'Nama Lengkap'; } ?> *)</label>
					<div class="col-sm-3">
						<input type="text" id="name" name="name" class="form-control" required="" value="<?php echo $row_client->name ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Edentity ID'; } else { echo 'NO KTP'; } ?> </label>
					<div class="col-sm-3" id="ktp_id">
						<?php if($ref == "") { ?>
							<input type="text" id="fax" name="fax" class="form-control" autocomplete="off" onblur="loadHTMLPost4('<?php echo $__folder ?>app/client_ajax.php','ktp_id','getktp','code','fax','client_type')" value="<?php echo $row_client->fax ?>">
						<?php } else { ?>
							<input type="text" id="fax" name="fax" class="form-control" autocomplete="off" onblur="loadHTMLPost4('<?php echo $__folder ?>app/client_ajax.php','ktp_id','getktp2','code','fax','client_type')" value="<?php echo $row_client->fax ?>">
						<?php } ?>
					</div>
				</div>
				
				<div class="form-group"> 
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload KTP</label>
                        
                    <div class="col-sm-5">
						<input type="file" id="identity_file" name="identity_file" />
						<?php if (!empty($row_client->identity_file)) { ?>
        					<img src="../app/ktp_file/<?php echo $row_client->identity_file; ?>" width="160" height="150" />
        				<?php } ?>
                        <input type="hidden" id="identity_file2" name="identity_file2" value="<?php echo $row_client->identity_file; ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Address'; } else { echo 'Alamat'; } ?></label>
					<div class="col-sm-3">
						<input type="text" id="address" name="address" class="form-control" value="<?php echo $row_client->address ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Zip Code'; } else { echo 'Kode Pos'; } ?></label>
					<div class="col-sm-3">
						<input type="text" id="zip_code" name="zip_code" class="form-control" maxlength="5" value="<?php echo $row_client->zip_code ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'WA Phone'; } else { echo 'No WA'; } ?> *)</label>
					<div class="col-sm-3" id="phone_id">

						<input type="text" id="phone" name="phone" class="form-control" required="" autocomplete="off" value="<?php echo $row_client->phone ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">E-mail *)</label>
					<div class="col-sm-3">
						<input type="email" id="email" name="email" class="form-control" required="" value="<?php echo $row_client->email ?>">
					</div>
				</div>

				<!--<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">TTL</label>
					<div class="col-sm-3">
						<input type="text" id="web" name="web" class="form-control" value="<?php echo $row_client->web ?>">
					</div>
				</div>-->

                <div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Bank Name'; } else { echo 'Nama Bank'; } ?></label>
					<div class="col-sm-3">
						<input type="text" id="bank_name" name="bank_name" class="form-control" value="<?php echo $row_client->bank_name ?>">
					</div>
				</div>

                <div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Bank Branch'; } else { echo 'Cabang'; } ?></label>
					<div class="col-sm-3">
						<input type="text" id="bank_branch" name="bank_branch" class="form-control" value="<?php echo $row_client->bank_branch ?>">
					</div>
				</div>

                <div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Acc. Bank No.'; } else { echo 'No Rekening'; } ?></label>
					<div class="col-sm-3">
						<input type="text" id="bank_account_no" name="bank_account_no" class="form-control" value="<?php echo $row_client->bank_account_no ?>">
					</div>
				</div>

                <div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Acc. Bank Name'; } else { echo 'Nama Pemilik Rekening'; } ?></label>
					<div class="col-sm-3">
						<textarea id="bank_account" name="bank_account" class="form-control"><?php echo $row_client->name ?></textarea>
					</div>
				</div>

                <?php if($ref !='' && $_SESSION["adm"] == 1) { ?>
                	<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Registation Amount'; } else { echo 'Biaya Pendaftaran'; } ?></label>
						<div class="col-sm-3">
							<input type="text" id="amount_receipt" name="amount_receipt" class="form-control" style="text-align: right" autocomplete="off" onkeyup="formatangka('amount_receipt')" value="<?php echo number_format($row_client->amount_receipt,0,'.',',') ?>">
						</div>
					</div>
					
                	<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Deposit'; } else { echo 'Simpanan Pokok'; } ?></label>
						<div class="col-sm-3">
							<input type="text" id="amount" name="amount" class="form-control" style="text-align: right" autocomplete="off" onkeyup="formatangka('amount')" value="<?php echo number_format($row_client->amount,0,'.',',') ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Voucher'; } else { echo 'Voucher'; } ?></label>
						<div class="col-sm-3">
							<input type="text" id="voucher" name="voucher" class="form-control" style="text-align: right" autocomplete="off" onkeyup="formatangka('voucher')" value="<?php echo number_format($row_client->voucher,0,'.',',') ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Income Voucher'; } else { echo 'Income Voucher'; } ?></label>
						<div class="col-sm-3">
							<input type="text" id="voucher_income" name="voucher_income" class="form-control" style="text-align: right" autocomplete="off" onkeyup="formatangka('voucher_income')" value="<?php echo number_format($row_client->voucher_income,0,'.',',') ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><?php if($lng==1) { echo 'Active'; } else { echo 'Aktif'; } ?></label>
						<div class="col-sm-3">
							<?php //if($ref =='') { ?>
								<input class="ace" type="checkbox" name="active" id="active" value="1" <?php echo $active ?> />
							<?php /*} else { ?>
								<input class="ace" type="checkbox" name="active" id="active" value="1" <?php if($row_client->active==1) echo "checked";?>/>
							<?php }*/ ?>
							<span class="lbl"></span>

						</div>
					</div>
				<?php } ?>

				<?php if( $_SESSION["adm"] == 1 ) { ?>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Free</label>
						<div class="col-sm-3">
							<input class="ace" type="checkbox" name="__free" id="__free" value="1" <?php echo $__free ?> />
							<span class="lbl"></span>

						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Suspend</label>
						<div class="col-sm-3">
							<input class="ace" type="checkbox" name="suspend" id="suspend" value="1" <?php echo $suspend ?> />
							<span class="lbl"></span>

						</div>
					</div>
				<?php } else { ?>
					<input type="hidden" name="__free" id="__free" value="0" />
					<input type="hidden" name="suspend" id="suspend" value="<?php echo $row_client->suspend ?>" />
					<input type="hidden" id="amount_receipt" name="amount_receipt" value="<?php echo number_format($row_client->amount_receipt,0,'.',',') ?>">
					<input type="hidden" id="amount" name="amount" class="form-control" style="text-align: right" onkeyup="formatangka('amount')" value="<?php echo number_format($row_client->amount,0,'.',',') ?>">
					<input type="hidden" id="voucher" name="voucher" class="form-control" style="text-align: right" onkeyup="formatangka('voucher')" value="<?php echo number_format($row_client->voucher,0,'.',',') ?>">
					<input type="hidden" id="voucher_income" name="voucher_income" class="form-control" value="<?php echo number_format($row_client->voucher_income,0,'.',',') ?>">
				<?php } ?>
				
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Agree</label>
					<div class="col-sm-3">
						<input class="ace" type="checkbox" name="agree" id="agree" value="1" <?php echo $__free ?> />
						<span class="lbl"></span>
						<a href="#my-modal" role="button" class="bigger-125 bg-primary white" data-toggle="modal">
							Pernyataan Agree
						</a>

					</div>
				</div>
					
				
				
				
				<div id="my-modal" class="modal fade" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h3 class="smaller lighter blue no-margin">Pernyataan Kesepakatan Member dikibar.com</h3>
							</div>

							<div class="modal-body">
								<?php
									$sqlcompany = $select->list_company();
									$datacompany = $sqlcompany->fetch(PDO::FETCH_OBJ);
									$agree = $datacompany->agree;
									echo $agree;
								?>
							</div>

							<div class="modal-footer">
								<button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
									<i class="ace-icon fa fa-times"></i>
									Close
								</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div>
				
				
				

				<div class="space-4"></div>

				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">

                        <?php if (allowupd('frmclient')==1 && $_SESSION["suspend"] != 1) { ?>
                            <?php if($ref!='') { ?>
    							<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Edit" />
    						<?php } ?>
                        <?php } ?>

                        <?php if (allowadd('frmclient')==1 || $act == 'p') { ?>
    						<?php if($ref=='' && $_SESSION["suspend"] != 1) { ?>
    							<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Daftar" />
    						<?php } ?>
                        <?php } ?>

                        <?php if (allowdel('frmclient')==1 && $_SESSION["suspend"] != 1) { ?>
                            &nbsp;
    						<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
                        <?php } ?>

						<?php if($act != 'p') { ?>
							&nbsp;
							<input type="button" name="submit" id="submit" class="btn btn-success" value="Daftar Data" onclick="self.location='<?php echo $nama_folder . '/' . obraxabrix('client_view') ?>'" />
						<?php } ?>
			
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
