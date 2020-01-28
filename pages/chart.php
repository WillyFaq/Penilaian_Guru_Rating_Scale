<?php
    require_once('../config/koneksi.php');
    if($_GET['cart']=='1'):
?>
<div id="morris-bar-chart"></div>
<?php
           
    $data = mysql_query("SELECT * FROM periode ");
    
    if(isset($_GET['idp'])){
        $idp = $_GET['idp'];
        $data = mysql_query("SELECT * FROM periode WHERE id_periode = $idp ");
            
    }

    $periode = '';
    $id_periode = '';
    $p = 0;
    while($row = mysql_fetch_array($data)){
        if($p==0){
            $id_periode .= '"'.$row['id_periode'].'"';
            $periode .= '"'.$row['nama_periode'].'"';
        }else{
            $id_periode .= ', "'.$row['id_periode'].'"';
            $periode .= ', "'.$row['nama_periode'].'"';
        }
        $p++;
    }
?>
<script type="text/javascript">
    
$(function(){
     Morris.Bar({
        element: 'morris-bar-chart',
        data: [
        <?php
            $guru = mysql_query("SELECT a.nip, a.nama_guru, SUM(b.total_skor) FROM data_guru a LEFT JOIN penilaian b ON a.nip = b.nip GROUP BY a.nip ORDER BY b.total_skor DESC LIMIT 0, 3");
            while($row = mysql_fetch_array($guru)){
                $q = mysql_query("SELECT * FROM penilaian WHERE nip = $row[nip]");

                if(isset($_GET['idp'])){
                    $idp = $_GET['idp'];
                    $q = mysql_query("SELECT * FROM penilaian WHERE nip = $row[nip] AND id_periode = $idp");
                }
                echo '{';
                echo "y: '$row[nama_guru]',";

                while($rw = mysql_fetch_array($q)){
                    echo $rw['id_periode'].": ".$rw['total_skor'].","; 
                }
                echo "},"; 
            }
        ?>
        ],
        xkey: 'y',
        ykeys: [<?= $id_periode; ?>],
        labels: [<?= $periode; ?>],
        hideHover: 'auto',
        resize: true
    });
});
</script>
<?php elseif($_GET['cart']==2): ?>
<div id="morris-area-chart" ></div>
<?php
        $id = isset($_GET['nip'])?$_GET['nip']:'';
        $i=0;
        $nm = '';
        $np = '';
        if($id!=''){
            $g = mysql_query("SELECT * FROM data_guru WHERE nip = '$id' ORDER BY nip ASC");
        }else{
            $g = mysql_query("SELECT * FROM data_guru ORDER BY nip ASC");
        }
        while ($row = mysql_fetch_array($g)) {
            if($i==0){
                $nm .= "'$row[nama_guru]'";
                $np .= "'$row[nip]'";
            }else{
                $nm .= ", '$row[nama_guru]'";
                $np .= ", '$row[nip]'";
            }
            $i++;
        }

        $dd = '';
        $q = mysql_query("SELECT * FROM periode ORDER BY nama_periode ASC");
        while($row = mysql_fetch_array($q)){
        $dd .= '{ ';
            $dd .= 'period: "'.$row['nama_periode'].' ", ';
            $idp = $row['id_periode'];
            if($id!=''){
                $p = mysql_query("SELECT * FROM data_guru a LEFT OUTER JOIN penilaian b  ON a.nip = b.nip WHERE id_periode = $idp AND a.nip = '$id' ORDER BY a.nip ASC");
            }else{
                $p = mysql_query("SELECT * FROM data_guru a LEFT OUTER JOIN penilaian b  ON a.nip = b.nip WHERE id_periode = $idp ORDER BY a.nip ASC");
            }
            while ($rp = mysql_fetch_array($p)) {
                $dd .= '"'.$rp['nip'].'" : '.$rp['total_skor'].', '; 
            }
            $dd .= '},';
        }
?>
<script type="text/javascript">
    $(function(){
        Morris.Bar({
            element: 'morris-area-chart',
            data: [<?= $dd; ?>],
            xkey: 'period',
            ykeys: [<?= $np; ?>],
            labels: [<?= $nm; ?>],
            pointSize: 2,
            hideHover: 'auto',
            resize: true
        });
    });
</script>
<?php endif; ?>