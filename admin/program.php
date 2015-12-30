<?php if(!isset($_GET['act'])){ ?>
<div class="col-lg-12">
    <h1 class="page-header">Data Program</h1>
</div>
<table class="table table-hover table-bordered" id="tbl">
	<thead>
		<tr>
			<th class="col-lg-1 text-center">No</th>
			<th class="col-lg-2 text-center">Kode</th>
			<th>Nama Program</th>
			<th class="col-lg-3 text-center">Biaya</th>
			<th class="col-lg-1 text-center">#</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		$db = new Database();
		$db->connect();
		$db->select('program'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$res = $db->getResult();
		foreach($res as $d){
		?>
		<tr>
			<td class="text-center"><?=$i++;?></td>
			<td class="text-center"><?=$d['kode'];?></td>
			<td><?=$d['nama'];?></td>
			<td>
				<table>
				<tr>
					<td class="col-lg-7">Total</td><td>Rp.<?=number_format($d['total'],'0',',','.');?></td>
				</tr>
				<tr>
					<td class="col-lg-7">Hemat</td><td>Rp.<?=number_format($d['hemat'],'0',',','.');?></td>
				</tr>
				<tr>
					<td class="col-lg-7">1 Semester</td><td>Rp.<?=number_format($d['pendek'],'0',',','.');?></td>
				</tr>
				</table>
			</td>
			<td class="text-center">
				<p><?=tbl_ubah('?p=program&act=ubah&id='.$d['id']);?> <?=tbl_hapus('?p=program&act=hapus&id='.$d['id']);?></p>
				<p><a href="?p=biaya&program=<?=$d['id'];?>&x=<?=base64_encode($d['tahap']);?>" class="btn btn-xs btn-block btn-info">Biaya</a></p>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<?php }else{

	switch ($_GET['act']) {
		case 'ubah': ?>
			<?php 
			if(isset($_GET['id'])){ 
				echo '<h1 class="page-header">Ubah Program</h1>';
				$id = $_GET['id'];
				$db->select('program','*',NULL,"id='$id'",null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
				$d = $db->getResult();
			}else{
				echo '<h1 class="page-header">Tambah Program</h1>';
			}

			if(isset($_POST['nama'])){
				echo "Processing...";
				$nama = mysql_real_escape_string($_POST['nama']);
				$kode = mysql_real_escape_string($_POST['kode']);
				$tahap = mysql_real_escape_string($_POST['tahap']);
				$total = mysql_real_escape_string($_POST['total']);
				$hemat = mysql_real_escape_string($_POST['hemat']);
				$pendek = mysql_real_escape_string($_POST['pendek']);
				$jumsiswa = mysql_real_escape_string($_POST['jumsiswa']);

				// diskon guru
				$dguru = 30;
				$guru = $total * 30 / 100;

				if(isset($_POST['id'])){
					$id = mysql_real_escape_string($_POST['id']);
					$db->update('program',array('nama'=>$nama,'kode'=>$kode,'tahap'=>$tahap,'total'=>$total,'hemat'=>$hemat,'pendek'=>$pendek,'jumsiswa'=>$jumsiswa,'guru'=>$guru),"id='$id'");
					eksyen('Data berhasil diubah','?p=program');
				}else{
					$db->insert('program',array('id'=>id(),'nama'=>$nama,'kode'=>$kode,'tahap'=>$tahap,'total'=>$total,'hemat'=>$hemat,'pendek'=>$pendek,'jumsiswa'=>$jumsiswa,'guru'=>$guru));
					$res = $db->getResult();
					eksyen('Data berhasil diinput','?p=program');
				}
			}
			?>
			<form action="" method="POST" class="form-horizontal" role="form">
				<?php if(isset($_GET['id'])){ ?>
				<input type="hidden" name="id" id="inputId" class="form-control" value="<?=$_GET['id'];?>">
				<?php } ?>
				<div class="form-group">
					<label for="inputNama" class="col-sm-2 control-label">Nama Program :</label>
					<div class="col-sm-10">
						<input type="text" name="nama" id="inputNama" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['nama'];?>"<?php } ?> required="required" maxlength="30">
					</div>
				</div>

				<div class="form-group">
					<label for="inputkode" class="col-sm-2 control-label">Kode Program :</label>
					<div class="col-sm-10">
						<input type="text" name="kode" id="inputkode" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['kode'];?>"<?php } ?> maxlength="10" required="required">
					</div>
				</div>

				<div class="form-group">
					<label for="inputtahap" class="col-sm-2 control-label">Tahap Pembayaran :</label>
					<div class="col-sm-2">
					<div class="input-group">
						<input type="text" name="tahap" id="inputtahap" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['tahap'];?>"<?php } ?> maxlength="2" required="required" onkeypress="return isNumber(event)">
						<span class="input-group-addon" id="basic-addon2">kali</span>
					</div>
					</div>
				</div>

				<div class="form-group">
					<label for="total" class="col-sm-2 control-label">Jumlah Total :</label>
					<div class="col-sm-10">
						<input type="text" name="total" id="total" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['total'];?>"<?php } ?> maxlength="8" required="required" onkeypress="return isNumber(event)">
					</div>
				</div>

				<div class="form-group">
					<label for="hemat" class="col-sm-2 control-label">Paket Hemat :</label>
					<div class="col-sm-10">
						<input type="text" name="hemat" id="hemat" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['hemat'];?>"<?php } ?> maxlength="8" required="required" onkeypress="return isNumber(event)">
					</div>
				</div>

				<div class="form-group">
					<label for="pendek" class="col-sm-2 control-label">Paket 1 Semester :</label>
					<div class="col-sm-10">
						<input type="text" name="pendek" id="pendek" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['pendek'];?>"<?php } ?> maxlength="8" required="required" onkeypress="return isNumber(event)">
					</div>
				</div>

				<div class="form-group">
					<label for="guru" class="col-sm-2 control-label">Diskon Guru :</label>
					<div class="col-sm-10">
						<input type="text" name="guru" id="guru" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['guru'];?>"<?php } ?> maxlength="8" readonly onkeypress="return isNumber(event)">
					</div>
				</div>

				<div class="form-group">
					<label for="jumsiswa" class="col-sm-2 control-label">Siswa per Kelas :</label>
					<div class="col-sm-10">
						<input type="text" name="jumsiswa" id="jumsiswa" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['jumsiswa'];?>"<?php } ?> maxlength="8" required="required" onkeypress="return isNumber(event)">
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
			echo '<h1 class="page-header">Hapus Jabatan</h1>Processing...';
			$id = mysql_real_escape_string($_GET['id']);
			$db->delete('jabatan',"id='$id'"); 
			$res = $db->getResult();
			eksyen('','?p=program');
			break;
		
		default:
			eksyen('Halaman tidak ditemukan','index.php');
			break;
	}
}