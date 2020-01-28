<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Laporan Penilaian Keseluruhan
        </h1>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <form class="form-inline">
                    <div class="form-group">
                        <label class="sr-only" for="periode">Periode</label>
                        <select class="form-control" name="periode" id="periode_filter">
                            <option value="">[Periode]</option>
                            <?php
                                $p = mysql_query("SELECT * FROM periode");
                                while ($row=mysql_fetch_array($p)) {
                                    echo '<option value="'.$row['id_periode'].'">'.$row['nama_periode'].'</option>';        
                                }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <a id="link_export" target="blank" href="pages/data_penilaian.php" class="btn btn-success pull-right" ><i class="fa fa-file-excel-o"></i> Export</a>
            </div>
            <div class="col-lg-12">
            <hr>
                <div class="table-responsive"> 
                    <div class="load_penilaian"></div>
                    <div class="spacer"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        //$('.load_penilaian').load('pages/data_penilaian.php');
        $('#periode_filter').change(function(){
            var id = $(this).val();
            var link =  'pages/data_penilaian.php?idp='+id;
            $('.load_penilaian').load(link);
            link += '&export=true';
            $('#link_export').attr('href', link);
        });

    });
</script>






























