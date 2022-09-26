<div class="page-header">
    <h1>Tambah Kriteria</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label>Aspek</label>
                <select class="form-control" name="aspek">
                    <?=get_aspek_option(set_value('aspek'))?>
                </select>
            </div>
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" value="<?=set_value('kode', kode_oto('kode_kriteria', 'tb_kriteria', 'KR', 2))?>"/>
            </div>
            <div class="form-group">
                <label>Nama Kriteria <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=set_value('nama')?>"/>
            </div>
            <div class="form-group">
                <label>Nilai Kriteria<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nilai" value="<?=set_value('nilai')?>"/>
            </div>
            <div class="form-group">
                <label>Factor<span class="text-danger">*</span></label>
                <?=get_factor_radio(set_value('factor'))?>
            </div>
            <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
            <a class="btn btn-danger" href="?m=kriteria"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
        </form>
    </div>
</div>