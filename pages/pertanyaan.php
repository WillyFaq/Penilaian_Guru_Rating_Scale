<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Pertanyaan & Pernyataan
        </h1>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    if(isset($_GET['ket'])){
                        $ket = $_GET['ket'];
                        echo '<h3>'.ucfirst($ket).' Pertanyaan & Pernyataan</h3>';
                        if($ket=='ubah'){
                            $id = mysql_real_escape_string(htmlspecialchars($_GET['id']));
                            $data = mysql_query("SELECT * FROM pertanyaan WHERE id_pertanyaan = '$id' ");
                            while ($row = mysql_fetch_array($data)) {
                                $id_kategori    = $row['id_kategori'];
                                $isi_pernyataan = $row['isi_pernyataan'];
                            }
                        }elseif($ket=='hapus'){
                            $id = mysql_real_escape_string(htmlspecialchars($_GET['id']));
                            $delete = mysql_query("UPDATE pertanyaan SET status = 1 WHERE id_pertanyaan = '$id' ");
                            if($delete){
                                pesan('index.php?p=pertanyaan', 'Data berhasil dinon aktifkan!');
                            }else{
                                pesan('index.php?p=pertanyaan', 'Data gagal dinon aktifkan!');
                            }
                        }elseif($ket=='aktif'){
                            $id = mysql_real_escape_string(htmlspecialchars($_GET['id']));
                            $delete = mysql_query("UPDATE pertanyaan SET status = 0 WHERE id_pertanyaan = '$id' ");
                            if($delete){
                                pesan('index.php?p=pertanyaan', 'Data berhasil di aktifkan!');
                            }else{
                                pesan('index.php?p=pertanyaan', 'Data gagal di aktifkan!');
                            }
                        }

                ?>
                    <form role="form" class="form-horizontal" action="model/p_pertanyaan.php" method="post">
                        <input type="hidden" name="id_pertanyaan" value="<?= isset($id)?"$id":''; ?>" >
                        <div class="form-group">
                            <label for="id_kategori" class="col-sm-2 control-label">Kategori</label>
                            <div class="col-sm-8">
                            	<select name="id_kategori" id="id_kategori" class="form-control">
                            		<option value="">[Pilih Kategori]</option>
                            		<?php
                            			$ev = mysql_query("SELECT * FROM kategori_penilaian_kinerja");
                            			while ($rev = mysql_fetch_array($ev)) {
                            				echo '<option value="'.$rev['id_kategori'].'"';
                            				echo isset($id_kategori) && $id_kategori==$rev['id_kategori']?'selected':'';
                            				echo '>';
                            				echo $rev['nama_kategori'];
                            				echo '</option>';
                            			}
                            		?>
                            	</select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="job" class="col-sm-2 control-label">Isi Pernyataan</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="isi_pernyataan" placeholder="Isi Pernyataan" name="isi_pernyataan" rows="8" required><?= isset($isi_pernyataan)?"$isi_pernyataan":''; ?></textarea>
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
                    <h3>Data Pertanyaan & Pernyataan</h3>
                    <a class="btn btn-primary" href="<?= base_url('&ket=tambah'); ?>">Tambah Data</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th width="50%">Pertanyaan & Pernyataan</th> 
                                <th>Status</th> 
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;
                                $data = mysql_query("SELECT * FROM pertanyaan a JOIN kategori_penilaian_kinerja b ON a.id_kategori = b.id_kategori ORDER BY nama_kategori");
                                while ($row = mysql_fetch_array($data)) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row['nama_kategori']; ?></td>
                                <td><?= $row['isi_pernyataan']; ?></td>
                                <td><?= $row['status']==0?'Aktif':'Tidak Aktif'; ?></td>
                                <td>
                                    <a href="<?= base_url("&ket=ubah&id=$row[id_pertanyaan]"); ?>" class="btn btn-success btn-xs" title="Ubah" data-toggle="tooltip" data-placement="top"><span class="fa fa-pencil"></span></a>
                                    <?php if($row['status']==0): ?>
                                    <a href="<?= base_url("&ket=hapus&id=$row[id_pertanyaan]"); ?>" class="btn btn-danger btn-xs" title="Non Aktif" data-toggle="tooltip" data-placement="top"><span class="fa fa-remove"></span></a>
                                    <?php else: ?>
                                    <a href="<?= base_url("&ket=aktif&id=$row[id_pertanyaan]"); ?>" class="btn btn-primary btn-xs" title="Aktif" data-toggle="tooltip" data-placement="top"><span class="fa fa-remove"></span></a>
                                    <?php endif; ?>
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