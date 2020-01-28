<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Laporan Penilaian Per-Guru
        </h1>
        <div class="row">
            <?php if(isset($_GET['detail'])): ?>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <a id="link_export" target="blank" href="pages/data_penilaian_guru.php?nip=<?= $_GET['detail']; ?>&export=true" class="btn btn-success pull-right" ><i class="fa fa-file-excel-o"></i> Export</a>
            </div>
            <div class="col-lg-12">
                <hr>
                <?php
                    $id = mysql_real_escape_string(htmlspecialchars($_GET['detail']));
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
                ?>
                <div class="table-responsive">
                    <h3>Data Guru</h3>
                    <table class="table table-hover">
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
                <div class="table-responsive"> 
                    <h3>Detail Penilaian </h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Periode</th> 
                                <th>Skor Absen</th> 
                                <th>Skor Pertanyaan</th> 
                                <th>Total Skor</th> 
                                <th>Nilai Huruf</th> 
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;
                                $data = mysql_query("SELECT * FROM penilaian a JOIN periode b ON a.id_periode = b.id_periode WHERE nip = '$id'");
                                while ($row = mysql_fetch_array($data)) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row['nama_periode']; ?></td>
                                <td><?= number_format($row['skor_absen'],2); ?></td>
                                <td><?= number_format($row['skor_pertanyaan'],2); ?></td>
                                <td><?= number_format($row['total_skor'], 2); ?></td>
                                <td><?= nilai_huruf($row['total_skor']); ?></td>
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
                                            <td><?= get_skore_lap($row['nip'], $rw['id_kategori'], $row['id_periode']); ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                    <a href="index.php?p=lap_penilaian_guru" class="btn btn-warning">Kembali</a>
                    <div class="spacer"></div>
                </div>
            </div>
            <?php else: ?>
            <div class="col-lg-12">
            <hr>
                <div class="table-responsive"> 
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th> 
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;
                                $data = mysql_query("SELECT a.nip, a.nama_guru, SUM(b.total_skor) total FROM data_guru a LEFT JOIN penilaian b ON a.nip = b.nip GROUP BY a.nama_guru ORDER BY 3 ASC");
                                while ($row = mysql_fetch_array($data)) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row['nip']; ?></td>
                                <td><?= $row['nama_guru']; ?></td>
                                <td>
                                    <a href="index.php?p=lap_penilaian_guru&detail=<?= $row['nip']; ?>" class="btn btn-success btn-xs btn-detail" title="Detail" data-toggle="tooltip" data-placement="top"><span class="fa fa-eye"></span></a>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                    <div class="spacer"></div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('.detail_box').hide();
        $('.btn-detail').click(function(){
            var id = $(this).attr('id');
            $('#box-'+id).toggle();
        });
    });
</script>