<?php
  session_start();
  ob_start();
  
  // nhúng kết nối csdl
  include "dao/pdo.php";

  include "view/header.php";

  if(!isset($_GET['pg'])) {
    include "view/home.php";
  } else {
    switch ($_GET['pg']) {
      case 'login':
        include "view/login.php";
        break;
      case 'my-account':
        include "view/my-account.php";
        break;
      case 'my-account-2':
        include "view/my-account-2.php";
        break;
      case 'shop':
        include "view/shop.php";
        break;
      case 'product-detail':
        include "view/product-detail.php";
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
        include "view/blog-detail.php";
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