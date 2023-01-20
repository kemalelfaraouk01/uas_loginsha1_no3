<!Doctype html>
<html>
 <head>
  <title>Form Entri Barang Baru</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="styleinput.css">
 </head>
 <body>
 <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center">
          <li class="breadcrumb-item"><a href="index.php?page=<?php echo base64_encode('index');?>">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Form</li>
        </ol>
      </nav>
  <div class="container">
  <h2>Form Pembelian Barang</h2>
  <form method="post">
  <div class="form-group ">
    <label for="namabarang">Email</label>
    <input type="email" class="form-control" id="email" name="email" style="width: 500px;">
  </div>
  <div class="form-group ">
    <label for="namabarang">Nama Barang</label>
    <input type="text" class="form-control" id="namabarang" name="namabarang" style="width: 500px;">
  </div>
  <div class="form-group">
    <label for="jumlahbeli">Jumlah Barang</label>
    <input type="number" class="form-control" id="jumlahbeli" name="jumlahbeli" style="width: 500px;">
  </div>
  <div class="form-group">
   <label>Jenis Pembayaran</label>
   <select id="jenispembayaran" name="jenispembayaran">
    <option value="cod">COD</option>
	<option value="kredit">Kredit</option>
   </select></div>
  <div class="form-group ">
    <label for="keterangan">Catatan kepada penjual</label>
    <input type="text" class="form-control" id="keterangan" name="keterangan" style="width: 500px;">
  </div>
  <div class="form-group ">
    <label for="alamat">Alamat Pengiriman</label>
    <textarea type="textarea" class="form-control" id="alamat" name="alamat" style="width: 500px;">
    </textarea>
  </div>
  <button type="submit" class="btn btn-primary" name="bSimpan">Check Out</button>
</form>
  </div>
 </body>
</html>
<?php 
function enc($plaintext) {
    $iv="1141241217415612";
    $algo="aes-256-cbc";
    $kunci=sha1("SHOLATLAH");
    $chipertext=openssl_encrypt($plaintext,$algo,$kunci,$option=0,$iv);
    return $chipertext;
}

if (isset($_POST['bSimpan'])) {
    $email=$_POST['email'];
	$namabarang=$_POST['namabarang'];
	$jumlahbeli=$_POST['jumlahbeli'];
	$jenispembayaran=$_POST['jenispembayaran'];
	$keterangan=$_POST['keterangan'];
    $alamat=$_POST['alamat'];
    $email=enc($email);
    $namabarang=enc($namabarang);
    $jumlahbeli=enc($jumlahbeli);
    $alamat=enc($alamat);
    $jenispembayaran=enc($jenispembayaran);
    $keterangan=enc($keterangan);
	$koneksi=new mysqli("localhost","root","","tokosaya");
	$sql="INSERT INTO `barang` (`email`,`namabarang`, `jumlahbeli`,`jenispembayaran`,`keterangan`,`alamat`) VALUES ('".$email."','".$namabarang."', '".$jumlahbeli."','".$jenispembayaran."','".$keterangan."','".$alamat."');";
	$q1=$koneksi->query($sql);
	if ($q1) {  //jika proses benar
    echo '<script language="javascript">';
    echo 'alert("Check Out Berhasil!")';
    echo '</script>';
    
} else { //jika proses salah
	echo "Rekord barang gagal disimpan !";
}
}	

?>