<table id="simple-table" class="table table-striped table-bordered table-hover" style="width: 70%" />
 	<thead>
		<tr> 
			<th>No.</th>
			<th>Dimensi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			for($i=0; $i<=5; $i++) {			
		?>								
				<tr style="background-color:ffffff;"> 
					<td width="3%" align="center">
						<?= ($i+1) ?>.
					</td>
					<td>
						<textarea id="dimensi_<?= $i ?>" name="dimensi_<?= $i ?>" class="form-control"></textarea>
					</td>
				</tr>
		<?php } ?>		

		<input type="hidden" name="jmldata" id="jmldata" value="<?= $i ?>">
	</tbody>
</table>
