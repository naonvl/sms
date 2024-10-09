<?php
    // cek_notifikasi.php
    header('Content-Type: application/json');

    include_once ("include/queryfunctions.php");
    include_once ("include/functions.php");

    $dbpdo = DB::create();

    date_default_timezone_set('Asia/Jakarta');

    // Query untuk mengambil notifikasi baru
    $date_now = date('Y-m-d');
    $sqlstr = "select a.nis, a.ts, b.nama, a.keterangan, a.info3, c.nama nama_sekolah from phsiswa a left join siswa b on a.nis=b.nis left join departemen_sekolah c on a.departemen_sekolah_id=c.replid where date_format(a.ts,'%Y-%m-%d')='$date_now' and ifnull(a.info2,'')='' order by a.ts limit 1";
    $sql=$dbpdo->prepare($sqlstr);
    $sql->execute();
    $num_rows = $sql->rowCount();

    $notifikasi = array();

    if ($num_rows > 0) {
        while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $notifikasi[] = $row;

            //update data terkirim
            $nis            =   $row['nis'];
            $dlu            =   $row['ts'];
            $sukses_absen   =   $row['info3']; //keterangan
            $nama_sekolah   =   $row['nama_sekolah'];
            if($sukses_absen == "") {
                $sukses_absen = "ABSENSI BERHASIL";
            }

            if($nama_sekolah == "") {
                $nama_sekolah = "YAYASAN PERMATA SARI";
            }
            
            kirim_wa($nis, $dlu, $nama_sekolah, $sukses_absen);          

            //update sent wa
            $sqlstr = "update phsiswa set info2='sentwa' where date_format(ts,'%Y-%m-%d')='$date_now' and nis='$nis' and ifnull(info2,'')='' and ts='$dlu'";
            $sql1=$dbpdo->prepare($sqlstr);
            $sql1->execute();
        }
    }

    // Mengirimkan hasil notifikasi sebagai JSON
    echo json_encode($notifikasi);


    function kirim_wa($nisn, $jam, $namasekolah, $sukses_absen) {
        $dbpdo = DB::create();

        $keterangan = "";
        if($sukses_absen == "ABSENSI BERHASIL") {
            $keterangan = "*Tiba* di sekolah";
        }
        if($sukses_absen == "TERLAMBAT") {
            $keterangan = "*Terlambat Tiba* di sekolah";
        }
        if($sukses_absen == "PULANG CEPAT") {
            $keterangan = "*Pulang Cepat*";
        }
        if($sukses_absen == "ABSENSI PULANG BERHASIL") {
            $keterangan = "*Pulang* dari sekolah";
        }

        //----------/\-----------
        $sender = getapi_nomor_wa();

        $sqlcek     =   "select hportu phone, nama from siswa where (nisn='$nisn' or nis='$nisn')"; 
        $resultcek1=$dbpdo->prepare($sqlcek);
        $resultcek1->execute();
        $data_epy1      = $resultcek1->fetch(PDO::FETCH_OBJ);
        $phone          = $data_epy1->phone;
        $nama           = strtoupper($data_epy1->nama);
        ##----phone----------
        if($phone != "") {
            $phone_check_nol = substr($phone,0,1);
            if($phone_check_nol == 8) {
                $phone      =   '62'.$phone;
            }
            if($phone_check_nol == 0) {
                $phone_len  =   strlen($phone);
                $phone      =   substr($phone,1, $phone_len-1);
                $phone      =   '62'.$phone;
            }
            if(substr($phone,0,3) == '+62') {
                $phone_len  =   strlen($phone);
                $phone      =   substr($phone,3, $phone_len-3);
                $phone      =   '62'.$phone;
            }
            if(substr($phone,0,2) == '62') {
                //$phone_len    =   strlen($phone);
                //$phone        =   substr($phone,3, $phone_len-3);
                $phone      =   $phone;
            }
            ##-----/\-------

            $survey_date = date('d-m-Y', strtotime($survey_date));
            if($survey_date == "01-01-1970") {
                $survey_date = "";
            }
            
            $message = '*'.$namasekolah.'*'.

    $message_wa.


    '
Assalamualaikum Warohmatullaahi Wabarokaatuh'.
    '
Anak Bapak/Ibu '. $nama.
    ' '.
    $keterangan .' pada pukul '.$jam;
            if($keterangan != "") {

                if($sukses_absen == "TERLAMBAT") {
                    $message = $message.

                    '

Note :'.
                    '
Mohon untuk menjadi perhatian ayah dan bunda';
                }
                //echo $message;
                send_whatsapp_api($phone, $message, $sender);
            }
        }
    }
?>