<h1>Perhitungan</h1>    
<?php    
get_aspek();
get_alternatif();
get_kriteria();
foreach($ASPEK as $ASP): 
    $m_awal = get_profile_nilai(get_profile($ASP->kode_aspek));  
    get_peta_gap($m_awal); 
    get_bobot_nilai_gap($m_awal);  
    
    foreach($m_awal as $key => $value):
        $nc = array();
        $ns = array();                
        foreach($value as $k => $v):
            if($KRITERIA[$k]->factor=='Core')
                $nc[] = $v;
            else
                $ns[] = $v;
        endforeach;
        $ncf = array_sum($nc)/ count($nc);
        $nsf = array_sum($ns)/ count($ns);
        $total = (60 / 100 * $ncf) + (40 / 100 * $nsf);
        $profile[$key][$ASP->kode_aspek] = $total;                              
    endforeach;
endforeach;?>
<table>
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
        <td><?=$key?> - <?=$ALTERNATIF[$key]->nama_alternatif?></td>
        <?php foreach($profile[$key] as $k => $v):?>
        <td><?=round($v,3)?></td>    
        <?php endforeach?>
        <td class="text-primary"><?=round($nilai[$key], 3)?></td>
        <td class="text-primary"><?=$val?></td>        
    </tr>
    <?php endforeach?>
    </tr>                           
 </table> 