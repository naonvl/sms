<html>
    <head>
    </head>
    <body>

      <?php
            session_start();

            if (($_SESSION["logged"] == 0)) {
              echo 'Access denied';
              exit;
            }
        ?>
        <?php
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Daftar PTK Non PNS.xls");

            include_once ("include/queryfunctions.php");
            include_once ("include/functions.php");
            include_once ("include/function_excel.php");

            include 'class/class.select.php';
            include 'class/class.selectview.php';

            $select = new select;
            $selectview = new selectview;

			$bagian		= $_REQUEST['bagian'];
			$nip		= $_REQUEST['nip'];
			$nama		= $_REQUEST['nama'];
			$all		= $_REQUEST['all'];
        ?>

	        <table border="1" id="dynamic-table" class="table table-striped table-bordered table-hover">
	        	<tr>
                    <th colspan="7" class="left" style="font-weight:bold ">DAFTAR DATA PTK NON PNS</th>
				</tr>
				<thead>
					<tr>
                        <th class="center" style="font-weight:bold ">No.</th>
                        <th style="font-weight:bold ">Bagian&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Jabatan&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Nama&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">NIKKI&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Pendidikan Terakhir&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Jurusan&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Tahun Lulus&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Universitas/Sekolah&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Nama Panggilan&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Jenis Kelamin&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Gelar Depan&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Gelar Belakang&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Tempat Lahir&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Karpeg&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Tanggal Lahir&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">No Peserta Sertifikasi&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Jenis Sertifikat&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">NIK&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Agama&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">NUPTK&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Menikah&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Jenis Identitas&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">No Identitas&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Alamat&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">TMT di SMAN&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">No. SK KKI&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Tahun SK KKI&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Status Pegawai&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Banyak Jam di Induk&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Banyak Jam di non Induk&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Desa/Kelurahan&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Kecamatan&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Kode Pos&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Email&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">No. HP&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">No. Telepon&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Nama Ibu Kandung&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">NPWP&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Nama Bank&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Unit Bank&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Nama Pemilik Bank&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">No Rekening&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Tanggal Pensiun&nbsp;&nbsp;</th>
						<th style="font-weight:bold ">Keterangan&nbsp;&nbsp;</th>
					</tr>
				</thead>

				<tbody>
                    <?php			
						$sql=$selectview->list_pegawai_non_pns($bagian, $nip, $nama, $all);
						while($pegawai_view=$sql->fetch(PDO::FETCH_OBJ)){
						
							$i++;
							
							if($pegawai_view->kelamin == "P") {
								$kelamin = "Perempuan";
							} else {
								$kelamin = "Laki-laki";
							}
							
							$nikah = "";
							if($pegawai_view->nikah == 'belum') {
								$nikah = "Belum Menikah";
							}
							if($pegawai_view->nikah == 'sudah') {
								$nikah = "Sudah Menikah";
							}

							$jenis_id = "";
							if($pegawai_view->jenis_id == 'ktp') {
								$jenis_id = "KTP";
							}
							if($pegawai_view->jenis_id == 'passpor') {
								$jenis_id = "PASSPOR";
							}
							if($pegawai_view->jenis_id == 'sim') {
								$jenis_id = "SIM";
							}

							$status_pegawai = "";
							if($pegawai_view->status_pegawai == 1) {
								$status_pegawai = "KKI";
							}
							if($pegawai_view->status_pegawai == 2) {
								$status_pegawai = "Non KKI";
							}
							
					?>
                                
                            <tr>
                                <td align="center"><?php echo $i ?></td>
                                <td><?php echo $pegawai_view->nama_bagian ?></td>
								<td><?php echo $pegawai_view->jabatan ?></td>
								<td><?php echo $pegawai_view->nama ?></td>
								<?php
									$nikki = $pegawai_view->nip;
									echo "<td>=\"$nikki\"</td>";
								?>
								<td><?= $pegawai_view->pendidikan_terakhir ?></td>
								<td><?= $pegawai_view->jurusan ?></td>
								<td><?= $pegawai_view->tahun_lulus ?></td>
								<td><?= $pegawai_view->universitas ?></td>
								<td><?= $pegawai_view->panggilan ?></td>
								<td><?= $kelamin ?></td>
								<td><?= $pegawai_view->gelar ?></td>
								<td><?= $pegawai_view->gelar_belakang ?></td>
								<td><?= $pegawai_view->tmplahir ?></td>
								<td><?= $pegawai_view->karpeg ?></td>
								<td><?= date('d-m-Y', strtotime($pegawai_view->tgllahir)) ?></td>
								<td><?= $pegawai_view->no_sertifikasi ?></td>
								<td><?= $pegawai_view->idjenis_sertifikasi ?></td>
								<td><?= $pegawai_view->nik ?></td>
								<td><?= $pegawai_view->agama ?></td>
								<td><?= $pegawai_view->nuptk ?></td>
								<td><?= $nikah ?></td>
								<td><?= $jenis_id ?></td>
								<td><?= $pegawai_view->noid ?></td>
								<td><?php echo $pegawai_view->alamat ?></td>
								<td><?= date('d-m-Y', strtotime($pegawai_view->unit_cpns)) ?></td>
								<td><?= $pegawai_view->no_skkki ?></td>
								<td><?= date('d-m-Y', strtotime($pegawai_view->tahun_skkki)) ?></td>
								<td><?= $status_pegawai ?></td>
								<td><?= $pegawai_view->jumlah_jam_induk ?></td>
								<td><?= $pegawai_view->jumlah_jam_ajar_lain ?></td>
								<td><?= $pegawai_view->desa ?></td>
								<td><?= $pegawai_view->kecamatan ?></td>
								<td><?= $pegawai_view->kode_pos ?></td>
								<td><?= $pegawai_view->email ?></td>
								<td><?= $pegawai_view->handphone ?></td>
								<td><?= $pegawai_view->telpon ?></td>
								<td><?= $pegawai_view->nama_ibu ?></td>
								<td><?= $pegawai_view->npwp ?></td>
								<td><?= $pegawai_view->nama_bank ?></td>
								<td><?= $pegawai_view->unit_bank ?></td>
								<td><?= $pegawai_view->nama_pemilik ?></td>
								<td><?= $pegawai_view->no_rek ?></td>
								<td><?= date('d-m-Y', strtotime($pegawai_view->tanggal_pensiun)) ?></td>
								<td><?= $pegawai_view->keterangan ?></td>
							</tr>
                        
                        <?php
                            }
                        ?>
                        
				</tbody>
			</table>
    </body>
</html>