<div class="page-header">
    <h1>Nilai Profile </h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
    <form class="form-inline">
        <input type="hidden" name="m" value="profile" />
        <div class="form-group">
            <select class="form-control" name="kode_aspek" onchange="this.form.submit()">
            <option value="">Pilih Aspek</option>
            <?=get_aspek_option($_GET['kode_aspek']);
            get_aspek();
            get_alternatif();
            get_kriteria();?>
            </select>
        </div>
    </form>
    </div>
    <div class="panel-body">
        <?php if($_POST) include'aksi.php'?> 
        <?php 
        $data = get_profile($_GET['kode_aspek']); 
        if($data):?>        
        <form class="form-inline" method="post">             
            <div class="table-responsive">    
                <table class="table table-bordered table-hover table-striped">
                <thead><tr>
                    <th>NAMA</th>
                    <?php 
                    $rows = $db->get_results("SELECT kode_kriteria, nama_kriteria FROM tb_kriteria WHERE kode_aspek='$_GET[kode_aspek]'");
                    foreach($rows as $row):?>
                    <th><?=$row->nama_kriteria?></th>
                    <?php endforeach?>
                </tr></thead>
                <?php foreach($data as $key => $val):?>
                <tr>
                    <th><?=$ALTERNATIF[$key]->nama_alternatif?></th>
                    <?php foreach($val as $k => $v):?>
                    <td>
                        <select class="form-control" name="nilai[<?=$key?>][<?=$k?>]">
                        <?=get_nilai_option($k, $v)?>
                        </select>
                    </td>      
                    <?php endforeach?>
                </tr>
                <?php endforeach?>
                </table>                     
            </div>     
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
            </div>
        </form>
        <?php endif?>
    </div>
</div>