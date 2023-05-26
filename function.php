<?php
session_start(); 
// Membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","cekstokdarah");

//menambah data baru
if(isset($_POST['addnewdata'])){
    $darah = $_POST['darah'];
    $stok = $_POST['stok'];
    $keterangan = $_POST['keterangan'];

    $addtotable = mysqli_query($conn, "INSERT into stok_darah (darah, stok, keterangan) values ('$darah','$stok','$keterangan')");
    if($addtotable){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php'); 
    }
}

//menambah data masuk
if(isset($_POST['datamasuk'])){
    $darahnya = $_POST['darahnya'];
    $pendonor = $_POST['pendonor'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "SELECT * from stok_darah where id_stok='$darahnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];
    $tambahstoksekarangdenganquantity = $stoksekarang+$qty;

    $addtomasuk = mysqli_query($conn, "INSERT into data_darah_masuk (id_stok, pendonor, qty) values('$darahnya', '$pendonor', '$qty')");
    //pas nambah data agar otomatis
    $updatestokmasuk = mysqli_query($conn, "UPDATE stok_darah set stok='$tambahstoksekarangdenganquantity' where id_stok='$darahnya' ");
    if($addtomasuk&&$updatestokmasuk){
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php'); 
    }
}

//menambah data keluar
if(isset($_POST['adddatakeluar'])){
    $darahnya = $_POST['darahnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "SELECT * from stok_darah where id_stok='$darahnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];
    $tambahstoksekarangdenganquantity = $stoksekarang-$qty;

    $addtokeluar = mysqli_query($conn, "INSERT into data_darah_keluar (id_stok, penerima, qty) values('$darahnya', '$penerima', '$qty')");
    //pas nambah data agar otomatis
    $updatestokmasuk = mysqli_query($conn, "UPDATE stok_darah set stok='$tambahstoksekarangdenganquantity' where id_stok='$darahnya' ");
    if($addtokeluar&&$updatestokmasuk){
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php'); 
    }
}



//update info data stok
if(isset($_POST['updatedata'])){
    $idstok = $_POST['id_stok'];
    $darah = $_POST['darah'];
    $keterangan =$_POST['keterangan'];

    $update = mysqli_query($conn, "UPDATE stok_darah set darah='$darah', keterangan='$keterangan' where id_stok='$idstok' ");
    
    if($update){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php'); 
    }
}

//menghapus data dari stok
if(isset($_POST['hapusdata'])){

    $idstok = $_POST['id_stok'];

    $hapus = mysqli_query($conn, "DELETE from stok_darah where id_stok='$idstok' ");
    
    if($hapus){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php'); 
    }
}

//mengubah data darah masuk

if(isset($_POST['updatedatamasuk'])){
    $idstok = $_POST['id_stok'];
    $idm = $_POST['idmasuk'];
    $pendonor = $_POST['pendonor'];
    $qty = $_POST['qty'];

    //Mengambil stok dari tabel stok_darah
    $lihatstok = mysqli_query($conn, "SELECT * FROM stok_darah WHERE id_stok='$idstok'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stokskrng = $stoknya['stok'];

    //Mengambil qty dari tabel data_darah_masuk
    $qtyskrng = mysqli_query($conn, "SELECT * FROM data_darah_masuk WHERE idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrng);
    $qtyskrng = $qtynya['qty'];

    //Menghitung stok sekarang dengan qty baru
    if ($qty >= $qtyskrng && $qtyskrng > 0) {
        $tambahstoksekarangdenganquantity = $stokskrng + ($qty - $qtyskrng);
    } else {
        $tambahstoksekarangdenganquantity = $stokskrng;
    }

    //Melakukan update data masuk
    $updatemasuk = mysqli_query($conn, "UPDATE data_darah_masuk SET pendonor='$pendonor', qty='$qty' WHERE idmasuk='$idm' ");

    //Melakukan update stok masuk
    $updatestokmasuk = mysqli_query($conn, "UPDATE stok_darah SET stok='$tambahstoksekarangdenganquantity' WHERE id_stok='$idstok' ");
    
    //Cek apakah update berhasil atau tidak
    if($updatemasuk && $updatestokmasuk){
        header('Location: masuk.php');
    } else {
        echo 'Gagal';
        header('Location: masuk.php'); 
    }
}



//Menghapus data darah masuk
if(isset($_POST['hapusdatamasuk'])){
    $idstok = $_POST['id_stok'];
    $idm = $_POST['idmasuk'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['kty'];

    $getdatastok = mysqli_query($conn, "SELECT * from stok_darah where id_stok='$idstok' ");
    $data = mysqli_fetch_array($getdatastok);
    $stok = $data['stok'];

    //mengeluarkan data yang tidak jadi masuk
    $selisih = $stok-$qty;
    
    $update = mysqli_query($conn, "UPDATE stok_darah set stok='$selisih' where id_stok='$idstok'");
    $hapusdata = mysqli_query($conn, "DELETE from data_darah_masuk where idmasuk='$idm' ");

    if($update&&$hapusdata){
        header('Location: masuk.php');
    }else{
        header('Location: keluar.php');
    }
    
}

//mengubah data darah keluar

if(isset($_POST['updatedatakeluar'])){
    $idstok = $_POST['id_stok'];
    $idk = $_POST['idkeluar'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    //Mengambil stok dari tabel stok_darah
    $lihatstok = mysqli_query($conn, "SELECT * FROM stok_darah WHERE id_stok='$idstok'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stokskrng = $stoknya['stok'];

    //Mengambil qty dari tabel data_darah_keluar
    $qtyskrng = mysqli_query($conn, "SELECT * FROM data_darah_keluar WHERE idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrng);
    $qtyskrng = $qtynya['qty'];

    //Menghitung stok sekarang dengan qty baru
    if ($qty >= $qtyskrng && $qtyskrng > 0) {
        $tambahstoksekarangdenganquantity = $stokskrng - ($qty - $qtyskrng);
    } else {
        $tambahstoksekarangdenganquantity = $stokskrng;
    }

    //Melakukan update data keluar
    $updatemasuk = mysqli_query($conn, "UPDATE data_darah_keluar SET penerima='$penerima', qty='$qty' WHERE idkeluar='$idk' ");

    //Melakukan update stok keluar
    $updatestokmasuk = mysqli_query($conn, "UPDATE stok_darah SET stok='$tambahstoksekarangdenganquantity' WHERE id_stok='$idstok' ");
    
    //Cek apakah update berhasil atau tidak
    if($updatemasuk && $updatestokmasuk){
        header('Location: keluar.php');
    } else {
        echo 'Gagal';
        header('Location: keluar.php'); 
    }
}



//Menghapus data darah keluar
if(isset($_POST['hapusdatakeluar'])){
    $idstok = $_POST['id_stok'];
    $idk = $_POST['idkeluar'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['kty'];

    $getdatastok = mysqli_query($conn, "SELECT * from stok_darah where id_stok='$idstok' ");
    $data = mysqli_fetch_array($getdatastok);
    $stok = $data['stok'];

    //mengeluarkan data yang tidak jadi masuk
    $selisih = $stok+$qty;
    
    $update = mysqli_query($conn, "UPDATE stok_darah set stok='$selisih' where id_stok='$idstok'");
    $hapusdata = mysqli_query($conn, "DELETE from data_darah_keluar where idkeluar='$idk' ");

    if($update&&$hapusdata){
        header('Location: keluar.php');
    }else{
        header('Location: keluar.php');
    }
}

//Menambah data detail darah baru
if(isset($_POST['adddatadetail'])){
    $darahnya = $_POST['darahnya'];
    $goldar = $_POST['goldar'];
    $rhesus = $_POST['rhesus'];
    $produk = $_POST['produk'];

    $addtodetail = mysqli_query($conn, "INSERT into informasi_detail_darah (id_stok, goldar, rhesus, produk) values ('$darahnya', '$goldar', '$rhesus', '$produk') ");

    if($addtodetail){
        header('location:detaildarah.php');
    } else {
        echo 'Gagal';
        header('location:detaildarah.php'); 
    }
}

//update data detail darah
if(isset($_POST['updatedatadetail'])){
    $idstok = $_POST['id_stok'];
    $idd = $_POST['id_darah'];
    $goldar = $_POST['goldar'];
    $rhesus = $_POST['rhesus'];
    $produk = $_POST['produk'];

    $update = mysqli_query($conn, "UPDATE informasi_detail_darah SET goldar='$goldar', rhesus='$rhesus', produk='$produk' WHERE id_darah='$idd' ");
    
    if($update){
        header('location:detaildarah.php');
    } else {
        echo 'Gagal';
        header('location:detaildarah.php'); 
    }
}


//menghapus data detail
if(isset($_POST['hapusdatadetail'])){

    $idd = $_POST['id_darah'];

    $hapus = mysqli_query($conn, "DELETE from informasi_detail_darah where id_darah='$idd' ");
    
    if($hapus){
        header('location:detaildarah.php');
    } else {
        echo 'Gagal';
        header('location:detaildarah.php'); 
    }
}

//Menambah Admin

if(isset($_POST['addadmin'])){
    $username = $_POST['username'];
    $email  = $_POST['email'];
    $password  = $_POST['password'];

    $queryinsert = mysqli_query($conn, "insert into login (username, email, password) values ('$username','$email','$password') ");

    if($queryinsert){
        header('Location: admin.php'); 
    } else {
        header('Location: admin.php');
    }
}

//Update data admin
if(isset($_POST['updateadmin'])){
    $idu = $_POST['id_user'];
    $usernamebaru = $_POST['usernamebaru'];
    $emailbaru = $_POST['emailadmin'];
    $passwordbaru = $_POST['passwordbaru'];

    $update = mysqli_query($conn, "UPDATE login SET username='$usernamebaru', email='$emailbaru', password='$passwordbaru' WHERE id_user='$idu' ");
    
    if($update){
        header('location:admin.php');
    } else {
        echo 'Gagal';
        header('location:admin.php'); 
    }
}

//menghapus data admin
if(isset($_POST['hapusadmin'])){

    $idu = $_POST['id_user'];

    $hapus = mysqli_query($conn, "DELETE from login where id_user='$idu' ");
    
    if($hapus){
        header('location:admin.php');
    } else {
        echo 'Gagal';
        header('location:admin.php'); 
    }
}

//Menambah data detail stok darah baru
if(isset($_POST['adddatadetailstok'])){
    $darahnya = $_POST['darahnya'];
    $kadaluarsa = $_POST['kadaluarsa'];
    $suhu = $_POST['suhu'];
    $keterangan = $_POST['keterangan'];

    $addtodetail = mysqli_query($conn, "INSERT into detail_stok_darah (id_stok, kadaluarsa, suhu, keterangan_stok) values ('$darahnya', '$kadaluarsa', '$suhu', '$keterangan') ");

    if($addtodetail){
        header('location:detailstokdarah.php');
    } else {
        echo 'Gagal';
        header('location:detailstokdarah.php'); 
    }
}

//update data detail stok darah
if(isset($_POST['updatedatadetailstok'])){
    $idstok = $_POST['id_stok'];
    $idds = $_POST['id_detailstok'];
    $kadaluarsa = $_POST['kadaluarsa'];
    $suhu = $_POST['suhu'];
    $keteranganbaru = $_POST['keteranganbaru'];

    $update = mysqli_query($conn, "UPDATE detail_stok_darah SET kadaluarsa='$kadaluarsa', suhu='$suhu', keterangan_stok='$keteranganbaru' WHERE id_detailstok='$idds' ");
    
    if($update){
        header('location:detailstokdarah.php');
    } else {
        echo 'Gagal';
        header('location:detailstokdarah.php'); 
    }
}

//menghapus data detailstok
if(isset($_POST['hapusdatadetailstok'])){

    $idds = $_POST['id_detailstok'];

    $hapus = mysqli_query($conn, "DELETE from detail_stok_darah where id_detailstok='$idds' ");
    
    if($hapus){
        header('location:detailstokdarah.php');
    } else {
        echo 'Gagal';
        header('location:detailstokdarah.php'); 
    }
}




?>
