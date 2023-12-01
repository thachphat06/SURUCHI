<?php
    $html_dm='';
    foreach ($dsdm as $dm) {
        extract($dm);
        if($id==$iddm){
            $se="selected";
        } else{
            $se="";
        }
        $link='index.php?pg=blog-list&iddm='.$id;
        $html_dm.='<li class="widget__categories--menu__list">
                        <option value="'.$link.'" '.$se.'>'.$name.'</option>
                    </li>';
    } 
    $html_bloglist=showblog_admin($bloglist);
?>
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Danh sách tin tức</h2>
        </div>
        <div>
            <a href="index.php?pg=page-add-blog" class="btn btn-primary btn-sm rounded">Thêm tin tức</a>
        </div>
    </div>
    <div class="card mb-4">
        <header class="card-header">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 me-auto">
                    <form action="index.php?pg=page-blog-list" method="post">
                        <input type="text" name="kyw" placeholder="Tìm kiếm..." class="form-control">
                        <button hidden class="btn btn-light bg btn-fix" type="submit" name="search"> <i class="material-icons md-search"></i></button>
                    </form>
                </div>
                <div class="col-lg-3 col-md-3 col-6">
                    <select class="form-select" id="mySelect">
                        <option value="index.php?pg=page-blog-list" selected>Tất cả tin tức</option>
                        <?=$html_dm;?>
                    </select>
                </div>
            </div>
        </header>
        <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="9%">STT</th>
                            <th>Tác giả</th>
                            <th style="padding-left: 55px;">Ngày đăng</th>
                            <th style="padding-right: 40px;">Tiêu đề</th>
                            <th class="text-end"> Action </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <?=$html_bloglist;?>
        </div>
        <!-- card-body end// -->
    </div>
    <!-- card end// -->
    <div class="pagination-area mt-30 mb-50">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-start">
                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                <li class="page-item"><a class="page-link" href="#">02</a></li>
                <li class="page-item"><a class="page-link" href="#">03</a></li>
                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">16</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="material-icons md-chevron_right"></i></a>
                </li>
            </ul>
        </nav>
    </div>
</section>
