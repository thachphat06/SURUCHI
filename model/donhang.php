<?php
require_once 'pdo.php';
function order_insert_id($mahd, $iduser, $nguoidat_ten, $nguoidat_email, $nguoidat_tel, $nguoidat_diachi, $note, $total, $ship, $voucher, $tongthanhtoan, $pttt, $date, $time){
    $sql = "INSERT INTO orders (mahd, iduser, nguoidat_ten, nguoidat_email, nguoidat_tel, nguoidat_diachi, note, total, ship, voucher, tongthanhtoan, pttt, date, time) VALUES (?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?, ?, ?)";   
    return pdo_execute_id($sql, $mahd, $iduser, $nguoidat_ten, $nguoidat_email, $nguoidat_tel, $nguoidat_diachi, $note, $total, $ship, $voucher, $tongthanhtoan, $pttt, $date, $time);
}

function get_order(){
    $sql = "SELECT * FROM orders ORDER BY id";
    return pdo_query($sql);
}
function get_order_desc(){
    $sql = "SELECT * FROM orders ORDER BY id DESC";
    return pdo_query($sql);
}

function get_order_by_id($id){
    $sql = "SELECT * FROM orders WHERE id=?";
    return pdo_query_one($sql, $id);
}


function get_status($id){
    $sql = "SELECT status FROM orders WHERE id=".$id;
    $kq = pdo_query_one($sql);
    return $kq["status"];
}

// function get_status($id){
//     $sql = "SELECT status FROM orders WHERE id=".$id;
//     return pdo_query($sql);
// }

function update_status($id, $status) {
    $sql = "UPDATE orders SET status = ? WHERE id = ?";
    pdo_execute($sql, $status, $id);
}
