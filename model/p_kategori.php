<?php
	require_once('../config/koneksi.php');
	if(isset($_POST['btnSimpan'])){
		$nama_kategori  = $_POST['nama_kategori'];
		$katerangan     = $_POST['katerangan'];
		$KET     		= $_POST['btnSimpan'];

		if($KET=='tambah'){
			$query = "INSERT INTO kategori_penilaian_kinerja (nama_kategori, katerangan) VALUES ('$nama_kategori', '$katerangan')";
			$insert = mysql_query($query);
			if($insert){
				pesan('../index.php?p=kategori', 'Data berhasil ditambahkan!');
			}else{
				pesan('../index.php?p=kategori', 'Data gagal ditambahkan! '.mysql_error());
			}
		}else if($KET=='ubah'){
			$id_kategori = $_POST['id_kategori'];
			$query = "UPDATE kategori_penilaian_kinerja SET 
						nama_kategori = '$nama_kategori', 
						katerangan = '$katerangan' 
						WHERE id_kategori = '$id_kategori'";
			$update = mysql_query($query);
			if($update){
				pesan('../index.php?p=kategori', 'Data berhasil diubah!');
			}else{
				pesan('../index.php?p=kategori', 'Data gagal diubah! '.mysql_error());
			}
		}
	}

?>