<?php
	require_once('../config/koneksi.php');
	if(isset($_POST['btnSimpan'])){
		$nama_periode = $_POST['nama_periode'];
		$batas_waktu = $_POST['batas_waktu'];
		$KET = $_POST['btnSimpan'];   
		if($KET=='tambah'){
			$query = "INSERT INTO periode (nama_periode, batas_waktu) VALUES ('$nama_periode', '$batas_waktu')";
			$insert = mysql_query($query);
			if($insert){
				pesan('../index.php?p=periode', 'Data berhasil ditambahkan!');
			}else{

				$pp = mysql_error();
				echo $pp;
				pesan('../index.php?p=periode', 'Data gagal ditambahkan! '.$pp);
			}
		}elseif($KET=='ubah'){
			$id_periode = $_POST['id_periode'];
			$query = "UPDATE periode SET nama_periode = '$nama_periode', batas_waktu = '$batas_waktu' WHERE id_periode = '$id_periode'";
			$update = mysql_query($query);
			if($update){
				pesan('../index.php?p=periode', 'Data berhasil diubah!');
			}else{
				$pp = mysql_error();
				pesan('../index.php?p=periode', 'Data gagal diubah! '.$pp);
			}
		}
	}

?>


