<div class="page-header">
    <h1>Tambah Sub Kriteria</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label>Kriteria</label>
                <select class="form-control" name="kriteria">
                    <?=get_kriteria_option(set_value('kriteria'))?>
                </select>
            </div>
            <div class="form-group">
                <label>Nama Sub Kriteria <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=set_value('nama')?>"/>
            </div>
            <div class="form-group">
                <label>Nilai Sub Kriteria<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nilai" value="<?=set_value('nilai')?>"/>
            </div>
            <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
            <a class="btn btn-danger" href="?m=crips"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
        </form>
    </div>
</div>