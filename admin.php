<div class="page-header">
    <h1>Admin</h1>
</div>
<div class="panel panel-default">
<div class="panel-heading">
    <form class="form-inline">
        <input type="hidden" name="m" value="admin" />
        <div class="form-group">
            <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
        </div>
        <div class="form-group">
            <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
        </div>
        <div class="form-group">
            <a class="btn btn-primary" href="?m=admin_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
        </div>
        <div class="form-group">
            <a class="btn btn-default" href="cetak.php?m=admin" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
        </div>
    </form>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <?php
    $q = esc_field($_GET['q']);
    $rows = $db->get_results("SELECT * FROM tb_admin WHERE user LIKE '%$q%' ORDER BY user");
    $no=0;
    foreach($rows as $row):?>
    <tr>
        <td><?=++$no?></td>
        <td><?=$row->user?></td>
        <td>
            <a class="btn btn-xs btn-warning" href="?m=admin_ubah&ID=<?=$row->user?>"><span class="glyphicon glyphicon-edit"></span></a>
            <a class="btn btn-xs btn-danger" href="aksi.php?act=admin_hapus&ID=<?=$row->pass?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
        </td>
    </tr>
    <?php endforeach;?>
    </table>
</div>
</div>