<table id="dynamic-table" class="table table-bordered table-condensed table-hover table-striped" style="width: auto;">
	<thead>
		<tr style="color: #168124; font-weight: bold; border: 1px solid #ccc; background-color: #e6ffea"> 
			<td width="5%" align="center"><?php if($lng==1) { echo 'No.'; } else { echo 'No.'; } ?></td> 
			<td align="center">NIP</td>
			<td align="center">Nama</td>
			<td align="center">Hadir</td>
			<td align="center">Sakit</td>
			<td align="center">Izin</td>
			<td align="center">Cuti</td>
			<td align="center">Alpa</td>
		</tr>
	</thead>
	
	<tbody>
		
		<?php	
			
			/*if($ref == "") {
				$hadir = "checked";
			}*/
			
			//|47|14|7|44|24|32|21|42|4
			$idpegawai__ = "";
			$cuti__ = "";
			$sakit__ = "";
			$izin__ = "";
			$alpa__ = "";

			$no = 0;
			$sql=$select->get_presensi_general($idpegawai, $all);
			while($row_pegawai_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
				
				//if($absen == "hadir") {
					$hadir = "checked";
				//} 
				
				if($absen == "cuti") {
					$cuti = "checked";
				} 
				
				if($absen == "sakit") {
					$sakit = "checked";
				} 
				
				if($absen == "izin") {
					$izin = "checked";
				} 
				
				if($absen == "alpa") {
					$alpa = "checked";
				} 			

				if($idpegawai__ == "") {
					$idpegawai__ = "|".$row_pegawai_detail->replid;
				} else {
					$idpegawai__ = $idpegawai__."|".$row_pegawai_detail->replid;
				}

				if($hadir__ == "") {
					$hadir__ = "|hadir";
				} else {
					$hadir__ = $hadir__."|hadir";
				}

				if($cuti__ == "") {
					$cuti__ = "|";
				} else {
					$cuti__ = $cuti__."|";
				}

				if($sakit__ == "") {
					$sakit__ = "|";
				} else {
					$sakit__ = $sakit__."|";
				}

				if($izin__ == "") {
					$izin__ = "|";
				} else {
					$izin__ = $izin__."|";
				}

				if($alpa__ == "") {
					$alpa__ = "|";
				} else {
					$alpa__ = $alpa__."|";
				}

		?>								
			
				<div class="hide">
					<input type="text" id="idpegawai_<?php echo $no ?>" name="idpegawai_<?php echo $no ?>" value="<?php echo $row_pegawai_detail->replid; ?>" >
				</div>
				
				<tr> 
					<td align="center"><?php echo $no+1 ?></td>
					<td><?php echo $row_pegawai_detail->nip ?></td>
					<td><?php echo $row_pegawai_detail->nama ?></td>
					<td align="center">
						<input type="radio" id="absena_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="hadir" <?php echo $hadir ?> /><span class="lbl"></span>
					</td>
					<td align="center">
						<input type="radio" id="absenc_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="sakit" <?php echo $sakit ?> /><span class="lbl"></span>
					</td>
					<td align="center">
						<input type="radio" id="absend_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="izin" <?php echo $izin ?> /><span class="lbl"></span>
					</td>
					<td align="center">
						<input type="radio" id="absenb_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="cuti" <?php echo $cuti ?> /><span class="lbl"></span>
					</td>
					<td align="center">
						<input type="radio" id="absene_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="alpa" <?php echo $alpa ?> /><span class="lbl"></span>
					</td>
				</tr>
				
				
		<?php 
				$no++; 
			}			

		?>
				<div class="hide">
					<input type="text" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
				</div>
						
	</tbody>
</table>