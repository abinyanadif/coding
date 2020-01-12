<?php

	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "perpus";
	$con = mysqli_connect($server,$username,$password) or die("<h1>Koneksi Mysqli Error :<h1>".mysqli_connect_error());

	mysqli_select_db($con,$database) or die("<h1>Koneksi Ke Database Error : </h1>".mysql_error($con));

	@$operasi = $_GET['operasi'];
	
	switch ($operasi) {
		// Menampilkan Semua Data
		case 'get_kategori':
			$query_view = mysqli_query($con,"select * from kategori order by id_kategori") or die (mysqli_error($con));
			$data_array = array();

			while ($data = mysqli_fetch_assoc($query_view)) {
				$data_array[] = $data;
			}

			echo json_encode($data_array);

			break;
		// Menampilkan data berdasarkan ID
		case 'get_id_kategori':
			@$id = $_GET['id'];
			$query_view = mysqli_query($con,"select * from kategori where id_kategori='".$id."' order by id_kategori") or die (mysqli_error($con));
			$data_array = array();

			while ($data = mysqli_fetch_assoc($query_view)) {
				$data_array[] = $data;
			}

			echo json_encode($data_array);

			break;		
		// Menampilkan Semua Data
		case 'get_admin':
			$query_view = mysqli_query($con,"select * from admin order by id_admin") or die (mysqli_error($con));
			$data_array = array();

			while ($data = mysqli_fetch_assoc($query_view)) {
				$data_array[] = $data;
			}

			echo json_encode($data_array);

			break;
		case 'get_id_admin':
			@$id = $_GET['id'];
			$query_view = mysqli_query($con,"select * from admin where id_admin='".$id."' order by id_admin") or die (mysqli_error($con));
			$data_array = array();

			while ($data = mysqli_fetch_assoc($query_view)) {
				$data_array[] = $data;
			}

			echo json_encode($data_array);

			break;
		// Menampilkan Semua Data
		case 'get_anggota':
			$query_view = mysqli_query($con,"select * from anggota order by id_anggota") or die (mysqli_error($con));
			$data_array = array();

			while ($data = mysqli_fetch_assoc($query_view)) {
				$data_array[] = $data;
			}

			echo json_encode($data_array);

			break;
		case 'get_id_anggota':
			@$id = $_GET['id'];
			$query_view = mysqli_query($con,"select * from anggota where id_anggota='".$id."' order by id_anggota") or die (mysqli_error($con));
			$data_array = array();

			while ($data = mysqli_fetch_assoc($query_view)) {
				$data_array[] = $data;
			}

			echo json_encode($data_array);

			break;		
		// Menampilkan Semua Data
		case 'get_buku':
			$query_view = mysqli_query($con,"SELECT *,kategori.nama_kategori FROM buku join kategori on buku.id_kategori = kategori.id_kategori order by buku.id_kategori asc") or die (mysqli_error($con));
			$data_array = array();

			while ($data = mysqli_fetch_assoc($query_view)) {
				$data_array[] = $data;
			}

			echo json_encode($data_array);

			break;
		case 'get_id_buku':
			@$id = $_GET['id'];
			$query_view = mysqli_query($con,"select * from buku where id_buku='".$id."' order by id_buku") or die (mysqli_error($con));
			$data_array = array();

			while ($data = mysqli_fetch_assoc($query_view)) {
				$data_array[] = $data;
			}

			echo json_encode($data_array);

			break;		
		// Memasukkan data ke dalam database
		case 'insert_buku':
			@$id_kategori = $_GET['id_kategori'];
			@$judul_buku = $_GET['judul_buku'];
			@$pengarang = $_GET['pengarang'];
			@$thn_terbit = $_GET['thn_terbit'];
			@$penerbit = $_GET['penerbit'];
			@$isbn = $_GET['isbn'];			
			@$jumlah_buku = $_GET['jumlah_buku'];
			@$lokasi = $_GET['lokasi'];
			@$tanggal = $_GET['tanggal'];

			$query_insert_data = mysqli_query($con,"insert into buku (id_kategori,judul_buku,pengarang,thn_terbit,penerbit,isbn,jumlah_buku,lokasi,gambar,tgl_input,status_buku) values('".$id_kategori."','".$judul_buku."','".$pengarang."','".$thn_terbit."','".$penerbit."','".$isbn."',".$jumlah_buku.",'".$lokasi."','','".$tanggal."','0')");

			if ($query_insert_data) {
				echo "Data Berhasil Disimpan";
			}else {
				echo "Maaf, Insert Data Gagal\n".mysqli_error($con);
			}

			break;
		// Mengubah Data sesuai ID
		case 'update_buku':
			@$id_kategori = $_GET['id_kategori'];
			@$judul_buku = $_GET['judul_buku'];
			@$pengarang = $_GET['pengarang'];
			@$thn_terbit = $_GET['thn_terbit'];
			@$penerbit = $_GET['penerbit'];
			@$isbn = $_GET['isbn'];			
			@$jumlah_buku = $_GET['jumlah_buku'];
			@$lokasi = $_GET['lokasi'];
			@$tanggal = $_GET['tanggal'];			
			@$id = $_GET['id'];

			$query_update_data = mysqli_query($con,"update buku set id_kategori='".$id_kategori."',judul_buku='".$judul_buku."',pengarang='".$pengarang."', thn_terbit='".$thn_terbit."', penerbit='".$penerbit."',isbn='".$isbn."', jumlah_buku=".$jumlah_buku.", lokasi='".$lokasi."', tgl_input='".$tanggal."' where id_buku='".$id."'");

			if ($query_update_data) {
				echo "Data Berhasil Diupdate";
			}else {
				echo "Maaf, Update Data Gagal\n".mysqli_error($con);
			}			
			break;			
		// Menghapus Data sesuai ID
		case 'delete_buku':			
			@$id = $_GET['id'];

			$query_delete_data = mysqli_query($con,"delete from buku where id_buku='".$id."'");

			if ($query_delete_data) {
				echo "Data Berhasil Dihapus";
			}else {
				echo "Maaf, Hapus Data Gagal\n".mysqli_error($con);
			}	
			break;					
		// Memasukkan data ke dalam database
		case 'insert_admin':
			@$nama_admin = $_GET['nama_admin'];
			@$username = $_GET['username'];
			@$password = md5($_GET['password']);

			$query_insert_data = mysqli_query($con,"insert into admin (nama_admin,username,password) values('".$nama_admin."','".$username."','".$password."')");

			if ($query_insert_data) {
				echo "Data Berhasil Disimpan";
			}else {
				echo "Maaf, Insert Data Gagal\n".mysqli_error($con);
			}

			break;		
		// Mengubah Data sesuai ID
		case 'update_admin':
			@$nama_admin = $_GET['nama_admin'];
			@$username = $_GET['username'];
			@$password = md5($_GET['password']);

			@$id = $_GET['id'];

			if (@$password = '') {
				$query_update_data = mysqli_query($con,"update admin set nama_admin='".$nama_admin."',username='".$username."' where id_admin='".$id."'");
			}else {
				$query_update_data = mysqli_query($con,"update admin set nama_admin='".$nama_admin."',username='".$username."',password='".$password."' where id_admin='".$id."'");
			}


			if ($query_update_data) {
				echo "Data Berhasil Diupdate";
			}else {
				echo "Maaf, Update Data Gagal\n".mysqli_error($con);
			}			
			break;
		// Menghapus Data sesuai ID
		case 'delete_admin':			
			@$id = $_GET['id'];

			$query_delete_data = mysqli_query($con,"delete from admin where id_admin='".$id."'");

			if ($query_delete_data) {
				echo "Data Berhasil Dihapus";
			}else {
				echo "Maaf, Hapus Data Gagal\n".mysqli_error($con);
			}	
			break;
		// Memasukkan data ke dalam database
		case 'insert_anggota':
			
			@$username = $_GET['username'];
			@$nama_anggota = $_GET['nama_anggota'];
			@$gender = $_GET['gender'];
			@$no_telp = $_GET['no_telp'];
			@$alamat = $_GET['alamat'];
			@$email = $_GET['email'];			
			@$password = md5($_GET['password']);

			$query_insert_data = mysqli_query($con,"insert into anggota (username,nama_anggota,gender,no_telp,alamat,email,password) values('".$username."','".$nama_anggota."','".$gender."','".$no_telp."','".$alamat."','".$email."','".$password."')");

			if ($query_insert_data) {
				echo "Data Berhasil Disimpan";
			}else {
				echo "Maaf, Insert Data Gagal\n".mysqli_error($con);
			}

			break;	
		// Mengubah Data sesuai ID
		case 'update_anggota':
			@$username = $_GET['username'];
			@$nama_anggota = $_GET['nama_anggota'];
			@$gender = $_GET['gender'];
			@$no_telp = $_GET['no_telp'];
			@$alamat = $_GET['alamat'];
			@$email = $_GET['email'];			
			@$password = md5($_GET['password']);

			@$id = $_GET['id'];

			if (@$password = '') {
				$query_update_data = mysqli_query($con,"update anggota set username='".$username."',nama_anggota='".$nama_anggota."',gender='".$gender."',no_telp='".$no_telp."',alamat='".$alamat."',email='".$email."' where id_anggota='".$id."'");
			}else {
				$query_update_data = mysqli_query($con,"update anggota set username='".$username."',nama_anggota='".$nama_anggota."',gender='".$gender."',no_telp='".$no_telp."',alamat='".$alamat."',email='".$email."',password='".$password."' where id_anggota='".$id."'");
			}

			if ($query_update_data) {
				echo "Data Berhasil Diupdate";
			}else {
				echo "Maaf, Update Data Gagal\n".mysqli_error($con);
			}			
			break;
		// Menghapus Data sesuai ID
		case 'delete_anggota':			
			@$id = $_GET['id'];

			$query_delete_data = mysqli_query($con,"delete from anggota where id_anggota='".$id."'");

			if ($query_delete_data) {
				echo "Data Berhasil Dihapus";
			}else {
				echo "Maaf, Hapus Data Gagal\n".mysqli_error($con);
			}	
			break;																						
		// Memasukkan data ke dalam database
		case 'insert_kategori':
			@$nama_kategori = $_GET['nama_kategori'];

			$query_insert_data = mysqli_query($con,"insert into kategori (nama_kategori) values('".$nama_kategori."')");

			if ($query_insert_data) {
				echo "Data Berhasil Disimpan";
			}else {
				echo "Maaf, Insert Data Gagal\n".mysqli_error($con);
			}

			break;
			
		// Mengubah Data sesuai ID
		case 'update_kategori':
			@$nama_kategori = $_GET['nama_kategori'];
			@$id = $_GET['id'];

			$query_update_data = mysqli_query($con,"update kategori set nama_kategori='".$nama_kategori."' where id_kategori='".$id."'");

			if ($query_update_data) {
				echo "Data Berhasil Diupdate";
			}else {
				echo "Maaf, Update Data Gagal\n".mysqli_error($con);
			}			
			break;
	
		// Menghapus Data sesuai ID
		case 'delete_kategori':			
			@$id = $_GET['id'];

			$query_delete_data = mysqli_query($con,"delete from kategori where id_kategori='".$id."'");

			if ($query_delete_data) {
				echo "Data Berhasil Dihapus";
			}else {
				echo "Maaf, Hapus Data Gagal\n".mysqli_error($con);
			}	
			break;							
		default:			
			break;
	}
?>
