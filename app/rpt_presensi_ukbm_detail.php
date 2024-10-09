<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");
include_once ("include/inword.php");

include 'class/class.select.php';
include 'class/class.selectview.php';

$select = new select;
$selectview = new selectview;

$idkelas	= $_GET['idkelas'];
$idtingkat	= $_GET['idtingkat'];
$tanggal	= $_GET['tanggal'];
$tanggal1	= $_GET['tanggal1'];
$idguru 	= $_GET['idguru'];
$idpelajaran= $_GET['idpelajaran'];

$ftanggal = "";
if($tanggal == $tanggal1) {
	$ftanggal = date('d F Y', strtotime($tanggal));
} else {
	$ftanggal = date('d F Y', strtotime($tanggal)).' s/d '.date('d F Y', strtotime($tanggal1));
}

?>

<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/font-awesome/4.2.0/css/font-awesome.min.css" />

<!-- page specific plugin styles -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/jquery-ui.custom.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/chosen.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/datepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/daterangepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/colorpicker.min.css" />


<!-- text fonts -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/fonts/fonts.googleapis.com.css" />

<!-- ace styles -->
<link rel="stylesheet" href="../<?php echo $__folder ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />


<!-- ace settings handler -->
<script src="../<?php echo $__folder ?>assets/js/ace-extra.min.js"></script>


<div class="page-content">						
	<div class="row">
		<div class="col-xs-12">
      <!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<div class="clearfix">
						<div class="pull-right tableTools-container"></div>
					</div>
					<!-- div.dataTables_borderWrap -->
					<div>
						<?php
							$sqldet = $selectview->list_kelas($idkelas);
							$datakelas = $sqldet->fetch(PDO::FETCH_OBJ);

							$sqlpel = $select->list_pelajaran($idpelajaran);
							$datapel = $sqlpel->fetch(PDO::FETCH_OBJ);

							$sqlguru = $select->list_pegawai($idguru);
							$dataguru = $sqlguru->fetch(PDO::FETCH_OBJ);
	    				?>
						<table class="table table-striped table-bordered table-hover">
								<tr>
									<td colspan="5" align="center">DETAIL PRESENSI KBM SISWA</td>
								</tr>
								<tr>
									<td width="20%">KELAS</td>
									<td>: <?= $datakelas->tingkat.'-'.$datakelas->kelas ?></td>
								</tr>
								<tr>
									<td>TANGGAL</td>
									<td>: <?= $ftanggal ?></td>
								</tr>
								<tr>
									<td>MATA PELAJARAN</td>
									<td>: <?= $datapel->nama ?></td>
								</tr>
								<tr>
									<td>GURU</td>
									<td>: <?= $dataguru->nama ?></tr>
								</tr>
		                </table>

						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<td align="center">No.</td>
									<td align="center">NIS</td>
									<td align="center">Nama</td>
									<td align="center">Hadir</td>
									<td align="center">Dispensasi</td>
									<td align="center">Sakit</td>
									<td align="center">Izin</td>
									<td align="center">Alpa</td>
								</tr>
	                       </thead>
                      
	                      	<tbody>
	                      		<?php 
	                      			$no= 0;
									$sql=$select->list_presensi_ukbm_siswa('', '', $idtingkat, $idkelas, $nama, $all, 'SMA');
									while($row_siswa_detail=$sql->fetch(PDO::FETCH_OBJ)) { 
										
										$sql2=$select->list_presensi_ukbm_detail($segmen3, $row_siswa_detail->replid, $idtingkat, $idkelas, $row_siswa_detail->tanggal);
										$row_siswa_detail2=$sql2->fetch(PDO::FETCH_OBJ);
									
										$hadir 		= "checked";
										$dispensasi = "";
										$sakit		= "";
										$izin		= "";
										$alpa		= "";
										
										if($row_siswa_detail2->dispensasi == 1) {
											$dispensasi = "checked";
										} else if($row_siswa_detail2->sakit == 1) {
											$sakit = "checked";
										} else if($row_siswa_detail2->izin == 1) {
											$izin = "checked";
										} else if($row_siswa_detail2->alpa == 1) {
											$alpa = "checked";
										} 						
								?>
									<tr>
										<td align="center"><?php echo $no+1 ?></td>
										<td><?php echo $row_siswa_detail->nis ?></td>
										<td><?php echo $row_siswa_detail->nama ?></td>
										<td align="center">
											<input type="radio" id="absena_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="hadir" <?php echo $hadir ?> /><span class="lbl"></span>
										</td>
										<td align="center">
											<input type="radio" id="absenb_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="dispensasi" <?php echo $dispensasi ?> /><span class="lbl"></span>
										</td>
										<td align="center">
											<input type="radio" id="absenc_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="sakit" <?php echo $sakit ?> /><span class="lbl"></span>
										</td>
										<td align="center">
											<input type="radio" id="absend_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="izin" <?php echo $izin ?> /><span class="lbl"></span>
										</td>
										<td align="center">
											<input type="radio" id="absene_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="alpa" <?php echo $alpa ?> /><span class="lbl"></span>
										</td>
									</tr>
								<?php 
										$no++;
									} 
								?>
	                     	</tbody>	                     		
						</table>
						</div>
					</div>
				</div>

			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
</div>
