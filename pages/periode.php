<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Periode
        </h1>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    if(isset($_GET['ket'])){
                        $ket = $_GET['ket'];
                        echo '<h3>'.ucfirst($ket).' Periode</h3>';
                        if($ket=='ubah'){
                            $id = mysql_real_escape_string(htmlspecialchars($_GET['id']));
                            $data = mysql_query("SELECT * FROM periode WHERE id_periode = '$id' ");
                            while ($row = mysql_fetch_array($data)) {
                                $nama_periode = $row['nama_periode'];
                            }
                        }else if($ket=='hapus'){
                            $id = mysql_real_escape_string(htmlspecialchars($_GET['id']));
                            $delete = mysql_query("DELETE FROM periode WHERE id_periode = '$id' ");
                            if($delete){
                                pesan('index.php?p=periode', 'Data berhasil dihapus!');
                            }else{
                                pesan('index.php?p=periode', 'Data gagal dihapus! '.mysql_error());
                            }
                        }

                ?>
                    <form role="form" class="form-horizontal" action="model/p_periode.php" method="post">
                        <input type="hidden" name="id_periode" value="<?= isset($id)?$id:''; ?>" >
                        <div class="form-group">
                            <label for="nama_periode" class="col-sm-2 control-label">Periode</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_periode" placeholder="Periode" name="nama_periode" value="<?= isset($nama_periode)?"$nama_periode":''; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="batas_waktu" class="col-sm-2 control-label">Batas Waktu</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control tgl" id="batas_waktu" placeholder="Periode" name="batas_waktu" value="<?= isset($batas_waktu)?"$batas_waktu":''; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" name="btnSimpan" value="<?= $ket; ?>">Simpan</button>
                            </div>
                        </div>
                    </form>
                <?php
                    }else{
                ?>
                <div class="table-responsive">
                    <h3>Data Periode</h3>
                    <a class="btn btn-primary" href="<?= base_url('&ket=tambah'); ?>">Tambah Data</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Periode</th> 
                                <th>Bataas Waktu</th> 
                                <th>Status</th> 
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;
                                $data = mysql_query("SELECT * FROM periode");
                                while ($row = mysql_fetch_array($data)) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row['nama_periode']; ?></td>
                                <td><?= date("d-m-Y", strtotime($row['batas_waktu'])); ?></td>
                                <td><?= get_sts($row['sts']); ?></td>
                                <td>
                                    <?php if($row['sts']==0): ?>
                                    <a href="<?= base_url("&aktif=$row[id_periode]"); ?>" class="btn btn-success btn-xs" title="Aktif" data-toggle="tooltip" data-placement="top"><span class="fa fa-check"></span></a>
                                    <?php endif; ?>
                                    <a href="<?= base_url("&ket=ubah&id=$row[id_periode]"); ?>" class="btn btn-primary btn-xs" title="Ubah" data-toggle="tooltip" data-placement="top"><span class="fa fa-pencil"></span></a>
                                    <a href="<?= base_url("&ket=hapus&id=$row[id_periode]"); ?>" class="btn btn-danger btn-xs" title="Hapus" data-toggle="tooltip" data-placement="top"><span class="fa fa-trash"></span></a>
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

<?php
    if(isset($_GET['aktif'])){
        $a = $_GET['aktif'];
        $up = mysql_query("UPDATE periode SET sts = 0");
        $p = mysql_query("UPDATE periode SET sts = 1 WHERE id_periode = $a");
        if($p){
            pesan('index.php?p=periode', 'Periode berhasil diaktifkan!');
        }else{
            pesan('index.php?p=periode', 'Periode gagal diaktifkan! '.mysql_error());
        }
    }
?>