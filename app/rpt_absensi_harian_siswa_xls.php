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
            header("Content-Disposition: attachment; filename=Laporan Absensi Harian Siswa.xls");

            include_once ("include/queryfunctions.php");
            include_once ("include/functions.php");

            include 'class/class.selectview.php';
            $selectview = new selectview;
            
            $departemen = $_GET['departemen']; 
            $daritgl    = $_GET['daritgl'];
            $ketgl      = $_GET['ketgl'];
            $idtingkat  = $_GET['idtingkat'];
            $idkelas    = $_GET['idkelas'];
            $nama       = $_GET['nama'];
            $all        = $_GET['all'];

        ?>

        <table border="1" id="dynamic-table" class="table table-striped table-bordered table-hover">
            <tr>
                <th class="center" colspan="6" style="font-weight:bold ">LAP. ABSENSI HARIAN SISWA</th>
            </tr>
            <thead>
                <tr>
                    <th class="center" style="font-weight:bold ">No.</th>
                    <th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
                    <th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
                    <th style="font-weight:bold ">Level-Kelas &nbsp;&nbsp;</th>
                    <th style="font-weight:bold ">Tanggal &nbsp;&nbsp;</th>
                    <th style="font-weight:bold ">Jenis Absensi &nbsp;&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                <?php           
                    $i = 0;
                    $total = 0;                                                 
                    $sql=$selectview->rpt_absensi_harian_siswa($daritgl, $ketgl, $nis, $idkelas, $idtingkat, $nama, $departemen);                                               
                    while ($rpt_presensi_harian_siswa_view=$sql->fetch(PDO::FETCH_OBJ)) {
                        
                        $i++;
                        
                        $kelas = $rpt_presensi_harian_siswa_view->tingkat . ' - ' . $rpt_presensi_harian_siswa_view->kelas;         

                        $absen = "";
                        if($rpt_presensi_harian_siswa_view->ijin == 1) {
                            $absen = "Izin";
                        }
                        if($rpt_presensi_harian_siswa_view->sakit == 1) {
                            $absen = "Sakit";
                        }
                        if($rpt_presensi_harian_siswa_view->alpa == 1) {
                            $absen = "Alpa";
                        }   
                        if($rpt_presensi_harian_siswa_view->cuti == 1) {
                            $absen = "Cuti";
                        }                   
                ?>
                            
                        <tr>
                            <td><?php echo $i ?></td> 
                            <td><?php echo $rpt_presensi_harian_siswa_view->nis ?></td>
                            <td><?php echo $rpt_presensi_harian_siswa_view->nama ?></td>
                            <td><?php echo $kelas ?></td>
                            <td><?php echo date('d-m-Y', strtotime($rpt_presensi_harian_siswa_view->tanggal1)).' '.date('H:i', strtotime($rpt_presensi_harian_siswa_view->ts)); ?></td>
                            <td><?php echo $absen ?></td>
                                        
                        </tr>
                    
                    <?php
                        }
                    ?>
                    
            </tbody>
        </table>
    </body>
</html>