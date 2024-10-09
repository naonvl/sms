<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");
include 'class/class.select.php';
include 'class/class.selectview.php';
$select = new select;
$selectview = new selectview;

$idtahunajaran 	= $_REQUEST['idtahunajaran2'];
$semester_id= $_REQUEST['semester'];
$tingkat	= $_REQUEST['tingkat'];
$idkelas	= $_REQUEST['kelas'];
$kelamin	= $_REQUEST['kelamin'];
$nama		= $_REQUEST['nama'];
$nis		= $_REQUEST['nis'];
$nik		= $_REQUEST['nik'];
$all		= $_REQUEST['all'];

/*if($_SESSION["adm"] == 0) {
	if($_SESSION["tipe_user"] == "Siswa") {
		$idtahunajaran 	= $_SESSION['idtahunajaran'];
		$semester_id= $_REQUEST['semester']; //$_SESSION["semester_id"];
		$idkelas	= $_SESSION["idkelas"];
		$idtingkat	= $_SESSION["idtingkat"];
		$nama 		= $_SESSION["nama"];	
		$nis		= $_SESSION['nis'];
		$nik		= $_SESSION['nik'];
		$all		= "";
		$all2 		= "";
	}
	
	if(!empty($_SESSION["idpegawai"])) {
		$sqlpeg = $select->list_pegawai($_SESSION["idpegawai"]);
		$datapeg = $sqlpeg->fetch(PDO::FETCH_OBJ);
		
		$sqlpa=$select->list_kelas("", "", $datapeg->nip);
		$datapa=$sqlpa->fetch(PDO::FETCH_OBJ);
				
		$semester_id= $_REQUEST['semester']; //$_SESSION["semester_id"];
		$idkelas	= $datapa->replid;
		$idtingkat 	= $datapa->idtingkat;
		$nama		= $_REQUEST['nama'];
		$nis		= $_REQUEST['nis'];
		$nik		= $_REQUEST['nik'];
		$all		= "";
		$all2 		= "";
	}
}

if($idtahunajaran == "") {
	$idtahunajaran = $_SESSION["idtahunajaran"];
}*/

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
							$count_semester = explode(",", $semester_id);
							for($x=0; $x<count($count_semester); $x++) {
								$m_semester = "";
								$m_tingkat = "";
    	                    	if($count_semester[$x] == 1) {
									$m_semester = "Ganjil";
									$m_tingkat = "X";
								}
								if($count_semester[$x] == 2) {
									$m_semester = "Genap";
									$m_tingkat = "X";
								}
								if($count_semester[$x] == 3) {
									$m_semester = "Ganjil";
									$m_tingkat = "XI";
								}
								if($count_semester[$x] == 4) {
									$m_semester = "Genap";
									$m_tingkat = "XI";
								}
								if($count_semester[$x] == 5) {
									$m_semester = "Ganjil";
									$m_tingkat = "XII";
								}
								if($count_semester[$x] == 6) {
									$m_semester = "Genap";
									$m_tingkat = "XII";
								}
							}
							$sql1=$select->list_leger_nilai($nis, $idtahunajaran, $m_semester, $m_tingkat, $idkelas);
							$data = $sql1->fetch(PDO::FETCH_OBJ);
							$kelas = $data->kelas;
							$tahun_pelajaran = $data->tahun_pelajaran;
						?>
						<table class="table table-striped table-hover">
							<body>
								<tr>
		                        	<td align="center" colspan="42">SMAN 28 JAKARTA</td>
		                        </tr>
								<tr>
		                        	<td align="center" colspan="42"><?= $kelas ?></td>
		                        </tr>
		                        <tr>
		                        	<td align="center" colspan="42"><?= $tahun_pelajaran ?></td>
		                        </tr>
	                       </body>
	                    </table>
	                    
						
						<table class="table table-striped table-bordered table-hover" style="font-size: 14px">
							<?php
								$count_semester = explode(",", $semester_id);
								for($x=0; $x<count($count_semester); $x++) {
							?>
							
								<tr style="background-color: green; color: white;">
		                        	<td align="left" colspan="44">Semester <?= $count_semester[$x] ?></td>
		                        </tr>
							<!-- <thead> -->								
								<tr>
		                        	<td align="center" rowspan="4">No.</td>
		                        	<td align="center" rowspan="4">NIS</td>
		                        	<td align="center" valign="bottom" rowspan="4">Nama</td>
		                        	<td align="center" colspan="42">Mata Pelajaran</td>
		                        </tr>		                        
		                        <tr>
		                        	<td align="center" colspan="2">Agama</td>
		                        	<td align="center" colspan="2">PPKn</td>
		                        	<td align="center" colspan="2">IND</td>
		                        	<td align="center" colspan="2">ING</td>
		                        	<td align="center" colspan="2">MAT_WJB</td>
		                        	<td align="center" colspan="2">SEJ_WJB</td>
		                        	<td align="center" colspan="2">PENJAS</td>
		                        	<td align="center" colspan="2">PKWU</td>
		                        	<td align="center" colspan="2">JER</td>
		                        	<td align="center" colspan="2">P5</td>
		                        	<td align="center" colspan="2">BK</td>
		                        	<td align="center" colspan="2">SENBUD</td>
		                        	<td align="center" colspan="2">MAT_PM</td>
		                        	<td align="center" colspan="2">BIO</td>
		                        	<td align="center" colspan="2">FIS</td>
		                        	<td align="center" colspan="2">KIM</td>
		                        	<td align="center" colspan="2">MAT L</td>
		                        	<td align="center" colspan="2">Lintas Minat</td>
		                        	<td align="center" colspan="2">Rata2</td>
		                        	<td align="center" colspan="2">Rank</td>
		                        	<td align="center">Kuadran</td>
		                        </tr>
		                        <tr>
		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Peng</td>
		                        	<td align="center">Ket</td>

		                        	<td align="center">Prl</td>
		                        </tr>
	                        <!-- </thead> -->
                      
	                      	<tbody>
	                      		   						
	    	                    <?php
	    	                    	$m_semester = "";
									$m_tingkat = "";
	    	                    	if($count_semester[$x] == 1) {
										$m_semester = "Ganjil";
										$m_tingkat = "X";
									}
									if($count_semester[$x] == 2) {
										$m_semester = "Genap";
										$m_tingkat = "X";
									}
									if($count_semester[$x] == 3) {
										$m_semester = "Ganjil";
										$m_tingkat = "XI";
									}
									if($count_semester[$x] == 4) {
										$m_semester = "Genap";
										$m_tingkat = "XI";
									}
									if($count_semester[$x] == 5) {
										$m_semester = "Ganjil";
										$m_tingkat = "XII";
									}
									if($count_semester[$x] == 6) {
										$m_semester = "Genap";
										$m_tingkat = "XII";
									}

									$i = 0;
									$sql=$select->list_leger_nilai($nis, $idtahunajaran, $m_semester, $m_tingkat, $idkelas);
									while($siswa_view=$sql->fetch(PDO::FETCH_OBJ)){
									
									$i++;

									if($siswa_view->agama_p > 0) {
										$agama_p = $siswa_view->agama_p;
									}
									if($siswa_view->agama_k != "") {
										$agama_k = $siswa_view->agama_k;
									}

									if($siswa_view->pakr_p > 0) {
										$agama_p = $siswa_view->pakr_p;
									}
									if($siswa_view->pakr_k > 0) {
										$agama_k = $siswa_view->pakr_k;
									}

									if($siswa_view->hindu_p > 0) {
										$agama_p = $siswa_view->hindu_p;
									}
									if($siswa_view->hindu_k > 0) {
										$agama_k = $siswa_view->hindu_k;
									}

									if($siswa_view->budha_p > 0) {
										$agama_p = $siswa_view->budha_p;
									}
									if($siswa_view->budha_k > 0) {
										$agama_k = $siswa_view->budha_k;
									}
																	
								?>
                                            
                                    <tr>
                                        <td align="center"><?php echo $i ?></td>
                                        <td><?php echo $siswa_view->nis ?></td>
										<td><?php echo $siswa_view->nama ?></td>
										
										<td><?php echo $agama_p ?></td>
										<td><?php echo $agama_k ?></td>

										<td><?php echo $siswa_view->ppkn_p ?></td>
										<td><?php echo $siswa_view->ppkn_k ?></td>

										<td><?php echo $siswa_view->ind_p ?></td>
										<td><?php echo $siswa_view->ind_k ?></td>

										<td><?php echo $siswa_view->ing_p ?></td>
										<td><?php echo $siswa_view->ing_k ?></td>

										<td><?php echo $siswa_view->mat_wjb_p ?></td>
										<td><?php echo $siswa_view->mat_wjb_k ?></td>

										<td><?php echo $siswa_view->sej_wjb_p ?></td>
										<td><?php echo $siswa_view->sej_wjb_k ?></td>

										<td><?php echo $siswa_view->penjas_p ?></td>
										<td><?php echo $siswa_view->penjas_k ?></td>

										<td><?php echo $siswa_view->pkwu_p ?></td>
										<td><?php echo $siswa_view->pkwu_k ?></td>

										<td><?php echo $siswa_view->jerman_p ?></td>
										<td><?php echo $siswa_view->jerman_k ?></td>

										<td><?php echo $siswa_view->p5_p ?></td>
										<td><?php echo $siswa_view->p5_k ?></td>

										<td><?php echo $siswa_view->bk_p ?></td>
										<td><?php echo $siswa_view->bk_k ?></td>

										<td><?php echo $siswa_view->senbud_p ?></td>
										<td><?php echo $siswa_view->senbud_k ?></td>

										<td><?php echo $siswa_view->mat_pm_p ?></td>
										<td><?php echo $siswa_view->mat_pm_k ?></td>

										<td><?php echo $siswa_view->bio_p ?></td>
										<td><?php echo $siswa_view->bio_k ?></td>

										<td><?php echo $siswa_view->fis_p ?></td>
										<td><?php echo $siswa_view->fis_k ?></td>

										<td><?php echo $siswa_view->kim_p ?></td>
										<td><?php echo $siswa_view->kim_k ?></td>

										<td><?php echo $siswa_view->mat_l_p ?></td>
										<td><?php echo $siswa_view->mat_l_k ?></td>

										<td><?php echo $siswa_view->lintas_minat_p ?></td>
										<td><?php echo $siswa_view->lintas_minat_k ?></td>

										<td><?php echo $siswa_view->rata_p ?></td>
										<td><?php echo $siswa_view->rata_k ?></td>

										<td><?php echo $siswa_view->rank_kelas ?></td>
										<td><?php echo $siswa_view->rank_paralel ?></td>

										<td><?php echo $siswa_view->prl ?></td>
									</tr>
                                
                                <?php
                                    }
                                ?>
	                        
	                        
	                     		</tbody>
	                     	<?php
								}
							?>
						</table>
							
						</div>
					</div>
				</div>

			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
