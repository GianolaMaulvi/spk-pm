<h1>Admin</h1>
<table>
<thead>
    <tr>
        <th>No</th>
        <th>Username</th>    
    </tr>
</thead>
<?php
$q = esc_field($_GET['q']);
$rows = $db->get_results("SELECT * FROM tb_admin WHERE user LIKE '%$q%' ORDER BY user");
$no=0;
foreach($rows as $row):?>
<tr>
    <td><?=++$no ?></td>
    <td><?=$row->user?></td>
</tr>
<?php endforeach;?>
</table>