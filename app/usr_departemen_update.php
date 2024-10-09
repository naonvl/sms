<div class="col-sm-5">
	<div class="widget-box">
		<div class="widget-header">
			<h4 class="widget-title">Unit</h4>
		</div>
        
        <table id="simple-table" class="table table-striped table-bordered table-hover">

            <thead>
        		<tr>            
        			<th>Nama Unit</th>
        			<th>Nama Sekolah</th> 
					<th align="center">Pilih</th>
        		</tr>
        	</thead>
            

        	<tbody>
                
            <?php 
            	
            	$sql=$select->list_usr_departemen($ref);
				$jmldata3 = $sql->rowCount();
            	
                $no = 0;					
            	while($row_departemen=$sql->fetch(PDO::FETCH_OBJ)) {  
        		$no++;
            ?>
            
                    <input type="hidden" id="jmldata3" name="jmldata3" value="<?php echo $jmldata3; ?>" >
                    <input type="hidden" id="old_id_<?php echo $no; ?>" name="old_id_<?php echo $no; ?>" value="<?php echo $row_departemen->id; ?>" >
                    <input type="hidden" id="departemen_id_<?php echo $no; ?>" name="departemen_id_<?php echo $no; ?>" value="<?php echo $row_departemen->departemen_id; ?>">
                    <input type="hidden" id="departemen_sekolah_id_<?php echo $no; ?>" name="departemen_sekolah_id_<?php echo $no; ?>" value="<?php echo $row_departemen->departemen_sekolah_id; ?>">
					<input type="hidden" id="old_slc_unit_<?php echo $no; ?>" name="old_slc_unit_<?php echo $no; ?>" value="<?php echo $row_departemen->old; ?>">							
					<tr 
						<?php if($row_departemen->old==1) { ?>style="background-color:#CCFFCC;" <?php } else { ?>style="background-color:#ffffff;" <?php } ?> > 
						<td width="300"><?php echo $row_departemen->departemen; ?></td>
						<td width="300"><?php echo $row_departemen->nama_sekolah; ?></td>
						<td align="center"><input type="checkbox" class="ace" id="slc_unit_<?php echo $no; ?>" name="slc_unit_<?php echo $no; ?>" value="1" <?php if($row_departemen->old==1) echo "checked"; ?> ><span class="lbl"></span></td>
					</tr> 
                    
            
        	<?php } ?>
            
        	</tbody>
        </table>

    </div>
</div>