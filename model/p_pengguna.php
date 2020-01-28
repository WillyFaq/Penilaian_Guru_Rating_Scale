<?php
	require_once('../config/koneksi.php');
	if(isset($_POST['btnSimpan'])){
		$username	= $_POST['username'];
		$password   = $_POST['password'];
		$nama       = $_POST['nama'];
		$hak_akses  = $_POST['hak_akses'];
		$KET     	= $_POST['btnSimpan'];

		if($KET=='tambah'){
			$query = "INSERT INTO pengguna (username, password, nama, hak_akses) VALUES ('$username', '$password', '$nama', $hak_akses)";
			$insert = mysql_query($query);
			if($insert){
				pesan('../index.php?p=pengguna', 'Data berhasil ditambahkan!');
			}else{
				$pp = mysql_error();
				pesan('../index.php?p=pengguna', 'Data gagal ditambahkan! '.$pp);
			}
		}elseif($KET=='ubah'){

			$query = "UPDATE pengguna SET password = '$password', nama = '$nama', hak_akses = $hak_akses WHERE username = '$username'";
			$update = mysql_query($query);
			if($update){
				if(get_hak_akses()==0){
					pesan('../index.php?p=pengguna', 'Data berhasil diubah!');
				}else{
					pesan('../index.php', 'Data berhasil diubah!');
				}
			}else{
				$pp = mysql_error();
				if(get_hak_akses()==0){
					pesan('../index.php?p=pengguna', 'Data gagal diubah! ');
				}else{
					pesan('../index.php', 'Data gagal diubah! ');
				}
			}
		}
	}

?>


