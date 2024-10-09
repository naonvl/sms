<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
		<tr>            
			<th align="center" width="10%">No</th>
			<th align="center">Nama Barang</th>
			<th align="center">Kelompok Barang</th>
			<th align="center">Jumlah</th> 
			<th align="center">Pilih</th>
		</tr>
	</thead>

	<tbody>
	        
	    <?php 
	    	$booked = $booked . " " . $from_time;
	    	$booked = date("d-m-Y H:i", strtotime($booked));
	    	
	    	$booked_finish = $booked_finish . " " . $to_time;
	    	$booked_finish = date("d-m-Y H:i", strtotime($booked_finish));
	    	
	    	$sql=$select->get_item_lab($_POST['submit'], $warehouse_id_from);
			$jmldata = $sql->rowCount();
	    	
	        $no = 0;
	        					
	    	while($row_item=$sql->fetch(PDO::FETCH_OBJ)) { 
			
			/*$sqlcheck = $select->get_loan_goods_ready($row_item->item_code, $_POST['submit'], $booked, $booked_finish);	
			$rows_item = $sqlcheck->rowCount();*/	    
			$rows_item = 0;
			if($rows_item == 0) {  
	    ?>
	    
	    			<div class="hide">
	                    <input type="text" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
	                	
	                    <input type="text" id="item_code_<?php echo $no; ?>" name="item_code_<?php echo $no; ?>" value="<?php echo $row_item->item_code; ?>">
	                </div>
	    							
	    			<tr style="background-color:ffffff;"> 
	    				<td align="center"><?php echo $no+1 ?>.</td>
	    				<td><?php echo $row_item->item_name; ?></td>
	    				<td><?php echo $row_item->item_group_name; ?></td>
	    				<td align="center">
	    					<input type="tel" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>'),checklist(<?php echo $no ?>)" style="text-align: center; width: 50px" value="1">
	                    </td>
	    				<td width="10%" align="center">
	    					<label class="pos-rel">
	    						<?php //if($row_item->item_booking == 1) { ?>
	    							<input type="checkbox" class="ace" id="book_slc_<?php echo $no; ?>" name="book_slc_<?php echo $no; ?>" onclick="checklist(<?php echo $no ?>)" value="1" ><span class="lbl"></span>
	    						<?php /*} else { ?>
	    							<span class="label label-danger">Perawatan</span>
	    						<?php }*/ ?>
	    					</label>
	    				</td>  				
	    			</tr>
	            
				
	<?php 
			$no++;
			
				}
			
		} 

	?>
	    
	</tbody>
</table>