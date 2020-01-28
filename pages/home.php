

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Beranda 
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-home"></i> Beranda
            </li>

        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">

            <!-- <div class="alert alert-info alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 id="warning-alert">Pengumuman!</h4>
                <p>Batas Waktu Pengisian penilaian untuk periode <strong><?= get_periode_txt(); ?></strong>   </p>
            </div> -->
        <?php 
            if(!get_num_penilaian()){
        ?>
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 id="warning-alert">Peringatan!</h4>
                <p>Anda belum/belum lengkap memberikan penilaian untuk periode <strong><?= get_periode_txt(); ?></strong> </p>
                <p>Batas waktu pengisisan penilaian adalah sampai dengan  <strong> <?= date('d-m-Y', strtotime(get_batas_periode())); ?></strong></p>
            </div>
        <?php
            }
        ?>
    </div>
    <div class="col-lg-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Filter
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Periode : </label>
                    <select class="form-control" name="periode" id="periode_filter">
                        <option value="">[Semua Periode]</option>
                        <?php
                            $p = mysql_query("SELECT * FROM periode");
                        while ($row=mysql_fetch_array($p)) {
                            echo '<option value="'.$row['id_periode'].'">'.$row['nama_periode'].'</option>';        
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                Nilai Tertinggi
            </div>
            <div class="panel-body">
                <div class="cart_load" >
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Filter
            </div>
            <div class="panel-body panel-filter">
                <div class="form-group">
                    <label>Guru : </label>
                    <ul class="list-group">
                        <li  class="list-group-item list-filter list-active" data-id="0">Semua Guru</li>
                        <?php
                        $p = mysql_query("SELECT * FROM data_guru");
                        while ($row=mysql_fetch_array($p)) {
                            echo '<li  class="list-group-item list-filter" data-id="'.$row['nip'].'">'.$row['nama_guru'].'</li>';        
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                History
            </div>
            <div class="panel-body">
                <div class="cart_load_history" >
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
        
    ?>

<script type="text/javascript">
    $(document).ready(function(){
        //$('.cart_load').load('pages/chart.php?cart=1');
        $('#periode_filter').change(function(){
            var id = $(this).val();
            if(id==''){
                $('.cart_load').load('pages/chart.php?cart=1');
            }else{
                $('.cart_load').load('pages/chart.php?cart=1&idp='+id);
            }
            console.log($('.cart_load').html());
        });

        //$('.cart_load_history').load('pages/chart.php?cart=2');
        $('.list-filter').click(function(){
            var id = $(this).attr('data-id');
            console.log(id);
            $('.list-filter').each(function(){
                $(this).removeClass('list-active');
            });
            $(this).addClass('list-active');

            if(id=='0'){
                $('.cart_load_history').load('pages/chart.php?cart=2');
            }else{
                $('.cart_load_history').load('pages/chart.php?cart=2&nip='+id);
            }
        });

    });
</script>

