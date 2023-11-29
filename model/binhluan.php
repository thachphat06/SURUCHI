<?php
require_once 'pdo.php';

function comment_insert($iduser, $idpro, $content, $date, $time, $rating) {
    $sql = "INSERT INTO comment (iduser, idpro, content, date, time, rating) VALUES (?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $iduser, $idpro, $content, $date, $time, $rating);
}

function comment_delete($ma_bl){
    $sql = "DELETE FROM comment WHERE ma_bl=?";
    if(is_array($ma_bl)){
        foreach ($ma_bl as $ma) {
            pdo_execute($sql, $ma);
        }
    }
    else{
        pdo_execute($sql, $ma_bl);
    }
}

// function comment_select_all(){
//     $sql = "SELECT * FROM comment ORDER BY id DESC";
//     return pdo_query($sql);
// }

function comment_select_all($iduser, $idpro){
    $sql = "SELECT c.*, u.name, u.img
            FROM comment c
            JOIN users u ON c.iduser = u.id
            WHERE c.iduser = ? AND c.idpro = ?
            ORDER BY c.id DESC";
    return pdo_query($sql, $iduser, $idpro);
}

// function binh_luan_select_by_id($ma_bl){
//     $sql = "SELECT * FROM binh_luan WHERE ma_bl=?";
//     return pdo_query_one($sql, $ma_bl);
// }

function binh_luan_exist($ma_bl){
    $sql = "SELECT count(*) FROM binh_luan WHERE ma_bl=?";
    return pdo_query_value($sql, $ma_bl) > 0;
}
function count_comments($iduser, $idpro) {
    $sql = "SELECT COUNT(*) as total_comments FROM comment WHERE iduser = ? AND idpro = ?";
    $result = pdo_query_one($sql, $iduser, $idpro);
    // Trả về số lượng bình luận hoặc 0 nếu có lỗi
    return ($result && isset($result['total_comments'])) ? $result['total_comments'] : 0;
}
//-------------------------------//
// function binh_luan_select_by_hang_hoa($ma_hh){
//     $sql = "SELECT b.*, h.ten_hh FROM binh_luan b JOIN hang_hoa h ON h.ma_hh=b.ma_hh WHERE b.ma_hh=? ORDER BY ngay_bl DESC";
//     return pdo_query($sql, $ma_hh);
// }
