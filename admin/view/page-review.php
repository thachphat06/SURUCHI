<?php
    $html_cmt="";
    foreach($comment_list as $binhluan) {
        extract($binhluan);
        $html_cmt.=' <tr>
        <td>
            <a href="#" class="itemside">
                <div class="left">
                    <img src="../uploads/'.$user_img.'" class="img-sm img-avatar" alt="Userpic">
                </div>
                <div class="info pl-3">
                    <h6 class="mb-0 title">'.$user_name.'</h6>
                    <small class="text-muted">Seller ID: '.$user_id.'</small>
                </div>
            </a>
        </td>
        <td>'.$product_name.'</td>
        <td width="35%">
          '.$content.'
        </td>
        <td>'.$date.'</td>
        <td class="text-end">
            <a class="btn btn-sm btn-brand rounded font-sm mt-14" href="index.php?pg=delcomment&id='.$id.'">Xóa</a>
        </td>
    </tr>';
    }
?>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Bình luận từ khách hàng</h2>
    </div>
    <div class="card mb-4">
        <header class="card-header">
            
        </header>
        <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tài Khoản</th>
                            <th>Sản Phẩm</th>
                            <th>Bình Luận</th>
                            <th>Ngày</th>
                            <th class="text-end"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                       <?=$html_cmt;?>
                    </tbody>
                </table>
                <!-- table-responsive.// -->
            </div>
        </div>
        <!-- card-body end// -->
    </div>
    <!-- card end// -->
    <div class="pagination-area mt-15 mb-50">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-start">
                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                <li class="page-item"><a class="page-link" href="#">02</a></li>
                <li class="page-item"><a class="page-link" href="#">03</a></li>
                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">16</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="material-icons md-chevron_right"></i></a></li>
            </ul>
        </nav>
    </div>
</section>
