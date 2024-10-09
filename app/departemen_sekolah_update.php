<table id="simple-table" class="table table-striped table-bordered table-hover" />
 	<thead>
		<tr> 
			<th>No.</th>
			<th>Nama Sekolah</th>
			<th>Alamat</th>
			<th>Nama Kepala Sekolah</th>
			<th>Kuota</th>
			<th>Periode PPDB</th>
			<th style="width: 10%">Link PPDB</th>
			<th>Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no = 0;
			$sqldet = $select->list_departemen_sekolah($ref);
			while($datadet = $sqldet->fetch(PDO::FETCH_OBJ)) {

				$tanggal_awal = date('m/d/Y H:i', strtotime($datadet->tanggal_awal));
				if($tanggal_awal == "01/01/1970 07:00") {
					$tanggal_awal = "";
				}
				$tanggal_akhir = date('m/d/Y H:i', strtotime($datadet->tanggal_akhir));
				if($tanggal_akhir == "01/01/1970 07:00") {
					$tanggal_akhir = "";
				}

				$used = $protection->protection_departemen_sekolah($datadet->replid);
		?>
				<input type="hidden" id="old_id_<?php echo $no; ?>" name="old_id_<?php echo $no; ?>" class="form-control" value="<?= $datadet->replid ?>" >

				<tr> 
					<td><?= ($no+1) ?></td>
					<td>							
						<input type="text" id="nama_<?php echo $no; ?>" name="nama_<?php echo $no; ?>" class="form-control" value="<?= $datadet->nama ?>" >
					</td>
					<td>
						<input type="text" id="alamat_<?php echo $no; ?>" name="alamat_<?php echo $no; ?>" class="form-control" value="<?= $datadet->alamat ?>" >
					</td>
					<td>	
						<div style="width: 230px">						
							<select name="nipkepsek_<?= $no ?>" id="nipkepsek_<?= $no ?>" class="chosen-select form-control" style="width:auto;" >
								<option value=""></option>
								<?php select_pegawai($datadet->nipkepsek) ?>
							</select>
						</div>
					</td>
					<td>
						<input type="text" id="kuota_<?php echo $no; ?>" name="kuota_<?php echo $no; ?>" class="form-control" autocomplete="off" style="width: 60px;" value="<?= $datadet->kuota ?>" >
					</td>
					<td>
						<div class="input-group">
							<input id="tanggal_awal_<?php echo $no; ?>" name="tanggal_awal_<?php echo $no; ?>" type="text" class="form-control" autocomplete="off" value="<?= $tanggal_awal ?>" />
							<br>s/d
							<input id="tanggal_akhir_<?php echo $no; ?>" name="tanggal_akhir_<?php echo $no; ?>" type="text" class="form-control" autocomplete="off" value="<?= $tanggal_akhir ?>" />
						</div>
						<br>Biaya Pendaftaran :<input type="text" id="biaya_<?php echo $no; ?>" name="biaya_<?php echo $no; ?>" class="form-control" autocomplete="off" value="<?= $datadet->biaya ?>" >
						<br>Nama Bank :<input type="text" id="bank_<?php echo $no; ?>" name="bank_<?php echo $no; ?>" class="form-control" autocomplete="off" value="<?= $datadet->bank ?>" >
						<br>Nomor Rekening :<input type="text" id="no_rekening_<?php echo $no; ?>" name="no_rekening_<?php echo $no; ?>" class="form-control" autocomplete="off" value="<?= $datadet->no_rekening ?>">
						<br>A/N :<input type="text" id="nama_pemilik_<?php echo $no; ?>" name="nama_pemilik_<?php echo $no; ?>" class="form-control" autocomplete="off" value="<?= $datadet->nama_pemilik ?>">
					</td>
					<td width="10%">
						<a href="<?= $datadet->link_registrasi ?>" target="_blank"><?= $datadet->link_registrasi ?></a>
					</td>
					<td align="center">
						<?php if($used == 0) { ?>
							<input type="checkbox" name="delete_<?= $no ?>" id="delete_<?= $no ?>" class="ace" value="1"><span class="lbl"></span>
						<?php } ?>
					</td>
				</tr>
		<?php
				$no++;
			}
		?>

		<tr> 
			<td><?= ($no+1) ?></td>
			<td>							
				<input type="text" id="nama_<?php echo $no; ?>" name="nama_<?php echo $no; ?>" class="form-control" value="" >
			</td>
			<td>
				<input type="text" id="alamat_<?php echo $no; ?>" name="alamat_<?php echo $no; ?>" class="form-control" value="" >
			</td>
			<td>	
				<div style="width: 230px">						
					<select name="nipkepsek_<?= $no ?>" id="nipkepsek_<?= $no ?>" class="chosen-select form-control" style="width:auto;" >
						<option value=""></option>
						<?php select_pegawai('') ?>
					</select>
				</div>
			</td>
			<td>
				<input type="text" id="kuota_<?php echo $no; ?>" name="kuota_<?php echo $no; ?>" class="form-control" autocomplete="off" style="width: 60px;" value="" >
			</td>
			<td>
				<div class="input-group">
					<input id="tanggal_awal_<?php echo $no; ?>" name="tanggal_awal_<?php echo $no; ?>" type="text" class="form-control" autocomplete="off" />
					<br>s/d
					<input id="tanggal_akhir_<?php echo $no; ?>" name="tanggal_akhir_<?php echo $no; ?>" type="text" class="form-control" autocomplete="off" />
				</div>				
				<br>Nama Bank :<input type="text" id="bank_<?php echo $no; ?>" name="bank_<?php echo $no; ?>" class="form-control" autocomplete="off" value="" >
				<br>Nomor Rekening :<input type="text" id="no_rekening_<?php echo $no; ?>" name="no_rekening_<?php echo $no; ?>" class="form-control" autocomplete="off" value="">
				<br>A/N :<input type="text" id="nama_pemilik_<?php echo $no; ?>" name="nama_pemilik_<?php echo $no; ?>" class="form-control" autocomplete="off" value="">
			</td>
			<td>
				
			</td>
		</tr>

		<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
		
	</tbody>
</table>