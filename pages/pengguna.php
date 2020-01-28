<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Pengguna
        </h1>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    if(isset($_GET['ket'])){
                        $ket = $_GET['ket'];
                        //--------------------------------- IKI DIGGANTI >=
                        if(get_hak_akses()==0){
                            echo '<h3>'.ucfirst($ket).' Pengguna</h3>';
                        }
                        if($ket=='ubah'){
                            $id = mysql_real_escape_string(htmlspecialchars($_GET['id']));
                            $data = mysql_query("SELECT * FROM pengguna WHERE username = '$id' ");
                            while ($row = mysql_fetch_array($data)) {
                                $password   = $row['password'];
                                $nama       = $row['nama'];
                                $hak_akses  = $row['hak_akses'];
                            }
                        }else if($ket=='hapus'){
                            $id = mysql_real_escape_string(htmlspecialchars($_GET['id']));
                            $delete = mysql_query("DELETE FROM pengguna WHERE username = '$id' ");
                            if($delete){
                                pesan('index.php?p=pengguna', 'Data berhasil dihapus!');
                            }else{
                                pesan('index.php?p=pengguna', 'Data gagal dihapus! '.mysql_error());
                            }
                        }

                ?>
                    <form role="form" class="form-horizontal" action="model/p_pengguna.php" method="post">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="username" placeholder="Username" name="username" <?= isset($id)?"value='$id' readonly":'required'; ?> >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="password" placeholder="Password" name="password" value="<?= isset($password)?"$password":''; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="<?= isset($nama)?"$nama":''; ?>" required>
                            </div>
                        </div>
                        <?php
                            if(get_hak_akses()==0){
                        ?>
                        <div class="form-group">
                            <label for="hak_akses" class="col-sm-2 control-label">Jabatan</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="hak_akses" name="hak_akses" required>
                                    <?php
                                        $pd = ['Admin', 'Kepala Sekolah', 'Wakil Kepala Sekolah', 'Tata Usaha'];
                                        foreach ($pd as $k => $v) {
                                            echo "<option value='$k'";
                                            if(isset($hak_akses) && $hak_akses==$v){
                                                echo "selected";
                                            }
                                            echo ">$v</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php }else{
                        ?>
                        <div class="form-group">
                            <label for="jabatan" class="col-sm-2 control-label">Jabatan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="jabatan" placeholder="Jabatan" name="jabatan" value="<?= get_jabatan($hak_akses) ?>" readonly >
                                <input type="hidden" class="form-control" id="jabat" placeholder="Jabatan" name="hak_akses" value="<?= $hak_akses ?>" required>
                            </div>
                        </div>
                        <?php
                            } 
                        ?>
                        <?php

                        //--------------------------------- IKI DIGGANTI get_hak_akses()>=0
                            if(get_hak_akses()==0){
                        ?>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" name="btnSimpan" value="<?= $ket; ?>">Simpan</button>
                            </div>
                        </div>
                        <?php } ?>
                    </form>
                <?php
                    }elseif(isset($_GET['detail'])){
                            $id = mysql_real_escape_string(htmlspecialchars($_GET['detail']));
                            $data = mysql_query("SELECT * FROM pengguna WHERE username = '$id' ");
                            while ($row = mysql_fetch_array($data)) {
                                $password   = $row['password'];
                                $nama       = $row['nama'];
                                $hak_akses  = $row['hak_akses'];
                            }
                ?>
                <div class="table-responsive">
                    <h3>Detail Data Pengguna</h3>
                    <table class="table table-hover">
                        <tr><th width="20%">Username</th><td>: <?= $id; ?></td></tr>
                        <tr><th>Password</th><td>: <?= $password; ?></td></tr>
                        <tr><th>Nama</th><td>: <?= $nama; ?></td></tr>
                        <tr><th>Jabatan</th><td>: <?= get_jabatan($hak_akses); ?></td></tr>
                    </table>
                    <a href="index.php?p=pengguna" class="btn btn-warning">Kembali</a>
                </div>
                <?php
                    }else{
                ?>
                <div class="table-responsive">
                    <h3>Data Pengguna</h3>
                    <a class="btn btn-primary" href="<?= base_url('&ket=tambah'); ?>">Tambah Data</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama</th> 
                                <th>Jabatan</th> 
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;
                                $data = mysql_query("SELECT * FROM pengguna");
                                while ($row = mysql_fetch_array($data)) {
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row['username']; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= get_jabatan($row['hak_akses']); ?></td>
                                <td>
                                    <a href="<?= base_url("&detail=$row[username]"); ?>" class="btn btn-primary btn-xs" title="Lihat" data-toggle="tooltip" data-placement="top"><span class="fa fa-eye"></span></a>
                                    <a href="<?= base_url("&ket=ubah&id=$row[username]"); ?>" class="btn btn-success btn-xs" title="Ubah" data-toggle="tooltip" data-placement="top"><span class="fa fa-pencil"></span></a>
                                    <a href="<?= base_url("&ket=hapus&id=$row[username]"); ?>" class="btn btn-danger btn-xs" title="Hapus" data-toggle="tooltip" data-placement="top"><span class="fa fa-trash"></span></a>
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