<?php
	require_once('../config/koneksi.php');
	if(isset($_POST['btnSimpan'])){
		$nip         			= $_POST['nip'];
		$nama_guru     			= $_POST['nama_guru'];
		$alamat 	  			= $_POST['alamat'];
		$tgl_lahir    	 		= $_POST['tgl_lahir'];
		$jenis_kelamin     		= $_POST['jenis_kelamin'];
		$status_kawin     		= $_POST['status_kawin'];
		$no_telp     			= $_POST['no_telp'];
		$status_guru     		= $_POST['status_guru'];
		$pendidikan_terakhir	= $_POST['pendidikan_terakhir'];
		$KET     				= $_POST['btnSimpan'];

		if($KET=='tambah'){
			$query = "INSERT INTO data_guru (nip, nama_guru, alamat, tgl_lahir, jenis_kelamin, status_kawin, no_telp, status_guru, pendidikan_terakhir) VALUES ('$nip', '$nama_guru', '$alamat', '$tgl_lahir', '$jenis_kelamin', '$status_kawin', '$no_telp', '$status_guru', '$pendidikan_terakhir')";
			$insert = mysql_query($query);
			if($insert){
				pesan('../index.php?p=guru', 'Data berhasil ditambahkan!');
			}else{
				pesan('../index.php?p=guru', 'Data gagal ditambahkan! '.mysql_error());
			}
		}elseif($KET=='ubah'){
			$query = "UPDATE data_guru SET nama_guru = '$nama_guru', alamat = '$alamat', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', status_kawin = '$status_kawin', no_telp = '$no_telp', status_guru = '$status_guru', pendidikan_terakhir = '$pendidikan_terakhir' WHERE nip = '$nip'";

			$update = mysql_query($query);
			if($update){
				pesan('../index.php?p=guru', 'Data berhasil diubah!');
			}else{
				$pp = mysql_error();
				pesan('../index.php?p=guru', 'Data gagal diubah! '.$pp);
			}
		}
	}

?>


