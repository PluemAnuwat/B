<?php session_start(); ?>
<?php // echo '<pre'.print_r($_REQUEST, ).'</pre>'; exit; ?>
<?php require 'include/heade.php' ?>
<?php require 'connect.php' ?>
<?php require 'functionDateThai.php' ?>
<?php if (isset($_SESSION['user_login']) && !empty($_SESSION['user_login'])) : ?>

  <body>
    <div id="wrapper">
      <?php require 'include/nav.php' ?>
      <?php require 'include/tab.php' ?>
      <div id="page-wrapper">
        <div id="page-inner">
          <?php
          if (!isset($_GET['page']) && empty($_GET['page'])) {
            include('index_dashboard.php');
          } elseif (isset($_GET['page']) && $_GET['page'] == 'product') {
            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
              include('insert_product.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('delete_product.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('update_product.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'detail') {
              include('detail_product.php');
            } else {
              include('index_product.php');
            }
          } elseif (isset($_GET['page']) && $_GET['page'] == 'type') {
            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
              include('insert_type.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete_type') {
              include('delete_type.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete_unit') {
              include('delete_unit.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete_symp') {
              include('delete_symp.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete_cate') {
              include('delete_cate.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('update_type.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'detail') {
              include('detail_type.php');
            } else {
              include('index_type.php');
            }
          } elseif (isset($_GET['page']) && $_GET['page'] == 'po') {
            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
              include('insert_po.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'confirm') {
              include('index_po_confirm.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'status') {
              include('cancel_status_po.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'detail') {
              include('detail_po.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('update_po.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'good') {
              include('insertsql_good.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'rptdetail') {
              include('rpt_detail_po.php');
            } else {
              include('index_po.php');
            }
          } elseif (isset($_GET['page']) && $_GET['page'] == 'good') {
            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
              include('insert_good.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('delete_good.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('update_good.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'detail') {
              include('detail_good.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'rptdetail') {
              include('rpt_detail_good.php');
            } else {
              include('index_good.php');
            }
          } elseif (isset($_GET['page']) && $_GET['page'] == 'suppiles') {
            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
              include('insert_suppiles.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('delete_suppiles.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('update_suppiles.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'detail') {
              include('detail_suppiles.php');
            } else {
              include('index_suppiles.php');
            }
          } elseif (isset($_GET['page']) && $_GET['page'] == 'customer') {
            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
              include('insert_customer.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('delete_customer.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('update_customer.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'detail') {
              include('detail_customer.php');
            } else {
              include('index_customer.php');
            }
          } elseif (isset($_GET['page']) && $_GET['page'] == 'employee') {
            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
              include('insert_employee.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('delete_employee.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('update_employee.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'detail') {
              include('detail_employee.php');
            } else {
              include('index_employee.php');
            }
          } elseif (isset($_GET['page']) && $_GET['page'] == 'store') {
            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
              include('insert_store.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'sell') {
              include('index_sell_product.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('update_store.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'detail') {
              include('detail_store.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'confirm') {
              include('detail_store.php');
            } else {
              include('index_store.php');
            }
          } elseif (isset($_GET['page']) && $_GET['page'] == 'price') {
            include('index_price.php');
          } elseif (isset($_GET['page']) && $_GET['page'] == 'dashboard') {
            include('index_dashboard.php');
          } elseif (isset($_GET['page']) && $_GET['page'] == 'stock') {
            include('index_stock.php');
          } elseif (isset($_GET['page']) && $_GET['page'] == 'logout') {
            include('logout.php');
          } elseif (isset($_GET['page']) && $_GET['page'] == 'rpt_po') {
            // die('test');
            include('rpt_po.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == 'barcode') {
          include('index_barcode.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == 'index_profile') {
          include('index_profile.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == 'rpt_employee') {
          include('rpt_employee.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == 'rpt_suppiles') {
          include('rpt_suppiles.php');
//report

} elseif (isset($_GET['page']) && $_GET['page'] == 'rptsales_chart') {
  include('rptsales_chart.php');
} elseif (isset($_GET['page']) && $_GET['page'] == 'rptsales_month') {
  include('rptsales_month.php');
} elseif (isset($_GET['page']) && $_GET['page'] == 'rptsales_year') {
  include('rptsales_year.php');
} elseif (isset($_GET['page']) && $_GET['page'] == 'rptsales_day') {
  include('rptsales_day.php');

        }
        
          ?>
        </div>
      </div>
      <?php include 'include/script.php' ?>
  </body>
<?php else : ?>
  <?php include('../login/index.php') ?>
<?php endif; ?>

</html>