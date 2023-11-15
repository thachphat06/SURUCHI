<?php
  session_start();
  ob_start();
  if(isset($_SESSION['s_user'])&&(is_array($_SESSION['s_user']))&&(count($_SESSION['s_user'])>0)) {
      $admin=$_SESSION['s_user'];
  } else{
      header('location: login.php');
  }

  include "view/header.php";
  if(!isset($_GET['pg'])){
    include "view/home.php";
  }else{
    switch ($_GET['pg']){
      case 'add-product':
        include "view/page-form-product.php";
        break;
      case 'products-list':
        include "view/page-products-list.php";
        break;
      case 'categories':
        include "view/page-categories.php";
        break;
      case 'orders':
        include "view/page-orders.php";
        break;
      case 'orders-detail':
        include "view/page-orders-detail.php";
        break;
      case 'sellers-list':
        include "view/page-sellers-list.php";
        break;
  
      default:
        include "view/home.php";
        break;
    }
  }
  include "view/footer.php";
?>