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
            header("Content-Disposition: attachment; filename=Laporan Presensi Harian Siswa.xls");

            include_once ("include/queryfunctions.php");
            include_once ("include/functions.php");

            include 'class/class.selectview.php';
            $selectview = new selectview;
            
            $departemen = $_POST['departemen']; 
            $daritgl    = $_POST['daritgl'];
            $ketgl      = $_POST['ketgl'];
            $idtingkat  = $_POST['idtingkat'];
            $idkelas    = $_POST['idkelas'];
            $nama       = $_POST['nama'];
            $all        = $_POST['all'];

        ?>

        <table border="1" id="dynamic-table" class="table table-striped table-bordered table-hover">
            <tr>
                <th class="center" colspan="12" style="font-weight:bold ">LAP. PRESENSI HARIAN SISWA</th>
            </tr>
            <thead>
                <tr>
                    <th class="center" style="font-weight:bold ">No.</th>
                    <th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
                    <th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
                    <th style="font-weight:bold ">Level-Kelas &nbsp;&nbsp;</th>
                    <th style="font-weight:bold ">Datang &nbsp;&nbsp;</th>
                    <th style="font-weight:bold ">Pulang &nbsp;&nbsp;</th>
                    <th style="font-weight:bold ">Hadir &nbsp;&nbsp;</th>
                    <th style="font-weight:bold ">Ijin &nbsp;&nbsp;</th>
                    <th style="font-weight:bold ">Sakit &nbsp;&nbsp;</th>
                    <th style="font-weight:bold ">Alpa &nbsp;&nbsp;</th>
                    <th style="font-weight:bold ">Terlambat &nbsp;&nbsp;</th>
                    <th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                <?php           
                    $dbpdo = DB::create();

                    $i = 0;
                    $total = 0;                                                 
                    $sql=$selectview->rpt_presensi_harian_siswa_2($daritgl, $ketgl, $nis, $idkelas, $idtingkat, $nama, $departemen, $departemen_sekolah_id);    
                    while ($rpt_presensi_harian_siswa_view=$sql->fetch(PDO::FETCH_OBJ)) {
                        
                        $i++;
                        
                        $kelas = $rpt_presensi_harian_siswa_view->tingkat . ' - ' . $rpt_presensi_harian_siswa_view->kelas;

                        // get setup presensi
                        $sqlstr = "select replid, jam_masuk, jam_pulang_cepat, jam_pulang from presensiharian_setup where departemen='$rpt_presensi_harian_siswa_view->departemen' and departemen_sekolah_id='$rpt_presensi_harian_siswa_view->departemen_sekolah_id' order by replid desc limit 1 ";
                        $sqlx=$dbpdo->prepare($sqlstr);
                        $sqlx->execute();
                        $rowssetup=$sqlx->rowCount();
                        $time_in = date('H:i', strtotime($datasetup->jam_masuk)); //lebih besar > 06:30 dianggap terlambat
                        $time_mid = date('H:i', strtotime($datasetup->jam_pulang_cepat));
                        $time_out = date('H:i', strtotime($datasetup->jam_pulang));

                        $bg = "";
                        $terlambat = 0;
                        $min_terlambat = $time_in; //date("H:i", strtotime("06:30"));
                        $max_terlambat = $time_out; //date("H:i", strtotime("14:00"));
                        if(date('H:i', strtotime($rpt_presensi_harian_siswa_view->ts)) > $min_terlambat && date('H:i', strtotime($rpt_presensi_harian_siswa_view->ts)) < $max_terlambat) {
                            $terlambat = 1;
                            $bg = "background-color: red; color: yellow; font-weight: bold";
                        }

                        //rpt_presensi_harian_siswa_view->cuti;

                        if($rpt_presensi_harian_siswa_view->ijin > 0 || $rpt_presensi_harian_siswa_view->sakit > 0 || $rpt_presensi_harian_siswa_view->alpa > 0) {
                            $terlambat = 0;
                        }

                        // get jam pulang
                        $sqlcekphs  = "select ts from phsiswa where nis='$rpt_presensi_harian_siswa_view->nis' and idpresensi='$rpt_presensi_harian_siswa_view->id' and departemen='$rpt_presensi_harian_siswa_view->departemen' and departemen_sekolah_id='$rpt_presensi_harian_siswa_view->departemen_sekolah_id' and info1='pulang' order by ts desc limit 1 ";
                        $sql5=$dbpdo->prepare($sqlcekphs);
                        $sql5->execute();
                        $data5=$sql5->fetch(PDO::FETCH_OBJ);
                        $jam_pulang = date("d-m-Y H:i", strtotime($data5->ts));
                        if($jam_pulang == "01-01-1970 07:00") {
                            $jam_pulang = "";
                        }  
                ?>
                            
                        <tr>
                            <td><?php echo $i ?></td> 
                            <td><?php echo $rpt_presensi_harian_siswa_view->nis ?></td>
                            <td><?php echo $rpt_presensi_harian_siswa_view->nama ?></td>
                            <td><?php echo $kelas ?></td>
                            <td><?php echo date('d-m-Y', strtotime($rpt_presensi_harian_siswa_view->tanggal1)).' '.date('H:i', strtotime($rpt_presensi_harian_siswa_view->ts)); ?></td>
                            <td><?= $jam_pulang ?></td>
                            <td align="center"><?php echo $rpt_presensi_harian_siswa_view->hadir ?></td>
                            <td align="center"><?php echo $rpt_presensi_harian_siswa_view->ijin ?></td>
                            <td align="center"><?php echo $rpt_presensi_harian_siswa_view->sakit ?></td>
                            <td><?php echo $rpt_presensi_harian_siswa_view->alpa ?></td>
                            <td align="center" style="<?= $bg ?>"><?php echo $terlambat ?></td>
                            <td><?php echo $rpt_presensi_harian_siswa_view->keterangan ?></td>
                        </tr>
                    
                    <?php
                        }
                    ?>
                                    
            </tbody>
        </table>
    </body>
</html>