<?php
include'functions.php';
//if(empty($_SESSION['login']))
    //header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>    
    <link rel="canonical" href="http://tugasakhir.id/spk-pm/" />

    <title>SPK Metode Profile Matching</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/general.css" rel="stylesheet"/>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>            
  </head>
  <body>
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?">Profile Matching</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <?php 
            /** jika levelnya admin */
            if($_SESSION['level']=='admin'):?>
			<li><a href="?m=admin"><span class="glyphicon glyphicon-user"></span> Admin</a></li>
            <li><a href="?m=alternatif"><span class="glyphicon glyphicon-book"></span> Alternatif</a></li>
            <li><a href="?m=aspek"><span class="glyphicon glyphicon-th-large"></span> Aspek</a></li>
            <li><a href="?m=kriteria"><span class="glyphicon glyphicon-th"></span> Kriteria</a></li>
            <li><a href="?m=crips"><span class="glyphicon glyphicon-th-list"></span> Sub Kriteria</a></li>
            <li><a href="?m=profile"><span class="glyphicon glyphicon-calendar"></span> Nilai Profile</a></li>      
            <li><a href="?m=hitung"><span class="glyphicon glyphicon-star"></span> Perhitungan</a></li>
            <li><a href="?m=password"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
            <li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>  
           
            <?php 
            /** jika tidak login sama sekali */
            else: ?>            
           
            <li><a href="?m=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>            
            <?php endif?>               
          </ul>          
          <div class="navbar-text"></div>
        </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
    <?php
        if(file_exists($mod.'.php'))
            include $mod.'.php';
        else
            include 'home.php';
    ?>
    </div>
    <footer class="footer bg-primary">
      <div class="container">
        <p style="text-align:center;">Copyright &copy; <?=date('Y')?></p>
      </div>
    </footer>
    </body>
</html>