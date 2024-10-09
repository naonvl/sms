<?php
	@session_start();

	if (($_SESSION["logged"] == 0)) {
		echo 'Access denied';
		exit;
	}

	include_once ("../app/include/sambung.php");
	include_once ("../app/include/functions.php");
	include_once ("../app/include/inword.php");

	include_once ("../app/class/class.select.php");
	include_once ("../app/class/class.selectview.php");
?>

<!-- PAGE CONTENT BEGINS -->
<form class="form-horizontal" role="form" action="" method="post" name="daftarnilai_input" id="daftarnilai_input" enctype="multipart/form-data" >
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload File</label>
		<div class="col-sm-3">
			<input type="file" name="file" id="file" accept=".csv">
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-3">
			<input type="submit" name="submit" class='btn btn-primary' value="Upload" >
		</div>
	</div>
</form>

<?php
if($_POST["submit"]) {
	$select 	= new select;
	$selectview = new selectview;

	$dbpdo = DB::create();

    $fileName 	= $_FILES["file"]["tmp_name"];
    
    /*$sqlukbm 	 = $selectview->list_ukbm_pertemuan($idtingkat, $idpelajaran, $semester_id);
	$dataukbm 	 = $sqlukbm->fetch(PDO::FETCH_OBJ); 
	$jumlah_ukbm1= $dataukbm->jumlah_ukbm;*/
    
    if ($_FILES["file"]["size"] > 0) {
    	    	
    	$file = fopen($fileName, "r");
        
        $jmlnilai = 0;
        $x = 0;
        $insert = 0;
        $update = 0;
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
        	        	
        	if($x > 0) {
        		
        		$uid			=	"import";
				$dlu			=	date("Y-m-d H:i:s");

				$code			=	$column[1];
				$old_code		=	$column[2];
				$name			=	petikreplace($column[3]);
				$name2			=	"";
				$qty			= 	numberreplace($column[4]);
				$spec			=	"";
				$identity_no	=	"";
				$certificate_date=	"";
				$certificate_no	=	"";
				$lab_code		=	"";
				
				$year_purchase	=	numberreplace($column[6]);
				$material		=	petikreplace($column[7]);
				
				$uom_code_stock		=	$column[5];
				$uom_code_sales		=	$column[5];
				$uom_code_purchase	=	$column[5];
				
				/*--------brand---------*/
				$brand_id 		=	$column[8];
				$sql="select id from brand where name='$brand_id'";
				$results=$dbpdo->query($sql);
				$rows=$results->rowCount();
				if($rows == 0) {
					$brand_code = substr($brand_id,0,5);
					$sql="insert into brand (code, name, active, uid, dlu) values ('$brand_code', '$brand_id', 1, '$uid', '$dlu')";
					$results=$dbpdo->query($sql);

					$sqlstr 		= 	"select last_insert_id() last_id";
					$results		=	$dbpdo->query($sqlstr);
					$data 			=  	$results->fetch(PDO::FETCH_OBJ);
					$brand_id		=	$data->last_id;
				} else {
					$data = $results->fetch(PDO::FETCH_OBJ);
					$brand_id = $data->id;
				}
				//----------------

				/*--------item group---------*/
				$item_group_id		=	$column[9];
				$sql="select id from item_group where name='$item_group_id'";
				$results=$dbpdo->query($sql);
				$rows=$results->rowCount();
				if($rows == 0) {
					$group_code = substr($item_group_id,0,5);
					$sql="insert into item_group (code, name, active, uid, dlu) values ('$group_code', '$item_group_id', 1, '$uid', '$dlu')";
					$results=$dbpdo->query($sql);

					$sqlstr 		= 	"select last_insert_id() last_id";
					$results		=	$dbpdo->query($sqlstr);
					$data 			=  	$results->fetch(PDO::FETCH_OBJ);
					$item_group_id	=	$data->last_id;
				} else {
					$data = $results->fetch(PDO::FETCH_OBJ);
					$item_group_id = $data->id;
				}
				//----------------	

				$item_subgroup_id	=	"0";
				$date_receipt 		=	date('Y-m-d', strtotime($column[10]));
				$no_bast 			=	petikreplace($column[11]);
				$unit_cost 			=	numberreplace($column[12]);
				$status 			=	petikreplace($column[14]);

				$size_id 			=	"";
				$item_booking		=	"1";
				$item_category_id 	=	0;
				$minimum_stock 	=	0;
				$maximum_stock 	=	0;
				$consigned 		=	0;
				$item_stock__  	=	$column[17];
				$item_stock 	=	0;
				if($item_stock__ == "Ya") {
					$item_stock = 1;
				} 

				/*--------vendor---------*/
				$vendor_code		=	petikreplace($column[19]);
				if($vendor_code != "") {
					$sql="select syscode from vendor where name='$vendor_code'";
					$results=$dbpdo->query($sql);
					$rows=$results->rowCount();
					if($rows == 0) {
						$date	=	date('Y-m-d');
						$code = notran($date, 'frmvendor', '', '', ''); //---get no ref

						$syscode_vendor		= 	random(15);
						$sql="insert into vendor (code, name, active, uid, dlu, syscode) values ('$code', '$vendor_code', 1, '$uid', '$dlu', '$syscode_vendor')";
						$results=$dbpdo->query($sql);
						notran($date, 'frmvendor', 1, '', '') ; //----eksekusi ref

						$vendor_code	=	$syscode_vendor;
					} else {
						$data = $results->fetch(PDO::FETCH_OBJ);
						$vendor_code = $data->syscode;
					}
				}
				//----------------	
				$source_funds 	=	petikreplace($column[13]);
				$location 		=	petikreplace($column[20]);
				
				/*--------penerbit---------*/
				$publisher_id 		=	petikreplace($column[21]);
				if($publisher_id != "") {
					$sql="select replid from penerbit where nama='$publisher_id'";
					$results=$dbpdo->query($sql);
					$rows=$results->rowCount();
					if($rows == 0) {
						$publish_code = substr($publisher_id,0,5);
						$sql="insert into penerbit (kode, nama, ts) values ('$publish_code', '$publisher_id', '$dlu')";
						$results=$dbpdo->query($sql);

						$sqlstr 		= 	"select last_insert_id() last_id";
						$results		=	$dbpdo->query($sqlstr);
						$data 			=  	$results->fetch(PDO::FETCH_OBJ);
						$publisher_id	=	$data->last_id;
					} else {
						$data = $results->fetch(PDO::FETCH_OBJ);
						$publisher_id = $data->replid;
					}
				} else {
					$publisher_id = "0";
				}
				//----------------	

				$active			= 	1;
				
				$syscode		= 	random(25);
				
				if($name != "") {
					
					$sqlstr="select syscode from item where code='$code'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$dataitem = $sql->fetch(PDO::FETCH_OBJ);
					$rows=$sql->rowCount();
					
					if($rows == 0) {
						$sqlstr="insert into item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, material, year_purchase, date_receipt, no_bast, photo, consigned, item_booking, item_stock, vendor_code, source_funds, location, active, uid, dlu, syscode, status, publisher_id, qty) values ('$code', '$old_code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom_code_stock', '$uom_code_sales', '$uom_code_purchase', '$minimum_stock', '$maximum_stock', '$material', '$year_purchase', '$date_receipt', '$no_bast', '$photo', '$consigned', '$item_booking', '$item_stock', '$vendor_code', '$source_funds', '$location', '$active', '$uid', '$dlu', '$syscode', '$status', '$publisher_id', '$qty')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
						$insert++;
					} else {
						
						$update++;
					}
					
										
				}		
							
			}
			
			$x++;
			
        }
    }
?>    

<table align="center" style="font-size: 36px; color: #07581c">
	<tr>
		<td><?php echo "Jumlah Tambah Data : " . $insert; ?></td>
	</tr>
	<tr>
		<td><?php echo "Jumlah Update Data : " . $update; ?></td>
	</tr>
</table>

<?php    
}
?>



