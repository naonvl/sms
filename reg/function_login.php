<?php

function Login(){
	$dbpdo = DB::create();
	
	$username=$_POST['username'];
	$_SESSION['bahasa'] = 0; //1;
	    
	if($username) {
	  $sql_cek = "select nik from calonsiswa where nik='$username' and aktif=1";
	  $hasil_cek = $dbpdo->query($sql_cek);
	  $data_cek = $hasil_cek->fetch(PDO::FETCH_OBJ);
	 
	  if (!empty($data_cek->nik)) {	  	  		
		  $sql = "select replid, nik from calonsiswa where nik='$username' and aktif=1"; 
		  $r = $dbpdo->query($sql);
		  $rr = $r->fetch(PDO::FETCH_OBJ);
		  		  
		  if($rr->nik != ""){
				//@mysql_close($conn);
				
				$sql="select a.replid, a.departemen, a.nopendaftaran, a.tanggal, a.idkelompok, a.foto_file, a.nik, a.nama, a.token from calonsiswa a where a.nik='$username' and a.aktif=1";
				$password_r = $dbpdo->query($sql);
				$password_d = $password_r->fetch(PDO::FETCH_OBJ);
				
				$_SESSION["nama"]=$password_d->nama; // ." ". $password['sname'];
				$_SESSION["nik"]=$password_d->nik;
				$_SESSION["token"]=$password_d->token;
				$_SESSION["foto_file"]=$password_d->foto_file;
				$_SESSION["departemen"]=$password_d->departemen;
				
				$_SESSION["loggedreg"]=1;
											
				?>	
					<meta http-equiv="Refresh" content="0;url=<?php echo 'http://158.140.190.252/sims/reg/registrasi' ?>" />
				
				<?php	
					exit;
					
		  }else{
				$passed = new PDO("mysql:host=$host;dbname=$mydb, $userdb, $passdb");													
		  }
			
			//@mysql_select_db(DB);
			if (!$passed) {		
			
				echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">NIK belum benar</font></center>";
				
				$_SESSION["loggedreg"]=0;
				$_SESSION["useridreg"]="";
											
			}else{
				$sql="select a.replid, a.departemen, a.nopendaftaran, a.tanggal, a.idkelompok, a.foto_file, a.nik, a.nama, a.token from calonsiswa a where a.nik='$username' and a.aktif=1";
				$password_r=$dbpdo->query($sql);
				$password_d=$password_r->fetch(PDO::FETCH_OBJ);
				
				$_SESSION["nama"]=$password_d->nama; // ." ". $password['sname'];
				$_SESSION["nik"]=$password_d->nik;
				$_SESSION["token"]=$password_d->token;
				$_SESSION["foto_file"]=$password_d->foto_file;
				$_SESSION["departemen"]=$password_d->departemen;
				
				$_SESSION["loggedreg"]=1;
		?>

				<meta http-equiv="Refresh" content="0;url=<?php echo 'http://158.140.190.252/sims/reg/registrasi' ?>" />
		<?php		
			}
		} else {
			echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">NIK belum benar !!!</font></center>";     
			$_SESSION["logged"]=0;
			$_SESSION["userid"]="";
		}
		
	}else{
		echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">Masukkan NIK</font></center>";
		$_SESSION["logged"]=0;
	}
	
	if($msg) echo $msg; 
}
?>