<?php
session_start();
            
error_reporting(E_ALL & ~E_NOTICE);

if (($_SESSION["logged"] == 0)) {
  echo 'Access denied';
  exit;
}

include_once ("include/sambung.php");
include_once ("include/functions.php");

include 'class/class.select.php';

$select = new select;

$idsiswa  = $_REQUEST['idsiswa'];
$idtingkat  = $_REQUEST['idtingkat'];
$idkelas  = $_REQUEST['idkelas'];
$tanggal  = $_REQUEST['tanggal'];
$tanggal1 = $_REQUEST['tanggal1'];
$all    = $_REQUEST['all'];

$filter = "";
if($tanggal != "") {
    $filter = "Tanggal : ".date('d-m-Y', strtotime($tanggal));
}
if($tanggal1 != "") {
    $filter = $filter . " s/d Tanggal : ".date('d-m-Y', strtotime($tanggal1));
}
if($all == 1) {
    $filter = "Semua Data";
}

//get siswa
$filter1 = "";
if($idsiswa != "") {
  $sql = $select->list_siswa('', $idsiswa);
  $datasiswa = $sql->fetch(PDO::FETCH_OBJ);
  $filter1 = 'Nama : '.$datasiswa->nis.' '.$datasiswa->nama.'; '.$datasiswa->tingkat.' '.$datasiswa->kelas;
}

require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace

use Dompdf\Dompdf;

//initialize dompdf class

$document = new Dompdf();

$html = '
  <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
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

//$document->loadHtml($html);
//$page = file_get_contents("cat.html");

//$document->loadHtml($page);

$output = "
  <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #ffffff;
}
</style>
<table style='font-size: 12px'>
  <tr>
      <th colspan='5' style='font-weight:bold; text-align: center;'>DAFTAR BUKU KUNJUNGAN</th>
  </tr>
  <tr>
      <th colspan='5' style='text-align: left'>".$filter."</th>
  </tr>";

  if($filter1 != "") {
    $output.="<tr>
        <th colspan='5' style='text-align: left'>".$filter1."</th>
    </tr>";
  }

  $output.="<tr style='font-size: 12px'>
    <th class='center' style='font-weight:bold '>No.</th>
    <th style='font-weight:bold '>Nama Siswa &nbsp;&nbsp;</th>
    <th style='font-weight:bold '>Tingkat &nbsp;&nbsp;</th>
    <th style='font-weight:bold ' colspan='2'>Kelas &nbsp;&nbsp;</th>
  </tr>";

  $output.="<tr style='font-size: 12px'>
    <th class='center' style='font-weight:bold '></th>
    <th style='font-weight:bold '>Tanggal &nbsp;&nbsp;</th>
    <th style='font-weight:bold '>Jam &nbsp;&nbsp;</th>
    <th style='font-weight:bold '>Kesan dan Pesan &nbsp;&nbsp;</th>
  </tr>
";

$x = 0;
$sqlx=$select->get_kunjungan_perpustakaan("", $tanggal, $tanggal1, $idsiswa, $idtingkat, $kelas, $all);
while($siswa_view=$sqlx->fetch(PDO::FETCH_OBJ)){

    $x++;

    $output .= '
        <tr style="background-color: #a2ed86">
          <td>'.$x.'</td>
          <td>'.$siswa_view->nis . ' ' .$siswa_view->nama_siswa.'</td>
          <td>'.$siswa_view->tingkat.'</td>
          <td>'.$siswa_view->kelas.'</td>
        </tr>
      ';

    $i = 0;
    $sql=$select->list_kunjungan_perpustakaan("", $tanggal, $tanggal1, $siswa_view->idsiswa, "", "", $all);
    while($kunjungan_perpustakaan_view=$sql->fetch(PDO::FETCH_OBJ)){
        
      $i++;
      
      $output .= '
        <tr>
          <td></td>
          <td>'.date("d-m-Y", strtotime($kunjungan_perpustakaan_view->tanggal)).'</td>
          <td>'.date("H:i", strtotime($kunjungan_perpustakaan_view->jam)).'</td>
          <td>'.$kunjungan_perpustakaan_view->keterangan.'</td>
        </tr>
      ';
    }
}

$output .= '</table>';

//echo $output;

$document->loadHtml($output);

//set page size and orientation

$document->setPaper('A4', 'landscape');

//Render the HTML as PDF

$document->render();

//Get output of generated pdf in Browser

$document->stream("Webslesson", array("Attachment"=>0));
//1  = Download
//0 = Preview
?>

<!--<table>
  <tr>
    <td colspan="13" valign="top" style="text-align: center"></td>
  </tr>
</table>-->
