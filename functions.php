<?php
error_reporting(~E_NOTICE);
session_start();

include'config.php';
include'includes/db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
include'includes/general.php';  

$mod = $_GET['m'];
$act = $_GET['act'];  

/** ===== DEKLARASI TABLE ===== */

$ALTERNATIF = array();
$ASPEK = array();
$KRITERIA = array();
$PROFILE = array();
$CRIPS = array();
$KRITERIA_CRIPS = array();

/** ===== MEMBUKA TABLE ===== */

$rows = $db->get_results("SELECT * FROM tb_crips ORDER BY kode_kriteria, nilai_crips");
foreach($rows as $row){
    $CRIPS[$row->kode_crips] = $row;
    $CRIPS[$row->kode_kriteria][$row->kode_crips] = $row;
}

function get_alternatif(){
    global $ALTERNATIF, $db;
    $rows = $db->get_results("SELECT *FROM tb_alternatif ORDER BY kode_alternatif");
    foreach($rows as $row){
        $ALTERNATIF[$row->kode_alternatif] = $row;
    }    
}

function get_aspek(){
    global $ASPEK, $db;
    $rows = $db->get_results("SELECT * FROM tb_aspek ORDER BY kode_aspek");
    foreach($rows as $row){
        $ASPEK[$row->kode_aspek] = $row;
    }
}

function get_kriteria(){
    global $KRITERIA, $db;
    $rows = $db->get_results("SELECT * FROM tb_kriteria ORDER BY kode_aspek, kode_kriteria");
    foreach($rows as $row){
        $KRITERIA[$row->kode_kriteria] = $row;
    }
}

function PM_profile(){
    global $PROFILE, $db;    
    $rows = $db->get_results("SELECT * FROM tb_profile ORDER BY kode_aspek, kode_alternatif, kode_kriteria");
    foreach($rows as $row){
        $PROFILE[] = $row;
    }
}

/** ===== PROFILE ===== */

function get_profile($kode_aspek=''){
    global $PROFILE, $CRIPS;  
    if(!$PROFILE) PM_profile();
    foreach($PROFILE as $key => $row){
        if($row->kode_aspek == $kode_aspek)
            $matriks[$row->kode_alternatif][$row->kode_kriteria] = $row->kode_crips;
    }
    return $matriks;
}

function get_profile_nilai($profile){
    global $CRIPS;
    $arr = array();
    foreach($profile as $key => $val){
        foreach($val as $k => $v){
            $arr[$key][$k] = $CRIPS[$v]->nilai_crips; 
        }
    }
    return $arr;
}

/** ===== PERHITUNGAN ===== */

function get_peta_gap(&$matriks = array()){
    global $KRITERIA;        
    foreach((array) $matriks as $key => $value){
        foreach ($value as $k => $v){
            $matriks[$key][$k] = $v - $KRITERIA[$k]->nilai_kriteria;            
        }
    }     
}

function get_bobot_nilai($nilai){
    $array = array(
        '0' => 5,
        '1' => 4.5,
        '-1' => 4,
        '2' => 3.5,
        '-2' => 3,
        '3' => 2.5,
        '-3' => 2,
        '4' => 1.5,
        '-4' => 1,
    );
    return $array[$nilai];
}

function get_bobot_nilai_gap(&$matriks = array()){    
    foreach((array)$matriks as $key => $value){
        foreach ($value as $k => $v){
            $matriks[$key][$k] = get_bobot_nilai($v);            
        }
    }     
}

function get_total($matriks = array()){
    global $ASPEK;
    $total = array();    
    foreach($matriks as $key => $value){
        foreach ($value as $k => $v){
            $total[$key]+= $v * $ASPEK[$k]->persen / 100;      
        }
    }       
    return $total;
}

/** ===== TEMPLATE ===== */
function get_factor_radio($selected){
    $array = array('Core', 'Secondary');
    foreach($array as $arr){
        if($arr==$selected)
            $a.="<label class='radio-inline'>
                  <input type='radio' name='factor' value='$arr' checked> $arr
                </label>";
        else
            $a.="<label class='radio-inline'>
                  <input type='radio' name='factor' value='$arr'> $arr
                </label>";    
    }
    return '<div class="radio">'.$a.'</div>';
} 

function get_kriteria_option($kode_aspek, $selected = ''){
    global $KRITERIA;
    if(!$KRITERIA) get_kriteria();
    //print_r($KRITERIA);
    foreach($KRITERIA as $key => $row){
        //if($row->kode_aspek == $kode_aspek){
            if($row->kode_kriteria==$selected)
                $a.="<option value='$row->kode_kriteria' selected>$row->kode_kriteria - $row->nama_kriteria</option>";
            else
                $a.="<option value='$row->kode_kriteria'>$row->kode_kriteria - $row->nama_kriteria</option>";
        //}            
    }
    return $a;
}

function get_aspek_option($selected = ''){
    global $ASPEK;   
    if(!$ASPEK) get_aspek();
     
    foreach($ASPEK as $key => $row){
        if($row->kode_aspek==$selected)
            $a.="<option value='$row->kode_aspek' selected>$row->kode_aspek - $row->nama_aspek</option>";
        else
            $a.="<option value='$row->kode_aspek'>$row->kode_aspek - $row->nama_aspek</option>";
    }
    return $a;
}

function get_alternatif_option($selected = ''){
    global $ALTERNATIF;    
    if(!$ALTERNATIF) get_alternatif();
    foreach($ALTERNATIF as $key => $row){
        if($row->kode_alternatif==$selected)
            $a.="<option value='$row->kode_alternatif' selected>$row->kode_alternatif - $row->nama_alternatif</option>";
        else
            $a.="<option value='$row->kode_alternatif'>$row->kode_alternatif - $row->nama_alternatif</option>";
    }
    return $a;
}

function get_nilai_option($kode_kriteria, $selected = ''){  
    global $CRIPS;    
    foreach((array)$CRIPS[$kode_kriteria] as $key => $val){
        if($selected==$key)
            $a.="<option value='$key' selected>$val->nilai_crips - $val->nama_crips</option>";
        else
            $a.= "<option value='$key'>$val->nilai_crips - $val->nama_crips</option>";
    }
    return $a;
}

/** pilihan login */
function get_level_radio($selected){
    $array = array('admin');
    foreach($array as $arr){
        if($arr==$selected)
            $a.="<label class='radio-inline'>
                  <input type='radio' name='level' value='$arr' checked> $arr
                </label>";
        else
            $a.="<label class='radio-inline'>
                  <input type='radio' name='level' value='$arr'> $arr
                </label>";    
    }
    return '<div class="radio">'.$a.'</div>';
} 