<table id="simple-table" class="table table-striped table-bordered table-hover" />
 	<thead>
		<tr> 
			<th>No.</th>
			<th>Nama Sekolah</th>
			<th>Alamat</th>
			<th>Nama Kepala Sekolah</th>
			<th>Kuota</th>
			<th>Periode PPDB</th>
		</tr>
	</thead>
	<tbody>
		<?php for($no=0; $no<5; $no++) { ?>
			<tr> 
				<td><?= ($no+1) ?></td>
				<td>							
					<input type="text" id="nama_<?php echo $no; ?>" name="nama_<?php echo $no; ?>" class="form-control" value="" >
				</td>
				<td>
					<input type="text" id="alamat_<?php echo $no; ?>" name="alamat_<?php echo $no; ?>" class="form-control" value="" >
				</td>
				<td>	
					<div style="width: 250px">						
						<select name="nipkepsek_<?= $no ?>" id="nipkepsek_<?= $no ?>" class="chosen-select form-control" style="width:auto;" >
							<option value=""></option>
							<?php select_pegawai('') ?>
						</select>
					</div>
				</td>
				<td>
					<input type="text" id="kuota_<?php echo $no; ?>" name="kuota_<?php echo $no; ?>" class="form-control" autocomplete="off" style="width: 100px;" value="" >
				</td>
				<td>
					<div class="input-group">
						<input id="tanggal_awal_<?php echo $no; ?>" name="tanggal_awal_<?php echo $no; ?>" type="text" class="form-control"autocomplete="off"  />
						<span class="input-group-addon">
							<i class="fa fa-exchange"></i>
						</span>
						<input id="tanggal_akhir_<?php echo $no; ?>" name="tanggal_akhir_<?php echo $no; ?>" type="text" class="form-control" autocomplete="off" />
					</div>
					<br>Biaya Pendaftaran :<input type="text" id="biaya_<?php echo $no; ?>" name="biaya_<?php echo $no; ?>" class="form-control" autocomplete="off" value="" >
					<br>Nama Bank :<input type="text" id="bank_<?php echo $no; ?>" name="bank_<?php echo $no; ?>" class="form-control" autocomplete="off" value="" >
					<br>Nomor Rekening :<input type="text" id="no_rekening_<?php echo $no; ?>" name="no_rekening_<?php echo $no; ?>" class="form-control" autocomplete="off" value="">
					<br>A/N :<input type="text" id="nama_pemilik_<?php echo $no; ?>" name="nama_pemilik_<?php echo $no; ?>" class="form-control" autocomplete="off" value="">
				</td>
			</tr>
		<?php } ?>

		<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
		
	</tbody>
</table>