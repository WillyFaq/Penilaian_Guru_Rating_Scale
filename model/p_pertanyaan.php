<?php
	require_once('../config/koneksi.php');
	if(isset($_POST['btnSimpan'])){
		$id_kategori	= $_POST['id_kategori'];
		$isi_pernyataan = $_POST['isi_pernyataan'];
		$KET     		= $_POST['btnSimpan'];

		if($KET=='tambah'){
			$query = "INSERT INTO pertanyaan (id_kategori, isi_pernyataan) VALUES ('$id_kategori', '$isi_pernyataan')";
			$insert = mysql_query($query);
			if($insert){
				pesan('../index.php?p=pertanyaan', 'Data berhasil ditambahkan!');
			}else{
				//pesan('../index.php?p=pertanyaan', 'Data gagal ditambahkan! '.mysql_error());
			}

			echo $query;
		}else if($KET=='ubah'){
			$id_pertanyaan = $_POST['id_pertanyaan'];
			$query = "UPDATE pertanyaan SET 
						id_kategori = '$id_kategori', 
						isi_pernyataan = '$isi_pernyataan'
						WHERE id_pertanyaan = '$id_pertanyaan'";
			$update = mysql_query($query);
			if($update){
				pesan('../index.php?p=pertanyaan', 'Data berhasil diubah!');
			}else{
				pesan('../index.php?p=pertanyaan', 'Data gagal diubah! '.mysql_error());
			}
		}
	}

?>