<h1 class="page-header">Profil Saya</h1>
<?php
$db->select('users','*',NULL,"id='".$_SESSION['id']."'"); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
$d = $db->getResult();

if(isset($_POST['nama'])){
	echo "Processing...";
	$nama = mysql_real_escape_string($_POST['nama']);
	$level = mysql_real_escape_string($_POST['level']);
	$username = mysql_real_escape_string($_POST['username']);
	$password = mysql_real_escape_string(md5($_POST['password']));
	$id = $_SESSION['id'];

	$_SESSION['nama'] = $nama;

	if($_POST['password']==''){
		$db->update('users',array('nama'=>$nama,'level'=>$level,'email'=>$username),"id='$id'");
	}else{
		$db->update('users',array('nama'=>$nama,'level'=>$level,'email'=>$username,'password'=>$password),"id='$id'");
	}

	eksyen('Data berhasil diubah','?p=profil');
}

foreach($d as $d){
?>
<form action="" method="POST" class="form-horizontal" role="form">

	<div class="form-group">
		<label for="inputNama" class="col-sm-2 control-label">Nama:</label>
		<div class="col-sm-4">
			<input type="text" name="nama" id="inputNama" class="form-control" required="required" maxlength="50" value="<?=$d['nama'];?>">
		</div>
	</div>

	<div class="form-group">
		<label for="input" class="col-sm-2 control-label">Level :</label>
		<div class="col-sm-4">
			<select name="level" id="inputLevel" class="form-control" required="required">
				<?php
				$level = array('Kasir','Direktur','Admin');
				foreach($level as $level){
				?>
				<option value="<?=$level;?>" <?php selek($d['level'],$level);?>><?=$level;?></option>
				<?php } ?>
			</select>
		</div>
	</div>		

	<div class="form-group">
		<label for="inputUsername" class="col-sm-2 control-label">Email:</label>
		<div class="col-sm-4">
			<input type="text" name="username" id="inputUsername" class="form-control" required="required" maxlength="15" value="<?=$d['email'];?>">
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
<?php } ?>