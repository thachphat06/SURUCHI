<?php
    require_once 'pdo.php';

function cart_insert($idpro , $price, $name, $img, $soluong, $thanhtien, $idbill ){
    $sql = "INSERT INTO cart(idpro, price, name, img, soluong, thanhtien, idbill) VALUES (?, ?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $idpro , $price, $name, $img, $soluong, $thanhtien, $idbill);
}

// function get_tongdonhang(){
//     $sum=0;
//     foreach ($_SESSION['giohang'] as $sp) {
//         extract($sp);
//         $tt= (int)$price* (int)$amount;
//         $sum += $stt;
//     }
//     return $sum;
// }
function get_tongdonhang() {
    // Ghi code để tính tổng đơn hàng của bạn ở đây
    // Ví dụ:
    $total = 0;

    // Lặp qua từng sản phẩm trong giỏ hàng
    foreach ($_SESSION['giohang'] as $sp) {
        $amount = $sp['amount'];
        $gia = $sp['price'];
        $thanhtien = $amount * $gia;

        $total += $thanhtien;
    }

    return $total;
}
?>  