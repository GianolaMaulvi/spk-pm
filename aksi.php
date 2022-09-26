<?php
require_once'functions.php';

/** LOGIN */ 
if ($mod=='login'){
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);
    $level = $_POST['level'];
    
    $tb = $level=='admin' ? 'tb_admin' : 'tb_alternatif';
    
    $row = $db->get_row("SELECT * FROM $tb WHERE user='$user' AND pass='$pass'");
    if($row){
        $_SESSION['login'] = $row->user;
        $_SESSION['user'] = $row;
        $_SESSION['level'] = $level;
        redirect_js("index.php");
    } else{
        print_msg("Salah kombinasi username dan password.");
    }          
} elseif($act=='logout'){
    unset($_SESSION['login'], $_SESSION['level'], $_SESSION['user']);
    header("location:index.php?m=login");
}elseif ($mod=='password'){
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];
    
    $tb = $_SESSION['level']=='admin' ? 'tb_admin' : 'tb_alternatif';
    
    $row = $db->get_row("SELECT * FROM $tb WHERE user='$_SESSION[login]' AND pass='$pass1'");        
    
    if($pass1=='' || $pass2=='' || $pass3=='')
        print_msg('Field bertanda * harus diisi.');
    elseif(!$row)
        print_msg('Password lama salah.');
    elseif( $pass2 != $pass3 )
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else{        
        $db->query("UPDATE $tb SET pass='$pass2' WHERE user='$_SESSION[login]'");                    
        print_msg('Password berhasil diubah.', 'success');
    }
} 


/** ADMIN */
if($mod=='admin_tambah'){
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    if($user=='' || $pass=='')
        print_msg("username dan password tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_admin WHERE user='$user'"))
        print_msg("username sudah ada!");
    else{
        $db->query("INSERT INTO tb_admin (user, pass)   
            VALUES ('$user', '$pass')");                                           
        redirect_js("index.php?m=admin");
    }
} elseif ($mod=='admin_ubah'){
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    if($user=='' || $pass=='')
        print_msg("username dan password tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_admin SET pass='$pass' WHERE user='$_GET[ID]'");
        redirect_js("index.php?m=admin");
    }
} elseif ($act=='admin_hapus'){
    $db->query("DELETE FROM tb_admin WHERE user='$_GET[ID]'");
    header("location:index.php?m=admin");
} 

/** ALTERNATIF */
if($mod=='alternatif_tambah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    if($kode=='' || $nama=='')
        print_msg("Kode dan nama tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_alternatif WHERE kode_alternatif='$kode'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_alternatif (kode_alternatif, nama_alternatif, user, pass)   
            VALUES ('$kode', '$nama', '$kode', '$kode')");        
        $db->query("INSERT INTO tb_profile (ID, kode_alternatif, kode_aspek, kode_kriteria, kode_crips)
            SELECT NULL, '$kode', k.kode_aspek, k.kode_kriteria, 1 FROM tb_kriteria k");                                   
        redirect_js("index.php?m=alternatif");
    }
} elseif ($mod=='alternatif_ubah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $pass = $_POST['pass'];
    if($kode=='' || $nama=='' || $pass=='')
        print_msg("Kode dan nama tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_alternatif SET kode_alternatif='$kode', nama_alternatif='$nama', pass='$pass' WHERE kode_alternatif='$_GET[ID]'");
        redirect_js("index.php?m=alternatif");
    }
} elseif ($act=='alternatif_hapus'){
    $db->query("DELETE FROM tb_alternatif WHERE kode_alternatif='$_GET[ID]'");
    $db->query("DELETE FROM tb_profile WHERE kode_alternatif='$_GET[ID]'");
    header("location:index.php?m=alternatif");
} 

