<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Penilaian
        </h1>
        <h3>Periode : <?= get_periode_txt(); ?></h3>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <?php if(isset($_GET['id'])): 
                        $id = mysql_real_escape_string(htmlspecialchars($_GET['id']));
                        $data = mysql_query("SELECT * FROM data_guru WHERE nip = '$id' ");
                        while ($row = mysql_fetch_array($data)) {
                            $nama_guru      = $row['nama_guru'];
                            /*
                            $alamat         = $row['alamat'];
                            $tgl_lahir      = $row['tgl_lahir'];
                            $jenis_kelamin  = $row['jenis_kelamin'];
                            $status_kawin   = $row['status_kawin'];
                            $no_telp        = $row['no_telp'];
                            $status_guru    = $row['status_guru'];
                            $pendidikan_terakhir    = $row['pendidikan_terakhir'];
                            */
                        }
                    ?>
                    <div class="table-responsive">
                        <h3>Data Guru</h3>
                        <table class="table">
                            <tr><th width="20%">NIP</th><td>: <?= $id; ?></td></tr>
                            <tr><th>Nama</th><td>: <?= $nama_guru; ?></td></tr>
<!-- 
                            <tr><th>Alamat</th><td>: <?= $alamat; ?></td></tr>
                            <tr><th>Tanggal Lahir</th><td>: <?= date('d M Y', strtotime($tgl_lahir)); ?></td></tr>
                            <tr><th>Jenis Kelamin</th><td>: <?= $jenis_kelamin=='P'?'Pria':'Wanita'; ?></td></tr>
                            <tr><th>Status Kawin</th><td>: <?= $status_kawin=='K'?'Kawin':'Belum Kawin'; ?></td></tr>
                            <tr><th>No Telp</th><td>: <?= $no_telp; ?></td></tr>
                            <tr><th>Pendidikan Terakhir</th><td>: <?= $pendidikan_terakhir; ?></td></tr>
                            <tr><th>Status Guru</th><td>: <?= $status_guru; ?></td></tr>
                             -->
                        </table>
                    </div>

                    <?php if(get_hak_akses()==1 || get_hak_akses()==2){ ?>
                    <div class="table-responsive">
                        <h3>Peryataan</h3>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Skor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            <?php
                                $ket = get_hak_akses(); 
                                $kat = mysql_query("SELECT * FROM kategori_penilaian_kinerja WHERE keterangan = $ket");
                                while($row = mysql_fetch_array($kat)):
                            ?>
                            <tr>
                                <td><?= $row['nama_kategori']; ?></td>
                                <td><?= get_skore($id, $row['id_kategori']); ?></td>
                                <td><a href="index.php?p=penilaian&kategori=<?= $row['id_kategori']; ?>&nip=<?= $id; ?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a></td>
                            </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } ?>
                    <?php if(get_hak_akses()==3){ ?>
                    <div class="table-responsive">
                        <h3>Absensi</h3>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th width="10%">Skor</th>
                                    <td>: <?= get_skore_absen($id); ?></td>
                                    <th><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></button></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php } ?>
                    <?php elseif(isset($_GET['kategori'])): 

                            $id = mysql_real_escape_string(htmlspecialchars($_GET['nip']));
                            $data = mysql_query("SELECT * FROM data_guru WHERE nip = '$id' ");
                            while ($row = mysql_fetch_array($data)) {
                                $nama_guru      = $row['nama_guru'];
                                /*
                                $alamat         = $row['alamat'];
                                $tgl_lahir      = $row['tgl_lahir'];
                                $jenis_kelamin  = $row['jenis_kelamin'];
                                $status_kawin   = $row['status_kawin'];
                                $no_telp        = $row['no_telp'];
                                $status_guru    = $row['status_guru'];
                                $pendidikan_terakhir    = $row['pendidikan_terakhir'];
                                */
                            }
                    ?>
                        <div class="table-responsive">
                            <h3>Data Guru</h3>
                            <table class="table table-hover">
                                <tr><th width="20%">NIP</th><td>: <?= $id; ?></td></tr>
                                <tr><th>Nama</th><td>: <?= $nama_guru; ?></td></tr>
                                <!-- 
                                <tr><th>Alamat</th><td>: <?= $alamat; ?></td></tr>
                                <tr><th>Tanggal Lahir</th><td>: <?= date('d M Y', strtotime($tgl_lahir)); ?></td></tr>
                                <tr><th>Jenis Kelamin</th><td>: <?= $jenis_kelamin=='P'?'Pria':'Wanita'; ?></td></tr>
                                <tr><th>Status Kawin</th><td>: <?= $status_kawin=='K'?'Kawin':'Belum Kawin'; ?></td></tr>
                                <tr><th>No Telp</th><td>: <?= $no_telp; ?></td></tr>
                                <tr><th>Pendidikan Terakhir</th><td>: <?= $pendidikan_terakhir; ?></td></tr>
                                <tr><th>Status Guru</th><td>: <?= $status_guru; ?></td></tr>
                                 -->
                            </table>
                        </div>
                    <form action="model/p_penilaian.php" method="post">
                        <div class="table-responsive">
                            <h3>Peryataan</h3>
                            <table class="table table-hover table-bordered tbl-pertanyaan">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2" width="90%">Indikator</th>
                                        <th colspan="5">Skor</th>
                                    </tr>
                                    <tr class="tr-skor">
                                        <th>Sangat Kurang</th>
                                        <th>Kurang</th>
                                        <th>Cukup Baik</th>
                                        <th>Baik</th>
                                        <th>Sangat Baik</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" name="nip" value="<?= $_GET['nip']; ?>" >
                                    <?php
                                        $i=0;
                                        $idkat = mysql_real_escape_string(htmlspecialchars($_GET['kategori']));
                                        $per = mysql_query("SELECT * FROM pertanyaan WHERE id_kategori = $idkat ");
                                        while ($row = mysql_fetch_array($per)):
                                    ?>
                                    <tr>
                                        <input type="hidden" name="id_pertanyaan[]" value="<?= $row['id_pertanyaan']; ?>" >
                                        <td><?= ++$i; ?></td>
                                        <td><?= $row['isi_pernyataan']; ?></td>
                                        <td class="text-center"><input type="radio" class="rb-skore" name="<?= $row['id_pertanyaan']; ?>" value="1" <?= cek_pertanyaan($_GET['nip'], $row['id_pertanyaan'])==1?'checked':'' ?> ></td>
                                        <td class="text-center"><input type="radio" class="rb-skore" name="<?= $row['id_pertanyaan']; ?>" value="2" <?= cek_pertanyaan($_GET['nip'], $row['id_pertanyaan'])==2?'checked':'' ?> ></td>
                                        <td class="text-center"><input type="radio" class="rb-skore" name="<?= $row['id_pertanyaan']; ?>" value="3" <?= cek_pertanyaan($_GET['nip'], $row['id_pertanyaan'])==3?'checked':'' ?> ></td>
                                        <td class="text-center"><input type="radio" class="rb-skore" name="<?= $row['id_pertanyaan']; ?>" value="4" <?= cek_pertanyaan($_GET['nip'], $row['id_pertanyaan'])==4?'checked':'' ?> ></td>
                                        <td class="text-center"><input type="radio" class="rb-skore" name="<?= $row['id_pertanyaan']; ?>" value="5" <?= cek_pertanyaan($_GET['nip'], $row['id_pertanyaan'])==5?'checked':'' ?> ></td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="container btn-box">
                            <div class="row">
                                <div class="col-md-6"><a href="index.php?p=penilaian&id=<?= $_GET['nip']; ?>" class="btn btn-warning">Kembali</a></div>
                                <div class="col-md-6 text-right"><button type="submit" name="btnsimpan" class="btn btn-success">Simpan</button></div>
                            </div>
                        </div>
                    </form>
                    <?php else: ?>  
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th> 
                                <th>Telp</th> 
                                <th>Status Guru</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;
                                $data = mysql_query("SELECT * FROM data_guru");
                                while ($row = mysql_fetch_array($data)) {
                            ?>
                            <tr class="<?= (cek_diisi($row['nip']))?'strong-tr':''; ?>">
                                <td><?= $i; ?></td>
                                <td><?= $row['nip']; ?></td>
                                <td><?= $row['nama_guru']; ?></td>
                                <td><?= $row['no_telp']; ?></td>
                                <td><?= $row['status_guru']; ?></td>
                                <td>
                                    <a href="<?= base_url("&id=$row[nip]"); ?>" class="btn btn-success btn-xs" title="Isi Penilaian" data-toggle="tooltip" data-placement="top"><span class="fa fa-pencil"></span></a>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                    <div class="spacer"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Absensi</h4>
            </div>
            <div class="modal-body">
                <form method="post">
                    <input type="hidden" name="nip" value="<?= $_GET['id']; ?>">
                    <div class="form-group">
                        <label for="skor_absen">Skore Absensi</label>
                        <input type="number" class="form-control" id="skor_absen" name="skor_absen" placeholder="Skor" min="0" max="190">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['skor_absen'])){
        $skor_absen = $_POST['skor_absen'];
        $nip = $_POST['nip'];
        $idp = get_periode();
        $sql = mysql_query("SELECT * FROM penilaian WHERE nip = '$nip'");
        if(mysql_num_rows($sql)>0){

        
            $update = mysql_query("UPDATE penilaian SET skor_absen = $skor_absen WHERE nip = '$nip' AND id_periode = $idp");

            if($update){
                $sql = mysql_query("SELECT * FROM penilaian WHERE nip = '$nip' AND id_periode = $idp");
                $row = mysql_fetch_array($sql);
                if(update_total($row['id_penilaian'])){
                    pesan('index.php?p=penilaian&id='.$nip, 'Data berhasil disimpan!');
                }
            }else{
                pesan('index.php?p=penilaian&id='.$nip, 'Data gagal disimpan! '.mysql_error());
            }
        }else{
            pesan('index.php?p=penilaian&id='.$nip, 'Silahkan isi penilaian terlebih dahulu!');
        }

    }
?>

































