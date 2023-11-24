<?php
  session_start();
  ob_start();
  if(!isset($_SESSION["giohang"])) {
    $_SESSION["giohang"]=[];
  }
  
  // nhúng kết nối csdl
  include "model/pdo.php";
  include "model/global.php";
  include "model/sanpham.php";
  include "model/danhmuc.php";
  include "model/dmuc-tintuc.php";
  include "model/tintuc.php";
  include "model/user.php";
  include "model/donhang.php";
  include "model/giohang.php";

  include "view/header.php";

  if(!isset($_GET['pg'])) {
    $dssp_new=get_new(10);
    $dssp_hot=get_hot(10);
    $dssp_best=get_best(10);
    $dssp_best2=get_best(10);
    $dsblog=get_blog(6);
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
      case 'my-account-2';
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
        $dssp_new=get_new(10);
        if(isset($_GET['del'])&&($_GET['del']==1)) {
          unset($_SESSION["giohang"]);
          header('location: index.php?pg=cart');
        }else{
          include "view/cart.php";
        }
        break;
      case 'addcart':
        if (isset($_POST["btnaddcart"])) {
          $id = $_POST['id'];
          $name = $_POST["name"];
          $img = $_POST["img"];
          $amount = $_POST["amount"];
          $price = $_POST["price"];
          $thanhtien = (int)$amount * (int)$price;
          $sp = array("id" => $id, "name" => $name, "img" => $img, "price" => $price, "amount" => $amount, "thanhtien" => $thanhtien);

          // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
          $productExists = false;
          foreach ($_SESSION['giohang'] as &$item) {
            // Nếu sản phẩm đã tồn tại, tăng số lượng
              if ($item['id'] == $id) {
                  $item['amount'] += $amount;
                  $sp['thanhtien'] = (int)$sp['amount'] * (int)$price;
                  $productExists = true;
                  break;
              }
          }

          if (!$productExists) {
              // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
              array_push($_SESSION['giohang'], $sp);
          }
          echo '<script>updateCartItemCount();</script>';
          header('location: index.php?pg=cart');
        }
        // Trang PHP nơi bạn muốn thực hiện thêm sản phẩm vào giỏ hàng
        include_once("./controller/AddToCart.php");
        break;
      case 'checkoutcart':
        if(isset($_POST['btncheckout']) && ($_POST['btncheckout'])){
          $id= $_POST['id'];
          $name= $_POST['name'];
          $img= $_POST['img'];
          $price= $_POST['price'];
          if(isset($_POST['amount']) && ($_POST['amount'] > 0)){
            $amount = $_POST['amount'];
        }else{
            $amount = 1;
        }
          $sp=["id"=>$id,"name"=>$name,"img"=>$img,"price"=>$price,"amount"=>$amount];
          $_SESSION['thanhtoan'][]=$sp;
          header('Location: index.php?pg=checkout-2');
        }
        break;
      case 'delcart':
        if(isset($_GET['ind'])&&($_GET['ind']>=0)) {
          array_splice($_SESSION['giohang'],$_GET['ind'],1);
          header('location: index.php?pg=cart');
        }
        break;
      case 'delcart-box':
        if(isset($_GET['ind'])&&($_GET['ind']>=0)) {
          array_splice($_SESSION['giohang'],$_GET['ind'],1);
          header('location: index.php');
        }
        break;
      case 'checkout':
        include "view/checkout.php";
        break;
      case 'checkout-2':
        if (isset($_SESSION['s_user'])){
          if (isset($_POST['donhangsubmit'])) {
            $nguoidat_ten = $_POST['hoten'];
            $nguoidat_tel = $_POST['sdt'];
            $nguoidat_diachi = $_POST['diachi'];
            $nguoidat_email = $_POST['email'];
            $pttt = isset($_POST['pttt']) ? $_POST['pttt'] : '';
            $ngaymua = date("Y-m-d H:i:s");
            $username = "guest".rand(1,999);
            $password = "123456";
            $iduser = user_insert_id($username, $password, $nguoidat_ten, $nguoidat_diachi, $nguoidat_email, $nguoidat_tel);
            $mahd = "Suruchi" . $iduser;
            $total = get_tongdonhang();
            $ship = 0;
            if (isset($_SESSION['giatrivoucher'])) {
                $voucher = $_SESSION['giatrivoucher'];
            } else {
                $voucher = 0;
            }
            $tongthanhtoan = ($total - $voucher) + $ship;
            $_SESSION['customer_info'] = array(
                'hoten' => $nguoidat_ten,
                'sdt' => $nguoidat_tel,
                'diachi' => $nguoidat_diachi,
                'email' => $nguoidat_email,
            );
    
            $idbill = bill_insert_id($mahd, $iduser, $nguoidat_ten, $nguoidat_email, $nguoidat_tel, $nguoidat_diachi, $total, $ship, $voucher, $tongthanhtoan, $pttt, $ngaymua);
            foreach ($_SESSION['giohang'] as $sp) {
              extract($sp);
              cart_insert($id, $price, $name, $img, $amount, $thanhtien, $idbill);
            }
            header('location: index.php?pg=checkout-3&mahd='.$mahd);
          }
        }else{
          echo'Bạn cần đăng nhập để thanh toán !';
        }
        include "view/checkout-2.php";
        break;
      case 'checkout-3':
        if(isset($_SESSION['customer_info'])) {
          // Lấy thông tin khách hàng từ session
          $customer_info = $_SESSION['customer_info'];
        }
          include "view/checkout-3.php";
      break;
      case 'checkout-4':
        include "view/checkout-4.php";
        break;
      case 'blog':
        $dmtintuc=dmuc_all();
        $kyw="";
        $titlepage="";

        if(!isset($_GET['idloai'])){
          $idloai=0;
        }else{
          $idloai=$_GET['idloai'];
          $titlepage=get_name_dmuc($idloai);
        } 

        if (isset($_POST["search"])) {
          $kyw=$_POST["kyw"];
          $titlepage="Kết quả tìm kiếm với từ khóa: ".$kyw;
        }
        $dsblog=get_dsblog($kyw, $idloai, 16);  
        include "view/blog.php";
        break;
      case 'blog-detail':
        if(isset($_GET['idblog'])&&($_GET["idblog"]>0)) {
          $id=$_GET['idblog'];
          $idloai=get_iddmuc($id);
          $blogchitiet=get_blog_by_id($id);
          $bloglienquan=get_blog_lienquan($idloai, $id, 2);
          include "view/blog-details.php";
        }else {
          include "view/home.php";
        }
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