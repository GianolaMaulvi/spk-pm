<?php
    $row = $db->get_row("SELECT * FROM tb_kriteria WHERE kode_kriteria='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1>Ubah kriteria</h1>
</div>
<div class="row">
    <div class="col-sm-6">
    <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label>Aspek</label>
                <select class="form-control" name="aspek" disabled="">
                    <?=get_aspek_option(set_value('aspek', $row->kode_aspek))?>
                </select>
            </div>
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" value="<?=set_value('kode', $row->kode_kriteria)?>" readonly=""/>
            </div>
            <div class="form-group">
                <label>Nama Kriteria <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=set_value('nama', $row->nama_kriteria)?>"/>
            </div>
            <div class="form-group">
                <label>Nilai Kriteria<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nilai" value="<?=set_value('nilai', $row->nilai_kriteria)?>"/>
            </div>
            <div class="form-group">
                <label>Factor<span class="text-danger">*</span></label>
                <?=get_factor_radio(set_value('factor', $row->factor))?>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=kriteria"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>