<?php
    require_once('../config/koneksi.php');
    if(isset($_GET['export'])){
        $id = mysql_real_escape_string(htmlspecialchars($_GET['nip']));
        $data = mysql_query("SELECT * FROM data_guru WHERE nip = '$id' ");
        while ($row = mysql_fetch_array($data)) {
            $nama_guru      = $row['nama_guru'];
            $alamat         = $row['alamat'];
            $tgl_lahir      = $row['tgl_lahir'];
            $jenis_kelamin  = $row['jenis_kelamin'];
            $status_kawin   = $row['status_kawin'];
            $no_telp        = $row['no_telp'];
            $status_guru    = $row['status_guru'];
            $pendidikan_terakhir    = $row['pendidikan_terakhir'];
        }
        $fn = 'Laporan_penilaian_kinerja_'.$id;
        
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=$fn.xls");
        header("Pragma: no-cache"); 
        header("Expires: 0");
        
?>
<style>
    h1, h2{
        margin:0;
    }
    .table-guru {
        margin-bottom: 30px;
    }
    .table-guru th{
        text-align: left;
    }
</style>
<h1>Laporan Penilaian Kinerja</h1>
<h2>SMA Muhammadyah 1 Taman Sidarjo</h1>
<br>
    <div class="table-responsive">
        <h3>Data Guru</h3>
        <table class="table-guru">
            <tr><th width="20%">NIP</th><td>: <?= $id; ?></td></tr>
            <tr><th>Nama</th><td>: <?= $nama_guru; ?></td></tr>
            <tr><th>Alamat</th><td>: <?= $alamat; ?></td></tr>
            <tr><th>Tanggal Lahir</th><td>: <?= date('d M Y', strtotime($tgl_lahir)); ?></td></tr>
            <tr><th>Jenis Kelamin</th><td>: <?= $jenis_kelamin=='P'?'Pria':'Wanita'; ?></td></tr>
            <tr><th>Status Kawin</th><td>: <?= $status_kawin=='K'?'Kawin':'Belum Kawin'; ?></td></tr>
            <tr><th>No Telp</th><td>: <?= $no_telp; ?></td></tr>
            <tr><th>Pendidikan Terakhir</th><td>: <?= $pendidikan_terakhir; ?></td></tr>
            <tr><th>Status Guru</th><td>: <?= $status_guru; ?></td></tr>
        </table>
    </div>
    <h3>Detail Penilaian</h3>
<table class="table table-hover" border="1" cellspacing="0" cellpadding="10">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="300px">Periode</th>
                                <?php 
                                    $kat = mysql_query("SELECT * FROM kategori_penilaian_kinerja");
                                    while($rw = mysql_fetch_array($kat)):
                                ?> 
                                <th><?= $rw['nama_kategori']; ?></th>
                                <?php endwhile; ?>
                                <th>Total Skor Pertanyaan</th>
                                <th>Skor Absen</th> 
                                <th>Total Skor</th>
                                <th>Nilai Huruf</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;
                                $data = mysql_query("SELECT * FROM penilaian a JOIN periode b ON a.id_periode = b.id_periode WHERE nip = '$id' ORDER BY nama_periode ASC");
                                while ($row = mysql_fetch_array($data)) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row['nama_periode']; ?></td>
                                <?php 
                                    $kat = mysql_query("SELECT * FROM kategori_penilaian_kinerja");
                                    while($rw = mysql_fetch_array($kat)):
                                ?> 
                                <td><?= get_skore_lap($row['nip'], $rw['id_kategori'], $row['id_periode']); ?></td>
                                <?php endwhile; ?>
                                <td><?= number_format($row['skor_absen'],2); ?></td>
                                <td><?= number_format($row['skor_pertanyaan'],2); ?></td>
                                <td><?= number_format($row['total_skor'], 2); ?></td>
                                <td><?= nilai_huruf($row['total_skor']); ?></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                    <br><br>
                    <table>
                        <tr>
                            <th>Surabaya, <?= date("d F Y"); ?></th>
                        </tr>
                        <tr></tr>
                        <tr>
                            <th>Kepala SMA Muhammadyah <br>1 Taman Sidarjo </th>
                        </tr>
                        <tr><th> <br><br><br> </th></tr>
                        <tr>
                            <th><u>NAMA</u></th>
                        </tr>
                        <tr>
                            <th><u>NIP: </u></th>
                        </tr>
                    </table>

<?php } ?>

