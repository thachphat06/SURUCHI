<?php
  include "view/header.php";
  if(!isset($_GET['pg'])){
    include "view/home.php";
  }else{
    switch ($_GET['pg']){
      case 'login':
        include "view/login.php";
        break;
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