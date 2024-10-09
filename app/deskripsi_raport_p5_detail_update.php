<table id="simple-table" class="table table-striped table-bordered table-hover" />
 	<thead>
		<tr> 
			<th>No.</th>
			<th>Dimensi</th>
			<th></th>
			<th>Hapus Dimensi</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$i = 0;
			$sqldet = $select->list_deskripsi_raport_p5_dimensi($ref);
			while($datadet = $sqldet->fetch(PDO::FETCH_OBJ)) {

				$x = 0;
				$deskripsi_nilai = "";
				$sqldetsub = $select->list_deskripsi_raport_p5_nilai($datadet->replid);
				while($datadetsub = $sqldetsub->fetch(PDO::FETCH_OBJ)) {	
					$x++;
					if($deskripsi_nilai == "") {
						$deskripsi_nilai = $x.'.'.$datadetsub->deskripsi;
					} else {
						$deskripsi_nilai = $deskripsi_nilai.'<br>'.$x.'.'.$datadetsub->deskripsi;
					}
				}

				$deskripsi_nilai = html_entity_decode($deskripsi_nilai, ENT_QUOTES, 'UTF-8');
		?>								
				<tr style="background-color:ffffff;"> 
					<input type="hidden" id="old_line_<?= $i ?>" name="old_line_<?= $i ?>" value="<?= $datadet->line ?>" >
					<td width="3%" align="center">
						<?= ($i+1) ?>.
					</td>
					<td>
						<textarea id="dimensi_<?= $i ?>" name="dimensi_<?= $i ?>" class="form-control"><?= $datadet->dimensi ?></textarea>
					</td>
					<td width="3%" align="center" valign="bottom">
						Hapus Elemen
					</td>
					<th style="text-align: center;">
						<input type="checkbox" class="ace" id="delete_<?= $i ?>" name="delete_<?= $i ?>" value="1" ><span class="lbl"></span>
					</th>
				</tr>

				<!-- get data elemen -->
				<?php
					$j = 0;
					$sqlelemen = $select->list_deskripsi_raport_p5_elemen($datadet->replid);
					while($dataelemen = $sqlelemen->fetch(PDO::FETCH_OBJ)) {
				?>
						<input type="hidden" name="elemen_id_<?= $i.$j ?>" id="elemen_id_<?= $i.$j ?>">
						<input type="hidden" id="elemen_old_line_<?= $i.$j ?>" name="elemen_old_line_<?= $i.$j ?>" value="<?= $dataelemen->line ?>" >
						<tr>
							<td></td>
							<td>Elemen : <?= $j+1 ?>&nbsp;
								<input type="text" name="elemen_<?= $i.$j ?>" id="elemen_<?= $i.$j ?>" style="width: 500px;" value="<?= $dataelemen->elemen ?>">&nbsp;&nbsp;
								Sub Elemen :
								<a href="javascript:void(0);" name="Find" title="Sub Elemen" onClick="deskripsi_nilai('<?php echo $dataelemen->replid ?>','<?php echo $datadet->replid ?>')"><img src="../assets/img/rapor_proses.png" /></a>
							</td>
							<td align="center">
								<input type="checkbox" name="delete_elemen_<?= $i.$j ?>" id="delete_elemen_<?= $i.$j ?>" class="ace" value="1"><span class="lbl"></span>
							</td>
						</tr>
				<?php 
						$j++;
					}
				?>
				<tr>
					<td></td>
					<td>Elemen : <?= $j+1 ?>&nbsp;
						<input type="text" name="elemen_<?= $i.$j ?>" id="elemen_<?= $i.$j ?>" style="width: 500px;" value="">
					</td>
				</tr>

				<input type="hidden" name="jmldata_elemen_<?= $i ?>" id="jmldata_elemen_<?= $i ?>" value="<?= $j ?>">
		<?php 
				$i++;
			} 
		?>		

		<tr style="background-color:ffffff;"> 
			<td align="center">
				<?= ($i+1) ?>.
			</td>
			<td>
				<textarea id="dimensi_<?= $i ?>" name="dimensi_<?= $i ?>" class="form-control"></textarea>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>Elemen : 1 &nbsp;
				<input type="text" name="elemen_<?= $i ?>" id="elemen_<?= $i ?>" style="width: 500px;" value="">
			</td>
		</tr>

		<input type="hidden" name="jmldata" id="jmldata" value="<?= $i ?>">
	</tbody>
</table>
