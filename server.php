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
		case 'get':
			$query_view = mysqli_query($con,"select * from kategori") or die (mysqli_error($con));
			$data_array = array();

			while ($data = mysqli_fetch_assoc($query_view)) {
				$data_array[] = $data;
			}

			echo json_encode($data_array);

			break;
		// Menampilkan data berdasarkan ID
		case 'get_id':
			@$id = $_GET['id'];
			$query_view = mysqli_query($con,"select * from kategori where id_kategori='".$id."'") or die (mysqli_error($con));
			$data_array = array();

			while ($data = mysqli_fetch_assoc($query_view)) {
				$data_array[] = $data;
			}

			echo json_encode($data_array);

			break;		
		// Memasukkan data ke dalam database
		case 'insert':
			@$nama_kategori = $_GET['nama_kategori'];

			$query_insert_data = mysqli_query($con,"insert into kategori (nama_kategori) values('".$nama_kategori."')");

			if ($query_insert_data) {
				echo "Data Berhasil Disimpan";
			}else {
				echo "Maaf, Insert Data Gagal\n".mysqli_error($con);
			}

			break;	
		// Mengubah Data sesuai ID
		case 'update':
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
		case 'delete':			
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