<div class="page-header">
    <h1>Sub Kriteria</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="crips" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=crips_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
            <div class="form-group">
                <a class="btn btn-default" href="cetak.php?m=crips" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kriteria</th>
                <th>Nama Sub Kriteria</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_crips k INNER JOIN tb_kriteria a ON a.kode_kriteria=k.kode_kriteria WHERE k.nama_crips LIKE '%$q%' ORDER BY k.kode_crips");
        $no=0;
        foreach($rows as $row):?>
        <tr>
            <td><?=++$no ?></td>
            <td><?=$row->nama_kriteria?></td>
            <td><?=$row->nama_crips?></td>
            <td><?=$row->nilai_crips?></td>
            <td>
                <a class="btn btn-xs btn-warning" href="?m=crips_ubah&ID=<?=$row->kode_crips?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=crips_hapus&ID=<?=$row->kode_crips?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach;?>
        </table>
    </div>
</div>