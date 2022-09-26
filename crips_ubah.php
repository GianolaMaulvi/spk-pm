<?php
    $row = $db->get_row("SELECT * FROM tb_subkriteria WHERE kode_crips='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1>Ubah Sub Kriteria</h1>
</div>
<div class="row">
    <div class="col-sm-6">
    <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label>Kriteria</label>
                <select class="form-control" name="kriteria" disabled="">
                    <?=get_kriteria_option(set_value('kriteria', $row->kode_kriteria))?>
                </select>
            </div>
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" value="<?=set_value('kode', $row->kode_crips)?>" readonly=""/>
            </div>
            <div class="form-group">
                <label>Nama Sub Kriteria <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=set_value('nama', $row->nama_crips)?>"/>
            </div>
            <div class="form-group">
                <label>Nilai Sub Kriteria<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nilai" value="<?=set_value('nilai', $row->nilai_crips)?>"/>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=crips"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>