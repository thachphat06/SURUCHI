<?php 
    $revenue=0;
    $count_order=0;
    $total_products = 0;
    foreach ($orderlist as $order) {
        extract($order);
        if($status==4){
            $revenue += $total;
        }
        if($status == 1 || $status == 2){
            $count_order++;
        }
    }

    foreach ($count_product as $item) {
        extract($item);
        $total_products += 1;
    }

    $html_userlist = '';
    $count = 0;

    foreach ($userlist as $item) {
        extract($item);

        $html_userlist .= '<div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <img src="../uploads/'.$img.'" alt="" class="avatar">
                                    <div>
                                        <h6>'.$name.'</h6>
                                    </div>
                                </div>
                            </div>';

        // Tăng biến đếm sau mỗi lần lặp
        $count++;

        // Kiểm tra nếu biến đếm đạt đến 3, thoát khỏi vòng lặp
        if ($count === 6) {
            break;
        }
    }
?>

<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Dashboard </h2>
            <p>Toàn bộ dữ liệu về doanh nghiệp của bạn ở đây</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary material-icons md-monetization_on"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Doanh Thu</h6>
                        <span><?=number_format($revenue,0,",",".")?> VNĐ</span>
                        <span class="text-sm">
                            Phí vận chuyển không được bao gồm
                        </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success material-icons md-local_shipping"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Đơn Hàng</h6> <span><?=$count_order?></span>
                        <span class="text-sm">
                            Không bao gồm các đơn hàng đang vận chuyển
                        </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-qr_code"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Các sản phẩm</h6> <span><?=$total_products?></span>
                        <span class="text-sm">
                            Trong 3 danh mục
                        </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Thu nhập hàng tháng</h6> <span><?=number_format($revenue,0,",",".")?> VNĐ</span>
                        <span class="text-sm">
                            Dựa trên giờ địa phương của bạn.
                        </span>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-12">
            <div class="card mb-4">
                <article class="card-body">
                    <h5 class="card-title">Thống kê bán hàng</h5>
                    <canvas id="myChart" height="120px"></canvas>
                </article>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="card mb-4">
                        <article class="card-body">
                            <h5 class="card-title">Thành viên mới</h5>
                            <div class="new-member-list">
                                <?=$html_userlist;?>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card mb-4">
                        <article class="card-body">
                            <h5 class="card-title">Hoạt động gần đây</h5>
                            <ul class="verti-timeline list-unstyled font-sm">
                                <li class="event-list">
                                    <div class="event-timeline-dot">
                                        <i class="material-icons md-play_circle_outline font-xxl"></i>
                                    </div>
                                    <div class="media">
                                        <div class="me-3">
                                            <h6><span>Today</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>
                                        </div>
                                        <div class="media-body">
                                            <div>
                                                Lorem ipsum dolor sit amet consectetur
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="event-list active">
                                    <div class="event-timeline-dot">
                                        <i class="material-icons md-play_circle_outline font-xxl animation-fade-right"></i>
                                    </div>
                                    <div class="media">
                                        <div class="me-3">
                                            <h6><span>17 May</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>
                                        </div>
                                        <div class="media-body">
                                            <div>
                                                Debitis nesciunt voluptatum dicta reprehenderit
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="event-list">
                                    <div class="event-timeline-dot">
                                        <i class="material-icons md-play_circle_outline font-xxl"></i>
                                    </div>
                                    <div class="media">
                                        <div class="me-3">
                                            <h6><span>13 May</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>
                                        </div>
                                        <div class="media-body">
                                            <div>
                                                Accusamus voluptatibus voluptas.
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="event-list">
                                    <div class="event-timeline-dot">
                                        <i class="material-icons md-play_circle_outline font-xxl"></i>
                                    </div>
                                    <div class="media">
                                        <div class="me-3">
                                            <h6><span>05 April</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>
                                        </div>
                                        <div class="media-body">
                                            <div>
                                                At vero eos et accusamus et iusto odio dignissi
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="event-list">
                                    <div class="event-timeline-dot">
                                        <i class="material-icons md-play_circle_outline font-xxl"></i>
                                    </div>
                                    <div class="media">
                                        <div class="me-3">
                                            <h6><span>26 Mar</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>
                                        </div>
                                        <div class="media-body">
                                            <div>
                                                Responded to need “Volunteer Activities
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </article>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="card mb-4">
                <article class="card-body">
                    <h5 class="card-title">Cơ sở doanh thu theo khu vực</h5>
                    <canvas id="myChart2" height="217"></canvas>
                </article>
            </div>
            <div class="card mb-4">
                <article class="card-body">
                    <h5 class="card-title">Kênh tiếp thị</h5>
                    <span class="text-muted font-xs">Facebook</span>
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" style="width: 15%">15%</div>
                    </div>
                    <span class="text-muted font-xs">Instagram</span>
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" style="width: 65%">65% </div>
                    </div>
                    <span class="text-muted font-xs">Google</span>
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" style="width: 51%"> 51% </div>
                    </div>
                    <span class="text-muted font-xs">Twitter</span>
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" style="width: 80%"> 80%</div>
                    </div>
                    <span class="text-muted font-xs">Other</span>
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" style="width: 80%"> 80%</div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>