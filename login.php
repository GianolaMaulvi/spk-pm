<!-- Form login user -->
<div class="page-header">
    <h1 align="center">Login</h1>
</div>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">        
        <?php if($_POST) include 'aksi.php'; ?>
        <form class="form-signin" method="post">
            <div class="form-group">
                <label>Login sebagai</label>
                <?=get_level_radio(set_value('level', 'admin'))?>
            </div>      
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" placeholder="Username" name="user" autofocus />
            </div>
            <div class="form-group">            
                <label>Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="pass" />
                <p class="help-block">&nbsp;</p>    
            </div>      
            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-log-in"></span> Masuk</button>                  
        </form>      
    </div>
    <div class="col-md-4"></div>
</div>