<?php
require_once 'pdo.php';
function bill_insert_id($mahd, $iduser, $nguoidat_ten, $nguoidat_email, $nguoidat_tel, $nguoidat_diachi, $total, $ship, $voucher, $tongthanhtoan, $pttt, $ngaymua){
    $sql = "INSERT INTO bill(mahd, iduser, nguoidat_ten, nguoidat_email, nguoidat_tel, nguoidat_diachi, total, ship, voucher, tongthanhtoan, pttt, ngaymua) VALUES (?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?)";   
    return pdo_execute_id($sql, $mahd, $iduser, $nguoidat_ten, $nguoidat_email, $nguoidat_tel, $nguoidat_diachi, $total, $ship, $voucher, $tongthanhtoan, $pttt, $ngaymua);
}