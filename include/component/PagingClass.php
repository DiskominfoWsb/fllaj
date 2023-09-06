<?php
class Paging
{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas)
{
if(empty($_GET[page])){
	$posisi=0;
	$_GET[page]=1;
}
else{
	$posisi = ($_GET[page]-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas)
{
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 ... Next, Prev, First, Last
function navHalaman($halaman_aktif, $jmlhalaman)
{
$link_halaman = "";
/*
// Link First dan Previous
if ($halaman_aktif > 1)
{
$link_halaman .= " <a href=$_SERVER[PHP_SELF]?mode=$_GET[mode]&mode=$_GET[content]&halaman=1><< First</a> | ";
}

if (($halaman_aktif-1) > 0)
{
$previous = $halaman_aktif-1;
$link_halaman .= "<a href=$_SERVER[PHP_SELF]?page=$_GET[page]&halaman=$previous>< Previous</a> | ";
}
*/
// Link halaman 1,2,3, ...
for ($i=1; $i<=$jmlhalaman; $i++)
{
if ($i == $halaman_aktif)
{
$link_halaman .= "<span class=disabled>$i</span>  ";
}
else
{
	if (!$_GET[content]){
	$link_halaman .= "<a href=$_SERVER[PHP_SELF]?mode=$_GET[mode]&page=$i> $i </a>  ";
	
	}else{
	$link_halaman .= "<a href=$_SERVER[PHP_SELF]?mode=$_GET[mode]&content=$_GET[content]&id=$_GET[id]&page=$i> $i </a>  ";
	
	}
}
$link_halaman .= " ";
}
/*
// Link Next dan Last
if ($halaman_aktif < $jmlhalaman)
{
$next=$halaman_aktif+1;
$link_halaman .= " <a href=$_SERVER[PHP_SELF]?page=$_GET[page]&halaman=$next>Next ></a> ";
}

if (($halaman_aktif != $jmlhalaman) && ($jmlhalaman != 0))
{
$link_halaman .= " | <a href=$_SERVER[PHP_SELF]?page=$_GET[page]&halaman=$jmlhalaman>Last >></a> ";
}
*/
return $link_halaman;
}
}
?>
