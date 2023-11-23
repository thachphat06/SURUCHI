<?php 
    $html_productlist=showsp_admin($productlist);
?>

<section class="content-main">
            <div class="content-header">
                <div>
                    <h2 class="content-title card-title">Danh sách sản phẩm</h2>
                </div>
                <div>
                    <!-- <a href="#" class="btn btn-light rounded font-md">Export</a>
                    <a href="#" class="btn btn-light rounded  font-md">Import</a> -->
                    <a href="index.php?pg=form-add-product" class="btn btn-primary btn-sm rounded">Thêm sản phẩm</a>
                </div>
            </div>
            <div class="card mb-4">
                <header class="card-header">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-6 me-auto">
                            <input type="text" placeholder="Tìm kiếm..." class="form-control">
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <select class="form-select">
                                <option selected>Tất cả danh mục</option>
                                <option>Electronics</option>
                                <option>Clothes</option>
                                <option>Automobile</option>
                            </select>
                        </div>
                        <!-- <div class="col-md-2 col-6">
                            <input type="date" value="02.05.2022" class="form-control">
                        </div> -->
                        <!-- <div class="col-md-2 col-6">
                            <select class="form-select">
                                <option selected>Trạng thái</option>
                                <option>Active</option>
                                <option>Disabled</option>
                                <option>Show all</option>
                            </select>
                        </div> -->
                    </div>
                </header>
                <!-- card-header end// -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="9%">STT</th>
                                    <th>Sản phẩm</th>
                                    <th style="padding-left: 165px;">Giá</th>
                                    <th style="padding-right: 40px;">Giá gốc</th>
                                    <th style="padding-right: 280px;">Mô tả</th>
                                    <th class="text-end"> Action </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <?=$html_productlist;?>
                </div>
                <!-- card-body end// -->
            </div>
            <!-- card en    d// -->
            <div class="pagination-area mt-30 mb-50">
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