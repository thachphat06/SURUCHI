<?php
require_once 'pdo.php';

function get_iddmuc($id) {
    $sql = "SELECT idloai FROM blog WHERE id=?";
    return pdo_query_value($sql, $id);
}

function get_blog($limi){
    $sql = " SELECT * FROM blog ORDER BY id limit ".$limi;
    return pdo_query($sql);
}

function get_dsblog($kyw, $idloai, $limi){
    $sql = "SELECT * FROM blog WHERE 1";
    if($idloai>0){
        $sql .=" AND idloai=".$idloai;
    }
    if($kyw!=""){
        $sql .=" AND name LIKE '%".$kyw."%'";
    }

    $sql .= " ORDER BY id DESC LIMIT ".$limi;
    return pdo_query($sql);
}

function get_blog_by_id($id){
    $sql = "SELECT * FROM blog WHERE id=?";
    return pdo_query_one($sql, $id);
}

function get_blog_lienquan($idloai, $id, $limi){
    $sql = "SELECT * FROM blog WHERE $idloai=? AND id<>? ORDER BY view DESC limit  ".$limi;
    return pdo_query($sql, $idloai, $id);
}

function showblog($dsblog){
    $html_dsblog='';
    foreach ($dsblog as $blog) {
    extract($blog);
    
    $link="index.php?pg=blog-detail&idblog=".$id;
    $html_dsblog.='<div class="col mb-30">
                        <div class="blog__items">
                            <div class="blog__thumbnail">
                                <a class="blog__thumbnail--link" href="'.$link.'"><img class="blog__thumbnail--img" src="./view/assets/img/blog/'.$img.'" alt="blog-img"></a>
                            </div>
                            <div class="blog__content">
                                <span class="blog__content--meta">'.$date.'</span>
                                <h3 class="blog__content--title"><a href="'.$link.'">'.$title.'</a></h3>
                                <a class="blog__content--btn primary__btn" href="'.$link.'">Đọc thêm</a>
                            </div>
                        </div>
                    </div>';
    }
    return $html_dsblog;
}

function showblog_slide($dsblog){
    $html_dsblog='';
    foreach ($dsblog as $blog) {
    extract($blog);
    
    $link="index.php?pg=blog-detail&idblog=".$id;
    $html_dsblog.='<div class="swiper-slide">
                        <div class="blog__items">
                            <div class="blog__thumbnail">
                                <a class="blog__thumbnail--link" href="'.$link.'"><img class="blog__thumbnail--img" src="./view/assets/img/blog/'.$img.'" alt="blog-img"></a>
                            </div>
                            <div class="blog__content">
                                <span class="blog__content--meta">'.$date.'</span>
                                <h3 class="blog__content--title"><a href="'.$link.'">'.$title.'</a></h3>
                                <a class="blog__content--btn primary__btn" href="'.$link.'">Đọc thêm </a>
                            </div>
                        </div>
                    </div>';
    }
    return $html_dsblog;
}

function showblog_lq($dsblog) {
    $html_dsblog='';
    foreach ($dsblog as $blog) {
        extract($blog);
        $link='index.php?pg=blog-detail&idblog='.$id;
        $html_dsblog.='<div class="col mb-28">
                                <div class="related__post--items">
                                    <div class="related__post--thumb border-radius-10 mb-15">
                                        <a class="display-block" href="'.$link.'"><img class="related__post--img display-block border-radius-10" src="./view/assets/img/blog/'.$img.'" alt="related-post" width="617px" height="412px"></a>
                                    </div>
                                    <div class="related__post--text">
                                        <h3 class="related__post--title"><a class="related__post--title__link" href="'.$link.'">'.$title.'</a></h3>
                                        <span class="related__post--deta">'.$date.'</span>
                                    </div>
                                </div>
                            </div>';
    }
    return $html_dsblog;
}