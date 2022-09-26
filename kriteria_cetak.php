<h1>Kriteria</h1>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Aspek</th>
            <th>Nama Kriteria</th>
            <th>Nilai</th>
            <th>Factor</th>
        </tr>
    </thead>
    <?php
    $q = esc_field($_GET['q']);
    $rows = $db->get_results("SELECT * FROM tb_kriteria k INNER JOIN tb_aspek a ON a.kode_aspek=k.kode_aspek WHERE k.nama_kriteria LIKE '%$q%' ORDER BY k.kode_kriteria");
    $no=0;
    foreach($rows as $row):?>
    <tr>
        <td><?=++$no ?></td>
        <td><?=$row->kode_kriteria?></td>
        <td><?=$row->nama_aspek?></td>
        <td><?=$row->nama_kriteria?></td>
        <td><?=$row->nilai_kriteria?></td>
        <td><?=$row->factor?></td>
    </tr>
    <?php endforeach;?>
</table>