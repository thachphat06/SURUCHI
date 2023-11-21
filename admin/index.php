<?php
  session_start();
  ob_start();
  if(isset($_SESSION['s_user'])&&(is_array($_SESSION['s_user']))&&(count($_SESSION['s_user'])>0)) {
      $admin=$_SESSION['s_user'];
  } else{
      header('location: login.php');
  }
  include "../model/danhmuc.php";
  include "../model/global.php";



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
        $cataloglist = danhmuc_all();  
        if (isset($_POST['btnadd'])) {
            $name = $_POST['name'];
            $img = $_FILES["img"]["name"];
            danhmuc_insert($name,$img);
            $tb = 'Tạo thành công';
            header("Location: index.php");
        }   
        include "view/page-categories.php";
        break;

      case 'deletedm':
        if(isset($_GET['id'])&&($_GET['id']>0)){
          $id=$_GET['id'];
          danhmuc_delete($id);
        }
        $cataloglist=danhmuc_all();
        include "view/page-categories.php";
      break;
        include "view/updatedmform.php";
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
      case 'page-review':
        include "view/page-review.php";
        break;
  
      default:
        include "view/home.php";
        break;
    }
  }
  include "view/footer.php";
?>