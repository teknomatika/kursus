<?php error_reporting(0);
if(isset($_GET['program']) and isset($_GET['x'])){
	$x = base64_decode($_GET['x']);
	$id = $_GET['program'];

	// PROSES FORM
	if(isset($_POST['idprogram'])){
		$idprogram = $db->escapeString($_POST['idprogram']);
		$total = $db->escapeString($_POST['total']);
		
		$db->select('tahap','*',NULL,"idprogram='$idprogram'");
		$jum = $db->numRows();
		echo "Proses...";
		if($jum<1){
			// insert
			$sql = "insert into tahap values";
			for($i=1;$i<=$total;$i++){
				$tahap = $db->escapeString($_POST['tahap'.$i]);
				$biaya = $db->escapeString($_POST['total'.$i]);
				$sql .= "('".id()."','$idprogram','$tahap','$biaya')";
				if($i<$total){
					$sql .= ",";
				}
			}
			$db->sql($sql);
			eksyen('','?p=biayas&program='.$idprogram.'&x='.base64_encode($total));
		}else{
			// update
			for($i=1;$i<=$total;$i++){
				$tahap = $db->escapeString($_POST['tahap'.$i]);
				$biaya = $db->escapeString($_POST['total'.$i]);
				$db->update('tahap',array('biaya'=>$biaya),"idprogram='$idprogram' and tahap='$tahap'");
			}
			eksyen('','?p=biayas&program='.$idprogram.'&x='.base64_encode($total));
		}
	}

	$db->select('programs','*',NULL,"id='$id'",null);
	$d = $db->getResult();
	foreach($d as $d){
?>
<div class="col-lg-12">
    <h1 class="page-header">Biaya Program Super</h1>
</div>
<form action="" method="POST" class="form-horizontal" role="form">
	<input type="hidden" name="idprogram" id="inputIdprogram" class="form-control" value="<?=$id;?>">
	<div class="form-group">
		<label for="inputNama" class="col-sm-2 control-label">Nama Program :</label>
		<div class="col-sm-10">
			<input type="text" name="nama" id="inputNama" class="form-control" value="<?=$d['nama'];?>" readonly maxlength="30">
		</div>
	</div>

	<div class="form-group">
		<label for="inputkode" class="col-sm-2 control-label">Kode Program :</label>
		<div class="col-sm-10">
			<input type="text" name="kode" id="inputkode" class="form-control" value="<?=$d['kode'];?>" maxlength="10" readonly>
		</div>
	</div>

	<div class="form-group">
		<label for="inputtahap" class="col-sm-2 control-label">Tahap Pembayaran :</label>
		<div class="col-sm-2">
		<div class="input-group">
			<input type="text" name="tahap" id="inputtahap" class="form-control" value="<?=$d['tahap'];?>" maxlength="2" readonly onkeypress="return isNumber(event)">
			<span class="input-group-addon" id="basic-addon2">kali</span>
		</div>
		</div>
	</div>

	<div class="form-group">
		<label for="total" class="col-sm-2 control-label">Jumlah Total :</label>
		<div class="col-sm-10">
			<input type="text" name="tota" id="total" class="form-control" value="<?=$d['total'];?>" maxlength="8" readonly onkeypress="return isNumber(event)">
		</div>
	</div>
	<?php
	for($i=1; $i<=$x; $i++){
	?>
	<div class="form-group">
		<label for="inputNama<?=$i;?>" class="col-sm-2 control-label">Tahap <?=$i;?> :</label>
		<div class="col-sm-10">
			<input type="text" name="total<?=$i;?>" id="total<?=$i;?>" class="form-control" <?php if(isset($_GET['x'])){ ?>value="<?=biaya($id,$i);?>"<?php } ?> maxlength="8" required="required" onkeypress="return isNumber(event)">
			<input type="hidden" name="tahap<?=$i;?>" id="inputTahap<?=$I;?>" class="form-control" value="<?=$i;?>">
		</div>
	</div>
	<?php
	} // END OF FOR
	?>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<button type="submit" class="btn btn-primary">Simpan</button>
			<button type="reset" class="btn btn-default">Reset</button>
		</div>
	</div>
	<!-- total tahap -->
	<input type="hidden" name="total" id="inputTotal" class="form-control" value="<?=$i-1;?>">
</form>
<?php 
	} // END OF FOREACH
} //END OF FILE
?>