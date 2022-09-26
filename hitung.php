<div class="page-header">
    <h1>Perhitungan</h1>
</div>
<?php    
    get_aspek();
    get_alternatif();
    get_kriteria();
    if (!$ALTERNATIF || !$ASPEK || !$KRITERIA):
        echo "Tampaknya anda belum mengatur alternatif, aspek, atau kriteria. Silahkan tambahkan alternatif, aspek, dan kriteria.";    
    elseif($db->get_row("SELECT * FROM tb_aspek WHERE kode_aspek NOT IN(SELECT kode_aspek FROM tb_kriteria)")):
        print_msg('Ada aspek yang belum diatur kriterianya.'); 
    else:
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#c1" aria-expanded="false" aria-controls="c1">
                Perhitungan
            </a>
        </h4>
    </div>
    <div id="c1" class="panel-body collapse">
    <?php foreach($ASPEK as $ASP): ?>
    <div class="panel panel-default">
        <div class="panel-heading"><strong><?=$ASP->nama_aspek?></strong></div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th>Kode</th>
                    <?php 
                    $rows = $db->get_results("SELECT kode_kriteria, nama_kriteria, nilai_kriteria FROM tb_kriteria WHERE kode_aspek='$ASP->kode_aspek'");
                    foreach($rows as $row):?>
                    <th><?=$row->nama_kriteria?></th>
                    <?php endforeach?>
                </tr>
                <?php 
                $m_awal = get_profile_nilai(get_profile($ASP->kode_aspek));                        
                foreach((array) $m_awal as $key => $value):?>
                <tr>
                    <th><?=$ALTERNATIF[$key]->nama_alternatif?></th>
                    <?php foreach($value as $k => $v):?>
                    <td><?=round($v, 8)?></td>
                    <?php endforeach?>
                </tr>
                <?php endforeach?>
                <tfoot><tr>
                    <th>Nilai Kriteria</th>
                    <?php foreach($rows as $row):?>
                    <td class="text-primary"><?=$row->nilai_kriteria?></td>        
                    <?php endforeach?>
                </tr></tfoot>            
            </table>
        </div>    
        <div class="panel-body">Perhitungan pemetaan gap <strong><?=$nama?></strong>:</div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead><tr>
                    <th></th>
                    <?php foreach($rows as $row):?>
                    <th><?=$row->nama_kriteria?></th>
                    <?php endforeach?>                 
                </tr></thead>
                <?php             
                get_peta_gap($m_awal);            
                foreach((array)$m_awal as $key => $value):?>
                <tr>
                    <th><?=$ALTERNATIF[$key]->nama_alternatif?></th>
                    <?php foreach($value as $k => $v):?>
                    <td><?=round($v, 8)?></td>
                    <?php endforeach?>
                </tr>
                <?php endforeach?>            
            </table>
        </div>            
        <div class="panel-body">Pembobotan nilai gap <strong><?=$nama?></strong>:</div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
            <thead><tr>
                <th></th>
                <?php foreach($rows as $row):?>
                <th><?=$row->nama_kriteria?></th>
                <?php endforeach?>                 
            </tr></thead>
            <?php             
            get_bobot_nilai_gap($m_awal);            
            foreach((array)$m_awal as $key => $value):?>
            <tr>
                <th><?=$ALTERNATIF[$key]->nama_alternatif?></th>
                <?php foreach($value as $k => $v):?>
                <td><?=round($v, 8)?></td>
                <?php endforeach?>
            </tr>
            <?php endforeach?>            
        </table>
        </div>
        <div class="panel-body">Perhitungan factor <strong><?=$nama?></strong>:</div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th></th>
                    <?php foreach($rows as $row):?>
                    <th><?=$row->nama_kriteria?></th>                    
                    <?php endforeach?>
                    <th>NCF</th>
                    <th>NSF</th>
                    <th>Total</th>
                </tr>
                <?php foreach((array)$m_awal as $key => $value):?>
                <tr>
                    <th><?=$ALTERNATIF[$key]->nama_alternatif?></th>
                    <?php 
                    $nc = array();
                    $ns = array();                
                    foreach($value as $k => $v):
                        if($KRITERIA[$k]->factor=='Core')
                            $nc[] = $v;
                        else
                            $ns[] = $v;?>
                    <td><?=round($v, 8)?></td>
                    <?php endforeach;
                    $ncf = count($nc) == 0 ? 0 : array_sum($nc)/ count($nc);
                    $nsf = count($ns) ==0 ? 0 : array_sum($ns)/ count($ns);
                    $total = (60 / 100 * $ncf) + (40 / 100 * $nsf);
                    $profile[$key][$ASP->kode_aspek] = $total;?>                
                    <td><?=number_format($ncf, 8)?></td>
                    <td><?=number_format($nsf, 8)?></td>
                    <td class='text-primary'><?=number_format($total, 8)?></td>                                
                <?php endforeach?>                        
                <tr>
                    <td></td>
                    <?php foreach($rows as $row):?>
                    <td class="text-primary"><?=$KRITERIA[$row->kode_kriteria]->factor?></td> 
                    <?php endforeach?>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>            
    </div>
    <?php endforeach;?>
</div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading"><strong>Hasil Akhir</strong></div>
    <div class="panel-body">    
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Hasil Akhir</strong></div>            
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>Alternatif</th>
                        <?php foreach($ASPEK as $ASP):?>
                        <th><?=$ASP->nama_aspek?></th>
                        <?php endforeach?>                                        
                        <th>Total</th>
                        <th>Rank</th>
                    </tr>
                    <tr>
                        <td>Prosentase</td>
                        <?php foreach($ASPEK as $ASP):?>
                        <td><?=$ASP->persen?> %</td>
                        <?php endforeach?>
                        <td></td>
                        <td></td>
                    </tr>                            
                    <?php 
                    //print_r($profile);
                    $nilai = get_total($profile);                
                    function get_rank($array){
                        $m_awal = $array;
                        arsort($m_awal);
                        $no=1;
                        $new = array();
                        foreach($m_awal as $key => $value){
                            $new[$key] = $no++;
                        }
                        return $new;
                    }                
                    $rank = get_rank($nilai);                
                    foreach($rank as $key => $val):?>
                    <tr>
                        <td><?=$ALTERNATIF[$key]->nama_alternatif?></td>
                        <?php foreach($profile[$key] as $k => $v):?>
                        <td><?=round($v,8)?></td>    
                        <?php endforeach?>
                        <td class="text-primary"><?=round($nilai[$key], 8)?></td>
                        <td class="text-primary"><?=$val?></td>        
                    </tr>
                    <?php endforeach?>
                    </tr>                           
                 </table>
            </div>                         
        </div>
        <a class="btn btn-sm btn-default" href="cetak.php?m=hitung" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
    </div>
</div>
<?php endif?>
