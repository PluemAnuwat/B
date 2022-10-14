<?php session_start(); ?>
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
          } elseif (isset($_GET['page']) && $_GET['page'] == 'dashboard') {
            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
              include('insert_dashboard.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('delete_dashboard.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('update_dashboard.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'detail') {
              include('detail_dashboard.php');
            } else {
              include('index_dashboard.php');
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
          } elseif (isset($_GET['page']) && $_GET['page'] == 'logout') {
            include('logout.php');
          } elseif (isset($_GET['page']) && $_GET['page'] == 'rpt_employee') {
            include('rpt_employee.php');
          } elseif (isset($_GET['page']) && $_GET['page'] == 'rpt_suppiles') {
            include('rpt_suppiles.php');
          } elseif (isset($_GET['page']) && $_GET['page'] == 'index_profile') {
            include('index_profile.php');
          } elseif (isset($_GET['page']) && $_GET['page'] == 'rpt_po') {
            include('rpt_po.php');
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