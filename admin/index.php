<?php
  session_start();
  ob_start();
  if(isset($_SESSION['s_user'])&&(is_array($_SESSION['s_user']))&&(count($_SESSION['s_user'])>0)) {
      $admin=$_SESSION['s_user'];
  } else{
      header('location: login.php');
  }
  include "../model/sanpham.php";
  include "../model/danhmuc.php";
  include "../model/user.php";
  include "../model/global.php";

  include "view/header.php";
  if(!isset($_GET['pg'])){
    include "view/home.php";
  }else{
    switch ($_GET['pg']){
      case 'products-list':
        $productlist=get_dssp_admin(100); 
        include "view/page-products-list.php";
        break;
      case 'updateproduct':
        //kiem tra va lay du lieu
        if(isset($_POST['updateproduct'])){
          //lấy dữ liệu về
          $name = $_POST["name"];
          $price = $_POST["price"];
          $old_price = $_POST["old_price"];
          $describe1 = $_POST["describe1"];
          $describe2 = $_POST["describe2"];
          // $best = $_POST["best"];
          // $hot = $_POST["hot"];
          // $new = $_POST["new"];
          $iddm = $_POST["iddm"];
          $id = $_POST["id"];

          $img = $_FILES["img"]['name'];
          if($img!=""){
            //upload hình
            $target_file = IMG_PATH_ADMIN.$img;
            move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

            //xóa hình cũ trên host
            $old_img=IMG_PATH_ADMIN.$_POST['old_img'];
            if(file_exists($old_img)) unlink($old_img);

          } else {
            $img="";
          }
          //update
          sanpham_update($name, $img, $price, $old_price, $describe1, $describe2, $iddm, $id);
        }

        //show dssp
        $productlist=get_dssp_admin(100); 
        include "view/page-products-list.php";
        break;
      case 'form-add-product':
        $categorylist = danhmuc_all();
        include "view/page-form-product.php";
        break;
      case 'page-update-product':
        if(isset($_GET['id'])&&($_GET['id']>0)){
          $id=$_GET['id'];
          $sp=get_sp_by_id($id);
        }
        //trở về trang dssp
        $categorylist=danhmuc_all();
        include "view/page-update-product.php";
        break;
      case 'delproduct':
        if(isset($_GET['id'])&&($_GET['id']>0)){
          $id=$_GET['id'];
          $img=IMG_PATH_ADMIN.get_img($id);
          if(is_file($img)){
            unlink($img);
          }
          try {
            sanpham_delete($id);
          } catch(\Throwable $th){
            //throw $th;
            echo"<h3 style='color:red; text-align:center' >Sản phẩm đã có trong giỏ hàng! Không được quyền xóa!</h3>";
          }
        }  
        //trở về trang dssp
        $productlist=get_dssp_admin(100); 
        include "view/page-products-list.php";
        break;
      case 'addproduct':
        if (isset($_POST['addproduct'])) {
          //lấy dữ liệu về
          $name = $_POST["name"];
          $price = $_POST["price"];
          $old_price = $_POST["old_price"];
          $describe1 = $_POST["describe1"];
          $describe2 = $_POST["describe2"];
          // $best = $_POST["best"];
          // $hot = $_POST["hot"];
          // $new = $_POST["new"];
          $iddm = $_POST["iddm"];
          $img = $_FILES["img"]['name'];

          //upload hình
          $target_file = IMG_PATH_ADMIN.$img;
          move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

          //insert into
          sanpham_insert($name, $img, $price, $old_price, $describe1, $describe2, $iddm);

          //trở về trang dssp
          $productlist=get_dssp_admin(100); 
          include "view/page-products-list.php";
        } else {
          $categorylist=danhmuc_all();
          include "view/page-form-product.php";
        }
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
          $img=IMG_PATH_ADMIN.get_img_dm($id);
          if(is_file($img)){
            unlink($img);
          }
          try {
            danhmuc_delete($id);
          } catch(\Throwable $th){
            //throw $th;
            echo"<h3 style='color:red; text-align:center' >Danh mục này là khóa ngoại! Không được quyền xóa!</h3>";
          }
        } 
        //trở về trang dm
        $cataloglist = danhmuc_all();  
        include "view/page-categories.php";
        break;
      break;
      case 'updatedm':
        //kiem tra va lay du lieu
        if(isset($_POST['updatedm'])){
          //lấy dữ liệu về
          $id = $_POST["id"];
          $name = $_POST["name"];

          $img = $_FILES["img"]['name'];
          if($img!=""){
            //upload hình
            $target_file = IMG_PATH_ADMIN.$img;
            move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

            //xóa hình cũ trên host
            $old_img=IMG_PATH_ADMIN.$_POST['old_img'];
            if(file_exists($old_img)) unlink($old_img);

          } else {
            $img="";
          }
          //update
          danhmuc_update($name, $img, $id);
        }

        //show dm
        $cataloglist = danhmuc_all();  
        include "view/page-categories.php";
        break;
      case 'page-update-dm':
        if(isset($_GET['id'])&&($_GET['id']>0)){
          $id=$_GET['id'];
          $dm=danhmuc_all();
        } 
        //trở về trang dm
        $cataloglist = danhmuc_all();  
        include "view/page-update-dm.php";
      break;
      case 'orders':
        include "view/page-orders.php";
        break;
      case 'orders-detail':
        include "view/page-orders-detail.php";
        break;
      case 'sellers-list':
        $listuser=loadall_user();
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