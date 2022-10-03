<?php
if(@$_GET['category_id']) { 
if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
     $category_id = $_GET['category_id'];
     $sql = "SELECT * FROM category  WHERE category_id = '$category_id'";
     $query = mysqli_query($con, $sql);
     $result = mysqli_fetch_assoc($query);
}
if (isset($_POST) && !empty($_POST)) {
        $category_name = $_POST['category_name'];
     $sql = "UPDATE category SET category_name = '$category_name'  WHERE category_id = '$category_id'";
     if(mysqli_query($con,$sql)){
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("แก้ไขเรียบร้อย !!");';
        $alert .= 'window.location.href = "?page=type";';
        $alert .= '</script>';
        echo $alert;
        exit();
   } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
   }
   mysqli_close($con);
   }
}
elseif(@$_GET['type_id']) { 
if (isset($_GET['type_id']) && !empty($_GET['type_id'])) {
     $type_id = $_GET['type_id'];
     $sql = "SELECT * FROM type_product  WHERE type_id = '$type_id'";
     $query = mysqli_query($con, $sql);
     $result = mysqli_fetch_assoc($query);
}
if (isset($_POST) && !empty($_POST)) {
        $type_name = $_POST['type_name'];
     $sql = "UPDATE type_product SET type_name = '$type_name'  WHERE type_id = '$type_id'";
     if(mysqli_query($con,$sql)){
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("แก้ไขเรียบร้อย !!");';
        $alert .= 'window.location.href = "?page=type";';
        $alert .= '</script>';
        echo $alert;
        exit();
   } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
   }
   mysqli_close($con);
   }
}elseif(@$_GET['symp_id']) { 
     if (isset($_GET['symp_id']) && !empty($_GET['symp_id'])) {
          $symp_id = $_GET['symp_id'];
          $sql = "SELECT * FROM sympton  WHERE symp_id = '$symp_id'";
          $query = mysqli_query($con, $sql);
          $result = mysqli_fetch_assoc($query);
     }
     if (isset($_POST) && !empty($_POST)) {
             $symp_name = $_POST['symp_name'];
          $sql = "UPDATE sympton SET symp_name = '$symp_name'  WHERE symp_id = '$symp_id'";
          if(mysqli_query($con,$sql)){
             $alert = '<script type="text/javascript">';
             $alert .= 'alert("แก้ไขเรียบร้อย !!");';
             $alert .= 'window.location.href = "?page=type";';
             $alert .= '</script>';
             echo $alert;
             exit();
        } else {
             echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
        mysqli_close($con);
        }
     }elseif($_GET['unit_id']) { 
          if (isset($_GET['unit_id']) && !empty($_GET['unit_id'])) {
               $unit_id = $_GET['unit_id'];
               $sql = "SELECT * FROM unit  WHERE unit_id = '$unit_id'";
               $query = mysqli_query($con, $sql);
               $result = mysqli_fetch_assoc($query);
          }
          if (isset($_POST) && !empty($_POST)) {
                  $unit_name = $_POST['unit_name'];
               $sql = "UPDATE unit SET unit_name = '$unit_name'  WHERE unit_id = '$unit_id'";
               if(mysqli_query($con,$sql)){
                  $alert = '<script type="text/javascript">';
                  $alert .= 'alert("แก้ไขเรียบร้อย !!");';
                  $alert .= 'window.location.href = "?page=type";';
                  $alert .= '</script>';
                  echo $alert;
                  exit();
             } else {
                  echo "Error: " . $sql . "<br>" . mysqli_error($con);
             }
             mysqli_close($con);
             }
          }
   ?>

