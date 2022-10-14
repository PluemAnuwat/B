<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="?page=index_profile"><?= $_SESSION['posit_login']?></a> 
            </div>
            <?php $date = date('Y-m-d') ?>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> วันปัจจุบัน : <?= datethai($date) ?>  &nbsp; <a href="?page=logout" class="btn btn-danger square-btn-adjust">ออกจากระบบ</a> </div>
        </nav>  