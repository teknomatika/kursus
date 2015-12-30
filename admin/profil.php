<h1 class="page-header">Profil Saya</h1>
<?php
$db->select('users','*',NULL,"id='".$_SESSION['userid']."'"); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
$d = $db->getResult();

if(isset($_POST['nama'])){
	echo "Processing...";
	$nama = mysql_real_escape_string($_POST['nama']);
	$alamat = mysql_real_escape_string($_POST['alamat']);
	$jk = mysql_real_escape_string($_POST['jk']);
	$jabatan = mysql_real_escape_string($_POST['jabatan']);
	$level = mysql_real_escape_string($_POST['level']);
	$username = mysql_real_escape_string($_POST['username']);
	$password = mysql_real_escape_string(md5($_POST['password']));
	$id = $_SESSION['userid'];

	if($_POST['password']==''){
		$db->update('users',array('nama'=>$nama,'alamat'=>$alamat,'jk'=>$jk,'jabatan'=>$jabatan,'level'=>$level,'username'=>$username,'ubah'=>wkt()),"id='$id'");
	}else{
		$db->update('users',array('nama'=>$nama,'alamat'=>$alamat,'jk'=>$jk,'jabatan'=>$jabatan,'level'=>$level,'username'=>$username,'password'=>$password,'ubah'=>wkt()),"id='".$_SESSION['userid']."'");
	}

	eksyen('Data berhasil diubah','?p=profil');
}
?>
<form action="" method="POST" class="form-horizontal" role="form">

	<div class="form-group">
		<label for="inputNama" class="col-sm-2 control-label">Nama:</label>
		<div class="col-sm-4">
			<input type="text" name="nama" id="inputNama" class="form-control" required="required" maxlength="50" value="<?=$d[0]['nama'];?>">
		</div>
	</div>

	<div class="form-group">
		<label for="inputNama" class="col-sm-2 control-label">Alamat:</label>
		<div class="col-sm-6">
			<textarea name="alamat" id="inputAlamat" class="form-control" rows="3" required="required"><?php echo $d[0]['alamat']; ?></textarea>
		</div>
	</div>	

	<div class="form-group">
		<label for="inputNama" class="col-sm-2 control-label">Jenis Kelamin:</label>
		<div class="col-sm-10">
			<div class="radio">
				<label>
					<input type="radio" name="jk" id="inputJk" value="L" <?php cekbok($d[0]['jk'],'L');?>>
					Laki-laki
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="jk" id="inputJk" value="P" <?php cekbok($d[0]['jk'],'P');?>>
					Perempuan
				</label>
			</div>
		</div>
	</div>	

	<div class="form-group">
		<label for="inputNama" class="col-sm-2 control-label">Jabatan:</label>
		<div class="col-sm-4">
			<select name="jabatan" id="inputJabatan" class="form-control" required="required">
				<?php
				$db->select('jabatan'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
				$jb = $db->getResult();
				foreach($jb as $jb){
				?>
				<option value="<?=$jb['id'];?>" <?php selek($d[0]['jabatan'],$jb['id']);?>><?=$jb['nama'];?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="input" class="col-sm-2 control-label">Level :</label>
		<div class="col-sm-4">
			<select name="level" id="inputLevel" class="form-control" required="required">
				<?php
				$level = array('Pegawai','Direktur','Admin');
				foreach($level as $level){
				?>
				<option value="<?=$level;?>" <?php selek($d[0]['level'],$level);?>><?=$level;?></option>
				<?php } ?>
			</select>
		</div>
	</div>		

	<div class="form-group">
		<label for="inputUsername" class="col-sm-2 control-label">Username:</label>
		<div class="col-sm-4">
			<input type="text" name="username" id="inputUsername" class="form-control" required="required" maxlength="15" value="<?=$d[0]['username'];?>">
		</div>
	</div>	

	<div class="form-group">
		<label for="inputPassword" class="col-sm-2 control-label">Password:</label>
		<div class="col-sm-4">
			<input type="password" name="password" id="inputPassword" class="form-control" >
			<span class='help-block'>Kosongkan jika tidak ingin mengubah password</span>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<button type="submit" class="btn btn-primary">Simpan</button>
			<button type="reset" class="btn btn-default">Reset</button>
		</div>
	</div>
</form>