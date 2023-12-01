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
  include "model/binhluan.php";
  include "model/donhang.php";
  include "model/giohang.php";
  include "model/tintuc.php";
  include "model/dmuc-tintuc.php";
  include "model/user.php";

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
        $tbdk="";
        include "view/login.php";
        break;
      case 'signin':
        $tbdk="";
        //input
        if(isset($_POST["login"])) {
          $username=$_POST["username"];
          $password=$_POST["password"];
          //xử lý: kiem tra
          $kq=checkuser($username, $password);
          if(is_array($kq)&&(count($kq))) {
            $_SESSION['s_user']=$kq;
            // if($_SESSION['page']=="product-details"){
            //   // header('location: index.php?pg=product-detail&idpro='.$_SESSION['idpro'].'#cmt');
            // } else {
            //   header('location: index.php');
            // }
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
        $tbdk="";
        // xác định giá trị input
        if(isset($_POST["register"])){
          $username=$_POST["username"];
          $password=$_POST["password"];
          $email=$_POST["email"];
          // Xử lý
          if (isUsernameExists($username)) {
            $tbdk="Tài khoản đã tồn tại. Vui lòng chọn một tài khoản khác.";
          } else {
            user_insert($username, $password, $email);
            $tbdk="Đăng ký thành công!";
          }
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
      case 'change-pw':
        $tbpw="";
        if(isset($_POST['change_pw'])){
          $username = $_POST['username'];
          $password = $_POST['pw'];
          $newpassword = $_POST['newpw'];
          $repassword = $_POST['repw'];
          
          // Kiểm tra xác thực mật khẩu và thực hiện đổi mật khẩu
          if (isPasswordExists($password)) {
            if ($newpassword === $repassword) {
              change_password($username, $newpassword);
              $tbpw = "Đổi mật khẩu thành công!";
            }else {
              $tbpw = "Mật khẩu mới không trùng khớp!";
            }
          }else {
            $tbpw = "Mật khẩu hiện tại không chính xác!";
          }  
        }
        include "view/change-pw.php";
        break;  
      case 'my-account-2';
        include "view/my-account-2.php";
        break;
      case 'my-account-3':
        if(isset($_SESSION['s_user'])) {
          $iduser = $_SESSION['s_user']['id'];
        }
        $orderlist=get_orders_by_user($iduser);
        include "view/my-account-3.php";
        break;
      case 'orders-detail':
        if(isset($_GET['id']) && ($_GET["id"] > 0)) {
          $id = $_GET['id'];
          if(isset($_SESSION['s_user'])) {
            $iduser = $_SESSION['s_user']['id'];
          }
          $ordercart = get_cart_by_id($id);
          $orderdetail = get_order_by_id($id);
          include "view/order-detail.php";
        }else {
          include "view/home.php";
        }
        break;
      case 'order-cancelled':
        if(isset($_GET['id']) && $_GET['id'] > 0) {
          $id = $_GET['id'];
          if(isset($_SESSION['s_user'])) {
            $iduser = $_SESSION['s_user']['id'];
          }
          // Lấy trạng thái từ cơ sở dữ liệu hoặc bất kỳ nguồn dữ liệu nào khác
          $status = get_status($id);

          // Kiểm tra xem có phải đơn hàng đang ở trạng thái "Pending" hay không
          update_status($id, 6);
          $orderlist = get_orders_by_user($iduser);
          include "view/my-account-3.php";
        }else {
          include "view/index.php";
        }
        break;
      case 'shop':
        $dsdm=danhmuc_all();
        $kyw="";
        $titledm="";
        $titlepage="";

        if(!isset($_GET['iddm'])){
          $iddm=0;
        }else{
          $iddm=$_GET['iddm'];
          $titledm=get_name_dm($iddm);
        }  

        if (isset($_POST["search"])) {
          $kyw=$_POST["kyw"];
          $titlepage="Tìm kiếm sản phẩm: '$kyw'";
        }
        $dssp=get_dssp($kyw, $iddm, 16);

        include "view/shop.php";
        break;
      case 'product-detail':
        $iduser="";
        if(isset($_GET['idpro'])&&($_GET["idpro"]>0)) {
          $id=$_GET['idpro'];
          $iddm=get_iddm($id);
          $spchitiet=get_sp_by_id($id);
          $splienquan=get_dssp_lienquan($iddm, $id, 4);
          if(isset($_SESSION['s_user'])) {
            $iduser = $_SESSION['s_user']['id'];
          }
          $commentlist = comment_select_all($iduser, $id);
          include "view/product-details.php";
        }else {
          include "view/home.php";
        }
        break;
      case 'process-comment':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Kiểm tra xem các trường cần thiết có tồn tại không
          if (isset($_POST['idpro'], $_SESSION['s_user']['id'], $_POST['content'])) {
              $idpro = $_POST['idpro'];
              $iduser = $_SESSION['s_user']['id'];
              $content = $_POST['content'];
              $rating = $_POST['rating'];
              // Lấy ngày và giờ hiện tại
              var_dump($rating);
              $date = date('Y-m-d');
              $time = date('H:i:s');
              // Thực hiện chèn bình luận
              comment_insert($iduser, $idpro, $content, $date, $time, $rating);
              // Chuyển hướng sau khi thêm bình luận
              header("Location: index.php?pg=product-detail&idpro=$idpro");
              exit();
          }
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
          header('location: index.php?pg=checkout');
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
        $tbdn="";
        if (isset($_SESSION['s_user'])){
          if (isset($_POST['btnpay'])) {
            $nguoidat_ten = $_POST['name'];
            $nguoidat_tel = $_POST['sdt'];
            $nguoidat_diachi = $_POST['address'];
            $nguoidat_email = $_POST['email'];
            $note = $_POST['note'];
            $pttt = isset($_POST['pttt']) ? $_POST['pttt'] : '';
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $datetime = new DateTime($formatted_date);
            $date = $datetime->format('Y-m-d');
            $time = $datetime->format('H:i:s');
            $iduser = $_SESSION['s_user']['id'];
            $mahd = "Suruchi".rand(1,999);
            $total = get_tongdonhang();
            $ship = 30000;
            if (isset($_SESSION['giatrivoucher'])) {
              $voucher = $_SESSION['giatrivoucher'];
            } else {
              $voucher = 0;
            }
            $tongthanhtoan = ($total - $voucher) + $ship;
            $_SESSION['customer_info'] = array(
              'name' => $nguoidat_ten,
              'sdt' => $nguoidat_tel,
              'address' => $nguoidat_diachi,
              'email' => $nguoidat_email,
            );
            $idbill = order_insert_id($mahd, $iduser, $nguoidat_ten, $nguoidat_email, $nguoidat_tel, $nguoidat_diachi, $note, $total, $ship, $voucher, $tongthanhtoan, $pttt, $date, $time);
            foreach ($_SESSION['giohang'] as $sp) {
              extract($sp);
              cart_insert($id, $price, $name, $img, $amount, $thanhtien, $idbill);
            }
            header('location: index.php?pg=checkout-2&mahd='.$mahd);
          }
        }else{
          $tbdn='<p class="layout__flex--item">
                  <span style="color:red; font-weight:500">Bạn cần đăng nhập để thanh toán ! </span>
                  <a class="layout__flex--item__link" href="index.php?pg=signin-signup">Đăng nhập</a>
                </p>';
        }
        include "view/checkout.php";
        break;
      case 'checkout-2':
        if(isset($_SESSION['customer_info'])) {
          // Lấy thông tin khách hàng từ session
          $customer_info = $_SESSION['customer_info'];
        }
          include "view/checkout-2.php";
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