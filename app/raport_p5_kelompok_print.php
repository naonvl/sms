<?php
session_start();
            
error_reporting(E_ALL & ~E_NOTICE);

if (($_SESSION["logged"] == 0)) {
  echo 'Access denied';
  exit;
}

//include_once ("include/queryfunctions.php");
include_once ("include/sambung.php");
include_once ("include/functions.php");
//include_once ("include/inword.php");

include 'class/class.select.php';
include 'class/class.selectview.php';

//include "phpqrcode/qrlib.php"; //<-- LOKASI FILE UTAMA PLUGINNYA

$select = new select;
$selectview = new selectview;

$dbpdo = DB::create();

#-------------FILTER
$departemen_id = $_REQUEST["departemen_id"]; 
$departemen_sekolah_id = $_REQUEST["departemen_sekolah_id"]; 
$idsiswa		= $_REQUEST["idsiswa"];
$idsemester		= $_REQUEST["semester_id"]; //$_SESSION["semester_id"];
$idtingkat		= $_REQUEST["idtingkat"];
$idkelas		= $_REQUEST["idkelas"];
$idtahunajaran	= $_REQUEST["idtahunajaran"];
$alumni			= $_REQUEST["alumni"];
$idtema 		= $_REQUEST["idtema"];
$raport_line 		= $_REQUEST["line"];
$iddetail = $_REQUEST["iddetail"];
$syscode 		= $_REQUEST["line"];

$sqlidentitas = $selectview->list_identitas();
$dataidentitas = $sqlidentitas->fetch(PDO::FETCH_OBJ);

$sqlthnajaran = $selectview->list_tahunajaran($idtahunajaran);
$datatahunajaran = $sqlthnajaran->fetch(PDO::FETCH_OBJ);
$tahun_ajaran 	= $datatahunajaran->tahunajaran;
$nip_kepsek		= $datatahunajaran->info1;
$nama_kepsek	= $datatahunajaran->nama_kepsek;
$ttd_file_kepsek= $datatahunajaran->ttd_file;

$sqlsiswa = $selectview->get_siswa_raport_p5("", $iddetail, '', $alumni, '', '');
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$document = new Dompdf();
/*$canvas = $document ->get_canvas();
$mline = $canvas->page_line(0, 0, "{PAGE_NUM}/{PAGE_COUNT}", null, 10, array(0, 0, 0));*/


$html = '
  <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}


tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<table>
  <tr>
    <th>Company</th>
    <th>Contact</th>
    <th>Country</th>
  </tr>
  <tr>
    <td>Alfreds Futterkiste</td>
    <td>Maria Anders</td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Centro comercial Moctezuma</td>
    <td>Francisco Chang</td>
    <td>Mexico</td>
  </tr>
  <tr>
    <td>Ernst Handel</td>
    <td>Roland Mendel</td>
    <td>Austria</td>
  </tr>
  <tr>
    <td>Island Trading</td>
    <td>Helen Bennett</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Laughing Bacchus Winecellars</td>
    <td>Yoshi Tannamuri</td>
    <td>Canada</td>
  </tr>
  <tr>
    <td>Magazzini Alimentari Riuniti</td>
    <td>Giovanni Rovelli</td>
    <td>Italy</td>
  </tr>
</table>
';

if($idsemester == 24 && $idtingkat == 27) {
	$numeric_semester = 1;
}
if($idsemester == 20 && $idtingkat == 27) {
	$numeric_semester = 2;
}

if($idsemester == 24 && $idtingkat == 28) {
	$numeric_semester = 3;
}
if($idsemester == 20 && $idtingkat == 28) {
	$numeric_semester = 4;
}

if($idsemester == 24 && $idtingkat == 46) {
	$numeric_semester = 5;
}
if($idsemester == 20 && $idtingkat == 46) {
	$numeric_semester = 6;
}

if($idtingkat == 27) {
	$fase = "E";
}
if($idtingkat == 28) {
	$fase = "F";
}

$total_baris = 0;

$output = "
  <style>
  	.header {
	     position: fixed;
	     top: -10px;
	     left: 0px;
	     height: 30px;
	  }
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
    }

    .page_break { 
    		page-break-before: always;
    }
</style>";

