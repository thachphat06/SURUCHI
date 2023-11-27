<?php 
    $html_orderlist='';
    foreach ($orderlist as $order) {
        extract($order);
        if($status==1) $tt='<span class="badge rounded-pill alert-warning">Pending</span>';
        if($status==2) $tt='<span class="badge rounded-pill alert-success">Confirm</span>';
        if($status==3) $tt='<span class="badge rounded-pill alert-success">Delivering</span>';
        if($status==4) $tt='<span class="badge rounded-pill alert-success">Complete</span>';
        if($status==5) $tt='<span class="badge rounded-pill alert-warning">Delivery failed</span>';
        if($status==6) $tt='<span class="badge rounded-pill alert-danger">Cancelled</span>';
        $html_orderlist.='<tr>
                            <td>#'.$mahd.'</td>
                            <td><b>'.$nguoidat_ten.'</b></td>
                            <td>'.number_format($tongthanhtoan,0,",",".").'VNĐ</td>
                            <td>'.$tt.'</td>
                            <td>'.$date.'</td>
                            <td class="text-end">
                                <a href="index.php?pg=orders-detail&id='.$id.'" class="btn btn-md rounded font-sm">Chi tiết</a>
                            </td>
                        </tr>';
    }
?>

<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Danh sách đơn đặt hàng</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <header class="card-header">
                    <div class="row gx-3">
                        <div class="col-lg-4 col-md-6 me-auto">
                            <input type="text" placeholder="Tìm kiếm..." class="form-control">
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <select class="form-select">
                                <option>Trạng thái</option>
                                <option>Active</option>
                                <option>Disabled</option>
                                <option>Show all</option>
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
                                    <th>ID</th>
                                    <th>Tên Khách Hàng</th>
                                    <th>Tổng Tiền</th>
                                    <th>Trạng Thái</th>
                                    <th>Ngày Đặt Hàng</th>
                                    <th class="text-end"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?=$html_orderlist;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- table-responsive //end -->
                </div>
                <!-- card-body end// -->
            </div>
            <!-- card end// -->
        </div>
    </div>
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