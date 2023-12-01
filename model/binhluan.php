<?php
require_once 'pdo.php';

function comment_insert($iduser, $idpro, $content, $date, $time, $rating) {
    $sql = "INSERT INTO comment (iduser, idpro, content, date, time, rating) VALUES (?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $iduser, $idpro, $content, $date, $time, $rating);
}

function comment_delete($id){
    $sql = "DELETE FROM comment WHERE id=?";
    if(is_array($id)){
        foreach ($id as $ma) {
            pdo_execute($sql, $ma);
        }
    }
    else{
        pdo_execute($sql, $id);
    }
}

// function comment_select_all(){
//     $sql = "SELECT * FROM comment ORDER BY id DESC";
//     return pdo_query($sql);
// }

function comment_select_by_idpro($idpro){
    $sql = "SELECT c.*, u.name, u.img
            FROM comment c
            JOIN users u ON c.iduser = u.id
            WHERE c.idpro = ?
            ORDER BY c.id DESC";
    return pdo_query($sql, $idpro);
}

function comment_select_all(){
    $sql = "SELECT comment.*, users.id AS user_id, users.name AS user_name, users.img AS user_img, product.name AS product_name
            FROM comment
            INNER JOIN users ON comment.iduser = users.id
            INNER JOIN product ON comment.idpro = product.id
            ORDER BY comment.id DESC";

    return pdo_query($sql);
}
// function binh_luan_select_by_id($ma_bl){
//     $sql = "SELECT * FROM binh_luan WHERE ma_bl=?";
//     return pdo_query_one($sql, $ma_bl);
// }

function binh_luan_exist($ma_bl){
    $sql = "SELECT count(*) FROM binh_luan WHERE ma_bl=?";
    return pdo_query_value($sql, $ma_bl) > 0;
}
function count_comments_by_idpro($idpro) {
    $sql = "SELECT COUNT(*) as total_comments FROM comment WHERE idpro = ?";
    $result = pdo_query_one($sql, $idpro);
    // Trả về số lượng bình luận hoặc 0 nếu có lỗi
    return ($result && isset($result['total_comments'])) ? $result['total_comments'] : 0;
}
//-------------------------------//
// function binh_luan_select_by_hang_hoa($ma_hh){
//     $sql = "SELECT b.*, h.ten_hh FROM binh_luan b JOIN hang_hoa h ON h.ma_hh=b.ma_hh WHERE b.ma_hh=? ORDER BY ngay_bl DESC";
//     return pdo_query($sql, $ma_hh);
// }
