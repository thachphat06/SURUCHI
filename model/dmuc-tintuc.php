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

//admin
function showdmtt_admin($dsdm, $iddm){
    $html_dm='';
    foreach ($dsdm as $dm) {
        extract($dm);
        if($id==$iddm){
            $se="selected";
        } else{
            $se="";
        } 
        // $link='index.php?pg=dmuc-tintuc&iddm=' .$id;
        $html_dm.='<option value="'.$id.'" '.$se.'>'.$name.'</option>';
    }
    return $html_dm;
}

