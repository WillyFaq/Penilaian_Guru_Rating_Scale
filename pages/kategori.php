<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Kategori Penilaian
        </h1>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    if(isset($_GET['ket'])){
                        $ket = $_GET['ket'];
                        echo '<h3>'.ucfirst($ket).' Kategori Penilaian</h3>';
                        if($ket=='ubah'){
                            $id = mysql_real_escape_string(htmlspecialchars($_GET['id']));
                            $data = mysql_query("SELECT * FROM kategori_penilaian_kinerja WHERE id_kategori = '$id' ");
                            while ($row = mysql_fetch_array($data)) {
                                $nama_kategori   = $row['nama_kategori'];
                                $keterangan      = $row['keterangan'];
                            }
                        }else if($ket=='hapus'){
                            $id = mysql_real_escape_string(htmlspecialchars($_GET['id']));
                            $delete = mysql_query("DELETE FROM kategori_penilaian_kinerja WHERE id_kategori = '$id' ");
                            if($delete){
                                pesan('index.php?p=kategori', 'Data berhasil dihapus!');
                            }else{
                                pesan('index.php?p=kategori', 'Data gagal dihapus! '.mysql_error());
                            }
                        }

                ?>
                    <form role="form" class="form-horizontal" action="model/p_kategori.php" method="post">
                        <input type="hidden" name="id_kategori" <?= isset($id)?"value='$id'":'required'; ?> >
                        <div class="form-group">
                            <label for="nama_kategori" class="col-sm-2 control-label">Nama Kategori</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_kategori" placeholder="Nama Kategori" name="nama_kategori" value="<?= isset($nama_kategori)?"$nama_kategori":''; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="keterangan" id="keterangan" required>
                                    <option value="1" <?= isset($keterangan) && $keterangan==1?"selected":''; ?> >Kepala Sekolah</option>
                                    <option value="2" <?= isset($keterangan) && $keterangan==2?"selected":''; ?>>Wakil Kepala Sekolah</option>
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
                    }else{
                ?>
                <div class="table-responsive">
                    <h3>Data Kategori Penilaian</h3>
                    <a class="btn btn-primary" href="<?= base_url('&ket=tambah'); ?>">Tambah Data</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th> 
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;
                                $data = mysql_query("SELECT * FROM kategori_penilaian_kinerja");
                                while ($row = mysql_fetch_array($data)) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row['nama_kategori']; ?></td>
                                <td><?= $row['keterangan']==1?'Kepala Sekolah':'Wakil Kepala Sekolah'; ?></td>
                                <td>
                                    <a href="<?= base_url("&ket=ubah&id=$row[id_kategori]"); ?>" class="btn btn-success btn-xs" title="Ubah" data-toggle="tooltip" data-placement="top"><span class="fa fa-pencil"></span></a>
                                    <a href="<?= base_url("&ket=hapus&id=$row[id_kategori]"); ?>" class="btn btn-danger btn-xs" title="Hapus" data-toggle="tooltip" data-placement="top"><span class="fa fa-trash"></span></a>
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