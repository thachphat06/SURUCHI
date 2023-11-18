<?php
  session_start();
  ob_start();
  
  // nhúng kết nối csdl
  include "model/pdo.php";
  include "model/global.php";
  include "model/sanpham.php";
  include "model/danhmuc.php";
  include "model/user.php";

  include "view/header.php";

  if(!isset($_GET['pg'])) {
    $dssp_new=get_new(10);
    $dssp_hot=get_hot(10);
    $dssp_best=get_best(10);
    $dssp_best2=get_best(10);
    include "view/home.php";
  } else {
    switch ($_GET['pg']) {
      case 'signin-signup':
        include "view/login.php";
        break;
      case 'signin':
        //input
        if(isset($_POST["login"])) {
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
        if(isset($_POST["register"])){
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
        if(isset($_POST["update"])) {
          $username=$_POST["username"];
          // $password=$_POST["password"];
          $email=$_POST["email"];
          $name=$_POST["name"];
          $address=$_POST["address"];
          $sdt=$_POST["sdt"];
          $id=$_POST["id"];
          $role=0;

          $img=$_FILES["img"]["name"];
          $target_file = IMG_PATH_USER.basename($img);
          if($img!=""){
            //upload hình
            $target_file = IMG_PATH_USER.$img;
            move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
            
            //xóa hình cũ trên host
            $old_img=IMG_PATH_USER.$_POST['old_img'];
            if(file_exists($old_img)) unlink($old_img);

          } else {
            $img="";
          }
            //xử lý
          user_update($username, $password, $email, $name, $img, $address, $sdt, $role, $id);

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
        $dsdm=danhmuc_all();
        $kyw="";
        $titlepage="";

        if(!isset($_GET['iddm'])){
          $iddm=0;
        }else{
            $iddm=$_GET['iddm'];
            $titlepage=get_name_dm($iddm);
        }  

        if (isset($_POST["search"])) {
          $kyw=$_POST["kyw"];
          $titlepage="Kết quả tìm kiếm với từ khóa: ".$kyw;
        }
        $dssp=get_dssp($kyw, $iddm, 16);

        include "view/shop.php";
        break;
      case 'product-detail':
        if(isset($_GET['idpro'])&&($_GET["idpro"]>0)) {
          $id=$_GET['idpro'];
          $iddm=get_iddm($id);
          $spchitiet=get_sp_by_id($id);
          $splienquan=get_dssp_lienquan($iddm, $id, 4);
          include "view/product-details.php";
      }else {
          include "view/home.php";
      }
        break;
      case 'cart':
        if(isset($_GET['del'])&&($_GET['del']==1)) {
          unset($_SESSION["giohang"]);
          header('location: index.php?pg=cart');
        }else{
            include "view/cart.php";
        }
        break;
      case 'addcart':
        if(isset($_POST["btnaddcart"])&&($_POST['btnaddcart'])) {
          $id=$_POST['id'];
          $name=$_POST["name"];
          $img=$_POST["img"];
          $amount=$_POST["amount"]; 
          $price=$_POST["price"];
          $thanhtien=(int)$amount * (int)$price;
          $sp=["id"=>$id, "name"=>$name, "img"=>$img, "price"=>$price, "amount"=>$amount, "thanhtien"=>$thanhtien];
          $_SESSION['giohang'][]=$sp;
          header('location: index.php?pg=cart');
        }
        break;
      case 'delcart':
        if(isset($_GET['ind'])&&($_GET['ind']>=0)) {
          array_splice($_SESSION['giohang'],$_GET['ind'],1);
          header('location: index.php?pg=cart');
        }
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