<?php
  session_start();
  ob_start();
  
  // nhúng kết nối csdl
  include "model/pdo.php";
  include "model/user.php";

  include "view/header.php";

  if(!isset($_GET['pg'])) {
    include "view/home.php";
  } else {
    switch ($_GET['pg']) {
      case 'signin-signup':
        include "view/login.php";
        break;
      case 'signin':
        //input
        if(isset($_POST["login"])&&($_POST["login"])) {
          $username=$_POST["username"];
          $password=$_POST["password"];
          //xử lý: kiem tra
          $kq=checkuser($username, $password);
          if(is_array($kq)&&(count($kq))) {
              $_SESSION['s_user']=$kq;
              header('location: index.php');
          }else{
              $tb="Tài khoản không tồn tại hoặc thông tin đăng nhập sai !";
              $_SESSION['tb_dangnhap']=$tb;
              header('location: index.php?pg=signin-signup');
          }
          //xl
        }
        break;
      case 'logout':
        if(isset($_SESSION['s_user'])&&(count($_SESSION['s_user'])>0)) {
            unset($_SESSION['s_user']);
        }
        header('location: index.php');
        break;
      case 'adduser':
        // xác định giá trị input
        if(isset($_POST["register"])&&($_POST["register"])){
          $username=$_POST["username"];
          $password=$_POST["password"];
          $email=$_POST["email"];
          //xử lý
          user_insert($username, $password, $email);
        }
        include "view/login.php";
        break;
      case 'updateuser':
        // xác định giá trị input
        if(isset($_POST["update"])&&($_POST["update"])) {
          $username=$_POST["username"];
          // $password=$_POST["password"];
          $email=$_POST["email"];
          $name=$_POST["name"];
          $address=$_POST["address"];
          $sdt=$_POST["sdt"];
          $id=$_POST["id"];
          $role=0;
            //xử lý
          user_update($username, $password, $email, $name, $address, $sdt, $role, $id);
          include "view/my-account.php";
        }
        break;
      case 'my-account':
        if(isset($_SESSION['s_user'])&&(count($_SESSION['s_user'])>0)) {
          include "view/my-account.php";
        }
        break;
      case 'my-account-2':
        include "view/my-account-2.php";
        break;
      case 'my-account-3':
        include "view/my-account-3.php";
        break;
      case 'shop':
        include "view/shop.php";
        break;
      case 'product-detail':
        include "view/product-detail.php";
        break;
      case 'add-cart':
        include "view/cart.php";
        break;
      case 'del-cart':
        include "view/cart.php";
        break;
      case 'cart':
        include "view/cart.php";
        break;
      case 'checkout':
        include "view/checkout.php";
        break;
      case 'checkout-2':
        include "view/checkout-2.php";
        break;
      case 'checkout-3':
        include "view/checkout-3.php";
        break;
      case 'checkout-4':
        include "view/checkout-4.php";
        break;
      case 'blog':
        include "view/blog.php";
        break;
      case 'blog-detail':
        include "view/blog-details.php";
        break;
      case 'about':
        include "view/about.php";
        break;
      case 'contact':
        include "view/contact.php";
        break;
        
      case 'privacy-policy':
        include "view/privacy-policy.php";
        break;
      case '404':
        include "view/404.php";
        break;
  
      default:
        include "view/home.php";
        break;
    }
  }

  include "view/footer.php";
?>