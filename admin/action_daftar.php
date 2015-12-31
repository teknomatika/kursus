<!DOCTYPE html>
<?php session_start();
include '../_db.php';
$db = new Database();
$db->connect();

if(isset($_POST['nama'])){
	$nama = $db->escapeString($_POST['nama']);
	$tanggal = $db->escapeString($_POST['tanggal']);
	$alamat = $db->escapeString($_POST['alamat']);
	$kodepos = $db->escapeString($_POST['kodepos']);
	$email = $db->escapeString($_POST['email']);
	$telp = $db->escapeString($_POST['telp']);
	$hp = $db->escapeString($_POST['hp']);
	$sekolah = $db->escapeString($_POST['sekolah']);
	$kelas = $db->escapeString($_POST['kelas']);
	$ortu = $db->escapeString($_POST['ortu']);
	$pekerjaan = $db->escapeString($_POST['pekerjaan']);
	$program = $db->escapeString($_POST['program']);
	$ptn1 = $db->escapeString($_POST['ptn1']);
	$ptn2 = $db->escapeString($_POST['ptn2']);
	$ptn3 = $db->escapeString($_POST['ptn3']);

	// generik kode
	 $uuid = id();
	 $nis = getnis($program);

	// upload foto
	$foto = $db->escapeString($_FILES['foto']['name']);
	$sumber = $_FILES['foto']['tmp_name'];
	$file_type = $_FILES['foto']['type'];
    $tipe = array("image/jpeg","image/png","image/gif");
        if(!in_array($file_type, $tipe)) eksyen('Improper File Type for Photo. Use JPEG/JPG/PNG/GIF only.','index.php');
    if(move_uploaded_file($sumber, "foto/siswa/$nis-$foto")){
    	$fotonya = "$nis-$foto";
    }else{
    	echo "<h3>Gagal Upload File</h3>";
    	$fotonya = "";
    }

	/* Tabel Siswa
	 id
	 nis
	 nama
	 tanggallahir
	 alamat
	 kodepos
	 email
	 tlp
	 hp
	 sekolah
	 kelas
	 namaortu
	 kerjaortu
	 foto
	 buat
	*/

	// insert into ptn
    $b = trim($ptn1);
    $b = explode(" ", $b);
    $kecil = "";
    foreach ($b as $b){
        $kecil .= strtolower($b);
    }
    $qi = mysql_query("select * from ptn where alias='$kecil'");
    $ci = mysql_num_rows($qi);
    if($ci==1){
        $di = mysql_fetch_array($qi);
        $idins1 = $di['id'];
    }else{
        mysql_query("insert into ptn values(uuid(),'$ptn1','$kecil','1')");
        $qi = mysql_query("select * from ptn where alias='$kecil'");
        $di = mysql_fetch_array($qi);
        $idins1 = $di['id'];
    }

	    	$b = trim($ptn2);
		    $b = explode(" ", $b);
		    $kecil = "";
		    foreach ($b as $b){
		        $kecil .= strtolower($b);
		    }
		    $qi = mysql_query("select * from ptn where alias='$kecil'");
		    $ci = mysql_num_rows($qi);
		    if($ci==1){
		        $di = mysql_fetch_array($qi);
		        $idins2 = $di['id'];
		    }else{
		        mysql_query("insert into ptn values(uuid(),'$ptn2','$kecil','1')");
		        $qi = mysql_query("select * from ptn where alias='$kecil'");
		        $di = mysql_fetch_array($qi);
		        $idins2 = $di['id'];
		    }

		    		$b = trim($ptn3);
				    $b = explode(" ", $b);
				    $kecil = "";
				    foreach ($b as $b){
				        $kecil .= strtolower($b);
				    }
				    $qi = mysql_query("select * from ptn where alias='$kecil'");
				    $ci = mysql_num_rows($qi);
				    if($ci==1){
				        $di = mysql_fetch_array($qi);
				        $idins3 = $di['id'];
				    }else{
				        mysql_query("insert into ptn values(uuid(),'$ptn3','$kecil','1')");
				        $qi = mysql_query("select * from ptn where alias='$kecil'");
				        $di = mysql_fetch_array($qi);
				        $idins3 = $di['id'];
				    }
  	// insert into siswa_ptn
   	mysql_query("insert into siswa_ptn values(uuid(),'$uuid','$idins1','1'),(uuid(),'$uuid','$idins2','2'),(uuid(),'$uuid','$idins3','3')");

	// insert into siswa
	$db->insert('siswa',array('id'=>$uuid,'nis'=>$nis,'nama'=>$nama,'tanggallahir'=>$tanggal,'alamat'=>$alamat,'kodepos'=>$kodepos,'email'=>$email,'tlp'=>$telp,'hp'=>$hp,'sekolah'=>$sekolah,'kelas'=>$kelas,'namaortu'=>$ortu,'kerjaortu'=>$pekerjaan,'foto'=>$fotonya,'buat'=>wkt()));
	$db->getResult();
	$db->insert('inkelas',array('id'=>id(),'idsiswa'=>$uuid,'idprogram'=>$program,'buat'=>wkt()));
	$db->getResult();
	eksyen('Pendaftaran Berhasil','index.php');
}
?>