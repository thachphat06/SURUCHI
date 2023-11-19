<?php
require_once 'pdo.php';

/**
 * Truy vấn tất cả các loại
 * @return array mảng loại truy vấn được
 * @throws PDOException lỗi truy vấn
 */
function dmuc_all(){
    $sql = "SELECT * FROM blog_category ORDER BY stt";
    return pdo_query($sql);
}

function get_name_dmuc($id) {
    $sql = "SELECT name FROM blog_category WHERE id=".$id;
    $kq = pdo_query_one($sql);
    return $kq["name"];
}
