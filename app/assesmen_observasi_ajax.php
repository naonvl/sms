<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

include '../app/class/class.select.php';
$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "gettingkat":
		$departemen = $_POST["departemen"];	
			
?>		
		<!-- <option value=""></option>
		<php select_tingkat_unit($departemen, ""); ?> -->

		<select name="idtingkat" id="idtingkat" class="chosen-select form-control" onchange="loadHTMLPost2('app/assesmen_observasi_ajax.php','kelas_id','getkelas','idtingkat')" />
			<option value="">...</option>
			<?php select_tingkat_unit($departemen, ""); ?>
		</select>
		

<?php	
		break;
		
	case "getkelas":
		$idtingkat = $_POST["idtingkat"];	
			
?>		
		<!-- <option value=""></option>
		<php select_kelas($idtingkat, ""); ?> -->
		
		<select name="idkelas" id="idkelas" class="chosen-select form-control" onClick="loadHTMLPost2('app/assesmen_observasi_ajax.php','siswa_id1','getsiswa','idkelas')" />
			<option value="">...</option>
			<?php select_kelas($idtingkat, $assesmen_observasi_data->idkelas); ?>
		</select>

<?php	
		break;
	
	case "getsiswa":
		$idkelas = $_POST["idkelas"];	
			
?>		
		<!-- <option value=""></option>
		<php select_siswa($idkelas, ""); ?> -->
		
		<select name="idsiswa" id="idsiswa" class="chosen-select form-control" onchange="loadHTMLPost2('app/assesmen_observasi_ajax.php','siswa_id','getdatasiswa','idsiswa')" />
			<option value="">...</option>
			<?php select_siswa($idkelas, ""); ?>
		</select>

<?php	

		break;
		
	case "getdatasiswa":
		$idsiswa = $_POST["idsiswa"];	
		
		$sql = $select->list_siswa('',$idsiswa);		
		$assesmen_observasi_data = $sql->fetch(PDO::FETCH_OBJ);	
?>		
		<table border="0" width="100%" cellpadding="5">
			<tr>
				<td width="20%">Nama Panggilan</td>
				<td>&nbsp;&nbsp;</td>
				<td>:</td>
				<td width="30%"><?php echo $assesmen_observasi_data->panggilan ?></td>
				
				<td>&nbsp;&nbsp;</td>
				
				<td width="20%">Tempat, Tanggal Lahir</td>
				<td>&nbsp;&nbsp;</td>
				<td>:</td>
				<td width="30%">
					<?php echo $assesmen_observasi_data->tmplahir ?>, <?php echo $assesmen_observasi_data->tgllahir ?>
				</td>											
			</tr>
				
			<tr>
				<td>Alamat</td>
				<td>&nbsp;&nbsp;</td>
				<td>:</td>
				<td><?php echo $assesmen_observasi_data->alamatsiswa ?></td>
				
				<td>&nbsp;&nbsp;</td>
				
				<td>Anak ke-</td>
				<td>&nbsp;&nbsp;</td>
				<td>:</td>
				<td><?php echo $assesmen_observasi_data->anakke ?></td>											
			</tr>
			
			<tr>
				<td>Nama Ayah</td>
				<td>&nbsp;&nbsp;</td>
				<td>:</td>
				<td><?php echo $assesmen_observasi_data->namaayah ?></td>
				
				<td>&nbsp;&nbsp;</td>
				
				<td>Pekerjaan Ayah</td>
				<td>&nbsp;&nbsp;</td>
				<td>:</td>
				<td><?php echo $assesmen_observasi_data->pekerjaan_ayah ?></td>											
			</tr>
			
			<tr>
				<td>Nama Ibu</td>
				<td>&nbsp;&nbsp;</td>
				<td>:</td>
				<td><?php echo $assesmen_observasi_data->namaibu ?></td>
				
				<td>&nbsp;&nbsp;</td>
				
				<td>Pekerjaan Ibu</td>
				<td>&nbsp;&nbsp;</td>
				<td>:</td>
				<td><?php echo $assesmen_observasi_data->pekerjaan_ibu ?></td>											
			</tr>
		</table>
		

<?php	

		break;
		
        				
	default:
	
}
?>