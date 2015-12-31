<?php if(!isset($_GET['act'])){ ?>
<div class="col-lg-12">
    <h1 class="page-header">Data Kelas</h1>
</div>
<table class="table table-hover table-bordered" id="tbl">
	<thead>
		<tr>
			<th class="col-lg-1 text-center">No</th>
			<th>Kelas</th>
			<th>Program</th>
			<th class="col-lg-2 text-center">Tapel</th>
			<th class="col-lg-2 text-center">Status</th>
			<th class="col-lg-1 text-center">#</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		$db = new Database();
		$db->connect();
		$db->select('kelas','*',null,"status='1' or status='0'","status asc"); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$res = $db->getResult();
		foreach($res as $d){
		?>
		<tr<?php if($d['status']==0){ echo ' class="warning"';} ?>>
			<td class="text-center"><?=$i++;?></td>
			<td><?=$d['kode'];?> - <?=$d['nama'];?></td>
			<td><?=konvert('program',$d['idprogram'],'nama');?><?=konvert('programs',$d['idprogram'],'nama');?></td>
			<td class="text-center"><?=$d['tapel'];?></td>
			<td class="text-center"><?php if($d['status']==0){ echo "Non-Aktif"; }elseif($d['status']==1){ echo "Aktif"; } ?></td>
			<td class="text-center"><?=tbl_ubah('?p=kelas&act=ubah&id='.$d['id']);?> <?=tbl_hapus('?p=kelas&act=hapus&id='.$d['id']);?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php }else{

	switch ($_GET['act']) {
		case 'ubah': ?>
			<?php 
			if(isset($_GET['id'])){ 
				echo '<h1 class="page-header">Ubah Kelas</h1>';
				$id = $_GET['id'];
				$db->select('kelas','*',NULL,"id='$id'",null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
				$d = $db->getResult();
			}else{
				echo '<h1 class="page-header">Tambah Kelas</h1>';
			}

			if(isset($_POST['nama'])){
				echo "Processing...";
				$nama = mysql_real_escape_string($_POST['nama']);
				$kode = mysql_real_escape_string($_POST['kode']);
				$tapel = mysql_real_escape_string($_POST['tapel']);
				$program = mysql_real_escape_string($_POST['program']);
				$status = mysql_real_escape_string($_POST['status']);

				if(isset($_POST['id'])){
					$id = mysql_real_escape_string($_POST['id']);
					$db->update('kelas',array('nama'=>$nama,'kode'=>$kode,'tapel'=>$tapel,'idprogram'=>$program,'status'=>$status),"id='$id'");
					eksyen('Data berhasil diubah','?p=kelas');
				}else{
					$db->insert('kelas',array('id'=>id(),'nama'=>$nama,'kode'=>$kode,'tapel'=>$tapel,'idprogram'=>$program,'status'=>$status));
					$res = $db->getResult();
					eksyen('Data berhasil diinput','?p=kelas');
				}
			}
			?>
			<form action="" method="POST" class="form-horizontal" role="form">
				<?php if(isset($_GET['id'])){ ?>
				<input type="hidden" name="id" id="inputId" class="form-control" value="<?=$_GET['id'];?>">
				<?php } ?>
				<div class="form-group">
					<label for="namakelas" class="col-sm-2 control-label">Nama Kelas :</label>
					<div class="col-sm-10">
						<input type="text" name="nama" id="namakelas" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['nama'];?>"<?php } ?> required="required" maxlength="30">
					</div>
				</div>

				<div class="form-group">
					<label for="kodekelas" class="col-sm-2 control-label">Kode Kelas :</label>
					<div class="col-sm-10">
						<input type="text" name="kode" id="kodekelas" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['kode'];?>"<?php } ?> maxlength="10" required="required">
					</div>
				</div>

				<div class="form-group">
					<label for="inputtahap" class="col-sm-2 control-label">Tahun Pelajaran :</label>
					<div class="col-sm-10">
						<input type="text" name="tapel" id="inputtahap" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['tapel'];?>"<?php } ?> maxlength="9" required="required" aria-describedby="helpBlock">
						<span id="helpBlock" class="help-block">Format: 2000/2000</span>
					</div>
				</div>

				<div class="form-group">
					<label for="inputProgram" class="col-sm-2 control-label">Program:</label>
					<div class="col-sm-10">
						<select name="program" id="inputProgram" class="form-control" required="required">
							<?php
							$dp = new Database();
							$dp->connect();
							$dp->sql('select id,nama from program union select id,nama from programs');
							$dp = $dp->getResult();
							foreach($dp as $dp){
							?>
							<option value="<?=$dp['id'];?>" <?php if(isset($_GET['id'])){ ?><?=selek($dp['id'],$d[0]['idprogram']);?><?php } ?>><?=$dp['nama'];?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="input" class="col-sm-2 control-label">Status:</label>
					<div class="col-sm-10">
						<div class="radio">
							<label>
								<input type="radio" name="status" id="inputStatus" value="1" <?php if(isset($_GET['id'])){ ?><?=cekbok('1',$d[0]['status']);?><?php } ?>>
								Aktif
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="status" id="inputStatus" value="0" <?php if(isset($_GET['id'])){ ?><?=cekbok('0',$d[0]['status']);?><?php } ?>>
								Non-Aktif
							</label>
						</div>
					</div>
				</div>

				
			
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<button type="submit" class="btn btn-primary">Simpan</button>
						<button type="reset" class="btn btn-default">Reset</button>
					</div>
				</div>
			</form>
			<?php break;

		case 'hapus':
			echo '<h1 class="page-header">Hapus Kelas</h1>Processing...';
			$id = mysql_real_escape_string($_GET['id']);
			$db->update('kelas',array('status'=>'2'),"id='$id'"); 
			$res = $db->getResult();
			eksyen('','?p=kelas');
			break;
		
		default:
			eksyen('Halaman tidak ditemukan','index.php');
			break;
	}
}