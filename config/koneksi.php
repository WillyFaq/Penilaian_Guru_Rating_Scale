<?php
	session_start();
	date_default_timezone_set('Asia/Jakarta');
	$host	= 'localhost';
	$user	= 'root';
	$pass	= '';
	$db		= 'dbpenilaian_kinerja';
	
	if(mysql_connect($host, $user, $pass)){
		if(!mysql_select_db($db)){
			echo 'kesalahan koneksi database '.mysql_error();
		}
	}else{
		echo 'kesalahan server '.mysql_error();
	}

	function base_url($value='')
	{
		$root = "http://".$_SERVER['HTTP_HOST'];
        $root .= $_SERVER['REQUEST_URI'];
        $root .= $value;
        return  $root;
	}

	function pesan($v, $m)
	{
		echo '<script>';
		if($v==''){
			echo "alert('$m');";
		}else if($m==''){
			echo "document.location='$v';";
		}else{
			echo "alert('$m');";
			echo "document.location='$v';";
		}
		echo '</script>';
	}

	function get_user()
	{
		$v = $_SESSION[md5('admin')];
		$data = mysql_query("SELECT * FROM pengguna WHERE username = '$v' ");
		$row = mysql_fetch_array($data);
        return  $row['nama'];
	}

	function get_hak_akses()
	{
		$v = $_SESSION[md5('admin')];
		$data = mysql_query("SELECT * FROM pengguna WHERE username = '$v' ");
		$row = mysql_fetch_array($data);
        return  $row['hak_akses'];
	}

	function get_sts($v='')
	{
		switch ($v) {
			case '0':
				$ret = '<p class="label label-default">TIDAK AKTIF</p>';
				break;
			case '1':
				$ret = '<p class="label label-success">AKTIF</p>';
				break;
			default:
				break;
		}
		return $ret;
	}

	function get_periode()
	{
		$q = mysql_query("SELECT * FROM periode WHERE sts = 1");
		$row = mysql_fetch_array($q);
		return $row['id_periode'];
	}

	function get_batas_periode()
	{
		$q = mysql_query("SELECT * FROM periode WHERE sts = 1");
		$row = mysql_fetch_array($q);
		return $row['batas_waktu'];
	}

	function get_periode_txt()
	{
		$q = mysql_query("SELECT * FROM periode WHERE sts = 1");
		$row = mysql_fetch_array($q);
		return $row['nama_periode'];
	}

	function gen_kode_per()
	{
        $q = mysql_query("SELECT * FROM penilaian");
        $nr = mysql_num_rows($q)+1;
        $nn = '000000000000000'.$nr;
        $nop = 'PN'.substr($nn, strlen($nn)-13, 13);
        while(cek_kode($nop)){
            $nr++;
        	$nn = '000000000000000'.$nr;
        	$nop = 'PN'.substr($nn, strlen($nn)-13, 13);
        }
        return $nop;
	}

	function cek_kode($v)
    {
        $q = mysql_query("SELECT * FROM penilaian WHERE id_penilaian = '$v'");
        if(mysql_num_rows($q)>0){
            return true;
        }else{
            return false;
        }
    }

	function get_skore($idg='', $idk='')
	{
		$p = mysql_query("SELECT * FROM pertanyaan WHERE id_kategori = $idk");
		$cp = mysql_num_rows($p);
		$idper = get_periode();
		$n = mysql_query("SELECT * FROM penilaian a JOIN detail_penilaian b ON a.id_penilaian = b.id_penilaian JOIN pertanyaan c ON b.id_pertanyaan = c.id_pertanyaan WHERE nip = '$idg' AND c.id_kategori = $idk AND id_periode = $idper");
		$cn = mysql_num_rows($n);
		$ret='';
		if($cn==0){
			$ret .= 'belum diisi';
		}else{
			$ret .= $cn.'/'.$cp;
		}
		
		if($cn==$cp){
			$sk=0;
			while($row = mysql_fetch_array($n)){
				$sk += $row['skor'];
			}
			$ts = $sk/$cn;
			$ret = number_format($ts, 2);
		}
		return $ret;
	}



	function get_skore_lap($idg='', $idk='', $idper='')
	{
		$p = mysql_query("SELECT * FROM pertanyaan WHERE id_kategori = $idk");
		$cp = mysql_num_rows($p);
		//$idper = get_periode();
		$n = mysql_query("SELECT * FROM penilaian a JOIN detail_penilaian b ON a.id_penilaian = b.id_penilaian JOIN pertanyaan c ON b.id_pertanyaan = c.id_pertanyaan WHERE nip = '$idg' AND c.id_kategori = $idk AND id_periode = $idper");
		$cn = mysql_num_rows($n);
		$ret='';
		if($cn==0){
			$ret .= 'belum diisi';
		}else{
			$ret .= $cn.'/'.$cp;
		}
		
		if($cn==$cp){
			$sk=0;
			while($row = mysql_fetch_array($n)){
				$sk += $row['skor'];
			}
			$ts = $sk/$cn;
			$ret = number_format($ts, 2);
		}
		return $ret;
	}

	function cek_status($idp='',  $idper='')
	{	
		$p = mysql_query("SELECT * FROM pertanyaan");
		$cp = mysql_num_rows($p);
		$sql = "SELECT * FROM penilaian a JOIN detail_penilaian b ON a.id_penilaian = b.id_penilaian JOIN pertanyaan c ON b.id_pertanyaan = c.id_pertanyaan WHERE a.id_penilaian = '$idp' AND id_periode = $idper";
		$n = mysql_query($sql);
		$cn = mysql_num_rows($n);
		$ret = '';
		if($cp==$cn){
			$ret = 'Lengkap';
			while($row = mysql_fetch_array($n)){
				if($row['skor_absen']==0 || $row['skor_absen']==null){
					$ret = 'Belum lengkap';
				}
			}
		}else{
			$ret = 'Belum lengkap';
		}
		
		return $ret;
	}

	function cek_pertanyaan($idg='', $idp='')
	{	
		$idper = get_periode();
		$n = mysql_query("SELECT * FROM penilaian a JOIN detail_penilaian b ON a.id_penilaian = b.id_penilaian JOIN pertanyaan c ON b.id_pertanyaan = c.id_pertanyaan WHERE nip = '$idg' AND c.id_pertanyaan = $idp AND id_periode = $idper");
		$cn = mysql_num_rows($n);
		if($cn==0){
			return 0;
		}
		$row = mysql_fetch_array($n);
		return $row['skor'];
	}

	function cek_penilaian($nip='')
	{
		$idper = get_periode();
		$n = mysql_query("SELECT * FROM penilaian WHERE nip = '$nip' AND id_periode = $idper");
		$cn = mysql_num_rows($n);
		if($cn==0){
			return 0;
		}
		$row = mysql_fetch_array($n);
		return $row['id_penilaian'];
	}

	function cek_detail_nilai($idd='', $idp='')
	{
		$n = mysql_query("SELECT * FROM detail_penilaian WHERE id_penilaian = '$idp' AND id_pertanyaan = $idd");
		$cn = mysql_num_rows($n);
		if($cn==0){
			return 0;
		}
		$row = mysql_fetch_array($n);
		return $row['id_detail_penilaian'];
	}

	function get_skore_absen($idg='')
	{
		$idper = get_periode();
		$n = mysql_query("SELECT * FROM penilaian WHERE nip = '$idg' AND id_periode = $idper");
		$cn = mysql_num_rows($n);

		if($cn==0){
			$ret = '0';
		}else{
			$row = mysql_fetch_array($n);
			$ret = $row['skor_absen'];
		}
		return $ret;
	}

	function update_total($id_penilaian='')
	{
		$q = mysql_query("SELECT * FROM penilaian WHERE id_penilaian = '$id_penilaian'");
		$row = mysql_fetch_array($q);
		$tot = ($row['skor_absen']*0.6) + ($row['skor_pertanyaan']*0.4);

		$up = mysql_query("UPDATE penilaian SET total_skor = $tot WHERE id_penilaian = '$id_penilaian'");
		return $up;
	}

	function get_jabatan($v='')
	{
		switch ($v) {
			case '0':
				return 'Admin';
				break;
			case '1':
				return 'Kepala Sekolah';
				break;
			case '2':
				return 'Wakil Kepala Sekolah';
				break;
			case '3':
				return 'Tata Usaha';
				break;
			
			default:
				# code...
				break;
		}
	}

	function cek_diisi($nip="")
	{
		$ha = get_hak_akses();
		$idper = get_periode();
		if($ha<3){
			$sql = "SELECT * FROM penilaian a";
			$sql .= " JOIN detail_penilaian b ON a.id_penilaian = b.id_penilaian";
			$sql .= " JOIN pertanyaan c ON b.id_pertanyaan = c.id_pertanyaan";
			$sql .= " JOIN kategori_penilaian_kinerja d ON c.id_kategori = d.id_kategori";
			$sql .= " WHERE a.nip = '$nip' AND d.keterangan = $ha AND a.id_periode = $idper";
			//echo $sql;
			$q = mysql_query($sql);
			if(mysql_num_rows($q)>0){
				$sql2 = "SELECT * FROM kategori_penilaian_kinerja WHERE keterangan = $ha";
				$q2 = mysql_query($sql2);
				$nk = mysql_num_rows($q2);
				$nn = 0;
				while($row=mysql_fetch_array($q2)){
					$idk = $row['id_kategori'];
					$sql3 = "SELECT * FROM penilaian a";
					$sql3 .= " JOIN detail_penilaian b ON a.id_penilaian = b.id_penilaian";
					$sql3 .= " JOIN pertanyaan c ON b.id_pertanyaan = c.id_pertanyaan";
					$sql3 .= " WHERE a.nip = '$nip' AND c.id_kategori = $idk AND a.id_periode = $idper";
					$q3 = mysql_query($sql3);
					if(mysql_num_rows($q3)>0){
						$nn++;
					}
				}
				if($nn>=$nk){
					return true;
				}
			}
			return false;
		}else{
			$sql = "SELECT * FROM penilaian";
			$sql .= " WHERE nip = '$nip' AND skor_absen > 0 AND id_periode = $idper";
			//echo $sql;
			$q = mysql_query($sql);
			if(mysql_num_rows($q)>0){
				return true;
			}
			return false;
		}
	}


	function nilai_huruf($v='')
	{
		if($v<=100 && $v>=80){
			return 'A';
		}else if($v<=79 && $v>=75){
			return 'B+';
		}else if($v<=74 && $v>=65){
			return 'B';
		}else if($v<=64 && $v>=60){
			return 'C+';
		}else if($v<=59 && $v>=55){
			return 'C';
		}else if($v<=54 && $v>=40){
			return 'D';
		}else{
			return 'E';
		}
	}

	function get_num_penilaian()
	{
		if(get_hak_akses()==1){
        	$ket = "1";
        }else if(get_hak_akses()==2){
        	$ket = "2";
        }else{
        	$ket = "0";
        } 

		$idper = get_periode();

		$sql = "SELECT * FROM penilaian a";
		$sql .= " JOIN detail_penilaian b ON a.id_penilaian = b.id_penilaian";
		$sql .= " JOIN pertanyaan c ON b.id_pertanyaan = c.id_pertanyaan";
		$sql .= " JOIN kategori_penilaian_kinerja d ON c.id_kategori = d.id_kategori";
		$sql .= " WHERE d.keterangan = $ket AND a.id_periode = $idper";
		$n = mysql_query($sql);
		$cn = mysql_num_rows($n);

		$sql = "SELECT * FROM pertanyaan a";
		$sql .= " JOIN kategori_penilaian_kinerja b ON a.id_kategori = b.id_kategori";
		$sql .= " WHERE b.keterangan = $ket";
		$p = mysql_query($sql);
		$cp = mysql_num_rows($p);

		if(get_hak_akses()==3){ 
        	$sql = "SELECT skor_absen FROM penilaian";
			$sql .= " WHERE id_periode = $idper";
			$n = mysql_query($sql);
			while($row = mysql_fetch_array($n)){
				if($row['skor_absen']<=0){
					return false;
				}
				$cn = 10;
				$cp = 1;
			}
        }

		if($cn<=0){
			return false;
		}else if($cn<$cp){
			return false;
		}else{
			return true;
		}
	}
?>