<div class="col-lg-12">
	<h1 class="page-header">Formulir Pendaftaran</h1>
</div>

<form action="action_daftar.php" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="inputNama" class="col-sm-2 control-label">Nama:</label>
		<div class="col-sm-10">
			<input type="text" name="nama" id="inputNama" class="form-control" value="" required="required" maxlength="100">
		</div>
	</div>

	<div class="form-group">
		<label for="datepicker" class="col-sm-2 control-label">Tanggal Lahir:</label>
		<div class="col-sm-10">
			<input type="text" name="tanggal" id="datepicker" class="form-control" value="" required="required" >
		</div>
	</div>

	<div class="form-group">
		<label for="textareaAlamat" class="col-sm-2 control-label">Alamat:</label>
		<div class="col-sm-10">
			<textarea name="alamat" id="textareaAlamat" class="form-control" rows="3" required="required"></textarea>
		</div>
	</div>

	<div class="form-group">
		<label for="inputKodepos" class="col-sm-2 control-label">Kode Pos:</label>
		<div class="col-sm-3">
			<input type="text" name="kodepos" id="inputKodepos" class="form-control" value="" required="required" <?=angka();?> maxlength="6">
		</div>

		<label for="email" class="col-sm-1 control-label">Email:</label>
		<div class="col-sm-6">
			<input type="email" name="email" id="email" class="form-control" value="" required="required" maxlength="100">
		</div>
	</div>

	<div class="form-group">
		<label for="inputTelp" class="col-sm-2 control-label">Telp Rumah:</label>
		<div class="col-sm-3">
			<input type="text" name="telp" id="inputTelp" class="form-control" value="" required="required" <?=angka();?> maxlength="15">
		</div>
		<label for="hp" class="col-sm-1 control-label">Handphone:</label>
		<div class="col-sm-6">
			<input type="text" name="hp" id="hp" class="form-control" value="" required="required" <?=angka();?> maxlength="15">
		</div>
	</div>

	<div class="form-group">
		<label for="inputSekolah" class="col-sm-2 control-label">Asal Sekolah:</label>
		<div class="col-sm-10">
			<input type="text" name="sekolah" id="inputSekolah" class="form-control" value="" required="required" maxlength="100">
		</div>
	</div>

	<div class="form-group">
		<label for="inputKelas" class="col-sm-2 control-label">Kelas:</label>
		<div class="col-sm-10">
			<select name="kelas" id="inputKelas" class="form-control" required="required">
			<?php
			$arrkelas = array('X SMA','XI IPA','XII IPA','XI IPS','XII IPS','Alumni');
			foreach($arrkelas as $kelas){ ?>
				<option value="<?=$kelas;?>"><?=$kelas;?></option>
			<?php } ?>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="inputOrtu" class="col-sm-2 control-label">Nama Orang Tua:</label>
		<div class="col-sm-10">
			<input type="text" name="ortu" id="inputOrtu" class="form-control" value="" required="required" maxlength="100">
		</div>
	</div>

	<div class="form-group">
		<label for="inputPekerjaan" class="col-sm-2 control-label">Pekerjaan O.Tua:</label>
		<div class="col-sm-10">
			<input type="text" name="pekerjaan" id="inputPekerjaan" class="form-control" value="" required="required" maxlength="100">
		</div>
	</div>

	<div class="form-group">
		<label for="inputProgram" class="col-sm-2 control-label">Program:</label>
		<div class="col-sm-10">
			<select name="program" id="inputProgram" class="form-control" required="required">
				<?php
				$db->sql('select id,nama from program union select id,nama from programs');
				$d = $db->getResult();
				foreach($d as $d){
				?>
				<option value="<?=$d['id'];?>"><?=$d['nama'];?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="inputPtn1" class="col-sm-2 control-label">Pilihan PTN #1:</label>
		<div class="col-sm-10">
			<input type="text" name="ptn1" id="inputPtn1" class="form-control" value="" required="required" maxlength="100">
		</div>
	</div>

	<div class="form-group">
		<label for="inputPtn2" class="col-sm-2 control-label">Pilihan PTN #2:</label>
		<div class="col-sm-10">
			<input type="text" name="ptn2" id="inputPtn2" class="form-control" value="" required="required" maxlength="100">
		</div>
	</div>

	<div class="form-group">
		<label for="inputPtn3" class="col-sm-2 control-label">Pilihan PTN #3:</label>
		<div class="col-sm-10">
			<input type="text" name="ptn3" id="inputPtn3" class="form-control" value="" required="required" maxlength="100">
		</div>
	</div>

	<div class="form-group">
		<label for="inputFoto" class="col-sm-2 control-label">Foto:</label>
		<div class="col-sm-10">
			<input type="file" name="foto" id="inputFoto" required="required" maxlength="200">
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>
</form>