 <table class="table table-bordered table-condensed table-hover table-striped">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<td width="5%" align="center"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></td> 
			<td align="center" colspan="2">Ditujukan</td>
			<td align="center">Instruksi</td>
			<td align="center">Hapus</td>
		</tr>
	</thead>
	<tbody>
		<?php 
				$no = 0;
				$sql=$select->list_surat_masuk_disposisi_detail($ref);
				while($row_disposisi_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
							
		?>								
				<input type="hidden" id="old_line_<?php echo $no ?>" name="old_line_<?php echo $no ?>" value="<?php echo $row_disposisi_detail->line; ?>" >
				<input type="hidden" id="disposisi_id_<?php echo $no ?>" name="disposisi_id_<?php echo $no ?>" value="<?php echo $row_disposisi_detail->disposisi_id; ?>" >
				
				<tr> 
					
					<td align="center">				
						<?php echo $no + 1; ?>.
					</td>

					<td width="10%">
						<?php echo $row_disposisi_detail->nama; ?>		
					</td>
					
					<td width="20%">
						<input type="text" id="nama_disposisi_<?php echo $no ?>" name="nama_disposisi_<?php echo $no ?>" class="form-control" autocomplete="off" style="width: 200px" value="<?php echo $row_disposisi_detail->nama_disposisi; ?>" >
					</td>
					
					<td>
						<input type="text" id="instruksi_<?php echo $no ?>" name="instruksi_<?php echo $no ?>" class="form-control" autocomplete="off" value="<?php echo $row_disposisi_detail->instruksi; ?>" >
					</td>

					<td align="center">
						<?php if($row_disposisi_detail->old == 1) { ?>
							<input type="checkbox" id="delete_<?php echo $no ?>" name="delete_<?php echo $no ?>" class="ace" value="1" ><span class="lbl"></span>
						<?php } ?>
					</td>
									
				</tr>
		<?php 
				$no++; 
			}	
		?>
				<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
						
	</tbody>
</table>