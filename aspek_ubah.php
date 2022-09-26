<?php
    $row = $db->get_row("SELECT * FROM tb_aspek WHERE kode_aspek='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1>Ubah Aspek</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" readonly="readonly" value="<?=set_value('kode', $row->kode_aspek)?>"/>
            </div>
            <div class="form-group">
                <label>Nama Aspek <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=set_value('nama', $row->nama_aspek)?>"/>
            </div>
            <div class="form-group">
                <label>Prosentase <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="persen" value="<?=set_value('persen', $row->persen)?>"/>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=kaspek"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>