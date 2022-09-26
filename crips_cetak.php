<h1>Crips</h1>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kriteria</th>
            <th>Nama Subkriteria</th>
            <th>Nilai</th>
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
    </tr>
    <?php endforeach;?>
</table>