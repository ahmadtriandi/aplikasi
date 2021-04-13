<?php
define('FPDF_FONTPATH','font/');
require('../../fpdf/fpdf.php');
include "../../koneksi/koneksi.php";
$tanggal1 = $_POST['dari'];
$tanggal2 = $_POST['sampai'];
class PDF extends FPDF
{

//Page header
function Header()
{
    //Logo
    //$this->Image('logo_pb.png',10,8,33);
    //Arial bold 15
	$this->Ln(10);
    $this->SetFont('Arial','B',13);
    //Move to the right
    $this->Cell(100);
    //Title
    $this->Cell(10,10,'Rekap Invoice / Laporan Keuangan',0,0,'C');
	$this->SetFont('Arial','I',10);
    //Line break
    $this->Ln(20);
}

//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
	//$this->Ln(10);
    $this->SetY(-25);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Instanciation of inherited class
$pdf=new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
$pdf->SetX(10);
$pdf->Cell(30,6,'Dari Tanggal',0,0,'L');
$pdf->Cell(0,6,':  '.$tanggal1,0,0,'L');
$pdf->Ln(5);
$pdf->SetX(10);
$pdf->Cell(30,6,'Sampai Tanggal',0,0,'L');
$pdf->Cell(0,6,':  '.$tanggal2,0,0,'L');
$pdf->Ln(10);
$pdf->SetX(10);
$sql=mysqli_query($con, "select * from cash where (tanggal_faktur between '$tanggal1' and '$tanggal2') order by no_faktur DESC") ;
$no=1;
$i=1;
//$pdf->setFillColor(222,222,222);
while ($data = mysqli_fetch_array($sql)){ 
$sql_limit = "select * from penjualan,produk where penjualan.kode_barang = produk.id_barang and penjualan.no_transaksi = '$data[no_faktur]'";
$query=mysqli_query($con, $sql_limit);
$row = mysqli_fetch_array(mysqli_query($con, "select tanggal_transaksi from penjualan where no_transaksi = '$data[no_faktur]'"));
$row2 = mysqli_fetch_array(mysqli_query($con, "select nama_pelanggan from penjualan,pelanggan where penjualan.id_pelanggan = pelanggan.id_pelanggan and penjualan.no_transaksi = '$data[no_faktur]'"));
$pdf->setFillColor(255,255,255);
$pdf->SetX(10);
$pdf->CELL(20,6,'NO Invoice',0,0,'C',1);
$pdf->cell(30,6,': '.$data['no_faktur'],0,0,'L',1);
$pdf->CELL(30,6,'Tanggal Invoice',0,0,'C',1);
$pdf->cell(25,6,': '.$data['tanggal_faktur'],0,1,'L',1);
$pdf->SetX(10);
$pdf->cell(23,6,'Kode Barang',1,0,'L',1);
$pdf->CELL(65,6,'Nama Barang',1,0,'C',1);
$pdf->cell(35,6,'Harga',1,0,'L',1);
$pdf->CELL(8,6,'Qty',1,0,'C',1);
$pdf->cell(25,6,'Diskon',1,0,'L',1);
$pdf->cell(35,6,'Total Harga',1,1,'L',1);
while($tampil=mysqli_fetch_array($query)){ 
$pdf->SetX(10);
$pdf->cell(23,6,$tampil['kode_barang'],1,0,'L',1);
$pdf->CELL(65,6,$tampil['nama_barang'],1,0,'C',1);
$pdf->cell(35,6,'Rp'.number_format($tampil['harga_jual'],2,',','.'),1,0,'L',1);
$pdf->CELL(8,6,$tampil['qty'],1,0,'C',1);
$pdf->cell(25,6,'Rp'.number_format($tampil['potongan'],2,',','.'),1,0,'L',1);
$pdf->cell(35,6,'Rp'.number_format($tampil['total_harga'],2,',','.'),1,1,'L',1);
}
$maks=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
$tampil=mysqli_fetch_array($maks);
$kuery=mysqli_query($con, "select SUM(total_bayar) as total_harga from cash where no_faktur = '$data[no_faktur]'");
$tampilkan=mysqli_fetch_array($kuery);
$pdf->SetX(10);
$pdf->cell(156,6,'Total Yang Harus Di Bayar Adalah : ',1,0,'R',1);
$pdf->cell(35,6,'Rp'.number_format($tampilkan['total_harga'],2,',','.'),1,1,'L',1);
$pdf->SetX(10);
$pdf->cell(156,6,'Cash : ',1,0,'R',1);
$pdf->cell(35,6,'Rp'.number_format($data['cash'],2,',','.'),1,1,'L',1);
$pdf->SetX(10);
$pdf->cell(156,6,'Kembali : ',1,0,'R',1);
$pdf->cell(35,6,'Rp'.number_format($data['kembali'],2,',','.'),1,1,'L',1);
$pdf->SetX(10);
$pdf->cell(156,6,'DP : ',1,0,'R',1);
$pdf->cell(35,6,'Rp'.number_format($data['dp'],2,',','.'),1,1,'L',1);
$pdf->SetX(10);
$pdf->cell(156,6,'Sisa : ',1,0,'R',1);
$pdf->cell(35,6,'Rp'.number_format($data['sisa'],2,',','.'),1,1,'L',1);
$pdf->Ln(10);
}
$tot=mysqli_query($con, "select SUM(total_bayar) as total_bayar from cash where (tanggal_faktur between '$tanggal1' and '$tanggal2')");
$tampilkantot=mysqli_fetch_array($tot);
$tot2=mysqli_query($con, "select SUM(dp) as dp from cash where (tanggal_faktur between '$tanggal1' and '$tanggal2') and (lunas ='TIDAK')");
$tampilkantot2=mysqli_fetch_array($tot2);
$tot3=mysqli_query($con, "select SUM(sisa) as sisa from cash where (tanggal_faktur between '$tanggal1' and '$tanggal2') and (lunas ='TIDAK')");
$tampilkantot3=mysqli_fetch_array($tot3);
$tot4=mysqli_query($con, "SELECT SUM( (harga_jual - harga_beli) - potongan ) as laba FROM cash, penjualan, produk WHERE ( produk.id_barang = penjualan.kode_barang) AND (cash.no_faktur = penjualan.no_transaksi) AND (tanggal_transaksi between '$tanggal1' and '$tanggal2')");
$tampilkantot4=mysqli_fetch_array($tot4);
//$laba = ($tampilkantot4['laba']-$tampilkantot5['hutang'])+;
$pdf->SetX(10);
$pdf->cell(80,6,'Total Penjualan : ',1,0,'R',1);
$pdf->cell(45,6,'Rp'.number_format($tampilkantot['total_bayar'],2,',','.'),1,1,'L',1);
/*$pdf->SetX(10);
$pdf->cell(80,6,'Total Penjualan Belum Lunas : ',1,0,'R',1);
$pdf->cell(45,6,'Rp'.number_format($tampilkantot2['dp'],2,',','.'),1,1,'L',1);
$pdf->SetX(10);
$pdf->cell(80,6,'Total Piutang : ',1,0,'R',1);
$pdf->cell(45,6,'Rp'.number_format($tampilkantot3['sisa'],2,',','.'),1,1,'L',1);*/
$pdf->SetX(10);
/*$pdf->AddPage();
$pdf->SetFont('Arial','',9);
$pdf->SetX(85);
$pdf->Cell(30,6,'Dari Tanggal',0,0,'L');
$pdf->Cell(0,6,':  '.$tanggal1,0,0,'L');
$pdf->Ln(5);
$pdf->SetX(85);
$pdf->Cell(30,6,'Sampai Tanggal',0,0,'L');
$pdf->Cell(0,6,':  '.$tanggal2,0,0,'L');
$pdf->Ln(10);
$sql = mysqli_query ("select jns_kamar from jenis");
$q=0;
$pdf->SetX(85);
$pdf->cell(50,6,'Jenis Kamar',1,0,'L',1);
$pdf->cell(50,6,'Jumlah Yang Menginap',1,0,'L',1);
$pdf->cell(50,6,'Total',1,1,'L',1);
while ($tmpil = mysqli_fetch_array($sql)){
$pdf->SetX(85);
$pdf->cell(50,6,$tmpil['jns_kamar'],1,0,'L',1);
$htg=mysqli_query($con, "select COUNT(*) as jumlah from pemesanan,tamu,jenis,pembayaran where pemesanan.no_ktp = tamu.no_ktp and pemesanan.no_jenis=jenis.no_jenis and pemesanan.no_pemesanan=pembayaran.no_pemesanan and (pembayaran.tgl_bayar between '$tanggal1' and '$tanggal2') and jenis.jns_kamar='$tmpil[jns_kamar]'") ;
$jmlh = mysqli_fetch_array($htg);
$pdf->cell(50,6,$jmlh['jumlah'],1,0,'L',1);
$htg2=mysqli_query($con, "select SUM(total_bayar) as jumlah from pemesanan,tamu,jenis,pembayaran where pemesanan.no_ktp = tamu.no_ktp and pemesanan.no_jenis=jenis.no_jenis and pemesanan.no_pemesanan=pembayaran.no_pemesanan and (pembayaran.tgl_bayar between '$tanggal1' and '$tanggal2') and jenis.jns_kamar='$tmpil[jns_kamar]'") ;
$jmlh2 = mysqli_fetch_array($htg2);
$pdf->cell(50,6,$jmlh2['jumlah'],1,1,'L',1);
$q+=$jmlh2['jumlah'];
}
$pdf->setX(135);
$pdf->cell(50,6,'Total',1,0,'R',1);
$pdf->cell(50,6,$q,1,0,'L',1);
$pdf->Ln(20);
$pdf->setX(200);
$pdf->cell(50,6,'Resepsionis',0,0,'L',1);
$pdf->Ln(20);
$pdf->setX(192);
$pdf->cell(50,6,'(..................................)',0,0,'L',1);*/
$pdf->Output();
?>