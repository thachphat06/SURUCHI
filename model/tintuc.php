<?php
require_once 'pdo.php';

function blog_insert($author, $date, $title, $content, $img, $idloai){
    $sql = "INSERT INTO blog (author, date, title, content, img, idloai) VALUES (?,?,?,?,?,?)";
    pdo_execute($sql, $author, $date, $title, $content, $img, $idloai);
}
function blog_update($author, $date, $title, $content, $img, $id){
    if($img!=""){
        $sql = "UPDATE blog SET author=?, date=?, title=?, content=?, img=? WHERE id=?";
        pdo_execute($sql, $author, $date, $title, $content, $img, $id);
    } else{
        $sql = "UPDATE blog SET author=?, date=?, title=?, content=?, idloai=? WHERE id=?";
        pdo_execute($sql, $author, $date, $title, $content, $id);
    }
}

function blog_delete($id){
    $sql = "DELETE FROM blog WHERE  id=?";   
    pdo_execute($sql, $id);
}

function get_tt_by_id($id){
    $sql = "SELECT * FROM blog WHERE id=?";
    return pdo_query_one($sql, $id);
}

function get_iddmuc($id){
    $sql = "SELECT idloai FROM blog WHERE id=?";
    return pdo_query_value($sql, $id);
}

function get_blog($limi){
    $sql = " SELECT * FROM blog ORDER BY id limit " . $limi;
    return pdo_query($sql);
}

function get_dsblog($kyw, $idloai, $limi){
    $sql = "SELECT * FROM blog WHERE 1";
    if ($idloai > 0) {
        $sql .= " AND idloai=" . $idloai;
    }
    if ($kyw != "") {
        $sql .= " AND name LIKE '%" . $kyw . "%'";
    }

    $sql .= " ORDER BY id ASC LIMIT " . $limi;
    return pdo_query($sql);
}

function get_blog_by_id($id){
    $sql = "SELECT * FROM blog WHERE id=?";
    return pdo_query_one($sql, $id);
}

function get_blog_lienquan($idloai, $id, $limi){
    $sql = "SELECT * FROM blog WHERE $idloai=? AND id<>? ORDER BY view DESC limit  " . $limi;
    return pdo_query($sql, $idloai, $id);
}

function showblog($dsblog){
    $html_dsblog = '';
    foreach ($dsblog as $blog) {
        extract($blog);

        $link = "index.php?pg=blog-detail&idblog=" . $id;
        $html_dsblog .= '<div class="col mb-30">
                        <div class="blog__items">
                            <div class="blog__thumbnail">
                                <a class="blog__thumbnail--link" href="' . $link . '"><img class="blog__thumbnail--img" src="./view/assets/img/blog/' . $img . '" alt="blog-img"></a>
                            </div>
                            <div class="blog__content">
                                <span class="blog__content--meta">' . $date . '</span>
                                <h3 class="blog__content--title"><a href="' . $link . '">' . $title . '</a></h3>
                                <a class="blog__content--btn primary__btn" href="' . $link . '">Đọc thêm</a>
                            </div>
                        </div>
                    </div>';
    }
    return $html_dsblog;
}

function showblog_slide($dsblog){
    $html_dsblog = '';
    foreach ($dsblog as $blog) {
        extract($blog);

        $link = "index.php?pg=blog-detail&idblog=" . $id;
        $html_dsblog .= '<div class="swiper-slide">
                        <div class="blog__items">
                            <div class="blog__thumbnail">
                                <a class="blog__thumbnail--link" href="' . $link . '"><img class="blog__thumbnail--img" src="./view/assets/img/blog/' . $img . '" alt="blog-img"></a>
                            </div>
                            <div class="blog__content">
                                <span class="blog__content--meta">' . $date . '</span>
                                <h3 class="blog__content--title"><a href="' . $link . '">' . $title . '</a></h3>
                                <a class="blog__content--btn primary__btn" href="' . $link . '">Đọc thêm </a>
                            </div>
                        </div>
                    </div>';
    }
    return $html_dsblog;
}

function showblog_lq($dsblog){
    $html_dsblog = '';
    foreach ($dsblog as $blog) {
        extract($blog);
        $link = 'index.php?pg=blog-detail&idblog=' . $id;
        $html_dsblog .= '<div class="col mb-28">
                                <div class="related__post--items">
                                    <div class="related__post--thumb border-radius-10 mb-15">
                                        <a class="display-block" href="' . $link . '"><img class="related__post--img display-block border-radius-10" src="./view/assets/img/blog/' . $img . '" alt="related-post" width="617px" height="412px"></a>
                                    </div>
                                    <div class="related__post--text">
                                        <h3 class="related__post--title"><a class="related__post--title__link" href="' . $link . '">' . $title . '</a></h3>
                                        <span class="related__post--deta">' . $date . '</span>
                                    </div>
                                </div>
                            </div>';
    }
    return $html_dsblog;
}

//ADMIN
function showblog_admin($dsblog){
    $html_dsblog = '';
    $i=1;
    foreach ($dsblog as $blog) {
        extract($blog);
        $html_dsblog .= '<article class="itemlist">
                            <div class="row align-items-center">
                                <div class="col-lg-1 col-quantity"> 
                                    <span>'.$id.'</span> 
                                </div>
                                <div class="col-lg-2 col-sm-4 col-8 flex-grow-1 col-name">
                                    <a class="itemside" href="#">
                                        <div class="info">
                                            <h6 class="mb-0" style="margin-left:-30px">'.$author.'</h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-1 col-sm-2 col-4 col-price"> 
                                    <span style="display: inline-block;min-width: 100px;float: left;margin-left:-445px" >'.$date.'</span> 
                                </div>
                                <div class="col-lg-1 col-sm-2 col-4 col-old_price">
                                    <span><del style="text-decoration: none;display: inline-block;min-width: 300px;margin-left:-300px" >'.$title.'</del></span> 
                                </div>
                                <div class="col-lg-1 col-sm-2 col-4 col-action text-end">
                                    <a href="index.php?pg=page-update-blog&id='.$id.'" class="btn btn-sm font-sm rounded btn-brand">
                                        <i class="material-icons md-edit"></i>Sửa</a>
                                    <a href="index.php?pg=delblog&id='.$id.'" class="btn btn-sm font-sm btn-light rounded">
                                        <i class="material-icons md-delete_forever"></i>Xóa
                                    </a>
                                </div>
                            </div>
                        </article>';
                        $i++;
    }
    return $html_dsblog;
}
