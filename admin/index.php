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
  include "../model/donhang.php";
  include "../model/giohang.php";
  include "../model/user.php";
  include "../model/tintuc.php";
  include "../model/dmuc-tintuc.php";
  include "../model/global.php";

  include "view/header.php";
  if(!isset($_GET['pg'])){
    $orderlist=get_order();
    $count_product=product_all();
    include "view/home.php";
  }else{
    switch ($_GET['pg']){
      case 'update-role':
        if(isset($_GET['id']) && $_GET['id'] > 0) {
          $id = $_GET['id'];

          update_role($id, 1);
          
          $listuser=loadall_user();
          include "view/page-user-list.php";
        }else {
          include "view/home.php";
        }
        break;
      case 'abort-role':
        if(isset($_GET['id']) && $_GET['id'] > 0) {
          $id = $_GET['id'];

          update_role($id, 0);
          $listuser=loadall_user();

          include "view/page-user-list.php";
        }else {
          include "view/home.php";
        }
        break;
      case 'products-list':
        $dsdm=danhmuc_all();
        $kyw="";
        if(!isset($_GET['iddm'])){
          $iddm=0;
        }else{
          $iddm=$_GET['iddm'];
        }

        if (isset($_POST["search"])) {
          $kyw=$_POST["kyw"];
        }
        $productlist=get_dssp_admin($kyw, $iddm, 100); 
        include "view/page-products-list.php";
        break;
      case 'updateproduct':
        $dsdm=danhmuc_all();
        $kyw="";
        $iddm="";
        //kiem tra va lay du lieu
        if(isset($_POST['updateproduct'])){
          //lấy dữ liệu về
          $name = $_POST["name"];
          $price = $_POST["price"];
          $old_price = $_POST["old_price"];
          $describe1 = $_POST["describe1"];
          $describe2 = $_POST["describe2"];
          $iddm = $_POST["iddm"];
          $id = $_POST["id"];
          if(isset($_POST['bestseller'])){
            $bestseller = $_POST["bestseller"];
            if($bestseller='checked') $bestseller=1; else $bestseller=0;
          }else{
            $bestseller=0;
          }
          if(isset($_POST['hot'])){
            $hot = $_POST["hot"];
            if($hot='checked') $hot=1; else $hot=0;
          }else{
            $hot=0;
          }
          if(isset($_POST['new'])){
            $new = $_POST["new"];
            if($new='checked') $new=1; else $new=0;
          }else{
            $new=0;
          }
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
          sanpham_update($name, $img, $price, $old_price, $describe1, $describe2, $bestseller, $hot, $new, $iddm, $id);
        }

        //show dssp
        $productlist=get_dssp_admin($kyw, $iddm, 100); 
        include "view/page-products-list.php";
        break;
      case 'page-add-product':
        $categorylist = danhmuc_all();
        include "view/page-add-product.php";
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
        $dsdm=danhmuc_all();
        $kyw="";
        $iddm="";
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
        $productlist=get_dssp_admin($kyw, $iddm, 100); 
        include "view/page-products-list.php";
        break;
      case 'addproduct':
        if (isset($_POST['addproduct'])) {
          $dsdm=danhmuc_all();
          $kyw="";
          //lấy dữ liệu về
          $name = $_POST["name"];
          $price = $_POST["price"];
          $old_price = $_POST["old_price"];
          $describe1 = $_POST["describe1"];
          $describe2 = $_POST["describe2"];
          $iddm = $_POST["iddm"];
          if(isset($_POST['bestseller'])){
            $bestseller = $_POST["bestseller"];
            if($bestseller=1) $bestseller=1; else $bestseller=0;
          }else{
            $bestseller=0;
          }
          if(isset($_POST['hot'])){
            $hot = $_POST["hot"];
            if($hot=1) $hot=1; else $hot=0;
          }else{
            $hot=0;
          }
          if(isset($_POST['new'])){
            $new = $_POST["new"];
            if($new=1) $new=1; else $new=0;
          }else{
            $new=0;
          }
          $img = $_FILES["img"]['name'];
          //upload hình
          $target_file = IMG_PATH_ADMIN.$img;
          move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

          //insert into
          sanpham_insert($name, $img, $price, $old_price, $describe1, $describe2, $bestseller, $hot, $new, $iddm);

          //trở về trang dssp
          $productlist=get_dssp_admin($kyw, $iddm, 100); 
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
        $orderlist=get_order();
        include "view/page-orders.php";
        break;
      case 'orders-detail':
        if(isset($_GET['id']) && ($_GET["id"] > 0)) {
          $id = $_GET['id'];
  
          $ordercart = get_cart_by_id($id);
          $orderdetail = get_order_by_id($id);
          include "view/page-orders-detail.php";
        }else {
          include "view/home.php";
        }
        break;  
      case 'order-pending':
        if(isset($_GET['id']) && $_GET['id'] > 0) {
          $id = $_GET['id'];
          
          // Lấy trạng thái từ cơ sở dữ liệu hoặc bất kỳ nguồn dữ liệu nào khác
          $status = get_status($id);
  
          update_status($id, 1);
          $orderlist=get_order();
          include "view/page-orders.php";
        }else {
          include "view/home.php";
        }
        break;
      case 'order-confirm':
        if(isset($_GET['id']) && $_GET['id'] > 0) {
          $id = $_GET['id'];
          
          // Lấy trạng thái từ cơ sở dữ liệu hoặc bất kỳ nguồn dữ liệu nào khác
          $status = get_status($id);
  
          update_status($id, 2);
          $orderlist=get_order();
          include "view/page-orders.php";
        }else {
          include "view/home.php";
        }
        break;
      case 'order-delivering':
        if(isset($_GET['id']) && $_GET['id'] > 0) {
          $id = $_GET['id'];
          
          // Lấy trạng thái từ cơ sở dữ liệu hoặc bất kỳ nguồn dữ liệu nào khác
          $status = get_status($id);
  
          update_status($id, 3);
          $orderlist=get_order();
          include "view/page-orders.php";
        }else {
          include "view/home.php";
        }
        break;  
      case 'order-complete':
        if(isset($_GET['id']) && $_GET['id'] > 0) {
          $id = $_GET['id'];
          
          // Lấy trạng thái từ cơ sở dữ liệu hoặc bất kỳ nguồn dữ liệu nào khác
          $status = get_status($id);
  
          update_status($id, 4);
          $orderlist=get_order();
          include "view/page-orders.php";
        }else {
          include "view/home.php";
        }
        break;
      case 'order-fail':
        if(isset($_GET['id']) && $_GET['id'] > 0) {
          $id = $_GET['id'];
          
          // Lấy trạng thái từ cơ sở dữ liệu hoặc bất kỳ nguồn dữ liệu nào khác
          $status = get_status($id);
  
          update_status($id, 5);
          $orderlist=get_order();
          include "view/page-orders.php";
        }else {
          include "view/home.php";
        }
        break;
      case 'user-list':
        $listuser=loadall_user();
        include "view/page-user-list.php";
        break;
      case 'deluser':
        if(isset($_GET['id'])&&($_GET['id']>0)){
          $id=$_GET['id'];
          $img=IMG_PATH_ADMIN.get_img_user($id);
          if(is_file($img)){
            unlink($img);
          }
          try {
            user_delete($id);
          } catch(\Throwable $th){
            //throw $th;
            echo"<h3 style='color:red; text-align:center' >User này là khóa ngoại! Không được quyền xóa!</h3>";
          }
        } 
        //trở về trang user
        $listuser=loadall_user();
        include "view/page-user-list.php";
        break;
      
      case 'page-blog-list':
        $dsdm = dmuc_all();
        $kyw = "";
        if (!isset($_GET['iddm'])) {
          $iddm = 0;
        } else {
          $iddm = $_GET['iddm'];
        }
  
        if (isset($_POST["search"])) {
          $kyw = $_POST["kyw"];
        }
        $bloglist = get_dsblog($kyw, $iddm, 100);
        include "view/page-blog-list.php";
        break;
      case 'addblog':
        $tintuclist = dmuc_all();
        include "view/page-add-blog.php";
        break;
      case 'page-add-blog':
        if (isset($_POST['addblog'])) {
          $dsdm = dmuc_all();
          $kyw = "";
          //Lấy dữ liệu về
          $author = $_POST['author'];
          $date = $_POST['date'];
          $title = $_POST['title'];
          $content = $_POST['content'];
          $iddm = $_POST['iddm'];
          $img = $_FILES['img']['name'];
          //upload hình
          $target_file = IMG_PATH_ADMIN . $img;
          move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
  
          //Insert into
          blog_insert($author, $date, $title, $content, $img, $iddm);
          // Chuyển hướng người dùng sau khi thêm tin tức
          header("Location: index.php?pg=page-blog-list");
          exit(); //
  
          // //trở về trang dstt
          // $bloglist = get_dsblog($kyw, $iddm, 100);
          // include "view/page-blog-list.php";
        } else {
          $tintuclist = dmuc_all();
          include "view/page-add-blog.php";
        }
        break;
      case 'delblog':
        $dsdm = danhmuc_all();
        $kyw = "";
        $iddm = "";
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
          $id = $_GET['id'];
          $img = IMG_PATH_ADMIN . get_img($id);
          if (is_file($img)) {
            unlink($img);
          }
          try {
            blog_delete($id);
          } catch (\Throwable $th) {
            //throw $th;
            echo "<h3 style='color:red; text-align:center' >Tin tức đặc biệt! Không được quyền xóa!</h3>";
          }
        }
        //trở về trang dstt
        $bloglist = get_dsblog($kyw, $iddm, 100);
        include "view/page-blog-list.php";
        break;
      case 'page-update-blog':
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
          $id = $_GET['id'];
          $tt = get_tt_by_id($id);
        }
        //trở về trang dstt
        $tintuclist = dmuc_all();
        include "view/page-update-blog.php";
        break;
      case 'updateblog':
        $dsdm = danhmuc_all();
        $kyw = "";
        $iddm = "";
        //kiểm tra và lấy dữ liệu
        if(isset($_POST['updateblog'])){
          $author = $_POST['author'];
          $date = $_POST['date'];
          $title = $_POST['title'];
          $content = $_POST['content'];
          $iddm = $_POST['iddm'];
          $id = $_POST['id'];
          $img = $_FILES['img']['name'];
          if ($img != "") {
            //upload hình
            $target_file = IMG_PATH_ADMIN . $img;
            move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
  
            //xóa hình cũ trên host
            $old_img = IMG_PATH_ADMIN . $_POST['old_img'];
            if (file_exists($old_img))
              unlink($old_img);
  
          } else {
            $img = "";
          }
          //Insert into
          blog_update($author, $date, $title, $content, $img, $id);
          
        }
        //
  
        //
  
        //trở về trang dstt
        $bloglist = get_dsblog($kyw, $iddm, 100);
        include "view/page-blog-list.php";
        break;
      default:
        include "view/home.php";
        break;
    }
  }
  include "view/footer.php";
?>