/** ASPEK */
if($mod=='aspek_tambah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    if($kode=='' || $nama=='')
        print_msg("Kode dan nama tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_aspek WHERE kode_aspek='$kode'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_aspek (kode_aspek, nama_aspek, persen) VALUES ('$kode', '$nama', '$_POST[persen]')");                                                      
        redirect_js("index.php?m=aspek");
    }
} elseif ($mod=='aspek_ubah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    if($kode=='' || $nama=='')
        print_msg("Kode dan nama tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_aspek SET kode_aspek='$kode', nama_aspek='$nama', persen='$_POST[persen]' WHERE kode_aspek='$_GET[ID]'");
        redirect_js("index.php?m=aspek");
    }
} elseif ($act=='aspek_hapus'){
    $db->query("DELETE FROM tb_aspek WHERE kode_aspek='$_GET[ID]'");
    $db->query("DELETE FROM tb_subkriteria WHERE kode_kriteria IN (SELECT kode_kriteria FROM tb_kriteria WHERE kode_aspek='$_GET[ID]')");
    $db->query("DELETE FROM tb_kriteria WHERE kode_aspek='$_GET[ID]'");
    $db->query("DELETE FROM tb_profile WHERE kode_aspek='$_GET[ID]'");
    header("location:index.php?m=aspek");
} 

/** KRITERIA */    
elseif($mod=='kriteria_tambah'){        
    $aspek = $_POST['aspek'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $nilai = $_POST['nilai'];
    $factor = $_POST['factor'];
    
    if($kode=='' || $nama=='' || $nilai=='' || $factor=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_kriteria WHERE kode_kriteria='$kode'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_kriteria (kode_kriteria, nama_kriteria, kode_aspek, nilai_kriteria, factor) VALUES ('$kode', '$nama', '$aspek', '$nilai', '$factor')");
        $db->query("INSERT INTO tb_profile (ID, kode_alternatif, kode_aspek, kode_kriteria, kode_crips)
            SELECT NULL, kode_alternatif, '$aspek', '$kode', 1 FROM tb_alternatif");                       
               
        redirect_js("index.php?m=kriteria");
    }    
} else if($mod=='kriteria_ubah'){
    $aspek = $_POST['aspek'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $nilai = $_POST['nilai'];
    $factor = $_POST['factor'];
    
    if($kode=='' || $nama=='' || $nilai=='' || $factor=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_kriteria SET nama_kriteria='$nama', nilai_kriteria='$nilai', factor='$factor' WHERE kode_kriteria='$_GET[ID]'");
        redirect_js("index.php?m=kriteria");
    }    
} else if ($act=='kriteria_hapus'){
    $db->query("DELETE FROM tb_kriteria WHERE kode_kriteria='$_GET[ID]'");        
    $db->query("DELETE FROM tb_profile WHERE kode_kriteria='$_GET[ID]'");       
    $db->query("DELETE FROM tb_subkriteria WHERE kode_kriteria='$_GET[ID]'");
    header("location:index.php?m=kriteria");
} 

/** crips */    
elseif($mod=='crips_tambah'){        
    $kriteria = $_POST['kriteria'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $nilai = $_POST['nilai'];
    
    if($nama=='' || $nilai=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_crips WHERE kode_crips='$kode'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_crips (kode_crips, nama_crips, kode_kriteria, nilai_crips) 
            VALUES ('$kode', '$nama', '$kriteria', '$nilai')");           
        redirect_js("index.php?m=crips");
    }    
} else if($mod=='crips_ubah'){
    $kriteria = $_POST['kriteria'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $nilai = $_POST['nilai'];
    
    if($kode=='' || $nama=='' || $nilai=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_crips SET nama_crips='$nama', nilai_crips='$nilai' WHERE kode_crips='$_GET[ID]'");
        redirect_js("index.php?m=crips");
    }    
} else if ($act=='crips_hapus'){
    $db->query("DELETE FROM tb_crips WHERE kode_crips='$_GET[ID]'");   
    header("location:index.php?m=crips");
} 

/** PROFILE */ 
else if ($mod=='profile'){
    if($_GET['kode_aspek']==''){
        print_msg('Pilih aspek terlebih dulu.');
    } else {
        $arr_query = array(); 
        //print_r($_POST['nilai']);
        foreach($_POST['nilai'] as $key => $val){
            foreach($val as $k => $v){
                $db->query("UPDATE tb_profile SET kode_crips='$v' WHERE kode_kriteria='$k' AND kode_alternatif='$key' AND kode_aspek='$_GET[kode_aspek]'");                    
            }
        }                              
        print_msg('Data berhasil diubah.', 'success');
    }
}  
else if($mod=='kuisioner'){
    foreach($_POST['nilai'] as $key => $val){
        $db->query("UPDATE tb_profile SET kode_crips='$val' WHERE ID='$key'");
    }
    print_msg('Data tersimpan!', 'success');
}  
