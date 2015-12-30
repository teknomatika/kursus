<?php if(!isset($_GET['act'])){ ?>
<div class="col-lg-12">
    <h1 class="page-header">Data Program Super</h1>
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
		$db->select('programs'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$res = $db->getResult();
		foreach($res as $d){
		?>
		<tr>
			<td class="text-center"><?=$i++;?></td>
			<td class="text-center"><?=$d['kode'];?></td>
			<td><?=$d['nama'];?><br><?=$d['namap'];?></td>
			<td>
				<table>
				<tr>
					<td class="col-lg-7">Total</td><td>Rp.<?=number_format($d['total'],'0',',','.');?></td>
				</tr>
				<tr>
					<td class="col-lg-7">Hemat</td><td>Rp.<?=number_format($d['total']-$d['diskon'],'0',',','.');?></td>
				</tr>
				<tr>
					<td class="col-lg-7">Jaminan</td><td>Rp.<?=number_format($d['jaminan'],'0',',','.');?></td>
				</tr>
				</table>
			</td>
			<td class="text-center">
				<p><?=tbl_ubah('?p=super&act=ubah&id='.$d['id']);?> <?=tbl_hapus('?p=super&act=hapus&id='.$d['id']);?></p>
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
				echo '<h1 class="page-header">Ubah Program Super</h1>';
				$id = $_GET['id'];
				$db->select('programs','*',NULL,"id='$id'",null); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
				$d = $db->getResult();
			}else{
				echo '<h1 class="page-header">Tambah Program Super</h1>';
			}

			if(isset($_POST['nama'])){
				echo "Processing...";
				$nama = mysql_real_escape_string($_POST['nama']);
				$namap = mysql_real_escape_string($_POST['namap']);
				$kode = mysql_real_escape_string($_POST['kode']);
				$tahap = mysql_real_escape_string($_POST['tahap']);
				$total = mysql_real_escape_string($_POST['total']);
				$operasional = mysql_real_escape_string($_POST['operasional']);
				$jaminan = mysql_real_escape_string($_POST['jaminan']);
				$diskon = mysql_real_escape_string($_POST['diskon']);
				$jumsiswa = mysql_real_escape_string($_POST['jumsiswa']);

				// diskon guru
				$dguru = 30;
				$guru = $total * 30 / 100;

				if(isset($_POST['id'])){
					$id = mysql_real_escape_string($_POST['id']);
					$db->update('programs',array('nama'=>$nama,'namap'=>$namap,'kode'=>$kode,'tahap'=>$tahap,'total'=>$total,'operasional'=>$operasional,'jaminan'=>$jaminan,'diskon'=>$diskon,'guru'=>$guru,'jumsiswa'=>$jumsiswa),"id='$id'");
					eksyen('Data berhasil diubah','?p=super');
				}else{
					$db->insert('programs',array('id'=>id(),'nama'=>$nama,'namap'=>$namap,'kode'=>$kode,'tahap'=>$tahap,'total'=>$total,'operasional'=>$operasional,'jaminan'=>$jaminan,'diskon'=>$diskon,'guru'=>$guru,'jumsiswa'=>$jumsiswa));
					$res = $db->getResult();
					eksyen('Data berhasil diinput','?p=super');
				}
			}
			?>
			<form action="" method="POST" class="form-horizontal" role="form">
				<?php if(isset($_GET['id'])){ ?>
				<input type="hidden" name="id" id="inputId" class="form-control" value="<?=$_GET['id'];?>">
				<?php } ?>
				<div class="form-group">
					<label for="inputNama" class="col-sm-2 control-label">Nama Pendek :</label>
					<div class="col-sm-10">
						<input type="text" name="nama" id="inputNama" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['nama'];?>"<?php } ?> required="required" maxlength="30">
					</div>
				</div>

				<div class="form-group">
					<label for="inputNamap" class="col-sm-2 control-label">Nama Panjang :</label>
					<div class="col-sm-10">
						<input type="text" name="namap" id="inputNamap" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['namap'];?>"<?php } ?> required="required" maxlength="100">
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
					<label for="operasional" class="col-sm-2 control-label">Dana Operasional :</label>
					<div class="col-sm-10">
						<input type="text" name="operasional" id="operasional" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['operasional'];?>"<?php } ?> maxlength="8" required="required" onkeypress="return isNumber(event)">
					</div>
				</div>

				<div class="form-group">
					<label for="jaminan" class="col-sm-2 control-label">Dana Jaminan :</label>
					<div class="col-sm-10">
						<input type="text" name="jaminan" id="jaminan" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['jaminan'];?>"<?php } ?> maxlength="8" required="required" onkeypress="return isNumber(event)">
					</div>
				</div>

				<div class="form-group">
					<label for="diskon" class="col-sm-2 control-label">Diskon Lunas :</label>
					<div class="col-sm-10">
						<input type="text" name="diskon" id="diskon" class="form-control" <?php if(isset($_GET['id'])){ ?>value="<?=$d[0]['diskon'];?>"<?php } ?> maxlength="8" required="required" onkeypress="return isNumber(event)">
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
			eksyen('','?p=super');
			break;
		
		default:
			eksyen('Halaman tidak ditemukan','index.php');
			break;
	}
}