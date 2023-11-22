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
          $img=$_FILES["img"]["name"];
          $target_file = IMG_PATH_ADMIN.basename($img);
          if($img!=""){
            //upload hình
            $target_file = IMG_PATH_ADMIN.$img;
            move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
          } else {
            $img="";
          }
          danhmuc_insert($name, $img);
          header("location: index.php?pg=categories");
        }   
        include "view/page-categories.php";
        break;

      case 'deletedm':
        $cataloglist=danhmuc_all();
        if(isset($_GET['id'])&&($_GET['id']>0)){
          $id=$_GET['id'];
          //xóa hình trên host
          $img=IMG_PATH_ADMIN.get_img_dm($id);
          if(file_exists($img)){
            unlink(basename($img));
            // var_dump(basename($img));
          } 

          danhmuc_delete($id);
        }
        include "view/page-categories.php";
      break;
      case 'updatedmform':
        $cataloglist=danhmuc_all();
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