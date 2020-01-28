<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Guru
        </h1>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    if(isset($_GET['ket'])){
                        $ket = $_GET['ket'];
                        echo '<h3>'.ucfirst($ket).' Guru</h3>';
                        if($ket=='ubah'){
                            $id = mysql_real_escape_string(htmlspecialchars($_GET['id']));
                            $data = mysql_query("SELECT * FROM data_guru WHERE nip = '$id' ");
                            while ($row = mysql_fetch_array($data)) {
                                $nama_guru      = $row['nama_guru'];
                                $alamat         = $row['alamat'];
                                $tgl_lahir      = $row['tgl_lahir'];
                                $jenis_kelamin  = $row['jenis_kelamin'];
                                $status_kawin   = $row['status_kawin'];
                                $no_telp        = $row['no_telp'];
                                $status_guru    = $row['status_guru'];
                                $$status_guru    = $row['status_guru'];
                                $pendidikan_terakhir    = $row['pendidikan_terakhir'];
                            }
                        }else if($ket=='hapus'){
                            $id = mysql_real_escape_string(htmlspecialchars($_GET['id']));
                            $delete = mysql_query("DELETE FROM data_guru WHERE nip = '$id' ");
                            if($delete){
                                pesan('index.php?p=guru', 'Data berhasil dihapus!');
                            }else{
                                pesan('index.php?p=guru', 'Data gagal dihapus! '.mysql_error());
                            }
                        }

                ?>
                    <form role="form" class="form-horizontal" action="model/p_guru.php" method="post">
                        <div class="form-group">
                            <label for="nip" class="col-sm-2 control-label">NIP</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nip" placeholder="NIP" name="nip" <?= isset($id)?"value='$id' readonly":'required'; ?> >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_guru" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_guru" placeholder="Nama" name="nama_guru" value="<?= isset($nama_guru)?"$nama_guru":''; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="alamat" placeholder="Alamat" name="alamat" rows="5" required><?= isset($alamat)?"$alamat":''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_telp" class="col-sm-2 control-label">Telp</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="no_telp" placeholder="Telp" name="no_telp" value="<?= isset($no_telp)?"$no_telp":''; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir" class="col-sm-2 control-label">Tanggal Lahir</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control tgl" id="tgl_lahir" placeholder="Tanggal Lahir" name="tgl_lahir" value="<?= isset($tgl_lahir)?"$tgl_lahir":''; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin</label>
                            <div class="col-sm-8">
                                <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="P" <?= isset($jenis_kelamin) && $jenis_kelamin=='P'?'checked':""; ?> > Pria &nbsp;&nbsp;
                                <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="W" <?= isset($jenis_kelamin) && $jenis_kelamin=='W'?'checked':""; ?> > Wanita
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status_kawin" class="col-sm-2 control-label">Status Kawin</label>
                            <div class="col-sm-8">
                                <input type="radio" id="status_kawin" name="status_kawin" value="K" <?= isset($status_kawin) && $status_kawin=='K'?'checked':""; ?> > Kawin &nbsp;&nbsp;
                                <input type="radio" id="status_kawin" name="status_kawin" value="B" <?= isset($status_kawin) && $status_kawin=='B'?'checked':""; ?> > Belum Kawin
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pendidikan_terakhir" class="col-sm-2 control-label">Pendidikan Terakhir</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                                    <?php
                                        $pd = ['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'];
                                        foreach ($pd as $k => $v) {
                                            echo "<option value='$v'";
                                            if(isset($pendidikan_terakhir) && $pendidikan_terakhir==$v){
                                                echo "selected";
                                            }
                                            echo ">$v</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status_guru" class="col-sm-2 control-label">Status Guru</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="status_guru" name="status_guru" required>
                                    <option value="Honorer" <?= isset($Honorer)?'selected':''; ?> >Honorer</option>
                                    <option value="Tetap" <?= isset($Tetap)?'selected':''; ?> >Tetap</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" name="btnSimpan" value="<?= $ket; ?>">Simpan</button>
                            </div>
                        </div>
                    </form>
                <?php
                    }elseif(isset($_GET['detail'])){
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
                    <h3>Detail Data Guru</h3>
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
                    <a href="index.php?p=guru" class="btn btn-warning">Kembali</a>
                </div>
                <?php
                    }else{
                ?>
                <div class="table-responsive">
                    <h3>Data Guru</h3>
                    <a class="btn btn-primary" href="<?= base_url('&ket=tambah'); ?>">Tambah Data</a>
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
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row['nip']; ?></td>
                                <td><?= $row['nama_guru']; ?></td>
                                <td><?= $row['no_telp']; ?></td>
                                <td><?= $row['status_guru']; ?></td>
                                <td>
                                    <a href="<?= base_url("&detail=$row[nip]"); ?>" class="btn btn-primary btn-xs" title="Lihat" data-toggle="tooltip" data-placement="top"><span class="fa fa-eye"></span></a>
                                    <a href="<?= base_url("&ket=ubah&id=$row[nip]"); ?>" class="btn btn-success btn-xs" title="Ubah" data-toggle="tooltip" data-placement="top"><span class="fa fa-pencil"></span></a>
                                    <a href="<?= base_url("&ket=hapus&id=$row[nip]"); ?>" class="btn btn-danger btn-xs" title="Hapus" data-toggle="tooltip" data-placement="top"><span class="fa fa-trash"></span></a>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>