<?php
    $html_userlist="";
    foreach($listuser as $users){
    extract($users);
    $html_userlist.='<tr>
                        <td width="23%">
                            <a href="#" class="itemside">
                                <div class="left">
                                    <img src="../uploads/'.$img.'" class="img-sm img-avatar" alt="Userpic">
                                </div>
                                <div class="info pl-3">
                                    <h6 class="mb-0 title">'.$username.'</h6>
                                    <small class="text-muted" style="font-size: 12px;">'.$name.'</small> <br>
                                    <small class="text-muted">Mã khách hàng: #'.$id.'</small>
                                </div>
                            </a>
                        </td>
                        <td>
                            <a href="mailto:'.$email.'" class="__cf_email__">'.$email.'</a>
                        </td>
                        <td><span class="badge rounded-pill alert-success">'.$sdt.'</span></td>
                        <td width="30%">'.$address.'</td>
                        <td class="text-end">
                            <a href="index.php?pg=deluser&id='.$id.'" class="btn btn-sm btn-brand rounded font-sm mt-15">Xóa</a>
                        </td>
                    </tr>';
    }
?>

<section class="content-main">
            <div class="content-header">
                <h2 class="content-title">Danh Sách Khách Hàng</h2>
                <div>
                    <a href="#" class="btn btn-primary"><i class="material-icons md-plus"></i>Thêm Tài Khoản</a>
                </div>
            </div>
            <div class="card mb-4">
                <header class="card-header">
                    <div class="row gx-3">
                        <div class="col-lg-4 col-md-6 me-auto">
                            <input type="text" placeholder="Tìm..." class="form-control">
                        </div>
                    </div>
                </header>
                <!-- card-header end// -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tài Khoản</th>
                                    <th>Email</th>
                                    <th>SDT</th>
                                    <th>Địa Chỉ</th>
                                    <th class="text-end"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?=$html_userlist;?>
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