$m_page		=	0;
while($datasiswa = $sqlsiswa->fetch(PDO::FETCH_OBJ)) {
		$idsiswa = $datasiswa->replid;
		$angkatan =  $datasiswa->angkatan; //angkatan
		$sqlsemester = $selectview->list_semester($idsemester);
		$datasemester = $sqlsemester->fetch(PDO::FETCH_OBJ);

		$sqlperiode_raport = $select->list_setup_periode_raport_p5('', $idtahunajaran, $idsemester, $idtingkat, $all, $departemen_id,  $departemen_sekolah_id);
		$periode_raport = $sqlperiode_raport->fetch(PDO::FETCH_OBJ);
		/*------------------------------------------*/

		/*---------print header-----------*/
		$nama_sekolah	=	$dataidentitas->nama;
		$nama_semester	=	$datasemester->semester;
		$tanggal_ttd	=	$periode_raport->tanggal_ttd; //$datasemester->tanggal_ttd;
		$alamat_sekolah	=	$dataidentitas->alamat1;
		$nama_siswa		=	$datasiswa->nama;
		$nis_siswa		=	$datasiswa->nis;
		$nisn_siswa		=	$datasiswa->nisn;
		$kelas			=	$datasiswa->kelas;
		if($_REQUEST["idkelas"] != "") {
			$sqlkelas = $selectview->list_kelas($_REQUEST["idkelas"]);
			$data_kelas = $sqlkelas->fetch(PDO::FETCH_OBJ);
			$kelas			=	$data_kelas->kelas;
		}
		$idtingkat		= 	$idtingkat; //$datasiswa->idtingkat;
		$tingkat 		=	$datasiswa->tingkat;
		if($_REQUEST["idtingkat"] != "") {
			$sqltingkat = $selectview->list_tingkat($_REQUEST["idtingkat"]);
			$datatingkat = $sqltingkat->fetch(PDO::FETCH_OBJ);
			$tingkat = $datatingkat->tingkat;
		}
		$idkelas_wali	=	$idkelas; //$datasiswa->idkelas;

		$numeric_semester = numeric_semester($idtingkat, $idsemester);
		/*-------------------------------*/

		if($m_page == 0) {
			$output .= '<div>';	
		} else {
			$output .= '<div class="page_break">';
		}

		$kop_header = '<table border="0" width="100%" class="page_break" style="text-align: center; font-size: 14px;">
			        <tr>
			          <td width="18%" style="text-align: left;">Nama Peserta Didik</td>
			          <td width="1%" style="text-align: left;">:</td>
			          <td width="45%" style="text-align: left;">'.$nama_siswa.'</td>

			          <td width="15%" style="text-align: left;">Kelas</td>
			          <td width="1%" style="text-align: left;">:</td>
			          <td width="18%" style="text-align: left;">'.$kelas.'</td>
			        </tr>
			        <tr>
			          <td width="18%" style="text-align: left;">NISN</td>
			          <td width="1%" style="text-align: left;">:</td>
			          <td width="45%" style="text-align: left;">'.$nisn_siswa.'</td>

			          <td width="15%" style="text-align: left;">Tingkat</td>
			          <td width="1%" style="text-align: left;">:</td>
			          <td width="18%" style="text-align: left;">'.$tingkat.'</td>
			        </tr>
			        <tr>
			          <td width="18%" style="text-align: left;">Sekolah</td>
			          <td width="1%" style="text-align: left;">:</td>
			          <td width="45%" style="text-align: left;">'.$nama_sekolah.'</td>

			          <td width="15%" style="text-align: left;">Tahun Pelajaran</td>
			          <td width="1%" style="text-align: left;">:</td>
			          <td width="18%" style="text-align: left;">'.$tahun_ajaran.'</td>
			        </tr>
			        <tr>
			          <td width="18%" style="text-align: left;">Alamat</td>
			          <td width="1%" style="text-align: left;">:</td>
			          <td width="45%" style="text-align: left;">'.$alamat_sekolah.'</td>

			          <td width="15%" style="text-align: left;"></td>
			          <td width="1%" style="text-align: left;"></td>
			          <td width="18%" style="text-align: left;"></script>'.'</td>
			        </tr></table>';

		$output .= '<table border="0" width="100%" style="text-align: center; font-size: 25px; font-weight: bold; background-color: #4dc4ef; color: white; margin-top: -25px">
		        <tr>
		          <td colspan="6" style="text-align: center;">RAPOR PROJEK</td>
		        </tr>';
		$output .= '</table>';

		$output .= '<table border="0" width="100%" style="text-align: center; font-size: 14px;">
		        <tr>
		          <td width="18%" style="text-align: left;">Nama Peserta Didik</td>
		          <td width="1%" style="text-align: left;">:</td>
		          <td width="45%" style="text-align: left;">'.$nama_siswa.'</td>

		          <td width="15%" style="text-align: left;">Kelas</td>
		          <td width="1%" style="text-align: left;">:</td>
		          <td width="18%" style="text-align: left;">'.$kelas.'</td>
		        </tr>
		        <tr>
		          <td width="18%" style="text-align: left;">NISN</td>
		          <td width="1%" style="text-align: left;">:</td>
		          <td width="45%" style="text-align: left;">'.$nisn_siswa.'</td>

		          <td width="15%" style="text-align: left;">Tingkat</td>
		          <td width="1%" style="text-align: left;">:</td>
		          <td width="18%" style="text-align: left;">'.$tingkat.'</td>
		        </tr>
		        <tr>
		          <td width="18%" style="text-align: left;">Sekolah</td>
		          <td width="1%" style="text-align: left;">:</td>
		          <td width="45%" style="text-align: left;">'.$nama_sekolah.'</td>

		          <td width="15%" style="text-align: left;">Tahun Pelajaran</td>
		          <td width="1%" style="text-align: left;">:</td>
		          <td width="18%" style="text-align: left;">'.$tahun_ajaran.'</td>
		        </tr>
		        <tr>
		          <td width="18%" style="text-align: left;">Alamat</td>
		          <td width="1%" style="text-align: left;">:</td>
		          <td width="45%" style="text-align: left;">'.$alamat_sekolah.'</td>

		          <td width="15%" style="text-align: left;"></td>
		          <td width="1%" style="text-align: left;"></td>
		          <td width="18%" style="text-align: left;"></script>'.'</td>
		        </tr>

		        ';
		$output .= '</table>';

		$total_baris = $total_baris + 4;

		// $output .= '<table border="0" width="100%" style="text-align: center; font-size: 12px; padding-top: 10px">
		// 	        <tr style="font-weight: bold">
		// 	          <td style="text-align: center; height: 1px"><hr></td>
		// 	        </tr>';
		// $output .= '</table>';

		##get tema
		//$sqltema = $select->list_raport_p5($idtema, '', '', '', '', '', '', $raport_line);
		$sqltema = $select->list_raport_p5('', '', '', '', '', '', '', $syscode, $idsiswa);
		$datatema = $sqltema->fetch(PDO::FETCH_OBJ);
		$tema = $datatema->tema;
		$nama_tema = $datatema->nama_tema;
		$syscode = $datatema->syscode;
		$rangkuman_proses_id = $datatema->rangkuman_proses_id;

		// $output .= '<table border="0" width="100%" style="text-align: center; font-size: 12px; padding-top: 10px">
	  //       <tr style="font-weight: bold;">
	  //         <td width="60%" align="left" colspan="6" >Tema : '.$nama_tema.'</td>
	  //       </tr></table>';
	  $output .= '<table border="0" width="100%" style="text-align: center; font-size: 12px; padding-top: 2px; border-top: 1px solid #000000">
	        <tr style="font-weight: bold;">
	          <td width="60%" align="left" colspan="6" >Tema : '.$nama_tema.'</td>
	        </tr></table>';

		$output .= '<table border="0" width="100%" style="text-align: center; font-size: 12px; padding-top: 10px">
			        <tr style="font-weight: bold;">
			        	<td style="text-align: left; border-bottom: 1px solid #000000; border-top: 1px solid #000000"></td>
			          <td width="60%" style="text-align: left; border-bottom: 1px solid #000000; border-top: 1px solid #000000">Topik : '.$tema.'</td>
			          <td width="10%" style="text-align: center; border-bottom: 1px solid #000000; border-top: 1px solid #000000;  border-left: 1px solid #000000;  border-right: 1px solid #000000;">Mulai Berkembang</td>
			          <td width="10%" style="text-align: center; border-bottom: 1px solid #000000; border-top: 1px solid #000000;  border-right: 1px solid #000000;">Sedang Berkembang</td>
			          <td width="10%" style="text-align: center; border-bottom: 1px solid #000000; border-top: 1px solid #000000;  border-right: 1px solid #000000;">Berkembang Sesuai Harapan</td>
			          <td width="10%" style="text-align: center; border-bottom: 1px solid #000000; border-top: 1px solid #000000;  border-right: 1px solid #000000;">Sangat Berkembang</td>
			        </tr>';

		##get dimensi
		$id_elemen = "";
		$rowsdimensi = 0;
		//$sqldimensi = $select->list_raport_p5_dimensi('', '', '', '', '', $idsiswa, $syscode);
		$sqldimensi = $select->list_raport_p5_dimensi('', '', '', '', '', $idsiswa, $syscode, $datatema->replid);
		while($datadimensi = $sqldimensi->fetch(PDO::FETCH_OBJ)) {
			$rowsdimensi = $sqldimensi->rowCount();
			if($id_elemen == "" || $id_elemen == 1 || $id_elemen == 2 || $id_elemen == 3) {
					$id_elemen = $datadimensi->iddesk;
			}

			$dimensi = $datadimensi->dimensi;
			$output .= '<tr style="font-weight: bold">
							<td colspan="6" style="text-align: left; background-color: #f2f1ef; border-bottom: 1px solid #000000; border-top: 1px solid #000000; height: 30px">'.$dimensi.'</td>
		        </tr>';

		  //$sql3=$select->list_raport_p5_elemen('', $datadimensi->replid, $idsiswa, $syscode); 
		  $sql3=$select->list_raport_p5_elemen('', $datadimensi->dimensi_id, $idsiswa, $syscode, $datatema->replid);
			while($row_elemen=$sql3->fetch(PDO::FETCH_OBJ)) {	
					$elemen = $row_elemen->elemen;
					$output .= '<tr style="font-weight: bold">
							<td>:></td>
							<td colspan="5" style="text-align: left; border-bottom: 1px solid #000000; border-top: 1px solid #000000; height: 30px">'.$elemen.'</td>
		        </tr>';

					//$sqlsubdimensi=$select->list_raport_p5_subelemen('', $row_elemen->replid, $idsiswa, $syscode); 
					$sqlsubdimensi=$select->list_raport_p5_subelemen('', $row_elemen->replid, $idsiswa, $syscode, $datatema->replid);
					while($datasub_dimensi = $sqlsubdimensi->fetch(PDO::FETCH_OBJ)) {
						$deskripsi = $datasub_dimensi->deskripsi;

						$mulai 		=	"";
						$sedang 	=	"";
						$sesuai 	=	"";
						$sangat 	=	"";
						if($datasub_dimensi->mulai == 1) { $mulai = '<img src="../assets/img/checked.png" height="18">'; }
						if($datasub_dimensi->sedang == 2) { $sedang = '<img src="../assets/img/checked.png" height="18">'; }
						if($datasub_dimensi->sesuai == 3) { $sesuai = '<img src="../assets/img/checked.png" height="18">'; }
						if($datasub_dimensi->sangat == 4) { $sangat = '<img src="../assets/img/checked.png" height="18">'; }
						
						$output .= '<tr><td valign="top">*</td>
								<td width="60%" style="text-align: left; border-bottom: 1px solid #000000;">'.$deskripsi.'</td>
			          <td width="10%" style="text-align: center; border-bottom: 1px solid #000000; border-left: 1px solid #000000;">'.$mulai.'</td>
			          <td width="10%" style="text-align: center; border-bottom: 1px solid #000000; border-left: 1px solid #000000;">'.$sedang.'</td>
			          <td width="10%" style="text-align: center; border-bottom: 1px solid #000000; border-left: 1px solid #000000;">'.$sesuai.'</td>
			          <td width="10%" style="text-align: center; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">'.$sangat.'</td>
		          </tr>';

		##get dimensi
				/*$sqldimensi = $select->list_deskripsi_raport_p5_dimensi($idtema);
				while($datadimensi = $sqldimensi->fetch(PDO::FETCH_OBJ)) {
						$dimensi = $datadimensi->dimensi;
						$output .= '<tr style="font-weight: bold">
										<td colspan="6" style="text-align: left; background-color: #f2f1ef; border-bottom: 1px solid #000000; border-top: 1px solid #000000; height: 30px">'.$dimensi.'</td>
					        </tr>';

					   $sqlsubdimensi = $select->list_raport_p5_nilai('', $idtema, $idtingkat, $idkelas, $idtahunajaran, $idsemester, $idsiswa, $datadimensi->replid, $raport_line);

							while($datasub_dimensi = $sqlsubdimensi->fetch(PDO::FETCH_OBJ)) {
									$deskripsi = $datasub_dimensi->deskripsi;

									$mulai 		=	"";
									$sedang 	=	"";
									$sesuai 	=	"";
									$sangat 	=	"";
									if($datasub_dimensi->mulai == 1) { $mulai = '<img src="../assets/img/checked.png" height="18">'; }
									if($datasub_dimensi->sedang == 2) { $sedang = '<img src="../assets/img/checked.png" height="18">'; }
									if($datasub_dimensi->sesuai == 3) { $sesuai = '<img src="../assets/img/checked.png" height="18">'; }
									if($datasub_dimensi->sangat == 4) { $sangat = '<img src="../assets/img/checked.png" height="18">'; }
									
									$output .= '<tr><td valign="top">*</td>
											<td width="60%" style="text-align: left; border-bottom: 1px solid #000000;">'.$deskripsi.'</td>
						          <td width="10%" style="text-align: center; border-bottom: 1px solid #000000; border-left: 1px solid #000000;">'.$mulai.'</td>
						          <td width="10%" style="text-align: center; border-bottom: 1px solid #000000; border-left: 1px solid #000000;">'.$sedang.'</td>
						          <td width="10%" style="text-align: center; border-bottom: 1px solid #000000; border-left: 1px solid #000000;">'.$sesuai.'</td>
						          <td width="10%" style="text-align: center; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">'.$sangat.'</td>
					          </tr>';
							}
				}*/

				}

			}
		}

		$output .= '</table>';

		##get catatan (ambil salah satu dr subdimensi yg telah dipilih)
		$sql=$select->list_raport_p5_subelemen($rangkuman_proses_id); 
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$rangkuman_proses_id = $data->subelemen_id;
		$sqlsub = $select->get_catatan_proses_raport_p5($rangkuman_proses_id);
		$datasub = $sqlsub->fetch(PDO::FETCH_OBJ);
		$subdimensi_deskripsi = $datasub->deskripsi;

		if(($rowsdimensi == 2 && $id_elemen == 4) || ($rowsdimensi == 2 && $id_elemen == 3) || ($rowsdimensi == 2 && $id_elemen == 5) ) {

				if( $syscode == '328317547') {
				$output .= '<table border="0" width="100%" style="text-align: center; font-size: 12px; margin-top: 10px">
			        <tr style="font-weight: bold; font-size: 14px">
			          <td style="text-align: left;"><i>Catatan Proses</i></td>
			        </tr>
			        <tr style="font-size: 12px">
			          <td style="text-align: left;"><i>Dalam mengerjakan projek ini, '.$nama_siswa.' '.$subdimensi_deskripsi.'</i></td>
			        </tr>';
				$output .= '</table>';
			} else if( $rowsdimensi == 2 && $id_elemen == 4 ) {
				$output .= '<table border="0" width="100%" style="text-align: center; font-size: 12px; margin-top: 10px">
			        <tr style="font-weight: bold; font-size: 14px">
			          <td style="text-align: left;"><i>Catatan Proses</i></td>
			        </tr>
			        <tr style="font-size: 12px">
			          <td style="text-align: left;"><i>Dalam mengerjakan projek ini, '.$nama_siswa.' '.$subdimensi_deskripsi.'</i></td>
			        </tr>';
				$output .= '</table>';	
			} else {
				$output .= '<table border="0" width="100%" class="page_break" style="text-align: center; font-size: 12px; margin-top: 10px">
		        <tr style="font-weight: bold; font-size: 14px">
		          <td style="text-align: left;"><i>Catatan Proses</i></td>
		        </tr>
		        <tr style="font-size: 12px">
		          <td style="text-align: left;"><i>Dalam mengerjakan projek ini, '.$nama_siswa.' '.$subdimensi_deskripsi.'</i></td>
		        </tr>';
		     $output .= '</table>';
		   }
		} else if(($rowsdimensi == 2 && $id_elemen == 6) ) {

				if($syscode == "758917212") {
						$output .= '<table border="0" width="100%" class="page_break" style="text-align: center; font-size: 12px; margin-top: 10px">
							        <tr style="font-weight: bold; font-size: 14px">
							          <td style="text-align: left;"><i>Catatan Proses</i></td>
							        </tr>
							        <tr style="font-size: 12px">
							          <td style="text-align: left;"><i>Dalam mengerjakan projek ini, '.$nama_siswa.' '.$subdimensi_deskripsi.'</i></td>
							        </tr>';
							$output .= '</table>';
				} else {
						$output .= '<table border="0" width="100%" style="text-align: center; font-size: 12px; margin-top: 10px">
							        <tr style="font-weight: bold; font-size: 14px">
							          <td style="text-align: left;"><i>Catatan Proses</i></td>
							        </tr>
							        <tr style="font-size: 12px">
							          <td style="text-align: left;"><i>Dalam mengerjakan projek ini, '.$nama_siswa.' '.$subdimensi_deskripsi.'</i></td>
							        </tr>';
							$output .= '</table>';
				}
		} else if( ($rowsdimensi == 2 && $id_elemen == 2) || ($rowsdimensi == 5 && $id_elemen == 4) ) {

				$output .= '<table border="0" width="100%" class="page_break" style="text-align: center; font-size: 12px; margin-top: 10px">
					        <tr style="font-weight: bold; font-size: 14px">
					          <td style="text-align: left;"><i>Catatan Proses</i></td>
					        </tr>
					        <tr style="font-size: 12px">
					          <td style="text-align: left;"><i>Dalam mengerjakan projek ini, '.$nama_siswa.' '.$subdimensi_deskripsi.'</i></td>
					        </tr>';
					$output .= '</table>';
		} else if( ($rowsdimensi == 4 && $id_elemen == 6) ) {

					$output .= '<table border="0" width="100%" style="text-align: center; font-size: 12px; margin-top: 10px">
						        <tr style="font-weight: bold; font-size: 14px">
						          <td style="text-align: left;"><i>Catatan Proses</i></td>
						        </tr>
						        <tr style="font-size: 12px">
						          <td style="text-align: left;"><i>Dalam mengerjakan projek ini, '.$nama_siswa.' '.$subdimensi_deskripsi.'</i></td>
						        </tr>';
						$output .= '</table>';
		} else if( ($rowsdimensi == 3 && $id_elemen == 4) ) {

				$output .= '<table border="0" width="100%" class="page_break" style="text-align: center; font-size: 12px; margin-top: 10px">
					        <tr style="font-weight: bold; font-size: 14px">
					          <td style="text-align: left;"><i>Catatan Proses</i></td>
					        </tr>
					        <tr style="font-size: 12px">
					          <td style="text-align: left;"><i>Dalam mengerjakan projek ini, '.$nama_siswa.' '.$subdimensi_deskripsi.'</i></td>
					        </tr>';
					$output .= '</table>';
		} else if( ($rowsdimensi == 3 && $id_elemen == 5) ) {
				//if($syscode == "085468738" || $syscode == "440823706" || $syscode == "273849800") {
						$output .= '<table border="0" width="100%" style="text-align: center; font-size: 12px; margin-top: 10px">
						        <tr style="font-weight: bold; font-size: 14px">
						          <td style="text-align: left;"><i>Catatan Proses</i></td>
						        </tr>
						        <tr style="font-size: 12px">
						          <td style="text-align: left;"><i>Dalam mengerjakan projek ini, '.$nama_siswa.' '.$subdimensi_deskripsi.'</i></td>
						        </tr>';
						$output .= '</table>';
				/*} else {
						$output .= '<table border="0" width="100%" class="page_break" style="text-align: center; font-size: 12px; margin-top: 10px">
					        <tr style="font-weight: bold; font-size: 14px">
					          <td style="text-align: left;"><i>Catatan Proses</i></td>
					        </tr>
					        <tr style="font-size: 12px">
					          <td style="text-align: left;"><i>Dalam mengerjakan projek ini, '.$nama_siswa.' '.$subdimensi_deskripsi.'</i></td>
					        </tr>';
						$output .= '</table>';
				}*/
		} else if($id_elemen == 3 || $id_elemen == 4 || $id_elemen == 5 || $rowsdimensi == 1 || ($rowsdimensi == 2 && $id_elemen == 2)) {
			$output .= '<table border="0" width="100%" style="text-align: center; font-size: 12px; margin-top: 10px">
				        <tr style="font-weight: bold; font-size: 14px">
				          <td style="text-align: left;"><i>Catatan Proses</i></td>
				        </tr>
				        <tr style="font-size: 12px">
				          <td style="text-align: left;"><i>Dalam mengerjakan projek ini, '.$nama_siswa.' '.$subdimensi_deskripsi.'</i></td>
				        </tr>';
			$output .= '</table>';
		} else {
			$output .= '<table border="0" width="100%" class="page_break"  style="text-align: center; font-size: 12px; margin-top: 10px">
				        <tr style="font-weight: bold; font-size: 14px">
				          <td style="text-align: left;"><i>Catatan Proses</i></td>
				        </tr>
				        <tr style="font-size: 12px">
				          <td style="text-align: left;"><i>Dalam mengerjakan projek ini, '.$nama_siswa.' '.$subdimensi_deskripsi.'</i></td>
				        </tr>';
			$output .= '</table>';
	}

		$output .= '<table border="0" width="100%" style="text-align: center; font-size: 12px;">
			        <tr style="font-weight: bold">
			          <td style="text-align: center; height: 1px"><hr></td>
			        </tr>';
		$output .= '</table>';

		//$total_baris = $total_baris + 3;

		//$sql_wali 	= $selectview->list_kelas($idkelas_wali, ""); //$idkelas1
		$sql_wali 	= $selectview->list_kelas_detail($idkelas_wali, $idtahunajaran, $idsemester); //$idkelas1
		$data_wali	= $sql_wali->fetch(PDO::FETCH_OBJ);
		$nip_wali	= $data_wali->nip_wali;
		$nama_wali	= $data_wali->walikelas;
		$ttd_file_wali	= $data_wali->ttd_file;

		$tgl 	= date("d-m-Y", strtotime($tanggal_ttd)); //date("Y-m-d"); //14-12-2018";
		$tnggal	= tglindonesia($tgl, $hasil);

		$nip_wali__ = "";
		if(strlen($nip_wali) >= 16) {
				$nip_wali__ = 'NIP '.$nip_wali;
		}


		$output .= '<table border="0" width="100%" style="text-align: center; font-size: 12px; margin-top: 10px">
		        <tr>
		          <td colspan="1" width="33%" style="text-align: center;">Mengetahui,<br>Orang Tua/Wali</td>
		          <td colspan="1" width="33%" style="text-align: center;" valign="top">Pembimbing Akademik</td>
		          <td colspan="1" width="33%" style="text-align: center;">Jakarta, '.$tnggal.'<br>Kepala Sekolah'.'</td>
		        </tr>';
		$output .= '</table>';
		$output .= '<table border="0" width="100%" style="text-align: center; font-size: 12px; padding-top: 30px">
		        <tr>
		          <td colspan="1" width="33%" style="text-align: center;"></td>
		          <td colspan="1" width="33%" style="text-align: center;">'.$nama_wali.'</td>
		          <td colspan="1" width="33%" style="text-align: center;">'.$nama_kepsek.'</td>
		        </tr>
		        <tr>
		          <td colspan="1" width="33%" style="text-align: center;">................................</td>
		          <td colspan="1" width="33%" style="text-align: center;">'.$nip_wali__.'</td>
		          <td colspan="1" width="33%" style="text-align: center;">NIP '.$nip_kepsek.'</td>
		        </tr>';
		$output .= '</table>';
		//$output .= '</div>';

		$m_page++;
}

//echo $output;
$document->loadHtml($output);

//set page size and orientation
//$customPaper = array(0,0,450,$print_height); //1360
  //$dompdf->set_paper($customPaper);
//$document->setPaper($customPaper, 'portrait');
$document->setPaper('F4', 'landscape');

//Render the HTML as PDF

$document->render();

//Get output of generated pdf in Browser

$document->stream("Rapor_P5_Kelompok", array("Attachment"=>0));
//1  = Download
//0 = Preview

?>

