<?php
    require_once('../config/koneksi.php');
    if(isset($_GET['export'])){
        $idp =  $_GET['idp'];
        $per = mysql_query("SELECT * FROM periode WHERE id_periode = $idp");
        $rw = mysql_fetch_array($per);

    $fn = 'Laporan_penilaian_kinerja_'.$rw['nama_periode'];
    
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=$fn.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
    
?>
<style>
    h1, h2{
        margin:0;
    }
</style>
<h1>Laporan Penilaian Kinerja</h1>
<h2>SMA Muhammadyah 1 Taman Sidarjo</h1>
<?php
    echo '<h2>Periode : '.$rw['nama_periode'].'</h2>';
?>
<br>
<table class="table table-hover" border="1" cellspacing="0" cellpadding="10">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="150px">NIP</th>
                                <th width="300px">Nama</th>
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
                                if(isset($_GET['idp'])){
                                    $idp =  $_GET['idp'];
                                    $data = mysql_query("SELECT * FROM penilaian a JOIN data_guru b ON a.nip = b.nip WHERE id_periode = $idp ORDER BY total_skor ASC");
                                }else{
                                    $data = mysql_query("SELECT * FROM penilaian a JOIN data_guru b ON a.nip = b.nip  ORDER BY total_skor ASC");
                                }
                                while ($row = mysql_fetch_array($data)) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row['nip']; ?></td>
                                <td><?= $row['nama_guru']; ?></td>
                                <?php 
                                    $kat = mysql_query("SELECT * FROM kategori_penilaian_kinerja");
                                    while($rw = mysql_fetch_array($kat)):
                                ?> 
                                <td><?= get_skore($row['nip'], $rw['id_kategori']); ?></td>
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

<?php
    }else{
?>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th> 
                                <th>Skor Absen</th> 
                                <th>Skor Pertanyaan</th>
                                <th>Total Skor</th>
                                <th>Nilai Huruf</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;
                                if(isset($_GET['idp'])){
                                    $idp =  $_GET['idp'];
                                    $data = mysql_query("SELECT * FROM penilaian a JOIN data_guru b ON a.nip = b.nip WHERE id_periode = $idp ORDER BY total_skor ASC");
                                }else{
                                    $data = mysql_query("SELECT * FROM penilaian a JOIN data_guru b ON a.nip = b.nip ORDER BY total_skor ASC");
                                }
                                while ($row = mysql_fetch_array($data)) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row['nip']; ?></td>
                                <td><?= $row['nama_guru']; ?></td>
                                <td><?= number_format($row['skor_absen'],2); ?></td>
                                <td><?= number_format($row['skor_pertanyaan'],2); ?></td>
                                <td><?= number_format($row['total_skor'], 2); ?></td>
                                <td><?= nilai_huruf($row['total_skor']); ?></td>
                                <td><?= cek_status($row['id_penilaian'], $row['id_periode']); ?></td>
                                <td>
                                    <button id="<?= $row['id_penilaian']; ?>" class="btn btn-success btn-xs btn-detail" title="Detail" data-toggle="tooltip" data-placement="top"><span class="fa fa-eye"></span></button>
                                </td>
                            </tr>
                            <tr class="detail_box" id="box-<?= $row['id_penilaian']; ?>">
                                <td colspan="7"> 
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kategori</th>
                                                <th>Skor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        <?php 
                                            $kat = mysql_query("SELECT * FROM kategori_penilaian_kinerja");
                                            while($rw = mysql_fetch_array($kat)):
                                        ?>
                                        <tr>
                                            <td><?= $rw['nama_kategori']; ?></td>
                                            <td><?= get_skore($row['nip'], $rw['id_kategori']); ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>

<script type="text/javascript">
    $(document).ready(function(){
        $('.detail_box').hide();
        $('.btn-detail').click(function(){
            var id = $(this).attr('id');
            $('#box-'+id).toggle();
        });
    });
</script>

<?php } ?>

