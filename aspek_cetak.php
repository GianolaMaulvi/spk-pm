<h1>Aspek</h1>    
<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Aspek</th>
            <th>Prosentase</th>
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
    </tr>
    <?php endforeach;?>
</table>