<?php
	require_once('../config/koneksi.php');
	if(isset($_POST['btnsimpan'])){

		$okedeh= true;

		foreach ($_POST['id_pertanyaan'] as $key => $value) {
			if(isset($_POST[$value])){
				$skore = $_POST[$value];
				$idp = cek_penilaian($_POST['nip']);
				
				if($idp=='0'){
					$_idp = gen_kode_per();
					//echo $_idp;
					$nip = $_POST['nip'];
					$idper = get_periode();
					$insert = mysql_query("INSERT INTO penilaian (id_penilaian, id_periode, nip) VALUES('$_idp', $idper, '$nip')");
					//echo "INSERT INTO penilaian (id_penilaian, id_periode, nip) VALUES('$_idp', $idper, '$nip')<br>";
					if($insert){
						$in_det = mysql_query("INSERT INTO detail_penilaian (id_penilaian, id_pertanyaan, skor) VALUES('$_idp', $value, $skore)");
					}else{
						echo mysql_error();
						$okedeh = false;
						break;
					}

				}else{
					$idd = cek_detail_nilai($value, $idp);
					if($idd=='0'){
						$in_det = mysql_query("INSERT INTO detail_penilaian (id_penilaian, id_pertanyaan, skor) VALUES('$idp', $value, $skore)");
					}else{
						$up_det = mysql_query("UPDATE detail_penilaian SET skor = $skore WHERE id_detail_penilaian = $idd");
					}
					hit_total($idp);
					update_total($idp);
				}
			}
		}

		if($okedeh){
			pesan('../index.php?p=penilaian&id='.$_POST['nip'], 'Data berhasil disimpan!');
		}else{
			pesan('../index.php?p=penilaian', 'Data gagal disimpan! '.mysql_error());
		}
	}

	function hit_total($idp='')
	{
		$tot = 0;
		$i=0;
		$k = mysql_query("SELECT * FROM kategori_penilaian_kinerja");
		$i = mysql_num_rows($k);
		$p = mysql_query("SELECT b.id_kategori, AVG(skor) AS rat FROM detail_penilaian a JOIN pertanyaan b ON a.id_pertanyaan = b.id_pertanyaan WHERE a.id_penilaian = '$idp' GROUP BY b.id_kategori");
		while($row = mysql_fetch_array($p)){
			$tot += ($row['rat']/$i);
		}
		$up = mysql_query("UPDATE penilaian SET skor_pertanyaan = $tot WHERE id_penilaian = '$idp'");
		if($up){
			//echo "OKE";
		}else{
			//echo "GGL ".mysql_error();
		}
	}

?>