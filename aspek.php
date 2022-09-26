<div class="page-header">
    <h1>Aspek</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="aspek" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=aspek_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
            <div class="form-group">
                <a class="btn btn-default" href="cetak.php?m=aspek" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Aspek</th>
                <th>Presentase</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_aspek WHERE kode_aspek LIKE '%$q%' OR nama_aspek LIKE '%$q%' ORDER BY kode_aspek");
        $no=0;
        foreach($rows as $row):?>
        <tr>
            <td><?=++$no ?></td>
            <td><?=$row->kode_aspek?></td>
            <td><?=$row->nama_aspek?></td>
            <td><?=$row->persen?></td>
            <td>
                <a class="btn btn-xs btn-warning" href="?m=aspek_ubah&ID=<?=$row->kode_aspek?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=aspek_hapus&ID=<?=$row->kode_aspek?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach;?>
        </table>
    </div>        
</div>