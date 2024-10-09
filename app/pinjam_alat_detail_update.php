<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
		<tr>            
			<th align="center" width="10%">No</th>
			<th align="center">Nama Barang</th>
			<th align="center">Kelompok Barang</th>
			<th align="center">Jumlah</th> 
			<th align="center">Hapus</th>
		</tr>
	</thead>

	<tbody>
	        
	    <?php 
	    	$sql=$select->list_pinjam_alat_detail($ref);
			$jmldata = $sql->rowCount();
	    	
	        $no = 0;
	        					
	    	while($row_item=$sql->fetch(PDO::FETCH_OBJ)) { 
			
				$qty = number_format($row_item->qty,0,'.',',');
	    ?>
	    
			<div class="hide">
                <input type="text" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
            	
            	<input type="text" id="old_line_<?php echo $no; ?>" name="old_line_<?php echo $no; ?>" value="<?php echo $row_item->line; ?>">
                <input type="text" id="item_code_<?php echo $no; ?>" name="item_code_<?php echo $no; ?>" value="<?php echo $row_item->item_code; ?>">

                <input type="text" id="book_slc_<?php echo $no; ?>" name="book_slc_<?php echo $no; ?>" value="1">
                
            </div>
							
			<tr style="background-color:ffffff;"> 
				<td align="center"><?php echo $no+1 ?>.</td>
				<td><?php echo $row_item->item_name; ?></td>
				<td><?php echo $row_item->item_group_name; ?></td>
				<td align="center">
					<input type="tel" id="qty_<?php echo $no; ?>" name="qty_<?php echo $no; ?>" class="form-control" onkeyup="formatangka('qty_<?php echo $no; ?>')" readonly style="text-align: center; width: 50px" value="<?= $qty ?>">
                </td>
				<td width="10%" align="center">
					<input type="checkbox" class="ace" id="delete_<?php echo $no; ?>" name="delete_<?php echo $no; ?>" value="1" ><span class="lbl"></span>
				</td>  				
			</tr>
	            
				
	<?php 
			$no++;
		} 

	?>
	    
	</tbody>
</table>