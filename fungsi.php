<?php
define("TITLE", "Super Einscoll");
date_default_timezone_set("Asia/Jakarta");

function konvert($tabel,$id,$kolom){
	$q = mysql_query("select $kolom from $tabel where id='$id'");
	$d = mysql_fetch_array($q);
	return $d[$kolom];
}

function biaya($program,$tahap){
	$q = mysql_query("select * from tahap where idprogram='$program' and tahap='$tahap'");
	$d = mysql_fetch_array($q);
	return $d['biaya'];
}

function id(){
	$q = mysql_query("select uuid() as id");
	$d = mysql_fetch_array($q);
	return $d['id'];
}

function wkt(){
	$q = mysql_query("select now() as id");
	$d = mysql_fetch_array($q);
	return $d['id'];
}

function sesi($grup){
	if($_SESSION['grup'] != $grup){
		echo '<script>window.location.assign("inside.php");</script>';
	}
}

function cekbok($a,$b){
	if($a==$b){
		echo "checked";
	}
}

function selek($a,$b){
	if($a==$b){
		echo "selected";
	}
}

function yakin(){
	echo "onClick=\"return confirm('Apakah Anda yakin akan melakukan aksi ini?');\" ";
}

function eksyen($teks=false,$tujuan){ // buat pindah halaman
	if($teks){
		die("<script>alert('$teks');</script><script>window.location.assign('$tujuan');</script>");
	}else{
		die("<script>window.location.assign('$tujuan');</script>");
	}
}

function tbl_ubah($url){
	echo '<a href="'.$url.'" class="btn btn-info btn-xs" alt="ubah" title="ubah"><i class="fa fa-edit fa-fw"></i></a>';
}

function tbl_hapus($url){
	echo '<a href="'.$url.'" class="btn btn-danger btn-xs" onClick="return confirm(\'Apakah Anda yakin akan melakukan aksi ini?\')"  alt="hapus" title="hapus"><i class="fa fa-trash-o fa-fw"></i></a>';
}